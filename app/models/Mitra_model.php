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

    $query = "SELECT * FROM $this->table WHERE (username = :username  || no_telepon = :no_telepon) && email != :email ";
    $this->db->query($query);
    $this->db->bind('email',$data['email']);
    $this->db->bind('username',$data['username']);
    $this->db->bind('no_telepon',$data['no_telepon']);
    if ($this->db->single() == false ){
      try{
        $query = "UPDATE $this->table SET alamat = :alamat, desa_id = :desa,kecamatan_id = :kecamatan,kabupaten_id = :kabupaten,provinsi_id = :provinsi,negara_id = :negara, username = :username ,no_telepon = :no_telepon,status_akun_id = :status_akun, tanggal_lahir = :tanggal_lahir,jenis_kelamin_id = :jenis_kelamin,nama_lengkap= :nama_lengkap WHERE email= :email";
        $this->db->query($query);
        $this->db->bind('email',$data['email']);
        $this->db->bind('username',$data['username']);
        $this->db->bind('no_telepon',$data['no_telepon']);
        $this->db->bind('nama_lengkap',$data['nama_lengkap']);
        $this->db->bind('jenis_kelamin',$data['jenis_kelamin']);
        $this->db->bind('tanggal_lahir',$data['tanggal_lahir']);
        $this->db->bind('status_akun',$data['status_akun']);
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
    else{
      return $this->db->single();
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
    $output .= ",".$this->db->single()['nama_desa'];

    $query = "SELECT * FROM kecamatan WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id_kecamatan);
    $output .= ", ".$this->db->single()['nama_kecamatan']; 

    $query = "SELECT * FROM kabupaten WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id_kabupaten);
    $output .= ", ".$this->db->single()['nama_kabupaten']; 

    $query = "SELECT * FROM provinsi WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id_provinsi);
    $output .= ", ".$this->db->single()['nama_provinsi']; 

    $query = "SELECT * FROM negara WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id',$id_negara);
    $output .= ", ".$this->db->single()['nama_negara']; 


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