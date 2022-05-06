
<?php $this->view("Navbar",[]); ?>
<?php
$list_of_month = [
  "January","Febuary","March","April","Mei","Juny","July","August","September","October","November","Desember"
];
?>
<style>
  .shadow-textarea textarea.form-control::placeholder {
    font-weight: 300;
  }
  .shadow-textarea textarea.form-control {
      padding-left: 0.8rem;
  }
</style>

<div class="main">
  <h2>Product</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <table class="table">
      <tbody>
        <input type="hidden" name="id" value="<?= $data['detail_product']['id'] ?>">
        <tr>
          <td>Product Name</td>
          <td><input value="<?= $data['detail_product']['nama_produk'] ?>" type="text" name="product_name" placeholder="Write some name here..." class="form-control" id="validationCustom03" oninput="null_title_value(tag_name = 'product_name')" required></td>
        </tr>
        <tr>
          <td>Stock</td>
          <td><input value="<?= $data['detail_product']['stok'] ?>" style="width: 150px;" type="number" id="quantity" name="stock" class="form-control" min="1" max="1000000" oninput="null_title_value(tag_name = 'stock')" required></td>
        </tr>
        <tr>
          <td>Stock of Month</td>
          <td>
          <select style="width: 320px;" name="stock_of_month" class="form-select" aria-label="Default select example">
            <?php
            foreach ($list_of_month as $month) { ?>
              <?php
                if($month == $data['detail_product']['stok_bulan']){ ?> 
                  <option selected value="<?= $month ?>"><?= $month ?></option>
                <?php
                }
                else{ ?>
                  <option value="<?= $month ?>"><?= $month ?></option>
                <?php
                }
              ?>
              
            <?php
            }
            ?>
            
          </select>
          </td>
        </tr>
        <tr>
          <td>Description</td>
          <td>
            <div class="form-group shadow-textarea">
              <textarea name="description" class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="20" placeholder="Write description here..." id="validationCustom03" oninput="null_title_value(tag_name = 'description')" required> <?= $data['detail_product']['deskripsi'] ?> </textarea>
            </div>
          </td>
        </tr>
        <tr>
          <td>Weight (Kg)</td>
          <td>
            <input value="<?= $data['detail_product']['berat'] ?>" style="width: 150px;" type="number" id="quantity" name="weight" class="form-control" min="1" max="1000000000" oninput="null_title_value(tag_name = 'weight')" required>
          </td>
        </tr>
        <tr>
          <td>Price</td>
          <td>
            <table style="display: flex;align-content:flex-start">
              <tr>
                <td><h6>Rp.</h6></td>
                <td>
                  <input value="<?= $data['detail_product']['harga'] ?>" style="width: 150px;" type="number" id="quantity" name="price" class="form-control" min="1" max="1000000" oninput="null_title_value(tag_name = 'price')" required>
                </td> 
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>Expired</td>
          <td>
            <input value="<?= $data['detail_product']['expired'] ?>" style="width: 320px;" type="date" placeholder="Expired"  name="expired" class="form-control" required>
          </td>
        </tr>
        <tr>
          <td>Image</td>
          <td>
            <div class="file-input">
              <label class="btn btn-primary" for="upload-photo">Upload Image...</label>
              <input name="gambar" type="file">
            </div>
            
          </td>
        </tr>
      </tbody>
    </table>
    <br>
    <div style="display: flex; width:100%;justify-content:space-between">
      <a style="width:150px" href="<?= BASE_URL ?>/Product" class="btn btn-dark">Back</a>
      <button style="width:150px" type="submit" name="edit_product" value="edit_product" class="btn btn-success">Edit</button>
    </div>
    
  </form>
</div>