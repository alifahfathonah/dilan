<?php
defined('BASEPATH') or exit('No direct script access allowed');

class V_laptri extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_pelptri');
        $this->load->library('fpdf_lib');
        include_once APPPATH . 'libraries/Tablepdf.php';
        include_once APPPATH . 'libraries/Mypdf.php';


        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 1 and $this->session->userdata('role_id') != 4) {
                redirect('auth');
            }
        }
    }

    function index()
    {
        $data['usaha'] = $this->mod_usaha->selectByUsaha()->result_array();
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_laptri/view', $data);
        $this->load->view('admin/template/footer');
    }



    function act()
    {
        if (isset($_POST['update'])) {

            $idx = $this->input->post('id_usaha');

            $data = [

                'vlap' => '1',
                'tgl_vlap' => date('Y-m-d')

            ];
            $this->mod_pelptri->verify($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Laporan Triwulan Telah Diverifikasi</div>');
            redirect('admin/v_laptri/report/' . $idx);
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_pelptri->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_laptri/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function report($id)
    {
        $id = $this->uri->segment(4);
        $data['usaha'] = $this->mod_pelptri->selectv_usaha($id)->result_array();
        $data['lap_tri'] = $this->db->get_where('lap_tri', ['id_usaha' => $id])->row_array();

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_laptri/report', $data);
        $this->load->view('admin/template/footer');
    }

    function act1()
    {
        if (isset($_POST['kirim'])) {

            $idx = $this->input->post('id_usaha');
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');

            $data = [

                'id_usaha' => $idx,
                'periode_t' => $pr,
                'tahun_t' => $th

            ];
            $this->mod_pelptri->create_tri($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Laporan Triwulan Berhasil Dikirim</div>');
            redirect('admin/v_laptri/create/');
        } else if (isset($_POST['correct'])) {

            $idx = $this->input->post('id_usaha');
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');
            $ket = $this->input->post('ket');

            $data = [

                'sts_lapt' => '1',
                'ket' => $ket,
                'kode_terima' => '',
                'tgl_terima' => ''
            ];
            $this->mod_pelptri->correct($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Status Laporan Berhasil Dikoreksi</div>');
            redirect('admin/v_laptri/report/' . $idx);
        } else if (isset($_POST['verify'])) {
            $idx = $this->input->post('id_usaha');
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');
            $ket = $this->input->post('ket');
            $kode = $this->_random_char(20);
            $terima = date('Y-m-d');
            $data = [

                'sts_lapt' => '2',
                'ket' => $ket,
                'kode_terima' => $kode,
                'tgl_terima' => $terima
            ];
            $this->mod_pelptri->correct($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Laporan Berhasil Diverifikasi</div>');
            redirect('admin/v_laptri/report/' . $idx);
        } else {
            $param = $this->uri->segment(5);
            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_pelptri->selectv_tri($id, $param)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_laptri/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }


    function create()
    {
        if (isset($_POST['kirim'])) {
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');
            $id = $this->input->post('id_usaha');
            $data = [

                'id_usaha' => $id,
                'periode_t' => $pr,
                'tahun_t' => $th

            ];
            $this->mod_pelptri->create_tri($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Laporan Triwulan Berhasil Dikirim</div>');
            redirect('admin/v_laptri/listlaptri');
        } else {
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $user = $data['user']['user_id'];
            $data['usaha'] = $this->mod_pelptri->selectByUsaha($user)->row_array();


            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_laptri/create', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function edit()
    {
        if (isset($_POST['update'])) {
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');

            $data = [


                'periode_t' => $pr,
                'tahun_t' => $th

            ];
            $this->mod_pelptri->update_tri($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Laporan Triwulan Berhasil Diupdate</div>');
            redirect('admin/v_laptri/listlaptri');
        } else {
            $id = $this->uri->segment(4);
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $user = $data['user']['user_id'];
            $data['usaha'] = $this->mod_pelptri->selectByUsaha($user)->row_array();
            $data['laptri'] = $this->mod_pelptri->selectById($id)->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_laptri/edit_u', $data);
            $this->load->view('admin/template/footer');
        }
    }
    function listlaptri()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];
        $data['usaha'] = $this->mod_pelptri->selectByUsaha($user)->row_array();
        $data['laptri'] = $this->mod_pelptri->selectUsaha($user)->result_array();


        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_laptri/view_u', $data);
        $this->load->view('admin/template/footer');
    }
    function delete($id)
    {
        $id = $this->uri->segment(4);
        $this->db->where('id_laptri', $id);
        $this->db->delete('lap_tri');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Laporan Triwulan Berhasil Dihapus</div>');
        redirect('admin/v_laptri/listlaptri');
    }

    private function _random_char($panjang)
    {
        $karakter = "ABCDEFGHIJKL123456789_-";
        $string = "";
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{
                $pos};
        }
        return $string;
    }

    function print_kode($id, $idu)
    {
        $data['usaha'] = $this->mod_pelptri->selectr_usaha($idu, $id)->row_array();

        $pdf = new PDF_MC_Table();


        // membuat halaman baru
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Legal');
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 

        $pdf->Cell(196, 7, 'TANDA TERIMA ELEKTRONIK (TTE)', 0, 1, 'C');
        $pdf->Cell(196, 7, 'MEDIA PELAPORAN PERIZINAN LINGKUNGAN  ', 0, 1, 'C');

        $pdf->Cell(196, 7, '( D I L A N )', 0, 1, 'C');
        $pdf->Cell(196, 7, 'DINAS LINGKUNGAN HIDUP DAN SUMBER DAYA ALAM', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'IDI TTE', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['kode_terima'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'Periode Pelaporan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['periode_t'] . " " . $data['usaha']['tahun_t'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'Tanggal Terima', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, $data['usaha']['tgl_terima'], 0, 1);

        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'Nama Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['nm_usaha'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'Nama Penanggung Jawab', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['owner'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'Lokasi Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, 'Desa :  ' . $data['usaha']['almt_ush'] . ',  Kecamatan:  ' . $data['usaha']['kec_ush'], 0, 1);

        $pdf->Ln(15);
        $pdf->SetFont('Arial', '', 10);
        $txt = "Tanda Terima Elektronik ini sebagai bukti bahwa laporan yang disampaikan melalui DILAN telah lengkap dan terverifikasi oleh Dinas Lingkungan Hidup dan Sumber Daya Alam Kabupaten Gorontalo. Dokumen ini sah, diterbitkan secara elektronik oleh Dinas Lingkungan Hidup dan Sumber Daya Alam Kabupaten Gorontalo sehingga tidak memerlukan cap dan tanda tangan basah.";

        $pdf->MultiCell(196, 6, $txt, 0, 'J', 0, 0);
        $pdf->Ln(15);
        $pdf->Cell(100, 6, 'Terima kasih telah menyampaikan laporan pelaksanaan perizinan lingkungan.', 0, 1, 'L');

        $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, 7, 'Tim Pengelola DILAN', 0, 1, 'C');
        $pdf->Cell(196, 7, 'Dinas Lingkungan Hidup Dan Sumber Daya Alam Kabupaten Gorontalo', 0, 1, 'C');
        $pdf->Output('I', 'TANDA TERIMA');
    }
}
