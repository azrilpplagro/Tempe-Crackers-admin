<?php
// var_dump($data['products']);
// die();

?>
<?php $this->view("Navbar",[]); ?>

<div class="main">
  <h2>Product</h2>
  <div style="display:flex; justify-content:space-between">
    <div></div>
    <a href="<?= BASE_URL ?>/Product/add_new_product" class="btn btn-success">+ Create New</a>
  </div>
  <div class="card-container">
    <?php
    foreach ($data['products'] as $product) { ?>
      <div class="card-product">
        <div class="img-product" style="background-image: url('http://localhost/Tempe-Crackers/public/img/products/<?= $product['gambar'] ?>?<?php echo time(); ?>');">
        </div>
        <h4><?= $product['nama_produk'] ?></h4>
        <h6>Stock : <?= $product['stok'] ?> / <?= $product['stok_bulan'] ?></h6>
        <a href="<?= BASE_URL ?>/Product/detail_product/<?= $product['id'] ?>" class="btn btn-outline-danger container">View Product</a>
        <a href="<?= BASE_URL ?>/Product/edit_product/<?= $product['id'] ?>" class="btn btn-outline-dark container">Edit</a>
      </div>
    <?php
    }
    ?>
    
  </div>
</div>