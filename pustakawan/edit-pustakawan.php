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
    $hisid = $_GET['hisid'];
    $hisdata = $con->prepare("SELECT * FROM pustakawan, login WHERE pustakawan.idPustakawan=:hisid AND pustakawan.idPustakawan=login.idPustakawan");
    $hisdata->bindParam(':hisid', $hisid);
    $hisdata->execute();
    while($his = $hisdata->fetch(PDO::FETCH_ASSOC)){
      $hisnama = $his['nama'];
      $hisalamat = $his['alamat'];
      $hisphone = $his['phone'];
      $hisemail = $his['email'];
      $hisuser = $his['username'];
      $hispass = $his['password'];
      $hishak = $his['hakUser'];
      $hisimage = $his['image'];
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
            <a class="nav-item nav-link disabled" href="data-siswa.html"><i class="fas fa-user-friends"></i>&nbsp;Data Siswa</a>
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-user-friends"></i>&nbsp;Data Pustakawan</a>
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
                Edit Data Pustakawan
            </div>
            <div class="a">
            <form action="../proses/edit.php?hisid=<?php echo $hisid; ?>&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <div class="container-fluid">
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <small>Nama</small>
                      <input type="text" class="form-control" name="hisnama" placeholder="Nama lengkap..." required value="<?php echo $hisnama; ?>">
                    </div>
                    <div class="col-6">
                      <small>Alamat</small>
                      <input type="text" class="form-control" name="hisalamat" placeholder="Alamat..." required value="<?php echo $hisalamat; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <small>Email</small>
                      <input type="email" class="form-control" name="hisemail" placeholder="Email..." required value="<?php echo $hisemail; ?>">
                    </div>
                    <div class="col-6">
                      <small>Nomor Telepon</small>
                      <input type="tel" class="form-control" name="hisphone" placeholder="Nomor Telepon..." required value="<?php echo $hisphone; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <small>Username</small>
                      <input type="text" readonly class="form-control" name="hisusername" placeholder="Username..." required value="<?php echo $hisuser; ?>">
                    </div>
                    <div class="col-6">
                      <small>Password</small>
                      <input type="password" readonly class="form-control" name="hispassword" placeholder="Password..." required value="<?php echo $hispass; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-12">
                      <small>Hak Akses</small>
                      <input type="text" readonly class="form-control" name="hishak" placeholder="Hak User..." required value="<?php echo $hishak; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-2 col-sm-6 col-4 text-right">
                    <img src="../upload/<?php echo $hisimage; ?>" id="hisgambar" style="width: 80px; height: 100px;">
                    </div>
                    <div class="col-lg-4 col-sm-6 col-8">
                      <input type="file" class="form-control-file" name="hisfilegambar" onchange="document.getElementById('hisgambar').src = window.URL.createObjectURL(this.files[0])">
                      <small>File yang diupload di sini akan dijadikan sebagai foto dari data yang ditambahkan..</small>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                      <button type="submit" class="btn btn-primary mt-3 mb-2" name="hisedit" style="width: 100%;">Edit</button>
                      <a type="submit" class="btn btn-secondary" style="width: 100%; color: white;" data-toggle="modal" data-target="#batal-edit" >Batal</a>
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
            <a type="submit" href="data-pustakawan.php?id=<?php echo $id ?>" name="sure-hapus" class="btn btn-danger">Yes</a>
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