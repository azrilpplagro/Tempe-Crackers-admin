<?php
class Mitra_model{

  private $table = "akun_mitra";
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }
  public function get_all_user(){
    $this->db->query("SELECT * FROM $this->table");
    return $this->db->result_set();
  }
  public function get_data_user($email){
    try {
      $query = "SELECT * FROM $this->table WHERE email = :email";
      $this->db->query($query);
      $this->db->bind('email',$email);
      return $this->db->single();
    } catch (\Throwable $th) {
      return "Error";
    }
  }
  public function get_specific_user($username){
    try {
      $query = "SELECT * FROM $this->table WHERE username = :username";
      $this->db->query($query);
      $this->db->bind('username',$username);
      return $this->db->single();
    } catch (\Throwable $th) {
      return "Error";
    }
  }
  public function update_data($data){
    try{
      $query = "UPDATE $this->table SET status_akun_id = :status_akun WHERE email= :email";
      $this->db->query($query);
      $this->db->bind('email',$data['email']);
      $this->db->bind('status_akun',$data['status_akun']);
      $this->db->execute();
      return true;
    }
    catch (\Throwable $th) {
      return false;
    }
  }
  public function login($email, $password){
    $query = "SELECT * FROM $this->table WHERE email = :email && password = :password";
    $this->db->query($query);
    $this->db->bind('email',$email);
    $this->db->bind('password',$password);
    return $this->db->single();
  }


  public function get_spesifik_alamat($id_desa,$id_kecamatan,$id_kabupaten,$id_provinsi,$id_negara){
    // Desa
    $output = "";
    $query = "SELECT * FROM desa WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id_desa);

    if(!is_bool($this->db->single())){
      $output .= ",".$this->db->single()['nama_desa'];
    }
    else{
      $output .= "";
    }
    $query = "SELECT * FROM kecamatan WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id_kecamatan);
    if(!is_bool($this->db->single())){
      $output .= ",".$this->db->single()['nama_kecamatan'];
    }
    else{
      $output .= "";
    }
    $query = "SELECT * FROM kabupaten WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id_kabupaten);
    if(!is_bool($this->db->single())){
      $output .= ",".$this->db->single()['nama_kabupaten'];
    }
    else{
      $output .= "";
    }
    $query = "SELECT * FROM provinsi WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id_provinsi);
    if(!is_bool($this->db->single())){
      $output .= ",".$this->db->single()['nama_provinsi'];
    }
    else{
      $output .= "";
    }
    $query = "SELECT * FROM negara WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id_negara);
    if(!is_bool($this->db->single())){
      $output .= ",".$this->db->single()['nama_negara'];
    }
    else{
      $output .= "";
    }
    $output = substr_replace($output, '', 0, 1);
    return $output;
  }

  public function get_data_desa(){
    $query = "SELECT * FROM desa";
    $this->db->query($query);
    return $this->db->result_set();
  }
  public function get_data_kecamatan(){
    $query = "SELECT * FROM kecamatan";
    $this->db->query($query);
    return $this->db->result_set();
  }
  public function get_data_kabupaten(){
    $query = "SELECT * FROM kabupaten";
    $this->db->query($query);
    return $this->db->result_set();
  }
  public function get_data_provinsi(){
    $query = "SELECT * FROM provinsi";
    $this->db->query($query);
    return $this->db->result_set();
  }
  public function get_data_negara(){
    $query = "SELECT * FROM negara";
    $this->db->query($query);
    return $this->db->result_set();
  }
}
?>