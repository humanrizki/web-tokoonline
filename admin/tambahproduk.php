<h2>Tambah produk</h2>
<?php 
$semuak = [];
$kategori = $connect->query("SELECT * FROM kategori");
while($detil = $kategori->fetch_assoc()){
    $semuak[] = $detil;
}
?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Nama : </label>
            <div class="">
                <input type="text" class="form-control" name="nama" id="nama">
            </div>
        </div>
        <div class="form-group">
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
                <input type="number" class="form-control" name="harga" id="harga">
            </div>
        </div>
        <div class="form-group">
            <label for="berat">Berat (Gr) : </label>
            <div class="">
                <input type="number" class="form-control" name="berat" id="berat" >
            </div>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi : </label>
            <div class="">
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="foto">Foto : </label>
            <div class="letak-input" style="margin-bottom: 10px;">
                <input type="file" class="form-control" name="foto[]" id="foto">
            </div>
                <span class="btn btn-primary btn-tambah">
                <i class="fa fa-plus"></i>
                </span>
        </div>
        <div class="form-group">
            <label for="stok">Stok : </label>
            <div class="">
                <input type="number" min="1" class="form-control" name="stok" id="stok">
            </div>
        </div>
        <button class="btn btn-success" name="save" type="submit">Kirim Data</button>
    </form>

<!-- </div> -->
<?php
// include 'functions.php'; 
if(isset($_POST['save'])){
    global $connect;
            $nama_produk = $_POST['nama'];
            $harga_produk = $_POST['harga'];
            $berat_produk = $_POST['berat'];
            $deskripsi = $_POST['deskripsi'];
            $stok = $_POST['stok'];
            $kategori = $_POST['id_kategori'];
            $tmpName = $_FILES['foto']['tmp_name'];
            $error = $_FILES['foto']['error'];
            $namaFile = $_FILES['foto']['name'][0];
            $ekstensif = explode(".",$namaFile);
            $ekstensif = strtolower(end($ekstensif));
            $namaFile = uniqid();
            $namaFile .=".". $ekstensif;
            $ekstensiValid = ['jpg','jpeg','png'];
            if(!in_array($ekstensif,$ekstensiValid)){
                echo "<script>alert('yang anda upload bukan gambar!');</script>";
                return false;
            }
            $namag = $_FILES['foto']['name'];
            $connect->query("INSERT INTO produk (id_produk,nama_produk, harga_produk, berat_produk, foto_produk, deskripsi_produk, stok_produk, id_kategori) VALUES ('','$nama_produk','$harga_produk','$berat_produk','$namaFile','$deskripsi','$stok','$kategori')");
            $id_produk_barusan = $connect->insert_id;
            foreach($namag as $key => $value){
                $namag[$key] =  uniqid();
                $tiap_lokasi = $tmpName[$key];
                $ekstensi = strtolower(end(explode('.',$value)));
                if(!in_array($ekstensi,$ekstensiValid)){
                    echo "<script>alert('yang anda upload bukan gambar!');</script>";
                    return false;
                }
                $namag[$key] .= ".".$ekstensi;
                $namag[0] = $namaFile;
                move_uploaded_file($tiap_lokasi, "img/$namag[$key]");
                $connect->query("INSERT INTO produk_foto (id_produk_foto, id_produk, nama_produk_foto) VALUES ('','$id_produk_barusan','$namag[$key]')");
            }
} 
?>
<script>
$(document).ready(function(){
    $(".btn-tambah").on("click",function(){
        $(".letak-input").append("<input type='file' class='form-control' name='foto[]' id='foto'>");
    });
});
</script>
