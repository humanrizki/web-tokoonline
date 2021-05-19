<?php 
session_start();
include '../koneksi.php';
$admin = $_SESSION['admin'];
$user = $_SESSION['pelanggan'];
$chat_id = $_GET['id'];
$ambil = $connect->query("SELECT * FROM chat WHERE id_chat_user='$chat_id'");
$ambil2 = $connect->query("SELECT * FROM reply_chat");
$pecah = [];
$pecah2 = [];
while($tiap = $ambil->fetch_assoc()){
    $pecah[] = $tiap;

}
$id = end($pecah);
while($tiap = $ambil2->fetch_assoc()){
    $pecah2[] = $tiap;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <?php include '../favicon.php';?>
    <title>Halaman Chatting</title>
</head>
<body>
    <div class="container my-2">
        <h4>Halaman Chat</h4>
        <div class="linkup">
            <div class="brand bg-light p-3 d-block clearfix">
            <?php if(empty($user['foto_pelanggan'])):?>
                    <img src="../user(2).png" alt="" width="50" height="50" class="float-start">
                    <?php else:?>
                    <img src="../img/<?= $user['foto_pelanggan'];?>" alt="" width="50" height="50" class="float-start">
                    <?php endif;?>
                <p class="fs-3 d-inline ms-3 my-auto "><?= $user['nama_pelanggan'];?></p>
                <p class="fs-5 ms-5 d-block"><i class="fa fa-circle text-success ms-3 me-2"></i><?= isset($admin) ? "online": "offline";?></p>
            </div>
            <div class="body bg-white border" style="margin-bottom: 200px;">
                <div class="riwayatchat " style="height: 480px; overflow-y: auto;">
                    <?php foreach($pecah as $key => $value):?>
                                <div class="isinya bg-primary p-2 m-2 w-50 float-start rounded shadow">
                                <?php if(empty($user['foto_pelanggan'])):?>
                                <img src="../user(2).png" alt="" width="25" height="25" >
                                <?php else:?>
                                <img src="../img/<?= $user['foto_pelanggan'];?>" alt="" width="25" height="25" >
                                <?php endif;?>
                                <p class="d-inline text-white"><?= date("d F Y", strtotime($value['waktu']));?></p>
                                <p class="d-block text-white mt-2" cols="30" rows="1" readonly><?= $value['pesan'];?></p>
                                
                                </div>
                                <?php foreach($pecah2 as $keys => $values):?>
                                <?php if($value['id_chat'] == $values['id_chat']):?>
                                    <div class="isinya bg-info p-2 m-2 w-50 float-end rounded shadow">
                                        <img src="../user(2).png" alt="" width="25" height="25" >
                                        <p class="d-inline text-white"><?= date("d F Y", strtotime($value['waktu']));?></p>
                                        <p class="d-block text-white mt-2" cols="30" rows="1" readonly><?= $values['pesan'];?></p>
                                    </div>
                                <?php endif;?>
                    <?php endforeach;?>   
                        
                    
                        <?php endforeach;?>  
                </div>
                <div class="pesan w-100 " >
                    <form action="" method="POST" class="container bg-light rounded py-3 clearfix" >
                        <div class="form-group " >
                            <div class="input-group">
                                <textarea name="chat" id="" cols="30" rows="5" class="form-control" placeholder="Masukan komentar anda untuk membantu kami agar lebih berkembang lagi!"></textarea>
                            </div>
                            <div class="form-group my-2">
                                <button class="btn btn-primary float-start" name="kirim">Chat</button>
                                <a href="index.php?halaman=pelanggan" class="btn btn-info float-end text-white"> Kembali ke akun</a> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<?php 
    if(isset($_POST['kirim'])){
        $chat = $_POST['chat'];
        $idnya = $id['id_chat'];
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $connect->query("INSERT INTO reply_chat (id_reply_chat, id_chat, pesan) VALUES ('','$idnya','$chat')");
        echo "<script>alert('chat telah dikirim!');</script>";
        echo "<script>location = chat.php?id=".$chat_id.";</script>";
    }    
    ?>
</body>
</html>