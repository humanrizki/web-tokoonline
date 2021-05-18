<h2>Data Pelanggan</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>no</td>
            <td>nama</td>
            <td>email</td>
            <td>telepon</td>
            <td>aksi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
        $i = 1;
        $ambil = $connect->query("SELECT * FROM pelanggan");?>
        <?php while($pecah = $ambil->fetch_assoc()):?>
        <tr>
            <td><?= $i++;?></td>
            <td><?= $pecah['nama_pelanggan'];?></td>
            <td><?= $pecah['email_pelanggan'];?></td>
            <td><?= $pecah['telepon_pelanggan'];?></td>
            <td>
                <a href="" class="btn-danger btn">hapus</a>
                <a href="" class="btn-warning btn">ubah</a>
            </td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>