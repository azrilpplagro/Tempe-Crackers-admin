<?php
class Home extends Controller{

  public function index(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $data_chart = [
      'January'=>0,
      'February'=>0,
      'March'=>0,
      'April'=>0,
      'May'=>0,
      'June'=>0,
      'July'=>0,
      'August'=>0,
      'September'=>0,
      'October'=>0,
      'November'=>0,
      'Desember'=>0
    ];

    if(!isset($_POST['year'])){
      $_POST['year'] = date("Y");
    }
    $data_model = $this->model("Penjualan_model")->get_data();
      $data_penjualan = [];
      // var_dump($data_penjualan);
      foreach ($data_model as $value) {
        if(substr($value['tanggal_terima'], 0, 4) == $_POST['year']){
          $date =[
            "total_pembayaran"=>$value['total_pembayaran'],
            "year"=> substr($value['tanggal_terima'], 0, 4),
            "month" => substr($value['tanggal_terima'], 5,2),
          ];
          array_push($data_penjualan,$date);
        }
      }

      
      foreach ($data_penjualan as $value) {
        if($value['month'] == 1){
          if($data_chart['January'] != 0){
            $data_chart['January'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['January'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 2){
          if($data_chart['February'] != 0){
            $data_chart['February'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['February'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 3){
          if($data_chart['March'] != 0){
            $data_chart['March'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['March'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 4){
          if($data_chart['April'] != 0){
            $data_chart['April'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['April'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 5){
          if($data_chart['May'] != 0){
            $data_chart['May'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['May'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 6){
          if($data_chart['June'] != 0){
            $data_chart['June'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['June'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 7){
          if($data_chart['July'] != 0){
            $data_chart['July'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['July'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 8){
          if($data_chart['August'] != 0){
            $data_chart['August'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['August'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 9){
          if($data_chart['September'] != 0){
            $data_chart['September'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['September'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 10){
          if($data_chart['October'] != 0){
            $data_chart['October'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['October'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 11){
          if($data_chart['November'] != 0){
            $data_chart['November'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['November'] = $value['total_pembayaran'];
          }
          
        }
        if($value['month'] == 12){
          if($data_chart['Desember'] != 0){
            $data_chart['Desember'] += $value['total_pembayaran'];
          }
          else{
            $data_chart['Desember'] = $value['total_pembayaran'];
          }
          
        }
      }
    
    
    // echo $this->controller;
    date_default_timezone_set("Asia/Jakarta");
    $now_hour = (date('H'));

    // data cuaca
    $api_key = "2c2b8f37e36ebf41cbf0827ea2b484bf";
    $city_name = "Puger";
    $lat = -8.3702;
    $lot = 113.4752;
    $api_url = "https://openweathermap.org/data/2.5/onecall?lat=-8.3702&lon=113.4752&units=metric&appid=439d4b804bc8187953eb36d2a8c26a02";
    $weather_data = json_decode(file_get_contents($api_url),true);
    $data_weather = $weather_data; 
    //

    $data = [
      "controller_name" =>$controller_name,
      "method_name" => $method_name,
      'data_chart' => $data_chart,
      "now_hour" => $now_hour,
      "user_data"=>$this->model("User_model")->get_data_user($_SESSION['login-admin']['email']),
      "data_weather"=>$data_weather
    ];
    
    // echo $this->controller;
    $this->view("header",$data['controller_name']);
    $this->view("Home/index",$data);
    $this->view("footer");
  }

  public function week_forecast(){
    $now_date = date("Y/m/d");
    $now_date = strtotime($now_date);
    $week_day_data = array(
      [
        "date" => date('M d, Y', $now_date),
        "day_name" => date('l', strtotime("+0 day", $now_date) )
      ]
    );
    

    for ($i=1; $i <=7 ; $i++) { 
      $now_date = strtotime("+1 day", $now_date);
      $data_day = [
        "date" => date('M d', $now_date),
        "day_name" => date('l', strtotime("+0 day", $now_date) )
      ];
      array_push($week_day_data,$data_day);
    }

    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];

    date_default_timezone_set("Asia/Jakarta");
    $now_hour = (date('H'));

    // data cuaca
    $api_key = "2c2b8f37e36ebf41cbf0827ea2b484bf";
    $city_name = "Puger";
    $lat = -8.3702;
    $lot = 113.4752;
    $api_url = "https://openweathermap.org/data/2.5/onecall?lat=-8.3702&lon=113.4752&units=metric&appid=439d4b804bc8187953eb36d2a8c26a02";
    $weather_data = json_decode(file_get_contents($api_url),true);
    $data_weather = $weather_data; 
    //

    $data = [
      "controller_name" =>$controller_name,
      "method_name" => $method_name,
      "now_hour" => $now_hour,
      "user_data"=>$this->model("User_model")->get_data_user($_SESSION['login-admin']['email']),
      "data_weather"=>$data_weather,
      "week_day_data" => $week_day_data
    ];
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function hourly(){
    $now_date = date("Y/m/d");
    $now_date = strtotime($now_date);
    $week_day_data = array(
      [
        "date" => date('M d, Y', $now_date),
        "day_name" => date('l', strtotime("+0 day", $now_date) )
      ]
    );
    

    for ($i=1; $i <=7 ; $i++) { 
      $now_date = strtotime("+1 day", $now_date);
      $data_day = [
        "date" => date('M d', $now_date),
        "day_name" => date('l', strtotime("+0 day", $now_date) )
      ];
      array_push($week_day_data,$data_day);
    }
    
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];

    date_default_timezone_set("Asia/Jakarta");
    $now_hour = (date('H'));

    // data cuaca
    $api_key = "2c2b8f37e36ebf41cbf0827ea2b484bf";
    $city_name = "Puger";
    $lat = -8.3702;
    $lot = 113.4752;
    $api_url = "https://openweathermap.org/data/2.5/onecall?lat=-8.3702&lon=113.4752&units=metric&appid=439d4b804bc8187953eb36d2a8c26a02";
    $weather_data = json_decode(file_get_contents($api_url),true);
    $data_weather = $weather_data; 

    $data = [
      "controller_name" =>$controller_name,
      "method_name" => $method_name,
      "now_hour" => $now_hour,
      "user_data"=>$this->model("User_model")->get_data_user($_SESSION['login-admin']['email']),
      "data_weather"=>$data_weather,
      "week_day_data" => $week_day_data
    ];
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }


  public function another_day(){

    $now_date = date("Y/m/d");
    $now_date = strtotime($now_date);
    $week_day_data = array(
      [
        "date" => date('M d, Y', $now_date),
        "day_name" => date('l', strtotime("+0 day", $now_date) )
      ]
    );
    

    for ($i=1; $i <=7 ; $i++) { 
      $now_date = strtotime("+1 day", $now_date);
      $data_day = [
        "date" => date('M d', $now_date),
        "day_name" => date('l', strtotime("+0 day", $now_date) )
      ];
      array_push($week_day_data,$data_day);
    }


    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    if(!isset($_SESSION['params'][0])){
      header("Location: ".BASE_URL."/Home/week_forecast");
    }
    else{
      if ( $_SESSION['params'][0] >= 1 && $_SESSION['params'][0] <= 7  ){
        $params = $_SESSION['params'][0];
        
      }
      else{
        header("Location: ".BASE_URL."/Home/week_forecast");
      }
    }

    $api_key = "2c2b8f37e36ebf41cbf0827ea2b484bf";
    $city_name = "Puger";
    $lat = -8.3702;
    $lot = 113.4752;
    $api_url = "https://openweathermap.org/data/2.5/onecall?lat=-8.3702&lon=113.4752&units=metric&appid=439d4b804bc8187953eb36d2a8c26a02";
    $weather_data = json_decode(file_get_contents($api_url),true);
    $data_weather = $weather_data; 

    
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "data_weather"=>$data_weather,
      "week_day_data" => $week_day_data
    ];
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }
}
?>