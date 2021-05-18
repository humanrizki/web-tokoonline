<?php 
session_start();
include 'koneksi.php';
?>
<?php 
if(!isset($_SESSION['pelanggan']) or empty($_SESSION['pelanggan'])){
    echo "<script>alert('harus login terlebih dahulu!');</script>";
    echo "<script>location = 'login.php';</script>";
    exit();
}
$idpem = $_GET['id'];
$ambil = $connect->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();
$id_pelanggan_beli = $detpem['id_pelanggan'];
$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];
if($id_pelanggan_beli !== $id_pelanggan_login){
    echo "<script>alert('id untuk membayar tidak sesuai!');</script>";
    echo "<script>location = 'riwayat.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <?php include 'favicon.php';?>
    <title>Pembayaran produk</title>
</head>
<body>
<?php include 'menu.php';?>
<div class="container my-5">
    <h2>Konfirmasi pembayaran</h2>
    <p>kirim pembayaran anda disini!</p>
    <div class="alert alert-info">
        Total Tagihan Rp. <?= number_format($detpem['total_pembelian'])." atas nama ".$_SESSION['pelanggan']['nama_pelanggan'];?>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Nama Penyetor</label>
            <input type="text" class="form-control" name="nama" id="nama">
        </div>
        <div class="form-group">
            <label for="bank">Bank</label>
            <input type="text" class="form-control" name="bank" id="bank">
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" min="1" class="form-control" name="jumlah" id="jumlah">
        </div>
        <div class="form-group">
            <label for="foto">Foto Bukti</label>
            <input type="file" class="form-control" name="foto" id="foto">
            <p class="text-danger">foto bukti harus diberikan dan maksimal 10mb</p>
        </div>
        <button class="btn btn-primary" name="kirim">KIRIM</button>
    </form>
    <?php 
    include 'fungsi.php';
    if(isset($_POST['kirim'])){
        $gambar = upload2();
        $nama = $_POST['nama'];
        $bank = $_POST['bank'];
        $tanggal = date("Y-m-d");
        $jumlah = $_POST['jumlah'];
        $connect->query("INSERT INTO pembayaran (id_pembayaran, id_pembelian, nama, bank, jumlah,tanggal, bukti) VALUES ('','$idpem','$nama','$bank','$jumlah','$tanggal','$gambar')");
        $connect->query("UPDATE pembelian SET status_pembelian='sudah kirim' WHERE id_pembelian=$idpem");
        echo "<script>alert('terima kasih telah melakukan pembayaran dan telah mengirim bukti, akan kami proses!');</script>";
        echo "<script>location = 'riwayat.php';</script>";
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>  
<?php include 'footer.php';?>
</body>
</html>