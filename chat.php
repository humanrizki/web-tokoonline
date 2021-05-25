<?php 
session_start();
include 'koneksi.php';
$admin = $_SESSION['admin'];
if(!isset($_SESSION['admin'])){
    echo "<script>alert('admin sedang tidak aktif, tunggu beberapa saat dan coba lagi!');</script>";
    echo "<script>location = 'account.php';</script>";
}
$user = $_SESSION['pelanggan'];
$chat_id = $_SESSION['pelanggan']['id_pelanggan'];
$message = $_SESSION['admin']['id_admin'];
$ambil = $connect->query("SELECT * FROM chat");
$ambil2 = $connect->query("SELECT * FROM message");
$count = $ambil->num_rows;
$count2 = $ambil2->num_rows;
$pecah = [];
$pecah2 = [];
$pecah3 = [];
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
} else {
    $_SESSION['id'] = 1;
}
// var_dump($pecah);
$ambil3 = $connect->query("SELECT * FROM enroll");
    while($tiap = $ambil3->fetch_assoc()){
        $pecah3[] = $tiap;
    }
    $ambil4;
    $pecah4 = [];
    $ambil5;
    $pecah5 = [];
    foreach($pecah3 as $key => $value){
        
        
        
    }
    $ambil4 = $connect->query("SELECT * FROM chat JOIN enroll ON chat.id_enroll=enroll.id_enroll ");
    $ambil5 = $connect->query("SELECT * FROM message JOIN enroll ON message.id_enroll=enroll.id_enroll ");
    error_reporting(1);
    while($tiap = $ambil4->fetch_assoc()){
        $pecah4[] = $tiap;
    }
    while($tiap = $ambil5->fetch_assoc()){
        $pecah5[] = $tiap;
    }
?>
<pre>
<?php echo var_dump($pecah4);?>
</pre>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <?php include 'favicon.php';?>
    <style>
    
    div.isinya2{
        display: block;
        width: 50%;
        position: relative;
        background-color: #292b2c;
        }
    div.isinya2::before{
        content: "";
        display: block;
        width: 30px;
        height: 30px;
        clip-path: polygon(0 0, 100% 100%, 100% 0);
        position: absolute;
        top: 0px;
        left: -20px;
        background-color: #292b2c;
        }
        div.isinya1{
        display: block;
        width: 50%;
        position: relative;
        background-color: rgb(2, 117, 216);
        }
    div.isinya1::after{
        content: "";
        display: block;
        width: 30px;
        height: 30px;
        z-index: 0;
        background-color: rgb(2, 117, 216);
        clip-path: polygon(0 0, 0 100%, 100% 0);
        position: absolute;
        top: 0px;
        right: -20px;
        border-radius: 5px;
        }
        @media screen and (max-width: 600px){
        div.isinya2{
        display: block;
        width: 90%;
        position: relative;
        /* background-color: grey; */
        }
        div.isinya1{
        display: block;
        width: 90%;
        position: relative;
        
        }
        
    }
    </style>
    <title>Halaman Chatting</title>
