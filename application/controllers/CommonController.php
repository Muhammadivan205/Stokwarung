<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CommonController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangModel');
    date_default_timezone_set('Asia/Jakarta'); // pastikan timezone
  }

  public function index()
  {
    $this->load->model('BarangModel');

    $barang = $this->BarangModel->getAllBarang();

    $hour = date('H');
    if ($hour >= 5 && $hour < 11) {
      $salam = 'Selamat Pagi';
    } elseif ($hour >= 11 && $hour < 15) {
      $salam = 'Selamat Siang';
    } elseif ($hour >= 15 && $hour < 18) {
      $salam = 'Selamat Sore';
    } else {
      $salam = 'Selamat Malam';
    }

    $data = [
      'title' => 'Dashboard',
      'barang' => $barang,
      'salam' => $salam
    ];

    $this->load->view('layout', [
      'title' => 'Dashboard',
      'contents' => $this->load->view('dashboard', $data, true)
    ]);
  }
}
