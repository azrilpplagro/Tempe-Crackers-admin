<style>
  body{
    background-color: #F7CCAC;
  }
</style>
<nav><img src="<?= BASE_URL ?>/icon/logo.png" alt="" style="width: 80px;margin:10px"></nav>
<div class="card-container" style="width:480px;background-color:rgba(0, 0, 0, 0.1)">
  <center><img src="<?= BASE_URL ?>/icon/akun.png" alt=""></center>
  <center><h3>Admin Login</h3></center>
  <br><br>
  <form action="" method="POST">
    <input oninput="null_title_value('email')" type="email" placeholder="email" name="email" class="form-control">
    <input oninput="null_title_value('password')" type="password" placeholder="password" name="password" class="form-control">
    <br>
    <center><button data-bs-toggle="modal" data-bs-target="#exampleModal" type="submit" name="login" style="width: 100%;" class="btn btn-dark">Login</button></center>
  </form>
</div>