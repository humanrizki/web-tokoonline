<?php 
session_start();
include 'koneksi.php';
$idpem = $_GET['id'];
$ambil = $connect->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$idpem'");
$detail = $ambil->fetch_assoc();
if(empty($detail)){
    echo "<script>alert('belum ada data pembayaran!');</script>";
    echo "<script>location = 'riwayat.php';</script>";
    exit();
}
// jika data pelanggan  pembayaran tidak sesuai dengan yang login
if($detail['id_pelanggan'] !== $_SESSION['pelanggan']['id_pelanggan']){
    echo "<script>alert('anda tidak berhak untuk melihat data!');</script>";
    echo "<script>location = 'riwayat.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <?php include 'favicon.php';?>
    <title>Lihat Pembayaran</title>
</head>
<body>
<?php include 'menu.php';?>
<div class="container my-5">
    <h1>Lihat Pembayaran</h1>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped">
                <tr>
                    <th>Nama</th>
                    <td><?= $detail['nama'];?></td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td><?= $detail['bank'];?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?= $detail['tanggal'];?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>Rp. <?= number_format($detail['jumlah']);?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <img src="img/<?= $detail['bukti'];?>" alt="" class="img-responsive " style="width: 150px; height:150px;">
        </div>
    </div>
</div>
<?php include 'footer.php';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

</body>
</html>