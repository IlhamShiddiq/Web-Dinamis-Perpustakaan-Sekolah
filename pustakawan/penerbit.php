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
    <link rel="stylesheet" href="../assets/css/datatables.css">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">

    <title>Manage Penerbit - Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
  </head>
  <body>

  <?php
    if(isset($_GET['success'])){
      if($_GET['success']=="yes"){
        $act = $_GET['act'];
        echo "
          <div class='alert alert-success alert-dismissible fade show text-center' role='alert' style='position: fixed; opacity: 0.8; border-bottom: 1px solid green; width: 100%; top: 0; z-index: 5;'>
            Data berhasil $act...
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          ";
      } else {
        $pesan = $_GET['pesan'];
        echo "
          <div class='alert alert-danger alert-dismissible fade show text-center' role='alert' style='position: fixed; opacity: 0.8; border-bottom: 1px solid red; width: 100%; top: 0; z-index: 5;'>
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
    <nav class="navbar navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../assets/img/brand/logo.png" width="60" class="d-inline-block align-top" alt="">
          <p class="judul-pertama">perpustakaan</p>
          <p class="judul-kedua">smk negeri 1 kota cimahi</p>
        </a>
      </div>
    </nav>
    <img src="../upload/<?php echo $image; ?>" class="foto-pustakawan foto" width="55" height="55" >
    <!-- Akhir Navbar -->
    <!-- Navbar2 -->
    <nav class="navbar2 navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="home.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Dashboard</a>
            <a class="nav-item nav-link" href="data-buku.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Data Buku</a>
            <a class="nav-item nav-link" href="data-siswa.php?id=<?php echo $id ?>"><i class="fas fa-user-friends"></i>&nbsp;Data Siswa</a>
            <a class="nav-link <?php if($hak=="Pustakawan"){echo "disabled";} ?> nav-item" href="data-pustakawan.php?id=<?php echo $id ?>"><i class="fas fa-user-friends"></i>&nbsp;Data Pustakawan</a>
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-book"></i>&nbsp;Penerbit</a>
            <a class="nav-link <?php if($hak=="Admin"){echo "disabled";} ?> nav-item" href="transaksi.php?id=<?php echo $id ?>"><i class="fas fa-exchange-alt"></i>&nbsp;Transaksi</a>
            <a class="nav-item nav-link" href="laporan.php?id=<?php echo $id ?>"><i class="fas fa-clipboard"></i>&nbsp;Laporan</a>
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
                      <img src="../upload/<?php echo $image; ?>" class="foto" width="50"  height="50">
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
            <div class="a">
                <div class="row justify-content-end">
                  <div class="col">
                    <div class="tambah">
                        <form class="form-inline">
                            <a type="submit" class="btn btn-success ml-3" data-toggle="modal" data-target="#tambah-pnb" style="color: white;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data Penerbit</a>
                        </form>
                    </div>
                  </div>
                  <div class="col">
                      <div class="search">
                          <form class="form-inline" action="../proses/search.php?id=<?php echo $id; ?>" method="post">
                              <div class="form-group">
                                <input type="text" name="cari" class="form-control" placeholder="Search">
                              </div>
                              <button type="submit" name="gocaripenerbit" class="btn btn-primary ml-3"><i class="fas fa-search"></i></button>
                              <button type="submit" name="allpenerbit" class="btn btn-primary ml-4" style="color: white;"><i class="far fa-eye"></i>&nbsp;&nbsp;See All</button>
                          </form>
                      </div>
                  </div>
                </div>
            </div>
            <div class="a">
                <div class="table-responsive">
                    <table id="tbpenerbit" class="table table-hover" style="width: 120%;">
                        <thead class="thead-dark">
                          <tr class="text-center">
                            <th scope="col">Id</th>
                            <th scope="col">Nama Penerbit</th>
                            <th scope="col">Alamat Penerbit</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          if(isset($_GET['kata'])){
                            $kata = "%".$_GET['kata']."%";
                            $amb_penerbit = $con->prepare("SELECT * FROM penerbit WHERE nama LIKE :kata OR alamat LIKE :kata OR phone LIKE :kata OR email LIKE :kata");
                            $amb_penerbit->bindParam(':kata', $kata);
                            $amb_penerbit->execute();
                          } else {
                            $amb_penerbit = $con->prepare("SELECT * FROM penerbit");
                            $amb_penerbit->execute();
                          }
                          while($pen = $amb_penerbit->fetch(PDO::FETCH_ASSOC)){
                        ?>
                          <tr>
                            <th class="text-center" scope="row"><?php echo $pen['idPenerbit']; ?></th>
                            <td><?php echo $pen['nama']; ?></td>
                            <td><?php echo $pen['alamat']; ?></td>
                            <td><?php echo $pen['phone']; ?></td>
                            <td><?php echo $pen['email']; ?></td>
                            <td class="text-center">
                              <a href="edit-penerbit.php?id=<?php echo $id; ?>&idpen=<?php echo $pen['idPenerbit']; ?>"><i title='Edit selected list' class='far fa-edit' style='color: green;'></i></a>&nbsp; 
                              |
                              &nbsp;<a href="#" data-toggle="modal" data-target="#hapus-penerbit" data-whatever="<?php echo $pen['nama']; ?>" data-whatever2="<?php echo $pen['idPenerbit']; ?>"><i title='Delete selected list' class='fas fa-trash-alt' style='color: red;'></i></a>
                            </td>
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

    <!-- Modal Tambah Penerbit -->
    <div class="modal fade bd-example-modal-lg" id="tambah-pnb" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Buku</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../proses/tambahData.php?id=<?php echo $id; ?>" method="post">
              <div class="container-fluid">
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <input type="text" class="form-control" name="namapen" placeholder="Nama Penerbit..." required>
                    </div>
                    <div class="col-6">
                      <input type="text" class="form-control" name="alamatpen" placeholder="Alamat Penerbit..." required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <input type="email" class="form-control" name="emailpen" placeholder="Email Penerbit..." required>
                    </div>
                    <div class="col-6">
                      <input type="tel" class="form-control" name="phonepen" placeholder="Nomor Telepon..." required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-6">
                      <button type="submit" name="addpen" class="btn btn-primary mt-3" style="width: 100%;">Tambah</button>
                    </div>
                    <div class="col-6">
                      <a type="submit" class="btn btn-secondary mt-3" style="width: 100%; color: white;" data-dismiss="modal">Batal</a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Tambah Penerbit -->

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapus-penerbit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please Confirm..</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="tanya"></div>
          </div>
          <div class="modal-footer">
            <form action="../proses/hapusData.php" method="post">
              <div class="idnya"></div>
              <input type="hidden" name="idlama" value="<?php echo $id; ?>">
              <button type="submit" name="hapuspenerbit" class="btn btn-danger">Yes</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Hapus -->

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
    <script>
      $(document).ready(function() {
          $('#tbpenerbit').DataTable( {
            "info": true,
          } );
      } );
    </script>
    <script>
      $('#hapus-penerbit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nama = button.data('whatever')
        var idpus = button.data('whatever2') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.tanya').html('<p>Yakin ingin menghapus data dengan nama ' + nama + ' ?</p>')
        modal.find('.idnya').html('<input type="text" name="idnya" style="display: none;" value="'+idpus+'">')
      })
    </script>
  </body>
</html>