<?php require "koneksi.php"; ?>
<!-- Hapus Data Pustakawan -->
<?php
    // Data Pustakawan
    if(isset($_POST['sure-hapus'])){
        $idpus = $_POST['idnya'];
        // Ambil data gambar untuk dihapus
        $gmbrh = $con->prepare("SELECT image FROM pustakawan WHERE idPustakawan=:id");
        $gmbrh->bindParam(':id', $idpus);
        $gmbrh->execute();
        $row = $gmbrh->fetch(PDO::FETCH_ASSOC); 
        if($row['image']!="default.jpg"){
            unlink("../upload/".$row['image']);
        }
        // Menghapus dr tabel pustakawan
        $hapuspust = $con->prepare("DELETE FROM pustakawan WHERE idPustakawan=:idpus");
        $hapuspust->bindParam(':idpus', $idpus);
        $hapuspust->execute();
        // Menghapus dr tabel login
        $hapuslogin = $con->prepare("DELETE FROM login WHERE idPustakawan=:idpus");
        $hapuslogin->bindParam(':idpus', $idpus);
        $hapuslogin->execute();

        $idlama = $_POST['idlama'];
        header("Location: ../pustakawan/data-pustakawan.php?id=$idlama&success=yes&act=dihapus");
    }

    // data Buku
    if(isset($_POST['sure-hapus-buku'])){
        $idbuk = $_POST['idnya'];
        // Ambil data gambar untuk dihapus
        $gmbrh = $con->prepare("SELECT * FROM buku WHERE idBuku=:id");
        $gmbrh->bindParam(':id', $idbuk);
        $gmbrh->execute();
        $rowbuk = $gmbrh->fetch(PDO::FETCH_ASSOC); 
        if($rowbuk['image']!="default.jpg"){
            unlink("../upload/buku/".$rowbuk['image']);
        }
        // Menghapus dr tabel buku
        $hapusbuk = $con->prepare("DELETE FROM buku WHERE idBuku=:idpus");
        $hapusbuk->bindParam(':idpus', $idbuk);
        $hapusbuk->execute();

        $idlama = $_POST['idlama'];
        header("Location: ../pustakawan/data-buku.php?id=$idlama&success=yes&act=dihapus");
    }

    // data Penerbit
    if(isset($_POST['hapuspenerbit'])){
        $idpen = $_POST['idnya'];
        $idlama = $_POST['idlama'];
        // Periksa id penerbit di tabel buku
        $cek=$con->prepare("SELECT * FROM buku WHERE idPenerbit=:idp");
        $cek->bindParam(':idp', $idpen);
        $cek->execute();
        $total = $cek->rowCount();

        if($total==0){
            // Menghapus dr tabel penerbit
            $hapusbuk = $con->prepare("DELETE FROM penerbit WHERE idPenerbit=:idpen");
            $hapusbuk->bindParam(':idpen', $idpen);
            $hapusbuk->execute();

            header("Location: ../pustakawan/penerbit.php?id=$idlama&success=yes&act=dihapus");
        } else {
            $pesan = "Maaf, iD Penerbit ini telah digunakan pada tabel buku";
            header("Location: ../pustakawan/penerbit.php?id=$idlama&success=no&pesan=$pesan");
        }
    }

    // data Siswa
    if(isset($_POST['sishapus'])){
        $idbuk = $_POST['idnya'];
        // Periksa di tabel transaksi
        $cek = $con->prepare("SELECT * FROM transaksi WHERE nis=:nis");
        $cek->bindParam(':nis', $idbuk);
        $cek->execute();
        $jcek = $cek->rowCount();
        if($jcek==0){
            // Ambil data gambar untuk dihapus
            $gmbrh = $con->prepare("SELECT * FROM siswa WHERE nis=:id");
            $gmbrh->bindParam(':id', $idbuk);
            $gmbrh->execute();
            $rowbuk = $gmbrh->fetch(PDO::FETCH_ASSOC); 
            if($rowbuk['image']!="default.jpg"){
                unlink("../upload/siswa/".$rowbuk['image']);
            }
            // Menghapus dr tabel buku
            $hapusbuk = $con->prepare("DELETE FROM siswa WHERE nis=:idpus");
            $hapusbuk->bindParam(':idpus', $idbuk);
            $hapusbuk->execute();

            $idlama = $_POST['idlama'];
            header("Location: ../pustakawan/data-siswa.php?id=$idlama&success=yes&act=dihapus");
        } else {
            $idlama = $_POST['idlama'];
            $pesan = "Siswa ini masih terdaftar ke dalam transaksi";
            header("Location: ../pustakawan/data-siswa.php?id=$idlama&success=no&pesan=$pesan");
        }
    }

    // Transaksi
    if(isset($_POST['hapustr'])){
        $idnya = $_POST['idnya'];
        // Menghapus dr tabel detailtransaksi
        $hapus2 = $con->prepare("DELETE FROM detailtransaksi WHERE idTransaksi=:idnya2");
        $hapus2->bindParam(':idnya2', $idnya);
        $hapus2->execute();
        // Menghapus dr tabel transaksi
        $hapus = $con->prepare("DELETE FROM transaksi WHERE idTransaksi=:idnya");
        $hapus->bindParam(':idnya', $idnya);
        $hapus->execute();
        $idlama = $_POST['idlama'];
        header("Location: ../pustakawan/transaksi.php?id=$idlama&error=no&act=dihapus");
    }
?>