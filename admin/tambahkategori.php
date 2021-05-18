<h2>Tambah Kategori</h2>

<form action="" method="POST">
    <div class="form-group">
        <label for="">Nama Kategori</label>
        <div class="input-group">
            <input type="text" class="form-control" name="nama">
        </div>
    </div>
    <button class="btn btn-success" name="submit">Tambah Data</button>
</form>
<?php 
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $connect->query("INSERT INTO kategori (id_kategori, nama_kategori) VALUES ('','$nama')");
    echo "<script>alert('kategori baru telah ditambahkan!');</script>";
    echo "<script>location = 'index.php?halaman=kategori';</script>";
}
?>