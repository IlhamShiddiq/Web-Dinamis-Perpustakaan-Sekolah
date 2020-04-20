<?php require "../proses/koneksi.php"; 
require "../proses/today.php";?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- More CSS -->
    <link rel="stylesheet" href="../pustakawan/style.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/datatables.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">

    <title>Data Buku - Perpustakaan | SMK Negeri 1 Kota Cimahi</title>
  </head>
  <body>

    <?php
      if(isset($_POST['go'])){
        $searchby = "berdasarkan ".$_POST['searchby'];
        if($searchby!="berdasarkan all"){
          $kata = "Pencarian data buku ".$searchby;
          echo "
          <div class='alert alert-dark alert-dismissible fade show text-center' role='alert' style='position: fixed; opacity: 0.8; border-bottom: 1px solid gray; width: 100%; top: 0; z-index: 5;'>
            $kata..
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
        <a href="../index.php" type="button" class="btn btn-danger" style="width: 150px;">Keluar</a>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="a">
              <form action="" method="post">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                          <small>Search by</small>
                            <select class="form-control" name="searchby" style="margin: 0;">
                                <option value="all">All</option>
                                <option value="judul">Judul</option>
                                <option value="penerbit">Penerbit</option>
                                <option value="penulis">Penulis</option>
                                <option value="kategori">Kategori</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <small>Search Buku</small>
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                      </div>
                    </div>
                    <div class="col-1">
                      <div class="form-group">
                        <button type="submit" name="go" class="btn btn-primary mt-4" style="width: 100%;"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                    <div class="col-2">
                      <div class="form-group">
                        <button type="submit" name="allbuku" class="btn btn-primary mt-4" style="color: white;"><i class="far fa-eye"></i>&nbsp;&nbsp;See All</button>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div> 
          <div class="col-9 mt-1">
            <div class="a">
                <div class="table-responsive">
                    <table class="table table-hover" id="tbbuku">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" style="width: 5%;">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Kategori</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if(isset($_POST['go'])){
                              $searchby = $_POST['searchby'];
                              $kata = "%".$_POST['search']."%";
                              if($searchby=="all"){
                                $query =  "SELECT * FROM buku, penerbit, kategori WHERE (judul LIKE :kata OR nama LIKE :kata OR penulis LIKE :kata OR kategoriBuku LIKE :kata) AND buku.idPenerbit=penerbit.idPenerbit AND buku.idKategori=kategori.idKategori";
                                $tampil = $con->prepare($query);
                                $tampil->bindParam(':kata', $kata);
                                $tampil->execute();
                              } else {
                                if($searchby=="judul"){
                                  $query =  "SELECT * FROM buku, penerbit, kategori WHERE judul LIKE :kata AND buku.idPenerbit=penerbit.idPenerbit AND buku.idKategori=kategori.idKategori";
                                } else if($searchby=="penerbit"){
                                  $query =  "SELECT * FROM buku, penerbit, kategori WHERE nama LIKE :kata AND buku.idPenerbit=penerbit.idPenerbit AND buku.idKategori=kategori.idKategori";
                                } else if($searchby=="penulis"){
                                  $query =  "SELECT * FROM buku, penerbit, kategori WHERE penulis LIKE :kata AND buku.idPenerbit=penerbit.idPenerbit AND buku.idKategori=kategori.idKategori";
                                } else {
                                  $query =  "SELECT * FROM buku, penerbit, kategori WHERE kategoriBuku LIKE :kata AND buku.idPenerbit=penerbit.idPenerbit AND buku.idKategori=kategori.idKategori";
                                }
                                $tampil = $con->prepare($query);
                                $tampil->bindParam(':kata', $kata);
                                $tampil->execute();
                              }
                            } else if(isset($_POST['allbuku'])) {
                              $query_tampil = "SELECT * FROM buku b, penerbit p, kategori k WHERE b.idPenerbit=p.idPenerbit AND b.idKategori=k.idKategori";
                              $tampil = $con->prepare($query_tampil);
                              $tampil->execute();
                            } else {
                              $query_tampil = "SELECT * FROM buku b, penerbit p, kategori k WHERE b.idPenerbit=p.idPenerbit AND b.idKategori=k.idKategori";
                              $tampil = $con->prepare($query_tampil);
                              $tampil->execute();
                            }
                            $no=1;
                            while($row=$tampil->fetch(PDO::FETCH_ASSOC)){
                          ?>
                          <tr>
                            <th scope="row"><?php echo $no; ?></th>
                            <td><a type="button" style="color: white; width: 50px;" class="btn btn-primary" onclick="desc('<?php echo $row['idBuku'] ?>');"><i class="far fa-image"></i></a></td>
                            <td><?php echo $row['judul']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['penulis']; ?></td>
                            <td><?php echo $row['kategoriBuku']; ?></td>
                          </tr>
                            <?php $no++; } ?>
                        </tbody>
                      </table>
                </div>
            </div>
          </div>
          <div class="col-3 mt-1">
              <div class="a">
                <div class="hari-ini text-center">
                  <?php echo $today; ?>
                </div>
              </div>
              <div class="a">
                  <div class="wrap" style="background-color: rgb(245, 245, 245); width: 100%; min-height: 330px; padding: 10px;">
                    <div class="more text-center" style="font-size: 15px; color: gray;">More Details</div>
                    <hr>
                    <div class="judul text-center mb-2" style="font-size: 14px; font-weight: bold;"></div>
                    <div class="cover text-center"></div>
                    <div class="sinopsis text-center mt-3" style="font-size: 14px;"></div>
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

    <!-- Modal Gambar -->
    <div class="modal fade" id="lihat-gambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Judul Buku</h5>
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
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.gambartrigger').html('<img src="../upload/buku/'+recipient+'" width="250px">')
      })
    </script>

    <!-- Deskripsi Buku -->
    <script>
      function desc(id){
        if(id!=""){
          $.ajax({
            type: 'post',
            data: {
              id:id,
            },
            url: 'descbuku.php',
            
            success: function(response){
              var str = response;
              var strs = str.split("@");
              $('.judul').html(strs[0]);
              $('.cover').html("<img src='../upload/buku/"+strs[1]+"' width='100'>");
              $('.sinopsis').html(strs[2]);
            }
          });
        }
      }
    </script>
  </body>
</html>