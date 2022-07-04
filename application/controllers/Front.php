<?php defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(['customer_m', 'package_m', 'services_m', 'setting_m', 'bill_m', 'income_m', 'report_m']);
	}
	public function index()
	{
		$data['title'] = 'Home';
		$data['company'] = $this->db->get('company')->row_array();
    $data['carousel'] = $this->db->get('carousel')->result();
    $data['item'] = $this->db->get('package_item')->result();
		$this->template->load('frontend', 'frontend/home', $data);
	}

  public function about()
	{
		$data['title'] = 'About';
		$data['company'] = $this->db->get('company')->row_array();
		$this->template->load('frontend', 'frontend/about', $data);
	}

  public function status()
	{
		$data['title'] = 'Status';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['customer'] = $this->customer_m->getCustomer()->result();
    $data['bank'] = $this->setting_m->getBank()->row_array();
    $data['company'] = $this->db->get('company')->row_array();
		$this->template->load('frontend', 'frontend/status', $data);
	}

  public function view_status(){
    $data['no_services'] = $this->input->post('no_services');
    // var_dump($no_services);
    $data['title'] = 'Status Layanan - ' . $data['no_services'];
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['customer'] =  $this->customer_m->getNSCustomer($data['no_services'])->result();
    $data['bank'] = $this->setting_m->getBank()->row_array();
    $data['company'] = $this->db->get('company')->row_array();

    $this->template->load('frontend', 'frontend/status_success', $data);
  }


	public function view_bill()
	{
		$no_services = $this->input->post('no_services');
    // var_dump($no_services);
		if (isset($_POST['cek_status'])) {
      $data['title'] = 'Status';
      $data['company'] = $this->db->get('company')->row_array();
			$data['customer'] =  $this->customer_m->getNSCustomer($no_services);
      $this->template->load('frontend', 'frontend/status', $data);
		} else {
			echo "Not Found";
		}
	}
}
