<?php
    $id=$_GET['id'];
    $kata = $_POST['cari'];
    if(isset($_POST['gocaribuku'])){
        header("Location: ../pustakawan/data-buku.php?id=$id&kata=$kata");
    } else if(isset($_POST['allbuku'])){
        header("Location: ../pustakawan/data-buku.php?id=$id");
    }

    if(isset($_POST['gocarisiswa'])){
        header("Location: ../pustakawan/data-siswa.php?id=$id&kata=$kata");
    } else if(isset($_POST['allsiswa'])){
        header("Location: ../pustakawan/data-siswa.php?id=$id");
    }

    if(isset($_POST['gocaripust'])){
        header("Location: ../pustakawan/data-pustakawan.php?id=$id&kata=$kata");
    } else if(isset($_POST['allpust'])){
        header("Location: ../pustakawan/data-pustakawan.php?id=$id");
    }

    if(isset($_POST['gocaripenerbit'])){
        header("Location: ../pustakawan/penerbit.php?id=$id&kata=$kata");
    } else if(isset($_POST['allpenerbit'])){
        header("Location: ../pustakawan/penerbit.php?id=$id");
    }

    if(isset($_POST['gocaritransaksi'])){
        $status=$_GET['status'];
        header("Location: ../pustakawan/transaksi.php?id=$id&kata=$kata&status=$status");
    } else if(isset($_POST['alltransaksi'])){
        $status=$_GET['status'];
        header("Location: ../pustakawan/transaksi.php?id=$id&status=$status");
    }
?>