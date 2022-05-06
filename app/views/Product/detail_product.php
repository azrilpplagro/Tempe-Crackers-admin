<?php $this->view("Navbar",[]); ?>

<style>
  .card-product{
    margin-right: 80px;
  }
</style>
<div class="main">
  <h2>Product</h2>
  <div style="display: flex;flex-wrap:wrap">
    <div class="card-product">
      <div class="img-product" style="background-image: url('http://localhost/Tempe-Crackers/public/img/products/<?= $data['detail_product']['gambar'] ?>');">
        </div>
        <h4><?= $data['detail_product']['nama_produk'] ?></h4>
        <h6>Stock : <?= $data['detail_product']['stok'] ?> / <?= $data['detail_product']['stok_bulan'] ?></h6>
      </div>
      <div style="width: 400px;">
        <h4>Description : </h4>
        <p><?= $data['detail_product']['deskripsi'] ?></p>
        <table class="table">
          <tr>
            <td>Weight</td>
            <td>: <?= $data['detail_product']['berat'] ?> Kg</td>
          </tr>
          <tr>
            <td>Expired</td>
            <td>: <?= $data['detail_product']['expired'] ?></td>
          </tr>
          <tr>
            <td>Price</td>
            <td>: Rp.<?= $data['detail_product']['harga'] ?></td>
          </tr>
        </table>
      </div>
  </div>
</div>