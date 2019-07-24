<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aduan_u extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_aduan');

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 4) {
                redirect('auth');
            }
        }
    }

    public function index()
    {
        //$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['user_id'];
        $data['record'] = $this->mod_aduan->select_by_user($id)->result();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/aduan/view_user', $data);
        $this->load->view('admin/template/footer');
    }






    function create()
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
            $this->form_validation->set_rules('telp', 'Telp', 'required|trim');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
            $this->form_validation->set_rules('jenis', 'Jenis Aduan', 'required|trim');
            $this->form_validation->set_rules('kec', 'Kecamatan', 'required|trim');
            $this->form_validation->set_rules('ket', 'Keterangan', 'required|trim');


            if ($this->form_validation->run() == false) {
                $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
                $data['kec'] = $this->db->get('kecamatan')->result();
                $data['kateg'] = $this->db->get('kategori_aduan')->result();
                $this->load->view('admin/template/header', $data);
                $this->load->view('admin/template/navbar', $data);
                $this->load->view('admin/template/sidebar', $data);
                $this->load->view('admin/aduan_u/create', $data);
                $this->load->view('admin/template/footer');
            } else {


                $this->mod_aduan->simpan();
                $this->_sendEmail();

                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data berhasil Disimpan.</div>');
                redirect('admin/aduan_u');
            }
        } else {
            // $data['parent'] =  $this->mod_member->select_parent()->result();
            //$this->template->load('templateadmin', 'admin/member/post', $data);
            $data['kec'] = $this->db->get('kecamatan')->result();
            $data['kateg'] = $this->db->get('kategori_aduan')->result();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/aduan/create', $data);
            $this->load->view('admin/template/footer');
        }
    }



    private function _sendEmail()
    {
        $kec = $this->input->post('kec');
        $data['bos'] = $this->db->get_where('users', array('role_id' => 2))->row_array();
        //echo $data['bos']['email'] . "<br/>";

        $data['admin'] = $this->db->get_where('users', array('role_id' => 1))->row_array();
        //echo $data['admin']['email'] . "<br/>";
        $data['record'] = $this->db->query("select * from users where role_id='3' and kec_id=$kec")->row_array();

        $adm = $data['admin']['email'];
        $kd = $data['bos']['email'];
        $kc = $data['record']['email'];

        $this->load->library('phpmailer_lib');
        $mail = $this->phpmailer_lib->load();

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mansurmoji@gmail.com';
        $mail->Password = 'mansurmoji07';
        $mail->SMTPSecure = 'tls';
        $mail->Port = '587';

        $mail->setFrom('mansurmoji@gmail.com', 'sikasper admin');
        $mail->addReplyTo('mansurmoji@gmail.com', 'sikasper admin');

        $mail->addAddress($adm);
        $mail->addCC($kd);
        $mail->addBCC($kc);
        $mail->Subject = "aduan baru " . $this->input->post('judul') . " ";
        $mail->isHTML(true);

        $content = "<p>" . $this->input->post('ket') . "</p>";
        $mail->Body = $content;

        if (!$mail->send()) {
            echo "pesan tidak terkirim";
            echo "mail error : " .  $mail->ErrorInfo;
            die;
        } else {
            echo "pesan terkirim";
        }
    }
    public function aksi()
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('status', 'Status Aduan', 'required|trim');
            $idx = $this->input->post('id');


            if ($this->form_validation->run() == false) {

                $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
                $data['aduan'] = $this->mod_aduan->select_one($idx)->row_array();
                $this->load->view('admin/template/header', $data);
                $this->load->view('admin/template/navbar', $data);
                $this->load->view('admin/template/sidebar', $data);
                $this->load->view('admin/aduan/aksi', $data);
                $this->load->view('admin/template/footer');
            } else {

                $this->mod_aduan->update();
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data berhasil Diubah.</div>');
                redirect('admin/aduan/kec');
            }
        } else {
            $url = $this->uri->segment(4);
            $data['aduan'] = $this->mod_aduan->select_one($url)->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/aduan/aksi', $data);
            $this->load->view('admin/template/footer');
        }
    }
}
