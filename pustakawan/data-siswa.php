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

    <title>Data Siswa - Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
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
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-user-friends"></i>&nbsp;Data Siswa</a>
            <a class="nav-link <?php if($hak=="Pustakawan"){echo "disabled";} ?> nav-item" href="data-pustakawan.php?id=<?php echo $id ?>"><i class="fas fa-user-friends"></i>&nbsp;Data Pustakawan</a>
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
                                <a type="submit" class="btn btn-success ml-3" data-toggle="modal" data-target="#tambah-sis" style="color: white;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data Siswa</a>
                            </form>
                        </div>
                    </div>
                    <div class="col">
                        <div class="search">
                            <form class="form-inline" action="../proses/search.php?id=<?php echo $id; ?>" method="post">
                                <div class="form-group">
                                  <input type="text" name="cari" class="form-control" placeholder="Search">
                                </div>
                                <button type="submit" name="gocarisiswa" class="btn btn-primary ml-3"><i class="fas fa-search"></i></button>
                                <button type="submit" name="allsiswa" class="btn btn-primary ml-4" style="color: white;"><i class="far fa-eye"></i>&nbsp;&nbsp;See All</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="a">
                <div class="table-responsive">
                    <table id="tbsiswa" class="table table-hover" style="width: 160%;">
                        <thead class="thead-dark">
                          <tr class="text-center">
                            <th scope="col">NIS</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                            <th scope="col">Histori</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if(isset($_GET['kata'])){
                              $kata = "%".$_GET['kata']."%";
                              $siswa = $con->prepare("SELECT * FROM siswa WHERE nis LIKE :kata  OR nama LIKE :kata OR jurusan LIKE :kata OR tingkat LIKE :kata OR kelas LIKE :kata OR phone LIKE :kata OR email LIKE :kata ORDER BY nis");
                              $siswa->bindParam(':kata', $kata);
                              $siswa->execute();
                            } else {
                              $siswa = $con->prepare("SELECT * FROM siswa ORDER BY nis");
                              $siswa->execute();
                            }
                            while($row = $siswa->fetch(PDO::FETCH_ASSOC)){
                          ?>
                          <tr>
                            <th class="text-center" scope="row"><?php echo $row['nis']; ?></th>
                            <td class="text-center">
                            <button type="button" style=" width: 50px;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#lihat-sis" data-whatever="<?php echo $row['image']; ?>" data-whatever2="<?php echo $row['nama']; ?>" data-whatever3="<?php echo $row['nis']; ?>"><i class="far fa-image"></i></button>
                            </td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['tingkat']."-".$row['jurusan']."-".$row['kelas']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td class="text-center">
                            <a href="edit-siswa.php?id=<?php echo $id; ?>&nis=<?php echo $row['nis']; ?>"><i title='Edit selected list' class='far fa-edit' style='color: green;'></i></a>&nbsp;
                            | 
                            &nbsp;<a href="#" data-toggle="modal" data-target="#hapus-data" data-whatever="<?php echo $row['nama']; ?>" data-whatever2="<?php echo $row['nis']; ?>"><i title='Delete selected list' class='fas fa-trash-alt' style='color: red;'></i></a>
                            </td>
                            <td class="text-center"><a class="btn btn-sm btn-info" href="histori-siswa.php?id=<?php echo $id; ?>&nis=<?php echo $row['nis']; ?>" role="button"><i class="fas fa-history"></i>&nbsp;&nbsp;Lihat</a></td>
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

    <!-- Modal Tambah Siswa -->
    <div class="modal fade bd-example-modal-lg" id="tambah-sis" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../proses/tambahData.php" method="post" enctype="multipart/form-data">
              <div class="container-fluid">
                <div class="form-group">
                  <div class="row">
                    <div class="col-12">
                      <input type="text" class="form-control" name="nis" autocomplete="off" placeholder="NIS..." required>
                    </div>
                  </div>
                </div>
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
                      <input type="telp" class="form-control" name="phone" autocomplete="off" placeholder="Nomor Telepon..." required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-4">
                      <small>Tingkat</small>
                      <select class="form-control" name="tingkat">
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                      </select>
                    </div>
                    <div class="col-4">
                      <small>Jurusan</small>
                      <select class="form-control" name="jurusan">
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
                    <div class="col-4">
                      <small>Kelas</small>
                      <select class="form-control" name="kelas">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
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
                      <input type="file" class="form-control-file" name="fotosiswa" onchange="document.getElementById('gambar').src = window.URL.createObjectURL(this.files[0])">
                      <small>File yang diupload di sini akan dijadikan sebagai foto dari data yang ditambahkan..</small>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                      <input type="hidden" name="idygmasukkin" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-primary mt-3 mb-2" style="width: 100%;" name="addsis">Tambah</button>
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
    <!-- Akhir Modal Tambah Siswa -->

    <!-- Modal Gambar -->
    <div class="modal fade" id="lihat-sis" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
              <button type="submit" name="sishapus" class="btn btn-danger">Yes</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Hapus -->

    <!-- Modal Cek NIS -->
    <div class="modal fade" id="ceknis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please Input..</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-right">
            <form action="../proses/ceknis.php?id=<?php echo $id; ?>" method="post">
                <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS" required>
                <button type="submit" name="ceknis" class="btn btn-primary mt-3">Submit</button>
                <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Batal</button>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Cek NIS -->


    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
    <script>
      $(document).ready(function() {
          $('#tbsiswa').DataTable( {
            "info": true,
          } );
      } );
    </script>
    <script>
      $('#lihat-sis').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever')
        var name = button.data('whatever2')
        var nis = button.data('whatever3') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.nama').html("<h5 class='modal-title nama d-inline' id='exampleModalCenterTitle'>"+name+"</h5>&nbsp;<small class='d-inline'>("+nis+")</small>")
        modal.find('.gambartrigger').html('<img src="../upload/siswa/'+recipient+'" width="250px">')
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
    </script>
  </body>
</html>