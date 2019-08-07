<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_download');


        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 1) {
                redirect('auth');
            }
        }
    }

    function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['down'] = $this->mod_download->selectAll()->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/download/view', $data);
        $this->load->view('admin/template/footer');
    }

    function create()
    {
        if (isset($_POST['submit'])) {
            $config['upload_path']          = './upload/file/';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|xls|xlsx|ppt|ppt|zip|rar';
            $config['file_name']            = $this->input->post('judul') . '-' . $_FILES['u_file']['name'];
            $config['overwrite']            = true;
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);
            if (!empty($_FILES['u_file']['name'])) {

                if ($this->upload->do_upload(('u_file'))) {
                    $nama_file = $this->upload->data('file_name');
                    $data = [

                        'judul' => $this->input->post('judul'),
                        'nm_file' => $nama_file,
                        'created_at' => date('Y-m-d')

                    ];

                    $this->mod_download->simpan($data);
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                            File berhasil Diupload.</div>');
                    redirect('admin/download');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Somethink wrong with upload,  maksimal ukuran file  2mb</div>');
                    redirect('admin/download/create');
                }
            } else {




                $this->session->set_flashdata('message', '<div class= "alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        Upload File Gagal</div>');
                redirect('admin/download/create');
            }
        } else {


            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/download/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function delete($id)
    {
        $file = $this->mod_download->selectFile($this->uri->segment(4))->row_array();
        if (!empty($file['nm_file'])) {
            unlink("./upload/file/" . $file['nm_file']);
        }
        $this->db->where('id_d', $this->uri->segment(4));
        $this->db->delete('download');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data Berhasil Dihapus</div>');
        redirect('admin/download');
    }

    function list()
    {
        echo "disini list";
    }
}
