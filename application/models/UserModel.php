<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
  private $table = 'users';

  public function getByEmail($email) {
    return $this->db->get_where($this->table, ['email' => $email])->row();
  }

  public function createUser($data)
  {
    return $this->db->insert($this->table, $data);
  }
}
