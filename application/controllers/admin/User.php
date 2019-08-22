<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_user');
        $this->load->model('admin/mod_usaha');
        if (!$this->session->userdata('email')) {
            redirect('auth');
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

                $datakode = $this->mod_user->getKode()->row_array();

                // jika $datakode
                if ($datakode > 0) {
                    $nilaikode = substr($datakode['max_id'], 3);
                    // menjadikan $nilaikode ( int )
                    $kode = (int) $nilaikode;
                    // setiap $kode di tambah 1
                    $kode = $kode + 1;
                    $kode_otomatis = "usr" . str_pad($kode, 3, "0", STR_PAD_LEFT);
                } else {
                    $kode_otomatis = "usr001";
                }

                $du = $this->mod_usaha->getKode()->row_array();
                if ($du > 0) {
                    $nkode = substr($du['max_ush'], 3);
                    // menjadikan $nilaikode ( int )
                    $kodex = (int) $nkode;
                    // setiap $kode di tambah 1
                    $kodex = $kodex + 1;
                    $kode_usaha = "ush" . str_pad($kodex, 3, "0", STR_PAD_LEFT);
                } else {
                    $kode_usaha = "ush001";
                }


                $this->mod_user->simpan($kode_otomatis);
                $this->mod_usaha->create($kode_usaha, $kode_otomatis);
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

    function updateProfile()
    {

        if (isset($_POST['submit'])) {
            $config['upload_path']          = './asset/dist/img/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            = $_FILES['image']['name'];
            $config['overwrite']            = true;
            $config['max_size']             = 30048;
            $this->load->library('upload', $config);

            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload(('image'))) {

                    $nama_file = $this->upload->data('file_name');
                    $nama = $this->input->post('nama');
                    $email = $this->input->post('email');
                    $xls = $this->db->get_where('users', ['email' => $email])->row_array();
                    $fotolama = $xls['image'];
                    if (!empty($fotolama)) {
                        unlink("./asset/dist/img/" . $fotolama);
                    }
                    $this->db->set('nama', $nama);
                    $this->db->set('image', $nama_file);
                    $this->db->where('email', $email);
                    $this->db->update('users');

                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                Data Profile berhasil Diupdate.</div>');
                    redirect('admin/user/updateProfile');
                }
            } else {
                $nama = $this->input->post('nama');
                $email = $this->input->post('email');


                $this->db->set('nama', $nama);
                $this->db->where('email', $email);
                $this->db->update('users');
                $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data Profile berhasil diupdate.</div>');
                redirect('admin/user/updateProfile');
            }
        } else {
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/user/update-profile', $data);
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


            $id            = $this->uri->segment(4);
            $data['users']   = $this->db->get_where('users', array('user_id' => $id))->row_array();
            $data['usaha'] = $this->mod_user->selectByUser($id)->row_array();

            $data['role'] =  $this->db->get('user_role')->result();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/user/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }


    function changePassword()
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules(
                'c_pass',
                'Password Sekarang',
                'required|min_length[8]'
            );
            $this->form_validation->set_rules(
                'n_pass1',
                'Password Baru',
                'required|min_length[8]|matches[n_pass2]',
                ['matches' => 'password not matches', 'min_length' => 'paasword too short']
            );
            $this->form_validation->set_rules('n_pass2', 'Konfirm Password Baru', 'required|min_length[8]|matches[n_pass1]');
            if ($this->form_validation->run() == false) {

                $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view('admin/template/header', $data);
                $this->load->view('admin/template/navbar', $data);
                $this->load->view('admin/template/sidebar', $data);
                $this->load->view('admin/user/change-p', $data);
                $this->load->view('admin/template/footer');
            } else {
                $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
                $c = $this->input->post('c_pass');
                $n = $this->input->post('n_pass1');
                if (!password_verify($c, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class= "alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Maaf Anda Salah Mengetik Password Aktif</div>');
                    redirect('admin/user/changePassword');
                } else {
                    $p_hash = password_hash($n, PASSWORD_DEFAULT);
                    $this->db->set('password', $p_hash);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('users');
                    $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Password Berhasil Dirubah</div>');
                    redirect('admin/user/changePassword');
                }
            }
        } else {
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/user/change-p', $data);
            $this->load->view('admin/template/footer');
        }
    }
}
