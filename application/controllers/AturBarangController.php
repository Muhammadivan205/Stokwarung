<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AturBarangController extends CI_Controller
{
  public function index()
{
  $this->load->model('BarangModel');
  $data['barang'] = $this->BarangModel->getAllBarangWithSatuan();

  $this->load->view('layout', [
    'title' => 'Atur Stok',
    'contents' => $this->load->view('pages/aturStok', $data, true)
  ]);
}

}
