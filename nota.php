<?php
session_start(); 
include 'koneksi.php';
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
    <title>Halaman Nota</title>
</head>
<body>
<?php include 'menu.php';?>

<?php 
$id= $_GET['id'];
$ambil = $connect->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$id'");
$detail = $ambil->fetch_assoc();
?>
<?php 
// mendapatkan id pelanggan yang beli
$idpelangganyangbeli = $detail['id_pelanggan'];
$idpelangganyanglogin = $_SESSION['pelanggan']['id_pelanggan'];
if($idpelangganyangbeli !== $idpelangganyanglogin){
    echo "<script>alert('Jangan nakal ya!');</script>";
    echo "<script>location = 'riwayat.php';</script>";
    exit();
}
?>
<section class="konten my-4">
<div class="container">
<h2>Data Detail Pembelian</h2><hr>
<div class="row">
  <div class="col-md-4">
    <h3>Pembelian</h3>
    <strong>NO. Pembelian <?= $detail['id_pembelian'];?></strong><br>
    <p>Tanggal : <?= $detail['tanggal_pembelian'];?></p>
    <p>Total : <?= $detail['total_pembelian']; ?></p>
  </div>
  <div class="col-md-4">
  <h3>Pelanggan</h3>
    <strong><?= $detail['nama_pelanggan'];?></strong> <br>
    <p><?= $detail['telepon_pelanggan'];?></p>
    <p><?= $detail['email_pelanggan']?></p>
  </div>
  <div class="col-md-4">
    <h3>Pengiriman</h3>
      <strong><?= $detail['nama_kota'];?></strong><br>
      <p>Ongkos Kirim Rp. <?= number_format($detail['tarif']);?></p> 
      <p>Alamat : <?= $detail['alamat'];?></p>
  </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama produk</th>
            <th>harga</th>
            <th>berat</th>
            <th>jumlah</th>
            <th>subberat</th>
            <th>subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $ambil = $connect->query("SELECT * FROM pembelian_produk JOIN pembelian ON pembelian_produk.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$_GET[id]'");
        ?>
        <?php while( $pecah = $ambil->fetch_assoc()) :?>
        <tr>
            <td><?= $i++;?></td>
            <td><?= $pecah['nama'];?></td>
            <td><?= 'Rp. '.number_format($pecah['harga']);?></td>
            <td><?= $pecah['berat'].' Gr';?></td>
            <td><?= $pecah['jumlah'];?></td>
            <td><?= $pecah['subberat'].' Gr';?></td>
            <td><?= 'Rp. '.number_format($pecah['subharga']);?></td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>

<div class="row">
    <?php if($detail['status_pembelian'] != 'batal'):?>
    <div class="col-md-16">
        <div class="alert alert-info">
            <p>Silahkan melakukan pembayaran Rp.<?= number_format($detail['total_pembelian']);?> Ke </p>
            <strong>BANK MANDIRI 129-4452-2305 Tn. MUHAMMAD RIZKI</strong>
        </div>
    </div>
    <?php else :?>
        <div class="col-md-16">
        <div class="alert alert-danger">
            <p>Pembayaran telah dibatalkan!</p>
        </div>
    </div>
    <?php endif;?>
</div>
</div>
</section>   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<?php include 'footer.php';?>
</body>
</html>