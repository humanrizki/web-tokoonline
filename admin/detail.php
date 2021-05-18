<h2>Data Detail Pembelian</h2>
<?php 
$ambil = $connect->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();

?>
<div class="row">
<div class="col-md-4">
    <h1>Pembelian</h1>
    <strong>NO. Pembelian <?= $detail['id_pembelian'];?></strong><br>
    <p>Tanggal : <?= $detail['tanggal_pembelian'];?></p>
    <p>Total : <?= number_format($detail['total_pembelian']); ?></p>
    <p>Status : <?= $detail['status_pembelian'];?></p>
</div>
<div class="col-md-4">
    <h1>Pelanggan</h1>
    <strong><?= $detail['nama_pelanggan'];?></strong> <br>
    <p>No HP : <?= $detail['telepon_pelanggan'];?></p>
    <p>Email : <?= $detail['email_pelanggan']?></p>
</div>
<div class="col-md-4">
    <h1>Pengiriman</h1>
    <strong><?= $detail['nama_kota'];?></strong><br>
      <p>Ongkos Kirim Rp. <?= number_format($detail['tarif']);?></p> 
      <p>Alamat : <?= $detail['alamat'];?></p>
</div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama produk</th>
            <th>harga</th>
            <th>jumlah</th>
            <th>subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $ambil = $connect->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'");
        ?>
        <?php while( $pecah = $ambil->fetch_assoc()) :?>
        <tr>
            <td><?= $i++;?></td>
            <td><?= $pecah['nama_produk'];?></td>
            <td>Rp. <?= number_format($pecah['harga_produk']);?></td>
            <td><?= $pecah['jumlah'];?></td>
            <td>Rp. <?= number_format($pecah['harga_produk'] * $pecah['jumlah']);?></td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>