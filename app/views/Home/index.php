<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="<?= BASE_URL ?>/style/library/swiper/swiper-bundle.min.css"/>
<?php $this->view("Navbar",[]); ?>

<div class="main">
  <h3>Dashboard</h3>

  <div style="display: flex;align-items:flex-end">
    <img src="http://localhost/Tempe-Crackers/public/icon/location.png" style="width: 30px;" alt="">
    <h6>
    <?= $data['user_data']['alamat'] ?>, <?= $this->model("Mitra_model")->get_spesifik_alamat($data['user_data']['desa_id'],$data['user_data']['kecamatan_id'], $data['user_data']['kabupaten_id'],$data['user_data']['provinsi_id'],$data['user_data']['negara_id']); 
    ?>
    </h6>
  </div>
  
  <br>

  <div class="weather-box">
    <h4>Current Weather</h4>
    <p><?= date("Y/m/d") ?> <?php 
      if($data['now_hour'] < 10){
        echo "0$data[now_hour]";
      } 
      else{
        echo $data['now_hour'];
      }
      ?>.00
    </p>
    <a href="<?= BASE_URL ?>/Home/week_forecast" style="color:black;text-decoration:black;display: flex;flex-wrap:wrap">
      <img style="width: 140px;height:140px" src="<?= BASE_URL ?>/icon/weather_icon/<?= $data['data_weather']['current']['weather'][0]['icon']  ?>.png" alt="">
      <h1 style="align-self: center;"> <?= $data['data_weather']['hourly'][0]['temp'] ?> &#8451</h1>

      <div style="align-self: center;margin-left:40px">
        <h5><?= $data['data_weather']['current']['weather'][0]['description'] ?></h5>
        <?php
          if (str_contains(strtolower($data['data_weather']['current']['weather'][0]['description']), 'rain') || str_contains(strtolower($data['data_weather']['current']['weather'][0]['description']), 'overcast')  ) { ?>
            <div style="width: 100%;padding:40px;" class="btn btn-danger">
              <h5>"Today's weather is not suitable for drying"</h5>
            </div>
          <?php }
          else{ ?>
            <div style="width: 100%;padding:40px;" class="btn btn-success">
              <h5>"Today's weather is perfect for the drying process"</h5>
            </div>
          <?php }
        ?>
      </div>
    </a>
    <br>
    <!-- style="display: flex;flex-wrap:wrap;" -->
    <div  class="swiper mySwiper" style="z-index:-1">
      <div class="swiper-wrapper">
        <?php
          $hour = $data['now_hour'];
          for ($i=0; $i < 23; $i++) {  ?>
            <div class="hour-box swiper-slide" style="background-color: rgba(196, 196, 196, 0.52);">
              <center>
                <p><?php 
                  if($hour < 10){
                    echo "0$hour";
                  } 
                  else{
                    echo $hour;
                  }
                ?>.00
                </p>
                <img style="width: 50px;" src="<?= BASE_URL ?>/icon/weather_icon/<?= $data['data_weather']['hourly'][$i]['weather'][0]['icon']  ?>.png" alt="">
                <p style="align-self: center;"><?= $data['data_weather']['hourly'][$i]['temp'] ?>&#8451</p>
              </center>
            </div>
          <?php 
            if($hour == 24){
              $hour = 0;
            }else{
              $hour ++;
            }
        }
        ?>
      </div>
      
    </div>

  </div>
  <br>




  <form action="" method="POST">
    <input name="year" style="width: 300px;" placeholder="Year Input" class="form-control" type="number" min="1900" max="2099" step="1" value="<?php
    if(isset($_POST['year'])){
      echo $_POST['year'];
    }
    ?>" />
  </form>
  
  
  <?php
  if(isset($_POST['year'])){ ?>
    <div>
      <canvas id="myChart""></canvas>
    </div>
  <?php
  }
  ?>
  
  
</div>

<?php
  if(isset($data['data_chart'])){ ?>

  <script>
      const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'August',
        'September',
        'October',
        'November',
        'Desember'
      ];
      const data = {
        labels: labels,
        datasets: [
          {
            label: 'Salary',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [
              <?= $data['data_chart']['January'] ?>,
              <?= $data['data_chart']['February'] ?>,
              <?= $data['data_chart']['March'] ?>,
              <?= $data['data_chart']['April'] ?>,
              <?= $data['data_chart']['May'] ?>,
              <?= $data['data_chart']['June'] ?>,
              <?= $data['data_chart']['July'] ?>,
              <?= $data['data_chart']['August'] ?>,
              <?= $data['data_chart']['September'] ?>,
              <?= $data['data_chart']['October'] ?>,
              <?= $data['data_chart']['November'] ?>,
              <?= $data['data_chart']['Desember'] ?>,
            ]
          },
          // {
          //   label: 'Tes',
          //   backgroundColor: 'rgb(255, 99, 132)',
          //   borderColor: 'blue',
          //   data: [10, 20, 30, 40, 50, 34, 22],
          // }
      ],
        
      };
      const config = {
        type: 'line',
        data: data,
        options: {}
      };


      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
  </script>
<?php
}
?>

<script src="<?= BASE_URL ?>/style/library/swiper/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 8,
    spaceBetween: 30,
    slidesPerGroup: 3,
    loop: false,
    loopFillGroupWithBlank: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });
</script>
