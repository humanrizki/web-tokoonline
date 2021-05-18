<?php 
session_start();
include 'koneksi.php';
$id_produk = $_GET['id'];
error_reporting(1);
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$ambil = $connect->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();
$ambil1 = $connect->query("SELECT * FROM komentar WHERE id_produk='$id_produk'");
$ambil2 = $connect->query("SELECT * FROM reply");
$umumpesan = [];
while($umumkomen = $ambil2->fetch_assoc()){
    $umumpesan[] = $umumkomen;
}

$detail_komen = [];
while($pecah = $ambil1->fetch_assoc()){
    $detail_komen[] = $pecah;
}
// var_dump($detail_komen);
$namafoto = [];
$gets = $connect->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
while($tiap = $gets->fetch_assoc()){
    $namafoto[] = $tiap;
    // var_dump($namafoto);
} 
$ambil3 = $connect->query("SELECT * FROM bintang WHERE id_produk='$id_produk'");
$ambil4 = $connect->query("SELECT SUM(ukur) AS total FROM bintang WHERE id_produk='$id_produk'");
$jumlah_baris = $ambil3->num_rows;
$pecah3;
while($tiap = $ambil4->fetch_assoc()){
    $pecah3 = $tiap['total'];
}
$pecah2 = [];
$id_pel;
$id_pro; 
while($tiap = $ambil3->fetch_assoc()){
    $pecah2[] = $tiap;
    foreach($pecah2 as $k => $val){
        if($val['id_pelanggan'] == $_SESSION['pelanggan']['id_pelanggan']){
            $id_pel = $val['id_pelanggan'];
            $id_pro = $val['id_produk'];
        }
    }
}
$avg = $pecah3 / $jumlah_baris;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <?php if(count($detail_komen) >= 2):?>
    <link rel="stylesheet" href="css/detail.css">
    <?php endif;?>
    <?php include 'favicon.php';?>
    <title>Detail Barang</title>
