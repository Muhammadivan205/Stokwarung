<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangModel');
  }

  public function index()
  {
    $data['barang'] = $this->BarangModel->getAllBarangWithSatuan();
    $this->load->view('layout', [
      'title' => 'Laporan Stok',
      'contents' => $this->load->view('pages/laporanStok', $data, true)
    ]);
  }
}
