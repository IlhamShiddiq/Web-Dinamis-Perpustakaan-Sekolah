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
    $data = $con->prepare("SELECT * FROM siswa WHERE nis=:nis");
    $data->bindParam(':nis', $nis);
    $data->execute();
    $sis = $data->fetch(PDO::FETCH_ASSOC);
    $kelas = $sis['kelas'];
    $tingkat = $sis['tingkat'];
    $jurusan = $sis['jurusan'];
    $sisnama = $sis['nama'];
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
    <link rel="stylesheet" href="../assets/css/datatables.css">
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
                <div class="a">
                    <a type="submit" class="btn btn-danger" style="width: 100%; color: white;" data-toggle="modal" data-target="#batal">Keluar</a>
                </div>
              </div>
          <div class="col-lg-9">
            <div class="a">
              <form action="../proses/edit.php?id=<?php echo $id ?>&bukid=<?php echo $bukid; ?>" method="post" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <small>NIS</small>
                                <input type="text" class="form-control" readonly placeholder="Penulis buku..." value="<?php echo $nis; ?>">
                            </div>
                            <div class="col-6">
                                <small>Nama Siswa</small>
                                <input type="text" class="form-control" readonly value="<?php echo $sisnama; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <small>Tingkat</small>
                                <input type="text" class="form-control" readonly placeholder="Penulis buku..." value="<?php echo $tingkat; ?>">
                            </div>
                            <div class="col-4">
                                <small>Jurusan</small>
                                <input type="text" class="form-control" readonly placeholder="Quantity buku..." value="<?php echo $jurusan; ?>">
                            </div>
                            <div class="col-4">
                                <small>Kelas</small>
                                <input type="text" class="form-control" readonly placeholder="Quantity buku..." value="<?php echo $kelas; ?>">
                            </div>
                        </div>
                    </div>
                </div>
              </form>
            </div>
            <div class="a judul-act">
                Histori Siswa
            </div>
            <div class="a">
                <div class="table-responsive">
                    <table id="tbbuku" class="table table-hover" style="width: 130%;">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id Buku</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Tanggal Peminjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $data = $con->prepare("SELECT d.idBuku, b.judul, p.nama as penerbit, b.penulis, t.tglPinjam FROM buku b, detailtransaksi d, transaksi t, penerbit p WHERE d.idBuku=b.idBuku AND t.idTransaksi=d.idtransaksi AND b.idPenerbit=p.idPenerbit AND t.nis=:nis");
                                $data->bindParam(':nis', $nis);
                                $data->execute();
                                while($dtbuku = $data->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $dtbuku['idBuku']; ?></td>
                                <td><?php echo $dtbuku['judul']; ?></td>
                                <td><?php echo $dtbuku['penerbit']; ?></td>
                                <td><?php echo $dtbuku['penulis']; ?></td>
                                <td><?php echo $dtbuku['tglPinjam']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
            <p>Yakin ingin keluar ?</p>
          </div>
          <div class="modal-footer">
            <a type="submit" href="data-buku.php?id=<?php echo $id ?>" name="sure-hapus" class="btn btn-danger">Yes</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Keluar -->

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
            <a type="submit" href="data-siswa.php?id=<?php echo $id ?>" class="btn btn-danger">Yes</a>
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
    <script src="../assets/js/datatables.js"></script>
    <script>
      $(document).ready(function() {
          $('#tbbuku').DataTable( {
            "info": true,
          } );
      } );
    </script>
  </body>
</html>