<?php
session_start();
include 'koneksi.php';
$produk = $_GET['produk'];
$semua = array();
$ambil = $connect->query("SELECT * FROM produk WHERE nama_produk LIKE '%$produk%' OR deskripsi_produk LIKE '%$produk%'");
while($pecah = $ambil->fetch_assoc()){
    $semua[] = $pecah;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <?php include 'favicon.php';?>
    <title>pencarian <?= " : ".$produk;?></title>
</head>
<body>
    <?php include 'menu.php';?>
    <div class="container my-5" style="height: 100vh;">
        <h3>Hasil Pencarian<?= " : ".$produk;?></h3>
        <?php 
        if(empty($semua) or $produk == ''):
        ?>
        <div class="alert alert-danger">
            <?php echo $produk;?> Tidak ditemukan
        </div>
        <?php endif;?>
        <div class="row">
            <?php foreach($semua as $key => $value):?>
                <div class="col-md-3 col-sm-6 my-2">
                
                <div class="card shadow">
                
                    <img src="admin/img/<?= $value['foto_produk'];?>" alt=""  class=" ">
                    <?php if($value['stok_produk'] > 0):?>
                    <span class="badge bg-success p-2 position-absolute" style="width: fit-content;">Tersedia</span>
                    <?php else:?>
                    <span class="badge bg-primary p-2 position-absolute" style="width: fit-content;">Kosong</span>
                    <?php endif;?>
                    <div class="card-body">
                        <h5 class="card-title fs-5"><?= strlen($value['nama_produk']) >= 15? substr($value['nama_produk'],0,15)."...":$value['nama_produk'];?></h5>
                        <h6 class="card-subtitle text-muted"><?= substr($value['deskripsi_produk'], 0, 25)."...";?></h6>
                        <hr>
                        <h5 class="card-text"><?= "Rp ". number_format( $value['harga_produk']);?></h5>
                        <a href="beli.php?id=<?= $value['id_produk']; ?>" class="btn btn-primary w-0 float-left">Beli</a>
                        <a href="detail.php?id=<?= $value['id_produk'];?>" class="btn btn-info  text-white float-right">Detail</a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <?php include 'footer.php';?>
</body>
</html>