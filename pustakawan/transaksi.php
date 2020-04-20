<?php
  require "../proses/koneksi.php";
  $status=0;
  if(isset($_GET['status'])){
    $status=$_GET['status'];
  }
  $id = $_GET['id'];
  $query = "SELECT * FROM pustakawan, login WHERE pustakawan.idPustakawan=:id AND pustakawan.idPustakawan=login.idPustakawan";
  $result = $con->prepare($query);
  $result->bindParam(':id', $id);
  $result->execute();
  $today = date('Y-m-d');
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

    <title>Transaksi - Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
  </head>
  <body>

  <?php
    if(isset($_GET['nis'])){
      if($_GET['nis']=="unrecognized"){
        $act = "Maaf, NIS yang anda masukkan tidak tersedia...";
        echo "
          <div class='alert alert-danger alert-dismissible fade show text-center' role='alert' style='position: absolute; width: 100%; top: 0; z-index: 5;'>
            $act
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          ";
      }
    }
  ?>
  <?php
    if(isset($_GET['error'])){
      if($_GET['error']=="yes"){
        $e = $_GET['pesan'];
        echo "
          <div class='alert alert-danger alert-dismissible fade show text-center' role='alert' style='position: fixed; opacity: 0.8; border-bottom: 1px solid red; width: 100%; top: 0; z-index: 5;'>
            $e
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          ";
      } else {
        $act = $_GET['act'];
        echo "
          <div class='alert alert-success alert-dismissible fade show text-center' role='alert' style='position: fixed; opacity: 0.8; border-bottom: 1px solid green; width: 100%; top: 0; z-index: 5;'>
            Data transaksi berhasil $act...
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
            <a class="nav-item nav-link" href="penerbit.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Penerbit</a>
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-exchange-alt"></i>&nbsp;Transaksi</a>
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
                <div class="a">
                  <form action="../proses/viewby.php?id=<?php echo $id; ?>" method="post">
                    <div class="form-group">
                      <small>View by</small>
                      <select class="form-control mb-2" name="status">
                        <option <?php if($status==0){echo "selected";} ?> value="0">Belum dikembalikan</option>
                        <option <?php if($status==1){echo "selected";} ?> value="1">Sudah dikembalikan</option>
                      </select>
                    </div>
                    <div class="form-inline">
                      <button type="submit" class="btn btn-primary btn-sm" name="go" style="color: white; width: 40%; margin: auto;">Go</button>
                      <button type="submit" class="btn btn-secondary btn-sm" name="reset" style="color: white; width: 40%; margin: auto;">Reset</button>
                    </div>
                  </form>
                </div>
              </div>
          <div class="col-lg-9">
            <div class="a">
                <div class="row justify-content-end">
                    <div class="col">
                      <div class="tambah">
                          <form class="form-inline">
                              <a type="submit" class="btn btn-success ml-3" data-toggle="modal" data-target="#ceknis" style="color: white;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Transaksi</a>
                          </form>
                      </div>
                    </div>
                    <div class="col">
                        <div class="search">
                            <form class="form-inline" action="../proses/search.php?id=<?php echo $id; ?>&status=<?php echo $status; ?>" method="post">
                                <div class="form-group">
                                  <input type="text" name="cari" class="form-control" placeholder="Search by id or name">
                                </div>
                                <button type="submit" name="gocaritransaksi" class="btn btn-primary ml-3"><i class="fas fa-search"></i></button>
                                <button type="submit" name="alltransaksi" class="btn btn-primary ml-4" style="color: white;"><i class="far fa-eye"></i>&nbsp;&nbsp;See All</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="a">
                <div class="table-responsive">
                    <table class="table table-hover" id="tbtransaksi" style="width: 160%;">
                        <thead class="thead-dark">
                          <tr class="text-center">
                            <th scope="col">Id</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Nama Pustakawan</th>
                            <th scope="col">Jumlah buku</th>
                            <th scope="col">Tgl Peminjaman</th>
                            <th scope="col">Action</th>
                            <th scope="col">More</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                              if(isset($_GET['kata'])){
                                $kata = "%".$_GET['kata']."%";
                                $tran = $con->prepare("SELECT TIMESTAMPDIFF(DAY, t.tglPinjam, :today) as hari, t.idTransaksi, d.status, s.nis, s.nama, p.nama as namap, b.judul, t.tglPinjam FROM transaksi t, detailTransaksi d, siswa s, pustakawan p, buku b WHERE t.idTransaksi=d.idTransaksi AND t.nis=s.nis AND t.idPustakawan=p.idPustakawan AND d.idBuku=b.idBuku AND (t.idTransaksi LIKE :kata OR s.nama LIKE :kata) AND d.status=:stat GROUP BY t.idTransaksi");
                                $tran->bindParam(':today', $today);
                                $tran->bindParam(':kata', $kata);
                                $tran->bindParam(':stat', $status);
                                $tran->execute();
                              } else {
                                $tran = $con->prepare("SELECT t.idTransaksi, d.status, s.nis, s.nama, p.nama as namap, b.judul, t.tglPinjam FROM transaksi t, detailTransaksi d, siswa s, pustakawan p, buku b WHERE t.idTransaksi=d.idTransaksi AND t.nis=s.nis AND t.idPustakawan=p.idPustakawan AND d.idBuku=b.idBuku AND d.status=:stat GROUP BY t.idTransaksi");
                                $tran->bindParam(':stat', $status);
                                $tran->execute();
                              }
                              while($t = $tran->fetch(PDO::FETCH_ASSOC)){
                                $jb = $con->prepare("SELECT * FROM detailtransaksi WHERE idTransaksi=:idtr AND status='0'");
                                $jb->bindParam(':idtr', $t['idTransaksi']);
                                $jb->execute();
                                $tjb = $jb->rowCount();
                          ?>
                          <tr>
                            <th scope="row"><?php echo $t['idTransaksi']; ?></th>
                            <td><?php echo $t['nis']?></td>
                            <td><?php echo $t['nama']; ?></td>
                            <td><?php echo $t['namap']; ?></td>
                            <td class="text-center"><?php if($tjb==0){echo "Sudah dikembalikan";}else{echo $tjb." buku";} ?></td>
                            <td><?php echo $t['tglPinjam']; ?></td>
                            <?php 
                              $hitung = $con->prepare("SELECT * FROM detailtransaksi WHERE idTransaksi=:idtr");
                              $hitung->bindParam(':idtr', $t['idTransaksi']);
                              $hitung->execute();
                              $jbuku = $hitung->rowCount();
                            ?>
                            <td class="aksi text-center">
                              <a class="nav-link editpustakawan <?php if($status==1){echo "disabled";} ?>" href="edit-transaksi.php?id=<?php echo $id; ?>&jbuku=<?php echo $jbuku; ?>&idt=<?php echo $t['idTransaksi']; ?>"><i title='Edit selected list' class='far fa-edit' ></i></a>&nbsp; 
                              |
                              &nbsp;<a class="nav-link hapuspustakawan" href="#" data-toggle="modal" data-target="#hapus" data-whatever="<?php echo $t['nama']; ?>" data-whatever2="<?php echo $t['idTransaksi']; ?>" data-whatever3="<?php echo $t['idBuku']; ?>"><i title='Delete selected list' class='fas fa-trash-alt'></i></a>
                            </td>
                            <td>
                              <a class="btn btn-sm btn-ungu <?php if($status==1){echo "disabled";} ?>" href="pengembalian.php?id=<?php echo $id; ?>&idt=<?php echo $t['idTransaksi']; ?>" role="button"><i class="fas fa-exchange-alt"></i>&nbsp;&nbsp;Pengembalian</a>
                              <a class="btn btn-sm btn-info <?php if($status==1){echo "disabled";} ?>" data-toggle="modal" data-target="#detail" data-id="<?php echo $t['idTransaksi']; ?>" style="color: white;"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Info</a>
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

    <!-- Modal Cek NIS -->
    <div class="modal fade bd-example-modal-lg" id="ceknis" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Transaksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../proses/ceknis.php?id=<?php echo $id; ?>" method="post">
              <div class="container-fluid">
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-6">
                      <small>Id Pustakawan</small>
                      <input type="text" class="form-control" name="idp" readonly value="<?php echo $id; ?>">
                    </div>
                    <div class="col-6">
                      <small>Nama Pustakawan</small>
                      <input type="text" class="form-control" name="namap" readonly value="<?php echo $nama; ?>">
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-6">
                      <small>Tgl Peminjaman (today)</small>
                      <input type="text" class="form-control" name="tglpinjam" readonly value="<?php echo $today; ?>">
                    </div>
                    <div class="col-5">
                      <small>NIS</small>
                      <input type="text" class="form-control" name="nis" id="niss" required placeholder="Masukkan NIS..">
                    </div>
                    <div class="col-1">
                      <button type="button" onclick="loadnis();" class="btn btn-primary mt-4"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                      <small>Nama Siswa</small>
                      <input type="text" class="form-control" id="namas" readonly placeholder="Nama Siswa">
                    </div>
                    <div class="col-6">
                      <small>Kelas</small>
                      <input type="text" class="form-control" id="kelass" readonly placeholder="Kelas">
                    </div>
                </div>
                <div class="row justify-content-center mt-4 mb-2" style="background-color: rgb(240, 240, 240); PADDING: 10PX;">
                    <div class="col-12 text-center">
                      <small>Jumlah buku yang dipinjam</small>
                      <div class="form-check">
                        <input class="form-check-input mt-2" type="radio" name="jbuku" id="exampleRadios1" value="1" checked>
                        <small class="form-check-label mr-3" for="exampleRadios1">
                          1 Buku
                        </small>
                        <input class="form-check-input ml-2 mt-2" type="radio" name="jbuku" id="exampleRadios1" value="2">
                        <small class="form-check-label ml-4" for="exampleRadios1">
                          2 Buku
                        </small>
                      </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-5">
                      <small>Id Buku</small>
                      <input type="text" class="form-control" name="kbuku1" id="kode1" required placeholder="Id Buku..">
                    </div>
                    <div class="col-1">
                      <button type="button" onclick="loadbuku();" class="btn btn-primary mt-4"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="col-6">
                      <small>Judul Buku</small>
                      <input type="text" class="form-control" id="judul1" readonly placeholder="Judul Buku..">
                    </div>
                </div>
                <div style="display: none;" class="anim" id="show-me">
                  <div class="row justify-content-center">
                      <div class="col-5">
                        <small>Id Buku ke-2</small>
                        <input type="text" class="form-control" name="kbuku2" id="kode2" placeholder="Id Buku..">
                      </div>
                      <div class="col-1">
                        <button type="button" onclick="loadbuku2();" class="btn btn-primary mt-4"><i class="fas fa-search"></i></button>
                      </div>
                      <div class="col-6">
                        <small>Judul Buku-2</small>
                        <input type="text" class="form-control" id="judul2" readonly placeholder="Judul Buku..">
                      </div>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <div class="row justify-content-center">
                    <div class="col-4">
                      <button type="submit" name="addtran" class="btn btn-primary mt-3" style="width: 100%;">Tambah</button>
                    </div>
                    <div class="col-4">
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
    <!-- Akhir Modal Cek NIS -->

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <button type="submit" name="hapustr" class="btn btn-danger">Yes</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Hapus -->

    <!-- Modal Detail -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Info Transaksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row pl-1 pr-1">
                <div class="col-6">
                    <div class="form-group">
                        <small>Id Transaksi</small>
                        <input class="form-control" id="idt" type="text" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <small>Nama siswa</small>
                        <input class="form-control" id="nama" type="text" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <small>Nama Pustakawan</small>
                        <input class="form-control" id="namap" type="text" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <small>Tanggal Peminjaman</small>
                        <input class="form-control" id="tgl" type="text" readonly>
                    </div>
                </div>
                <div class="buk col-12">
                  
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Detail -->

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
    <script>
      $(document).ready(function() {
          $('#tbtransaksi').DataTable( {
            "info": true,
          } );
      } );
    </script>
    <script>
      $('#hapus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nama = button.data('whatever')
        var idpus = button.data('whatever2')// Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.tanya').html('<p>Yakin ingin menghapus data atas nama ' + nama + ' ?</p>')
        modal.find('.idnya').html('<input type="text" name="idnya" style="display: none;" value="'+idpus+'">')
      })
    </script>
    <script>
      $("input[name='jbuku']").click(function(){
        $('#show-me').css('display', ($(this).val() === "2") ? 'inline':'none');
      });
    </script>
    <!-- Load NIS -->
    <script>
      function loadnis(){
        var nis = document.getElementById('niss').value;
        if(nis!=""){
          $.ajax({
            type: 'post',
            data: {
              niss:nis,
            },
            url: '../proses/loadnis.php',
            
            success: function(response){
              var str = response;
              var strs = str.split(",");
              document.getElementById('namas').value = strs[0];
              document.getElementById('kelass').value = strs[1];
            }
          });
        }
      }
    </script>
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
    <!-- Detail -->
    <script>
      $(document).ready(function(){
        $('#detail').on('show.bs.modal', function(e){
          var rowid = $(e.relatedTarget).data('id');
          $.ajax({
            type: 'post',
            url: '../proses/detail.php',
            data: 'rowid='+rowid,
            success : function(response){
              var strs = response.split(",");
              document.getElementById('idt').value = strs[0];
              document.getElementById('nama').value = strs[1];
              document.getElementById('namap').value = strs[2];
              document.getElementById('tgl').value = strs[3];
              if(strs[4]=='1'){
                $('.buk').html('<div class="row"> <div class="col-12"> <div class="form-group"> <small>Buku yang dipinjam</small> <input class="form-control" value="'+strs[5]+'" type="text" readonly> </div> </div> </div>');
              } else {
                $('.buk').html('<div class="row"> <div class="col-6"> <div class="form-group"> <small>Buku yang dipinjam</small> <input class="form-control" value="'+strs[5]+'" type="text" readonly> </div> </div> <div class="col-6"> <div class="form-group"> <small>Buku yang dipinjam</small> <input class="form-control" value="'+strs[6]+'" type="text" readonly> </div> </div> </div>');
              }
            }
          });
        });
      });
    </script>

  </body>
</html>