<?php require "koneksi.php"; ?>
<!-- Tambah Pustakawan -->
<?php
    // Tambah Pustakawan
    if(isset($_POST['addpust'])){
        $idygmasukkin = $_POST['idygmasukkin'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hak = $_POST['hak'];

        $image_file = $_FILES["filegambar"]["name"];
        $type = $_FILES["filegambar"]["type"];
        $size = $_FILES["filegambar"]["size"];
        $temp = $_FILES["filegambar"]["tmp_name"];
        $path = "../upload/".$image_file;

        if(empty($image_file)){
            $filefoto = "default.jpg";
        } else if($type=="image/jpg" || $type=="image/jpeg" || $type=="image/png" || $type=="image/gif"){
            if(!file_exists($path)){
                if($size < 5000000){
                    $filefoto = $image_file;
                } else {
                    $errorMsg = "Your file is too large, please submit file below 5 mb size";
                }
            } else {
                $errorMsg = "File already exists, Please check upload folder!";
            }
        } else {
            $errorMsg = "Upload file JPG, JPEG, PNG or GIF only, Please check the extension!";
        }   
        
        if(!isset($errorMsg)){
            move_uploaded_file($temp, "../upload/".$filefoto);
            $ambilid = $con->prepare("SELECT idPustakawan FROM pustakawan ORDER BY idPustakawan DESC LIMIT 1");
            $ambilid->execute();
            $row = $ambilid->fetch(PDO::FETCH_ASSOC);   

            if(empty($row)){
                $angka = 1;
            } else {
                $angka = preg_replace('/[^0-9]/', '', $row['idPustakawan']);
                $angka = $angka+1;
            }

            // Menggabungkan kode
            $idbaru = "P".sprintf("%03d", $angka);
            // Masukkan data ke tabel login
            $masuklogin = $con->prepare("INSERT INTO login VALUES(:id, :user, :pass, :hak)");
            $masuklogin->bindParam(':id', $idbaru);
            $masuklogin->bindParam(':user', $username);
            $masuklogin->bindParam(':pass', $password);
            $masuklogin->bindParam(':hak', $hak);
            $masuklogin->execute();
            // Masukkan data ke tabel Pustakawan
            $masukpust = $con->prepare("INSERT INTO pustakawan VALUES(:id2, :nama, :alamat, :phone, :email, :image)");
            $masukpust->bindParam(':id2', $idbaru);
            $masukpust->bindParam(':nama', $nama);
            $masukpust->bindParam(':alamat', $alamat);
            $masukpust->bindParam(':phone', $phone);
            $masukpust->bindParam(':email', $email);
            $masukpust->bindParam(':image', $filefoto);
            $masukpust->execute();

            header("Location: ../pustakawan/data-pustakawan.php?id=$idygmasukkin&success=yes&act=ditambahkan");
        } else {
            header("Location: ../pustakawan/data-pustakawan.php?id=$idygmasukkin&success=no&pesan=$errorMsg");
        }
    }



    // Tambah Buku
    if(isset($_POST['addbuku'])){
        $idold = $_POST['idygmasukkin'];
        $judul = $_POST['judul'];
        $kodePenerbit = $_POST['penerbit'];
        $kodeKategori = $_POST['kategori'];
        $penulis = $_POST['penulis'];
        $qty = $_POST['qty'];
        $sinopsis = $_POST['sinopsis'];

        $image_file = $_FILES["gambarbuku"]["name"];
        $type = $_FILES["gambarbuku"]["type"];
        $size = $_FILES["gambarbuku"]["size"];
        $temp = $_FILES["gambarbuku"]["tmp_name"];
        $path = "../upload/buku/".$image_file;

        if(empty($image_file)){
            $filefoto = "default.jpg";
        } else if($type=="image/jpg" || $type=="image/jpeg" || $type=="image/png" || $type=="image/gif"){
            if(!file_exists($path)){
                if($size < 5000000){
                    $filefoto = $image_file;
                } else {
                    $errorMsg = "Your file is too large, please submit file below 5 mb size";
                }
            } else {
                $errorMsg = "File already exists, Please check upload folder!";
            }
        } else {
            $errorMsg = "Upload file JPG, JPEG, PNG or GIF only, Please check the extension!";
        }   
        
        if(!isset($errorMsg)){
            move_uploaded_file($temp, "../upload/buku/".$filefoto);
            $ambilid = $con->prepare("SELECT idBuku FROM buku ORDER BY idBuku DESC LIMIT 1");
            $ambilid->execute();
            $row = $ambilid->fetch(PDO::FETCH_ASSOC);   

            if(empty($row)){
                $angka = 1;
            } else {
                $angka = preg_replace('/[^0-9]/', '', $row['idBuku']);
                $angka = $angka+1;
            }

            // Menggabungkan kode
            $idbaru = "BK".sprintf("%04d", $angka);
            // Masukkan data ke tabel Buku
            $masukpust = $con->prepare("INSERT INTO buku VALUES(:id, :idkat, :judul, :idpen, :penulis, :qty, :image, :sinopsis)");
            $masukpust->bindParam(':id', $idbaru);
            $masukpust->bindParam(':idkat', $kodeKategori);
            $masukpust->bindParam(':judul', $judul);
            $masukpust->bindParam(':idpen', $kodePenerbit);
            $masukpust->bindParam(':penulis', $penulis);
            $masukpust->bindParam(':qty', $qty);
            $masukpust->bindParam(':image', $filefoto);
            $masukpust->bindParam(':sinopsis', $sinopsis);
            $masukpust->execute();

            header("Location: ../pustakawan/data-buku.php?id=$idold&success=yes&act=ditambahkan");
        } else {
            header("Location: ../pustakawan/data-buku.php?id=$idold&success=no&pesan=$errorMsg");
        }
    }

    if(isset($_POST['addpen'])){
        $namapen = $_POST['namapen'];
        $alamatpen = $_POST['alamatpen'];
        $phonepen = $_POST['phonepen'];
        $emailpen = $_POST['emailpen'];
        $myid = $_GET['id'];

        // Buat Id Baru
        $ambilid = $con->prepare("SELECT idPenerbit FROM penerbit ORDER BY idPenerbit DESC LIMIT 1");
        $ambilid->execute();
        $row = $ambilid->fetch(PDO::FETCH_ASSOC);   

        if(empty($row)){
            $angka = 1;
        } else {
            $angka = preg_replace('/[^0-9]/', '', $row['idPenerbit']);
            $angka = $angka+1;
        }
        // Menggabungkan kode
        $idbaru = "PB".sprintf("%03d", $angka);

        // Memasukkan ke tabel penerbit
        $masukpen = $con->prepare("INSERT INTO penerbit VALUES(:idp, :namap, :alamatp, :phonep, :emailp)");
        $masukpen->bindParam(':idp', $idbaru);
        $masukpen->bindParam(':namap', $namapen);
        $masukpen->bindParam(':alamatp', $alamatpen);
        $masukpen->bindParam(':phonep', $phonepen);
        $masukpen->bindParam(':emailp', $emailpen);
        $masukpen->execute();

        header("Location: ../pustakawan/penerbit.php?id=$myid&success=yes&act=ditambahkan");
    }

    // Tambah Siswa
    if(isset($_POST['addsis'])){
        $nis = $_POST['nis'];
        $idold = $_POST['idygmasukkin'];
        // Periksa NIS di tabel siswa
        $cek = $con->prepare("SELECT * FROM siswa WHERE nis=:nisnya");
        $cek->bindParam(':nisnya', $nis);
        $cek->execute();
        $total = $cek->rowCount();

        if($total==0){
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $tingkat = $_POST['tingkat'];
            $jurusan = $_POST['jurusan'];
            $kelas = $_POST['kelas'];

            $image_file = $_FILES["fotosiswa"]["name"];
            $type = $_FILES["fotosiswa"]["type"];
            $size = $_FILES["fotosiswa"]["size"];
            $temp = $_FILES["fotosiswa"]["tmp_name"];
            $path = "../upload/siswa/".$image_file;

            if(empty($image_file)){
                $filefoto = "default.jpg";
            } else if($type=="image/jpg" || $type=="image/jpeg" || $type=="image/png" || $type=="image/gif"){
                if(!file_exists($path)){
                    if($size < 5000000){
                        $filefoto = $image_file;
                    } else {
                        $errorMsg = "Your file is too large, please submit file below 5 mb size";
                    }
                } else {
                    $errorMsg = "File already exists, Please check upload folder!";
                }
            } else {
                $errorMsg = "Upload file JPG, JPEG, PNG or GIF only, Please check the extension!";
            }   
            
            if(!isset($errorMsg)){
                move_uploaded_file($temp, "../upload/siswa/".$filefoto);

                // Masukkan data ke tabel Buku
                $masuksis = $con->prepare("INSERT INTO siswa VALUES(:nis, :nama, :alamat, :jurusan, :tingkat, :kelas, :phone, :email, :image)");
                $masuksis->bindParam(':nis', $nis);
                $masuksis->bindParam(':nama', $nama);
                $masuksis->bindParam(':alamat', $alamat);
                $masuksis->bindParam(':jurusan', $jurusan);
                $masuksis->bindParam(':tingkat', $tingkat);
                $masuksis->bindParam(':kelas', $kelas);
                $masuksis->bindParam(':phone', $phone);
                $masuksis->bindParam(':email', $email);
                $masuksis->bindParam(':image', $filefoto);
                $masuksis->execute();
                $a = "bb";

                header("Location: ../pustakawan/data-siswa.php?id=$idold&success=yes&act=ditambahkan");
            } else {
                header("Location: ../pustakawan/data-siswa.php?id=$idold&success=no&pesan=$errorMsg");
            }
        } else {
            $pesan = "Maaf, NIS yang dimasukkan sudah ada..";
            header("Location: ../pustakawan/data-siswa.php?id=$idold&success=no&pesan=$pesan");
        }
    }
?>