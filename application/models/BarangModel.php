<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BarangModel extends CI_Model
{
  // Cek atau buat satuan
  public function getOrCreateSatuan($nama)
  {
    $query = $this->db->get_where('satuan_barang', ['nama' => $nama]);
    if ($query->num_rows() > 0) {
      return $query->row()->id;
    } else {
      $this->db->insert('satuan_barang', ['nama' => $nama]);
      return $this->db->insert_id();
    }
  }

  // Simpan data barang baru
  public function createBarang($data)
  {
    $this->db->insert('barang', $data);
    return $this->db->insert_id();
  }

  // Simpan data barang masuk
  public function createBarangMasuk($data)
  {
    $this->db->insert('barang_masuk', $data);
  }

  // Ambil semua barang dengan nama satuannya
  public function getAllBarangWithSatuan()
  {
    $this->db->select('barang.*, satuan_barang.nama AS satuan');
    $this->db->from('barang');
    $this->db->join('satuan_barang', 'barang.satuan_id = satuan_barang.id', 'left');
    return $this->db->get()->result();
  }


  // Ambil semua barang (tanpa join)
  public function getAllBarang()
  {
    return $this->db->get('barang')->result();
  }

  public function getBarangById($id)
  {
    $this->db->select('barang.*, satuan_barang.nama AS nama_satuan');
    $this->db->from('barang');
    $this->db->join('satuan_barang', 'barang.satuan_id = satuan_barang.id', 'left');
    $this->db->where('barang.id', $id);
    return $this->db->get()->row();
  }


  public function updateStokBarang($id, $newStok)
  {
    $this->db->where('id', $id);
    $this->db->update('barang', ['total_stok' => $newStok]);
  }

  public function createBarangKeluar($data)
  {
    $this->db->insert('barang_keluar', $data);
  }

  public function getBarangMasukHistori()
  {
    $this->db->select('barang.nama_barang, barang_masuk.jumlah, barang.total_stok');
    $this->db->from('barang_masuk');
    $this->db->join('barang', 'barang_masuk.barang_id = barang.id');
    $this->db->order_by('barang_masuk.created_at', 'DESC');
    return $this->db->get()->result();
  }

  public function getBarangKeluarHistori()
  {
    $this->db->select('barang.nama_barang, barang_keluar.jumlah, barang.total_stok');
    $this->db->from('barang_keluar');
    $this->db->join('barang', 'barang_keluar.barang_id = barang.id');
    $this->db->order_by('barang_keluar.created_at', 'DESC');
    return $this->db->get()->result();
  }

  public function updateBarang($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('barang', $data);
  }
  public function deleteBarang($id)
  {
    // Hapus relasi dulu
    $this->db->where('barang_id', $id)->delete('barang_masuk');
    $this->db->where('barang_id', $id)->delete('barang_keluar');
    $this->db->where('barang_id', $id)->delete('notifikasi');
    $this->db->where('barang_id', $id)->delete('history_stok');

    // Baru hapus barangnya
    return $this->db->delete('barang', ['id' => $id]);
  }
}
