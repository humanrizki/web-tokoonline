<?php 
$id =  $_GET['id'];
$id_produk = $_GET['idproduk'];
$ambil = $connect->query("SELECT * FROM produk_foto WHERE id_produk_foto='$id'");
$detailfoto = $ambil->fetch_assoc();

?>
<h2>Ubah Gambar Utama</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <img src="img/<?= $detailfoto['nama_produk_foto'];?>" alt=""  width="200" style="display: block;">
        <label for="">Ubah foto: </label>
        <input type="file" name="foto" class="form-control">
    </div>
    <button type="submit" name="save" class="btn btn-primary">Ubah</button>
</form>
<?php 
if(isset($_POST['save'])){
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
    $ekstensiValid = ['jpg','png','jpeg'];
    if(!in_array($ekstensi,$ekstensiValid)){
        echo "<script>alert('yang anda upload bukan gambar!');</script>";
        return false;
    }
    $namafoto = uniqid();
    $namafoto .= ".". $ekstensi;
    unlink("img/".$detailfoto['nama_produk_foto']);
    move_uploaded_file($lokasi, "img/$namafoto");
    $connect->query("UPDATE produk_foto SET nama_produk_foto='$namafoto' WHERE id_produk_foto='$id'");
    $connect->query("UPDATE produk SET foto_produk='$namafoto' WHERE id_produk='$id_produk'");
    echo "<script>alert('gambar telah diupload!');</script>";
    echo "<script>location = 'index.php?halaman=detailproduk&id=$id_produk';</script>";
}
?>