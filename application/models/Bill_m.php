<?php defined('BASEPATH') or exit('No direct script access allowed');
class Bill_m extends CI_Model
{
    public function getInvoice($invoice_id = null)
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        if ($invoice_id != null) {
            $this->db->where('invoice_id', $invoice_id);
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceThisMonth($month, $year)
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceUnpaid()
    {
        $this->db->select('*, customer.name as customer_name, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');

        $this->db->where('status', 'Belum Bayar');

        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoicePaid()
    {
        $this->db->select('*, customer.name as customer_name, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');

        $this->db->where('status', 'Sudah Bayar');

        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getInvoiceSelected($invoice = null)
    {
        $this->db->select('*, customer.name as customer_name, invoice.created as created_invoice, invoice.no_services as noServices');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');

        if ($invoice != null) {
            $this->db->where_in('invoice', $invoice);
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceDetail($invoice = null)
    {
        $this->db->select('*');
        $this->db->from('invoice_detail');
        $this->db->where('invoice_id', $invoice);
        $query = $this->db->get();
        return $query;
    }
    public function getBill($invoice = null)
    {
        $this->db->select('*, invoice.created as created_invoice, invoice.no_services as noServices');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->join('invoice_detail', '	invoice_detail.invoice_id = invoice.invoice');
        //$this->db->join('package_item', '	package_item.p_item_id = invoice_detail.item_id');

        if ($invoice != null) {
            $this->db->where_in('invoice', $invoice);
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getDetailBill($invoice = null)
    {
        $this->db->select('*, invoice_detail.price as detail_price, package_item.name as item_name');
        $this->db->from('invoice_detail');
        $this->db->join('package_item', 'package_item.p_item_id = invoice_detail.item_id');
        // $this->db->join('package_category', 'package_category.p_category_id = invoice_detail.category_id');
        $this->db->where('invoice_id', $invoice);
        $query = $this->db->get();
        return $query;
    }
    public function getEditInvoice($invoice)
    {
        $this->db->select('*, invoice_detail.price as detail_price, package_item.name as item_name');
        $this->db->from('invoice_detail');
        $this->db->join('package_item', 'package_item.p_item_id = invoice_detail.item_id');
        $this->db->join('package_category', 'package_category.p_category_id = invoice_detail.category_id');
        // $this->db->join('invoice_detail', 'invoice_detail.invoice_id = invoice.invoice');
        if ($invoice != null) {
            $this->db->where('invoice_id', $invoice);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getPendingPayment()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('status', 'BELUM BAYAR');
        $query = $this->db->get();
        return $query;
    }
    public function getTotalPendingPayment()
    {
        $this->db->select('*');
        $this->db->from('invoice_detail');
        $this->db->join('invoice', 'invoice_detail.invoice_id = invoice.invoice');
        $this->db->where('status', 'BELUM BAYAR');
        $query = $this->db->get();
        return $query;
    }

    public function cekItem($p_item_id = null)
    {
        $this->db->select('*');
        $this->db->from('invoice_detail');
        if ($p_item_id != null) {
            $this->db->where('item_id', $p_item_id);
        }
        $query = $this->db->get();
        return $query;
    }
    function invoice_no()
    {
        $tgl = date('ymd');
        $no = 001;
        $kode = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));  //cek jika kode belum terdapat pada table
        $kodetampil = $kode;  //format kode
        return $kodetampil;
    }
    public function getRecentInv()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->limit(1);
        $this->db->order_by('invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function addBill($post, $invoice)
    {
        $params = [
            'invoice' => $invoice,
            'month' => $post['month'],
            'year' => $post['year'],
            'code_unique' => substr(intval(rand()), 0, 3),
            'status' => 'BELUM BAYAR',
            'no_services' => $post['no_services'],
            'created' => time()
        ];

        $this->db->insert('invoice', $params);
    }

    public function add_bill_detail($params)
    {
        $this->db->insert_batch('invoice_detail', $params);
    }
    public function getCekInvoice($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }
    public function delete($invoice)
    {
        $this->db->where('invoice', $invoice);
        $this->db->delete('invoice');
    }
    public function deleteDetailBill($invoice)
    {
        $this->db->where('invoice_id', $invoice);
        $this->db->delete('invoice_detail');
    }
    public function payment($post)
    {
        $params = [
            'status' => 'SUDAH BAYAR',
            'date_payment' => time(),
        ];
        $this->db->where('invoice', $post['invoice']);
        $this->db->update('invoice', $params);
    }

    public function cekPeriode($no_services, $month, $year)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('no_services', $no_services);
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $query = $this->db->get();
        return $query;
    }
    public function cekinvoice($inv)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('invoice', $inv);
        $query = $this->db->get();
        return $query;
    }
}
