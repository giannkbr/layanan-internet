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
      $data['company'] = $this->db->get('company')->row_array();
      $this->template->load('backend', 'backend/candidate/data', $data);
  }


}

/* End of file Candidate.php */
