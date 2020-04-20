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
    <link rel="stylesheet" href="../assets/css/calendar-style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/datatables.css">
    <link rel="stylesheet" href="../assets/css/Chart.min.css">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">

    <title>Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
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
    <div class="akun">
      <img src="../upload/<?php echo $image; ?>" class="foto-pustakawan foto foto-edit" width="55" height="55"  data-toggle="modal" data-target="#edit-prof">
      
      
    </div>
    
    <!-- Akhir Navbar -->
    <!-- Navbar2 -->
    <nav class="navbar2 navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link aktif" href="#"><i class="fas fa-book"></i>&nbsp;Dashboard</a>
            <a class="nav-item nav-link" href="data-buku.php?id=<?php echo $id ?>"><i class="fas fa-book"></i>&nbsp;Data Buku</a>
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
                  <img src="../upload/<?php echo $image; ?>" class="foto foto-edit" width="50"  height="50" data-toggle="modal" data-target="#edit-prof">
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
                  <div class="edit-profile text-center mt-3">
                    <a type="submit" style="width: 100%; color: white;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-prof" style="color: white;"><i class='far fa-edit'></i>&nbsp;&nbsp;Edit Profil</a>
                    <a type="submit" style="width: 100%; color: white;" class="btn btn-danger btn-sm mt-2" data-toggle="modal" data-target="#logout" style="color: white;"><i class='fas fa-sign-out-alt'></i>&nbsp;&nbsp;Logout</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="a">
              <div class="calendar">
                    
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="a">
              <div class="identitas">
                <div class="sapaan">
                  Hallo, <?php echo $user; ?>
                </div>
                <div class="hak">
                  Anda terdaftar sebagai <?php echo $hak; ?>
                </div>
                <hr>
              </div>
            </div>
            <div class="ab">
              <div class="info-buku-title text-center">
                Info Buku
              </div>
              <div class="info-buku">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="info-bukunya jumlah-buku text-center">
                      <?php echo $total_buku; ?>
                    </div>
                    <small>Jumlah Buku</small>
                    <a href="data-buku.php?id=<?php echo $id; ?>" type="button" style="color: white;" class="btn btn-primary">Lihat Daftar</a>
                  </div>
                  <div class="col-lg-4">
                    <div class="info-bukunya penulis text-center">
                    <?php echo $total_penulis; ?>
                    </div>
                    <small>Penulis</small>
                    <a href="data-buku.php?id=<?php echo $id; ?>" type="button" style="color: white;" class="btn btn-primary">Lihat Daftar</a>
                  </div>
                  <div class="col-lg-4">
                    <div class="info-bukunya penerbit text-center">
                    <?php echo $total_penerbit; ?>
                    </div>
                    <small>Penerbit</small>
                    <a href="penerbit.php?id=<?php echo $id; ?>" type="button" style="color: white;" class="btn btn-primary">Lihat Daftar</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="a text-center">
              <div style="width: 95%;height: 250px">
                <canvas id="buku"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="a">
              <div class="hari-ini text-center">
                <?php echo $today; ?>
              </div>
            </div>
            <div class="a">
              <div class="info-umum">
                <div class="info-umum-buku buku-terpinjam text-center">
                <?php echo $total_pinjaman; ?>
                </div>
                <small>Buku Terpinjam</small>
                <hr>
                
                <div class="info-umum-buku jumlah-pustakawan text-center">
                <?php echo $total_pustakawan; ?>
                </div>
                <small>Jumlah Pustakawan</small>
              </div>
            </div>
            <div class="a text-center">
              <div style="width: 95%;">
                <canvas id="adm-pust"></canvas>
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

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="edit-prof" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="../proses/edit.php" method="post" enctype="multipart/form-data">
              <table class="table">
                <tr>
                  <td>
                    <div class="foto-edit text-center">
                      <img src="../upload/<?php echo $image; ?>" class="foto mb-3" id="gambar" width="60" height="60">
                    </div>
                  </td>
                  <td>
                    <label>Foto</label> 
                    <input type="text" name="sembunyi" style="display: none;" value="<?php echo $image; ?>">
                    <input type="file" class="form-control-file" name="file_gambar" value="<?php echo $image; ?>" onchange="document.getElementById('gambar').src = window.URL.createObjectURL(this.files[0])">
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="text" class="form-control" name="nama" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $nama; ?>">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" name="alamat" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $alamat; ?>">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label for="exampleInputEmail1">No Telepon</label>
                      <input type="tel" class="form-control" name="telepon" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $phone; ?>">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $email; ?>">
                    </div>
                  </td>
                </tr>
              </table>
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
              <button type="submit" name="edit" class="btn btn-primary" style="width: 100%;">Simpan Perubahan</button>
            </form>
          </div>
          <div class="modal-footer">
            <a href="gantipass.php?id=<?php echo $id; ?>" type="button" class="btn btn-danger" style="width: 100%;">Ganti Password</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Edit Profile -->

    <!-- Modal Logout -->
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please Confirm..</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Anda yakin ingin logout ?</p>
          </div>
          <div class="modal-footer">
            <a type="submit" style="color: white;" href="../index.php" name="sure-hapus" class="btn btn-danger">Yes</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Logout -->


    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/calendar.js "></script>
    <script src="../assets/js/Chart.min.js "></script>
    <script>
      let c = $('.calendar');
      let calendar = new Calendar(c);
    </script>
    <script src="../assets/js/datatables.js"></script>
    <script>
      $(document).ready(function() {
          $('#home-buku').DataTable( {
            "info": true,
          } );
      } );
    </script>
    <script>
      $(document).ready(function() {
          $('#home-penerbit').DataTable( {
            "info": true,
          } );
      } );
    </script>
    <script>
      $(document).ready(function() {
          $('#home-penulis').DataTable( {
            "info": true,
          } );
      } );
    </script>
    <!-- Grafik -->
    <script>
		var ctx = document.getElementById("buku").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Programming", "Networking", "Database", "Desain Grafis", "Multimedia"],
				datasets: [{
					label: ' > Jumlah Buku',
          data: [<?php 
          $pr = $con->prepare("SELECT * FROM buku WHERE idKategori='CA02'");
          $pr->execute();
          $jml_pr = $pr->rowCount();
          echo $jml_pr; 
          ?>, <?php 
          $nt = $con->prepare("SELECT * FROM buku WHERE idKategori='CA03'");
          $nt->execute();
          $jml_nt = $nt->rowCount();
          echo $jml_nt; 
          ?>, <?php 
          $db = $con->prepare("SELECT * FROM buku WHERE idKategori='CA01'");
          $db->execute();
          $jml_db = $db->rowCount();
          echo $jml_db; 
          ?>, <?php 
          $dg = $con->prepare("SELECT * FROM buku WHERE idKategori='CA04'");
          $dg->execute();
          $jml_dg = $dg->rowCount();
          echo $jml_dg; 
          ?>, <?php 
          $mm = $con->prepare("SELECT * FROM buku WHERE idKategori='CA05'");
          $mm->execute();
          $jml_mm = $mm->rowCount();
          echo $jml_mm; 
          ?>],
					backgroundColor: [
					'rgba(255, 99, 132)',
					'rgba(54, 162, 235)',
					'rgba(255, 206, 86)',
					'rgba(75, 192, 192)',
					'rgba(153, 102, 255)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
  <script>
		var ctx = document.getElementById("adm-pust").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: ["Admin", "Pustakawan"],
				datasets: [{
					label: ' > Jumlah Orang',
          data: [<?php 
          $ad = $con->prepare("SELECT * FROM login WHERE hakUser='Admin'");
          $ad->execute();
          $jml_ad = $ad->rowCount();
          echo $jml_ad; 
          ?>, <?php 
          $ps = $con->prepare("SELECT * FROM login WHERE hakUser='Pustakawan'");
          $ps->execute();
          $jml_ps = $ps->rowCount();
          echo $jml_ps; 
          ?>],
					backgroundColor: [
					'rgba(75, 192, 192)',
					'rgba(153, 102, 255)',
					],
					borderColor: [
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
  </body>
</html>