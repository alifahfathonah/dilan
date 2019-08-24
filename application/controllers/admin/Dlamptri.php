<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dlamptri extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_lamptri');



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
        $data['usaha'] = $this->mod_usaha->selectByUsaha()->result_array();
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/d_lamptri/view', $data);
        $this->load->view('admin/template/footer');
    }

    function list($ush)
    {
        $id = $this->uri->segment(4);
        $data['usaha'] = $this->mod_lamptri->selectri_usaha($id)->result_array();
        $data['lamp_tri'] = $this->db->get_where('lamp_tri', ['id_usaha' => $id])->row_array();

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/d_lamptri/view_d', $data);
        $this->load->view('admin/template/footer');
    }
}
