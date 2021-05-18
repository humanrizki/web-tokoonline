<h2>Detail Pembayaran</h2>

<?php 
$id_pembelian = $_GET['id'];

$ambil = $connect->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td><?= $detail['nama'];?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?= $detail['bank'];?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?=  number_format($detail['jumlah']);?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?= $detail['tanggal'];?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../img/<?= $detail['bukti'];?>" alt="">
    </div>
</div>

<form action="" method="POST">
    <div class="form-group">
        <label for="">no resi pengiriman</label>
        <input type="text" class="form-control" name="resi" value="hash" readonly>
    </div>
    <div class="form-group">
        <label for="">Status</label>
        <select name="status" id="" class="form-control">
            <option value="">Pilih Status</option>
            <option value="lunas">Lunas</option>
            <option value="barang dikirim">Barang dikirim</option>
        </select>
    </div>
    <button class="btn btn-success" name="proses">Proses</button>
</form>
<?php if(isset($_POST['proses'])){
    $resi;
    if($_POST['resi'] == 'hash'){
        $resi = hash("crc32",uniqid());
    }
    $status = $_POST['status'];
    $connect->query("UPDATE pembelian SET status_pembelian='$status', resi_pengiriman='$resi' WHERE id_pembelian='$id_pembelian'");
    echo "<script>alert('resi telah diupdate!');</script>";
    echo "<script>location = 'index.php?halaman=pembelian';</script>";
}

?>