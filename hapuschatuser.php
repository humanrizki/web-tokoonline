<?php 
session_start();
include 'koneksi.php';
$id = $_GET['id'];
$ambil = $connect->query("SELECT * FROM chat WHERE id_enroll='$id'");
$ambil2 = $connect->query("SELECT * FROM message WHERE id_enroll='$id'");
$ids;
if($ambil->num_rows == 1){
    $connect->query("DELETE FROM chat WHERE id_enroll='$id'");
    while($tiap = $ambil2->fetch_assoc()){
        $ids = $tiap['id_message'];
    }
    $connect->query("UPDATE message SET id_enroll=id_enroll - 1 WHERE id_message='$ids'");
    echo "<script>alert('berhasil menghapus pesan!');</script>";
    echo "<script>location = 'chat.php';</script>";
}
?>