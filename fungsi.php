<?php 
include 'koneksi.php';
function upload2(){   
$namaFile = $_FILES['foto']['name'];
$ukuranFile = $_FILES['foto']['size'];
$error = $_FILES['foto']['error'];
$tmpName = $_FILES['foto']['tmp_name'];
if($error === 4){
    echo "
        <script>
        alert('pilih gambar terlebih dahulu');
        </script>
    ";
    return false;
} 
$ekstensiFileValid = ['jpg','jpeg','png'];
$ekstensiFile = explode('.',$namaFile);
$ekstensiFile = strtolower(end($ekstensiFile));
if(!in_array($ekstensiFile, $ekstensiFileValid)){
    echo "
        <script>
        alert('yang anda upload bukan gambar');
        </script>
    ";
    return false;
}
if ($ukuranFile > 10000000){
    echo "
        <script>
        alert('ukuran gambar anda terlalu besar');
        </script>
    ";
    return false;
}
$namaFileBaru = date("YmdHis");
$namaFileBaru .= '.';
$namaFileBaru .= $ekstensiFile;
move_uploaded_file($tmpName, 'img/'.$namaFileBaru);
return $namaFileBaru;
}
?>