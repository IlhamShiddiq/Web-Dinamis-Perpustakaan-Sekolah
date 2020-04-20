<?php
    require "koneksi.php";
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Periksa akun
        $query = "SELECT * FROM login WHERE username=:user AND password=:pass";
        $result = $con->prepare($query);
        $result->bindParam(':user', $username);
        $result->bindParam(':pass', $password);
        $result->execute();

        $ada = $result->rowCount();


        if($ada >= 1){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $id = $row['idPustakawan'];
            }
            header("Location: ../pustakawan/home.php?id=$id");
        } else {
            $pesan = "Maaf, akun tidak terdaftar..";
            header("Location: ../index.php?login=fail&pesan=$pesan");
        }

    }
?>