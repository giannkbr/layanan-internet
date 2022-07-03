<?php defined('BASEPATH') or exit('No direct script access allowed');

class Candidate_m extends CI_Model
{

    // 1, pending verif data
    // 2, pending nunggu bayar
    // 3, on proses install
    // 4, success

    public function getCandidate($customer_id = null, $no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('package_item', 'package_item.p_item_id = customer.p_item_id');
        $this->db->join('c_status', 'c_status.c_status_id = customer.c_status');
        // $this->db->select('package_item.name as nameItem');
        $this->db->where('c_status', '1');
        if ($customer_id != null) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getCandidatePendingPayment($customer_id = null, $no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('package_item', 'package_item.p_item_id = customer.p_item_id');
        $this->db->join('c_status', 'c_status.c_status_id = customer.c_status');
        // $this->db->select('package_item.name as nameItem');
        $this->db->where('c_status', '2');
        if ($customer_id != null) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getCandidateProses($customer_id = null, $no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('package_item', 'package_item.p_item_id = customer.p_item_id');
        $this->db->join('c_status', 'c_status.c_status_id = customer.c_status');
        // $this->db->select('package_item.name as nameItem');
        $this->db->where('c_status', '3');
        if ($customer_id != null) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }


    public function getNSCustomer($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getInvoiceCustomer($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'name' => $post['name'],
            'no_services' => $post['no_services'],
            'no_ktp' => $post['no_ktp'],
            'email' => $post['email'],
            'no_wa' => $post['no_wa'],
            'address' => $post['address'],
            'created' => time(),
        ];
        $this->db->insert('customer', $params);
    }

    public function edit($post)
    {
        $params = [
            'name' => $post['name'],
            'no_ktp' => $post['no_ktp'],
            'email' => $post['email'],
            'c_status' => $post['c_status'],
            'no_wa' => $post['no_wa'],
            'address' => $post['address'],
        ];
        $this->db->where('customer_id', $post['customer_id']);
        $this->db->update('customer', $params);
    }

    public function delete($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('customer');
    }
}
