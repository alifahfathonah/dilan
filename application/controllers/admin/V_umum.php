<?php
defined('BASEPATH') or exit('No direct script access allowed');

class V_umum extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');


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
        $this->load->view('admin/v_umum/view', $data);
        $this->load->view('admin/template/footer');
    }



    function act()
    {
        if (isset($_POST['update'])) {

            echo "siap update";


            $data = [

                'verifikasi' => '1',
                'tgl_v' => date('Y-m-d')

            ];
            $this->mod_usaha->verify($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Usaha Telah Diverifikasi</div>');
            redirect('admin/v_umum');
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_umum/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }
}
