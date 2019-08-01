<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelptri extends CI_Controller
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
            if ($this->session->userdata('role_id') != 4) {
                redirect('auth');
            }
        }
    }

    function index()
    {
        $data['usaha'] = $this->mod_pelptri->selectByUsaha()->result_array();
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/pelptri/view', $data);
        $this->load->view('admin/template/footer');
    }

    function create()
    {
        if (isset($_POST['submit'])) {
            $config['upload_path']          = './upload/laptri/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            = 'file' . '-' . $this->input->post('nm_usaha') . '-' . $_FILES['lampiran']['name'];
            $config['overwrite']            = true;
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);
            if (!empty($_FILES['lampiran']['name'])) {
                if ($this->upload->do_upload(('lampiran'))) {

                    $nama_file = $this->upload->data('file_name');
                    $m1 = $this->input->post('m1');
                    $m2 = $this->input->post('m2');
                    $g = $m1 . "-" . $m2;
                    $data = [
                        'id_usaha' => $this->input->post('id_usaha'),
                        'periode' => $g,
                        'tahun' => $this->input->post('tahun'),
                        'PH' => $this->input->post('PH'),
                        'tgl_pantau' => $this->input->post('tgl_pantau'),
                        'parameter' => $this->input->post('parameter'),
                        'b_mutu' => $this->input->post('b_mutu'),
                        'h_pantau' => $this->input->post('h_pantau'),
                        'lampiran' => $nama_file

                    ];
                    $this->mod_pelptri->simpan($data);
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                            Data berhasil Disimpan.</div>');
                    redirect('admin/pelptri');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class= "' . $error . '">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Somethink wrong with upload</div>');
                    redirect('admin/pelptri');
                }
            } else {
                $m1 = $this->input->post('m1');
                $m2 = $this->input->post('m2');
                $g = $m1 . "-" . $m2;
                $data = [
                    'id_usaha' => $this->input->post('id_usaha'),
                    'periode' => $g,
                    'tahun' => $this->input->post('tahun'),
                    'PH' => $this->input->post('PH'),
                    'tgl_pantau' => $this->input->post('tgl_pantau'),
                    'parameter' => $this->input->post('parameter'),
                    'b_mutu' => $this->input->post('b_mutu'),
                    'h_pantau' => $this->input->post('h_pantau')

                ];
                $this->mod_pelptri->simpan($data);
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        Data berhasil Disimpan.</div>');
                redirect('admin/pelptri');
            }
        } else {

            $data['usaha'] = $this->mod_pelptri->selectByUser($this->session->userdata('user_id'))->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/pelptri/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function edit()
    {
        if (isset($_POST['update'])) {
            $config['upload_path']          = './upload/laptri/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            = 'file' . '-' . $this->input->post('nm_usaha') . '-' . $_FILES['lampiran']['name'];
            $config['overwrite']            = true;
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);
            if (!empty($_FILES['lampiran']['name'])) {
                if ($this->upload->do_upload(('lampiran'))) {
                    $gbrlama = $this->mod_pelptri->selectFile($this->input->post('id_lapor'))->row_array();
                    if (!empty($gbrlama['lampiran'])) {
                        unlink("./upload/laptri/" . $gbrlama['lampiran']);
                    }
                    $nama_file = $this->upload->data('file_name');
                    $m1 = $this->input->post('m1');
                    $m2 = $this->input->post('m2');
                    $g = $m1 . "-" . $m2;
                    $data = [
                        'id_usaha' => $this->input->post('id_usaha'),
                        'periode' => $g,
                        'tahun' => $this->input->post('tahun'),
                        'PH' => $this->input->post('PH'),
                        'tgl_pantau' => $this->input->post('tgl_pantau'),
                        'parameter' => $this->input->post('parameter'),
                        'b_mutu' => $this->input->post('b_mutu'),
                        'h_pantau' => $this->input->post('h_pantau'),
                        'lampiran' => $nama_file

                    ];
                    $this->mod_pelptri->update($data);
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data Berhasil Diubah</div>');
                    redirect('admin/pelptri');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class= "' . $error . '">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Somethink wrong with upload</div>');
                    redirect('admin/pelptri');
                }
            } else {
                $m1 = $this->input->post('m1');
                $m2 = $this->input->post('m2');
                $g = $m1 . "-" . $m2;
                $data = [
                    'id_usaha' => $this->input->post('id_usaha'),
                    'periode' => $g,
                    'tahun' => $this->input->post('tahun'),
                    'PH' => $this->input->post('PH'),
                    'tgl_pantau' => $this->input->post('tgl_pantau'),
                    'parameter' => $this->input->post('parameter'),
                    'b_mutu' => $this->input->post('b_mutu'),
                    'h_pantau' => $this->input->post('h_pantau')

                ];
                $this->mod_pelptri->update($data);
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data Berhasil Diubah</div>');
                redirect('admin/pelptri');
            }
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_pelptri->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/pelptri/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }
}
