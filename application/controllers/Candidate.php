<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {

  function __construct()
  {
      parent::__construct();
      is_logged_in();
      $this->load->model(['candidate_m', 'services_m', 'bill_m']);
  }
  public function index()
  {
      $data['title'] = 'Candidate customer';
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      $data['candidate'] = $this->candidate_m->getCandidate()->result();
      $data['candidatependingpayment'] = $this->candidate_m->getCandidatePendingPayment()->result();
      $data['candidateproses'] = $this->candidate_m->getCandidateProses()->result();
      $data['company'] = $this->db->get('company')->row_array();
      $this->template->load('backend', 'backend/candidate/data', $data);
  }

  public function edit($customer_id)
  {
      is_logged_in();
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|callback_no_ktp_check');
      $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|trim|callback_no_wa_check');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_check');
      $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
      $this->form_validation->set_message('is_unique', '%s Sudah dipakai, Silahkan ganti');
      if ($this->form_validation->run() == false) {
          $query  = $this->candidate_m->getCandidate($customer_id);
          if ($query->num_rows() > 0) {
              $data['candidate'] = $query->row();
              $data['title'] = 'Edit Candidate';
              $data['company'] = $this->db->get('company')->row_array();
              $data['c_status'] = $this->db->get('c_status')->result();
              $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
              $this->template->load('backend', 'backend/candidate/edit_candidate', $data);
          } else {
              echo "<script> alert ('Data tidak ditemukan');";
              echo "window.location='" . site_url('candidate') . "'; </script>";
          }
      } else {
          $post = $this->input->post(null, TRUE);
          $this->candidate_m->edit($post);
          if ($this->db->affected_rows() > 0) {
              $this->session->set_flashdata('success', 'Data Pelanggan berhasil diperbaharui');
          }
          echo "<script>window.location='" . site_url('candidate') . "'; </script>";
      }
  }

  public function editPendingPayment($customer_id)
  {
      is_logged_in();
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|callback_no_ktp_check');
      $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|trim|callback_no_wa_check');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_check');
      $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
      $this->form_validation->set_message('is_unique', '%s Sudah dipakai, Silahkan ganti');
      if ($this->form_validation->run() == false) {
          $query  = $this->candidate_m->getCandidatePendingPayment($customer_id);
          if ($query->num_rows() > 0) {
              $data['candidate'] = $query->row();
              $data['title'] = 'Edit Candidate';
              $data['company'] = $this->db->get('company')->row_array();
              $data['c_status'] = $this->db->get('c_status')->result();
              $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
              $this->template->load('backend', 'backend/candidate/edit_candidate', $data);
          } else {
              echo "<script> alert ('Data tidak ditemukan');";
              echo "window.location='" . site_url('candidate') . "'; </script>";
          }
      } else {
          $post = $this->input->post(null, TRUE);
          $this->candidate_m->edit($post);
          if ($this->db->affected_rows() > 0) {
              $this->session->set_flashdata('success', 'Data Pelanggan berhasil diperbaharui');
          }
          echo "<script>window.location='" . site_url('candidate') . "'; </script>";
      }
  }

  public function editProses($customer_id)
  {
      is_logged_in();
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|callback_no_ktp_check');
      $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|trim|callback_no_wa_check');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_check');
      $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
      $this->form_validation->set_message('is_unique', '%s Sudah dipakai, Silahkan ganti');
      if ($this->form_validation->run() == false) {
          $query  = $this->candidate_m->getCandidateProses($customer_id);
          if ($query->num_rows() > 0) {
              $data['candidate'] = $query->row();
              $data['title'] = 'Edit Candidate';
              $data['company'] = $this->db->get('company')->row_array();
              $data['c_status'] = $this->db->get('c_status')->result();
              $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
              $this->template->load('backend', 'backend/candidate/edit_candidate', $data);
          } else {
              echo "<script> alert ('Data tidak ditemukan');";
              echo "window.location='" . site_url('candidate') . "'; </script>";
          }
      } else {
          $post = $this->input->post(null, TRUE);
          $this->candidate_m->edit($post);
          if ($this->db->affected_rows() > 0) {
              $this->session->set_flashdata('success', 'Data Pelanggan berhasil diperbaharui');
          }
          echo "<script>window.location='" . site_url('candidate') . "'; </script>";
      }
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


    public function delete()
    {
        $customer_id = $this->input->post('customer_id');
        $no_services = $this->input->post('no_services');
        $query = $this->services_m->getServices($no_services);
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Pelanggan tidak bisa dihapus dikarenakan masih ada daftar layanan yang aktif');
            redirect('candidate');
        } else {
            $cekInvoice = $this->bill_m->getCekInvoice($no_services);
            if ($cekInvoice->num_rows() > 0) {
                $this->session->set_flashdata('error', 'Pelanggan tidak bisa dihapus dikarenakan data-nya masih digunakan di detail tagihan !');
                redirect('candidate');
            } else {
                $this->candidate_m->delete($customer_id);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data berhasil dihapus');
                }
                redirect('candidate');
            }
        }
    }
}

/* End of file Candidate.php */
