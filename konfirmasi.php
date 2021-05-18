<?php 
session_start();
include 'koneksi.php';
$id_pem = $_GET['id'];
$pecah = [];
$ambil = $connect->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pem'");
$ambil2 = $connect->query("SELECT * FROM pembelian JOIN pembelian_produk ON pembelian.id_pembelian=pembelian_produk.id_pembelian WHERE pembelian.id_pembelian='$id_pem'");
while($tiap = $ambil->fetch_assoc()){
    $pecah = $tiap;
}
$tiapid = [];
while($tiap = $ambil2->fetch_assoc()){
    $tiapid[] = $tiap['id_produk'];
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
    <title>Halaman Konfirmasi</title>
</head>
<body>
<?php include 'menu.php';?>
<div class="container my-5">
    <h3>Konfirmasi pembayaran</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group my-2">
            <label for="name">Tulis nama</label>
            <div class="input-gro">
                <input type="text" name="nama" id="name" class="form-control" value="<?= $_SESSION['pelanggan']['nama_pelanggan']?>">
            </div>
        </div>
        <div class="form-group my-2">
            <label for="jumlah">Tulis Jumlah / Harga produk</label>
            <div class="input-group">
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $pecah['jumlah'];?>">
            </div>
        </div>
        <div class="form-group my-2">
            <label for="sertakan">Sertakan bukti</label>
            <div class="input-group">
                <input type="file" name="foto" class="form-control" id="sertakan"> 
            </div>
        </div>
        <div class="form-group my-3">
            <button class="btn btn-success" name="konfirmasi">Konfirmasi</button>
        </div>
    </form>
</div>
<?php include 'footer.php';?>
<?php 
if(isset($_POST['konfirmasi'])){
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $id_pembayaran = $pecah['id_pembayaran'];
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    $namafoto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    if($_FILES['foto']['error'] === 4){
        echo "<script>alert('pilih gambar terlebih dahulu!');</script>";
        return false;
    }
    if($_FILES['foto']['size'] > 10_000_000){
        echo "<script>alert('ukuran gambar terlalu besar!');</script>";
        return false;
    }
    $ekstensi = end(explode('.',$namafoto));
    $ekstensi = strtolower($ekstensi);
    $ekstensiValid = ['jpg','png','jpeg'];
    if(!in_array($ekstensi,$ekstensiValid)){
        echo "<script>alert('yang anda upload bukan gambar!');</script>";
        return false;
    }
    $namafoto = uniqid();
    $namafoto .= ".". $ekstensi;
    move_uploaded_file($lokasi, "foto_konfirmasi/$namafoto");
    foreach($tiapid as $tiap => $value){

        $connect->query("INSERT INTO konfirmasi (id_konfirmasi, id_pembayaran, id_pelanggan, id_produk, nama_pelanggan, jumlah, bukti_barang) VALUES ('','$id_pembayaran','$id_pelanggan','$value', '$nama', '$jumlah', '$namafoto')");
    }
    $connect->query("UPDATE pembelian set status_pembelian='sudah kirim bukti' WHERE id_pembelian='$id_pem'");
    echo "<script>alert('bukti telah sukses ditambahkan');</script>";
    echo "<script>location = 'riwayat.php'</script>";
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>