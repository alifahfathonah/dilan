<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_user');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 1) {
                redirect('auth');
            }
        }
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['kec'] =  $this->db->get('kecamatan')->result();
        $data['admin'] = $this->mod_user->select_kec()->result();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/user/view', $data);
        $this->load->view('admin/template/footer');
    }
    function create()
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|trim|valid_email|is_unique[users.email]',
                [
                    'is_unique' => 'this email has been registered'
                ]
            );

            $this->form_validation->set_rules(
                'password',
                'Password',
                'required|min_length[8]|matches[cpassword]',
                ['matches' => 'password not matches', 'min_length' => 'paasword too short']
            );
            $this->form_validation->set_rules(
                'cpassword',
                'Password',
                'required|min_length[8]|matches[password]',
                ['matches' => 'password not matches', 'min_length' => 'paasword too short']
            );
            if ($this->form_validation->run() == false) {
                $data['level'] = $this->db->get('user_role')->result();
                $data['kec'] = $this->db->get('kecamatan')->result();
                $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view('admin/template/header', $data);
                $this->load->view('admin/template/navbar', $data);
                $this->load->view('admin/template/sidebar', $data);
                $this->load->view('admin/user/create', $data);
                $this->load->view('admin/template/footer');
            } else {
                //$this->form_validation->set_rules('c_password', 'Password2', 'required|min_length[8]|matches[password]');


                $this->mod_user->simpan();
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Berhasil Menambahkan User BAru.</div>');
                redirect('admin/user');
            }
        } else {
            // $data['parent'] =  $this->mod_member->select_parent()->result();
            //$this->template->load('templateadmin', 'admin/member/post', $data);
            $data['level'] = $this->db->get('user_role')->result();
            $data['kec'] = $this->db->get('kecamatan')->result();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/user/create', $data);
            $this->load->view('admin/template/footer');
        }
    }





    function delete()
    {
        $this->db->where('user_id', $this->uri->segment(4));
        $this->db->delete('users');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data Berhasil Dihapus</div>');
        redirect('admin/user');
    }
    function edit()
    {
        if (isset($_POST['submit'])) {


            $this->mod_user->update();
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Data Berhasil Diubah</div>');
            redirect('admin/user');
        } else {
            //$data['level'] = $this->db->get('user_role')->result();
            $data['kec'] = $this->db->get('kecamatan')->result();
            $id            = $this->uri->segment(4);
            $data['users']   = $this->db->get_where('users', array('user_id' => $id))->row_array();
            $data['role'] =  $this->db->get('user_role')->result();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/user/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }
}
