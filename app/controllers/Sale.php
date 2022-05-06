<?php
class Sale extends Controller{
  public function __construct()
  {
    parent::__construct();
    $this->model("Pesanan_model")->delete_expired_payment();
  }

  public function index(){
    header("Location: ".BASE_URL."/Sale/incoming");

    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];

    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      // "list_order" => $this->model("Pesanan_model")->get_pesanan_by_email($_SESSION['login']['email'])
    ];
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function incoming(){

    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];

    if(isset($_POST['tombol_confirm'])){
      $this->view("Component/confirm_shipping",["id"=>$_POST['tombol_confirm']]);
    }
    if(isset($_POST['confirm_shipping'])){
      $this->model("Pesanan_model")->confirm_shipping($_POST['id']);
      header("Location: ".BASE_URL."/Sale/done");
    }

    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "list_order" => $this->model("Pesanan_model")->get_pesanan_incoming()
    ];
    
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function sent(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];

    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "list_order" => $this->model("Pesanan_model")->get_pesanan_dikirim()
    ];

    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }
  
  public function detail_shipping(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    if(!isset($_SESSION['params'][0])){
      header("Location: ".BASE_URL."/Sale/sent");
    }
    else{
      $params = $_SESSION['params'][0];
    }

    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "detail_order" => $this->model("Pesanan_model")->get_detail_pengiriman($params)
    ];

    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function done(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];

    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "list_order" => $this->model("Pesanan_model")->pengiriman_selesai()
    ];
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }
  public function detail_order_done(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    if(!isset($_SESSION['params'][0])){
      header("Location: ".BASE_URL."/Sale/done");
    }
    else{
      $params = $_SESSION['params'][0];
    }
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "detail_order" => $this->model("Pesanan_model")->detail_pesanan_selesai($params)
    ];

    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function canceled(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];

    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "list_order" => $this->model("Pesanan_model")->get_pesanan_dibatalkan()
    ];
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  }

  public function payment_validation(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    if(!isset($_SESSION['params'][0])){
      header("Location: ".BASE_URL."/Sale");
    }
    else{
      $params = $_SESSION['params'][0];
    }
    if(isset($_POST['tombol-confirm'])){
      $this->view("Component/confirm_payment",["id"=>$_POST['id']]);
    }
    if(isset($_POST['tombol-reject'])){
      $this->view("Component/reject_payment",["id"=>$_POST['id']]);
    }
    if(isset($_POST['cancel'])){
      header("Location: ".BASE_URL."/Sale/payment_validation/$params");
    }
    if(isset($_POST['confirm'])){
      $this->model("Pesanan_model")->confirm_payment($_POST['id']);
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => true,
        "title" => "Success",
        "message" => "Payment confirmation successful!",
        "url" => BASE_URL.'/Sale/payment_validation/'.$params
      ]);
    }
    if(isset($_POST['reject'])){
      $this->model("Pesanan_model")->reject_payment($_POST['id']);
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => true,
        "title" => "Success",
        "message" => "Payment reject successful!",
        "url" => BASE_URL.'/Sale'
      ]);
    }

    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "detail_order" => $this->model("Pesanan_model")->get_detail_pemesanan([
        "id" => $params
      ]),
      
    ];
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  
  }

  public function shipping_validation(){
    $controller_name = $_SESSION['controller_name'];
    $method_name = $_SESSION['method_name'];
    if(!isset($_SESSION['params'][0])){
      header("Location: ".BASE_URL."/Sale");
    }
    else{
      $params = $_SESSION['params'][0];
    }

    if(isset($_POST['send'])){
      $this->model("Pesanan_model")->send($_POST);
      $this->view("Component/modal_redirect",$data_alert = [
        "type" => true,
        "title" => "Success",
        "message" => "Product shipped successfully!",
        "url" => BASE_URL.'/Sale/income'
      ]);
    }
    
    $data = [
      "controller_name"=>$controller_name,
      "method_name"=> $method_name,
      "detail_order" => $this->model("Pesanan_model")->get_detail_pemesanan([
        "id" => $params
      ]),
      
    ];
    
    $this->view("header",$data['controller_name']);
    $this->view("$controller_name/$method_name",$data);
    $this->view("footer");
  
  
  }

}