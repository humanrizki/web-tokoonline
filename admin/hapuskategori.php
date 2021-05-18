<?php 
$id = $_GET['id'];
$connect->query("DELETE FROM kategori WHERE id_kategori='$id'");
echo "<script>alert('kategori yang dipilih telah dihapus!');</script>";
echo "<script>location = 'index.php?halaman=kategori';</script>";
?>