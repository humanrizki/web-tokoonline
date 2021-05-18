<h2>Tambah Kategori</h2>
<?php 
$id = $_GET['id'];
$ambil = $connect->query("SELECT * FROM kategori WHERE id_kategori='$id'");
$pecah = $ambil->fetch_assoc();
?>
<form action="" method="POST">
    <div class="form-group">
        <label for="">Nama Kategori</label>
        <div class="input-group">
            <input type="text" class="form-control" name="nama" value="<?= $pecah['nama_kategori'];?>">
        </div>
    </div>
    <button class="btn btn-success" name="submit">Tambah Data</button>
</form>
<?php 
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $connect->query("UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori='$id'");
    echo "<script>alert('kategori telah dirubah!');</script>";
    echo "<script>location = 'index.php?halaman=kategori';</script>";
}