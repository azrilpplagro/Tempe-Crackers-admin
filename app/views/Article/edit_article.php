
<?php $this->view("Navbar",[]); ?>

<div class="main">
  <h2>Article</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <table class="table">
      <tbody>
        <input type="hidden" name="id" value="<?= $data['article']['id'] ?>">
        <input type="hidden" name="db_gambar" value="<?= $data['article']['gambar'] ?>">
        <tr>
          <td>Title</td>
          <td><input placeholder="Write title here..." type="text" value="<?= $data['article']['judul'] ?>" name="judul" class="form-control" id="validationCustom03" oninput="null_title_value(tag_name = 'judul')" required></td>
        </tr>
        <tr>
          <td>Content</td>
          <td>
            <div class="form-group shadow-textarea">
              <textarea name="isi" class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="20" placeholder="Write something here..." id="validationCustom03" oninput="null_title_value(tag_name = 'isi')" required><?= $data['article']['isi'] ?></textarea>
            </div>
          </td>
        </tr>
        <tr>
          <td>Image</td>
          <td>
            <div class="file-input">
              <label class="btn btn-primary" for="upload-photo">Upload Image...</label>
              <input name="gambar" type="file" required>
            </div>
            
          </td>
        </tr>
        <br>
      </tbody>
    </table>

    <div style="display: flex; width:100%;justify-content:space-between">
      <a style="width:150px" href="<?= BASE_URL ?>/Article/index" class="btn btn-dark">Back</a>
      <button style="width:150px" type="submit" name="edit_article" value="edit_article" class="btn btn-success">Save</button>
    </div>
    
  </form>
</div>
