<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoryController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangModel');
  }

  public function index()
  {
    $data['barangMasuk'] = $this->BarangModel->getBarangMasukHistori();
    $data['barangKeluar'] = $this->BarangModel->getBarangKeluarHistori();

    $this->load->view('layout', [
      'title' => 'Histori Stok',
      'contents' => $this->load->view('pages/historyStok', $data, true)
    ]);
  }
}
