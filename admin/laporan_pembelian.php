<?php 
$semuadata = [];
$tglm = "";
$tgls = "";
$status = "";
if(isset($_POST['kirim'])){
    $tglm = $_POST['tglm'];
    $tgls = $_POST['tgls'];
    $status = $_POST['laporan'];
    $ambil = $connect->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tglm' AND '$tgls'");
    while($detail = $ambil->fetch_assoc()){
        $semuadata[] = $detail;
    }
}
?>

<h2>Laporan pembelian dari <?= $tglm ." hingga ".$tgls;?></h2>

<form action="" method="POST">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Tanggal Mulai</label>
                <input type="date" class="form-control" name="tglm" value="<?= $tglm;?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgls" value="<?= $tgls;?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Status</label>
                <select name="laporan" id="" class="form-control">
                    <option value="">Pilih Status untuk melihat laporan!</option>
                    <option value="Barang dikirim">Barang dikirim</option>
                    <option value="Lunas">Lunas</option>
                    
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <br>
            <button class="btn btn-primary" name="kirim">Lihat</button>
        </div>
    </div>
</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total = 0;
        foreach($semuadata as $key => $value):
        $total+=$value['total_pembelian'];
        ?>
        <tr>
            <td><?= $key+1; ?></td>
            <td><?= $value['nama_pelanggan'];?></td>
            <td><?= date("d F Y", strtotime($value['tanggal_pembelian']));?></td>
            <td><?= $value['status_pembelian'];?></td>
            <td>Rp. <?= number_format($value['total_pembelian']);?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
    <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th>Rp. <?= number_format($total);?></th>
            </tr>
    </tfoot>
</table>
<a href="download_laporan.php?tglm=<?= $tglm;?>&tgls=<?= $tgls;?>&status=<?=$status;?>">Download PDF</a>