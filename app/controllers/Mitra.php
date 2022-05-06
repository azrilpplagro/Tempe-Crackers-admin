<?php
class Mitra extends Controller{
  public function index(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    
    // echo $this->controller;
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "mitra_data" => $this->model("Mitra_model")->get_all_user()
    ];
    
    $this->view("header",$data['controller_name']);
    $this->view("Mitra/index",$data);
    $this->view("footer");
  
  }


  public function Profile(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $params = $_SESSION['params'];


    if(count($params)<1){
      header("Location: ".BASE_URL."/Mitra");
    }
    

    if(isset($_POST['edites'])){
      var_dump($_POST);
    }
    if(isset($_POST['edit'])){
      $data = [
        "email"=>$_POST['email'],
        "status"=>$_POST['status_akun']
      ];
      $this->view("Component/modal_deactivate_account",$data);
    }
    if(isset($_POST['change_account'])){
      $this->model("Mitra_model")->update_data($_POST);
      if($_POST['account_status'] == 1){
        $message = 'activated';
      }
      else if($_POST['account_status'] == 2 ){
        $message = 'deactivated';
      }
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => true,
        "title" => "Success",
        "message" => "Account $message successfully",
        "url" => '',
      ]);
    }

    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "mitra_data" => $this->model("Mitra_model")->get_specific_user($params[0])
    ];
      
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  
}

?>