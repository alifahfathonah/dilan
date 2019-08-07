<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Area extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_download');


        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 4) {
                redirect('auth');
            }
        }
    }

    function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['down'] = $this->mod_download->selectAll()->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/download/list', $data);
        $this->load->view('admin/template/footer');
    }


    function list()
    {
        echo "disini list";
    }
}
