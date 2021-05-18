<?php 
session_start();
include 'koneksi.php';
$id_pembelian = $_GET['id'];
$ambil = $connect->query("SELECT * FROM pembelian JOIN pembelian_produk ON pembelian.id_pembelian=pembelian_produk.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
$pecah = [];
while($tiap = $ambil->fetch_assoc()){
    $pecah[] = $tiap;
}
foreach($pecah as $value){
    if($_SESSION['pelanggan']['id_pelanggan'] == $value['id_pelanggan']){
        $connect->query("DELETE FROM pembelian WHERE id_pembelian='$value[id_pembelian]'");
        $connect->query("DELETE FROM pembelian_produk WHERE id_pembelian='$value[id_pembelian]'");
        echo "<script>alert('riwayat dengan status batal telah dihapus!');</script>";
        echo "<script>location = 'riwayat.php';</script>";
    } else {
        echo "<script>alert('anda bukan pemilik pembayaran ini!');</script>";
        echo "<script>location = 'riwayat.php';</script>";
    }
}
?>