<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluarController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangModel');
    $this->load->model('NotificationModel');
  }

  public function index()
  {
    $data['barang'] = $this->BarangModel->getAllBarangWithSatuan();

    $this->load->view('layout', [
      'title' => 'Atur Barang Keluar',
      'contents' => $this->load->view('pages/barangKeluar', $data, true)
    ]);
  }

  public function store()
  {
    $barang_id = $this->input->post('barang_id');
    $jumlah_keluar = $this->input->post('jumlah_barang');

    $barang = $this->BarangModel->getBarangById($barang_id);
    if (!$barang) {
      show_error("Barang tidak ditemukan");
      return;
    }

    if ($barang->total_stok < $jumlah_keluar) {
      $this->session->set_flashdata('error', 'Stok tidak mencukupi untuk barang yang dipilih.');
      redirect('barang-keluar');
      return;
    }

    $stokBaru = $barang->total_stok - $jumlah_keluar;

    // Kurangi stok
    $this->BarangModel->updateStokBarang($barang_id, $stokBaru);

    // Simpan barang keluar
    $this->BarangModel->createBarangKeluar([
      'barang_id' => $barang_id,
      'jumlah' => $jumlah_keluar,
      'keterangan' => 'Barang keluar dari stok'
    ]);

    // 🔔 Cek & Buat Notifikasi
    $judul = '';
    $isi = '';

    if ($stokBaru == 0) {
      $judul = 'Stok Habis';
      $isi = 'Stok ' . $barang->nama_barang . ' habis.';
    } elseif ($stokBaru > 0 && $stokBaru < 5) {
      $judul = 'Stok Menipis';
      $isi = 'Stok ' . $barang->nama_barang . ' menipis – tinggal ' . $stokBaru;
    }

    if ($judul && $isi) {
      $this->NotificationModel->create([
        'title'     => $judul,
        'isi'       => $isi,
        'barang_id' => $barang_id
      ]);
    }

    $this->session->set_flashdata('success', 'Barang keluar berhasil dicatat.');
    redirect('atur-stok');
  }
}
