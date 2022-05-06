<?php
$detail_product = $this->model("Product_model")->get_spesific_product($data['detail_order']['produk_id']);
$data_user = $this->model("Mitra_model")->get_data_user($data['detail_order']['mitra_email']);
?>
<?php $this->view("Navbar",[]); ?>
<style>
  .img{
    margin: 0;
  }
  span{
    display: flex;
    margin: 0;
    padding: 0;
  }
  span h5{
    margin-right: 20px;
  }
  span .btn{
    width: 150px;
  }
  .btn{
    width: 150px;
  }
</style>
<div class="main">

  <h2>Payment Validation</h2>
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
  <br>
  <hr>
  <br>
  
  



  <div style="display: flex;flex-wrap:wrap">
    <div class="img" style=";margin-right:30px;width:300px;height:300px;background-image: url(http://localhost/Tempe-Crackers/public/img/products/<?= $detail_product['gambar'] ?>);background-position: center;background-size:cover"></div>
    <div>
      <h2><?= $detail_product['nama_produk'] ?></h2><br><br>
      <table>
        <tr>
          <td>Weight</td>
          <td> : <?= $detail_product['berat'] ?> Kg</td>
        </tr>
        <tr>
          <td>Amount</td>
          <td> : <?= $data['detail_order']['jumlah_pesanan'] ?></td>
        </tr>
        <tr>
          <td>Expired</td>
          <td> : <?= $detail_product['expired'] ?></td>
        </tr>
        <tr>
          <td>Payment Method</td>
          <td> : <?= $data['detail_order']['metode_pembayaran'] ?></td>
        </tr>
        <tr>
          <td>Shipping Method</td>
          <td> : <?= $data['detail_order']['jenis_pengiriman'] ?></td>
        </tr>
      </table>
    </div>
  </div>
  <br><br>
  <h5>Description : </h5>
  <p><?= $detail_product['deskripsi'] ?></p>
  <br>

  <span>
    <h5>Total Payment : </h5>
    <h5 style="color: red;">IDR <?= $data['detail_order']['total_pembayaran'] ?>,00</h5>
  </span>

  <br>
  <hr>
  <br>
  
  <form action="" method="POST">
    <input type="hidden" name="id" value="<?= $data['detail_order']['id'] ?>">
    <table style="width: 100%;">
      <tr>
        <td>No Resi</td>
        <td><input type="text" class="form-control" name="no_resi" oninput="null_title_value('no_resi')" required></td>
      </tr>
      <tr>
        <td>Order Time</td>
        <td style="text-align: right;"><?= $data['detail_order']['tanggal_pesan'] ?></td>
      </tr>
      <tr>
        <td>Payment Time</td>
        <td style="text-align: right;"><?= $data['detail_order']['tanggal_pembayaran'] ?></td>
      </tr>
    </table>
    
    <br><br>
    <span style="justify-content:space-between;">
      <a href="<?= BASE_URL ?>/Sale/incoming" class="btn btn-danger">Back</a>
      <button type="submit" name="send" class="btn btn-success">Send</button>
    </span>
  </form>
  
  

  
</div>