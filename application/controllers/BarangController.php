<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/controllers/BarangController.php
class BarangController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangModel');
  }

  public function edit($id)
  {
    $barang = $this->BarangModel->getBarangById($id);

    if (!$barang) {
      show_404();
    }

    $data = [
      'title' => 'Edit Barang',
      'barang' => $barang
    ];

    $this->load->view('layout', [
      'title' => 'Edit Barang',
      'contents' => $this->load->view('pages/editBarang', $data, true)
    ]);
  }

  public function update($id)
  {
    $this->load->model('NotificationModel'); 
    $barang = $this->BarangModel->getBarangById($id); 

    $data = [
      'nama_barang'  => $this->input->post('nama_barang'),
      'kode_barang'  => $this->input->post('kode_barang'),
      'total_stok'   => $this->input->post('jumlah_barang'),
    ];

    // Satuan
    $satuan = $this->input->post('satuan_barang');
    $satuan_id = $this->BarangModel->getOrCreateSatuan($satuan);
    $data['satuan_id'] = $satuan_id;

    // Gambar (jika diupload)
    if (!empty($_FILES['gambar']['name'])) {
      $config['upload_path']   = './uploads/';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $config['file_name']     = time() . '-' . $_FILES['gambar']['name'];
      $this->load->library('upload', $config);

      if ($this->upload->do_upload('gambar')) {
        $data['gambar'] = $this->upload->data('file_name');
      }
    }

    $this->BarangModel->updateBarang($id, $data);

    // === 🔔 CEK STOK & NOTIFIKASI ===
    $stokBaru = floatval($data['total_stok']);
    $stokLama = floatval($barang->total_stok); // sebelum diubah

    $judul = '';
    $isi = '';

    if ($stokBaru == 0) {
      $judul = 'Stok Habis';
      $isi = 'Stok ' . $data['nama_barang'] . ' habis.';
    } elseif ($stokBaru > 0 && $stokBaru < 5) {
      $judul = 'Stok Menipis';
      $isi = 'Stok ' . $data['nama_barang'] . ' menipis – tinggal ' . $stokBaru;
    } elseif ($stokBaru >= 5 && $stokLama < 5) {
      $judul = 'Stok Aman';
      $isi = 'Stok ' . $data['nama_barang'] . ' aman kembali.';
    }

    if ($judul && $isi) {
      $this->NotificationModel->create([
        'title'     => $judul,
        'isi'       => $isi,
        'barang_id' => $id
      ]);
    }

    redirect('atur-stok');
  }

  public function delete($id)
  {
    $barang = $this->BarangModel->getBarangById($id);

    if (!$barang) {
      show_404();
    }

    // Hapus file gambar jika ada
    if (!empty($barang->gambar)) {
      $gambar_path = FCPATH . 'uploads/' . $barang->gambar;
      if (file_exists($gambar_path)) {
        unlink($gambar_path);
      }
    }

    $this->BarangModel->deleteBarang($id);
    $this->session->set_flashdata('success', 'Barang berhasil dihapus.');
    redirect('atur-stok');
  }
}
