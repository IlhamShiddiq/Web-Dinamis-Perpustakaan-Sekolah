<?php 
    require "koneksi.php";

    $id = $_GET['id'];
    $jbuku = $_GET['jbuku'];
    $today = date('Y-m-d');
    $idp = $_GET['idp'];
    $nis = $_GET['nis'];
    $kbuku1 = $_GET['kbuku1'];
    // Buat Id Baru
    $ambilid = $con->prepare("SELECT idTransaksi FROM transaksi ORDER BY idTransaksi DESC LIMIT 1");
    $ambilid->execute();
    $row = $ambilid->fetch(PDO::FETCH_ASSOC);   
    if(empty($row)){
        $angka = 1;
    } else {
        $angka = preg_replace('/[^0-9]/', '', $row['idTransaksi']);
        $angka = $angka+1;
    }
    // Menggabungkan kode
    $idbaru = "TR".sprintf("%05d", $angka);

    // Mengurangi qty
    $ambqty = $con->prepare("SELECT qty FROM buku WHERE idBuku=:idbuk");
    $ambqty->bindParam(':idbuk', $kbuku1);
    $ambqty->execute();
    $qty1 = $ambqty->fetch(PDO::FETCH_ASSOC);
    $jqty1 = $qty1['qty'];
    $jqty1baru = $jqty1-1;

    if($jqty1baru<0){
        $error = "Maaf Buku yang anda masukkan kehabisan stok..";
        header("Location: ../pustakawan/transaksi.php?error=yes&pesan=$error&id=$id");
    } else {

        if($jbuku==2){
            // Mengurangi qty
            $kbuku2 = $_GET['kbuku2'];
            $ambqty2 = $con->prepare("SELECT qty FROM buku WHERE idBuku=:idbuk");
            $ambqty2->bindParam(':idbuk', $kbuku2);
            $ambqty2->execute();
            $qty12 = $ambqty2->fetch(PDO::FETCH_ASSOC);
            $jqty12 = $qty12['qty'];
            $jqty1baru2 = $jqty12-1;
            
            if($jqty1baru2 < 0){
                $error = "Maaf Buku yang anda masukkan kehabisan stok..";
                header("Location: ../pustakawan/transaksi.php?error=yes&pesan=$error&id=$id");
            } else {
                // Buku ke 1
                // Memasukkan ke tabel transaksi
                $masukt = $con->prepare("INSERT INTO transaksi VALUES (:idt, :nis, :idp, :tglp)");
                $masukt->bindParam(':idt', $idbaru);
                $masukt->bindParam(':nis', $nis);
                $masukt->bindParam(':idp', $idp);
                $masukt->bindParam(':tglp', $today);
                $masukt->execute();
                // Memasukkan ke tabel detaildetail transaksi
                $masukd = $con->prepare("INSERT INTO detailtransaksi(idTransaksi, idBuku, status) VALUES (:idt2, :idb, 0)");
                $masukd->bindParam(':idt2', $idbaru);
                $masukd->bindParam(':idb', $kbuku1);
                $masukd->execute();
                // Update qty
                $uqty = $con->prepare("UPDATE buku SET qty=:nqty WHERE idBuku=:idbu");
                $uqty->bindParam(':nqty', $jqty1baru);
                $uqty->bindParam(':idbu', $kbuku1);
                $uqty->execute();

                // Memasukkan ke tabel detail detailtransaksi
                $masukd2 = $con->prepare("INSERT INTO detailtransaksi(idTransaksi, idBuku, status) VALUES (:idt2, :idb, 0)");
                $masukd2->bindParam(':idt2', $idbaru);
                $masukd2->bindParam(':idb', $kbuku2);
                $masukd2->execute();   
                // Update qty
                $uqty = $con->prepare("UPDATE buku SET qty=:nqty2 WHERE idBuku=:idbu2");
                $uqty->bindParam(':nqty2', $jqty1baru2);
                $uqty->bindParam(':idbu2', $kbuku2);
                $uqty->execute();
                header("Location: ../pustakawan/transaksi.php?error=no&id=$id&act=ditambahkan");
            }
        } else {
            // Memasukkan ke tabel transaksi
            $masukt = $con->prepare("INSERT INTO transaksi VALUES (:idt, :nis, :idp, :tglp)");
            $masukt->bindParam(':idt', $idbaru);
            $masukt->bindParam(':nis', $nis);
            $masukt->bindParam(':idp', $idp);
            $masukt->bindParam(':tglp', $today);
            $masukt->execute();
            // Memasukkan ke tabel detaildetail transaksi
            $masukd = $con->prepare("INSERT INTO detailtransaksi(idTransaksi, idBuku, status) VALUES (:idt2, :idb, 0)");
            $masukd->bindParam(':idt2', $idbaru);
            $masukd->bindParam(':idb', $kbuku1);
            $masukd->execute();
            // Update qty
            $uqty = $con->prepare("UPDATE buku SET qty=:nqty WHERE idBuku=:idbu");
            $uqty->bindParam(':nqty', $jqty1baru);
            $uqty->bindParam(':idbu', $kbuku1);
            $uqty->execute();
            header("Location: ../pustakawan/transaksi.php?error=no&id=$id&act=ditambahkan");
        }
    }
    
?>