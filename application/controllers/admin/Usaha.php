<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usaha extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_kecamatan');

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 4) {
                redirect('auth');
            }
        }
    }

    function profile()

    {
        $data['kec'] = $this->mod_kecamatan->select_all()->result_array();
        $data['usaha'] = $this->db->get_where('usaha', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/umum/f_profile', $data);
        $this->load->view('admin/template/footer');
    }

    function izin()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/umum/f_izin', $data);
        $this->load->view('admin/template/footer');
    }

    function sarana()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/umum/f_sarana', $data);
        $this->load->view('admin/template/footer');
    }
    function updateUmum()
    {


        $this->mod_usaha->updateA();


        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data berhasil Diubah.</div>');
        redirect('admin/usaha/profile');
    }

    function updateAlmt()
    {
        $this->mod_usaha->updateB();

        $this->session->set_flashdata('message2', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data berhasil Diubah.</div>');

        redirect('admin/usaha/profile#tab_12/');
    }
    function updateDetail()
    {
        $this->mod_usaha->updateC();

        $this->session->set_flashdata('message3', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data berhasil Diubah.</div>');

        redirect('admin/usaha/profile#tab_12/');
    }
}
