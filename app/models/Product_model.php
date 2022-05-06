<?php
class Product_model{

  private $table = "produk";
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }

  public function get_all_product(){
    $query = "SELECT * FROM $this->table ORDER BY id DESC";
    $this->db->query($query);
    return $this->db->result_set();
  }

  public function get_spesific_product($id){
    $query = "SELECT * FROM $this->table WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id[0]);
    return $this->db->single();

  }

  public function insert_product($data){
    $query = "INSERT INTO $this->table VALUES(0,:nama_produk,:stok,:berat,:deskripsi,:gambar,:harga,:expired,:stok_bulan)";
    $this->db->query($query);
    $this->db->bind('nama_produk',$data['product_name']);
    $this->db->bind('stok',$data['stock']);
    $this->db->bind('berat',$data['weight']);
    $this->db->bind('deskripsi',$data['description']);
    $this->db->bind('gambar',$data['gambar']);
    $this->db->bind('harga',$data['price']);
    $this->db->bind('expired',$data['expired']);
    $this->db->bind('stok_bulan',$data['stock_of_month']);
    $this->db->execute();
  }

  public function update_product($data){
    $query = "UPDATE $this->table set nama_produk = :nama_produk, stok = :stok, berat = :berat, deskripsi = :deskripsi, harga = :harga, expired = :expired, stok_bulan = :stok_bulan WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$data['id']);
    $this->db->bind('nama_produk',$data['product_name']);
    $this->db->bind('stok',$data['stock']);
    $this->db->bind('berat',$data['weight']);
    $this->db->bind('deskripsi',$data['description']);
    $this->db->bind('harga',$data['price']);
    $this->db->bind('expired',$data['expired']);
    $this->db->bind('stok_bulan',$data['stock_of_month']);
    $this->db->execute();

  }

  public function update_gambar($id,$gambar){
    $query = "UPDATE $this->table set gambar = :gambar WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id);
    $this->db->bind('gambar',$gambar);
    $this->db->execute();
  }

  public function get_last_id(){
    $query = "SELECT id FROM $this->table ORDER BY id DESC LIMIT 1";
    $this->db->query($query);
    if(is_bool($this->db->single())){
      $last_id = 1;
    }
    else{
      $last_id = $this->db->single()['id'] + 1;
    }
    return $last_id;
  }
}