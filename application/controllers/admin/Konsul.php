<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsul extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/mod_konsul');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/konsul/konsul', $data);
        $this->load->view('admin/template/footer');
        //echo "selamat " . $data['user']['nama'] . " berada di halaman home";
    }

    public function send()
    {
        if (isset($_POST['submit'])) {
            $this->mod_konsul->simpan();
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Pesan Telah Dikirim, Anda Akan Dihubungi Via Email Dan Nomor Nomor Kontak.</div>');
            redirect('admin/konsul');
        }
    }
    public function list()
    {

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];
        $role = $data['user']['role_id'];
        if ($role == 4) {
            redirect('auth');
        } else if ($role == 1) {
            $data['usaha'] = $this->mod_konsul->selectByUser()->result_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/konsul/view', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function form()
    {
        $idk = $this->uri->segment(4);

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];
        $data['konsul'] = $this->mod_konsul->selectById($idk)->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/konsul/form', $data);
        $this->load->view('admin/template/footer');
    }

    function sendEmail()
    {
        if(isset($_POST['submit'])){
            $client = $this->input->post('email');
            $pesan = $this->input->post('pesan');
            $nama = $this->input->post('nama');
            $hal = $this->input->post('perihal');
    
            $this->load->library('phpmailer_lib');
            $mail = $this->phpmailer_lib->load();
    
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mansurmoji@gmail.com';
            $mail->Password = 'mansurmoji07';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
    
            $mail->setFrom('mansurmoji@gmail.com', 'administrator SI-DILAN');
            $mail->addReplyTo('mansurmoji@gmail.com', 'administrator SI-DILAN');
    
            $mail->addAddress($client);
            //$mail->addCC($);
            //$mail->addBCC($kc);
            $mail->Subject = "Konsultasi " . $hal . " ";
            $mail->isHTML(true);
    
            $content = "<p>" . $pesan . "</p>";
            $mail->Body = $content;
    
            if (!$mail->send()) {
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Gagal Mengirim Email.. terjadi gangguan jaringan'. '</div>');
                 redirect('admin/konsul/list');
            } else {
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Pesan Berhasil Dikirim Ke Email  '.$client.'</div>');
                 redirect('admin/konsul/list');
            }
        }
    }

    function delete($id)
    {
        $this->db->where('id_k', $id);
        $this->db->delete('konsul');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data Berhasil Dihapus </div>');
        redirect('admin/konsul/list');
    }

    
}
