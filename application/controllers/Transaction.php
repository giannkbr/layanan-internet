<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Transaction_m');
  }

  public function index()
  {
    $data['title'] = 'Transaction';
		$data['company'] = $this->db->get('company')->row_array();
    $data['carousel'] = $this->db->get('carousel')->result();
    $data['item'] = $this->db->get('package_item')->result();
		$this->template->load('frontend', 'frontend/transaction', $data);
  }

  public function transaction()
  {
    $this->input->post('name');
  }

}

/* End of file Transaction.php */
