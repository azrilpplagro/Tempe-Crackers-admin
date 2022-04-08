<?php
class About extends Controller{
  
  public function index(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "user_data"=>$this->model("User_model")->get_data_user($_SESSION['login-admin']['email'])
    ];

    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");  
  }


  public function edit(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "user_data"=>$this->model("User_model")->get_data_user($_SESSION['login-admin']['email'])
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
                "url" => BASE_URL.'/About/edit'
              ]);
              $is_validate_phone_number = false;
              break;
            }
          }
  
          
          if($is_validate_phone_number == true){
            if(strlen($_POST['no_telepon']) < 11 || strlen($_POST['no_telepon']) > 14 ){
              $this->view("Component/modal_redirect",$data_alert = [
                "type" => false,
                "title" => "Peringatan",
                "message" => "panjang nomor telepon harus 11-12",
                "url" => BASE_URL.'/About/edit'
              ]);
              $is_validate_phone_number = false;
            }
          }
          if($is_validate_phone_number == true){
            if($this->model("User_model")->update_data($_POST) == true ){
              $this->view("Component/modal_redirect",$data_alert = [
                "type" => true,
                "title" => "Success",
                "message" => "Data Berhasil Diperbarui",
                "url" => BASE_URL.'/About'
              ]);
            }
            else{
              var_dump($this->model("User_model")->update_data($_POST));
            }
          }
          
        }
        else{
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => false,
            "title" => "Peringatan",
            "message" => "Semua From Harus Terisi",
            "url" => BASE_URL.'/About/edit'
          ]);
        } 
      }
      else{
        $this->view("Component/modal_redirect",$data_alert = [
          "type" => false,
          "title" => "Peringatan",
          "message" => "Password Salah",
          "url" => BASE_URL.'/About/edit'
        ]);
      }
    }
    if(isset($_POST['tombol_photo'])){
      $this->view("Component/upload_img",["title" => "Upload Gambar"]);
    }
    if(isset($_FILES['img_upload'])){
      if ( $_FILES['img_upload']['name'] != "" ){
        $photo = $this->model("User_model")->get_data_user($_SESSION['login-admin']['email'])['profil'];
        if($photo == ""){
          $this->uploadImg();
        }
        else if(file_exists(realpath($_SERVER["DOCUMENT_ROOT"])."/Tempe-Crackers-admin/public/img/$photo")){
          unlink(realpath($_SERVER["DOCUMENT_ROOT"])."/Tempe-Crackers-admin/public/img/$photo");
          $this->uploadImg(); 
        }
        
        
      }
    }
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }





  function uploadImg(){
    $imgName = $_FILES['img_upload']['name'];
    $error = $_FILES['img_upload']['error'];
    $size = $_FILES['img_upload']['size'];
    $locationUp = $_FILES['img_upload']['tmp_name'];
    $formatFile = $_FILES['img_upload']['type'];
    
    $format = "";
    $formatFix = "";
    for ($i = strlen($imgName)-1; $i>=0; $i--){
      $format .= $imgName[$i];
      if ($imgName[$i] == ".") {
        break;
      }
    }
    for ($i=strlen($format)-1;$i>=0;$i--){
      $formatFix .= $format[$i];
    }
    
    $nameFix = ucwords($_SESSION['login-admin']['email'].$formatFix);
    
    if ($error == 0 ){
      if ($size < 200000000000){
        // echo $formatFile;
        if($formatFile == 'image/jpeg' || $formatFile == 'image/png'){
          $path = realpath($_SERVER["DOCUMENT_ROOT"])."/Tempe-Crackers-admin/public/img";
          move_uploaded_file($locationUp,$path.'/'.$nameFix);
          $this->model("User_model")->upload_gambar($nameFix,$_SESSION['login-admin']['email']);
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => true,
            "title" => "Success",
            "message" => "Upload Avatar Berhasil",
            "url" => BASE_URL.'/About'
          ]);
        }
        else{
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => false,
            "title" => "warning",
            "message" => "format file harus jpg/png",
            "url" => BASE_URL.'/About/edit'
          ]);
        }
      }
      else{
        $this->view("Component/modal_redirect",$data_alert = [
          "type" => false,
          "title" => "warning",
          "message" => "ukuran file terlalu besar",
          "url" => BASE_URL.'/About/edit'
        ]);
      }
    }
    else{
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => false,
        "title" => "warning",
        "message" => "ukuran file terlalu besar",
        "url" => BASE_URL.'/About/edit'
      ]);
    }
  }
}










?>
