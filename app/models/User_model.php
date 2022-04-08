<?php
class User_model{

  private $table = "admin";
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }


  // public function get_all_user(){
  //   $this->db->query("SELECT * FROM $this->table ORDER BY id DESC");
  //   return $this->db->result_set();
  // } 

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
  
  // public function get_specific_user($username){
  //   try {
  //     $query = "SELECT * FROM $this->table WHERE username = :username";
  //     $this->db->query($query);
  //     $this->db->bind('username',$username);
  //     return $this->db->single();
  //   } catch (\Throwable $th) {
  //     return "Error";
  //   }
    
  // }

  public function update_data($data){
    
    try{
      $query = "UPDATE $this->table SET alamat = :alamat,desa_id = :desa,kecamatan_id = :kecamatan,kabupaten_id = :kabupaten,provinsi_id = :provinsi,negara_id = :negara, username = :username ,no_telepon = :no_telepon, tanggal_lahir = :tanggal_lahir,jenis_kelamin_id = :jenis_kelamin,nama_lengkap= :nama_lengkap WHERE email= :email";
      $this->db->query($query);
      $this->db->bind('email',$data['email']);
      $this->db->bind('username',$data['username']);
      $this->db->bind('no_telepon',$data['no_telepon']);
      $this->db->bind('nama_lengkap',$data['nama_lengkap']);
      $this->db->bind('jenis_kelamin',$data['jenis_kelamin']);
      $this->db->bind('tanggal_lahir',$data['tanggal_lahir']);
      $this->db->bind('alamat',$data['alamat']);
      $this->db->bind('desa',$data['desa']);
      $this->db->bind('kecamatan',$data['kecamatan']);
      $this->db->bind('kabupaten',$data['kabupaten']);
      $this->db->bind('provinsi',$data['provinsi']);
      $this->db->bind('negara',$data['negara']);
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


  public function upload_gambar($name,$email){
    $query = "UPDATE $this->table SET profil = :profil WHERE email = :email";
    $this->db->query($query);
    $this->db->bind('profil',$name);
    $this->db->bind('email',$email);
    $this->db->execute();

  }
}

?>