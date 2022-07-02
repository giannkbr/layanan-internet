<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_m extends CI_Model {

  public function add($post)
  {
      $params = [
          'name' => $post['name'],
          'no_services' => $post['no_services'],
          'no_ktp' => $post['no_ktp'],
          'email' => $post['email'],
          'no_wa' => $post['no_wa'],
          'address' => $post['address'],
          'c_status' => 2,
          'created' => time(),
      ];
      $this->db->insert('customer', $params);
  }

}

/* End of file Transaction_m.php */
