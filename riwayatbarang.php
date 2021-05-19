<?php 
session_start();
include 'koneksi.php';
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$ambil = $connect->query("SELECT * FROM pembelian JOIN pembelian_produk ON pembelian.id_pembelian=pembelian_produk.id_pembelian WHERE pembelian.id_pelanggan='$id_pelanggan'");
$detail = [];
while($tiap = $ambil->fetch_assoc()){
    $detail[] = $tiap;
}

$detail_id = [];
$pecah = [];
$detail_ids = [];
$detail_jumlah = [];
foreach($detail as $value){
    $detail_id[] = $value['id_produk'];
    $detail_ids = array_keys(array_count_values($detail_id));
    $detail_jumlah = array_values(array_count_values($detail_id));
}
$ids = [];
$ids[] = array_values($detail_ids);
foreach($ids as $key){
    foreach($key as $k => $v){
        $ambil = $connect->query("SELECT  *  FROM produk  WHERE produk.id_produk='$v'");
        $pecah[] = $ambil->fetch_assoc();
    }
}      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'favicon.php';?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <title>Halaman riwayat barang</title>
</head>
<body>
<?php include 'menu.php';?>
<div class="container" style="overflow-x:auto;">
    <table class="table table-bordered my-5" >
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Detil</th>
            </tr>
        </thead>
        <tbody >
        <?php error_reporting(1);
        $i = 0;?>
        <?php foreach($pecah as $key => $value):?>
        <?php if(!empty($value)):?>
            
            <tr>
                <td ><img src="admin/img/<?= $value['foto_produk'];?>" width="100" alt=""></td>
                <td ><?= trim($value['nama_produk']);  ?></td>
                <td ><?= $value['harga_produk'];  ?></td>
                <td ><?= $detail_jumlah[$i];
                $i++;?></td>
                <td >
                    <a href="detilriwayat.php?id=<?=$value['id_produk'];?>" class="btn btn-primary">Detil <i class="fas fa-info ms-2"></i></a>
                </td>
            </tr>
        <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
</body>
</html>