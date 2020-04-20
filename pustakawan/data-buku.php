<?php
  require "../proses/koneksi.php";
  require "../proses/today.php";
  require "../proses/count.php";
  $id = $_GET['id'];

  // Data User
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

  // Tampil tabel buku
  if(isset($_GET['kata'])){
    $kata = "%".$_GET['kata']."%";
    $query =  "SELECT * FROM buku, penerbit, kategori WHERE (judul LIKE :kata OR nama LIKE :kata OR penulis LIKE :kata OR kategoriBuku LIKE :kata OR qty LIKE :kata) AND buku.idPenerbit=penerbit.idPenerbit AND buku.idKategori=kategori.idKategori";
    $tampil = $con->prepare($query);
    $tampil->bindParam(':kata', $kata);
    $tampil->execute();
  } else {
    $query_tampil = "SELECT * FROM buku b, penerbit p, kategori k WHERE b.idPenerbit=p.idPenerbit AND b.idKategori=k.idKategori";
    $tampil = $con->prepare($query_tampil);
    $tampil->execute();
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

    <title>Data Buku - Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
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
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-book"></i>&nbsp;Data Buku</a>
            <a class="nav-item nav-link" href="data-siswa.php?id=<?php echo $id ?>"><i class="fas fa-user-friends"></i>&nbsp;Data Siswa</a>
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
                                <a type="submit" class="btn btn-success ml-3" data-toggle="modal" data-target="#tambah-buku" style="color: white;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data Buku</a>
                            </form>
                        </div>
                    </div>
                    <div class="col">
                        <div class="search">
                            <form class="form-inline" action="../proses/search.php?id=<?php echo $id; ?>" method="post">
                                <div class="form-group">
                                  <input type="text" name="cari" class="form-control" placeholder="Search">
                                </div>
                                <button type="submit" name="gocaribuku" class="btn btn-primary ml-3"><i class="fas fa-search"></i></button>
                                <button type="submit" name="allbuku" class="btn btn-primary ml-4" style="color: white;"><i class="far fa-eye"></i>&nbsp;&nbsp;See All</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="a">
                <div class="table-responsive">
                    <table id="tbbuku" class="table table-hover" style="width: 150%;">
                        <thead class="thead-dark">
                          <tr class="text-center">
                            <th scope="col">Id</th>
                            <th scope="col">Image</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">qty</th>
                            <th scope="col">Action</th>
                            <th scope="col" style="width: 60px;">Histori</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while($row = $tampil->fetch(PDO::FETCH_ASSOC)){ ?>
                            <tr>
                              <th class="text-center" scope="row"><?php echo $row['idBuku']; ?></th>
                              <td class="text-center"><a type="submit" style="color: white; width: 50px;" class="btn btn-sm btn-primary" data-toggle="modal"  data-target="#lihat-gambar" data-whatever="<?php echo $row['image']; ?>" data-whatever2="<?php echo $row['sinopsis']; ?>" data-whatever3="<?php echo $row['judul']; ?>" data-whatever4="<?php echo $row['idBuku']; ?>"><i class="far fa-image"></i></a></td>
                              <td><?php echo $row['judul']; ?></td>
                              <td><?php echo $row['nama']; ?></td>
                              <td><?php echo $row['penulis']; ?></td>
                              <td><?php echo $row['kategoriBuku']; ?></td>
                              <td class="text-center"><?php echo $row['qty']; ?></td>
                              <td class="text-center"><a href="edit-buku.php?id=<?php echo $id; ?>&bukid=<?php echo $row['idBuku']; ?>"><i title='Edit selected list' class='far fa-edit' style='color: green;'></i></a>&nbsp; 
                              |
                              &nbsp;<a href="#" data-toggle="modal" data-target="#hapus-buku" data-whatever="<?php echo $row['judul']; ?>" data-whatever2="<?php echo $row['idBuku']; ?>"><i title='Delete selected list' class='fas fa-trash-alt' style='color: red;'></i></a></td>
                              <td class="text-center"><a class="btn btn-sm btn-info" href="histori-buku.php?id=<?php echo $id; ?>&bukid=<?php echo $row['idBuku']; ?>" role="button"><i class="fas fa-history"></i>&nbsp;&nbsp;Lihat</a></td>
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

    <!-- Modal Tambah Buku -->
    <div class="modal fade bd-example-modal-lg" id="tambah-buku" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Buku</h5>
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
                      <input type="text" class="form-control" name="judul" placeholder="Judul buku..." required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <input type="text" class="form-control" name="penulis" placeholder="Penulis buku..." required>
                    </div>
                    <div class="col-6">
                      <input type="number" class="form-control" name="qty" placeholder="Quantity buku..." required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <small>Penerbit Buku</small>
                      <select class="form-control" name="penerbit">
                        <?php
                          $pen_q = $con->prepare("SELECT * FROM penerbit");
                          $pen_q->execute();
                          while($row = $pen_q->fetch(PDO::FETCH_ASSOC)){
                        ?>
                          <option value="<?php echo $row['idPenerbit']; ?>"><?php echo $row['nama']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-6">
                      <small>Kategori Buku</small>
                      <select class="form-control" name="kategori">
                        <?php
                          $kat_q = $con->prepare("SELECT * FROM kategori");
                          $kat_q->execute();
                          while($row = $kat_q->fetch(PDO::FETCH_ASSOC)){
                        ?>
                          <option value="<?php echo $row['idKategori']; ?>"><?php echo $row['kategoriBuku']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="sinopsis" rows="3" placeholder="Sinopsis..."></textarea>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-2 col-sm-6 col-4 text-right">
                     <img id="gambar" style="width: 80px; height: 100px;">
                    </div>
                    <div class="col-lg-4 col-sm-6 col-8">
                      <input type="file" class="form-control-file" name="gambarbuku" onchange="document.getElementById('gambar').src = window.URL.createObjectURL(this.files[0])">
                      <small>File yang diupload di sini akan dijadikan sebagai image dari buku yang ditambahkan..</small>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                      <input type="hidden" name="idygmasukkin" value="<?php echo $id; ?>">
                      <button type="submit" name="addbuku" class="btn btn-primary mt-3 mb-2" style="width: 100%;">Tambah</button>
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
    <!-- Akhir Modal Tambah Buku -->

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapus-buku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <button type="submit" name="sure-hapus-buku" class="btn btn-danger">Yes</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Hapus -->

    <!-- Modal Gambar -->
    <div class="modal fade" id="lihat-gambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="judul"></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="gambartrigger text-center"></div>
            <hr style="margin-bottom: -10px;">
            <div class="sinop text-center" style="padding: 20px; font-size: 14px;">
              <div class="judul-sinopsis" style="font-weight: bold;">Sinopsis</div>
              <div class="sinopsis mt-2" style="line-height: 5px;"></div>
            </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Gambar -->
    
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
    <script>
      $('#lihat-gambar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever')
        var sinopsis = button.data('whatever2')
        var judul = button.data('whatever3')
        var id = button.data('whatever4') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.judul').html("<h5 class='modal-title d-inline' id='exampleModalCenterTitle'>"+judul+"</h5>&nbsp;<small class='d-inline'>("+id+")</small>")
        modal.find('.gambartrigger').html('<img src="../upload/buku/'+recipient+'" width="200px">')
        modal.find('.sinopsis').text(sinopsis)
      })
      $('#hapus-buku').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nama = button.data('whatever')
        var idpus = button.data('whatever2') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.tanya').html('<p>Yakin ingin menghapus data dengan judul ' + nama + ' ?</p>')
        modal.find('.idnya').html('<input type="text" name="idnya" style="display: none;" value="'+idpus+'">')
      })
    </script>
  </body>
</html>