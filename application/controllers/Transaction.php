<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['transaction_m' , 'customer_m', 'services_m', 'package_m']);
  }

  public function index()
  {
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|is_unique[customer.no_ktp]');
    $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|trim|is_unique[customer.no_wa]');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[customer.email]');
    $this->form_validation->set_rules('address', 'Alamat', 'required|trim');
    $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
    $this->form_validation->set_message('is_unique', '%s Sudah dipakai, Silahkan ganti');
    if ($this->form_validation->run() == false) {
        $data['title'] = 'Transaction';
        $data['company'] = $this->db->get('company')->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // getItemID
        $item_id = $this->input->post('item_id');
        $data['p_item_id'] = $item_id;

        $this->template->load('frontend', 'frontend/transaction', $data);
    } else {
        $no_services = $this->input->post('no_services');
        $post = $this->input->post(null, TRUE);
        $this->transaction_m->add($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Berhasil mendaftarkan layanan, tunggu konfirmasi dari admin ya!');
        }
        redirect('transaction/transaction_success/' . $no_services);
    }
  }

  public function transaction_success($no_services){
    $data['title'] = 'Transaction Success';
    $data['company'] = $this->db->get('company')->row_array();
    $data['no_services'] = $no_services;
    $query  = $this->customer_m->getNSCustomer();
    $this->template->load('frontend', 'frontend/transaction_success', $data);
  }

  function email_check()
  {
      $post = $this->input->post(null, TRUE);
      $query = $this->db->query("SELECT * FROM customer WHERE email = '$post[email]' AND customer_id != '$post[customer_id]'");
      if ($query->num_rows() > 0) {
          $this->form_validation->set_message('email_check', '%s Ini sudah dipakai, Silahkan ganti !');
          return FALSE;
      } else {
          return TRUE;
      }
  }

  function no_wa_check()
  {
      $post = $this->input->post(null, TRUE);
      $query = $this->db->query("SELECT * FROM customer WHERE no_wa = '$post[no_wa]' AND customer_id != '$post[customer_id]'");
      if ($query->num_rows() > 0) {
          $this->form_validation->set_message('no_wa_check', '%s Ini sudah dipakai, Silahkan ganti !');
          return FALSE;
      } else {
          return TRUE;
      }
  }

  function no_ktp_check()
  {
      $post = $this->input->post(null, TRUE);
      $query = $this->db->query("SELECT * FROM customer WHERE no_ktp = '$post[no_ktp]' AND customer_id != '$post[customer_id]'");
      if ($query->num_rows() > 0) {
          $this->form_validation->set_message('no_ktp_check', '%s Ini sudah dipakai, Silahkan ganti !');
          return FALSE;
      } else {
          return TRUE;
      }
  }

  public function uploadbukti(){
    $data['title'] = 'Form Upload Bukti Transfer';
    $data['company'] = $this->db->get('company')->row_array();
    $data['bank'] = $this->db->get('bank')->row_array();

    $query  = $this->customer_m->getNSCustomer();
    $this->template->load('frontend', 'frontend/uploadbukti', $data);
  }

  public function uploadbuktibayar(){
        $config['upload_path']          = './assets/images/bukti';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10048; // 10 Mb
        $config['file_name']             = 'bukti-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['bukti_pembayaran']['name'] != null) {
            if ($this->upload->do_upload('bukti_pembayaran')) {
                $this->customer_m->uploadbukti($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Bukti Pembayaran berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('transaction/uploadbukti') . "'; </script>";
            } else {
              $error = $this->upload->display_errors();
              $this->session->set_flashdata('error', $error);
              echo "<script>window.location='" . base_url('transaction/uploadbukti') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . base_url('transaction/uploadbukti') . "'; </script>";
        }
  }

}


/* End of file Transaction.php */