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

    if(isset($_POST['year'])){
      // var_dump($_POST['year']);
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
      // var_dump($data_penjualan);
      
      // print_r($data_chart);
      // die();
    }
    
    
    // echo $this->controller;
    $data = [
      "controller_name" =>$controller_name,
      "method_name" => $method_name,
      'data_chart' => $data_chart
    ];
    
    // echo $this->controller;
    $this->view("header",$data['controller_name']);
    $this->view("Home/index",$data);
    $this->view("footer");
  }
}
?>