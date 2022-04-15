<?php
class Article extends Controller{

  

  public function index(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    
    // echo $this->controller;
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "articles" => $this->model("Article_model")->get_all_article()
    ];
    
    // echo $this->controller;
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function detail_article(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $params = $_SESSION['params'];


    if(count($params)<1){
      header("Location: ".BASE_URL."/Article");
    }
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "article" => $this->model("Article_model")->get_article($params)
    ];
      
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function add_new_article(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    
    // echo $this->controller;
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
    ];

    if(isset($_POST['create_new_article'])){    
      $_POST['tanggal_terbit'] = date('Y-m-d');
      $_POST['admin_email'] = $_SESSION['login-admin']['email'];
      $this->uploadImg($_POST);
    }
    
    // echo $this->controller;
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }


  public function edit_article(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    $params = $_SESSION['params'];

    if(count($params)<1){
      header("Location: ".BASE_URL."/Article");
    }
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "article" => $this->model("Article_model")->get_article($params)
    ];

    if(isset($_POST['edit_article'])){
      $index_cut = 0;
      for ($i=strlen($_POST['db_gambar'])-1; $i >= 0 ; $i--) { 
        if($_POST['db_gambar'][$i] == "."){
          $index_cut += 1;
          break;
        }
        else{
          $index_cut += 1;
        }
      };
      $db_gambar = substr($_POST['db_gambar'], 0, -$index_cut);

      if($_FILES['gambar']['name'] != ""){
        $this->update_img($_POST['id'],$db_gambar);
      }


      $this->model("Article_model")->update_article($_POST);
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => true,
        "title" => "Success",
        "message" => "Data saved successfully",
        "url" => BASE_URL.'/Article'
      ]);
    }
    
    // echo $this->controller;
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
    
    $nameFix = ucwords($this->model("Article_model")->get_last_id().$formatFix);
    
    if ($error == 0 ){
      if ($size < 200000000000){
        // echo $formatFile;
        if($formatFile == 'image/jpeg' || $formatFile == 'image/png'){
          $path = realpath($_SERVER["DOCUMENT_ROOT"])."/Tempe-Crackers/public/img/article";
          move_uploaded_file($locationUp,$path.'/'.$nameFix);
          $data_insert['gambar'] = $nameFix;
          $this->model("Article_model")->insert_article($data_insert);
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => true,
            "title" => "Success",
            "message" => "Article Upload Successful",
            "url" => BASE_URL.'/Article'
          ]);
        }
        else{
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => false,
            "title" => "warning",
            "message" => "File format must be jpg/png",
            "url" => BASE_URL.'/Article'
          ]);
        }
      }
      else{
        $this->view("Component/modal_redirect",$data_alert = [
          "type" => false,
          "title" => "warning",
          "message" => "File size is too big",
          "url" => BASE_URL.'/Article'
        ]);
      }
    }
    else{
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => false,
        "title" => "warning",
        "message" => "File size is too big",
        "url" => BASE_URL.'/Article'
      ]);
    }
  }


  function update_img($id,$name){
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
    $nameFix = ($name.$formatFix);

    if ($error == 0 ){
      if ($size < 200000000000){
        // echo $formatFile;
        if($formatFile == 'image/jpeg' || $formatFile == 'image/png'){
          $path = realpath($_SERVER["DOCUMENT_ROOT"])."/Tempe-Crackers/public/img/article";
          move_uploaded_file($locationUp,$path.'/'.$nameFix);
          $this->model("Article_model")->update_gambar($id,$nameFix);
        }
        else{
          $this->view("Component/modal_redirect",$data_alert = [
            "type" => false,
            "title" => "warning",
            "message" => "File format must be jpg/png",
            "url" => BASE_URL.'/Article'
          ]);
        }
      }
      else{
        $this->view("Component/modal_redirect",$data_alert = [
          "type" => false,
          "title" => "warning",
          "message" => "File size is too big",
          "url" => BASE_URL.'/Article'
        ]);
      }
    }
    else{
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => false,
        "title" => "warning",
        "message" => "File size is too big",
        "url" => BASE_URL.'/Article'
      ]);
    }
  }
}
?>