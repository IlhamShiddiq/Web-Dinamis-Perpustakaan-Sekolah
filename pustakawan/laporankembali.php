<?php
  require "../proses/koneksi.php";
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
    $idt = $_GET['idt'];
    $nis = $_GET['nis'];
    $namas = $_GET['namas'];
    $jbuku = $_GET['jbuku'];
    $buk = [];
    $buk[0] = $_GET['buku1'];
    $jml=1;
    if($jbuku==2){
        $buk[1] = $_GET['buku2'];
        $jml++;
    }
    // Ambil tanggal pinjam
    $pinjam = $con->prepare("SELECT tglPinjam FROM transaksi WHERE idTransaksi=:idt");
    $pinjam->bindParam(':idt', $idt);
    $pinjam->execute();
    $pinj = $pinjam->fetch(PDO::FETCH_ASSOC);
    $tglpinjam = $pinj['tglPinjam'];
    $today = date('Y-m-d');
    // Ambil Perbedaan Hari
    $diff = $con->prepare("SELECT TIMESTAMPDIFF(DAY, :pin, :kem) AS beda");
    $diff->bindParam(':pin', $tglpinjam);
    $diff->bindParam(':kem', $today);
    $diff->execute();
    $per = $diff->fetch(PDO::FETCH_ASSOC);
    $selisih = $per['beda'];
    if($selisih<=3){
        $ket = " - ";
        $denda = "Rp 0 ";
    } else {
        $selisih = $selisih-3;
        $ket = $selisih." hari";
        $den = $jbuku*$selisih*1000;
        $denda = "Rp ".$den;
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
                Laporan Pengembalian
            </div>
            <div class="a">
              <form action="" method="post">
                <div class="container-fluid">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-12">
                            <small>Id Transaksi</small>
                            <input type="text" class="form-control" value="<?php echo $idt; ?>" readonly required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-6">
                            <small>NIS</small>
                            <input type="text" class="form-control" value="<?php echo $nis; ?>" readonly required>
                        </div>
                        <div class="col-6">
                            <small>Nama Siswa</small>
                            <input type="text" class="form-control" value="<?php echo $namas; ?>" readonly required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <?php for($z=0; $z<$jml; $z++) { ?>
                        <div class="col-6">
                            <small>Kode Buku yang dipinjam</small>
                            <input type="text" class="form-control" value="<?php echo $buk[$z]; ?>" readonly required>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-6">
                            <small>Tanggal Peminjaman</small>
                            <input type="text" class="form-control" value="<?php echo $tglpinjam; ?>" readonly required>
                        </div>
                        <div class="col-6">
                            <small>Tanggal Pengembalian</small>
                            <input type="text" class="form-control" value="<?php echo $today; ?>" readonly required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-6">
                            <small>Keterlambatan</small>
                            <input type="text" class="form-control" value="<?php echo $ket; ?>" readonly required>
                        </div>
                        <div class="col-6">
                            <small>Denda</small>
                            <input type="text" class="form-control" value="<?php echo $denda; ?>" readonly required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="row justify-content-end">
                        <div class="col-4">
                            <a type="submit" class="btn btn-danger mt-3" style="width: 100%; color: white;" data-toggle="modal" data-target="#batal">Keluar</a>
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

    <!-- Modal Keluar -->
    <div class="modal fade" id="batal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please Confirm..</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Yakin ingin keluar ?</p>
          </div>
          <div class="modal-footer">
            <a type="submit" href="transaksi.php?id=<?php echo $id ?>" class="btn btn-danger">Yes</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Keluar -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>