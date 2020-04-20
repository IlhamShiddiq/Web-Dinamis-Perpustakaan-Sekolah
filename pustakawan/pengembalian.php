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
    $idt = $_GET['idt'];
    $buku = [];
    $idbuku = [];
    $i = 0;
    $tran = $con->prepare("SELECT t.idPustakawan, s.nis, d.idBuku, s.nama, p.nama as namap, b.judul, t.tglPinjam FROM transaksi t, detailTransaksi d, siswa s, pustakawan p, buku b WHERE t.idTransaksi=:idt AND t.idTransaksi=d.idTransaksi AND t.nis=s.nis AND t.idPustakawan=p.idPustakawan AND d.idBuku=b.idBuku");
    $tran->bindParam(':idt', $idt);
    $tran->execute();
    $t = $tran->fetch(PDO::FETCH_ASSOC);
        $idp = $t['idPustakawan'];
        $nis = $t['nis'];
        $namas = $t['nama'];
        $namap = $t['namap'];
        

    $buk = $con->prepare("SELECT d.idBuku, b.judul FROM detailtransaksi d, buku b WHERE d.idTransaksi=:idtr AND status=0 AND d.idBuku=b.idBuku");
    $buk->bindParam(':idtr', $idt);
    $buk->execute();    
    $jbuku = $buk->rowCount();
    while($b = $buk->fetch(PDO::FETCH_ASSOC)){
        $idbuku[$i] = $b['idBuku'];
        $buku[$i] = $b['judul'];
        $i++;
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
            <a class="nav-item nav-link disabled" href="#"><i class="fas fa-user-friends"></i>&nbsp;Data Pustakawan</a>
            <a class="nav-item nav-link disabled" href="penerbit.html"><i class="fas fa-book"></i>&nbsp;Penerbit</a>
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-exchange-alt"></i>&nbsp;Transaksi</a>
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
                Pengembalian Buku
            </div>
            <div class="a">
              <form action="../proses/cekidt.php?id=<?php echo $id?>&jbuku=<?php echo $jbuku ?>&idt=<?php echo $idt ?>" method="post">
                <div class="container-fluid">
                  <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <small>Id Pustakawan</small>
                            <input type="text" class="form-control" name="idp" readonly required value="<?php echo $idp; ?>">
                        </div>
                        <div class="col-6">
                            <small>Nama Pustakawan</small>
                            <input type="text" class="form-control" name="namap" readonly required value="<?php echo $namap; ?>">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-6">
                            <small>Nomor Induk Siswa</small>
                            <input type="text" class="form-control" name="nis" readonly required value="<?php echo $nis; ?>">
                        </div>
                        <div class="col-6">
                            <small>Nama Siswa</small>
                            <input type="text" class="form-control" name="namas" readonly required value="<?php echo $namas; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row justify-content-center mt-4" style="background-color: rgb(240, 240, 240); padding: 10px; border-top-right-radius: 10px; border-top-left-radius: 10px;">
                          <div class="col-12 text-center">
                              <p>Buku yang dikembalikan</p>
                          </div>
                            <?php for($a=0; $a<$jbuku; $a++) { ?>

                                <div class="input-group mr-3 ml-3" style="width: 40%;">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text" style="background-color: white; padding-left: 40px; padding-right: 10px;">
                                      <input type="checkbox" class="form-check-input" name="buk[]" value="<?php echo $idbuku[$a]; ?>">
                                    </div>
                                  </div>
                                  <input type="text" style="background-color: white;" class="form-control" id="inlineFormInputGroup" readonly placeholder="<?php echo $buku[$a]; ?>">
                                </div>
                            <?php } ?>
                      </div>
                      <div class="row justify-content-center" style="background-color: rgb(240, 240, 240); padding: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                        <small style="color: gray;">Beri tanda <i>checklist</i> pada checkbox pada buku yang dikembalikan</small>
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <button type="submit" name="pengembalian" class="btn btn-primary mt-3" style="width: 100%;">Submit</button>
                        </div>
                        <div class="col-6">
                            <a type="submit" class="btn btn-secondary mt-3" style="width: 100%; color: white;"  data-toggle="modal" data-target="#batal">Batal</a>
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
            <p>Apakah anda yakin ingin membatalkan ?</p>
          </div>
          <div class="modal-footer">
            <a type="submit" href="transaksi.php?id=<?php echo $id ?>" name="sure-hapus" class="btn btn-danger">Yes</a>
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