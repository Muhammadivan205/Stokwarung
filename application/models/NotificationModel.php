<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotificationModel extends CI_Model
{
  public function create($data)
  {
    return $this->db->insert('notifikasi', $data);
  }

  public function getAll()
  {
    return $this->db
      ->select('n.*, b.nama_barang')
      ->from('notifikasi n')
      ->join('barang b', 'n.barang_id = b.id', 'left')
      ->order_by('n.created_at', 'DESC')
      ->get()
      ->result();
  }
}
