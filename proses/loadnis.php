<?php
require "koneksi.php";
    if(isset($_POST['niss'])){
        $nis = $_POST['niss'];
        $s = $con->prepare("SELECT * FROM siswa WHERE nis=:nis");
        $s->bindParam(':nis', $nis);
        $s->execute();

        $ada = $s->rowCount();
        if($ada == 1){
            $row=$s->fetch(PDO::FETCH_ASSOC);
            echo $row['nama'].",";
            echo $row['tingkat']."-".$row['jurusan']."-".$row['kelas'];
        } else {
            echo "NIS tidak terdaftar, NIS tidak terdaftar";
        }
    }
?>