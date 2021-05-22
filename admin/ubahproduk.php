<h2>Ubah produk</h2>
<?php 
$semuak = [];
$kategori = $connect->query("SELECT * FROM kategori");
while($detil = $kategori->fetch_assoc()){
    $semuak[] = $detil;
}
$ambil = $connect->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="fotoLama" value="<?php echo $pecah['foto_produk'];?>">
        <div class="form-group">
            <label for="nama">Nama : </label>
            <div class="">
                <input type="text" class="form-control" name="nama" id="nama" value="<?= $pecah['nama_produk'];?>">
            </div>
        </div>
        <div class="">
            <label for="kategori">Kategori : </label>
            <div class="">
                <select name="id_kategori" id="kategori" class="form-control">
                    <option value="">Pilih Kategori</option>
                    <?php foreach($semuak as $key => $value):?>
                    <option value="<?= $value['id_kategori'];?>"><?= $value['nama_kategori'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="harga">Harga (Rp) : </label>
            <div class="">
                <input type="number" class="form-control" name="harga" id="harga" value="<?= $pecah['harga_produk'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="berat">Berat (Gr) : </label>
            <div class="">
                <input type="text" class="form-control" name="berat" id="berat" value="<?= $pecah['berat_produk'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi : </label>
            <div class="">
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10" ><?= $pecah['deskripsi_produk'];?>
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="stok">Stok : </label>
            <div class="">
                <input type="number" min="1" class="form-control" name="stok" id="stok" value="<?= $pecah['stok_produk'];?>">
            </div>
        </div>
        <button class="btn btn-success" name="save" type="submit">Kirim Data</button>
<?php 
include 'functions.php';
if(isset($_POST['save'])){
    if(empty($_FILES['foto']['tmp_name'])){
        // $gambar = upload();
        $foto = $pecah['foto_produk'];
        // unlink("img/$foto");
        $id = $_GET['id'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $berat = $_POST['berat'];
        $desk = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $kategori = $_POST['id_kategori'];
        $connect->query("UPDATE produk set nama_produk='$nama', harga_produk='$harga', berat_produk='$berat', stok_produk='$stok', deskripsi_produk='$desk', id_kategori='$kategori' WHERE id_produk='$id'");
        echo "<script>alert('data berhasil dirubah'); document.location.href = 'index.php?halaman=produk';</script>";
    } else {
        $gambar = upload();
        $id = $_GET['id'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $berat = $_POST['berat'];
        $desk = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $kategori = $_POST['id_kategori'];
        $connect->query("UPDATE produk set nama_produk='$nama', harga_produk='$harga', berat_produk='$berat',
        stok_produk='$stok', deskripsi_produk='$desk',
        id_kategori='$kategori' WHERE id_produk='$id'");
        echo "<script>alert('data berhasil dirubah'); document.location.href = 'index.php?halaman=produk';</script>";
    }
}
?>