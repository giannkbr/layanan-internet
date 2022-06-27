<?php defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['setting_m']);
    }


    public function index()
    {
        $data['title'] = 'Setting';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/setting/company', $data);
    }
    public function editCompany()
    {
        $config['upload_path']          = './assets/images';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10048; // 10 Mb
        // $config['file_name']             = 'logo';
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['logo']['name'] != null) {
            if ($this->upload->do_upload('logo')) {
                $company = $this->setting_m->getCompany($post['id'])->row();
                if ($company->logo != null) {
                    $target_file = './assets/images/' . $company->logo;
                    unlink($target_file);
                }
                $post['logo'] =  $this->upload->data('file_name');
                $this->setting_m->editCompany($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data perusahaan berhasil diperbaharui');
                }
                echo "<script>window.location='" . site_url('setting') . "'; </script>";
            } else {
                $post['logo'] =  null;
                $this->setting_m->editCompany($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data perusahaan berhasil diperbaharui');
                }
                echo "<script>window.location='" . base_url('setting') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . base_url('setting') . "'; </script>";
        }
    }

    public function about()
    {
        $data['title'] = 'About';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/setting/about', $data);
    }
    public function editAbout()
    {
        $description = $this->input->post('description');
        $this->db->set('description', $description);
        $this->db->update('company');
        $this->session->set_flashdata('success', 'Deskripsi perusahaan sudah diperbaharui.
      ');
        redirect('setting/about');
    }

    public function bank()
    {
        $data['title'] = 'Bank';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/setting/bank', $data);
    }

    public function addBank()
    {
        $post = $this->input->post(null, TRUE);
        $this->setting_m->addBank($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Bank berhasil ditambahkan');
        }
        echo "<script>window.location='" . site_url('setting/bank') . "'; </script>";
    }
    public function editBank()
    {
        $post = $this->input->post(null, TRUE);
        $this->setting_m->editBank($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Bank berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('setting/bank') . "'; </script>";
    }
    public function deleteBank()
    {
        $bank_id = $this->input->post('bank_id');
        $this->setting_m->deleteBank($bank_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Bank berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('setting/bank') . "'; </script>";
    }

    public function carousel()
    {
        $data['title'] = 'Carousel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['carousel'] = $this->setting_m->getCarousel()->result();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/setting/carousel', $data);
    }
}