</head>
<body style="height: 100%;">
<?php include 'menu.php';?>
<section class="konten my-5 p-2"  >
    <div class="container p-5">
        <div class="row ">
            <?php if(!empty($namafoto)):?>
            <div id="carouselExampleInterval" class="carousel carousel-dark slide col-md-6" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach($namafoto as $key => $value):?>
                        <div class="carousel-item <?= ($key == 0) ? 'active' : '';?>" data-bs-interval="3000">
                            <img src="admin/img/<?= $value['nama_produk_foto'];?>" class="d-block w-50 mx-auto" alt="...">
                        </div>
                    <?php endforeach;?> 
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon text-dark" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <?php else :?>
            <div class="col-md-6">
                <img src="admin/img/<?= $detail['foto_produk'];?>" alt="">
            </div>
            <?php endif;?>
            <div class="col-md-6">
                <h3>Detail Data Produk</h3>
                <table class="table">
                    <tr>
                        <td>Nama</td>
                        <td><?= $detail['nama_produk'];?></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><?= "Rp. ".number_format($detail['harga_produk']);?></td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <?php if($detail['stok_produk'] == 0):?>
                        <td>Habis</td>
                        <?php else : ?>
                        <td><?= $detail['stok_produk']; ?></td>
                        <?php endif;?>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td><?= $detail['deskripsi_produk'];?></td>
                    </tr>
                </table>               
                <?php if($detail['stok_produk'] == 0 ):?> <!-- stok -->        
                        <?php if($id_pel != $id_pelanggan and $id_pro != $id_produk):?>
                            <h5>Rating : </h5>
                            <div class="d-flex"> 
                                <?php for($i = 0; $i < $avg; $i++):?>
                                    <i class="fas fa-star fa-2x my-1" style="color: gold;"></i>
                                <?php endfor;?> 
                                <p class="d-inline fs-4 mx-3"><?= round($avg,2);?></p>
                            </div>  
                            <form action="" method="POST">
                                <div class="row my-2">
                                    <div class="col-md-8">
                                        <select name="bintang" id="" class="form-select">
                                            <option value="">Pilih Bintang</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary col-sm-2" name="save">Rate</button>
                                </div>
                            </form>
                        <?php else:?>
                            <h5>Rating : </h5>
                            <div class="d-flex"> 
                                <?php for($i = 0; $i < $avg; $i++):?>
                                    <i class="fas fa-star fa-2x my-1" style="color: gold;"></i>
                                <?php endfor;?> 
                                <p class="d-inline fs-4 mx-3"><?= round($avg,2);?></p>
                            </div>
                        <?php endif;?>
                        <form action="" method="POST" class="d-none">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" min="1" class="form-control" max="<?= $detail['stok_produk'];?>" name="jumlah" value="1"><button class="btn btn-primary" type="submit" name="beli">Beli</button>
                                </div>
                            </div>
                        </form>                  
                <?php else :?>                             
                        <?php if($id_pel != $id_pelanggan and $id_pro != $id_produk):?>
                            <?php for($i = 0; $i < $avg; $i++):?>
                                    <i class="fas fa-star fa-2x my-1" style="color: gold;"></i>
                            <?php endfor;?> 
                            <p class="d-inline fs-4 mx-3"><?= !empty($avg) ? "Tidak ada rating": 'a';?></p>
                            <?php if(isset($_SESSION['pelanggan'])):?>
                                <form action="" method="POST">
                                    <div class="row my-2">
                                        <div class="col-md-8">
                                            <select name="bintang" id="" class="form-select">
                                                <option value="">Pilih Bintang</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary col-sm-2" name="save">Rate</button>
                                    </div>
                                </form>
                            <?php endif;?>
                        <?php else:?>
                            <h5>Rating : </h5>
                            <div class="d-flex"> 
                                <?php for($i = 0; $i < $avg; $i++):?>
                                    <i class="fas fa-star fa-2x my-1" style="color: gold;"></i>
                                <?php endfor;?> 
                                <p class="d-inline fs-4 mx-3"><?= !empty($avg) ? round($avg,2) : "tidak ada rating";?></p>
                            </div>
                        <?php endif;?>
                            <form action="" method="POST" >
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" min="1" class="form-control" max="<?= $detail['stok_produk'];?>" name="jumlah" value="1"><button class="btn btn-primary" type="submit" name="beli">Beli</button>
                                    </div>
                                </div>
                            </form>                 
                <?php endif;?>
            </div>
        </div>
        <div class="konten my-5" id="container">
            <?php 
            foreach($detail_komen as $value):
            if($value['id_produk'] == $id_produk):?>
            <div class="container bg-light p-2 my-3" >
                <h5>Nama : <?= $value['nama_pelanggan_komen'];?></h5>
                <p>Tanggal : <?= date("d F Y", strtotime($value['tanggal']));?></p>
                <div class="input-group" >  
                    <textarea readonly class="form-control text-dark" rows="1"><?= $value['komentar'];?></textarea>
                    <?php if($_SESSION['pelanggan']['id_pelanggan'] != $value['id_pelanggan']):?>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <a href="balaskomen.php?id=<?= $id_produk;?>&idkomen=<?= $value['id_komen'];?>"><i class="fas fa-reply p-1 fs-4" id="ibalas"></i></a>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if($_SESSION['pelanggan']['id_pelanggan'] == $value['id_pelanggan']):?>
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <a href="hapuskomentar.php?idkomen=<?= $value['id_komen'];?>&idproduk=<?= $id_produk;?>"><i class="fas fa-backspace fs-4 my-auto"></i></a>
                    </div>
                </div>    
                    <?php endif;?>
                    <?php foreach($umumpesan as $values):?>
                    <?php if($values['id_komen'] == $value['id_komen']):
                    ?>
                    <p class="w-100 mt-2">Reply From <?= $values['yang_balas'];?> <?= "○ ". date("d F Y", strtotime($value['tanggal'] ));?></p>
                    <input type="text" readonly name="masukan" class="w-75 form-control" value="<?= $values['reply_komentar'];?>">
                        <?php if($_SESSION['pelanggan']['id_pelanggan'] != $value['id_pelanggan']):?>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <a href="hapuskomentarbalasan.php?idkomen=<?= $values['id_komen'];?>&idproduk=<?= $id_produk?>"><i class="fas fa-backspace fs-4 my-auto"></i></a>
                                </div>
                            </div>            
                            <?php endif;?>
                        <?php endif;?>    
                    <?php endforeach;?>
                </div>
            </div>
            <?php endif;?>
            <?php endforeach;?>
        </div>
        <div class="read d-flex my-3" style="height: 40px;">
            <?php if(!empty($detail_komen)):?>
            <?php if(count($detail_komen) >= 2):?>
            <hr width="82%" class=" my-auto mx-2">
            <p class="text-end text-primary  my-auto" id="read">Read More Comment</p>
            <?php endif;?>
            <?php endif;?>           
        </div>        
        <?php if(isset($_SESSION['pelanggan'])):?>
        <form action="" method="POST" class="my-3 bg-light p-3 rounded">
            <div class="form-group">
                <h3>Masukkan komentar <?= (isset($_SESSION['pelanggan'])) ? $_SESSION['pelanggan']['nama_pelanggan'] : "Anda";?></h3>
                <div class="input-group">
                    <textarea name="komentar" id="" cols="30" rows="5" class="form-control" placeholder="Masukan komentar anda untuk membantu kami agar lebih berkembang lagi!"></textarea>
                </div>
                <div class="input-group my-2 w-100">
                    <button class="btn btn-primary float-right" name="kirim">Add Comment</button>
                </div>
            </div>
        </form>
        <?php endif;?>
    </div>
