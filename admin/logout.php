<?php 
session_destroy();
echo "<script>alert('berhasil logout');</script>";
echo "<script>location = 'login.php';</script>";
?>