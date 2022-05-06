<style>
  .img{
    margin-left: 30px;
    width: 180px;
    height: 180px;
    background-position: center;
    background-size: cover;
    align-self: center;
  }
  .list-order{
    display: flex;
    width: 100%;
    height: 200px;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    cursor: pointer;
    text-decoration: none;
    color: black;
  }
  .list-order:hover{
    box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
    color: black;
  }
</style>
<?php $this->view("Navbar",[]); ?>
<div class="main">
  <h3><?= $this->model("Mitra_model")->get_data_user($_SESSION['params'][0])['nama_lengkap']; ?></h3>
  <?php
  foreach ($data['list_order'] as $order) { 
    $detail_product = $this->model("Product_model")->get_spesific_product($order['produk_id']);
    ?>
       <a href="<?= BASE_URL ?>/Sale/detail_order_done/<?= $order['id'] ?>" class="list-order">
          <div class="img" style="background-image: url(http://localhost/Tempe-Crackers/public/img/products/<?= $detail_product['gambar'] ?>);">
          </div>
          <div style="margin:20px;display:flex;flex-direction:column;justify-content:space-between">
            <div>
              <h5><?= $detail_product['nama_produk'] ?> | <?= $detail_product['berat'] ?>kg | <?= $order['metode_pembayaran'] ?> | <?= $order['jenis_pengiriman'] ?> </h5>
              <h6>x <?= $order['jumlah_pesanan'] ?> </h6>
              <h6>Total Pembayaran : IDR <?= $order['total_pembayaran'] ?></h6>
            </div>
            
          </div>
        </a>
      <?php
      }
  ?>
</div>