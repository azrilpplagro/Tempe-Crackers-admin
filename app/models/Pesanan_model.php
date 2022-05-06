<?php
class Pesanan_model{

  private $table = "pesanan";
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }

  public function get_pesanan_by_email($email){
    $this->db->query(
      "SELECT * FROM $this->table WHERE mitra_email = :email ORDER BY id DESC"
    );
    $this->db->bind("email",$email);
    return $this->db->result_set();
  }

  public function get_pesanan(){
    $this->db->query(
      "SELECT * FROM $this->table WHERE bukti_pembayaran != '' AND batas_pembayaran >= CURRENT_DATE() AND status_diterima != 'Dibatalkan'  ORDER BY id DESC"
    );
    return $this->db->result_set();
  }

  public function get_pesanan_incoming(){
    $this->db->query(
      "SELECT * FROM $this->table WHERE batas_pembayaran >= CURRENT_DATE() AND status_diterima != 'Dibatalkan' AND status_pengiriman != 'Proses Pengiriman' AND status_pengiriman != 'Sudah Dikirim'  ORDER BY id DESC"
    );
    return $this->db->result_set();
  }

  public function get_pesanan_dikirim(){
    $this->db->query(
      "SELECT * FROM $this->table WHERE status_pengiriman = 'Proses Pengiriman' ORDER BY id DESC"
    );
    return $this->db->result_set();
  }

  public function get_detail_pengiriman($id){
    $this->db->query(
      "SELECT * FROM $this->table WHERE status_pengiriman = 'Proses Pengiriman' AND id = :id"
    );
    $this->db->bind('id',$id);
    return $this->db->single();
  }

  public function get_pesanan_sedang_dikemas(){
    $this->db->query(
      "SELECT * FROM $this->table WHERE  status_pembayaran = 'Lunas' AND status_pengiriman = 'Sedang Dikemas' ORDER BY id DESC"
    );
    return $this->db->result_set();
  }

  public function get_pesanan_dibatalkan(){
    $this->db->query(
      "SELECT * FROM $this->table WHERE  status_pembayaran = 'Dibatalkan' AND status_pengiriman = 'Dibatalkan' AND status_diterima = 'Dibatalkan' ORDER BY id DESC"
    );
    return $this->db->result_set();
  }



  public function get_detail_pemesanan($data){
    $this->db->query(
      "SELECT * FROM $this->table WHERE  id = :id"
    );
    $this->db->bind("id",$data['id']);
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

  public function confirm_payment($id){
    $this->db->query(
      "UPDATE $this->table SET status_pembayaran = 'Lunas', status_pengiriman = 'Sedang Dikemas' WHERE id = :id "
    );
    $this->db->bind('id',$id);
    $this->db->execute();
  }

  public function reject_payment($id){
    $this->db->query(
      "UPDATE $this->table SET status_pembayaran = 'Dibatalkan', status_pengiriman = 'Dibatalkan', status_diterima = 'Dibatalkan' WHERE id = :id "
    );
    $this->db->bind('id',$id);
    $this->db->execute();
  }
  public function confirm_shipping($id){
    $tanggal_terima = date("Y-m-d");
    $this->db->query(
      "UPDATE $this->table set status_pengiriman = 'Sudah Dikirim', status_diterima = 'Diterima', tanggal_terima = :tanggal_terima WHERE id=:id "
    );
    $this->db->bind('id',$id);
    $this->db->bind('tanggal_terima', $tanggal_terima);
    $this->db->execute();
  }


  public function send($data){
    $tanggal_pengiriman = date("Y-m-d");
    $this->db->query(
      "UPDATE $this->table SET no_resi = :no_resi,tanggal_pengiriman = :tanggal_pengiriman, status_pengiriman = 'Proses Pengiriman' WHERE id = :id "
    );
    $this->db->bind('id',$data['id']);
    $this->db->bind('no_resi',$data['no_resi']);
    $this->db->bind('tanggal_pengiriman',$tanggal_pengiriman);
    $this->db->execute();
  }
  public function pengiriman_selesai(){
    $this->db->query(
      "SELECT * FROM $this->table WHERE status_diterima  = 'Diterima' AND tanggal_terima IS NOT NULL ORDER BY id DESC"
    );
    return $this->db->result_set();
  }
  public function pengiriman_selesai_by_email($email){
    $this->db->query(
      "SELECT * FROM $this->table WHERE status_diterima  = 'Diterima'  AND mitra_email = :email AND tanggal_terima IS NOT NULL ORDER BY id DESC"
    );
    $this->db->bind('email',$email);
    return $this->db->result_set();
  }
  public function detail_pesanan_selesai($id){
    $this->db->query(
      "SELECT * FROM $this->table WHERE id = :id"
    );
    $this->db->bind('id',$id);
    return $this->db->single();
  }


  public function delete_expired_payment(){
    $this->db->query(
      "DELETE FROM $this->table WHERE  batas_pembayaran < CURRENT_DATE() AND bukti_pembayaran = ''"
    );
    $this->db->execute();
  }
}