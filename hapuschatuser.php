<?php 
session_start();
include 'koneksi.php';
$id = $_GET['id'];
$ambil = $connect->query("SELECT * FROM chat WHERE id_chat_user='$id'");
// $ambil2 = $connect->query("SELECT * FROM enroll WHERE id_enroll='$id'");
// $ids;
if($ambil->num_rows == 1){
    $connect->query("DELETE FROM chat WHERE id_chat_user='$id'");
    
    $connect->query("DELETE FROM enroll WHERE id_enroll='$pecah[id_enroll]'");
    echo "<script>alert('berhasil menghapus pesan!');</script>";
    echo "<script>location = 'chat.php';</script>";
}
?>