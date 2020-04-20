<?php
require "koneksi.php";
    if(isset($_POST['kode'])){
        $kode = $_POST['kode'];
        $s = $con->prepare("SELECT * FROM buku WHERE idBuku=:id");
        $s->bindParam(':id', $kode);
        $s->execute();

        $ada = $s->rowCount();
        if($ada == 1){
            $row=$s->fetch(PDO::FETCH_ASSOC);
            echo $row['judul'];
        } else {
            echo "ID Buku tak ditemukan!";
        }
    }
?>