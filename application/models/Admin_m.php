<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model {

  public function getAdmin($id = null)
  {
      $this->db->select('*');
      $this->db->from('user');
      if ($id != null) {
          $this->db->where('id', $id);
      }
      $this->db->order_by('name', 'DESC');
      $query = $this->db->get();
      return $query;
  }

  public function add($post)
  {
      $params = [
          'name' => $post['name'],
          'email' => $post['email'],
          'password' => password_hash( $post['password'], PASSWORD_DEFAULT),
          'alamat' => $post['alamat'],
          'role_id' => 1,
          'is_active' => 1,
          'date_created' => time(),
      ];
      $this->db->insert('user', $params);
  }

  public function edit($post)
  {
         $params = [
          'name' => $post['name'],
          'email' => $post['email'],
          'password' => password_hash( $post['password'], PASSWORD_DEFAULT),
          'address' => $post['address'],
          'role_id' => 1,
          'is_active' => 1,
          'date_created' => time(),
      ];
        $this->db->where('id', $post['id']);
        $this->db->update('user', $params);
  }

  public function delete($id)
  {
      $this->db->where('id', $id);
      $this->db->delete('user');
  }

}

/* End of file Admin_m.php */