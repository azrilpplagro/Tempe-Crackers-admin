<?php
class History extends Controller{
  public function index(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "data_mitra" => $this->model("Mitra_model")->get_all_user()
    ];

    if(isset($_POST['search'])){
      $data = [
        "controller_name"=>$controller_name,
        "method_name"=> $method_name,
        "data_mitra" => $this->model("Mitra_model")->searching_all_user($_POST['search'])
      ];
    }
    else{
      $data = [
        "controller_name"=>$controller_name,
        "method_name"=> $method_name,
        "data_mitra" => $this->model("Mitra_model")->get_all_user()
      ];
    }

    $index = 0;
    foreach ($data['data_mitra'] as $mitra) {
      $data['data_mitra'][$index]['last_order_date'] = $this->model("History_model")->get_last_order_date($data['data_mitra'][$index]['email']);
      $data['data_mitra'][$index]['total_sale'] = $this->model("History_model")->get_total_sales_of_mitra($mitra['email']);

      $index ++;

    }

    if(isset($_POST['total_sale_sort_desc'])){
      $data['data_mitra'] = $this->merge_sort_descending($data['data_mitra']);
    }
    
    
    if(isset($_POST['date_sort_desc'])){
      function date_compare($element1, $element2) {
        $datetime1 = strtotime($element1['last_order_date']);
        $datetime2 = strtotime($element2['last_order_date']);
        return $datetime2 - $datetime1;
      } 
      usort($data['data_mitra'], 'date_compare');
    }

    if(isset($_POST['name_sort_asc'])){
      function compareByName($a, $b) {
        return strcmp($a["nama_lengkap"], $b["nama_lengkap"]);
      }
      usort($data['data_mitra'], 'compareByName');
    }
    if(isset($_POST['name_sort_desc'])){
      function compareByName($a, $b) {
        return strcmp($b["nama_lengkap"], $a["nama_lengkap"]);
      }
      usort($data['data_mitra'], 'compareByName');
    }
    
    
    

    

  
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");    
  }

  public function profile(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    if(!isset($_SESSION['params'][0])){
      header("Location: ".BASE_URL."/History");
    }
    else{
      $params = $_SESSION['params'][0];
    }
    
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "list_order" => $this->model("Pesanan_model")->pengiriman_selesai_by_email($params)
    ];
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");    
  }


  function merge_sort_descending($my_array){
    if(count($my_array) == 1 ) return $my_array;
    $mid = count($my_array) / 2;
      $left = array_slice($my_array, 0, $mid);
      $right = array_slice($my_array, $mid);
    $left = $this->merge_sort_descending($left);
    $right = $this->merge_sort_descending($right);
    return $this->merge($left, $right);
  }
  function merge($left, $right){
    $res = array();
    while (count($left) > 0 && count($right) > 0){
      if($left[0]['total_sale'] > $right[0]['total_sale']){
        $res[] = $right[0];
        $right = array_slice($right , 1);
      }else{
        $res[] = $left[0];
        $left = array_slice($left, 1);
      }
    }
    while (count($left) > 0){
      $res[] = $left[0];
      $left = array_slice($left, 1);
    }
    while (count($right) > 0){
      $res[] = $right[0];
      $right = array_slice($right, 1);
    }
    return $res;
  }

  

}