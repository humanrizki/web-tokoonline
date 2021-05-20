<?php 
session_start();
include '../koneksi.php';
$admin = $_SESSION['admin'];
if(!isset($_SESSION['admin'])){
    echo "<script>alert('admin sedang tidak aktif, tunggu beberapa saat dan coba lagi!');</script>";
    echo "<script>location = 'account.php';</script>";
}
$user = $_SESSION['pelanggan'];
$chat_id = $_SESSION['pelanggan']['id_pelanggan'];
$ambil = $connect->query("SELECT * FROM chat");
$ambil2 = $connect->query("SELECT * FROM message");
// $ambil3;
$count = $ambil->num_rows;
$count2 = $ambil2->num_rows;
$pecah = [];
$pecah2 = [];
$pecah3 = [];
$temp = [];
if($count > 0){
    while($tiap = $ambil->fetch_assoc()){
        $pecah[] = $tiap;
    }
} else {
    $_SESSION['id'] = 1;
}
if($count2 > 0){
    while($tiap = $ambil2->fetch_assoc()){
        $pecah2[] = $tiap;
    }
} 
    $ambil3 = $connect->query("SELECT * FROM enroll");
    while($tiap = $ambil3->fetch_assoc()){
        $pecah3[] = $tiap;
    }
    echo "<pre>";
    var_dump($pecah3);
    echo "</pre>";
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
                <img src="../user(2).png" alt="" class="d-block float-start me-3" width="50" height="50">
                <p class="fs-3 d-block ms-5 my-auto "><?= $admin['fullname'];?></p>
                <p class="fs-5 ms-1 float-start"><i class="fas fa-circle text-success me-2"></i><?= isset($admin) ? "online": "offline";?></p>
            </div>
            <div class="body bg-white border" style="margin-bottom: 200px;">
                <div class="riwayatchat " style="height: 480px; overflow-y: auto;">
                            <?php 
                            $i = 1;
                            foreach($pecah3 as $ks){
                                $temp[] = $ks['id_enroll'];
                            }
                            var_dump($temp);
                            foreach($pecah2 as $keys => $values):?>
                                <?php if(!empty($temp[$i]) == $values['id_enroll']):?>
                                    <div class="isinya bg-primary p-2 m-2 w-50 float-end rounded shadow">
                                        <img src="../user(2).png" alt="" width="25" height="25" >
                                        <p class="d-inline text-white"><?= date("d F Y", strtotime($values['waktu_admin']));?></p>
                                        <a href="hapuschatuser.php?id=<?= $value['id_chat_user'];?>" class="btn btn-danger float-end" style="width:fit-content; height:fit-content"><i class="fas fa-window-close py-1"></i></a>
                                        <p class="d-block text-white mt-2" cols="30" rows="1" readonly><?= $values['pesan_admin'];?></p>
                                    </div>
                                <?php elseif($value['id_enroll'] == $values['id_enroll']):?>
                                    <div class="isinya bg-primary p-2 m-2 w-50 float-end rounded shadow">
                                        <img src="../user(2).png" alt="" width="25" height="25" >
                                        <p class="d-inline text-white"><?= date("d F Y", strtotime($values['waktu_admin']));?></p>
                                        <a href="hapuschatuser.php?id=<?= $value['id_chat_user'];?>" class="btn btn-danger float-end" style="width:fit-content; height:fit-content"><i class="fas fa-window-close py-1"></i></a>
                                        <p class="d-block text-white mt-2" cols="30" rows="1" readonly><?= $values['pesan_admin'];?></p>
                                    </div>
                                <?php endif;?>
                                
                    <?php foreach($pecah as $key => $value):?>
                                <div class="isinya bg-info p-2 m-2 w-50 float-start rounded shadow">
                                <img src="../img/<?= $user['foto_pelanggan'];?>" alt="" width="25" height="25" >
                                <p class="d-inline text-white"><?= date("d F Y", strtotime($value['waktu_user']));?></p>
                                
                                <p class="d-block text-white mt-2" readonly><?= $value['pesan_user'];?></p>
                                
                                </div>
                        
                        
                    <?php endforeach;?>  
                            <?php 
                            $i++;
                            endforeach;?>
                </div>
                <div class="pesan w-100 " >
                    <form action="" method="POST" class="container bg-light rounded py-3 clearfix" >
                        <div class="form-group" >
                            <div class="input-group">
                                <textarea name="chat" id="" cols="30" rows="5" class="form-control" placeholder="Ketik beberapa pesan untuk admin!"></textarea>
                            </div>
                            <div class="form-group my-2">
                                <button class="btn btn-primary float-start" name="kirim">Chat</button>
                                <a href="account.php" class="btn btn-info float-end text-white"> Kembali ke akun</a> 
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
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $id_admin = $_SESSION['admin']['id_admin'];
        $ambil3 = $connect->query("SELECT * FROM enroll WHERE id_admin='$id_admin' and id_pelanggan='$id_pelanggan'");
        $ambil4;
        global $id_barusan;
        if($ambil3->num_rows == 0){
            $connect->query("INSERT INTO enroll (id_enroll, id_admin, id_pelanggan ) VALUES (1,'$id_admin','$id_pelanggan')");
            $id_barusan = $connect->insert_id;
        } else {
            $ambil4 = $connect->query("SELECT * FROM enroll WHERE id_admin='$id_admin' and id_pelanggan='$id_pelanggan'");
            $i = 1;
            while($tiap = $ambil4->fetch_assoc()){
                $id_barusan = $tiap['id_enroll'] ;
                $id_barusan += $i;
                $i++;
            }
            $connect->query("INSERT INTO enroll (id_enroll, id_admin, id_pelanggan ) VALUES ('$id_barusan','$id_admin','$id_pelanggan')");
        }
        $connect->query("INSERT INTO message (id_message, id_enroll, id_admin, pesan_admin) VALUES ('','$id_barusan','$id_admin', '$chat')");
        echo "<script>alert('chat telah dikirim!');</script>";
        echo "<script>location = 'chat.php';</script>";
    }    
    ?>
</body>
</html>