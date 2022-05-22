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
    <div style="display: flex;">
      <a style="margin-left:20px;color: black;font-size:20px;text-decoration:none" href="week_forecast">More Details</a>
      <a style="margin-left:20px;color: black;font-size:20px" href="">Hourly</a>
    </div>
    <br>
    <div  class="swiper mySwiper" style="z-index:-1">
        <div style="display: flex;">
          <div style="display: flex;flex-direction:column;align-items:center;margin-right:40px">
            <img src="<?= BASE_URL ?>/icon/weather_icon/<?= $data['data_weather']['current']['weather'][0]['icon']  ?>.png" alt="">
            <h5><?= $data['data_weather']['hourly'][0]['temp'] ?>&#8451&#8451</h5>
            <p><?= $data['data_weather']['current']['weather'][0]['description'] ?></p>
            <h6><?php 
                  if($data['now_hour'] < 10){
                    echo "0$data[now_hour]";
                  } 
                  else{
                    echo $data['now_hour'];
                  }
                ?>.00</h6>
          </div>
          <div class="swiper-wrapper" style="height: 200px;background-color:black;width:1px">
            <p style="font-size: 1px;">1</p>
          </div>
          <div style="margin-left: 40px;height:auto;display:flex;flex-direction:column;width:500px">
          <p><?php
            if (str_contains(strtolower($data['data_weather']['current']['weather'][0]['description']), 'rain') || str_contains(strtolower($data['data_weather']['current']['weather'][0]['description']), 'overcast')  ) {  ?>
              <div style="width: 100%;padding:40px;" class="btn btn-danger">
                <h1>"Today's weather is not suitable for drying"</h1>
              </div>
            <?php }
            else{ ?>
              <div style="width: 100%;padding:40px;" class="btn btn-success">
                <h1>"Today's weather is perfect for the drying process"</h1>
              </div>
            <?php }
          ?></p>
            <div style="display: flex">
              <div style="display: flex;align-items:flex-start;flex-direction:column;margin-right:60px">
                <div style="display: flex;">
                  <img style="width: 20px;height: 20px;" src="http://localhost/Tempe-Crackers/public/icon/humidity.png" alt="">
                  <p>Humidity</p>
                </div>
                <p>70%</p>
              </div>

              <div style="display: flex;align-items:flex-start;flex-direction:column">
                <div style="display: flex;">
                  <img style="width: 20px;height: 20px;" src="http://localhost/Tempe-Crackers/public/icon/wind.png" alt="">
                  <p>Wind</p>
                </div>
                <p>10km/h</p>
              </div>
            </div>
            <br>
            <div style="display: flex">
              <div style="display: flex;align-items:flex-start;flex-direction:column;margin-right:60px">
                <div style="display: flex;">
                  <img style="width: 20px;height: 20px;" src="http://localhost/Tempe-Crackers/public/icon/pressure.png" alt="">
                  <p>Pressure</p>
                </div>
                <p>1007mb</p>
              </div>

              <div style="display: flex;align-items:flex-start;flex-direction:column">
                <div style="display: flex;">
                  <img style="width: 20px;height: 20px;" src="http://localhost/Tempe-Crackers/public/icon/weather.png" alt="">
                  <p>UVI</p>
                </div>
                <p><?= $data['data_weather']['hourly'][0]['uvi'] ?></p>
                
              </div>
            </div>
            

            
          </div>
        </div>
      <div class="swiper-wrapper">
        
        
        <?php
          $hour = $data['now_hour'];
          $count = 0;
          foreach ($data['data_weather']['hourly'] as $value) {    ?>
            <div class="swiper-slide" style="display: flex;flex-direction:column;align-items:center">
              <img src="<?= BASE_URL ?>/icon/weather_icon/<?= $data['data_weather']['hourly'][$count]['weather'][0]['icon']  ?>.png" alt="">
              <h5><?= $value['temp'] ?>&#8451</h5>
              <p><?php 
                  if($hour < 10){
                    echo "0$hour";
                  } 
                  else{
                    echo $hour;
                  }
                ?>.00</p>
            </div>
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