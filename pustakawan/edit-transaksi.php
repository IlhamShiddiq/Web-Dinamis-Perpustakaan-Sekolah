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
    $jbuku = $_GET['jbuku'];
    $idt = $_GET['idt'];
    $tamptr = $con->prepare("SELECT * FROM transaksi t, detailtransaksi d WHERE d.idTransaksi=t.idTransaksi AND t.idTransaksi=:idt");
    $tamptr->bindParam(':idt', $idt);
    $tamptr->execute();
    if($jbuku==1){
        while($row=$tamptr->fetch(PDO::FETCH_ASSOC)){
            $nis = $row['nis'];
            $idbuku = $row['idBuku'];
            $peminjaman = $row['tglPinjam'];

            $jud = $con->prepare("SELECT judul FROM buku WHERE idBuku=:idb");
            $jud->bindParam(':idb', $idbuku);
            $jud->execute();
            $judul = $jud->fetch(PDO::FETCH_ASSOC);
        }
    } else {
        $idbuku = [];
        $i = 0;
        while($row=$tamptr->fetch(PDO::FETCH_ASSOC)){
            $nis = $row['nis'];
            $idbuku[$i] = $row['idBuku'];
            $peminjaman = $row['tglPinjam'];
            $i++;
        }
        // Buku ke 1
        $jud = $con->prepare("SELECT judul FROM buku WHERE idBuku=:idb");
        $jud->bindParam(':idb', $idbuku[0]);
        $jud->execute();
        $judul = $jud->fetch(PDO::FETCH_ASSOC);
        // Buku ke 2
        $jud2 = $con->prepare("SELECT judul FROM buku WHERE idBuku=:idb2");
        $jud2->bindParam(':idb2', $idbuku[1]);
        $jud2->execute();
        $judul2 = $jud2->fetch(PDO::FETCH_ASSOC);
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
                Edit Transaksi
            </div>
            <div class="a">
            <form action="../proses/edit.php?id=<?php echo $id; ?>&jbuku=<?php echo $jbuku?>&idt=<?php echo $idt; ?>" method="post">
                <div class="container-fluid">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-6">
                            <small>ID Pustakawan</small>
                            <input type="text" class="form-control" readonly name="idp" placeholder="Id Pustakawan..." required value="<?php echo $id; ?>">
                        </div>
                        <div class="col-6">
                            <small>ID Transaksi</small>
                            <input type="text" class="form-control" readonly name="idt" placeholder="Id Transaksi..." required value="<?php echo $idt; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                        <small>Nomor Induk Siswa</small>
                        <input type="text" class="form-control" readonly name="nis" placeholder="NIS..." required value="<?php echo $nis; ?>">
                        </div>
                        <div class="col-6">
                        <small>Tanggal Peminjaman</small>
                        <input type="text" class="form-control" readonly name="peminjaman" placeholder="Tanggal Peminjaman..." required value="<?php echo $peminjaman; ?>">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <?php
                                if($jbuku==1){ ?>

                                    <div class="col-5">
                                        <small>Kode Buku</small>
                                        <input type="text" class="form-control" name="kbuku1" id="kode1" placeholder="Kode Buku..." required value="<?php echo $idbuku; ?>">
                                    </div>
                                    <div class="col-1">
                                      <button type="button" onclick="loadbuku();" class="btn btn-primary mt-4"><i class="fas fa-search"></i></button>
                                    </div>
                                    <div class="col-6">
                                      <small>Judul Buku</small>
                                      <input type="text" class="form-control" id="judul1" readonly value="<?php echo $judul['judul']; ?>">
                                    </div>

                                    <?php
                                } else {
                                  // Periksa Buku 1
                                  $ro = $con->prepare("SELECT status FROM detailTransaksi WHERE idTransaksi=:idt AND idBuku=:idb");
                                  $ro->bindParam(':idt', $idt);
                                  $ro->bindParam(':idb', $idbuku[0]);
                                  $ro->execute();
                                  $ros = $ro->fetch(PDO::FETCH_ASSOC);

                                  // Periksa Buku 2
                                  $ro2 = $con->prepare("SELECT status FROM detailTransaksi WHERE idTransaksi=:idt2 AND idBuku=:idb2");
                                  $ro2->bindParam(':idt2', $idt);
                                  $ro2->bindParam(':idb2', $idbuku[1]);
                                  $ro2->execute();
                                  $ros2 = $ro2->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="col-5">
                                        <small>Kode Buku</small>
                                        <input type="text" class="form-control" <?php if($ros['status']=='1'){echo "readonly";} ?> name="kbuku1" id="kode1" placeholder="Kode Buku..." required value="<?php echo $idbuku[0]; ?>">
                                    </div>
                                    <div class="col-1">
                                      <button type="button" onclick="loadbuku();" class="btn btn-primary mt-4"><i class="fas fa-search"></i></button>
                                    </div>
                                    <div class="col-6">
                                      <small>Judul Buku</small>
                                      <input type="text" class="form-control" id="judul1" readonly value="<?php echo $judul['judul']; ?>">
                                    </div>
                                    <div class="col-5">
                                        <small>Kode Buku</small>
                                        <input type="text" class="form-control" <?php if($ros2['status']=='1'){echo "readonly";} ?> name="kbuku2" id="kode2" placeholder="Kode Buku..." required value="<?php echo $idbuku[1]; ?>">
                                    </div>
                                    <div class="col-1">
                                      <button type="button" onclick="loadbuku2();" class="btn btn-primary mt-4"><i class="fas fa-search"></i></button>
                                    </div>
                                    <div class="col-6">
                                      <small>Judul Buku</small>
                                      <input type="text" class="form-control" id="judul2" readonly value="<?php echo $judul2['judul']; ?>">
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-6">
                            <input type="hidden" name="idygmasukkin" value="<?php echo $id; ?>">
                            <button type="submit" name="edittran" class="btn btn-primary mt-3" style="width: 100%;">Tambah</button>
                        </div>
                        <div class="col-6">
                            <a type="submit" class="btn btn-secondary mt-3" style="width: 100%; color: white;" data-toggle="modal" data-target="#batal-edit">Batal</a>
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
            <a type="submit" style="color: white;" href="transaksi.php?id=<?php echo $id ?>" name="sure-hapus" class="btn btn-danger">Yes</a>
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
    <!-- Load Buku 1 -->
    <script>
      function loadbuku(){
        var kode = document.getElementById('kode1').value;
        if(kode!=""){
          $.ajax({
            type: 'post',
            data: {
              kode:kode,
            },
            url: '../proses/loadbuku.php',
            
            success: function(response){
              document.getElementById('judul1').value = response;
            }
          });
        }
      }
    </script>
    <!-- Load Buku 2 -->
    <script>
      function loadbuku2(){
        var kode = document.getElementById('kode2').value;
        if(kode!=""){
          $.ajax({
            type: 'post',
            data: {
              kode:kode,
            },
            url: '../proses/loadbuku.php',
            
            success: function(response){
              document.getElementById('judul2').value = response;
            }
          });
        }
      }
    </script>
  </body>
</html>