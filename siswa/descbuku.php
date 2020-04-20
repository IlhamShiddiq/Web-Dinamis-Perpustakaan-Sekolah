<?php
    require "../proses/koneksi.php";

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $s = $con->prepare("SELECT * FROM buku WHERE idBuku=:id");
        $s->bindParam(':id', $id);
        $s->execute();

        $ada = $s->rowCount();
        if($ada == 1){
            $row=$s->fetch(PDO::FETCH_ASSOC);
            echo $row['judul']."@";
            echo $row['image']."@";
            echo $row['sinopsis'];
        } else {
            echo "ID Buku tak ditemukan!,ID Buku tak ditemukan!,ID Buku tak ditemukan!";
        }
    }
?>