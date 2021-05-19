<?php 
session_start();
include 'koneksi.php';
$id = $_GET['id'];
$sesi = $_SESSION['pelanggan']['id_pelanggan'];
$ambil = $connect->query("SELECT * FROM pembelian JOIN pembelian_produk ON pembelian.id_pembelian=pembelian_produk.id_pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian_produk.id_produk='$id' and pembelian.id_pelanggan='$sesi'");
$pecah = [];
while($tiap = $ambil->fetch_assoc()){
    $pecah[] = $tiap;
}
if(empty($pecah)){
    echo "<script>alert('data terkait barang tidak ada!');</script>";
    echo "<script>location = 'account.php';</script>";
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
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <?php include 'favicon.php';?>
    <title>Document</title>
</head>
<body>
<?php include 'menu.php';?>
<div class="container" style="margin: 0 auto; margin-top: 2%; margin-bottom: 6%;">
    <h3 class="my-5">Detil Riwayat pembelian melalui produk</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>No</td>
                <td>Tanggal</td>
                <td>Status</td>
                <td>Total</td>
                <td>Opsi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach($pecah as $value):
            ?>
            <tr>
                <td><?= $i++;?></td>
                <td><?= $value['tanggal_pembelian'];?></td>
                <td>
                <?= $value['status_pembelian'];?><br>
                <?php if(!empty($value['resi_pengiriman'])):?>
                <strong>No Resi : <?= $value['resi_pengiriman'];?></strong>
                <?php endif;?>
                </td>
                <td><?= number_format($value['total_pembelian']);?></td>
                <td>
                    <a href="nota.php?id=<?= $value['id_pembelian'];?>" class="btn btn-info text-white">Nota <i class="fas fa-sticky-note ms-1"></i></a>
                    <?php if(empty($value['resi_pengiriman']) and $value['status_pembelian'] == 'pending'):?>
                    <a href="pembayaran.php?id=<?= $value['id_pembelian']; ?>" class="btn btn-success">Input pembayaran <i class="fas fa-external-link-alt ms-1"></i></a>
                    <a href="batalkanpembayaran.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-danger">Batalkan <i class="fas fa-window-close ms-1"></i></a>
                    <?php elseif($pecah['status_pembelian'] == 'batal' or $pecah['status_pembelian'] == 'lunas'):?>
                    <a href="nota.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-info text-white">Nota <i class="fas fa-sticky-note ms-1"></i></a></a>
                    <a href="hapuspembayaran.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-danger">Hapus Riwayat <i class="fas fa-window-close"></i></a>
                    <?php elseif($pecah['status_pembelian'] == 'barang dikirim'):?>
                    <a href="nota.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-info text-white">Nota <i class="fas fa-sticky-note ms-1"></i></a></a>
                    <a href="konfirmasi.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-primary">Konfirmasi <i class="fas fa-check-circle"></i></a>
                    <?php else :?>
                        <a href="lihat_pembayaran.php?id=<?= $value['id_pembelian']; ?>" class="btn btn-warning text-white">Lihat pembayaran</a>
                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<?php include 'footer.php';?>  
</body>
</html>