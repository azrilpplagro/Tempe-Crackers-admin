<?php
$data_user = $this->model("Mitra_model")->get_data_user($data['detail_order']['mitra_email']);
?>

<?php $this->view("Navbar",[]); ?>
<div class="main">
  <h2>Shipping Detail</h2><br>
  <span style="display: flex;margin:0;padding:0;align-items:flex-end">
    <img src="http://localhost/Tempe-Crackers/public/icon/location.png" style="width: 30px;" alt="">
    <h6>Address</h6>
  </span>
  <h4><?= $data_user['nama_lengkap'] ?></h4>
  <h6>
    <?= $data_user['alamat'] ?>, <?= 
      $this->model("Mitra_model")->get_spesifik_alamat(
        $data_user['desa_id'], $data_user['kecamatan_id'], $data_user['kabupaten_id'], $data_user['provinsi_id'], $data_user['negara_id']); 
    ?>
  </h6>
  <h6>No Hp : <?= $data_user['no_telepon'] ?></h6>
  <hr>
  <br>
  <h2>Delivery Status</h2>
  <h6>Orders have been shipped on <?= $data['detail_order']['tanggal_pengiriman'] ?> </h6>
  <h6>POS - <?= $data['detail_order']['no_resi'] ?></h6>
</div>