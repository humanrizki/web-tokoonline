<?php 
session_start();
// $connect = new mysqli("localhost","root","","tkonline");
include 'koneksi.php';
if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
  echo "<script>alert('pilih produk terlebih dahulu!');</script>";
  echo "<script>location = 'index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="admin/assets/css/bootstrap.css">  -->
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <?php include 'favicon.php';?>
    <title>Keranjang belanja</title>
</head>
<body>
<?php include 'menu.php'; ?>
<!-- konten -->
<section class="konten my-3" style="height: 500px;">
    <div class="container">
        <h1>Keranjang Belanja</h1>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            error_reporting(1);
            foreach($_SESSION['keranjang'] as $id_produk => $jumlah):?>
            <?php 
            $ambil = $connect->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $pecah = $ambil->fetch_assoc();
            $subharga = $pecah['harga_produk'] * $jumlah;
            
            ?>
                <tr>
                    <td><?= $i++;?></td>
                    <td><?= $pecah['nama_produk'];?></td>
                    <td>Rp. <?= number_format($pecah['harga_produk']);?></td>
                    <td><?= $jumlah;?></td>
                    <td><?= number_format($subharga);?></td>
                    <td>
                    <?php if($_SESSION['keranjang'][$id_produk] >= 2 ):?>
                      <a href="hapuskeranjang.php?id=<?= $pecah['id_produk'];?>" class="btn btn-warning btn-xs text-white">Hapus</a>
                    <?php elseif($_SESSION['keranjang'][$id_produk] == 1):?>
                      <a href="hapuspkeranjang.php?id=<?= $pecah['id_produk'];?>" class="btn btn-danger text-white">Hapus</a>
                    <?php endif;?>
                    </td>
                </tr>
                
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-outline-primary">Lanjutkan Belanja</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<?php include 'footer.php';?>
</body>
</html>

