
<?php $this->view("Navbar",[]); ?>
<style>
  .shadow-textarea textarea.form-control::placeholder {
    font-weight: 300;
  }
  .shadow-textarea textarea.form-control {
      padding-left: 0.8rem;
  }

</style>

<div class="main">
  <h2>Article</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <table class="table">
      <tbody>
        <tr>
          <td>Title</td>
          <td><input type="text" name="judul" placeholder="Write some title here..." class="form-control" id="validationCustom03" oninput="null_title_value(tag_name = 'judul')" required></td>
        </tr>
        <tr>
          <td>Content</td>
          <td>
            <div class="form-group shadow-textarea">
              <textarea name="isi" class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="20" placeholder="Write something here..." id="validationCustom03" oninput="null_title_value(tag_name = 'isi')" required></textarea>
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
        <tr>
          <td><button type="submit" name="create_new_article" value="create_new_article" class="btn btn-dark">Create New Article</button></td>
        </tr>
      </tbody>
    </table>
    
  </form>
</div>

