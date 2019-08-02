<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_izin');

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
        $user = $data['user']['user_id'];
        $data['usaha'] = $this->mod_izin->selectByUsaha($user)->result_array();
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/izin/view', $data);
        $this->load->view('admin/template/footer');
    }

    function create()
    {
        if (isset($_POST['submit'])) {
            /*$this->form_validation->set_rules('j_izin', 'Jenis Izin', 'required');
            $this->form_validation->set_rules('nmr_izin', 'Nomor Izin', 'required');
            $this->form_validation->set_rules('tgl_terbit', 'Tangga Terbit', 'required');
            $this->form_validation->set_rules('berlaku', 'Masa Berlaku', 'required');
            $this->form_validation->set_rules('Keterangan', 'Keterangan', 'required');*/


            /*if ($this->form_validation->run() == false) {
                echo "balik lagi";
            } else {*/

            $this->mod_izin->simpan();
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data berhasil Disimpan.</div>');
            redirect('admin/izin');
            //}
        } else {

            $data['usaha'] = $this->mod_izin->selectByUser($this->session->userdata('user_id'))->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/izin/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function edit()
    {
        if (isset($_POST['update'])) {


            $this->mod_izin->update();
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Data Berhasil Diubah</div>');
            redirect('admin/izin');
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_izin->selectById($id)->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/izin/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function delete()
    {
        $this->db->where('id_izin', $this->uri->segment(4));
        $this->db->delete('perizinan');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data Berhasil Dihapus</div>');
        redirect('admin/izin');
    }
}
