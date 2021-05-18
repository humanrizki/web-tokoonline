<?php 
session_start();
include 'koneksi.php';
if(!isset($_SESSION['pelanggan'])){
    echo "<script>alert('harus login dulu!');</script>";
    echo "<script>location = 'detail.php?id=$id_produk';</script>";
} else {

    $idkomen = $_GET['idkomen'];
    $id_produk = $_GET['idproduk'];
    $connect->query("DELETE FROM komentar WHERE id_komen='$idkomen'");
    echo "<script>alert('komentar berhasil dihapus!');</script>";
    echo "<script>location = 'detail.php?id=$id_produk';</script>";

}
?>