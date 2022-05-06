<?php
class History_model{

  private $table = "pesanan";
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }

  public function get_last_order_date($email){
    $this->db->query(
      "SELECT tanggal_terima FROM $this->table WHERE mitra_email = :email  ORDER BY id DESC LIMIT 1"
    );
    $this->db->bind('email',$email);
    if(isset($this->db->single()['tanggal_terima'])){
      return $this->db->single()['tanggal_terima'];
    }
    else{
      return '';
    }
    
  }
  public function get_total_sales(){
    $this->db->query(
      "SELECT SUM(total_pembayaran) FROM $this->table WHERE status_diterima = 'Diterima'"
    );
    return $this->db->single()['SUM(total_pembayaran)'];
  }

  public function get_total_sales_of_mitra($email){
    $this->db->query(
      "SELECT SUM(total_pembayaran) FROM $this->table WHERE mitra_email = :email AND status_diterima = 'Diterima'"
    );
    $this->db->bind('email',$email);
    return $this->db->single()['SUM(total_pembayaran)'];
  }
}