<?php 
session_start();
include '../koneksi.php';
    $idkomen = $_GET['idkomen'];
    $id_produk = $_GET['idproduk'];
    $connect->query("DELETE FROM komentar WHERE id_komen='$idkomen'");
    echo "<script>alert('komentar berhasil dihapus!');</script>";
    echo "<script>location = 'index.php?halaman=detailproduk&id=$id_produk';</script>";
?>