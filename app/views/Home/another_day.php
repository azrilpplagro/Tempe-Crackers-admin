<?php
$params = $_SESSION['params'][0];
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="<?= BASE_URL ?>/style/library/swiper/swiper-bundle.min.css"/>
<?php $this->view("Navbar",[]); ?>

<div class="main">
  <h3>Dashboard</h3>
  <h5>7 Day Forecast</h5>

  <div>
    <div class="week-day">

      <a href="<?= BASE_URL ?>/Home/week_forecast" class="box-day">
        <h6>Today</h6>
        <div class="box-day-content">
          <img src="<?= BASE_URL ?>/icon/weather_icon/<?= $data['data_weather']['current']['weather'][0]['icon']  ?>.png" alt="">
          <div>
            <p><?= $data['data_weather']['hourly'][0]['temp'] ?>&#8451</p>
            <h5><?= $data['data_weather']['current']['weather'][0]['description'] ?></h5>
          </div>
        </div>
      </a>

      <?php
      for ($i=1; $i <count($data['data_weather']['daily']) ; $i++) { ?>
        <a href="<?= BASE_URL ?>/Home/another_day/<?= $i ?>" class="box-day <?php if($i == $_SESSION['params'][0] ){echo 'active'; } ?>" >
          <p><?= $data['week_day_data'][$i]['day_name'] ?> <?= $data['week_day_data'][$i]['date'] ?></p>
          <img src="<?= BASE_URL ?>/icon/weather_icon/<?= $data['data_weather']['daily'][$i]['weather'][0]['icon']  ?>.png" alt="">
          <h5><?= $data['data_weather']['daily'][$i]['weather'][0]['description'] ?></h5>
        </a>
      <?php }
      ?>

    </div>
  </div>
  <br>

  <div class="weather-box">

    <div style="color:black;text-decoration:black;display: flex;flex-wrap:wrap;">
        <div style="align-self: center;margin-left:40px">
          <br>
          <h5><?= $data['data_weather']['daily'][$params]['weather'][0]['description'] ?></h5>
          <p><?php
            if (str_contains(strtolower($data['data_weather']['daily'][$params]['weather'][0]['description']), 'rain') || str_contains(strtolower($data['data_weather']['daily'][$params]['weather'][0]['description']), 'overcast')  ) {  ?>
              <div style="width: 100%;padding:40px;" class="btn btn-danger">
                <h1>"<?= $data['week_day_data'][$params]['day_name'] ?> <?= $data['week_day_data'][$params]['date'] ?> weather is not suitable for drying"</h1>
              </div>
            <?php }
            else{ ?>
              <div style="width: 100%;padding:40px;" class="btn btn-success">
                <h1>"<?= $data['week_day_data'][$params]['day_name'] ?> <?= $data['week_day_data'][$params]['date'] ?> weather is perfect for the drying process"</h1>
              </div>
            <?php }
        ?></p>
        </div>
      </div>


      <div style="padding:20px 40px;display: flex;justify-content:space-between;flex-wrap:wrap">
        <div style="display: flex;align-items:center;flex-direction:column">
          <div style="display: flex;">
            <img style="width: 30px;height: 30px;" src="http://localhost/Tempe-Crackers/public/icon/humidity.png" alt="">
            <p>Humidity</p>
          </div>
          <h5><?= $data['data_weather']['daily'][$params]['humidity'] ?>%</h5>
        </div>

        <div style="display: flex;align-items:center;flex-direction:column">
          <div style="display: flex;">
            <img style="width: 30px;height: 30px;" src="http://localhost/Tempe-Crackers/public/icon/wind.png" alt="">
            <p>Wind</p>
          </div>
          <h5><?= $data['data_weather']['daily'][$params]['wind_speed'] ?>km/h</h5>
        </div>

        <div style="display: flex;align-items:center;flex-direction:column">
          <div style="display: flex;">
            <img style="width: 30px;height: 30px;" src="http://localhost/Tempe-Crackers/public/icon/pressure.png" alt="">
            <p>Pressure</p>
          </div>
          <h5><?= $data['data_weather']['daily'][$params]['pressure'] ?>mb</h5>
        </div>

        <div style="display: flex;align-items:center;flex-direction:column">
          <div style="display: flex;">
            <img style="width: 30px;height: 30px;" src="http://localhost/Tempe-Crackers/public/icon/weather.png" alt="">
            <p>UVI</p>
          </div>
          <h5><?= $data['data_weather']['daily'][$params]['uvi'] ?></h5>
          
        </div>
      </div>
      
    </div>
    <br>
  </div>
  
  <br>
  <!-- </div> -->
  
  
</div>


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