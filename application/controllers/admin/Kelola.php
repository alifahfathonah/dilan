<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_kelola');

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
        $data['usaha'] = $this->mod_kelola->selectByUsaha($user)->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/kelola/view', $data);
        $this->load->view('admin/template/footer');
    }

    function create()
    {
        if (isset($_POST['submit'])) {
            $config['upload_path']          = './upload/lapsm/';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|xls|xlsx|ppt|ppt|zip|rar';
            $config['file_name']            = 'file' . '-' . $this->input->post('nm_usaha') . '-' . $_FILES['lampiran']['name'];
            $config['overwrite']            = true;
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);
            if (!empty($_FILES['lampiran']['name'])) {

                if ($this->upload->do_upload(('lampiran'))) {
                    $nama_file = $this->upload->data('file_name');


                    $data = [
                        'id_usaha' => $this->input->post('id_usaha'),
                        'periode' => $this->input->post('smster'),
                        'tahun' => date('Y'),
                        'sumber' => $this->input->post('s_dampak'),
                        'jenis' => $this->input->post('j_dampak'),
                        'kelola' => $this->input->post('kelola'),
                        'pantau' => $this->input->post('pantau'),
                        'file' => $nama_file


                    ];

                    $this->mod_kelola->simpan($data);
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                            Data berhasil Disimpan.</div>');
                    redirect('admin/kelola');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class= "' . $error . '">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Somethink wrong with upload</div>');
                    redirect('admin/pelpsix');
                }
            } else {

                $data = [
                    'id_usaha' => $this->input->post('id_usaha'),
                    'periode' => $this->input->post('smster'),
                    'tahun' => date('Y'),
                    'sumber' => $this->input->post('s_dampak'),
                    'jenis' => $this->input->post('j_dampak'),
                    'kelola' => $this->input->post('kelola'),
                    'pantau' => $this->input->post('pantau')



                ];

                $this->mod_kelola->simpan($data);
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        Data berhasil Disimpan.</div>');
                redirect('admin/kelola');
            }
        } else {

            $data['usaha'] = $this->mod_kelola->selectByUser($this->session->userdata('user_id'))->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/kelola/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function edit()
    {
        if (isset($_POST['update'])) {

            $config['upload_path']          = './upload/lapsm/';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|xls|xlsx|ppt|ppt|zip|rar';
            $config['file_name']            = 'file' . '-' . $this->input->post('nm_usaha') . '-' . $_FILES['lampiran']['name'];
            $config['overwrite']            = true;
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);

            if (!empty($_FILES['lampiran']['name'])) {
                if ($this->upload->do_upload(('lampiran'))) {
                    $gbrlama = $this->mod_pelpsix->selectFile($this->input->post('id_laporsm'))->row_array();
                    if (!empty($gbrlama['lampiran'])) {
                        unlink("./upload/lapsm/" . $gbrlama['lampiran']);
                    }

                    $nama_file = $this->upload->data('file_name');

                    $data = [

                        'periode' => $this->input->post('smster'),
                        'tahun' => date('Y'),
                        'sumber' => $this->input->post('s_dampak'),
                        'jenis' => $this->input->post('j_dampak'),
                        'kelola' => $this->input->post('kelola'),
                        'pantau' => $this->input->post('pantau'),
                        'file' => $nama_file


                    ];
                    $this->mod_kelola->update($data);
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data Berhasil Diubah</div>');
                    redirect('admin/kelola');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class= "' . $error . '">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Somethink wrong with upload</div>');
                    redirect('admin/kelola');
                }
            } else {


                $data = [
                    'periode' => $this->input->post('smster'),
                    'tahun' => date('Y'),
                    'sumber' => $this->input->post('s_dampak'),
                    'jenis' => $this->input->post('j_dampak'),
                    'kelola' => $this->input->post('kelola'),
                    'pantau' => $this->input->post('pantau'),


                ];
                $this->mod_kelola->update($data);
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data Berhasil Diubah</div>');
                redirect('admin/kelola');
            }
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_kelola->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/kelola/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function delete($id)
    {
        $this->db->where('id_kelola', $id);
        $this->db->delete('kelola_pantau');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data berhasil Dihapus.</div>');
        redirect('admin/kelola');
    }
}
