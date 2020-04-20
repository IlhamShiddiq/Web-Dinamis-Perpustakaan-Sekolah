<?php
    require "koneksi.php";
    if(isset($_POST['addtran'])){
        $myid = $_GET['id'];
        $nis = $_POST['nis'];
        $idp=$_POST['idp'];
        $jbuku = $_POST['jbuku'];
        $ambil = $con->prepare("SELECT nis FROM siswa");
        $ambil->execute();
        while($row = $ambil->fetch(PDO::FETCH_ASSOC)){
            if($row['nis']==$nis){
                $i = 1;
            }
        }  
        if($i == 1){
            $id1 = $_POST['kbuku1'];
            $cekid = $con->prepare("SELECT * FROM buku WHERE idBuku=:idb");
            $cekid->bindParam(':idb', $id1);
            $cekid->execute();
            $j = $cekid->rowCount();
            if($j==1){
                if($jbuku==2){
                    $id2 = $_POST['kbuku2'];
                    $cekid2 = $con->prepare("SELECT * FROM buku WHERE idBuku=:idb");
                    $cekid2->bindParam(':idb', $id2);
                    $cekid2->execute();
                    $k = $cekid2->rowCount();

                    if($k == 1){
                        $id1 = $_POST['kbuku1'];
                        $id2 = $_POST['kbuku2'];
                        header("Location: addtrans.php?id=$myid&nis=$nis&jbuku=$jbuku&kbuku1=$id1&kbuku2=$id2&idp=$idp");
                    } else {
                        $pesan = "Id buku ".$_POST['kbuku2']." tidak terdaftar di sistem..";
                        header("Location: ../pustakawan/transaksi.php?id=$myid&error=yes&pesan=$pesan");
                    }
                } else {
                    $id1 = $_POST['kbuku1'];
                    header("Location: addtrans.php?id=$myid&nis=$nis&jbuku=$jbuku&kbuku1=$id1&idp=$idp");
                }
            } else {
                $pesan = "Id buku ".$_POST['kbuku1']." tidak terdaftar di sistem..";
                header("Location: ../pustakawan/transaksi.php?id=$myid&error=yes&pesan=$pesan");
            }
        } else {
            header("Location: ../pustakawan/transaksi.php?id=$myid&nis=unrecognized");
        }
    }
?>