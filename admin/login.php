<?php  
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css"> -->
    <link rel="stylesheet" href="assets/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
    <div class="d-block container w-25 position-absolute top-50 start-50 translate-middle bg-light p-3">
        <form action="" method="POST">
        <?php 
        $connect = new mysqli('localhost','root','','tkonline');
        ?>
        <?php if(isset($_POST['submit'])):
            $username = $_POST['username'];
            $password = $_POST['password'];
            $ambil = $connect->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
                if($ambil->num_rows == 1):
                $_SESSION['admin'] = $ambil->fetch_assoc();
                ?>
                    <div class="alert alert-info">Login berhasil</div>
                    <meta http-equiv="refresh" content="1;url='index.php'>">
                <?php else :?>
                    <div class="alert alert-danger">Login gagal</div>
                    <meta http-equiv="refresh" content="1;url='login.php'>">
                <?php endif;?>
        <?php endif;?>
            <div class="form-group">
                <h3 class="text-center">LOGIN ADMIN</h3>
            </div>
            <hr>
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user p-1"></i>
                        </div>
                    </div>
                    <input type="text" name="username" id="username" class="form-control ">
                </div>
            </div>
            <div class="form-group mt-2">
                <label for="password">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-lock p-1"></i>
                        </div>
                    </div>
                    <input type="password" name="password" id="password" class="form-control ">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>
    </div>
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://kit.fontawesome.com/43727f9558.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>