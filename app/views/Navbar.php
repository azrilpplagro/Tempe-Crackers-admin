<?php 
$photo = $this->model("User_model")->get_data_user($_SESSION['login-admin']['email'])['profil'];
?>


<section class="mb-3">
  <nav class="navbar navbar-light">
    <div class="container-fluid">
      <a href="<?= BASE_URL ?>/About" style=";text-decoration:none;color:black;cursor:pointer;display:flex;justify-content:center;align-items: center;">
        <div style="display:flex;flex-direction:column;justify-content:space-between;margin-right:10px">
          <h6 style="margin-top: auto;margin-bottom: auto"><?= $this->model("User_model")->get_data_user($_SESSION['login-admin']['email'])['nama_lengkap'] ?></h6>
          <p style="margin-top: auto;margin-bottom: auto">mitra</p>
        </div>
        <img style="width: 40px;" src="<?= BASE_URL ?>/icon/akun.png" alt="">
      </a>
      
      <div style="display: flex; justify-content:center">
        <div class="navbar-toggler first-button"  data-mdb-toggle="collapse"
          data-mdb-target="#navbarToggleExternalContent9"
          aria-controls="navbarToggleExternalContent9" aria-expanded="false"
          aria-label="Toggle navigation">
          <div class="animated-icon1"><span></span><span></span><span></span></div>
        </div>
        <form action="" method="POST">
          <button type="submit" name="tombol_logout" class="btn"><img src="http://localhost/Tempe-Crackers/public/icon/logout.png" style="width: 30px;margin-left:20px" alt=""></button>
        </form>
      </div>
      
    </div>
  </nav>
</section>

<div class="side-bar">
  <div class="logo">
    <img src="http://localhost/Tempe-Crackers/public/icon/logo.png" alt="">
  </div>
  <a href="<?= BASE_URL ?>/Home" <?php if($_SESSION['controller_name'] == "Home" ) echo 'style="background-color: rgba(128, 128, 128, 0.315);' ?>">
    <img src="http://localhost/Tempe-Crackers/public/icon/Dashboard.png" alt="">
    <h4>Dashboard</h4>
  </a>
  <a href="<?= BASE_URL ?>/Mitra" <?php if($_SESSION['controller_name'] == "Mitra" ) echo 'style="background-color: rgba(128, 128, 128, 0.315);' ?>">
    <img src="http://localhost/Tempe-Crackers/public/icon/mitra.png" alt="">
    <h4>Partner</h4>
  </a>
  <a href="<?= BASE_URL ?>/Article" <?php if($_SESSION['controller_name'] == "Article" ) echo 'style="background-color: rgba(128, 128, 128, 0.315);' ?>">
    <img src="http://localhost/Tempe-Crackers/public/icon/artikel.png" alt="">
    <h4>Article</h4>
  </a>
  <a href="<?= BASE_URL ?>/Product" <?php if($_SESSION['controller_name'] == "Product" ) echo 'style="background-color: rgba(128, 128, 128, 0.315);' ?>">
    <img src="http://localhost/Tempe-Crackers/public/icon/produk.png" alt="">
    <h4>Product</h4>
  </a>
  <a href="<?= BASE_URL ?>/Sale" <?php if($_SESSION['controller_name'] == "Sale" ) echo 'style="background-color: rgba(128, 128, 128, 0.315);' ?>">
    <img src="http://localhost/Tempe-Crackers/public/icon/sale.png" alt="">
    <h4>Sale</h4>
  </a>
  <a href="<?= BASE_URL ?>/History" <?php if($_SESSION['controller_name'] == "History" ) echo 'style="background-color: rgba(128, 128, 128, 0.315);' ?>">
    <img src="http://localhost/Tempe-Crackers/public/icon/history.png" alt="">
    <h4>History Order</h4>
  </a>
  <br>
  
</div>


<div id="nav">
  <h6></h6>
  <div style="display: flex;justify-content:center;align-items: flex-end;">
    <a href="<?= BASE_URL ?>/About" style="text-decoration:none;color:black;cursor:pointer;display:flex;justify-content:center;align-items: center;">
      <div style="display:flex;flex-direction:column;justify-content:space-between;margin-right:10px">
        <h6 style="margin-top: auto;margin-bottom: auto"><?= $this->model("User_model")->get_data_user($_SESSION['login-admin']['email'])['nama_lengkap'] ?></h6>
        <p style="margin-top: auto;margin-bottom: auto">admin</p>
      </div>
      <?php
      if($photo == ""){ ?>
        <img style="border-radius: 50%;width:40px;height:40px;object-fit: cover;" src="http://localhost/Tempe-Crackers/public/icon/akun.png" alt="">
      <?php  
      }else{ ?>
        <img style="border-radius: 50%;width:40px;height:40px;object-fit: cover;" src="<?= BASE_URL ?>/img/<?= $photo ?>?<?php echo time(); ?>" alt="">
      <?php
      }
      ?>
    </a>
    <!-- <img style="cursor:pointer" src="http://localhost/Tempe-Crackers/public/icon/dropdown.png" alt=""> -->
    <form action="" method="POST">
      <button type="submit" name="tombol_logout" class="btn"><img src="http://localhost/Tempe-Crackers/public/icon/logout.png" style="width: 30px;margin-left:20px" alt=""></button>
    </form>
    
  </div>
  
</div id="nav">