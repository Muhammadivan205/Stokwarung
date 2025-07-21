<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('UserModel');
  }

  public function index()
  {
    redirect('login');
  }

  public function login()
  {
    if ($this->input->method() === 'post') {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user = $this->UserModel->getByEmail($email);

      if ($user && password_verify($password, $user->password)) {
        $this->session->set_userdata('user', $user);
        redirect('dashboard');
        // $this->load->view('layout', [
        //   'title' => 'Dashboard',
        //   'contents' => $this->load->view('dashboard', isset($data) ? $data : [], true)
        // ]);
      } else {
        $data['error'] = 'Email atau password Anda salah.';
      }
    }

    $this->load->view('layout', [
      'title' => 'Login',
      'contents' => $this->load->view('auth/login', isset($data) ? $data : [], true)
    ]);
  }

  public function register()
  {
    if ($this->input->method() === 'post') {
      $name = $this->input->post('name');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $confirmPassword  = $this->input->post('confirm_password');

      if ($password !== $confirmPassword) {
        $data['error'] = 'Konfirmasi password tidak cocok';
      } elseif ($this->UserModel->getByEmail($email)) {
        $data['error'] = 'Email sudah terdaftar';
      } else {
        $this->UserModel->createUser([
          'name' => $name,
          'email' => $email,
          'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        redirect('login');
      }
    }

    $this->load->view('layout', [
      'title' => 'Register',
      'contents' => $this->load->view('auth/register', isset($data) ? $data : [], true)
    ]);
  }

  public function logout()
  {
    $this->session->unset_userdata('user');
    redirect('login');
  }
}
