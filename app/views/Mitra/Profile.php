
<?php $this->view("Navbar",[]); ?>


<div class="main">
  <form action="" method="POST" style="padding-left: 30px;">
    <table class="table"">
        <input type="hidden" name="email" value="<?= $data['mitra_data']['email'] ?>">
        <tr>
          <td><h1>Profile</h1></td>
          <td><img src="<?= BASE_URL ?>/icon/null_photo.png" style="width: 50px;cursor:pointer" alt=""></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><?= $data['mitra_data']['email'] ?></td>
        </tr>
        <tr>
          <td>Phone Number</td>
          <td><?= $data['mitra_data']['no_telepon'] ?></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><?= $data['mitra_data']['username'] ?></td>
        </tr>
        <tr>
          <td>Ful Name</td>
          <td><?= $data['mitra_data']['nama_lengkap'] ?></td>
        </tr>
        <tr>
          <td>Address</td>
          <td><?= $data['mitra_data']['alamat'] ?>, <?= 
            $this->model("Mitra_model")->get_spesifik_alamat(
              $data['mitra_data']['desa_id'],$data['mitra_data']['kecamatan_id'], $data['mitra_data']['kabupaten_id'],$data['mitra_data']['provinsi_id'],$data['mitra_data']['negara_id']); 
          ?></td>
        </tr>
        <tr>
          <td>Date of Birth</td>
          <td><?= $data['mitra_data']['tanggal_lahir'] ?></td>
        </tr>
        <tr>
          <td>Gender</td>
          <td>
              <?php 
                if($data['mitra_data']['jenis_kelamin_id'] == 1){
                  echo  'Male';
                }else{
                  echo  'Female';
                }  
              ?>
          </td>
        </tr>
        <tr>
          <td>Account Status</td>
          <td>
            <?php 
              if($data['mitra_data']['status_akun_id'] == 1){
                ?>
                  <input type="hidden" value="1" name="status_akun">
                  Active
                <?php
              }
              else{
                ?>
                  <input type="hidden" value="2" name="status_akun">
                  Not Active
                <?php
              }  
            ?>
            </span>
          </td>
        </tr>
      </table>
    <br>
    <div style="display: flex;width:100%;flex-direction:column;align-items:flex-end">
      <button type="submit" name="edit" value="submit" class="btn btn-dark" style="width: 300px;right:0">Edit Status</button>
    </div>
  </form>
</div>