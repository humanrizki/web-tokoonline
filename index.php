<?php 
session_start();
// $connect = new mysqli('localhost','root','','tkonline');
include 'koneksi.php';
// echo $_COOKIE['login'];
$namafoto = [];
$gets = $connect->query("SELECT * FROM produk");
while($tiap = $gets->fetch_assoc()){
    $namafoto[] = $tiap;
    // var_dump($namafoto);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="css/menu.css">
    <!-- <link rel="stylesheet" href="admin/assets/css/bootstrap.css"> -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <?php include 'favicon.php';?>
    <style>
    @media screen and (max-width: 600px){
        div#banner {
            display: none;
        }
    }
    
    </style>
    <title>Tarbenam Nostri</title>
</head>
<body>
<?php include 'menu.php';?>
<div class="row mx-auto" id="banner">
    <div class="col-sm-10 offset-1">
    <div class=" my-4 bg-light rounded">
      <div class="container">
      <div id="carouselExampleInterval" class="carousel carousel-dark slide mx-auto" data-bs-ride="carousel">
                <div class="carousel-inner mx-auto rounded">                    
                        <div class="carousel-item active" data-bs-interval="3000">
                            <img src="artboard1.png" class="d-block mx-auto py-2 rounded" alt="..." style="width: 100%;">
                        </div>
                        <div class="carousel-item " data-bs-interval="3000">
                            <img src="artboard2.png" class="d-block mx-auto py-2 rounded" alt="..." style="width: 100%;">
                        </div>                                          
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon text-dark" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
      </div>
    </div>
    </div>    
</div>
<section class="konten w-100 my-3">
    <div class="container " >
    <h1 class="p-2 bg-light" style="width: fit-content;">Produk Terbaru</h1>
        <div class="row ">
        <?php 
        $jumlahDataPerhalaman = 4.0;
        $hasil = $connect->query("SELECT * FROM produk");
        $hasil_tampungan = [];
        while($tampung_hasil = $hasil->fetch_assoc()){
            $hasil_tampungan[] = $tampung_hasil;
        }
        $jumlahData = ceil(count($hasil_tampungan) / $jumlahDataPerhalaman);
        $halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1 ;
        $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
        $ambil = $connect->query("SELECT * FROM produk LIMIT $awalData, $jumlahDataPerhalaman");
        while($pecah = $ambil->fetch_assoc()):
          $nama = $pecah['nama_produk'];
        ?>
            <div class="col-md-3 col-sm-6 my-2 ">
                
                <div class="card shadow">
                    <?php if($pecah['stok_produk'] > 0):?>
                    <span class="badge bg-success p-2 position-absolute" style="width: fit-content;">Tersedia</span>
                    <?php else:?>
                    <span class="badge bg-primary p-2 position-absolute" style="width: fit-content;">Kosong</span>
                    <?php endif;?>
                    <img src="admin/img/<?= $pecah['foto_produk'];?>" alt=""  class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title fs-5"><?= strlen($pecah['nama_produk']) >= 15? substr($nama,0,15)."...":$pecah['nama_produk'];?></h5>
                        <h6 class="card-subtitle text-muted"><?= substr($pecah['deskripsi_produk'], 0, 25)."...";?>
                        
                        </h6>
                        <hr>
                        <h5 class="card-text"><?= "Rp ". number_format( $pecah['harga_produk']);?></h5>
                        <a href="beli.php?id=<?= $pecah['id_produk']; ?>" class="btn btn-primary w-0 float-left">Beli</a>
                        <a href="detail.php?id=<?= $pecah['id_produk'];?>" class="btn btn-info  text-white float-right">Detail</a>
                    </div>
                </div>
            </div>
            <?php endwhile;?>
        </div>
        <?php if($halamanAktif > 1):?>
        <a href="?halaman=<?= $halamanAktif - 1;?>" class="btn btn-info"><i class="fas fa-arrow-left text-white"></i></a>
        <?php endif;?>
        <?php for($i = 1; $i <=  $jumlahData; $i++):?>
        <?php if($i == $halamanAktif):?>
        <a href="?halaman=<?= $i;?>" class="btn btn-primary"><?= $i;?></a>
        <?php else:?>
        <a href="?halaman=<?= $i;?>" class="btn btn-info text-white"><?= $i;?></a>
        <?php endif;?>
        <?php endfor;?>
        <?php if($halamanAktif < $jumlahData):?>
        <a href="?halaman=<?= $halamanAktif +1;?>" class="btn btn-info"><i class="fas fa-arrow-right text-white"></i></a>
        <?php endif;?>  
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<?php include 'footer.php';?>
</body>
</html>