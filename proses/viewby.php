<?php
$id = $_GET['id'];
    if(isset($_POST['go'])){
        $id = $_GET['id'];
        $status = $_POST['status'];
        header("Location: ../pustakawan/transaksi.php?id=$id&status=$status");
    } else if(isset($_POST['reset'])){
        header("Location: ../pustakawan/transaksi.php?id=$id");
    }
?>