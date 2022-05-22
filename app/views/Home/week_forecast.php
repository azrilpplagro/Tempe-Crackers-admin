<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="<?= BASE_URL ?>/style/library/swiper/swiper-bundle.min.css"/>
<?php $this->view("Navbar",[]); ?>

<div class="main">
  <h3>Dashboard</h3>
  <h5>7 Day Forecast</h5>

  <div>
    <div class="week-day">

      <div class="box-day active">
        
        <h6>Today</h6>
        <div class="box-day-content">
          <img src="<?= BASE_URL ?>/icon/weather_icon/<?= $data['data_weather']['current']['weather'][0]['icon']  ?>.png" alt="">
          <div>
            <p><?= $data['data_weather']['hourly'][0]['temp'] ?>&#8451</p>
            <h5><?= $data['data_weather']['current']['weather'][0]['description'] ?></h5>
          </div>
        </div>
      </div>

      <?php
      for ($i=1; $i <count($data['data_weather']['daily']) ; $i++) { ?>
        <a href="<?= BASE_URL ?>/Home/another_day/<?= $i ?>" class="box-day">
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
    <div style="display: flex;">
      <a style="margin-left:20px;color: black;font-size:20px" href="">More Details</a>
      <a style="margin-left:20px;color: black;font-size:20px;text-decoration:none" href="hourly">Hourly</a>
    </div>

    <div style="color:black;text-decoration:black;display: flex;flex-wrap:wrap;">
        <img src="<?= BASE_URL ?>/icon/weather_icon/<?= $data['data_weather']['current']['weather'][0]['icon']  ?>.png" alt="">
        <h1 style="align-self: center;"><?= $data['data_weather']['hourly'][0]['temp'] ?>&#8451</h1>

        <div style="align-self: center;margin-left:40px">
          <h5><?= $data['data_weather']['current']['weather'][0]['description'] ?></h5>
          <?php
            if (str_contains(strtolower($data['data_weather']['current']['weather'][0]['description']), 'rain') || str_contains(strtolower($data['data_weather']['current']['weather'][0]['description']), 'overcast')  ) { ?>
              <div style="width: 100%;padding:40px;" class="btn btn-danger">
                <h1>"Today's weather is not suitable for drying"</h1>
              </div>
            <?php }
            else{ ?>
              <div style="width: 100%;padding:40px;" class="btn btn-success">
                <h1>"Today's weather is perfect for the drying process"</h1>
              </div>
            <?php }
          ?>
        </div>
      </div>


      <div style="padding:20px 40px;display: flex;justify-content:space-between;flex-wrap:wrap">
        <div style="display: flex;align-items:center;flex-direction:column">
          <div style="display: flex;">
            <img style="width: 30px;height: 30px;" src="http://localhost/Tempe-Crackers/public/icon/humidity.png" alt="">
            <p>Humidity</p>
          </div>
          <h5><?= $data['data_weather']['hourly'][0]['humidity'] ?>%</h5>
        </div>

        <div style="display: flex;align-items:center;flex-direction:column">
          <div style="display: flex;">
            <img style="width: 30px;height: 30px;" src="http://localhost/Tempe-Crackers/public/icon/wind.png" alt="">
            <p>Wind</p>
          </div>
          <h5><?= $data['data_weather']['hourly'][0]['wind_speed'] ?>km/h</h5>
        </div>

        <div style="display: flex;align-items:center;flex-direction:column">
          <div style="display: flex;">
            <img style="width: 30px;height: 30px;" src="http://localhost/Tempe-Crackers/public/icon/pressure.png" alt="">
            <p>Pressure</p>
          </div>
          <h5><?= $data['data_weather']['hourly'][0]['pressure'] ?>mb</h5>
        </div>

        <div style="display: flex;align-items:center;flex-direction:column">
          <div style="display: flex;">
            <img style="width: 30px;height: 30px;" src="http://localhost/Tempe-Crackers/public/icon/weather.png" alt="">
            <p>UVI</p>
          </div>
          <h5><?= $data['data_weather']['hourly'][0]['uvi'] ?></h5>
          
        </div>
      </div>
      
    </div>
    <br>
    <div class="hourly-box">
      <h5>24 hour precipitacion</h5>
      <table class="table table-striped table-hover">
        <tr class="table-dark">
          <td>Hour</td>
          <td>Weather Description</td>
          <td>Temperature</td>
        </tr>
        <?php
          $hour = $data['now_hour'];
          $count = 0;
          foreach ($data['data_weather']['hourly'] as $value) {  ?>
            <tr>
              <td>
                <?php 
                  if($hour < 10){
                    echo "0$hour";
                  } 
                  else{
                    echo $hour;
                  }
                ?>.00
              </td>
              <td><?= $data['data_weather']['hourly'][$count]['weather'][0]['description'] ?></td>
              <td><?= $value['temp'] ?>&#8451</td>
            </tr>
          <?php 
          if($hour == 24){
            $hour = 0;
          }else{
            $hour ++;
          }
          $count ++;
          if($count == 24){
            break;
          }
          
        }
        ?>
      </table>
    </div>
    
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