<?php 
session_start();
include 'koneksi.php';
$id_produk = $_GET['id'];
error_reporting(1);
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$ambil1 = $connect->query("SELECT * FROM komentar WHERE id_produk='$id_produk'");
$detail_komen = [];
while($pecah = $ambil1->fetch_assoc()){
    $detail_komen[] = $pecah;
}
if(!isset($_SESSION['pelanggan'])){
    echo "<script>alert('harus login dulu!');</script>";
    echo "<script>location = 'detail.php?id=$id_produk';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <?php include 'favicon.php';?>
    <title>Detail Barang</title>
</head>
<body style="height: 100%;">
<section class="konten my-5 p-2"  >
    <div class="container p-5">
        <?php 
        foreach($detail_komen as $value):?>
        <?php if($value['id_pelanggan'] != $id_pelanggan):?>
        <div class="container bg-light p-2 my-3" >
            <h5>Nama : <?= $value['nama_pelanggan_komen'];?></h5>
            <p>Tanggal : <?= date("d F Y", strtotime($value['tanggal']));?></p>
            <div class="input-group" >  
                <textarea readonly class="form-control text-dark" rows="1"><?= $value['komentar'];?></textarea>
                <?php if($_SESSION['pelanggan']['id_pelanggan'] == $value['id_pelanggan']):?>
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <a href="hapuskomentar.php?idkomen=<?= $value['id_komen'];?>&idproduk=<?= $id_produk;?>"><i class="fas fa-backspace fs-4 my-auto"></i></a>
                </div>
            </div>
            <?php endif;?>
            </div>          
        </div>
        <?php endif;?>
            <?php endforeach;?>
        <?php if(isset($_SESSION['pelanggan'])):?>
        <form action="" method="POST" class="my-3 bg-light p-3 rounded">
            <div class="form-group">
                <h3>Masukkan komentar <?= (isset($_SESSION['pelanggan'])) ? $_SESSION['pelanggan']['nama_pelanggan'] : "Anda";?></h3>
                <div class="input-group">
                    <textarea name="balaskomen" id="" cols="30" rows="5" class="form-control" placeholder="Anda ingin memberi masukan untuk orang lain?"></textarea>
                </div>
                <div class="input-group my-2 w-100">
                
                <button class="btn btn-primary float-right" name="balas">Reply Comment</button>
                </div>
            </div>
        </form>
        <?php endif;?>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>

</body>
</html>
<?php
if(isset($_POST['balas'])){
    $id_komen = $_GET['idkomen'];
    $balaskomen = $_POST['balaskomen'];
    $id_balas = $_SESSION['pelanggan']['id_pelanggan'];
    $yangbalas = $_SESSION['pelanggan']['nama_pelanggan'];
    $connect->query("INSERT INTO reply (id_komen, id_pelanggan, yang_balas, reply_komentar) VALUES ('$id_komen','$id_balas','$yangbalas','$balaskomen')");
    echo "<script>alert('balasan telah dikirim!');</script>";
    echo "<script>location = 'detail.php?id=$id_produk';</script>";
}
?>