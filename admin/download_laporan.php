<?php
require_once '../vendor/autoload.php';
include '../koneksi.php';
$mpdf = new \Mpdf\Mpdf();
$tgl_mulai = $_GET['tglm'];
$tgl_selesai = $_GET['tgls'];
$status = $_GET['status'];

$ambil = $connect->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while($detail = $ambil->fetch_assoc()){
        $semuadata[] = $detail;
    }
    $isi =  "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0' crossorigin='anonymous'>";
$isi .= "<div class='container my-5'>";
$isi .= "<h5>Laporan Pembelian ".$status." </h5>";
$isi .= "<h3>".date("d F Y", strtotime($tgl_mulai))." Sampai ".date("d F Y", strtotime($tgl_selesai))."</h3>";
$isi .= "<table class='table table-bordered'  border='3'>";
    $isi .= "<thead>";
        $isi .= "<tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Jumlah</th>
        </tr>";
    $isi .= "</thead>";
    $isi .= "<tbody>"; 
        $total = 0;
        foreach($semuadata as $key => $value):
        $nomor = $key+1;
        $total+=$value['total_pembelian'];
        $isi .= "<tr>";
            $isi .= "<td>".$nomor."</td>";
            $isi .= "<td>".$value['nama_pelanggan']."</td>";
            $isi .= "<td>".date("d F Y", strtotime($value['tanggal_pembelian']))."</td>";
            $isi .= "<td>".$value['status_pembelian']."</td>";
            $isi .= "<td>Rp. ".number_format($value['total_pembelian'])."</td>";
        $isi .= "</tr>";
        endforeach;
    $isi .= "</tbody>";
    $isi .= "<tfoot>";
            $isi .= "<tr>";
                $isi .= "<th colspan='4'>Total</th>";
                $isi .= "<th>Rp. ".number_format($total)."</th>";
            $isi .= "</tr>";
    $isi .= "</tfoot>";
$isi .= "</table>";
$isi .= "</div>";

// // Write some HTML code:
$mpdf->WriteHTML($isi);

// // Output a PDF file directly to the browser
$mpdf->Output("laporan.pdf","I");
