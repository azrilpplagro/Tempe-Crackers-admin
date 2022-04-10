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
    
    // echo $this->controller;
    $this->view("header",$data['controller_name']);
    $this->view("Mitra/index",$data);
    $this->view("footer");
  
  }

  public function profile(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $params = $_SESSION['params'];
    if(count($params)<1){
      header("Location: ".BASE_URL."/Mitra");
    }
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "mitra_data" => $this->model("Mitra_model")->get_specific_user($params[0])
    ];
    // var_dump($data['mitra_data']);
    $this->view("header",$data['controller_name']);
    $this->view("Mitra/Profile",$data);
    $this->view("footer");
  }



  public function edit(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $params = $_SESSION['params'];


    if(count($params)<1){
      header("Location: ".BASE_URL."/Mitra");
    }
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "mitra_data" => $this->model("Mitra_model")->get_specific_user($params[0])
    ];

    if(isset($_POST['edites'])){
      var_dump($_POST);
    }

    if(isset($_POST['edit'])){
      $data_post = $_POST;
      // var_dump($data_post);
      // die();
      $this->view("Component/verifikasi_password",$data_post);
    }
    if(isset($_POST['verifikasi_password'])){
      if($_POST['password'] == $_SESSION['login-admin']['password']){
        $_POST = $_SESSION['form'];
        unset($_SESSION['form']);
          // cek nilai null
        $is_isset_null = false;
        foreach ($_POST as $value) {
          if($value == ""){
            $is_isset_null = true;
            break;
          }
        }
        $result = $this->model("Mitra_model")->update_data($_POST);
        if(is_bool($result) ){
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => true,
            "title" => "Success",
            "message" => "Data Berhasil Diperbarui",
            "url" => BASE_URL.'/Mitra/Profile/'.$params[0]
          ]);
        }
        else{
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => false,
            "title" => "Peringatan",
            "message" => "Data gagal diperbarui",
            "url" => BASE_URL.'/Mitra/edit/'.$params[0]
          ]);
        }
      }
      else{
        $this->view("Component/modal_redirect",$data_alert = [
          "type" => false,
          "title" => "Peringatan",
          "message" => "Password Salah",
          "url" => BASE_URL.'/Mitra/edit/'.$params[0]
        ]);
      }
      
    }


      
    
    // var_dump($data['mitra_data']);
    $this->view("header",$data['controller_name']);
    $this->view("Mitra/edit",$data);
    $this->view("footer");
  }

  
}

?>