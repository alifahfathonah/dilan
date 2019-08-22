<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Udara extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_udara');

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
        $data['usaha'] = $this->mod_udara->selectByUsaha($user)->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/udara/view', $data);
        $this->load->view('admin/template/footer');
    }

    function create()
    {
        if (isset($_POST['submit'])) {

            $data = [
                'id_usaha' => $this->input->post('id_usaha'),
                'lokasi_smp' => $this->input->post('lokasi'),
                'parameter_U' => $this->input->post('parameter'),
                'bk_mutu' => $this->input->post('b_mutu')

            ];



            $this->mod_udara->simpan($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        Data berhasil Disimpan.</div>');
            redirect('admin/udara');
        } else {

            $data['usaha'] = $this->mod_udara->selectByUser($this->session->userdata('user_id'))->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/udara/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function edit()
    {
        if (isset($_POST['submit'])) {


            $data = [
                'lokasi_smp' => $this->input->post('lokasi'),
                'parameter_u' => $this->input->post('parameter'),
                'bk_mutu' => $this->input->post('b_mutu'),
                'b1' => $this->input->post('jan'),
                'b2' => $this->input->post('feb'),
                'b3' => $this->input->post('mar'),
                'b4' => $this->input->post('apr'),
                'b5' => $this->input->post('mei'),
                'b6' => $this->input->post('jun'),
                'b7' => $this->input->post('jul'),
                'b8' => $this->input->post('agu'),
                'b9' => $this->input->post('sep'),
                'b10' => $this->input->post('okt'),
                'b11' => $this->input->post('nov'),
                'b12' => $this->input->post('des'),
                'thn_udara' => $this->input->post('tahun')


            ];
            $this->mod_udara->update($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Data Berhasil Diubah</div>');
            redirect('admin/udara');
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_udara->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/udara/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }
}
