<?php $this->view("Navbar",[]); ?>
<div class="main">
  <div class="navbar-order">
    <a href="<?= BASE_URL ?>/Sale/incoming" style="border-bottom: 3px solid white;">
      <h6>incoming</h6>
    </a>
    <a href="<?= BASE_URL ?>/Sale/sent">
      <h6>sent</h6>
    </a>
    <a href="<?= BASE_URL ?>/Sale/done">
      <h6>complicated</h6>
    </a>
    <a href="<?= BASE_URL ?>/Sale/canceled">
      <h6>canceled</h6>
    </a>
  </div>

  <?php
  foreach ($data['list_order'] as $order) { 
    $detail_product = $this->model("Product_model")->get_spesific_product($order['produk_id']);
    ?>
       <?php
        if($order['metode_pembayaran'] == 'transfer' && $order['bukti_pembayaran'] == ""  ){}
        else { ?>
          <div class="list-order">
            <div style="width: 100%">
              <h5><?= $this->model("Mitra_model")->get_data_user($order['mitra_email'])['nama_lengkap'] ?></h5>
              <p><?= $order['tanggal_pesan'] ?></p>
            </div>
            <div class="img" style="background-image: url(http://localhost/Tempe-Crackers/public/img/products/<?= $detail_product['gambar'] ?>);">
            </div>
            <div style="margin:20px;display:flex;flex-direction:column;justify-content:space-between">
              <div>
                <h5><?= $detail_product['nama_produk'] ?> | <?= $detail_product['berat'] ?>kg | <?= $order['metode_pembayaran'] ?> | <?= $order['jenis_pengiriman'] ?></h5>
                <h6>x <?= $order['jumlah_pesanan'] ?> </h6>
                <h6>Total Pembayaran : Rp.<?= $order['total_pembayaran'] ?></h6>
              </div>

              <table>
                <tr>
                  <td>
                  <?php
                    if( ( $order['status_pembayaran'] == "Lunas" || $order['metode_pembayaran'] == "cod" ) && $order['jenis_pengiriman'] == 'expedition' ){ ?>
                      <a href="<?= BASE_URL ?>/Sale/shipping_validation/<?= $order['id'] ?>" class="btn" style="margin: 0;padding:0"><img src="http://localhost/Tempe-Crackers/public/icon/blue_arrow.png" alt="">
                      </a>
                    <?php
                    }else if($order['status_pembayaran'] == "Belum Lunas"){ ?>
                      <img src="http://localhost/Tempe-Crackers/public/icon/black_arrow.png" alt="">
                    <?php } ?>
                  </td>

                  <?php
                  if($order['metode_pembayaran'] == "transfer"){ ?>
                    <?php
                      if($order['jenis_pengiriman'] == 'pickup' && $order['status_pembayaran'] == 'Lunas' ){ ?>
                        <td>
                          <a href="<?= BASE_URL ?>/Sale/payment_validation/<?= $order['id'] ?>" style="width: 250px;font-size:15px" class="btn btn-success">Payment Validation</a>
                        </td>
                        <td>
                          <form action="" method="POST">
                            <button type="submit" name="tombol_confirm" value="<?= $order['id'] ?>" style="margin-left:10px;width: 250px;font-size:15px" class="btn btn-dark">Order Confirmation</button>
                          </form>
                        </td>
                      <?php }
                      else{ ?>
                        <td>
                          <a href="<?= BASE_URL ?>/Sale/payment_validation/<?= $order['id'] ?>" style="width: 250px;font-size:15px" class="btn btn-success">Payment Validation</a>
                        </td>
                      <?php
                      } 
                    ?>
                    
                  <?php }
                  else if ($order['metode_pembayaran'] == "cod" && $order['jenis_pengiriman'] == 'pickup'){ ?>
                    <td>
                      <form action="" method="POST">
                        <button type="submit" name="tombol_confirm" value="<?= $order['id'] ?>" style="width: 250px;font-size:15px" class="btn btn-dark">Order Confirmation</button>
                      </form>
                    </td>
                  <?php }
                  ?>
                </tr>
              </table>
            </div>
          </div>
        <?php
        }
        ?>
    <?php
    }
  ?>
</div>