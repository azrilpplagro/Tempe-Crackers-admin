
<?php $this->view("Navbar",[]); ?>


<div class="main">
  <form action="" method="POST" style="padding-left: 30px;">
    <table class="table" style="width: 500px;">
        <input type="hidden" name="email" value="<?= $data['mitra_data']['email'] ?>">
        <tr>
          <td><h1>Profile</h1></td>
          <td><img src="<?= BASE_URL ?>/icon/null_photo.png" style="width: 50px;cursor:pointer" alt=""></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input class="form-control" placeholder="email" value="<?= $data['mitra_data']['email'] ?>" disabled></td>
        </tr>
        <tr>
          <td>No Telepon</td>
          <td><input type="text" name="no_telepon" class="form-control" placeholder="no_telepon" value="<?= $data['mitra_data']['no_telepon'] ?>" ></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input type="text" name="username" class="form-control" placeholder="username" value="<?= $data['mitra_data']['username'] ?>" ></td>
        </tr>
        <tr>
          <td>Nama Lengkap</td>
          <td><input type="text" name="nama_lengkap" class="form-control" placeholder="nama_lengkap" value="<?= $data['mitra_data']['nama_lengkap'] ?>"></td>
        </tr>



        <!-- Alamat -->
        <tr>
          <td>Alamat</td>
          <td>
            <input class="form-control" type="text" name="alamat" value="<?= $data['mitra_data']['alamat'] ?>">
          </td>
        </tr>
        <tr>
          <td>Desa</td>
            <td>
            <span style="display: flex;">
              <select class="form-select" id="desa" name="desa" aria-label="Default select example">
                <?php
                  $data_desa = $this->model("Mitra_model")->get_data_desa();
                  foreach ($data_desa as $desa) { 
                    if($desa['id'] == $data['mitra_data']['desa_id']){ ?>
                      <option value="<?= $desa['id'] ?>"  selected><?= $desa['nama_desa'] ?></option>
                    <?php
                    }
                    else{ ?>
                      <option value="<?= $desa['id'] ?>"><?= $desa['nama_desa'] ?></option>
                    <?php
                    }
                  }
                ?>
              </select>
            </span>
          </td>
        </tr>
        <tr>
          <td>Kecamatan</td>
            <td>
            <span style="display: flex;">
              <select class="form-select" id="kecamatan" name="kecamatan" aria-label="Default select example">
                <?php
                  $data_kecamatan = $this->model("Mitra_model")->get_data_kecamatan();
                  foreach ($data_kecamatan as $kecamatan) { 
                    if($kecamatan['id'] == $data['mitra_data']['kecamatan_id']){ ?>
                      <option value="<?= $kecamatan['id'] ?>"  selected><?= $kecamatan['nama_kecamatan'] ?></option>
                    <?php
                    }
                    else{ ?>
                      <option value="<?= $kecamatan['id'] ?>"><?= $kecamatan['nama_kecamatan'] ?></option>
                    <?php
                    }
                  }
                ?>
              </select>
            </span>
          </td>
        </tr>
        <tr>
          <td>Kabupaten</td>
            <td>
            <span style="display: flex;">
              <select class="form-select" id="kabupaten" name="kabupaten" aria-label="Default select example">
                <?php
                  $kabupaten = $this->model("Mitra_model")->get_data_kabupaten();
                  foreach ($kabupaten as $kabupaten) { 
                    if($kabupaten['id'] == $data['mitra_data']['kabupaten_id']){ ?>
                      <option value="<?= $kabupaten['id'] ?>"  selected><?= $kabupaten['nama_kabupaten'] ?></option>
                    <?php
                    }
                    else{ ?>
                      <option value="<?= $kabupaten['id'] ?>"><?= $kabupaten['nama_kabupaten'] ?></option>
                    <?php
                    }
                  }
                ?>
              </select>
            </span>
          </td>
        </tr>
        <tr>
          <td>Provinsi</td>
            <td>
            <span style="display: flex;">
              <select class="form-select" id="provinsi" name="provinsi" aria-label="Default select example">
                <?php
                  $provinsi = $this->model("Mitra_model")->get_data_provinsi();
                  foreach ($provinsi as $provinsi) { 
                    if($provinsi['id'] == $data['mitra_data']['provinsi_id']){ ?>
                      <option value="<?= $provinsi['id'] ?>"  selected><?= $provinsi['nama_provinsi'] ?></option>
                    <?php
                    }
                    else{ ?>
                      <option value="<?= $provinsi['id'] ?>"><?= $provinsi['nama_provinsi'] ?></option>
                    <?php
                    }
                  }
                ?>
              </select>
            </span>
          </td>
        </tr>
        <tr>
          <td>Negara</td>
            <td>
            <span style="display: flex;">
              <select class="form-select" id="negara" name="negara" aria-label="Default select example">
                <?php
                  $negara = $this->model("Mitra_model")->get_data_negara();
                  foreach ($negara as $negara) { 
                    if($negara['id'] == $data['mitra_data']['negara_id']){ ?>
                      <option value="<?= $negara['id'] ?>"  selected><?= $negara['nama_negara'] ?></option>
                    <?php
                    }
                    else{ ?>
                      <option value="<?= $negara['id'] ?>"><?= $negara['nama_negara'] ?></option>
                    <?php
                    }
                  }
                ?>
              </select>
            </span>
          </td>
        </tr>



        <!-- akhir alamat -->
        
        <tr>
          <td>Tanggal Lahir</td>
          <td>
          <input type="date" placeholder="tgl_lahir" value="<?= $data['mitra_data']['tanggal_lahir'] ?>" name="tanggal_lahir" class="form-control"></td>
          <!-- <td>Tanggal Lahir</td><td><?= $data['mitra_data']['tanggal_lahir'] ?></td> -->
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td>
          <span style="display: flex;">
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" aria-label="Default select example">
              <?php 
                if($data['mitra_data']['jenis_kelamin_id'] == 1){
                  echo  '<option value="1" selected>Pria</option>
                        <option value="2">Wanita</option>';
                }else{
                  echo  '<option value="1">Pria</option>
                        <option value="2" selected>Wanita</option>';
                }  
              ?>
            </select>
          </span>
          </td>
        </tr>
        <tr>
          <td>Status Akun</td>
          <td>
          <span style="display: flex;">
            <select class="form-select" id="jenis_kelamin" name="status_akun" aria-label="Default select example">
              <?php 
                if($data['mitra_data']['status_akun_id'] == 1){
                  echo '<option value="1" selected>Aktiv</option>
                        <option value="2">Tidak Aktiv</option>';
                }
                else{
                  echo  '<option value="2" selected>Tidak Aktiv</option>
                        <option value="1">Aktiv</option>';
                        
                }  
              ?>
            </select>
          </span>
          </td>
        </tr>
      </table>
    <br>
    <button type="submit" name="edit" value="submit" class="btn btn-dark" style="width: 300px;">Simpan</button>
  </form>
</div>