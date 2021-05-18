<?php 
$connect = new mysqli('localhost','root','','tkonline');
function upload(){
    global $connect;
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];
    // cek apakah ada tidak gamba
    if($error === 4){
        echo "
            <script>
            alert('pilih gambar terlebih dahulu');
            </script>
        ";
        return false;
    } 

    // cek apakah itu gambar
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
    // apkah ukuran file 
    if ($ukuranFile > 10000000){
        echo "
            <script>
            alert('ukuran gambar anda terlalu besar');
            </script>
        ";
        return false;
    }
    // lolo pengecekan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;
    // var_dump($namaFileBaru); die;
    move_uploaded_file($tmpName, 'img/'.$namaFileBaru);
    // var_dump($namaFile);
    return $namaFileBaru;
}
?>
