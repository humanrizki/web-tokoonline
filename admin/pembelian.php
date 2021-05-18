<h2>Data Pembelian</h2>
<table border="0" cellpadding="10" class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama pelanggan</th>
            <th>tanggal</th>
            <th>Status</th>
            <th>total</th>
            <th>aksi</th>
            <!-- <th>aksi</th> -->
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $ambil = $connect->query("SELECT * FROM  pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");?>
        <?php while($pecah = $ambil->fetch_assoc()):?>
        <tr>
            <td><?= $i++;?></td>
            <td><?= $pecah['nama_pelanggan'];?></td>
            <td><?= $pecah['tanggal_pembelian'];?></td>
            <td><?= $pecah['status_pembelian'];?></td>
            <td><?= $pecah['total_pembelian'];?></td>
            <td>
                <a href="index.php?halaman=detail&id=<?= $pecah['id_pembelian'];?>" class="btn-info btn">detail</a>
                <?php if ($pecah['status_pembelian'] == 'sudah kirim' or $pecah['status_pembelian'] == 'sudah kirim bukti'):?>
                    <a href="index.php?halaman=pembayaran&id=<?= $pecah['id_pembelian'] ?>" class="btn btn-success">Pembayaran</a>
                <?php endif;?>
            </td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>