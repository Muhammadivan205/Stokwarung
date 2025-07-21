<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasukController extends CI_Controller
{
  public function index()
  {
    $this->load->view('layout', [
      'title' => 'Atur Barang Masuk',
      'contents' => $this->load->view('pages/barangMasuk', isset($data) ? $data : [], true)
    ]);
  }

  public function store()
  {
    $nama_barang = $this->input->post('nama_barang');
    $kode_barang = $this->input->post('kode_barang');
    $jumlah = $this->input->post('jumlah_barang');
    $satuan = $this->input->post('satuan_barang');

    $config['upload_path']   = './uploads/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['encrypt_name']  = TRUE;
    $config['max_size']      = 2048;

    $this->load->library('upload', $config);

    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {
      if ($this->upload->do_upload('gambar')) {
        $uploadData = $this->upload->data();
        $gambar = $uploadData['file_name'];
      } else {
        echo $this->upload->display_errors();
        return;
      }
    }


    // Simpan satuan jika belum ada
    $this->load->model('BarangModel');
    $satuan_id = $this->BarangModel->getOrCreateSatuan($satuan);

    // Simpan barang
    $barang_id = $this->BarangModel->createBarang([
      'nama_barang' => $nama_barang,
      'kode_barang' => $kode_barang,
      'satuan_id' => $satuan_id,
      'gambar' => $gambar,
      'total_stok' => $jumlah,
      'stok_maks' => 0,
    ]);

    // Simpan ke tabel barang_masuk
    $this->BarangModel->createBarangMasuk([
      'barang_id' => $barang_id,
      'jumlah' => $jumlah,
      'keterangan' => 'Stok awal barang masuk'
    ]);

    redirect('atur-stok');
  }
}
