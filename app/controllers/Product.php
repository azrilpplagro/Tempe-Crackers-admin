<?php
class Product extends Controller{
  public function index(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    
    // echo $this->controller;
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "products" => $this->model("Product_model")->get_all_product()
    ];
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }


  public function detail_product(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $params = $_SESSION['params'];
    if(count($params)<1){
      header("Location: ".BASE_URL."/Product");
    }
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "detail_product" => $this->model("Product_model")->get_spesific_product($params)
    ];
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function add_new_product(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
    ];

    if(isset($_POST['create_new_product'])){
      $this->uploadImg($_POST);
    }
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function edit_product(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $params = $_SESSION['params'];
    if(count($params)<1){
      header("Location: ".BASE_URL."/Product");
    }
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "detail_product" => $this->model("Product_model")->get_spesific_product($params)
    ];

    if(isset($_POST['edit_product'])){
      $this->model("Product_model")->update_product($_POST);
      


      if($_FILES['gambar']['name'] != ""){
        $photo = $this->model("Product_model")->get_spesific_product($params)['gambar'];
        if(file_exists(realpath($_SERVER["DOCUMENT_ROOT"])."/Tempe-Crackers/public/img/products/$photo")){
          unlink(realpath($_SERVER["DOCUMENT_ROOT"])."/Tempe-Crackers/public/img/products/$photo");
          $this->update_img($params[0]);
        }
        else{
          $this->update_img($params[0]);
        }
      }

      $this->view("Component/modal_redirect",$data_alert = [
        "type" => true,
        "title" => "Success",
        "message" => "Data saved successfully",
        "url" => BASE_URL.'/Product'
      ]);

    }
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  
  




  function uploadImg($data_insert){
    $imgName = $_FILES['gambar']['name'];
    $error = $_FILES['gambar']['error'];
    $size = $_FILES['gambar']['size'];
    $locationUp = $_FILES['gambar']['tmp_name'];
    $formatFile = $_FILES['gambar']['type'];
    
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
    
    $nameFix = ucwords($this->model("Product_model")->get_last_id().$formatFix);
    
    if ($error == 0 ){
      if ($size < 200000000000){
        // echo $formatFile;
        if($formatFile == 'image/jpeg' || $formatFile == 'image/png'){
          $path = realpath($_SERVER["DOCUMENT_ROOT"])."/Tempe-Crackers/public/img/products";
          move_uploaded_file($locationUp,$path.'/'.$nameFix);
          $data_insert['gambar'] = $nameFix;
          $this->model("Product_model")->insert_product($data_insert);
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => true,
            "title" => "Success",
            "message" => "Product Upload Successful",
            "url" => BASE_URL.'/Product'
          ]);
        }
        else{
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => false,
            "title" => "warning",
            "message" => "File format must be jpg/png",
            "url" => BASE_URL.'/Product/add_new_product'
          ]);
        }
      }
      else{
        $this->view("Component/modal_redirect",$data_alert = [
          "type" => false,
          "title" => "warning",
          "message" => "File size is too big",
          "url" => BASE_URL.'/Product/add_new_product'
        ]);
      }
    }
    else{
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => false,
        "title" => "warning",
        "message" => "File size is too big",
        "url" => BASE_URL.'/Product/add_new_product'
      ]);
    }
  }

  function update_img($id){
    $imgName = $_FILES['gambar']['name'];
    $error = $_FILES['gambar']['error'];
    $size = $_FILES['gambar']['size'];
    $locationUp = $_FILES['gambar']['tmp_name'];
    $formatFile = $_FILES['gambar']['type'];
    
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
    $nameFix = ($id.$formatFix);

    if ($error == 0 ){
      if ($size < 200000000000){
        // echo $formatFile;
        if($formatFile == 'image/jpeg' || $formatFile == 'image/png'){
          $path = realpath($_SERVER["DOCUMENT_ROOT"])."/Tempe-Crackers/public/img/products";
          move_uploaded_file($locationUp,$path.'/'.$nameFix);
          $this->model("Product_model")->update_gambar($id,$nameFix);
        }
        else{
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => false,
            "title" => "warning",
            "message" => "File format must be jpg/png",
            "url" => BASE_URL.'/Product'
          ]);
        }
      }
      else{
        $this->view("Component/modal_redirect",$data_alert = [
          "type" => false,
          "title" => "warning",
          "message" => "File size is too big",
          "url" => BASE_URL.'/Product'
        ]);
      }
    }
    else{
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => false,
        "title" => "warning",
        "message" => "File size is too big",
        "url" => BASE_URL.'/Product'
      ]);
    }
  }
}