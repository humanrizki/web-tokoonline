<?php 
session_start();
$id = $_GET['id'];

unset($_SESSION['keranjang'][$id]);
echo "<script>alert('list terakhir telah dihapus, harap memilih barang terlebih dahulu!');</script>";
echo "<script>location = 'index.php';</script>";