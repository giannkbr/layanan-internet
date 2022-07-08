<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    is_logged_in();
    $this->load->model(['admin_m', 'services_m', 'bill_m']);
  }

  public function index()
  {
    $data['title'] = 'Admin';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['admin'] = $this->admin_m->getAdmin()->result();
    $data['company'] = $this->db->get('company')->row_array();
    $this->template->load('backend', 'backend/admin/data', $data);
  }


  public function add()
  {
      is_logged_in();
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
      $this->form_validation->set_rules('address', 'Alamat', 'required|trim');
      $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
      $this->form_validation->set_message('is_unique', '%s Sudah dipakai, Silahkan ganti');
      if ($this->form_validation->run() == false) {
          $data['title'] = 'Add Admin';
          $data['company'] = $this->db->get('company')->row_array();
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
          $this->template->load('backend', 'backend/admin/add_admin', $data);
      } else {
          $post = $this->input->post(null, TRUE);
          $this->admin_m->add($post);
          if ($this->db->affected_rows() > 0) {
              $this->session->set_flashdata('success', 'Data Admin berhasil disimpan');
          }
          echo "<script>window.location='" . site_url('admin') . "'; </script>";
      }
  }

  public function edit($id)
  {
      is_logged_in();
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
      $this->form_validation->set_rules('address', 'Alamat', 'required|trim');
      $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
      $this->form_validation->set_message('is_unique', '%s Sudah dipakai, Silahkan ganti');
      if ($this->form_validation->run() == false) {
          $query  = $this->admin_m->getAdmin($id);
          if ($query->num_rows() > 0) {
              $data['admin'] = $query->row();
              $data['title'] = 'Edit Admin';
              $data['company'] = $this->db->get('company')->row_array();
              $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
              $this->template->load('backend', 'backend/admin/edit_admin', $data);
          } else {
              echo "<script> alert ('Data tidak ditemukan');";
              echo "window.location='" . site_url('admin') . "'; </script>";
          }
      } else {
          $post = $this->input->post(null, TRUE);
          $this->admin_m->edit($post);
          if ($this->db->affected_rows() > 0) {
              $this->session->set_flashdata('success', 'Data Admin berhasil diperbaharui');
          }
          echo "<script>window.location='" . site_url('admin') . "'; </script>";
      }
  }

  function email_check()
  {
      $post = $this->input->post(null, TRUE);
      $query = $this->db->query("SELECT * FROM user WHERE email = '$post[email]' AND id != '$post[id]'");
      if ($query->num_rows() > 0) {
          $this->form_validation->set_message('email_check', '%s Ini sudah dipakai, Silahkan ganti !');
          return FALSE;
      } else {
          return TRUE;
      }
  }

  public function delete()
    {
        $id = $this->input->post('id');
        $this->admin_m->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data admin berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('admin') . "'; </script>";
    }

}

/* End of file Admin.php */
