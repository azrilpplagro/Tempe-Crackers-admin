<?php
class Article_model{

  private $table = "artikel";
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }

  public function get_all_article(){
    $query = "SELECT * FROM $this->table ORDER BY id DESC";
    $this->db->query($query);
    return $this->db->result_set();
  }

  public function get_article($id){
    $query = "SELECT * FROM $this->table WHERE id =:id";
    $this->db->query($query);
    $this->db->bind("id",$id[0]);
    return $this->db->single();
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

  public function insert_article($data){
    $query = "INSERT INTO $this->table VALUES(0,:tanggal_terbit,:admin_email,:judul,:isi,:gambar)";
    $this->db->query($query);
    $this->db->bind('tanggal_terbit',$data['tanggal_terbit']);
    $this->db->bind('admin_email',$data['admin_email']);
    $this->db->bind('judul',$data['judul']);
    $this->db->bind('isi',$data['isi']);
    $this->db->bind('gambar',$data['gambar']);
    $this->db->execute();
  }

  public function update_article($data){
    $query = "UPDATE $this->table set judul = :judul, isi = :isi WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$data['id']);
    $this->db->bind('judul',$data['judul']);
    $this->db->bind('isi',$data['isi']);
    $this->db->execute();
  }

  public function update_gambar($id,$gambar){
    $query = "UPDATE $this->table set gambar = :gambar WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id);
    $this->db->bind('gambar',$gambar);
    $this->db->execute();
  }


}
?>