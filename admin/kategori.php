<h1>Data Kategori</h1>
<hr>
<?php 
$semuak = [];
$ambil = $connect->query("SELECT * FROM kategori");
while($pecah = $ambil->fetch_assoc()){
    $semuak[] = $pecah;
}
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($semuak as $key => $value):?>
        <tr>
            <td><?= $key+1;?></td>
            <td><?= $value['nama_kategori'];?></td>
            <td>
                <a href="index.php?halaman=ubahkategori&id=<?= $value['id_kategori'];?>" class="btn btn-warning">Ubah</a>
                <a href="index.php?halaman=hapuskategori&id=<?= $value['id_kategori'];?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<a href="index.php?halaman=tambahkategori" class="btn btn-success">Tambah Data</a>