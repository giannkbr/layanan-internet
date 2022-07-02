<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bill extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['customer_m', 'package_m', 'services_m', 'setting_m', 'bill_m', 'income_m', 'report_m']);
    }

    public function index()
    {
        $data['title'] = 'Bill';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['bill'] = $this->bill_m->getInvoice()->result();
        $data['detail'] = $this->bill_m->getInvoiceDetail()->result();
        $data['invoice'] = $this->bill_m->invoice_no();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/bill/bill', $data);
    }


    public function view_data()
    {
        if (isset($_POST['cek_data'])) {
            $data['services'] =  $this->services_m->getServicesDetail($this->input->post('no_services'));
            $this->load->view('backend/bill/detail_bill', $data);
        } else {
            echo "cek";
        }
    }



    public function addBill()
    {
        $data = $this->input->post(null, TRUE);
        $no_services = $this->input->post('no_services');
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $cekperiode = $this->bill_m->cekPeriode($no_services, $month, $year);
        $inv = $this->input->post('invoice');
        $cekinvoice = $this->bill_m->cekInvoice($inv);
        $getInv = $this->bill_m->getRecentInv()->row();
        if ($cekinvoice->num_rows() > 0) {
            $invoice = $getInv->invoice + 1;
        } else {
            $invoice = $this->input->post('invoice');
        }
        if ($cekperiode->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Gagal, Tagihan untuk periode tersebut sudah tersedia, mohon dicek kembali !');
            echo "<script>window.location='" . site_url('bill') . "'; </script>";
        } else {
            $this->bill_m->addBill($data, $invoice);
            $Detail = $this->services_m->getServicesDetail($this->input->post('no_services'))->result();
            $data2 = [];
            foreach ($Detail as $c => $row) {
                array_push(
                    $data2,
                    array(
                        'invoice_id' => $invoice,
                        'item_id' => $row->item_id,
                        'price' => $row->price,
                        'qty' => $row->qty,
                        'disc' => $row->disc,
                        'remark' => $row->remark,
                        'total' => $row->total,
                    )
                );
            }
            $this->bill_m->add_bill_detail($data2);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Tagihan berhasil dibuat');
            }
            redirect('bill');
        }
    }

    public function detail($invoice)
    {
        $data['title'] = 'Detail Bill';
        $data['invoice'] = $this->bill_m->getEditInvoice($invoice);
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->template->load('backend', 'backend/bill/invoice_detail', $data);
    }

    public function donation()
    {
        $data['title'] = 'Donasi';
        $data['customer'] = $this->customer_m->getCustomer()->result();

        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->template->load('backend', 'backend/bill/donation', $data);
    }
    public function view_donation()
    {
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        if (isset($_POST['cek_bill'])) {
            $data['bill'] = $this->bill_m->getInvoiceThisMonth($month, $year)->result();
            $this->load->view('backend/bill/tampil_donation', $data);
        } else {
            echo "Not Found";
        }
    }
    public function delete()
    {
        $invoice = $this->input->post('invoice');
        $this->bill_m->delete($invoice);
        $this->bill_m->deleteDetailBill($invoice);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Tagihan berhasil dihapus');
        }
        redirect('bill');
    }

    public function payment()
    {
        $post = $this->input->post(null, TRUE);
        $invoice = $this->input->post('invoice');
        $this->bill_m->payment($post);
        $this->income_m->addPayment($post);
        $this->report_m->addReport($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Iuran berhasil terbayarkan');
        }
        echo "<script>window.location='" . site_url('bill/detail/' . $invoice) . "'; </script>";
    }

    public function printinvoice($invoice)
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice);
        $data['invoice_detail'] = $this->bill_m->getDetailBill($invoice);
        $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $this->load->view('backend/bill/invoice', $data);
    }
    public function printinvoiceselected()
    {
        $invoice = $_POST['invoice'];
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice)->result();
        $data['invoice_detail'] = $this->bill_m->getBill($invoice)->result();
        $data['bill'] = $this->bill_m->getInvoiceSelected($invoice)->result();

        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $this->load->view('backend/bill/invoiceselected', $data);
    }
    public function printinvoiceunpaid()
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $data['bill'] = $this->bill_m->getInvoiceUnpaid()->result();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $this->load->view('backend/bill/invoiceselected', $data);
    }
    public function printinvoicepaid()
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $data['bill'] = $this->bill_m->getInvoicePaid()->result();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $this->load->view('backend/bill/invoiceAll', $data);
    }
}
