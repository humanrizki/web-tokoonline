<?php 
session_start();
include 'koneksi.php';
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$ambil = $connect->query("SELECT * FROM pembelian JOIN pembelian_produk ON pembelian.id_pembelian=pembelian_produk.id_pembelian WHERE pembelian.id_pelanggan='$id_pelanggan'");
$detail = [];
while($tiap = $ambil->fetch_assoc()){
    $detail[] = $tiap;
}
$detail_id = [];
$pecah = [];
foreach($detail as $value){
    $detail_id[] = $value['id_produk'];
}
foreach($detail_id as $v){
    $ambil = $connect->query("SELECT * FROM produk WHERE id_produk='$v'");
    $pecah[] = $ambil->fetch_assoc();
}
$ambil2 = $connect->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah_akun = $ambil2->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <?php include 'favicon.php';?>
    <script>
        $(document).ready(function(){
            $("button#a").click(function(){
                if($("#input").attr("type") === "password"){
                    $("#input").attr("type","text");
                } else {
                    $("#input").attr("type","password");
                }
                var i = document.getElementById("i");
                if(i.attributes[0].value === "fas fa-lock"){
                    i.classList.replace("fa-lock","fa-unlock");
                } else {
                    i.classList.replace("fa-unlock","fa-lock");
                    
                }
            });
        })
    </script>
    <?php include 'favicon.php';?>
    <title>Halaman Akun</title>
</head>
<body>
    <?php include 'menu.php';?>
    <div class="container-fluid" >
        <div class="container">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="foto d-flex flex-column justify-content-center align-items-center mb-3" style="height: 300px;">
                    <?php if($pecah_akun['foto_pelanggan'] != ''):?>
                        <img src="img/<?= $pecah_akun['foto_pelanggan'];?>" alt="" class="rounded-circle shadow-lg mt-5" width="200" height="200">
                        <h3 class="text-primary my-2"><?= $pecah_akun['nama_pelanggan'];?></h3>
                    <?php else:?>
                        <img src="user(2).png" alt="" class="rounded-circle shadow-lg mt-5" width="200" height="200">
                        <h3 class="text-primary my-2"><?= $pecah_akun['nama_pelanggan'];?></h3>
                    <?php endif;?>
                    </div>
                    <div class="col w-100">
                        <div class="accordion accordion-flush position-relative" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Kebijakan privasi
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body"> Kami selalu memperhatikan bagaimana keamanan privasi anda dalam membeli produk yang kami jual <code><a href="index.php">Kami</a></code> harap kalian akan lebih tenang dengan kebijakan privasi yang telah kami buat.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Memberikan kepuasan untuk membeli
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body mb-3">Kami menjamin produk kami akan selalu menarik perhatian dan berkomitmen menarik lebih banyak khalayak untuk berbelanja.</div>
                                </div>
                            </div>
                            
                            </div>
                        </div>
                </div>
                <div class="col-md-6 position-relative my-5" >
                    <div class="isi">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Email</th>
                                <td><?= $pecah_akun['email_pelanggan'];?></td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td><?= $pecah_akun['telepon_pelanggan'];?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?= $pecah_akun['alamat_pelanggan'];?></td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>
                                    <div class="input-group">
                                        <input type="password" id="input" class="form-control bg-white" readonly value="<?= $pecah_akun['password_pelanggan'];?>">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <button class="btn" id="a"><i class="fas fa-lock" id="i"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="content-pem">
                            <h3>Barang yang sudah pernah dibeli</h3>
                            <div class="row my-3">
                                <?php if(!empty($pecah)):?>
                                
                                <?php foreach($pecah as $key => $value):?>
                                <?php if($key < 4):?>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <a href="detail.php?id=<?= $value['id_produk'];?>">
                                    <img src="admin/img/<?= $value['foto_produk'];?>" alt="" width="100" class="img-responsive"></a>
                                </div>
                                <?php endif;?>
                                <?php endforeach;?>
                                <?php else:?>
                                <div class="col-md-12">
                                    <h5 class="text-muted"><em> Masih belom ada riwayat detil barang yang dibeli!</em></h5>
                                </div>
                                <?php endif;?>
                                <div class="col-md-8 offset-2">
                                    <a href="riwayatbarang.php" class="btn btn-primary fs-5">Lihat data riwayat barang full! <i class="fas fa-history fa-1x"></i></a>
                                </div>
                            </div>
                            <hr>
                            <a href="rubahakun.php" class="btn btn-warning text-white">Ubah data diakun <i class="fas fa-pencil-alt"></i></a>
                            <?php if(isset($_SESSION['admin'])):?>
                            <a href="chat.php" class="btn btn-primary">Chat dengan admin : <i class="fas fa-user ms-2"></i>
                            </a>
                            <?php else:?>
                            <a href="ping.php" class="btn btn-danger">beritahu admin : <i class="fas fa-user ms-2"></i>
                            </a>
                            <?php endif;?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>