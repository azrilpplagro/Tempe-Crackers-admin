
<?php $this->view("Navbar",[]); ?>

<div class="main" style="padding-left: 30px;">
  <table class="table" >
    <tr>
      <td><h3>Mitra Data</h3></td>
    </tr>
    <?php
    foreach ($data['mitra_data'] as $value) { ?>
      <tr>
        <td><?= $value['nama_lengkap'] ?></td>
        <td><a href="<?= BASE_URL ?>/Mitra/Profile/<?= $value['username'] ?>" class="btn btn-outline-success">View Profile</a></td>
      </tr>
    <?php
    }
    ?>
  </table>
</div>