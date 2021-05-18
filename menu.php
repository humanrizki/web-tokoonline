<nav class="navbar navbar-expand-lg navbar-light bg-info text-white">
  <div class="container-fluid">
    <a class="navbar-brand text-white disabled" href="#">
     <img src="img/LogoP.png" alt="" width="40" height="40" class="mx-2"> Tabernam Nostri
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item mx-2">
          <a class="nav-link <?= ($page = $_SERVER['PHP_SELF'] === "/tokoonline/index.php" ? "gr text-white" : "text-white") ;?>" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link <?= ($page = $_SERVER['PHP_SELF'] === "/tokoonline/keranjang.php" ? "gr text-white" : "text-white") ;?>" href="keranjang.php">Keranjang</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link <?= ($page = $_SERVER['PHP_SELF'] === "/tokoonline/checkout.php" ? "gr text-white" : "text-white") ;?>" href="checkout.php">Checkout</a>
        </li>
        <?php if(isset($_SESSION['pelanggan'])):?>
            <li class="nav-item mx-2">
            <a href="riwayat.php" class="nav-link <?= ($page = $_SERVER['PHP_SELF'] === "/tokoonline/riwayat.php" ? "gr text-white" : "text-white") ;?>">Riwayat</a>
            </li>
            <li class="nav-item mx-2">
              <a href="account.php" class="nav-link <?= ($page = $_SERVER['PHP_SELF'] === "/tokoonline/account.php" ? "gr text-white" : "text-white") ;?>">Akun</a>
            </li>
            <li class="nav-item mx-2">
              
              <a class="nav-link text-white as p-2 bg-danger rounded " style="width: fit-content;" href="logout.php">Logout</a>
            </li>
        <?php else: ?>
            <li class="nav-item mx-2">
            <a href="daftar.php" class="nav-link <?= ($page = $_SERVER['PHP_SELF'] === "/tokoonline/daftar.php" ? "gr text-white" : "text-white") ;?>">Daftar</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link <?= ($page = $_SERVER['PHP_SELF'] === "/tokoonline/login.php" ? "d-none" : "text-white") ;?> as p-2 bg-primary rounded" style="width: fit-content;" href="login.php">Login</a>
              
            </li>
            
        <?php endif;?>
      </ul>
      <form action="pencarian.php" method="GET" class=" navbar-form d-flex w-100 justify-content-center my-2">
        <div class="input-group w-100">
          <input type="text" class="form-control float-right" name="produk">
        </div>
        
        <button class="btn btn-primary">Cari</button>
      </form>
    </div>
  </div>
</nav>