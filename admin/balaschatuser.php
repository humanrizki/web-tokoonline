<?php 
session_start();
include '../koneksi.php';
$id = $_GET['id'];
$ambil = $connect->query("SELECT * FROM chat WHERE id_chat_user='$id'");
$pecah_akun = $ambil->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <?php include 'favicon.php';?>
    <title>Detail Barang</title>
</head>
<body style="height: 100%;">
<section class="konten my-5 p-2"  >
    <div class="container p-5">
        
        
        <div class="container bg-light p-2 my-3" >
            <h5>Nama User : <?= $_SESSION['pelanggan']['nama_pelanggan'];?></h5>
            <p>Tanggal : <?= date("d F Y", strtotime($pecah_akun['waktu_user']));?></p>
            <div class="input-group" >  
                <textarea readonly class="form-control text-dark" rows="1"><?= $pecah_akun['pesan_user'];?></textarea>
                
            </div>          
        </div>
        
            
        <?php if(isset($_SESSION['pelanggan'])):?>
        <form action="" method="POST" class="my-3 bg-light p-3 rounded">
            <div class="form-group">
                <h3>Reply Chat Anda</h3>
                <div class="input-group">
                    <textarea name="chat" id="" cols="30" rows="5" class="form-control" placeholder="ingin mereply?"></textarea>
                </div>
                <div class="input-group my-2 w-100">
                
                <button class="btn btn-primary float-right" name="balas">Reply Chat</button>
                </div>
            </div>
        </form>
        <?php endif;?>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>

</body>
</html>
<?php 
if(isset($_POST['balas'])){
    $chat = $_POST['chat'];
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $id_admin = $_SESSION['admin']['id_admin'];
        $ambil3 = $connect->query("SELECT * FROM enroll WHERE id_admin='$id_admin' and id_pelanggan='$id_pelanggan'");
        $ambil4;
        $id_barusan;
        if($ambil3->num_rows == 0){
            $connect->query("INSERT INTO enroll (id_enroll, id_admin, id_pelanggan ) VALUES (1,'$id_admin','$id_pelanggan')");
            $id_barusan = $connect->insert_id;
        } else {
            $ambil4 = $connect->query("SELECT * FROM enroll WHERE id_admin='$id_admin' and id_pelanggan='$id_pelanggan'");
            // $i = 1;
            while($tiap = $ambil4->fetch_assoc()){
                $id_barusan = $tiap['id_enroll'] ;
                $id_barusan++;
                // $i++;
            }
            $connect->query("INSERT INTO enroll (id_enroll, id_admin, id_pelanggan ) VALUES ('$id_barusan','$id_admin','$id_pelanggan')");
        }
        $pesan_user = $pecah_akun['pesan_user'];
        $connect->query("INSERT INTO message (id_message, id_enroll, id_chat_user, id_admin, pesan_admin, pesan_user) VALUES ('','$id_barusan', '$id', '$id_admin', '$chat', '$pesan_user')");
        echo "<script>alert('chat telah dikirim!');</script>";
        echo "<script>location = 'chat.php';</script>";
}
?>