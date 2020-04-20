<?php

require "../proses/koneksi.php";
$id = $_GET['id'];
$query = "SELECT * FROM pustakawan, login WHERE pustakawan.idPustakawan=:id AND pustakawan.idPustakawan=login.idPustakawan";
$result = $con->prepare($query);
$result->bindParam(':id', $id);
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
  $nama = $row['nama'];
  $alamat = $row['alamat'];
  $phone = $row['phone'];
  $email = $row['email'];
  $user = $row['username'];
  $pass = $row['password'];
  $hak = $row['hakUser'];
  $image = $row['image'];
}

    if(isset($_POST['ganti'])){
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $conf = $_POST['confnewpass'];

        if($oldpass == $pass){
            if($newpass == $conf){
                if(isset($_POST['yes'])){
                    $up = $con->prepare("UPDATE login SET password=:pass WHERE idPustakawan=:id");
                    $up->bindParam(':pass', $newpass);
                    $up->bindParam(':id', $id);
                    $up->execute();

                    $ganti = "Password berhasil diganti";
                    header("Location: ../pustakawan/gantipass.php?id=$id&success=yes&act=$ganti");
                } else {
                    $pesan = "Harap beri tanda check pada persetujuan..";
                    header("Location: ../pustakawan/gantipass.php?id=$id&success=no&pesan=$pesan");
                }
            } else {
                $pesan = "Password yang dimasukkan tidak match..";
                header("Location: ../pustakawan/gantipass.php?id=$id&success=no&pesan=$pesan");
            }
        } else {
            $pesan = "Password yang dimasukkan salah..";
            header("Location: ../pustakawan/gantipass.php?id=$id&success=no&pesan=$pesan");
        }
    }
?>