<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsul extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/mod_konsul');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/konsul', $data);
        $this->load->view('admin/template/footer');
        //echo "selamat " . $data['user']['nama'] . " berada di halaman home";
    }

    public function send()
    {
        if (isset($_POST['submit'])) {
            $this->mod_konsul->simpan();
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Pesan Telah Dikirim, Anda Akan Dihubungi Via Email Dan Nomor Nomor Kontak.</div>');
            redirect('admin/konsul');
        }
    }
}
