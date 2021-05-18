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
    <title>Riwayat Belanja</title>
</head>
<body>
<?php include 'menu.php';?>
<section class="riwayat" style="margin-bottom: 10%; margin-top: 5%;">
    <div class="container">
        <h3>Riwayat Belanja <?= $_SESSION['pelanggan']['nama_pelanggan']; ?></h3>
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
                // mendaptkan id 
                $i = 1;
                $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                $ambil = $connect->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                if($ambil->num_rows == 0){
                    echo "<script>alert('harus memasukan beberapa pembayaran terlebih dahulu!');</script>";
                    echo "<script>location = 'index.php';</script>";
                }
                while($pecah = $ambil->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $i++;?></td>
                    <td><?= $pecah['tanggal_pembelian'];?></td>
                    <td>
                    <?= $pecah['status_pembelian'];?><br>
                    <?php if(!empty($pecah['resi_pengiriman'])):?>
                    <strong>No Resi : <?= $pecah['resi_pengiriman'];?></strong>
                    <?php endif;?>
                    </td>
                    <td><?= number_format($pecah['total_pembelian']);?></td>
                    <td> 
                        <?php if(empty($pecah['resi_pengiriman']) and $pecah['status_pembelian'] == 'pending'):?>
                        <a href="nota.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-info text-white">Nota</a>
                        <a href="pembayaran.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-success">Input pembayaran</a>
                        <a href="batalkanpembayaran.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-danger text-white">Batalkan</a>
                        <?php elseif($pecah['status_pembelian'] == 'batal' or $pecah['status_pembelian'] == 'lunas'):?>
                        <a href="nota.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-info text-white">Nota</a>
                        <a href="hapuspembayaran.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-danger">Hapus Riwayat</a>
                        <?php elseif($pecah['status_pembelian'] == 'barang dikirim'):?>
                        <a href="nota.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-info text-white">Nota</a>
                        <a href="konfirmasi.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-primary">Konfirmasi</a>
                        <?php else :?>
                            <a href="nota.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-info text-white">Nota</a>
                            <a href="lihat_pembayaran.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-warning text-white">Lihat pembayaran</a>

                        <?php endif;?>
                        
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<?php include 'footer.php';?>
</body>
</html>