<?php $this->view("Navbar",[]); ?>

<div class="main">
  <form action="" method="POST" style="padding-left: 30px;">
    <table class="table" style="width: 500px;">


        <tr>
          <td><h1>Profile</h1></td>
          <td>
            <form action="" method="POST">
              <button class="btn" type="submit" name="tombol_photo">
                <img src="<?= BASE_URL ?>/icon/null_photo.png" style="width: 50px;cursor:pointer" alt="">
              </button>
            </form>
          </td>
        </tr>
        <input type="hidden" name="email" value="<?= $data['user_data']['email'] ?>">
        <tr>
          <td>Email</td>
          <td><input class="form-control" placeholder="email" value="<?= $data['user_data']['email'] ?>" disabled></td>
        </tr>
        <tr>
          <td>Phone Number</td>
          <td><input type="text" oninput="null_title_value('no_telepon')" name="no_telepon" class="form-control" placeholder="no_telepon" value="<?= $data['user_data']['no_telepon'] ?>" ></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input type="text" oninput="null_title_value('username')" name="username" class="form-control" placeholder="username" value="<?= $data['user_data']['username'] ?>" ></td>
        </tr>
        <tr>
          <td>Full Name</td>
          <td><input type="text" oninput="null_title_value('nama_lengkap')" name="nama_lengkap" class="form-control" placeholder="nama_lengkap" value="<?= $data['user_data']['nama_lengkap'] ?>"></td>
        </tr>



        <!-- Alamat -->
        <tr>
          <td>Address</Address></td>
          <td>
            <input class="form-control" type="text" name="alamat" value="<?= $data['user_data']['alamat'] ?>">
          </td>
        </tr>

        <!-- akhir alamat -->



        
        <tr>
          <td>Date of Birth</td>
          <td>
          <input type="date" placeholder="tgl_lahir" value="<?= $data['user_data']['tanggal_lahir'] ?>" name="tanggal_lahir" class="form-control"></td>
        </tr>
        <tr>
          <td>Gender</td>
          <td>
          <span style="display: flex;">
      
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" aria-label="Default select example">
              <?php 
                if($data['user_data']['jenis_kelamin_id'] == 1){echo '<option value="1" selected>Male</option>
                  <option value="2">Female</option>';}else{echo '<option value="1">Male</option>
                    <option value="2" selected>Female</option>';}  
              ?>
              
            </select>
          </span>
          </td>
        </tr>
      </table>
    <button type="submit" name="edit_tempat" value="edit_tempat" class="btn btn-outline-dark" style="width: 300px;">Change Place Details</button>
    <button type="submit" name="edit" value="edit" class="btn btn-dark" style="width: 300px;">Save</button>
  </form>
</div>