</head>
<body>
    <div class="container my-2">
        <h4>Halaman Chat</h4>
        <div class="linkup">
            <div class="brand bg-light p-3 d-block clearfix">
                <img src="user(2).png" alt="" class="d-block float-start me-3" width="50" height="50">
                <p class="fs-3 d-block ms-5 my-auto "><?= $admin['fullname'];?></p>
                <p class="fs-5 ms-1 float-start"><i class="fas fa-circle text-success me-2"></i><?= isset($admin) ? "online": "offline";?></p>
            </div>
            <div class="body bg-white" >
                <div class="riwayatchat p-2" style="height: 480px; overflow-y: auto;">
                    <?php foreach($pecah3 as $key => $value):?>
                        <?php if(($value['id_pelanggan'] == $_SESSION['pelanggan']['id_pelanggan']) and ($value['id_admin'] == $_SESSION['admin']['id_admin'])):?>
                            <?php foreach($pecah4 as $kt => $vt):?>
                                <?php if($vt['id_enroll'] == $value['id_enroll'] or ($value['id_pelanggan'] == $_SESSION['pelanggan']['id_pelanggan'] and $value['id_admin'] == $_SESSION['admin']['id_admin'])):?>
                                        <?php if(empty($vt['pesan_admin'])):?>    
                                            <div class="isinya1 p-2 ms-2 mt-2 me-4 mb-2  float-end rounded shadow">
                                                <?php if(!empty($user['foto_pelanggan'])):?>
                                                    <img src="img/<?= $user['foto_pelanggan'];?>" alt="" width="25" height="25" >
                                                <?php else:?>
                                                    <img src="user(2).png" alt="" width="25" height="25" >
                                                <?php endif;?>
                                                <p class="d-inline text-white"><?= date("d F Y", strtotime($vt['waktu_user']));?></p>
                                                <a href="hapuschatuser.php?id=<?= $vt['id_chat_user'];?>" class="float-end" style="width:fit-content; height:fit-content"><i class="fas text-white fa-window-close py-1 px-1 fs-4" style="width: fit-content; height:fit-content"></i></a>
                                                <p class="d-block text-white mt-2 ms-1"><?= $vt['pesan_user'];?></p>
                                            </div>
                                        <?php else:?>
                                            <div class="isinya1 p-2 ms-2 mt-2 me-4 mb-2 float-end rounded shadow">
                                                <?php if(!empty($user['foto_pelanggan'])):?>
                                                    <img src="img/<?= $user['foto_pelanggan'];?>" alt="" width="25" height="25" >
                                                <?php else:?>
                                                    <img src="user(2).png" alt="" width="25" height="25" >
                                                <?php endif;?>
                                                <p class="d-inline text-white"><?= date("d F Y", strtotime($vt['waktu_user']));?></p>
                                                <a href="hapuschatuser.php?id=<?= $vt['id_chat_user'];?>" class="float-end" style="width:fit-content; height:fit-content"><i class="fas text-white fa-window-close py-1 px-1 fs-4" style="width: fit-content; height:fit-content"></i></a>
                                                <a href="balaschatadmin.php?id=<?= $vt['id_message'];?>" class="float-end"><i class="fas fa-reply p-1 fs-4" id="ibalas"></i></a>
                                                <div class="pesan-baru-user bg-white rounded border border-top-0 border-right-0 border-bottom-0 border-left border-primary" style="width: 90%; height:fit-content;">
                                                <p class="mt-4 mb-0 ms-2 py-2 "><?= $vt['pesan_admin'];?></p>
                                                </div>
                                                <p class="d-block text-white mt-1 ms-2"><?= $vt['pesan_user'];?></p>
                                            </div>
                                        <?php endif;?>
                                <?php endif;?>    
                            <?php endforeach;?>          
                            <?php foreach($pecah5 as $ks => $vs):?>
                                <?php if($ks == 0):?>
                                <?php if($vs['id_enroll'] == $value['id_enroll'] or ($value['id_pelanggan'] == $_SESSION['pelanggan']['id_pelanggan'] and $value['id_admin'] == $_SESSION['admin']['id_admin'])):?>
                                        <?php if(empty($vs['pesan_user'])):?>
                                            <div class="isinya2 p-2 ms-4 mt-2 me-2 mb-2 float-start rounded shadow">
                                                <img src="user(2).png" alt="" width="25" height="25" >
                                                <p class="d-inline text-white"><?= date("d F Y", strtotime($vs['waktu_admin']));?></p>
                                                <a href="balaschatadmin.php?id=<?= $vs['id_message'];?>" class="float-end"><i class="fas fa-reply p-1 fs-4" id="ibalas"></i></a>
                                                <p class="d-block text-white mt-2 ms-2"><?= $vs['pesan_admin'];?></p>
                                            </div>
                                        <?php else:?>
                                            <div class="isinya2 p-2 ms-4 mt-2 me-2 mb-2 float-start rounded shadow">
                                                <img src="user(2).png" alt="" width="25" height="25" >
                                                <p class="d-inline text-white"><?= date("d F Y", strtotime($vs['waktu_admin']));?></p>
                                                <a href="balaschatadmin.php?id=<?= $vs['id_message'];?>" class="float-end"><i class="fas fa-reply p-1 fs-4" id="ibalas"></i></a>
                                                <div class="pesan-baru-user bg-white rounded" style="width: 90%; height:fit-content;">
                                                <p class="mt-4 mb-0 ms-2 py-2 "><?= $vs['pesan_user'];?></p>
                                                </div>
                                                <p class="d-block text-white mt-1 ms-2"><?= $vs['pesan_admin'];?></p>
                                            </div>
                                        <?php endif;?>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
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
</body>
</html>
<?php 
    if(isset($_POST['kirim'])){
        $chat = $_POST['chat'];
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $id_admin = $_SESSION['admin']['id_admin'];
        $ambil3 = $connect->query("SELECT * FROM enroll WHERE id_admin='$id_admin' and id_pelanggan='$id_pelanggan'");
        $ambil4;
        $id_barusan;
        if($ambil3->num_rows == 0){
            $connect->query("INSERT INTO enroll (id_enroll, id_admin, id_pelanggan ) VALUES (1,'$id_admin','$id_pelanggan')");
            while($tiap = $ambil3->fetch_assoc()){
                $id_barusan = $tiap['id_enroll'];
            }
            
        } else {
            $ambil4 = $connect->query("SELECT * FROM enroll WHERE id_admin='$id_admin' and id_pelanggan='$id_pelanggan'");
            // $i = 1;
            while($tiap = $ambil4->fetch_assoc()){
                $id_barusan = $tiap['id_enroll'] ;
                $id_barusan++;
                
            }
            $connect->query("INSERT INTO enroll (id, id_enroll, id_admin, id_pelanggan) VALUES ('','$id_barusan','$id_admin','$id_pelanggan')");
        }
        $connect->query("INSERT INTO chat (id_chat_user, id_enroll, id_pelanggan, id_admin, pesan_user) VALUES ('','$id_barusan','$id_pelanggan', '$id_admin', '$chat')");
        echo "<script>alert('chat telah dikirim!');</script>";
        echo "<script>location = 'chat.php';</script>";
    }    
    ?>