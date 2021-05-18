<?php 
session_start();
$id_produk = $_GET['id'];
if($_SESSION['keranjang'][$id_produk] >= 1){
    $_SESSION['keranjang'][$id_produk] -= 1;
    echo "<script>alert('list berhasil dihapus!');</script>";
    echo "<script>location = 'keranjang.php';</script>";
} 
?>