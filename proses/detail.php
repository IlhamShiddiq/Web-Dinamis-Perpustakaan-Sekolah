<?php
    require "koneksi.php";
    if(isset($_POST['rowid'])){
        $id = $_POST['rowid'];
        $detail = $con->prepare("SELECT t.idTransaksi, t.tglPinjam, s.nis, s.nama, p.nama AS namap FROM transaksi t, siswa s, pustakawan p WHERE t.nis=s.nis AND p.idPustakawan=t.idPustakawan AND idTransaksi=:id");
        $detail->bindParam(':id', $id);
        $detail->execute();
        $row = $detail->fetch(PDO::FETCH_ASSOC);
        echo $row['idTransaksi'].",";
        echo $row['nama'].",";
        echo $row['namap'].",";
        echo $row['tglPinjam'].",";

        $bk=[];
        $i=0;
        $hit = $con->prepare("SELECT * FROM detailTransaksi d, buku b WHERE b.idBuku=d.idBuku AND idTransaksi=:idt AND d.status='0'");
        $hit->bindParam(':idt', $id);
        $hit->execute();
        $ttl = $hit->rowCount();
        echo $ttl.",";
        while($row2 = $hit->fetch(PDO::FETCH_ASSOC)){
            $bk[$i] = $row2['judul'];
            echo $bk[$i].",";
            $i++;
        }
        
        

    }
?>