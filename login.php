<?php 
session_start();
// setcookie('login','true',time() + 50);
// echo $_POST['ingat'];
// setcookie("login","user");
// if(isset($_COOKIE['login'])){
//     header("location: index.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main1.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <?php include 'favicon.php';?>
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
    <title>Login User</title>
</head>
<body>
<?php include 'menu.php';?>
<div class="container  d-block" >
    
            <form action="" method="post">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        LOGIN USER
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email" class="card-title">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-user p-1"></i>
                                    </div>
                                </div>
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="card-title">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock p-1"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control border-end-0" name="password" id="input">
                                <div class="input-group-text bg-white border-start-0">
                                    <!-- <button> -->
                                    <i class="fas fa-eye-slash" id="a"></i>
                                    <!-- </button> -->
                                    </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remember">Remember Me</label>
                            <div class="input-group">
                                <input type="checkbox" name="ingat" id="remember">
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button class="btn btn-success w-100" name="submit" type="submit">LOGIN</button>
                            
                        </div>
                    </div>
                </div>
            </form>
</div>
<?php 
include 'koneksi.php';
if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $ingat = $_POST['ingat'];
    
    $ambil = $connect->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
    if($ambil->num_rows == 1){
        $akun = $ambil->fetch_assoc();
        if(isset($_POST['ingat'])){
            
        }
        $_SESSION['pelanggan'] = $akun;
        if(isset($_SESSION['keranjang'])){
            // echo "<script>alert('Harus belanja dulu!');</script>";
            echo "<script>alert('Login berhasil!');</script>";
            echo "<script>location = 'checkout.php';</script>";

        } else {
            echo "<script>alert('Login berhasil!');</script>";
            echo "<script>location = 'index.php';</script>";
        }
        echo "<script>alert('Login berhasil!');</script>";
        echo "<script>location = 'index.php';</script>";
    } else {
        echo "<script>alert('Login gagal!');</script>";
        echo "<script>location = 'login.php';</script>";
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/43727f9558.js" crossorigin="anonymous"></script>
<?php include 'footer.php';?>
</body>
</html>