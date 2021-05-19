<?php 
// session_start();
include '../koneksi.php';
$ambil = $connect->query("SELECT * FROM ping JOIN pelanggan ON ping.id_pelanggan=pelanggan.id_pelanggan");
$pecah = [];
while($tiap = $ambil->fetch_assoc()){
    $pecah[] = $tiap;
}
?>
<pre>
<?= var_dump($pecah);?>
</pre>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>Pesan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $i = 1;
    foreach($pecah as $key => $value):?>
        <tr>
            <td><?= $i++;?></td>
            <td><?=$value['nama_pelanggan'];?></td>
            <td><?=$value['ping'];?></td>
            <td>
                <a href="chat.php?id=<?= $value['id_pelanggan'];?>" class="btn btn-success text-white">Chat Pelanggan</a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>