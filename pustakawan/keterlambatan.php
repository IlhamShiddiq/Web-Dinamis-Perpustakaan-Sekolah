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
?><!doctype html>
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
    <link rel="stylesheet" href="../assets/css/datatables.css">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">

    <title>Laporan - Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
  </head>
  <body>

    <?php
      if(isset($_POST['go'])){
        $jur = "jurusan ".$_POST['jurusan'];
        $tk = "tingkat ".$_POST['tingkat'];
        if($jur=="jurusan All"){
          $jur = "semua jurusan";
        }
        if($tk=="tingkat All"){
          $tk = "semua tingkat";
        }
        echo "
          <div class='alert alert-dark alert-dismissible fade show text-center' role='alert' style='position: fixed; opacity: 0.8; border-bottom: 1px solid gray; width: 100%; top: 0; z-index: 5;'>
            Menampilkan data $jur dan $tk..
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          ";
      } else if(isset($_POST['reset'])){
        echo "
          <div class='alert alert-dark alert-dismissible fade show text-center' role='alert' style='position: fixed; opacity: 0.8; border-bottom: 1px solid gray; width: 100%; top: 0; z-index: 5;'>
            Menampilkan semua data..
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          ";
      }
    ?>
    
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
    <img src="../upload/<?php echo $image; ?>" class="foto-pustakawan foto foto-edit" width="55" height="55" >
    <!-- Akhir Navbar -->
    <!-- Navbar2 -->
    <nav class="navbar2 navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link disabled" href="home.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Dashboard</a>
            <a class="nav-item nav-link disabled" href="data-buku.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Data Buku</a>
            <a class="nav-item nav-link disabled" href="data-siswa.php?id=<?php echo $id ?>"><i class="fas fa-user-friends"></i>&nbsp;Data Siswa</a>
            <a class="nav-link disabled nav-item" href="data-pustakawan.php?id=<?php echo $id ?>"><i class="fas fa-user-friends"></i>&nbsp;Data Pustakawan</a>
            <a class="nav-item nav-link disabled" href="penerbit.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Penerbit</a>
            <a class="nav-link disabled nav-item" href="transaksi.php?id=<?php echo $id ?>"><i class="fas fa-exchange-alt"></i>&nbsp;Transaksi</a>
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-clipboard"></i>&nbsp;Laporan</a>
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
                    <img src="../upload/<?php echo $image; ?>" class="foto foto-edit" width="50"  height="50">
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
                  <form action="" method="post">
                    <div class="form-group">
                      <small>Lihat berdasarkan jurusan</small>
                      <select class="form-control" name="jurusan">
                        <option value="All">All</option>
                        <option value="MEKA">MEKA</option>
                        <option value="IOP">IOP</option>
                        <option value="PFPT">PFPT</option>
                        <option value="RPL">RPL</option>
                        <option value="SIJA">SIJA</option>
                        <option value="TEDK">TEDK</option>
                        <option value="TEI">TEI</option>
                        <option value="TOI">TOI</option>
                        <option value="TPTU">TPTU</option>
                      </select>
                    </div>
                    <div class="form-group">
                    <small>Lihat berdasarkan tingkat</small>
                    <select class="form-control" name="tingkat">
                        <option value="All">All</option>  
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                      </select>
                    </div>
                    <div class="form-inline">
                    <button type="submit" class="btn btn-primary" name="go" style="color: white; width: 48%; margin: auto;">Go</button>
                    <button type="submit" class="btn btn-secondary" name="reset" style="color: white; width: 48%; margin: auto;">Reset</button>
                    </div>
                  </form>
                </div>
                <div class="a">
                    <a type="submit" class="btn btn-danger" style="width: 100%; color: white;" data-toggle="modal" data-target="#batal">Keluar</a>
                </div>
              </div>
          <div class="col-lg-9">
            <div class="a">
                <div class="row justify-content-start">
                    <div class="col-12 judul-act">
                        Laporan Keterlambatan
                    </div>
                </div>
            </div>
            <div class="a">
                <div class="table-responsive">
                    <table class="table table-hover" style="width: 160%;" id="tblaporan">
                        <thead class="thead-dark">
                          <tr class="text-center">
                            <th scope="col">Id</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Nama Pustakawan</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Tgl Peminjaman</th>
                            <th scope="col">Keterlambatan</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                              if(isset($_POST['go'])){
                                $jur = $_POST['jurusan'];
                                $tk = $_POST['tingkat'];
                                if($jur != "All" && $tk != "All"){
                                    $tran = $con->prepare("SELECT t.idTransaksi,(TIMESTAMPDIFF(DAY,t.tglPinjam,d.tglDikembalikan))-3 as telat, d.idBuku, d.status, s.nis, s.nama, p.nama as namap, b.judul, t.tglPinjam, s.kelas, s.jurusan, s.tingkat FROM transaksi t, detailTransaksi d, siswa s, pustakawan p, buku b WHERE t.idTransaksi=d.idTransaksi AND t.nis=s.nis AND t.idPustakawan=p.idPustakawan AND d.idBuku=b.idBuku AND d.status=1 AND (d.tglDikembalikan-t.tglPinjam) > 3 AND s.jurusan=:jur AND s.tingkat=:tk");
                                    $tran->bindParam(':jur', $jur);
                                    $tran->bindParam(':tk', $tk);
                                    $tran->execute();
                                } else if($jur == "All" && $tk != "All"){
                                    $tran = $con->prepare("SELECT t.idTransaksi,(TIMESTAMPDIFF(DAY,t.tglPinjam,d.tglDikembalikan))-3 as telat, d.idBuku, d.status, s.nis, s.nama, p.nama as namap, b.judul, t.tglPinjam, s.kelas, s.jurusan, s.tingkat FROM transaksi t, detailTransaksi d, siswa s, pustakawan p, buku b WHERE t.idTransaksi=d.idTransaksi AND t.nis=s.nis AND t.idPustakawan=p.idPustakawan AND d.idBuku=b.idBuku AND d.status=1 AND (d.tglDikembalikan-t.tglPinjam) > 3 AND s.tingkat=:tk");
                                    $tran->bindParam(':tk', $tk);
                                    $tran->execute();
                                } else if($jur != "All" && $tk == "All"){
                                    $tran = $con->prepare("SELECT t.idTransaksi,(TIMESTAMPDIFF(DAY,t.tglPinjam,d.tglDikembalikan))-3 as telat, d.idBuku, d.status, s.nis, s.nama, p.nama as namap, b.judul, t.tglPinjam, s.kelas, s.jurusan, s.tingkat FROM transaksi t, detailTransaksi d, siswa s, pustakawan p, buku b WHERE t.idTransaksi=d.idTransaksi AND t.nis=s.nis AND t.idPustakawan=p.idPustakawan AND d.idBuku=b.idBuku AND d.status=1 AND (d.tglDikembalikan-t.tglPinjam) > 3 AND s.jurusan=:jur");
                                    $tran->bindParam(':jur', $jur);
                                    $tran->execute();
                                } else {
                                    $tran = $con->prepare("SELECT t.idTransaksi,(TIMESTAMPDIFF(DAY,t.tglPinjam,d.tglDikembalikan))-3 as telat, d.idBuku, d.status, s.nis, s.nama, p.nama as namap, b.judul, t.tglPinjam, s.kelas, s.jurusan, s.tingkat FROM transaksi t, detailTransaksi d, siswa s, pustakawan p, buku b WHERE t.idTransaksi=d.idTransaksi AND t.nis=s.nis AND t.idPustakawan=p.idPustakawan AND d.idBuku=b.idBuku AND d.status=1 AND (d.tglDikembalikan-t.tglPinjam) > 3");
                                    $tran->execute();
                                }
                              } else if(isset($_POST['reset'])) {
                                $tran = $con->prepare("SELECT t.idTransaksi,(TIMESTAMPDIFF(DAY,t.tglPinjam,d.tglDikembalikan))-3 as telat, d.idBuku, d.status, s.nis, s.nama, p.nama as namap, b.judul, t.tglPinjam, s.kelas, s.jurusan, s.tingkat FROM transaksi t, detailTransaksi d, siswa s, pustakawan p, buku b WHERE t.idTransaksi=d.idTransaksi AND t.nis=s.nis AND t.idPustakawan=p.idPustakawan AND d.idBuku=b.idBuku AND d.status=1 AND (d.tglDikembalikan-t.tglPinjam) > 3");
                                $tran->execute();
                              } else {
                                $tran = $con->prepare("SELECT t.idTransaksi,(TIMESTAMPDIFF(DAY,t.tglPinjam,d.tglDikembalikan))-3 as telat, d.idBuku, d.status, s.nis, s.nama, p.nama as namap, b.judul, t.tglPinjam, s.kelas, s.jurusan, s.tingkat FROM transaksi t, detailTransaksi d, siswa s, pustakawan p, buku b WHERE t.idTransaksi=d.idTransaksi AND t.nis=s.nis AND t.idPustakawan=p.idPustakawan AND d.idBuku=b.idBuku AND d.status=1 AND (d.tglDikembalikan-t.tglPinjam) > 3");
                                $tran->execute();
                              }
                              while($t = $tran->fetch(PDO::FETCH_ASSOC)){
                          ?>
                          <tr class="text-center">
                            <th scope="row"><?php echo $t['idTransaksi']; ?></th>
                            <td><?php echo $t['nis']; ?></td>
                            <td><?php echo $t['nama']; ?></td>
                            <td><?php echo $t['tingkat']."-".$t['jurusan']."-".$t['kelas']; ?></td>
                            <td><?php echo $t['namap']; ?></td>
                            <td><?php echo $t['judul']; ?></td>
                            <td><?php echo $t['tglPinjam']; ?></td>
                            <td><?php echo $t['telat']." Hari"; ?></td>
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
            <a type="submit" href="laporan.php?id=<?php echo $id ?>" class="btn btn-danger">Yes</a>
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
          $('#tblaporan').DataTable( {
            "info": true,
          } );
      } );
    </script>
  </body>
</html>