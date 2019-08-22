<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Air extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_air');

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
        $data['usaha'] = $this->mod_air->selectByUsaha($user)->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/air/view', $data);
        $this->load->view('admin/template/footer');
    }

    function create()
    {
        if (isset($_POST['submit'])) {

            $data = [
                'id_usaha' => $this->input->post('id_usaha'),
                'parameter_a' => $this->input->post('parameter'),
                'bk_mutu' => $this->input->post('b_mutu')

            ];



            $this->mod_air->simpan($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        Data berhasil Disimpan.</div>');
            redirect('admin/air');
        } else {

            $data['usaha'] = $this->mod_air->selectByUser($this->session->userdata('user_id'))->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/air/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function edit()
    {
        if (isset($_POST['submit'])) {


            $data = [

                'parameter_a' => $this->input->post('parameter'),
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
                'thn_air' => $this->input->post('tahun')


            ];
            $this->mod_air->update($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Data Berhasil Diubah</div>');
            redirect('admin/air');
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_air->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/air/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }
}
