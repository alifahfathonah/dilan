<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aduan_kds extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_aduan');

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 2) {
                redirect('auth');
            }
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        //  $data['aduan'] = $this->mod_aduan->select_all()->result();
        //$data['kec'] = $this->db->get('kecamatan')->result();
        //$data['kateg'] = $this->db->get('kategori_aduan')->result();
        $data['record'] = $this->mod_aduan->select_kds()->result();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/aduan/view_kds', $data);
        $this->load->view('admin/template/footer');
    }

    public function aksi_kds()
    {
        if (isset($_POST['submit'])) {

            $idx = $this->input->post('id');
            $this->mod_aduan->update_kds();
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Data berhasil Diubah.</div>');
            redirect('admin/aduan_kds');
        } else {
            $url = $this->uri->segment(4);
            // var_dump($this->mod_aduan->select_one($url)->row_array());die;
            $data['aduan'] = $this->mod_aduan->select_one($url)->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/aduan/aksi_kds', $data);
            $this->load->view('admin/template/footer');
        }
    }
}
