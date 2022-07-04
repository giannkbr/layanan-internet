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
    $data['bill'] = $this->bill_m->getInvoice()->result();
    $data['detail'] = $this->bill_m->getInvoiceDetail()->result();
    $data['invoice'] = $this->bill_m->invoice_no();
    $data['bank'] = $this->setting_m->getBank()->row_array();
    $data['company'] = $this->db->get('company')->row_array();
		$this->template->load('frontend', 'frontend/status', $data);
	}


	public function view_bill()
	{
		$no_services = $this->input->post('no_services');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		if (isset($_POST['cek_bill'])) {
			$data['bill'] =  $this->services_m->getCekBill($no_services, $month, $year);
			$data['customer'] =  $this->customer_m->getNSCustomer($no_services);
			$this->load->view('frontend/cek_bill', $data);
		} else {
			echo "Not Found";
		}
	}
}
