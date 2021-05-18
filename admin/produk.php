<h2>Data Produk</h2>
<table border="0" cellpadding="10" class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama</th>
            <th>kategori</th>
            <th>harga</th>
            <th>berat</th>
            <th>foto</th>
            <th>aksi</th>
            <th>deskripsi</th>
            <th>stok</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $ambil = $connect->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori");?>
        <?php while($pecah = $ambil->fetch_assoc()):?>
        <tr>
            <td><?= $i++;?></td>
            <td><?= $pecah['nama_produk'];?></td>
            <td><?= $pecah['nama_kategori'];?></td>
            <td><?= $pecah['harga_produk'];?></td>
            <td><?= $pecah['berat_produk'];?></td>
            <td>
                <img src="img/<?= $pecah['foto_produk'];?>" alt="" width="100">
            </td>
            <td>
                <a href="index.php?halaman=hapusproduk&id=<?= $pecah['id_produk'] ?>" class="btn-danger btn">hapus</a>
                <a href="index.php?halaman=ubahproduk&id=<?= $pecah['id_produk'];?>" class="btn-warning btn">ubah</a>
                <a href="index.php?halaman=detailproduk&id=<?= $pecah['id_produk'];?>" class="btn-primary btn">detail</a>
            </td>
            <td><?= $pecah['deskripsi_produk']; ?></td>
            <td><?= $pecah['stok_produk'];?></td>
        </tr>

        <?php endwhile;?>
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn-success btn">Tambah Data</a>