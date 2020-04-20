<?php
require "koneksi.php";
    if(isset($_POST['cekidt'])){
        $id = $_GET['id'];
        $idt = $_POST['idt'];
        // Periksa apakah id transaksi ada atau tidak
        $periksa = $con->prepare("SELECT * FROM transaksi WHERE idTransaksi=:idt");
        $periksa->bindParam(':idt', $idt);
        $periksa->execute();
        $jumlah = $periksa->rowCount();
        if($jumlah==1){
            header("Location: ../pustakawan/pengembalian.php?id=$id&idt=$idt");
        } else {
            $pesan = "Maaf, id transaksi yang dimasukkan tidak tersedia..";
            header("Location: ../pustakawan/transaksi.php?id=$id&error=yes&pesan=$pesan");
        }
    }

    if(isset($_POST['pengembalian'])){
       $id = $_GET['id'];
       $jbuku = $_GET['jbuku'];
       $idt = $_GET['idt'];
       $nis = $_POST['nis'];
       $namas = $_POST['namas'];
       $idp = $_POST['idp'];
       $namap = $_POST['namap'];
       $today = date('Y-m-d');

       if(!empty($_POST['buk'])){
           $jubuk = [];
           $a = 0;
            foreach($_POST['buk'] as $value){
                // Update status
                $jubuk[$a] = $value;
                $upd = $con->prepare("UPDATE detailtransaksi SET status=1, tglDikembalikan=:today WHERE idTransaksi=:idt AND idBuku=:idb");
                $upd->bindParam(':idt', $idt);
                $upd->bindParam(':idb', $value);
                $upd->bindParam(':today', $today);
                $upd->execute();

                // Ambil qty awal
                $am = $con->prepare("SELECT qty FROM buku WHERE idBuku=:idbu");
                $am->bindParam(':idbu', $value);
                $am->execute();
                $amb = $am->fetch(PDO::FETCH_ASSOC);
                $qty = $amb['qty'];
                $qty = $qty + 1;
                // Update qty
                $upq = $con->prepare("UPDATE buku SET qty=:nqty WHERE idBuku=:idbuk");
                $upq->bindParam(':nqty', $qty);
                $upq->bindParam(':idbuk', $value);
                $upq->execute();
                $a++;
            }
            if($jbuku==1){
                header("Location: ../pustakawan/laporankembali.php?id=$id&idt=$idt&nis=$nis&namas=$namas&buku1=$jubuk[0]&jbuku=$a");
            } else {
                header("Location: ../pustakawan/laporankembali.php?id=$id&idt=$idt&nis=$nis&namas=$namas&buku1=$jubuk[0]&buku2=$jubuk[1]&jbuku=$a");
            }
        } else {
            header("Location: ../pustakawan/transaksi.php?id=$id");
        }
    }
?>