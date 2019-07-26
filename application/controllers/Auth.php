<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {

            $this->load->view('auth/header');
            $this->load->view('auth/login');
            $this->load->view('auth/footer');
        } else {
            $email = $this->input->post('email');
            $pass = $this->input->post('password');

            $user = $this->db->get_where('users', ['email' => $email])->row_array();

            if ($user) {
                if ($user['is_active'] == 1) {
                    if (password_verify($pass, $user['password'])) {
                        $data = [
                            'nama' => $user['nama'],
                            'user_id' => $user['user_id'],
                            'email' => $user['email'],
                            'role_id' => $user['role_id'],
                            'kec_id' => $user['kec_id']
                        ];
                        $this->session->set_userdata($data);
                        redirect('admin/home');
                    } else {
                        $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissi ble">
                        <button typ e="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa- check"></i> Alert!</h5>
                        Password Salah</div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissi ble">
                    <button typ e="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa- check"></i> Alert!</h5>
                    Email Belum aktivasi</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissi ble">
                <button typ e="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Email Tidak Terdaftar</div>');
                redirect('auth');
            }
        }
    }


    private function _sendEmail($token, $type)
    {

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

        $mail->addAddress($this->input->post('email'));

        if ($type == 'verify') {
            $mail->Subject = "Account Verification  ";


            $content = "Click This Link To verify your account <p><a href='" . base_url() . "auth/verify?email=" . $this->input->post('email') . "&token=" . urlencode($token) . "'>verify</a></p>";
            $mail->Body = $content;
        } else if ($type == 'lupa') {

            $mail->Subject = "Reset Password";
            $content = "Click This Link To verify your account <p><a href='" . base_url() . "auth/resetPass?email=" . $this->input->post('email') . "&token=" . urlencode($token) . "'>reset password</a></p>";
            $mail->Body = $content;
        }

        $mail->isHTML(true);



        if (!$mail->send()) {
            echo "pesan tidak terkirim";
            echo "mail error : " .  $mail->ErrorInfo;
            die;
        } else {
            echo "pesan terkirim";
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('users', array('email' => $email))->row_array();


        if ($user) {

            $user_token = $this->db->get_where('users', array('email' => $email))->row_array();


            if ($user_token['token']) {
                $this->db->set('is_active', 1);
                $this->db->where('email', $email);
                $this->db->update('users');
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                akun ' . $email . ' sudah aktif , silahkan login</div>');
                redirect('auth');

                /* if (time() - $user_token['data_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('users');
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    ".$email." sudah aktif , silahkan login</div>');
                    redirect('auth');
                } else {
                    $this->db -> delete('users', array('email' => $email));
                    $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Gagal Activasi Account, Waktu aktivasi Expired</div>');
                    redirect('auth');
                }*/
            } else {
                $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Gagal Activasi Account, Token Tidak Valid</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Gagal Activasi Account, Email Tidak Valid</div>');
            redirect('auth');
        }
    }

    public function resetPass()
    {

        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('users', array('email' => $email))->row_array();

        if ($user) {
            $data = $this->db->get_where('users', array('email' => $email))->row_array();
            if ($token['token']) {

                $this->session->set_userdata('reset_pass', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Gagal Reset Password, Token Tidak Terdaftar</div>');
                redirect('auth/forgotPassword');
            }
        } else {
            $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Gagal Reset Password, Email Tidak Terdaftar DI Sistem</div>');
            redirect('auth/forgotPassword');
        }
    }
    public function regis()
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nm_usaha', 'Nama Usaha', 'required');
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
            'required|min_length[8]|matches[c_password]',
            ['matches' => 'password not matches', 'min_length' => 'paasword too short']
        );
        $this->form_validation->set_rules('c_password', 'Password2', 'required|min_length[8]|matches[password]');

        if ($this->form_validation->run() == false) {
            $data['title'] = " data registras i";
            $this->load->view('auth/header');
            $this->load->view('auth/regis', $data);
            $this->load->view('auth/footer');
        } else {
            $token = base64_encode(random_bytes(32));

            $data = [
                'nama' => htmlspecialchars(($this->input->post('nama', true))),
                'email' => htmlspecialchars(($this->input->post('email', true))),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => 'default-image.jpg',
                'role_id' => 4,
                'is_active' => 0,
                'token' => $token,
                'created_at' => date('Y-m-d')
            ];

            $this->db->insert('users', $data);
            $this->mod_usaha->create();
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Silahkan Aktifkan Account Anda.</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Anda Berhasil Logout.</div>');
        redirect('auth');
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {

            $this->load->view('auth/header');
            $this->load->view('auth/forgot-pass');
            $this->load->view('auth/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('users', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token2 = base64_encode(random_bytes(32));
                $this->db->set('token', $token2);
                $this->db->where('email', $user['email']);
                $this->db->update('users');
                $this->_sendEmail($token2, 'lupa');
            } else {
                $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Email Tidak Terdaftar atau Email belum aktivasi</div>');
                redirect('auth/forgotPassword');
            }
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_pas')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repet Password', 'trim|required|min_length[8]|matches[password1]');
        if ($this->form_validation->run() == false) {

            $this->load->view('auth/header');
            $this->load->view('auth/change-pass');
            $this->load->view('auth/footer');
        } else {
            $pass = password_hash($this->input->post(password1), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_pass');
            $this->db->set('password', $pass);
            $this->db->where('email', $email);
            $this->db->update('users');
            $this->session->unset_userdata('reset_pass');
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Berhasil Reset Password.</div>');
            redirect('auth');
        }
    }
}
