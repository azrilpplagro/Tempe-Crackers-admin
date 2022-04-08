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
        if($is_isset_null == false){
          $is_validate_phone_number = true;
          foreach ( str_split($_POST['no_telepon']) as $char) {
            if(!is_numeric($char)){
              $this->view("Component/modal_redirect",$data_alert = [
                "type" => false,
                "title" => "Peringatan",
                "message" => "Nomor telepon harus angka!",
                "url" => BASE_URL.'/Mitra/edit/'.$params[0]
              ]);
              $is_validate_phone_number = false;
              break;
            }
          }
          if($is_validate_phone_number == true){
            if(strlen($_POST['no_telepon']) < 11 || strlen($_POST['no_telepon']) > 12 ){
              $this->view("Component/modal_redirect",$data_alert = [
                "type" => false,
                "title" => "Peringatan",
                "message" => "panjang nomor telepon harus 11-12",
                "url" => BASE_URL.'/Mitra/edit/'.$params[0]
              ]);
              $is_validate_phone_number = false;
            }
          }

          if($is_validate_phone_number == true){
            $result = $this->model("Mitra_model")->update_data($_POST);
            if(is_bool($result) ){
              $this->view("Component/modal_redirect",$data_alert = [
                "type" => true,
                "title" => "Success",
                "message" => "Data Berhasil Diperbarui",
                "url" => BASE_URL.'/Mitra/Profile/'.$_POST['username']
              ]);
            }
            else{
              $key = "";
              if($_POST['username'] == $result['username']){
                $key .= ",username";
              }
              if($_POST['no_telepon'] == $result['no_telepon']){
                $key .= ",no telepon";
              }
              $key = substr_replace($key, '', 0, 1);
    
              $this->view("Component/modal_redirect",$data_alert = [
                "type" => false,
                "title" => "Warning",
                "message" => "$key yang anda masukan sudah dipakai",
                "url" => BASE_URL.'/Mitra/edit/'.$params[0]
              ]);
            }
          }
        }
        else{
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => false,
            "title" => "Peringatan",
            "message" => "Data input tidak boleh ada yang kosong",
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