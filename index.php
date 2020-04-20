<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- More CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/font.css">
    <link rel="stylesheet" href="assets/css/all.min.css">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

    <title>Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
  </head>
  <body>

    <?php
    if(isset($_GET['login'])){
      if($_GET['login']=="fail"){
        $pesan = $_GET['pesan'];
        echo "
          <div class='alert alert-danger alert-dismissible fade show text-center' role='alert' style='position: fixed; opacity: 0.8; border-bottom: 1px solid red; width: 100%; top: 0; z-index: 20;'>
            $pesan
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          ";
      }
    }
  ?>
    
    <!-- Navbar -->
    <nav class="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="assets/img/brand/logo.png" width="60" class="d-inline-block align-top" alt="">
          <p class="judul-pertama">perpustakaan</p>
          <p class="judul-kedua">smk negeri 1 kota cimahi</p>
        </a>
      </div>
    </nav>
    <div class="tombol tombol-nav">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-login">Pustakawan</button>
      <a href="siswa/data-buku-student.php" type="button" class="btn btn-primary">Siswa</a>
    </div>
    <!-- Akhir Navbar -->

    <!-- Gambar Perpus -->
    <div class="gambar-perpus">
      <div class="welcome">
        <div class="welcome-to text-center">
          <div class="wrap-welcome-to">
            <h1>perpustakaan smkn 1 cimahi</h1>
          </div>
          <div class="wrap-welcome-to">
            <h2>selamat datang</h2>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <div class="footer text-center">
        <p>Copyright 2020 &copy; Perpustakaan SMK Negeri 1 Kota Cimahi</p>
      </div>
      <!-- Akhir Footer -->
    </div>
    <!-- Akhir Gambar Perpus -->

    <!-- Modal Login -->
    <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-login" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-login-judul">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <form action="proses/login.php" method="post">
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                  </div>
                  <input type="text" autocomplete="off" name="username" required class="form-control" id="inlineFormInputGroup" placeholder="Masukkan Username">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-unlock-alt"></i></div>
                  </div>
                  <input type="password" autocomplete="off" name="password" required class="form-control" id="inlineFormInputGroup" placeholder="Masukkan Password">
                </div>
              </div>
              <div class="form-group tombol">
                <button type="submit" name="login" class="btn btn-primary mb-2">Login Sekarang</button>
              </div>
            </form>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
    <!-- Modal Login -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/all.min.js"></script>
  </body>
</html>