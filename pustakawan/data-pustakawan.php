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

    <title>Data Pustakawan - Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
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
    <img src="../upload/<?php echo $image; ?>" class="foto-pustakawan foto" width="55"  height="55" >
    <!-- Akhir Navbar -->
    <!-- Navbar2 -->
    <nav class="navbar2 navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="home.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Dashboard</a>
            <a class="nav-item nav-link" href="data-buku.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Data Buku</a>
            <a class="nav-item nav-link" href="data-siswa.php?id=<?php echo $id ?>"><i class="fas fa-user-friends"></i>&nbsp;Data Siswa</a>
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-user-friends"></i>&nbsp;Data Pustakawan</a>
            <a class="nav-item nav-link" href="penerbit.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Penerbit</a>
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
                                <a type="submit" class="btn btn-success ml-3" data-toggle="modal" data-target="#tambah-pust" style="color: white;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data Pustakawan</a>
                            </form>
                        </div>
                    </div>
                    <div class="col">
                        <div class="search">
                            <form class="form-inline" action="../proses/search.php?id=<?php echo $id; ?>" method="post">
                                <div class="form-group">
                                  <input type="text" name="cari" class="form-control" placeholder="Search">
                                </div>
                                <button type="submit" name="gocaripust" class="btn btn-primary ml-3"><i class="fas fa-search"></i></button>
                                <button type="submit" name="allpust" class="btn btn-primary ml-4" style="color: white;"><i class="far fa-eye"></i>&nbsp;&nbsp;See All</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="a">
                <div class="table-responsive">
                    <table id="tbpustakawan" class="table table-hover" style="width: 180%;">
                        <thead class="thead-dark">
                          <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">Hak User</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if(isset($_GET['kata'])){
                              $kata = "%".$_GET['kata']."%";
                              $query =  "SELECT * FROM login l, pustakawan p WHERE l.idPustakawan=p.idPustakawan AND (p.nama LIKE :kata OR p.alamat LIKE :kata OR p.phone LIKE :kata OR p.email LIKE :kata OR l.username LIKE :kata OR l.password LIKE :kata OR l.hakUser LIKE :kata)";
                              $dftr_pust = $con->prepare($query);
                              $dftr_pust->bindParam(':kata', $kata);
                              $dftr_pust->execute();
                            } else {
                              $query = "SELECT * FROM login l, pustakawan p WHERE l.idPustakawan=p.idPustakawan";
                              $dftr_pust = $con->prepare($query);
                              $dftr_pust->execute();
                            }
                            while($row = $dftr_pust->fetch(PDO::FETCH_ASSOC)){
                          ?>
                          <tr>
                            <th class="text-center" scope="row"><?php echo $row['idPustakawan']; ?></th>
                            <td>
                                <button type="button" style="width: 50px;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#lihat-gambarpust" data-whatever="<?php echo $row['image']; ?>" data-whatever2="<?php echo $row['nama']; ?>" data-whatever3="<?php echo $row['idPustakawan']; ?>"><i class="far fa-image"></i></button>
                            </td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['hakUser']; ?></td>
                            <td class="text-center aksi"><a href="edit-pustakawan.php?id=<?php echo $id; ?>&hisid=<?php echo $row['idPustakawan'];?>" class="editpustakawan nav-link <?php if($row['idPustakawan']==$id){echo "disabled text-gray";} ?>"><i title='Edit selected list' class='far fa-edit' ></i></a>&nbsp;
                            | 
                            &nbsp;<a href="#" class="hapuspustakawan nav-link <?php if($row['idPustakawan']==$id){echo "disabled";} ?>" data-toggle="modal" data-target="#hapus-data" data-whatever="<?php echo $row['nama']; ?>" data-whatever2="<?php echo $row['idPustakawan']; ?>"><i title='Delete selected list' class='fas fa-trash-alt'></i></a></td>
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

    <!-- Modal Tambah Pustakawan -->
    <div class="modal fade bd-example-modal-lg" id="tambah-pust" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Pustakawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../proses/tambahData.php" method="post" enctype="multipart/form-data">
              <div class="container-fluid">
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <input type="text" class="form-control" name="nama" autocomplete="off" placeholder="Nama lengkap..." required>
                    </div>
                    <div class="col-6">
                      <input type="text" class="form-control" name="alamat" autocomplete="off" placeholder="Alamat..." required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Email..." required>
                    </div>
                    <div class="col-6">
                      <input type="tel" class="form-control" name="phone" autocomplete="off" placeholder="Nomor Telepon..." required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username..." required>
                    </div>
                    <div class="col-6">
                      <input type="password" class="form-control" name="password" placeholder="Password..." required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-12">
                      <small>Hak Akses</small>
                      <select class="form-control" name="hak">
                        <option value="Admin">Admin</option>
                        <option value="Pustakawan">Pustakawan</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-2 col-sm-6 col-4 text-right">
                      <img id="gambar" style="width: 80px; height: 100px;">
                    </div>
                    <div class="col-lg-4 col-sm-6 col-8">
                      <input type="file" class="form-control-file" name="filegambar" onchange="document.getElementById('gambar').src = window.URL.createObjectURL(this.files[0])">
                      <small>File yang diupload di sini akan dijadikan sebagai foto dari data yang ditambahkan..</small>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                      <input type="hidden" name="idygmasukkin" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-primary mt-3 mb-2" style="width: 100%;" name="addpust">Tambah</button>
                      <button type="submit" class="btn btn-secondary" style="width: 100%;" data-dismiss="modal">Batal</button>
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
    <!-- Akhir Modal Tambah Pustakawan -->

    <!-- Modal Gambar -->
    <div class="modal fade" id="lihat-gambarpust" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0.9);">
          <div class="modal-header">
            <div class="nama"></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="gambartrigger text-center"></div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Gambar -->

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapus-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <button type="submit" name="sure-hapus" class="btn btn-danger">Yes</button>
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
          $('#tbpustakawan').DataTable( {
            "info": true,
          } );
      } );
    </script>
    <script>
      $('#lihat-gambarpust').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever')
        var nama = button.data('whatever2')
        var id = button.data('whatever3') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.nama').html("<h5 class='modal-title d-inline' id='exampleModalCenterTitle'>"+nama+"</h5>&nbsp;<small class='d-inline'>("+id+")</small>")
        modal.find('.gambartrigger').html('<img src="../upload/'+recipient+'" width="250px">')
      })
      $('#hapus-data').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nama = button.data('whatever')
        var idpus = button.data('whatever2') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.tanya').html('<p>Yakin ingin menghapus data atas nama ' + nama + ' ?</p>')
        modal.find('.idnya').html('<input type="text" name="idnya" style="display: none;" value="'+idpus+'">')
      })
      $('#edit-pust').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.id').html('<input type="text" name="id" style="display: none;" value="'+id+'">')
      })
    </script>
  </body>
</html>