<?php
session_start();
include 'koneksi.php';
$id_pembelian = $_GET['id'];
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$ambil = $connect->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan JOIN pembelian_produk ON pembelian.id_pembelian=pembelian_produk.id_pembelian WHERE pembelian.id_pelanggan='$id_pelanggan'");
$pecah =[];
while($tiap = $ambil->fetch_assoc()){
    $pecah[] = $tiap;
}
$pecah2 = [];
$ambil2 = $connect->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$id_pembelian'");
while($tiap = $ambil2->fetch_assoc()){
    $pecah2[] = $tiap;
}
echo "<pre>";
        var_dump($pecah2);
        echo "</pre>";
foreach($pecah as $key){
    foreach($pecah2 as $keys){
        if($key['id_pelanggan'] == $_SESSION['pelanggan']['id_pelanggan']){
            if($key['id_pembelian'] == $keys['id_pembelian']){
                if($key['id_produk'] == $keys['id_produk']){
                    $connect->query("UPDATE pembelian SET status_pembelian='batal' WHERE id_pembelian='$id_pembelian'");
                    $connect->query("UPDATE produk SET stok_produk=stok_produk + 1 WHERE id_produk='$keys[id_produk]'");
                    echo "<script>alert('pembayaran telah dibatalkan!');</script>";
                    echo "<script>location = 'riwayat.php';</script>";
                }                  
            }
        }  else {
            echo "<script>alert('hanya pelanggan yang asli bisa melakukan ini!');</script>";
            echo "<script>location = 'riwayat.php';</script>";
        }
    }    
}
?>