<?php 
$id = $_GET['id'];
$ambil = $connect->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE id_produk='$id'");

$detailproduk = $ambil->fetch_assoc();


$ambil1 = $connect->query("SELECT * FROM komentar WHERE id_produk='$id'");
$detail_komen = [];
// var_dump($detail_komen);
while($pecah = $ambil1->fetch_assoc()){
    $detail_komen[] = $pecah;
}
$fotoproduk = [];
$ambilfoto = $connect->query("SELECT * FROM produk_foto WHERE id_produk='$id'");
while($tiap = $ambilfoto->fetch_assoc()){
    $fotoproduk[] = $tiap;
}
// echo "<pre>";
// echo var_dump($fotoproduk);
// echo var_dump($detailproduk);
// echo "</pre>";
?>
<table class="table table-bordered">
    <tr>
        <td>Kategori</td>
        <td><?= $detailproduk["nama_kategori"];?></td>
    </tr>
    <tr>
        <td>Produk</td>
        <td><?= $detailproduk["nama_produk"];?></td>
    </tr>
    <tr>
        <td>Harga</td>
        <td><?= $detailproduk["harga_produk"];?></td>
    </tr>
    <tr>
        <td>Berat</td>
        <td><?= $detailproduk["berat_produk"];?></td>
    </tr>
    <tr>
        <td>Dekripsi</td>
        <td><?= $detailproduk["deskripsi_produk"];?></td>
    </tr>
    <tr>
        <td>Stok</td>
        <td><?= $detailproduk["stok_produk"];?></td>
    </tr>
</table>
<div class="row">
    <?php foreach($fotoproduk as $key => $value):?>
    <div class="col-md-3">
    <img src="img/<?= $value['nama_produk_foto'];?>" alt="" width="100" style="display: block;">
    <?php if($key == 0):?>
    <a href="index.php?halaman=ubahfotoproduk&id=<?=$value['id_produk_foto'];?>&idproduk=<?= $id;?>" class="btn btn-primary d-block">Update</a>
    <?php else :?>
    <a href="index.php?halaman=hapusfotoproduk&id=<?=$value['id_produk_foto'];?>&idproduk=<?= $detailproduk['id_produk'];?>" class="btn btn-danger d-block">Hapus</a>
    <?php endif;?>
    </div>
    
    <?php endforeach;?>
</div>
<hr>
<h3>KOMENTAR PELANGGAN</h3>
<?php 
foreach($detail_komen as $value):?>
<div class="konten" style="background-color: #eee; padding: 10px; margin: 2% 0;">
    <h4 style="display: inline; margin-right: 5px;">Nama : <?= $value['nama_pelanggan_komen'];?></h4><a href="hapuskomentar.php?idkomen=<?= $value['id_komen'];?>&idproduk=<?= $id;?>"><i class="fas fa-backspace fs-4 my-auto"></i></a>
    <p>Tanggal : <?= date("d F Y", strtotime($value['tanggal']));?></p>
    <div class="">
    <input value="<?= $value['komentar'];?>" readonly class="form-control" style="background-color: white;">
    
    </div>
    
</div>
    <?php endforeach;?>
<form action="" method="POST" enctype="multipart/form-data">
    <div>
        <label for="">File Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <button type="submit" name="save" class="btn btn-success " style="margin-top: 10px;">Tambah foto</button>
</form>
<?php 
    if(isset($_POST['save'])){
        $lokasifoto = $_FILES['foto']['tmp_name'];
        $namafoto = $_FILES['foto']['name'];
        $namafoto = uniqid().".".end(explode('.',$namafoto));
        if($_FILES['foto']['error'] === 4){
            echo "<script>alert('pilih foto terlebih dahulu!');</script>";
            return false;
        }
        if($_FILES['foto']['size'] > 10_000_000){
            echo "<script>alert('ukuran terlalu besar!');</script>";
            return false;
        }
        move_uploaded_file($lokasifoto, "img/$namafoto");
        $connect->query("INSERT INTO produk_foto (id_produk, nama_produk_foto) VALUES ('$id','$namafoto')");
        echo "<script>alert('file gambar baru telah ditambahkan!');</script>";
        echo "<script>location = 'index.php?halaman=detailproduk&id=$detailproduk[id_produk]';</script>";
    }
?>