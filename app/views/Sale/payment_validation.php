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
  <h5>Proof of Payment : </h5>
  <div style="display: flex;flex-wrap:wrap">
    <div class="img" style=";margin-right:30px;width:300px;height:300px;background-image: url(<?= BASE_URL ?>/proof%20of%20payment/<?= $data['detail_order']['bukti_pembayaran']; ?>);background-position: center;background-size:cover"></div>
    <div style="width: 500px;">
      <h5><?= $detail_product['nama_produk'] ?></h5>
      <table class="table">
        <tr>
          <td>Order Time</td>
          <td style="text-align: right;"><?= $data['detail_order']['tanggal_pesan'] ?></td>
        </tr>
        <td>Payment Time</td>
          <td style="text-align: right;"><?= $data['detail_order']['tanggal_pembayaran'] ?></td>
        </tr>
      <?php
      if($data['detail_order']['status_pembayaran'] == "Lunas"){ ?>
          <tr>
            <td><h2>Payment Status</h2></td>
            <td><button class="btn btn-success">Paid</button></td>
          </tr>
      <?php
      }else if ($data['detail_order']['status_pembayaran'] == "Belum Lunas"){ ?>
          <tr>
            <td><a href="<?= BASE_URL ?>/Sale/incoming" class="btn btn-warning" style="color: white;">Back</a></td>
            <td>
              <table>
                <tr>
                  <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $data['detail_order']['id'] ?>">
                    <td><button type="submit" name="tombol-reject" class="btn btn-danger">Reject</button></td>
                    <td><button type="submit" name="tombol-confirm" class="btn btn-success">Confirm</button></td>
                  </form>
                  
                </tr>
              </table>
            </td>
          </tr>
      <?php }
      else{ ?>
      <?php 
      }
      ?>

    </table>
    </div>

  
  

  
</div>