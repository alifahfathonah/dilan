<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lamptri extends CI_Controller
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
            if ($this->session->userdata('role_id') != 4) {
                redirect('auth');
            }
        }
    }

    function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];
        $data['usaha'] = $this->mod_lamptri->selectByUsaha($user)->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/lamptri/view', $data);
        $this->load->view('admin/template/footer');
    }

    function create()
    {
        if (isset($_POST['submit'])) {
            $config['upload_path']          = './upload/laptri/';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|xls|xlsx|ppt|ppt|zip|rar';
            $config['file_name']            = $this->input->post('id_usaha') . '-' . $_FILES['u_file']['name'];
            $config['overwrite']            = true;
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);
            if (!empty($_FILES['u_file']['name'])) {

                if ($this->upload->do_upload(('u_file'))) {
                    $nama_file = $this->upload->data('file_name');
                    $data = [
                        'id_usaha' => $this->input->post('id_usaha'),
                        'file_tri' => $nama_file,
                        'p_tri' => $this->input->post('periode'),
                        'tahun_t' => $this->input->post('tahun')

                    ];

                    $this->mod_lamptri->simpan($data);
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                            Data berhasil Disimpan.</div>');
                    redirect('admin/lamptri');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert! ' . $error . '</h5>
                    Somethink wrong with upload</div>');
                    redirect('admin/lamptri');
                }
            } else {

                $data = [
                    'id_usaha' => $this->input->post('id_usaha'),
                    'p_tri' => $this->input->post('periode'),
                    'tahun_t' => $this->input->post('tahun')

                ];

                $this->mod_lamptri->simpan($data);
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        Data berhasil Disimpan.</div>');
                redirect('admin/lamptri');
            }
        } else {

            $data['usaha'] = $this->mod_lamptri->selectByUser($this->session->userdata('user_id'))->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/lamptri/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function edit()
    {
        if (isset($_POST['update'])) {

            $config['upload_path']          = './upload/laptri/';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|xls|xlsx|ppt|ppt|zip|rar';
            $config['file_name']            = $this->input->post('id_usaha') . '-' . $_FILES['u_file']['name'];
            $config['overwrite']            = true;
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);

            if (!empty($_FILES['u_file']['name'])) {
                if ($this->upload->do_upload(('u_file'))) {
                    $filelama = $this->mod_lamptri->selectFile($this->input->post('id_tri'))->row_array();
                    if (!empty($filelama['file_tri'])) {
                        unlink("./upload/laptri/" . $filelama['file_tri']);
                    }

                    $nama_file = $this->upload->data('file_name');

                    $data = [

                        'file_tri' => $nama_file,
                        'p_tri' => $this->input->post('periode'),
                        'tahun_t' => $this->input->post('tahun')

                    ];
                    $this->mod_lamptri->update($data);
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data Berhasil Diubah</div>');
                    redirect('admin/lamptri');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert! ' . $error . '</h5>
                    Somethink wrong with upload</div>');
                    redirect('admin/lamptri');
                }
            } else {


                $data = [

                    'p_tri' => $this->input->post('periode'),
                    'tahun_t' => $this->input->post('tahun')


                ];
                $this->mod_lamptri->update($data);
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data Berhasil Diubah</div>');
                redirect('admin/lamptri');
            }
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_lamptri->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/lamptri/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function delete($id)
    {
        $file = $this->mod_lamptri->selectFile($this->uri->segment(4))->row_array();
        if (!empty($file['file_tri'])) {
            unlink("./upload/laptri/" . $file['file_tri']);
        }
        $this->db->where('idl_tri', $this->uri->segment(4));
        $this->db->delete('lamp_tri');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data Berhasil Dihapus</div>');
        redirect('admin/lamptri');
    }
}
