<?php 
session_start();
include '../koneksi.php';
$id = $_GET['id'];
$ambil = $connect->query("SELECT * FROM message WHERE id_message='$id'");
$pecah = $ambil->fetch_assoc();
// $ambil2 = $connect->query("SELECT * FROM enroll WHERE id_enroll='$id'");
// $ids;
if($ambil->num_rows == 1){
    $connect->query("DELETE FROM message WHERE id_enroll='$pecah[id_enroll]'");
    
    $connect->query("DELETE FROM enroll WHERE id_enroll='$pecah[id_enroll]'");
    echo "<script>alert('berhasil menghapus pesan!');</script>";
    echo "<script>location = 'chat.php';</script>";
}
?>