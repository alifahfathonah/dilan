<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aduan_k extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_aduan');

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 3) {
                redirect('auth');
            }
        }
    }

    public function index()
    {

        $data['user'] = $this->db->get_where('users', [
            'email' => $this->session->userdata('email'),
            'kec_id' => $this->session->userdata('kec_id')
        ])->row_array();
        //  $data['aduan'] = $this->mod_aduan->select_all()->result();
        //$data['kec'] = $this->db->get('kecamatan')->result();
        //$data['kateg'] = $this->db->get('kategori_aduan')->result();
        $data['record'] = $this->mod_aduan->select_kec($data['user']['kec_id'])->result();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/aduan/view_k', $data);
        $this->load->view('admin/template/footer');
    }




    public function aksi_k()
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
                $this->load->view('admin/aduan_k/aksi_k', $data);
                $this->load->view('admin/template/footer');
            } else {

                $this->mod_aduan->update();
                $this->_sendEmail();
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data berhasil Diubah.</div>');
                redirect('admin/aduan_k');
            }
        } else {
            $url = $this->uri->segment(4);
            $data['aduan'] = $this->mod_aduan->select_one($url)->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/aduan/aksi_k', $data);
            $this->load->view('admin/template/footer');
        }
    }

    private function _sendEmail()
    {
        $kec = $this->input->post('kec');
        $data['bos'] = $this->db->get_where('users', array('role_id' => 2))->row_array();


        $data['admin'] = $this->db->get_where('users', array('role_id' => 1))->row_array();


        $adm = $data['admin']['email'];
        $kd = $data['bos']['email'];


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

        $mail->Subject = 'aduan limpahkan ke adminnistrator ';
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
}
