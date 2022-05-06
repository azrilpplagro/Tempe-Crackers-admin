<?php
class Penjualan_model{

  private $table = "pesanan";
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }
  public function get_data(){
    $this->db->query(
      "SELECT tanggal_terima,total_pembayaran FROM $this->table ORDER BY id DESC"
    );
    return $this->db->result_set();
  }
}