<?php $this->view("Navbar",[]); ?>

<div class="main">
  <form action="" method="POST" style="padding-left: 30px;">
    <table class="table table-striped table-hover">
        <input type="hidden" name="email" value="<?= $data['user_data']['email'] ?>">

        <h1>Profile</h1>
        <tr>
          <td>Email</td>
          <td><?= $data['user_data']['email'] ?></td>
        </tr>
        <tr>
          <td>Phone Number</td>
          <td><?= $data['user_data']['no_telepon'] ?></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><?= $data['user_data']['username'] ?></td>
        </tr>
        <tr>
          <td>Full Name</td>
          <td><?= $data['user_data']['nama_lengkap'] ?></td>
        </tr>
        <tr>
          <td>Address</td>
          <td><?= $data['user_data']['alamat'] ?>, <?= 
            $this->model("Mitra_model")->get_spesifik_alamat(
              $data['user_data']['desa_id'],$data['user_data']['kecamatan_id'], $data['user_data']['kabupaten_id'],$data['user_data']['provinsi_id'],$data['user_data']['negara_id']); 
          ?></td>
        </tr>
        <tr>
          <td>Birth of Date</td>
          <td><?= $data['user_data']['tanggal_lahir'] ?></td>
          
        </tr>
        <tr>
          <td>Gender</td>
          <td><?php 
                if($data['user_data']['jenis_kelamin_id'] == 1){echo 'Male';}else{echo 'Female';}  
              ?>
          </td>
        </tr>
        <tr>
          <td>Account Number</td>
          <td><?php $data['user_data']['no_rekening']
              ?>
          </td>
        </tr>
      </table>
    <a href="<?= BASE_URL ?>/About/edit"  class="btn btn-dark" style="width: 300px;">Edit</a>
  </form>
</div>




