<?php $this->view("Navbar",[]); ?>


<div class="main">
  <center><h1><?= $data['article']['judul']?></h1></center>
  <p><?= $data['article']['tanggal_terbit']?></p>
  <p>Writer: Abdi Wahab</p>
  <div style="width:90%;height:400px;background-image: url('http://localhost/Tempe-Crackers/public/img/article/<?= $data['article']['gambar'] ?>');background-position: center;
        background-size: cover;">

  </div>
  <br>
  <div style="width: 90%;">
    <p style="color: black;"><?= $data['article']['isi']?></p>
  </div>
</div>