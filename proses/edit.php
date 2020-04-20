<?php
    require "koneksi.php";
    if(isset($_POST['edit'])){
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];
        $id = $_POST['id'];
        $i = $_POST["sembunyi"];
        $image_file = $_FILES["file_gambar"]["name"];
        $type = $_FILES["file_gambar"]["type"];
        $size = $_FILES["file_gambar"]["size"];
        $temp = $_FILES["file_gambar"]["tmp_name"];
        $path = "../upload/".$image_file;
        $directory = "../upload/";
        if($image_file){
            if($type=="image/jpg" || $type=="image/jpeg" || $type=="image/png" || $type=="image/gif"){
                if(!file_exists($path)){
                    if($size < 5000000){
                        $ambil_gambar = "SELECT image FROM pustakawan WHERE idPustakawan=:idnya";
                        $ambil = $con->prepare($ambil_gambar);
                        $ambil->bindParam(':idnya', $id);
                        $ambil->execute();
                        while($row=$ambil->fetch(PDO::FETCH_ASSOC)){
                            unlink($directory.$row['image']);
                        }
                        move_uploaded_file($temp, "../upload/".$image_file);
                    } else {
                        $errorMsg = "Your file is too large, please submit file below 5 mb size";
                    }
                } else {
                    $errorMsg = "File already exists, Please check upload folder!";
                }
            } else {
                $errorMsg = "Upload file JPG, JPEG, PNG or GIF only, Please check the extension!";
            }
        } else {
            $image_file = $i;
        }

        if(isset($errorMsg)){
            header("Location: ../pustakawan/home.php?id=$id&success=no&pesan=$errorMsg");
        }
        else {
            $edit = "UPDATE pustakawan SET nama=:nama, alamat=:alamat, phone=:phone, email=:email, image=:image WHERE idPustakawan=:id";
            $ubah = $con->prepare($edit);
            $ubah->bindParam(':nama', $nama);
            $ubah->bindParam(':alamat', $alamat);
            $ubah->bindParam(':phone', $telepon);
            $ubah->bindParam(':email', $email);
            $ubah->bindParam(':image', $image_file);
            $ubah->bindParam(':id', $id);

            if($ubah->execute()){
                echo "<script>alert('File update successfully!');</script>";
            } else {
                echo "<script>alert('File update failed!');</script>";
            }
            header("Location: ../pustakawan/home.php?id=$id&success=yes&act=diedit");
        }
    }

    if(isset($_POST['hisedit'])){
        $hisid = $_GET['hisid'];
        $myid = $_GET['id'];
        $hisnama = $_POST['hisnama'];
        $hisalamat = $_POST['hisalamat'];
        $hisemail = $_POST['hisemail'];
        $hisphone = $_POST['hisphone'];

        $ambil_gambar = "SELECT image FROM pustakawan WHERE idPustakawan=:hisid";
        $ambil = $con->prepare($ambil_gambar);
        $ambil->bindParam(':hisid', $hisid);
        $ambil->execute();
        while($row=$ambil->fetch(PDO::FETCH_ASSOC)){
            $i = $row['image'];
        }
        
        $hisimage_file = $_FILES["hisfilegambar"]["name"];
        $histype = $_FILES["hisfilegambar"]["type"];
        $hissize = $_FILES["hisfilegambar"]["size"];
        $histemp = $_FILES["hisfilegambar"]["tmp_name"];
        $hispath = "../upload/".$hisimage_file;
        $hisdirectory = "../upload/";
        if($hisimage_file){
            if($histype=="image/jpg" || $histype=="image/jpeg" || $histype=="image/png" || $histype=="image/gif"){
                if(!file_exists($hispath)){
                    if($hissize < 5000000){
                        if($i != "default.jpg"){
                            unlink($hisdirectory.$i);
                        }
                        move_uploaded_file($histemp, "../upload/".$hisimage_file);
                    } else {
                        $errorMsg = "Your file is too large, please submit file below 5 mb size";
                    }
                } else {
                    $errorMsg = "File already exists, Please check upload folder!";
                }
            } else {
                $errorMsg = "Upload file JPG, JPEG, PNG or GIF only, Please check the extension!";
            }
        } else {
            $hisimage_file = $i;
        }

        if(isset($errorMsg)){
            header("Location: ../pustakawan/data-pustakawan.php?id=$myid&success=no&pesan=$errorMsg");
        }
        else {
            $edit = "UPDATE pustakawan SET nama=:nama, alamat=:alamat, phone=:phone, email=:email, image=:image WHERE idPustakawan=:hisid2";
            $ubah = $con->prepare($edit);
            $ubah->bindParam(':nama', $hisnama);
            $ubah->bindParam(':alamat', $hisalamat);
            $ubah->bindParam(':phone', $hisphone);
            $ubah->bindParam(':email', $hisemail);
            $ubah->bindParam(':image', $hisimage_file);
            $ubah->bindParam(':hisid2', $hisid);

            if($ubah->execute()){
                echo "<script>alert('File update successfully!');</script>";
            } else {
                echo "<script>alert('File update failed!');</script>";
            }
            header("Location: ../pustakawan/data-pustakawan.php?id=$myid&success=yes&act=diedit");
        }
    }

    if(isset($_POST['editbuku'])){
        $bukid = $_GET['bukid'];
        $myid = $_GET['id'];
        $bukjudul = $_POST['judul'];
        $bukpenulis = $_POST['penulis'];
        $bukqty = $_POST['qty'];
        $bukpenerbit = $_POST['penerbit'];
        $bukkategori = $_POST['kategori'];
        $buksinopsis = $_POST['sinopsis'];

        $ambil_gambar = "SELECT image FROM buku WHERE idBuku=:bukid";
        $ambil = $con->prepare($ambil_gambar);
        $ambil->bindParam(':bukid', $bukid);
        $ambil->execute();
        while($row=$ambil->fetch(PDO::FETCH_ASSOC)){
            $i = $row['image'];
        }
        
        $bukimage_file = $_FILES["gambarbuku"]["name"];
        $buktype = $_FILES["gambarbuku"]["type"];
        $buksize = $_FILES["gambarbuku"]["size"];
        $buktemp = $_FILES["gambarbuku"]["tmp_name"];
        $bukpath = "../upload/buku/".$bukimage_file;
        $bukdirectory = "../upload/buku/";
        if($bukimage_file){
            if($buktype=="image/jpg" || $buktype=="image/jpeg" || $buktype=="image/png" || $buktype=="image/gif"){
                if(!file_exists($bukpath)){
                    if($buksize < 5000000){
                        if($i != "default.jpg"){
                            unlink($bukdirectory.$i);
                        }
                        move_uploaded_file($buktemp, "../upload/buku/".$bukimage_file);
                    } else {
                        $errorMsg = "Your file is too large, please submit file below 5 mb size";
                    }
                } else {
                    $errorMsg = "File already exists, Please check upload folder!";
                }
            } else {
                $errorMsg = "Upload file JPG, JPEG, PNG or GIF only, Please check the extension!";
            }
        } else {
            $bukimage_file = $i;
        }

        if(isset($errorMsg)){
            header("Location: ../pustakawan/data-buku.php?id=$myid&success=no&pesan=$errorMsg");
        }
        else {
            $edit = "UPDATE buku SET idKategori=:idkat, judul=:judul, idPenerbit=:idpen, penulis=:penulis, qty=:qty, image=:image, sinopsis=:sinopsis WHERE idBuku=:bukid";
            $ubah = $con->prepare($edit);
            $ubah->bindParam(':bukid', $bukid);
            $ubah->bindParam(':idkat', $bukkategori);
            $ubah->bindParam(':judul', $bukjudul);
            $ubah->bindParam(':idpen', $bukpenerbit);
            $ubah->bindParam(':penulis', $bukpenulis);
            $ubah->bindParam(':qty', $bukqty);
            $ubah->bindParam(':image', $bukimage_file);
            $ubah->bindParam(':sinopsis', $buksinopsis);

            if($ubah->execute()){
                echo "<script>alert('File update successfully!');</script>";
            } else {
                echo "<script>alert('File update failed!');</script>";
            }
            header("Location: ../pustakawan/data-buku.php?id=$myid&success=yes&act=diedit");
        }
    }

    if(isset($_POST['editpen'])){
        $myid = $_GET['id'];
        $idpen = $_GET['idpen'];
        $namapen = $_POST['namapen'];
        $alamatpen = $_POST['alamatpen'];
        $phonepen = $_POST['phonepen'];
        $emailpen = $_POST['emailpen'];

        $ubahpen = $con->prepare("UPDATE penerbit SET nama=:namapen, alamat=:alamatpen, phone=:phonepen, email=:emailpen WHERE idPenerbit=:idpen");
        $ubahpen->bindParam(':namapen', $namapen);
        $ubahpen->bindParam(':alamatpen', $alamatpen);
        $ubahpen->bindParam(':phonepen', $phonepen);
        $ubahpen->bindParam(':emailpen', $emailpen);
        $ubahpen->bindParam(':idpen', $idpen);
        $ubahpen->execute();

        header("Location: ../pustakawan/penerbit.php?id=$myid&success=yes&act=diedit");
    }

    if(isset($_POST['editsis'])){
        $myid = $_GET['id'];
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $tingkat = $_POST['tingkat'];
        $jurusan = $_POST['jurusan'];
        $kelas = $_POST['kelas'];
        $idold = $_POST['idygmasukkin'];

        $ambil_gambar = "SELECT image FROM siswa WHERE nis=:nis";
        $ambil = $con->prepare($ambil_gambar);
        $ambil->bindParam(':nis', $nis);
        $ambil->execute();
        while($row=$ambil->fetch(PDO::FETCH_ASSOC)){
            $i = $row['image'];
        }

        $image_file = $_FILES["fotosiswa"]["name"];
        $type = $_FILES["fotosiswa"]["type"];
        $size = $_FILES["fotosiswa"]["size"];
        $temp = $_FILES["fotosiswa"]["tmp_name"];
        $path = "../upload/siswa/".$image_file;
        $directory = "../upload/siswa/";
        if($image_file){
            if($type=="image/jpg" || $type=="image/jpeg" || $type=="image/png" || $type=="image/gif"){
                if(!file_exists($path)){
                    if($size < 5000000){
                        if($i != "default.jpg"){
                            unlink($directory.$i);
                        }
                        move_uploaded_file($temp, "../upload/siswa/".$image_file);
                    } else {
                        $errorMsg = "Your file is too large, please submit file below 5 mb size";
                    }
                } else {
                    $errorMsg = "File already exists, Please check upload folder!";
                }
            } else {
                $errorMsg = "Upload file JPG, JPEG, PNG or GIF only, Please check the extension!";
            }
        } else {
            $image_file = $i;
        }

        if(isset($errorMsg)){
            header("Location: ../pustakawan/data-siswa.php?id=$myid&success=no&pesan=$errorMsg");
        }
        else {
            $edit = "UPDATE siswa SET nama=:nama, alamat=:alamat, jurusan=:jurusan, tingkat=:tingkat, kelas=:kelas, phone=:phone, email=:email, image=:image WHERE nis=:nis";
            $ubah = $con->prepare($edit);
            $ubah->bindParam(':nis', $nis);
            $ubah->bindParam(':nama', $nama);
            $ubah->bindParam(':alamat', $alamat);
            $ubah->bindParam(':jurusan', $jurusan);
            $ubah->bindParam(':tingkat', $tingkat);
            $ubah->bindParam(':kelas', $kelas);
            $ubah->bindParam(':phone', $phone);
            $ubah->bindParam(':email', $email);
            $ubah->bindParam(':image', $image_file);

            if($ubah->execute()){
                echo "<script>alert('File update successfully!');</script>";
            } else {
                echo "<script>alert('File update failed!');</script>";
            }
            header("Location: ../pustakawan/data-siswa.php?id=$myid&success=yes&act=diedit");
        }
    }

    if(isset($_POST['edittran'])){
        $id = $_GET['id'];
        $jbuku = $_GET['jbuku'];
        $idt = $_GET['idt'];
        $kbuku1 = $_POST['kbuku1'];

        // Periksa ID buku apakah ada atau tidak
        $periksa = $con->prepare("SELECT * FROM buku WHERE idBuku=:id1");
        $periksa->bindParam(':id1', $kbuku1);
        $periksa->execute();
        $check = $periksa->fetch(PDO::FETCH_ASSOC);
        $t = $periksa->rowCount();
        if($t==1){
            if($check['qty']>0){
                if($jbuku==2){
                    $kbuku2 = $_POST['kbuku2'];
                    // Periksa ID buku apakah ada atau tidak
                    $periksa2 = $con->prepare("SELECT * FROM buku WHERE idBuku=:id2");
                    $periksa2->bindParam(':id2', $kbuku2);
                    $periksa2->execute();
                    $check2 = $periksa2->fetch(PDO::FETCH_ASSOC);
                    $t2 = $periksa2->rowCount();
                    if($check2['qty']==0){
                        $error = "Maaf, Buku yang dimasukkan kehabisan stok..";
                    }
                    if($t2 != 1){
                        $error = "Maaf, ID Buku yang dimasukkan tidak tersedia..";
                    }
                }
            } else {
                $error = "Maaf, Buku yang dimasukkan kehabisan stok..";
            }
        } else {
            $error = "Maaf, ID Buku yang dimasukkan tidak tersedia..";
        }

        if(!isset($error)){

            $ambil = $con->prepare("SELECT idBuku FROM detailtransaksi WHERE idTransaksi=:idtr");
            $ambil->bindParam(':idtr', $idt);
            $ambil->execute();
            $tid = [];
            $i = 0;
            // Periksa apakah kode bukunya sama
            while($row = $ambil->fetch(PDO::FETCH_ASSOC)){
                $tid[$i] = $row['idBuku'];
                
                echo $tid[$i];
                $i++;
            }
            if($kbuku1!=$tid[0]){
                $tamb = $con->prepare("SELECT qty FROM buku WHERE idBuku=:bukuid");
                $tamb->bindParam(':bukuid', $tid[0]);
                $tamb->execute();
                $tam = $tamb->fetch(PDO::FETCH_ASSOC);
                $tamb2 = $tam['qty'];
                $tamb2 = $tamb2+1;
                // Update qty ke nilai semula
                $up = $con->prepare("UPDATE buku SET qty=:nqty WHERE idBuku=:idb");
                $up->bindParam(':nqty', $tamb2);
                $up->bindParam(':idb', $tid[0]);
                $up->execute();

                $kur = $con->prepare("SELECT qty FROM buku WHERE idBuku=:kbuku");
                $kur->bindParam(':kbuku', $kbuku1);
                $kur->execute();
                $ku = $kur->fetch(PDO::FETCH_ASSOC);
                $kur2 = $ku['qty'];
                $kur2 = $kur2-1;
                // Kurangi qty
                $upk = $con->prepare("UPDATE buku SET qty=:oqty WHERE idBuku=:oid");
                $upk->bindParam(':oqty', $kur2);
                $upk->bindParam(':oid', $kbuku1);
                $upk->execute();
                // Update id buku
                $upt = $con->prepare("UPDATE detailtransaksi SET idBuku=:nidb WHERE idTransaksi=:idt AND idBuku=:buki");
                $upt->bindParam(':nidb', $kbuku1);
                $upt->bindParam(':idt', $idt);
                $upt->bindParam(':buki', $tid[0]);
                $upt->execute();
            }

            if($jbuku==2){
                if($kbuku2!=$tid[1]){
                    $tamb2 = $con->prepare("SELECT qty FROM buku WHERE idBuku=:bukuid");
                    $tamb2->bindParam(':bukuid', $tid[1]);
                    $tamb2->execute();
                    $tam2 = $tamb2->fetch(PDO::FETCH_ASSOC);
                    $tamb22 = $tam2['qty'];
                    $tamb22 = $tamb22+1;
                    // Update qty ke nilai semula
                    $up2 = $con->prepare("UPDATE buku SET qty=:nqty WHERE idBuku=:idb");
                    $up2->bindParam(':nqty', $tamb22);
                    $up2->bindParam(':idb', $tid[1]);
                    $up2->execute();
    
                    $kur2 = $con->prepare("SELECT qty FROM buku WHERE idBuku=:kbuku");
                    $kur2->bindParam(':kbuku', $kbuku2);
                    $kur2->execute();
                    $ku2 = $kur2->fetch(PDO::FETCH_ASSOC);
                    $kur22 = $ku2['qty'];
                    $kur22 = $kur22-1;
                    // Kurangi qty
                    $upk2 = $con->prepare("UPDATE buku SET qty=:oqty WHERE idBuku=:oid");
                    $upk2->bindParam(':oqty', $kur22);
                    $upk2->bindParam(':oid', $kbuku2);
                    $upk2->execute();
                    // Update id buku
                    $upt2 = $con->prepare("UPDATE detailtransaksi SET idBuku=:nidb WHERE idTransaksi=:idt AND idBuku=:buki2");
                    $upt2->bindParam(':nidb', $kbuku2);
                    $upt2->bindParam(':idt', $idt);
                    $upt2->bindParam(':buki2', $tid[1]);
                    $upt2->execute();
                }
            }
            
            header("Location: ../pustakawan/transaksi.php?error=no&act=diedit&id=$id");
        } else {
            header("Location: ../pustakawan/transaksi.php?error=yes&pesan=$error&id=$id");
        }
    }
?>