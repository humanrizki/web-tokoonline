<?php
$ambil = $connect->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'"); 
$pecah = $ambil->fetch_assoc();
$fotoproduk = $pecah['foto_produk'];
if(file_exists("img/$fotoproduk")){
    unlink("img/$fotoproduk");
}
$connect->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

echo "<script>
alert('Data berhasil dihapus');
document.location.href = 'index.php?halaman=produk';
</script>";