</section>
<?php include 'footer.php';?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
<?php include 'fontawesome.php';?>
</body>
</html>
<?php if(isset($_POST['beli'])){
                    // mendapatkan id produk dan mendapatkan jumlah diinputkan
    $jumlah = $_POST['jumlah'];
    // masukkan dikeranjang belanja
    $_SESSION['keranjang'][$id_produk] = $jumlah;
    echo "<script>alert('Produk telah masuk ke keranjang belanja!');</script>";
    echo "<script>location = 'keranjang.php';</script>";
} 
if(isset($_POST['kirim'])){
    $komentar = $_POST['komentar'];
    $nama = $_SESSION['pelanggan']['nama_pelanggan'];
    $connect->query("INSERT INTO komentar (id_pelanggan, id_produk, nama_pelanggan_komen, komentar) VALUES ('$id_pelanggan','$id_produk','$nama','$komentar')");
    echo "<script>alert('komentar ditambahkan!');</script>";
}
if(isset($_POST['balas'])){
    $balaskomen = $_POST['balaskomen'];
    $balaskomens = $_POST['balaskomens'];
    $id_balas = $_SESSION['pelanggan']['id_pelanggan'];
    $connect->query("INSERT INTO reply (id_komen, id_pelanggan, reply_komentar) VALUES ('$balaskomens','$id_balas','$balaskomen')");
    echo "<script>alert('balasan telah dikirim!');</script>";
    echo "<script>location = 'detail.php?id=$id_produk';</script>";
}
if (isset($_POST['save'])) {
        $bintang = $_POST['bintang'];
        
        $sesi = $_SESSION['pelanggan']['id_pelanggan'];
        if(isset($_SESSION['pelanggan'])){
            $connect->query("INSERT INTO bintang (id_pelanggan,id_produk, ukur) VALUES ('$sesi','$id_produk','$bintang')");
            echo "<script>alert('sukses menambahkan rating!');</script>";
        }
}
?>