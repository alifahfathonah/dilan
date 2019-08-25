<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Limbah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_limbah');

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
        $data['usaha'] = $this->mod_limbah->selectByUsaha($user)->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/limbah/view', $data);
        $this->load->view('admin/template/footer');
    }

    function create()
    {
        if (isset($_POST['submit'])) {

            $bfr = floatval($this->input->post('before'));
            $now = floatval($this->input->post('now'));
            $ttl_now = floatval($bfr + $now);
            $used = floatval($this->input->post('used'));
            $give = floatval($this->input->post('to-part'));
            $sisa = floatval($ttl_now - ($used + $give));

            // $bln = substr($this->input->post('tgl_pantau'), 5, 2);
            $bln = $this->input->post('periode');
            if ($bln == 'January') {
                $b = '01';
            } else if ($bln == 'February') {
                $b = '02';
            } else if ($bln == 'March') {
                $b = '03';
            } else if ($bln == 'April') {
                $b = '04';
            } else if ($bln == 'May') {
                $b = '05';
            } else if ($bln == 'June') {
                $b = '06';
            } else if ($bln == 'July') {
                $b = '07';
            } else if ($bln == 'August') {
                $b = '08';
            } else if ($bln == 'September') {
                $b = '09';
            } else if ($bln == 'October') {
                $b = '10';
            } else if ($bln == 'November') {
                $b = '11';
            } else if ($bln == 'December') {
                $b = '12';
            }
            $thn = $this->input->post('tahun');
            $data = [
                'id_usaha' => $this->input->post('id_usaha'),
                'jenis_b3' =>  $this->input->post('jenis'),
                'jml_bfr' =>  $bfr,
                'jml_now' => $now,
                'ttl_now' =>  $ttl_now,
                'used' => $used,
                'give_3' => $give,
                'sisa' => $sisa,
                'bln' => $b,
                'thn_b3' => $thn
            ];



            $this->mod_limbah->simpan($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        Data berhasil Disimpan.</div>');
            redirect('admin/limbah');
        } else {

            $data['usaha'] = $this->mod_limbah->selectByUser($this->session->userdata('user_id'))->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/limbah/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function edit()
    {
        if (isset($_POST['update'])) {



            $bfr = floatval($this->input->post('before'));
            $now = floatval($this->input->post('now'));
            $ttl_now = floatval($this->input->post('u_now'));
            $used = floatval($this->input->post('used'));
            $give = floatval($this->input->post('to-part'));
            $sisa = floatval($ttl_now - ($used + $give));


            //$bln = substr($this->input->post('tgl_pantau'), 5, 2);
            $bln = $this->input->post('periode');
            if ($bln == 'January') {
                $b = '01';
            } else if ($bln == 'February') {
                $b = '02';
            } else if ($bln == 'March') {
                $b = '03';
            } else if ($bln == 'April') {
                $b = '04';
            } else if ($bln == 'May') {
                $b = '05';
            } else if ($bln == 'June') {
                $b = '06';
            } else if ($bln == 'July') {
                $b = '07';
            } else if ($bln == 'August') {
                $b = '08';
            } else if ($bln == 'September') {
                $b = '09';
            } else if ($bln == 'October') {
                $b = '10';
            } else if ($bln == 'November') {
                $b = '11';
            } else if ($bln == 'December') {
                $b = '12';
            }

            $thn = $this->input->post('tahun');
            $data = [

                'jenis_b3' =>  $this->input->post('jenis'),
                'jml_bfr' =>  $bfr,
                'jml_now' => $now,
                'ttl_now' =>  $ttl_now,
                'used' => $used,
                'give_3' => $give,
                'sisa' => $sisa,
                'bln' => $b,
                'thn_b3' => $thn
            ];

            $this->mod_limbah->update($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data Berhasil Diubah</div>');
            redirect('admin/limbah');
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_limbah->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/limbah/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function delete($id)
    {
        $this->db->where('id_b3', $id);
        $this->db->delete('p_b3');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data berhasil Dihapus.</div>');
        redirect('admin/limbah');
    }
}
