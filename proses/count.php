<?php
    // hitung jumlah buku
    $buku = "SELECT * from buku";
    $result_buku = $con->prepare($buku);
    $result_buku->execute();
    $total_buku = $result_buku->rowCount();

    // hitung penerbit
    $penerbit = "SELECT * from penerbit";
    $result_penerbit = $con->prepare($penerbit);
    $result_penerbit->execute();
    $total_penerbit = $result_penerbit->rowCount();

    // hitung penulis
    $penulis = "SELECT * from buku GROUP BY penulis";
    $result_penulis = $con->prepare($penulis);
    $result_penulis->execute();
    $total_penulis = $result_penulis->rowCount();

    // hitung pustakawan
    $pustakawan = "SELECT * from pustakawan";
    $result_pustakawan = $con->prepare($pustakawan);
    $result_pustakawan->execute();
    $total_pustakawan = $result_pustakawan->rowCount();

    // hitung pinjam
    $pinjaman = "SELECT * from detailtransaksi WHERE status=0";
    $result_pinjaman = $con->prepare($pinjaman);
    $result_pinjaman->execute();
    $total_pinjaman = $result_pinjaman->rowCount();
?>