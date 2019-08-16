<?php
defined('BASEPATH') or exit('No direct script access allowed');

class V_laptri extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_pelptri');



        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 1 and $this->session->userdata('role_id') != 4) {
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
        $this->load->view('admin/v_laptri/view', $data);
        $this->load->view('admin/template/footer');
    }



    function act()
    {
        if (isset($_POST['update'])) {

            $idx = $this->input->post('id_usaha');

            $data = [

                'vlap' => '1',
                'tgl_vlap' => date('Y-m-d')

            ];
            $this->mod_pelptri->verify($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Laporan Triwulan Telah Diverifikasi</div>');
            redirect('admin/v_laptri/report/' . $idx);
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_pelptri->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_laptri/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function report($id)
    {
        $id = $this->uri->segment(4);
        $data['usaha'] = $this->mod_pelptri->selectv_usaha($id)->result_array();
        $data['lap_tri'] = $this->db->get_where('lap_tri', ['id_usaha' => $id])->row_array();

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_laptri/report', $data);
        $this->load->view('admin/template/footer');
    }

    function act1()
    {
        if (isset($_POST['kirim'])) {

            $idx = $this->input->post('id_usaha');
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');

            $data = [

                'id_usaha' => $idx,
                'periode_t' => $pr,
                'tahun_t' => $th

            ];
            $this->mod_pelptri->create_tri($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Laporan Triwulan Berhasil Dikirim</div>');
            redirect('admin/v_laptri/create/');
        } else if (isset($_POST['correct'])) {

            $idx = $this->input->post('id_usaha');
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');
            $ket = $this->input->post('ket');

            $data = [

                'id_usaha' => $idx,
                'periode_t' => $pr,
                'tahun_t' => $th,
                'sts_lapt' => '0',
                'ket' => $ket
            ];
            $this->mod_pelptri->verify($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Laporan Triwulan Telah Diverifikasi</div>');
            redirect('admin/v_laptri/report/' . $idx);
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_pelptri->selectv_usaha($id)->row_array();
            $data['periode'] = "triwulan-1";
            $data['tahun'] = date('Y');
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_laptri/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }
    function create()
    {
        if (isset($_POST['kirim'])) {
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');
            $id = $this->input->post('id_usaha');
            $data = [

                'id_usaha' => $id,
                'periode_t' => $pr,
                'tahun_t' => $th

            ];
            $this->mod_pelptri->create_tri($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Laporan Triwulan Berhasil Dikirim</div>');
            redirect('admin/v_laptri/listlaptri');
        } else {
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $user = $data['user']['user_id'];
            $data['usaha'] = $this->mod_pelptri->selectByUsaha($user)->row_array();


            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_laptri/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function edit()
    {
        if (isset($_POST['update'])) {
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');

            $data = [


                'periode_t' => $pr,
                'tahun_t' => $th

            ];
            $this->mod_pelptri->update_tri($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Laporan Triwulan Berhasil Diupdate</div>');
            redirect('admin/v_laptri/listlaptri');
        } else {
            $id = $this->uri->segment(4);
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $user = $data['user']['user_id'];
            $data['usaha'] = $this->mod_pelptri->selectByUsaha($user)->row_array();
            $data['laptri'] = $this->mod_pelptri->selectById($id)->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_laptri/edit_u', $data);
            $this->load->view('admin/template/footer');
        }
    }
    function listlaptri()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];
        $data['usaha'] = $this->mod_pelptri->selectByUsaha($user)->row_array();
        $data['laptri'] = $this->mod_pelptri->selectUsaha($user)->result_array();


        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_laptri/view_u', $data);
        $this->load->view('admin/template/footer');
    }
    function delete($id)
    {
        $id = $this->uri->segment(4);
        $this->db->where('id_laptri', $id);
        $this->db->delete('lap_tri');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Laporan Triwulan Berhasil Dihapus</div>');
        redirect('admin/v_laptri/listlaptri');
    }
}
