<?php
  require "../proses/koneksi.php";
  require "../proses/today.php";
  require "../proses/count.php";
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
    $hak = $row['hakUser'];
    $image = $row['image'];
  }
?>
<?php
    $nis = $_GET['nis'];
    $sisdata = $con->prepare("SELECT * FROM siswa WHERE nis=:nis");
    $sisdata->bindParam(':nis', $nis);
    $sisdata->execute();
    while($sis = $sisdata->fetch(PDO::FETCH_ASSOC)){
        $sisnama = $sis['nama'];
        $sisalamat = $sis['alamat'];
        $sisjurusan = $sis['jurusan'];
        $sistingkat = $sis['tingkat'];
        $siskelas = $sis['kelas'];
        $sisphone = $sis['phone'];
        $sisemail = $sis['email'];
        $sisimage = $sis['image'];
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- More CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">

    <title>Data Pustakawan - Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
  </head>
  <body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../assets/img/brand/logo.png" width="60" class="d-inline-block align-top" alt="">
          <p class="judul-pertama">perpustakaan</p>
          <p class="judul-kedua">smk negeri 1 kota cimahi</p>
        </a>
      </div>
    </nav>
    <img src="../upload/<?php echo $image; ?>" class="foto-pustakawan foto" width="55" height="55">
    <!-- Akhir Navbar -->
    <!-- Navbar2 -->
    <nav class="navbar2 navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link disabled" href="home.html"><i class="fas fa-book"></i>&nbsp;Dashboard</a>
            <a class="nav-item nav-link disabled" href="data-buku.html"><i class="fas fa-book"></i>&nbsp;Data Buku</a>
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-user-friends"></i>&nbsp;Data Siswa</a>
            <a class="nav-item nav-link disabled" href="#"><i class="fas fa-user-friends"></i>&nbsp;Data Pustakawan</a>
            <a class="nav-item nav-link disabled" href="penerbit.html"><i class="fas fa-book"></i>&nbsp;Penerbit</a>
            <a class="nav-item nav-link disabled" href="transaksi.html"><i class="fas fa-exchange-alt"></i>&nbsp;Transaksi</a>
            <a class="nav-item nav-link disabled" href="laporan.html"><i class="fas fa-clipboard"></i>&nbsp;Laporan</a>
          </div>
        </div>
    </nav>
    <!-- Akhir Navbar2 -->

    <!-- Content -->
    <div class="content">
      <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="a">
                  <div class="your-profile-title text-center pb-1 mb-3">
                    Profil Anda
                  </div>
                  <div class="data-admin">
                    <div class="foto-admin text-center">
                      <img src="../upload/<?php echo $image; ?>" class="foto" width="50" height="50">
                      <hr>
                    </div>
                    <div class="data-admin">
                      <table style="width: 100%;">
                        <tr class="row-data-admin">
                          <td style="width: 30%; vertical-align: top;">Nama</td>
                          <td style="width: 70%;"><?php echo $nama; ?></td>
                        </tr>
                        <tr class="row-data-admin">
                          <td style="vertical-align: top;">Alamat</td>
                          <td><?php echo $alamat; ?></td>
                        </tr>
                        <tr class="row-data-admin">
                          <td style="vertical-align: top;">Phone</td>
                          <td><?php echo $phone; ?></td>
                        </tr>
                        <tr class="row-data-admin">
                          <td style="vertical-align: top;">Email</td>
                          <td><?php echo $email; ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          <div class="col-lg-9">
            <div class="a judul-act">
                Edit Data Siswa
            </div>
            <div class="a">
             <form action="../proses/edit.php?id=<?php echo $id ?>&nis=<?php echo $nis; ?>" method="post" enctype="multipart/form-data">
              <div class="container-fluid">
                <div class="form-group">
                  <div class="row">
                    <div class="col-12">
                      <small>Nomor Induk Siswa</small>
                      <input type="text" class="form-control" name="nis" autocomplete="off" placeholder="NIS..." readonly required value="<?php echo $nis; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <small>Nama Siswa</small>
                      <input type="text" class="form-control" name="nama" autocomplete="off" placeholder="Nama lengkap..." required value="<?php echo $sisnama; ?>">
                    </div>
                    <div class="col-6">
                      <small>Alamat Siswa</small>
                      <input type="text" class="form-control" name="alamat" autocomplete="off" placeholder="Alamat..." required value="<?php echo $sisalamat; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <small>Email</small>
                      <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Email..." required value="<?php echo $sisemail; ?>">
                    </div>
                    <div class="col-6">
                      <small>Nomor Telepon</small>
                      <input type="telp" class="form-control" name="phone" autocomplete="off" placeholder="Nomor Telepon..." required value="<?php echo $sisphone; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-4">
                      <small>Tingkat</small>
                      <select class="form-control" name="tingkat">
                        <option <?php if($sistingkat=="10"){echo "selected";} ?> value="10">10</option>
                        <option <?php if($sistingkat=="11"){echo "selected";} ?> value="11">11</option>
                        <option <?php if($sistingkat=="12"){echo "selected";} ?> value="12">12</option>
                      </select>
                    </div>
                    <div class="col-4">
                      <small>Jurusan</small>
                      <select class="form-control" name="jurusan">
                        <option <?php if($sisjurusan=="MEKA"){echo "selected";} ?> value="MEKA">MEKA</option>
                        <option <?php if($sisjurusan=="IOP"){echo "selected";} ?> value="IOP">IOP</option>
                        <option <?php if($sisjurusan=="PFPT"){echo "selected";} ?> value="PFPT">PFPT</option>
                        <option <?php if($sisjurusan=="RPL"){echo "selected";} ?> value="RPL">RPL</option>
                        <option <?php if($sisjurusan=="SIJA"){echo "selected";} ?> value="SIJA">SIJA</option>
                        <option <?php if($sisjurusan=="TEDK"){echo "selected";} ?> value="TEDK">TEDK</option>
                        <option <?php if($sisjurusan=="TEI"){echo "selected";} ?> value="TEI">TEI</option>
                        <option <?php if($sisjurusan=="TOI"){echo "selected";} ?> value="TOI">TOI</option>
                        <option <?php if($sisjurusan=="TPTU"){echo "selected";} ?> value="TPTU">TPTU</option>
                      </select>
                    </div>
                    <div class="col-4">
                      <small>Kelas</small>
                      <select class="form-control" name="kelas">
                        <option <?php if($siskelas=="A"){echo "selected";} ?> value="A">A</option>
                        <option <?php if($siskelas=="B"){echo "selected";} ?> value="B">B</option>
                        <option <?php if($siskelas=="C"){echo "selected";} ?> value="C">C</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-2 col-sm-6 col-4 text-right">
                      <img src="../upload/siswa/<?php echo $sisimage; ?>" id="gambar" style="width: 80px; height: 100px;">
                    </div>
                    <div class="col-lg-4 col-sm-6 col-8">
                      <input type="file" class="form-control-file" name="fotosiswa" onchange="document.getElementById('gambar').src = window.URL.createObjectURL(this.files[0])">
                      <small>File yang diupload di sini akan dijadikan sebagai foto dari data yang ditambahkan..</small>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                      <input type="hidden" name="idygmasukkin" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-primary mt-3 mb-2" style="width: 100%;" name="editsis">Tambah</button>
                      <a type="submit" class="btn btn-secondary" style="width: 100%; color: white;"  data-toggle="modal" data-target="#batal-edit">Batal</a>
                    </div>
                  </div>
                </div>
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Content -->

    <!-- Footer -->
    <div class="footer text-center">
      Copyright 2020 &copy; Perpustakaan SMK Negeri 1 Kota Cimahi
    </div>
    <!-- Akhir Footer -->

    <!-- Modal Batal Edit -->
    <div class="modal fade" id="batal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please Confirm..</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin membatalkan edit data ?</p>
          </div>
          <div class="modal-footer">
            <a type="submit" style="color: white;" href="data-siswa.php?id=<?php echo $id ?>" name="sure-hapus" class="btn btn-danger">Yes</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Batal Edit -->

    <!-- Modal Batal Edit -->
    <div class="modal fade" id="batal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please Confirm..</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin membatalkan edit data ?</p>
          </div>
          <div class="modal-footer">
            <a type="submit" href="data-buku.php?id=<?php echo $id ?>" name="sure-hapus" class="btn btn-danger">Yes</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Batal Edit -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>