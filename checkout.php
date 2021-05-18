<?php 
session_start();
include 'koneksi.php';
if(!isset($_SESSION['pelanggan'])){
    echo "<script>alert('anda harus login terlebih dahulu');</script>";
    echo "<script>location = 'login.php';</script>";
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
    <title>Halaman Checkout</title>
</head>
<body>
<?php include 'menu.php';?>
<section class="konten my-3">
    <div class="container">
        <h1>List Belanjaan</h1>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            $totalbelanja = 0;
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
                </tr>              
            <?php 
              $totalbelanja+=$subharga;
              endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4">Total Belanja</td>
                <td><?= number_format($totalbelanja);?></td>
              </tr>
            </tfoot>
        </table>
        <form action="" method="POST">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" readonly value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" readonly value="<?= $_SESSION['pelanggan']['telepon_pelanggan']; ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">      
                  <select name="ongkir" id="" class="form-select">
                  <option value="">Pilih Kota</option> 
                  <?php $ambil = $connect->query("SELECT * FROM ongkir");
                        while($perongkir = $ambil->fetch_assoc()):             
                  ?>
                    <option value="<?= $perongkir['id_ongkir'];?>" >
                      <?= $perongkir['nama_kota'];?> - 
                      <?= number_format($perongkir['tarif']);?>
                    </option>
                  <?php endwhile;?>
                  </select>
                </div>
              </div>
              <div class="form-group w-100 my-3">
                <label for="alamat" class="text-muted">Alamat Lengkap</label>
                <div class="input-group">
                  <textarea name="alamat_pengiriman" id="alamat" cols="30" rows="4" class="form-control"></textarea>
                </div>
              </div>
              <button class="btn btn-primary my-2" name="checkout">Checkout <i class="fas fa-credit-card ms-2"></i></button>
        </form>
        <?php 
          if(isset($_POST['checkout'])){
            $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
            $id_ongkir = $_POST['ongkir'];
            $alamat = $_POST['alamat_pengiriman'];
            $tanggal_pembelian = date('Y-m-d');
            $ambil = $connect->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
            $arrayongkir = $ambil->fetch_assoc();
            $nama_kota = $arrayongkir['nama_kota'];
            $tarif = $arrayongkir['tarif'];
            $total_pembelian = $totalbelanja + $tarif;
            $connect->query("INSERT INTO pembelian
            (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat) 
            VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat')");
            $id_pembelian_barusan = $connect->insert_id;
            foreach($_SESSION['keranjang'] as $id_produk => $jumlah){
              $ambil = $connect->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
              $perproduk = $ambil->fetch_assoc();
              $nama = $perproduk['nama_produk'];
              $harga = $perproduk['harga_produk'];
              $berat = $perproduk['berat_produk'];
              $subberat = $perproduk['berat_produk'] * $jumlah;
              $subharga = $perproduk['harga_produk'] * $jumlah;
              $connect->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah, nama, harga, berat, subberat, subharga)
              VALUES ('$id_pembelian_barusan','$id_produk','$jumlah','$nama','$harga','$berat','$subberat','$subharga')");
              $connect->query("UPDATE produk SET stok_produk=stok_produk - $jumlah WHERE id_produk='$id_produk'");
            }
            unset($_SESSION['keranjang']);
            echo "<script>alert('pembelian telah dialihkan ke halaman nota!');</script>";
            echo "<script>location = 'nota.php?id=$id_pembelian_barusan';</script>";
          }
        ?>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<?php include 'footer.php';?>
</body>
</html>