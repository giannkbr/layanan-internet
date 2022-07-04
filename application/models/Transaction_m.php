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
          'p_item_id' => $post['p_item_id'],
          'c_status' => 1,
          'created' => time(),
      ];
      $this->db->insert('customer', $params);
  }

  public function addServices($post)
  {
      $params = [
          'no_services' => $post['no_services'],
          'price' => $post['price'],
          'qty' => $post['qty'],
          'disc' => 0,
          'total' => $post['qty'] * $post['price'],
          'services_create' => time()
      ];
      $this->db->insert('services', $params);
  }

}

/* End of file Transaction_m.php */
