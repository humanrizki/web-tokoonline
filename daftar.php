<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="css/menu.css" >
    <?php include 'favicon.php';?>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#a").on('click',function(){
                if($("#input").attr("type") === "password"){
                    $("#input").attr("type","text");
                } else {
                    $("#input").attr("type","password");
                }
                var i = document.getElementById("a");
                if(i.attributes[0].value === "fas fa-eye-slash"){
                    i.classList.replace("fa-eye-slash","fa-eye");
                } else {
                    i.classList.replace("fa-eye","fa-eye-slash");
                    
                }
            });
        })
    </script>
    <title>Daftar Pelanggan</title>
</head>
<body>
<?php include 'menu.php';?>
<section class="konten p-3 "> 
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-2 col-lg-6 col-lg-offset-3 mx-auto">
        
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pelanggan</h3>
                    </div>
                    <div class="card-body ">
                        <form action="" method="POST">
                            <div class="form-group  row">
                                <div class="labels col-md-2 fs-5" >
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-group col-md-3 " >
                                        <input type="text" name="email" id="email" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group  row my-3">
                                <div class="labels col-md-2 fs-5" style="margin-right: 0px">
                                    <label for="password">Password</label>
                                </div>
                                <div class="input-group col-md-2 ">
                                    <input type="password" name="password" id="input" class="form-control border-end-0">
                                    <div class="input-group-text bg-white border-start-0">
                                    <i class="fas fa-eye-slash" id="a"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  row my-3">
                                <div class="labels col-md-2  fs-5">
                                    <label for="name">Name</label>
                                </div>
                                <div class="input-group col-md-2 ">
                                    <input type="text" name="name" id="name" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group  row my-3">
                                <div class="labels col-md-2 fs-5 ">
                                    <label for="telepon" >Telepon</label>
                                </div>
                                <div class="input-group col-md-2 ">
                                    <input type="text" name="telepon" id="telepon" class="form-control">
                                </div>
                            </div>
                            <div class="form-group  row my-3">
                                <div class="labels col-md-2 fs-5">
                                    <label for="alamat" >Alamat</label>
                                </div>
                                <div class="input-group col-md-2 ">
                                    <textarea type="text" name="alamat" id="alamat" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row my-3">
                                <div class="pencet2 col-md-12 ">
                                    <button class="btn btn-success w-100" name="save">Daftar</button>
                                </div>
                            </div>
                        </form>
                            <?php 
                                if(isset($_POST['save'])){
                                    $email = $_POST['email'];
                                    $password = $_POST['password'];
                                    $nama = $_POST['name'];
                                    $telepon = $_POST['telepon'];
                                    $alamat = $_POST['alamat'];
                                    $ambil2 = $connect->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                                    if($ambil2->num_rows == 1){
                                        echo "<script>alert('akun sudah ada!');</script>";
                                        echo "<script>location = 'daftar.php';</script>";
                                    } else {
                                        $connect->query("INSERT INTO pelanggan (id_pelanggan, email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat_pelanggan) VALUES ('','$email','$password','$nama','$telepon','$alamat')");
                                        echo "<script>alert('pengguna baru telah ditambahkan!');</script>";
                                        echo "<script>location = 'login.php';</script>";
                                    }
                                }
                            ?>
                    </div>
                    <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<?php include 'footer.php';?>
</body>
</html>