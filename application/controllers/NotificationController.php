<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotificationController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('NotificationModel');
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {
    $data['notifikasi'] = $this->NotificationModel->getAll();

    $this->load->view('layout', [
      'title' => 'Notification',
      'contents' => $this->load->view('pages/notification', $data, true)
    ]);
  }
}
