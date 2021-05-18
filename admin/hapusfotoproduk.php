<?php 
$id = $_GET['id'];
$id_produk = $_GET['idproduk'];

$ambilfoto = $connect->query("SELECT * FROM produk_foto WHERE id_produk_foto='$id'");
$detailfoto = $ambilfoto->fetch_assoc();
$namafilefoto = $detailfoto['nama_produk_foto'];
unlink("img/".$namafilefoto);

$connect->query("DELETE FROM produk_foto WHERE id_produk_foto='$id'");
echo "<script>alert('gambar berhasil dihapus!');</script>";
echo "<script>location = 'index.php?halaman=detailproduk&id=$id_produk';</script>";
?>