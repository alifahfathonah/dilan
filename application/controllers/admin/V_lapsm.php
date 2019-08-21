<?php
defined('BASEPATH') or exit('No direct script access allowed');

class V_lapsm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_pelpsix');
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
        $this->load->view('admin/v_lapsm/view', $data);
        $this->load->view('admin/template/footer');
    }

    function create()
    {
        if (isset($_POST['kirim'])) {
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');
            $id = $this->input->post('id_usaha');
            $data = [

                'id_usaha' => $id,
                'periode_sm' => $pr,
                'tahun_sm' => $th

            ];
            $this->mod_pelpsix->create_six($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Laporan Semester Berhasil Dikirim</div>');
            redirect('admin/v_lapsm/listlapsix');
        } else {
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $user = $data['user']['user_id'];
            $data['usaha'] = $this->mod_pelpsix->selectByUsaha($user)->row_array();


            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_lapsm/create', $data);
            $this->load->view('admin/template/footer');
        }
    }


    function edit()
    {
        if (isset($_POST['update'])) {
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');

            $data = [


                'periode_sm' => $pr,
                'tahun_sm' => $th

            ];
            $this->mod_pelpsix->update_six($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Laporan Semester Berhasil Diupdate</div>');
            redirect('admin/v_lapsm/listlapsix');
        } else {
            $id = $this->uri->segment(4);
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $user = $data['user']['user_id'];
            $data['usaha'] = $this->mod_pelpsix->selectByUsaha($user)->row_array();
            $data['lapsm'] = $this->mod_pelpsix->selectById($id)->row_array();
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_lapsm/edit_u', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function delete($id)
    {
        $id = $this->uri->segment(4);
        $this->db->where('id_lapsm', $id);
        $this->db->delete('lap_sm');
        $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Laporan Semester Berhasil Dihapus</div>');
        redirect('admin/v_lapsm/listlapsix');
    }
    function act()
    {
        if (isset($_POST['update'])) {

            $idx = $this->input->post('id_usaha');

            $data = [

                'vlapsm' => '1',
                'tgl_vlapsm' => date('Y-m-d')

            ];
            $this->mod_pelpsix->verify($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Laporan Triwulan Telah Diverifikasi</div>');
            redirect('admin/v_lapsm/report/' . $idx);
        } else {

            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_pelpsix->selectById($id)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_lapsm/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }

    function report($id)
    {
        $id = $this->uri->segment(4);
        $data['usaha'] = $this->mod_pelpsix->selectv_usaha($id)->result_array();


        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_lapsm/report', $data);
        $this->load->view('admin/template/footer');
    }

    function listlapsix()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];
        $data['usaha'] = $this->mod_pelpsix->selectByUsaha($user)->result_array();
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_lapsm/view_u', $data);
        $this->load->view('admin/template/footer');
    }

    function act1()
    {
        if (isset($_POST['kirim'])) {

            echo "some thing wrong";
        } else if (isset($_POST['correct'])) {

            $idx = $this->input->post('id_usaha');
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');
            $ket = $this->input->post('ket');

            $data = [

                'sts_lapsm' => '1',
                'ket_lapsm' => $ket,
                'kd_lapsm' => '',
                'tgl_trma' => ''
            ];
            $this->mod_pelpsix->correct($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Laporan Berhasil Dikoreksi</div>');
            redirect('admin/v_lapsm/report/' . $idx);
        } else if (isset($_POST['verify'])) {
            $idx = $this->input->post('id_usaha');
            $pr = $this->input->post('periode');
            $th = $this->input->post('tahun');
            $ket = $this->input->post('ket');
            $kode = $this->_random_char(20);
            $terima = date('Y-m-d');
            $data = [

                'sts_lapsm' => '2',
                'ket_lapsm' => $ket,
                'kd_lapsm' => $kode,
                'tgl_trma' => $terima
            ];
            $this->mod_pelpsix->verify($data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Laporan Berhasil Diverifikasi</div>');
            redirect('admin/v_lapsm/report/' . $idx);
        } else {
            $param = $this->uri->segment(5);
            $id = $this->uri->segment(4);
            $data['usaha'] = $this->mod_pelpsix->selectv_six($id, $param)->row_array();

            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('admin/template/header', $data);
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/v_lapsm/edit', $data);
            $this->load->view('admin/template/footer');
        }
    }

    private function _random_char($panjang)
    {
        $karakter = "ABCDEFGHIJKL123456789";
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
        $data['usaha'] = $this->mod_pelpsix->selectsm_usaha($idu, $id)->row_array();

        $pdf = new PDF_MC_Table();


        // membuat halaman baru
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Legal');
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 
        $pdf->Image(base_url() . '/asset/dist/img/gor.png', 93, 15, 20, 20);
        $pdf->Ln(25);
        $pdf->Cell(196, 7, 'TANDA TERIMA ELEKTRONIK (TTE)', 0, 1, 'C');
        $pdf->Cell(196, 7, 'MEDIA PELAPORAN PERIZINAN LINGKUNGAN  ', 0, 1, 'C');

        $pdf->Cell(196, 7, '( D I L A N )', 0, 1, 'C');
        $pdf->Cell(196, 7, 'DINAS LINGKUNGAN HIDUP DAN SUMBER DAYA ALAM', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'ID TTE', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['kd_lapsm'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'Periode Pelaporan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['periode_sm'] . " " . $data['usaha']['tahun_sm'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'Tanggal Terbit', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, $data['usaha']['tgl_trma'], 0, 1);

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
