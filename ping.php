<?php 
session_start();
include 'koneksi.php';
$id = $_SESSION['pelanggan']['id_pelanggan'];
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
<body >
<section class="konten my-5 p-2"  >
    <div class="container p-5">
        
        <?php if(isset($_SESSION['pelanggan'])):?>
        <form action="" method="POST" class="my-3 bg-light p-3 rounded">
            <div class="form-group">
                <h3>Masukkan pesan penting untuk admin</h3>
                <div class="input-group">
                    <textarea name="ping" id="" cols="30" rows="5" class="form-control" placeholder="Anda ingin memberi masukan untuk orang lain?"></textarea>
                </div>
                <div class="input-group my-2 w-100">
                
                <button class="btn btn-primary float-right" name="kirim">Give Message</button>
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
if(isset($_POST['kirim'])){
    $ping = $_POST['ping'];
    $connect->query("INSERT INTO ping (id_ping, id_pelanggan, ping) VALUES ('','$id','$ping')");
    echo "<script>alert('pesan telah dikirim!');</script>";
    echo "<script>location = 'account.php';</script>";
}
?>