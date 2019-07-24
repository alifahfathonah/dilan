<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_kecamatan');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 1) {
                redirect('auth');
            }
        }
    }

    function index()
    {
        $data['record'] =  $this->mod_kecamatan->select_all()->result();
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/kecamatan/view', $data);
        $this->load->view('admin/template/footer');
    }


    function create()
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
            if ($this->form_validation->run() == false) {
                $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view('admin/template/header', $data);
                $this->load->view('admin/template/navbar', $data);
                $this->load->view('admin/template/sidebar', $data);
                $this->load->view('admin/kecamatan/create', $data);
                $this->load->view('admin/template/footer');
            } else {
                $this->mod_kecamatan->simpan();
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data Derhasil Disimpan.</div>');
                redirect('admin/kecamatan');
            }
        } else {
            // $data['parent'] =  $this->mod_kecamatan->select_parent()->result();
            // $this->template->load('templateadmin', 'admin/kecamatan/post', $data);
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/kecamatan/create', $data);
            $this->load->view('admin/template/footer');
        }
    }


    function edit()
    {
        if (isset($_POST['submit'])) {
            $this->mod_kecamatan->update();
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data Derhasil Diubah.</div>');
            redirect('admin/kecamatan');
        } else {
            $id            = $this->uri->segment(4);
            $data['row']   = $this->db->get_where('kecamatan', array('kec_id' => $id))->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/kecamatan/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }
}
