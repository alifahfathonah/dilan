<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Claptri extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_pelptri');
        $this->load->model('admin/mod_air');
        $this->load->model('admin/mod_limbah');
        $this->load->model('admin/mod_udara');
        $this->load->model('admin/mod_izin');
        $this->load->model('admin/mod_sarana');
        $this->load->model('admin/mod_boiler');
        $this->load->model('admin/mod_genset');
        $this->load->library('fpdf_lib');
        include_once APPPATH . 'libraries/Tablepdf.php';
        include_once APPPATH . 'libraries/Mypdf.php';

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 4 && $this->session->userdata('role_id') != 1) {
                redirect('auth');
            }
        }
    }

    function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];
        $role = $data['user']['role_id'];
        if ($role == 4) {
            $data['usaha'] = $this->mod_pelptri->selectByUsaha($user)->result_array();
        } else if ($role == 1) {
            $data['usaha'] = $this->mod_pelptri->selectByUsaha($user)->result_array();
        }

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/c-laptri/view', $data);
        $this->load->view('admin/template/footer');
    }



    function print_satu($id)
    {
        $data['usaha'] = $this->mod_pelptri->selectByUsahaId($id)->row_array();
        $data['air'] = $this->mod_air->selectByUsahaId($id)->result();
        $data['udara'] = $this->mod_udara->selectByUsahaId($id)->result();
        $data['limbahj'] = $this->mod_limbah->selectByUsahaIdj($id)->result();
        $data['limbahf'] = $this->mod_limbah->selectByUsahaIdf($id)->result();
        $data['limbahm'] = $this->mod_limbah->selectByUsahaIdm($id)->result();
        $InterLigne = 7;
        $pdf = new PDF_MC_Table();
        // membuat halaman baru
        $pdf->AddPage('P', 'Legal');
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'BAB II PEMANTAUAN KUALITAS LINGKUNGAN', 0, 1, 'C');



        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Hasil Pemantauan Kualitas Air Limbah', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pemantauan kualitas air limbah periode Januari s/d Maret 2019 adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Parameter', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Baku Mutu (mg/l)', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Januari', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Februari', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Maret', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['air'] as $h) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->parameter_a, 1, 0, 'L');
            $pdf->Cell(30, 10, $h->bk_mutu, 1, 0, 'C');
            $pdf->Cell(50, 10, $h->b1, 1, 0, 'C');
            $pdf->Cell(50, 10, $h->b2, 1, 0, 'C');
            $pdf->Cell(20, 10, $h->b3, 1, 1, 'C');
            $no++;
        }


        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '2. Hasil Pemantauan Kualitas Udara', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pengujian kualitas udara periode Januari s/d Maret 2019 adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Parameter', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Baku Mutu (mg/l)', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Januari', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Februari', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Maret', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['udara'] as $d) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->parameter_u, 1, 0, 'L');
            $pdf->Cell(30, 10, $d->bk_mutu, 1, 0, 'C');
            $pdf->Cell(50, 10, $d->b1, 1, 0, 'C');
            $pdf->Cell(50, 10, $d->b2, 1, 0, 'C');
            $pdf->Cell(20, 10, $d->b3, 1, 1, 'C');
            $no++;
        }


        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Pengelolaan Limbah B3', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data limbah B3 yang dihasilkan selama periode pelaporan adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        /*  $pdf->Cell(195, 7, 'PERIODE BULAN JANUARI ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Jenis Limbah B3', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Jml Periode Sebelumnya', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Jml Periode Ini', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Jml Sampai Periode Ini', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Dimanfaatkan', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Ke Pihak k 3', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Sisa di TPS', 1, 1, 'C');*/
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN JANUARI ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahj'] as $e) {

            $pdf->Row(array(
                $no,
                $e->jenis_b3,
                $e->jml_bfr,
                $e->jml_now,
                $e->ttl_now,
                $e->used,
                $e->give_3,
                $e->sisa
            ));

            $no++;
        }
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN FEBRUARI ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahf'] as $f) {

            $pdf->Row(array(
                $no,
                $f->jenis_b3,
                $f->jml_bfr,
                $f->jml_now,
                $f->ttl_now,
                $f->used,
                $f->give_3,
                $f->sisa
            ));
            $no++;
        }
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN MARET ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['limbahm'] as $g) {

            $pdf->Row(array(
                $no,
                $g->jenis_b3,
                $g->jml_bfr,
                $g->jml_now,
                $g->ttl_now,
                $g->used,
                $g->give_3,
                $g->sisa
            ));
            $no++;
        }

        $pdf->Output('I', 'lap-triI.pdf');
    }

    function print_dua($id)
    {
        $data['usaha'] = $this->mod_pelptri->selectByUsahaId($id)->row_array();
        $data['air'] = $this->mod_air->selectByUsahaId($id)->result();
        $data['udara'] = $this->mod_udara->selectByUsahaId($id)->result();
        $data['limbaha'] = $this->mod_limbah->selectByUsahaIda($id)->result();
        $data['limbahme'] = $this->mod_limbah->selectByUsahaIdme($id)->result();
        $data['limbahjn'] = $this->mod_limbah->selectByUsahaIdjn($id)->result();
        $InterLigne = 7;
        $pdf = new PDF_MC_Table();
        // membuat halaman baru
        $pdf->AddPage('P', 'Legal');
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'BAB II PEMANTAUAN KUALITAS LINGKUNGAN', 0, 1, 'C');



        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Hasil Pemantauan Kualitas Air Limbah', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pemantauan kualitas air limbah periode April s/d Juni 2019 adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Parameter', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Baku Mutu (mg/l)', 1, 0, 'C');
        $pdf->Cell(30, 10, 'April', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Mei', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Juni', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['air'] as $h) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->parameter_a, 1, 0, 'L');
            $pdf->Cell(30, 10, $h->bk_mutu, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->b4, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->b5, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->b6, 1, 1, 'C');
            $no++;
        }


        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '2. Hasil Pemantauan Kualitas Udara', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pengujian kualitas udara periode April s/d Juni 2019 adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Parameter', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Baku Mutu (mg/l)', 1, 0, 'C');
        $pdf->Cell(30, 10, 'April', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Mei', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Juni', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['udara'] as $d) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->parameter_u, 1, 0, 'L');
            $pdf->Cell(30, 10, $d->bk_mutu, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->b4, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->b5, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->b6, 1, 1, 'C');
            $no++;
        }


        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Pengelolaan Limbah B3', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data limbah B3 yang dihasilkan selama periode pelaporan adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN APRIL ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);


        $no = 1;
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbaha'] as $e) {

            $pdf->Row(array(
                $no,
                $e->jenis_b3,
                $e->jml_bfr,
                $e->jml_now,
                $e->ttl_now,
                $e->used,
                $e->give_3,
                $e->sisa
            ));
            $no++;
        }


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN MEI ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        $no = 1;
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahme'] as $f) {

            $pdf->Row(array(
                $no,
                $f->jenis_b3,
                $f->jml_bfr,
                $f->jml_now,
                $f->ttl_now,
                $f->used,
                $f->give_3,
                $f->sisa
            ));
            $no++;
        }

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN JUNI ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);


        $no = 1;
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahjn'] as $g) {

            $pdf->Row(array(
                $no,
                $g->jenis_b3,
                $g->jml_bfr,
                $g->jml_now,
                $g->ttl_now,
                $g->used,
                $g->give_3,
                $g->sisa
            ));
            $no++;
        }






        $pdf->Output('I', 'lap-triII.pdf');
    }

    function print_tiga($id)
    {
        $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();
        $data['air'] = $this->mod_air->selectByUsahaId($id)->result();
        $data['udara'] = $this->mod_udara->selectByUsahaId($id)->result();
        $data['limbahju'] = $this->mod_limbah->selectByUsahaIdju($id)->result();
        $data['limbahag'] = $this->mod_limbah->selectByUsahaIdag($id)->result();
        $data['limbahse'] = $this->mod_limbah->selectByUsahaIdse($id)->result();
        $InterLigne = 7;
        $pdf = new PDF_MC_Table();
        // membuat halaman baru
        $pdf->AddPage('P', 'Legal');
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'BAB II PEMANTAUAN KUALITAS LINGKUNGAN', 0, 1, 'C');



        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Hasil Pemantauan Kualitas Air Limbah', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pemantauan kualitas air limbah periode Juli s/d September 2019 adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Parameter', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Baku Mutu (mg/l)', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Juli', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Agustus', 1, 0, 'C');
        $pdf->Cell(30, 10, 'September', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['air'] as $h) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->parameter_a, 1, 0, 'L');
            $pdf->Cell(30, 10, $h->bk_mutu, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->b7, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->b8, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->b9, 1, 1, 'C');
            $no++;
        }


        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '2. Hasil Pemantauan Kualitas Udara', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pengujian kualitas udara periode Juli s/d September 2019 adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Parameter', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Baku Mutu (mg/l)', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Juli', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Agustus', 1, 0, 'C');
        $pdf->Cell(30, 10, 'September', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['udara'] as $d) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->parameter_u, 1, 0, 'L');
            $pdf->Cell(30, 10, $d->bk_mutu, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->b7, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->b8, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->b9, 1, 1, 'C');
            $no++;
        }


        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Pengelolaan Limbah B3', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data limbah B3 yang dihasilkan selama periode pelaporan adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN JULI ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);


        $no = 1;
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahju'] as $e) {

            $pdf->Row(array(
                $no,
                $e->jenis_b3,
                $e->jml_bfr,
                $e->jml_now,
                $e->ttl_now,
                $e->used,
                $e->give_3,
                $e->sisa
            ));
            $no++;
        }


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN AGUSTUS ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        $no = 1;
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahag'] as $f) {

            $pdf->Row(array(
                $no,
                $f->jenis_b3,
                $f->jml_bfr,
                $f->jml_now,
                $f->ttl_now,
                $f->used,
                $f->give_3,
                $f->sisa
            ));
            $no++;
        }

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN SEPTEMBER ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);


        $no = 1;
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahse'] as $g) {

            $pdf->Row(array(
                $no,
                $g->jenis_b3,
                $g->jml_bfr,
                $g->jml_now,
                $g->ttl_now,
                $g->used,
                $g->give_3,
                $g->sisa
            ));
            $no++;
        }






        $pdf->Output('I', 'lap-triIII.pdf');
    }

    function print_empat($id)
    {
        $data['usaha'] = $this->mod_pelptri->selectByUsahaId($id)->row_array();
        $data['air'] = $this->mod_air->selectByUsahaId($id)->result();
        $data['udara'] = $this->mod_udara->selectByUsahaId($id)->result();
        $data['limbahok'] = $this->mod_limbah->selectByUsahaIdok($id)->result();
        $data['limbahno'] = $this->mod_limbah->selectByUsahaIdno($id)->result();
        $data['limbahde'] = $this->mod_limbah->selectByUsahaIdde($id)->result();

        $pdf = new PDF_MC_Table();
        // membuat halaman baru
        $pdf->AddPage('P', 'Legal');
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'BAB II PEMANTAUAN KUALITAS LINGKUNGAN', 0, 1, 'C');





        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Hasil Pemantauan Kualitas Air Limbah', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pemantauan kualitas air limbah periode Oktober s/d Desember 2019 adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Parameter', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Baku Mutu (mg/l)', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Oktober', 1, 0, 'C');
        $pdf->Cell(30, 10, 'November', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Desember', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['air'] as $h) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->parameter_a, 1, 0, 'L');
            $pdf->Cell(30, 10, $h->bk_mutu, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->b10, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->b11, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->b12, 1, 1, 'C');
            $no++;
        }


        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '2. Hasil Pemantauan Kualitas Udara', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pengujian kualitas udara periode Oktober s/d Desember 2019 adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Parameter', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Baku Mutu (mg/l)', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Oktober', 1, 0, 'C');
        $pdf->Cell(30, 10, 'November', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Desember', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['udara'] as $d) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->parameter_u, 1, 0, 'L');
            $pdf->Cell(30, 10, $d->bk_mutu, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->b10, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->b11, 1, 0, 'C');
            $pdf->Cell(30, 10, $d->b12, 1, 1, 'C');
            $no++;
        }


        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Pengelolaan Limbah B3', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data limbah B3 yang dihasilkan selama periode pelaporan adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN OKTOBER ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);


        $no = 1;
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahok'] as $e) {

            $pdf->Row(array(
                $no,
                $e->jenis_b3,
                $e->jml_bfr,
                $e->jml_now,
                $e->ttl_now,
                $e->used,
                $e->give_3,
                $e->sisa
            ));
            $no++;
        }


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN NOVEMBER ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        $no = 1;
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahno'] as $f) {

            $pdf->Row(array(
                $no,
                $f->jenis_b3,
                $f->jml_bfr,
                $f->jml_now,
                $f->ttl_now,
                $f->used,
                $f->give_3,
                $f->sisa
            ));
            $no++;
        }

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(175, 7, 'PERIODE BULAN DESEMBER ', 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 25, 25, 25, 20, 25, 20));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Limbah B3', 'Jml Periode Sebelumnya', 'Jml Periode Ini', 'Jml Sampai Periode Ini', 'Dimanfaatkan', 'Ke Pihak k 3', 'Sisa di TPS'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);


        $no = 1;
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['limbahde'] as $g) {

            $pdf->Row(array(
                $no,
                $g->jenis_b3,
                $g->jml_bfr,
                $g->jml_now,
                $g->ttl_now,
                $g->used,
                $g->give_3,
                $g->sisa
            ));
            $no++;
        }






        $pdf->Output('I', 'lap-triIV.pdf');
    }

    function print_profil_satu($id)
    {
        $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();
        $data['izin'] = $this->mod_izin->selectByUsahaId($id)->result();
        $data['sarana'] = $this->mod_sarana->selectByUsahaId($id)->row_array();
        $data['boiler'] = $this->mod_boiler->selectByUsahaId($id)->result();
        $data['genset'] = $this->mod_genset->selectByUsahaId($id)->result();
        $pdf = new PDF_MC_Table();


        // membuat halaman baru
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Legal');
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 

        $pdf->Cell(196, 7, 'LAPORAN PENGELOLAAN DAN PEMANTAUAN ', 0, 1, 'C');
        $pdf->Cell(196, 7, 'LINGKUNGAN / PERIZINAN LINGKUNGAN ', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(196, 7, $data['usaha']['nm_usaha'], 0, 1, 'C');
        $pdf->Cell(196, 7, 'PERIODE BULAN JANUARI S/D MARET 2019', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(196, 7, 'BAB 1. PENDAHULUAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Profil Usaha / Kegiatan', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'a. Nama Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['nm_usaha'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'b. Jenis Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, $data['usaha']['jenis'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'c. Nama Penanggung Jawab', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['owner'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'd. Alamat Kantor', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, 'Desa :  ' . $data['usaha']['almt_ktr'] . ',  Kecamatan:  ' . $data['usaha']['kec_ktr'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'e. Lokasi Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, 'Desa :  ' . $data['usaha']['almt_ush'] . ',  Kecamatan:  ' . $data['usaha']['kec_ush'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'f. No Telpon Kantor', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['telepon'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'g. Email', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['email_u'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'h. Tahun Operasi', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);

        $pdf->Cell(10, 6, $data['usaha']['tahun_opr'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'i. Jenis Dokumen Lingkungan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_dok'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(35, 6, 'j. Tahun Pengesahan Dokumen Lingkungan ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['tahun_sah'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'k. Luas Lahan Usaha / Kegiatan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['luas_lahan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'l. Jenis Produk', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_produk'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'm. Kapasitas Produksi', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['kapasitas'] . ' (ton/bln)', 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'n. Jenis Bahan Baku ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_bahan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'o. Penggunaan Bahan Baku', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['penggunaan'] . ' (ton/bln)', 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'p. Sumber Air Baku', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['sumber_air'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'q. Jumlah Karyawan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jml_karyawan'] . ' Orang', 0, 1);
        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '2. Perizinan Dan Non Perizinan Yang Dimiliki', 0, 1);
        $pdf->Ln(5);




        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 30, 40, 30, 30, 40));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Izin', 'Nomor Izin', 'Tgl. Terbit', 'Masa Berlaku', 'Keterangan'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['izin'] as $o) {

            $pdf->Row(array(
                $no,
                $o->j_izin,
                $o->nmr_izin,
                $o->tgl_terbit,
                $o->berlaku,
                $o->keterangan,
            ));

            $no++;
        }







        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Sarana Dan Prasarana Yang Dimiliki', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'a.  Bangunan (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['l_bangunan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'b.  Lahan Parkir (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['l_parkir'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'c.  Ruang Terbuka Hijau (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['ruang_hijau'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(25, 6, 'd.  Tempat Penyimpanan LB3 (m2)', 0, 0);
        $pdf->Cell(35);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['penyimpanan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'e.  Boiler', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);





        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 20, 25, 30, 30, 30, 25));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Nama Boiler', 'Kapasitas (Hp)', 'Bahan Bakar', 'Tinggi Cerobong', 'Bentuk Cerobong', 'Diameter Cerobong (m)', 'Waktu Operasi (jam)'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['boiler'] as $e) {

            $pdf->Row(array(
                $no,
                $e->nm_boiler,
                $e->kp_boiler,
                $e->b_bakar,
                $e->tinggi,
                $e->bentuk,
                $e->diameter,
                $e->w_opr
            ));

            $no++;
        }


        $pdf->SetFont('Arial', '', 10);

        $pdf->Ln(5);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'f.  Genset', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 40, 25, 25, 30));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Nama Genset', 'Kapasitas (KVA)', 'Bahan Bakar', 'Waktu Operasi (jam)'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['genset'] as $y) {

            $pdf->Row(array(
                $no,
                $y->nm_genset,
                $y->kp_genset,
                $y->bhn_bkrgent,
                $y->wkt_opr
            ));

            $no++;
        }



        $pdf->Output('I', 'bab1.pdf');
    }

    function print_profil_dua($id)
    {
        $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();
        $data['izin'] = $this->mod_izin->selectByUsahaId($id)->result();
        $data['sarana'] = $this->mod_sarana->selectByUsahaId($id)->row_array();
        $data['boiler'] = $this->mod_boiler->selectByUsahaId($id)->result();
        $data['genset'] = $this->mod_genset->selectByUsahaId($id)->result();
        $pdf = new PDF_MC_Table();


        // membuat halaman baru
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Legal');
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 

        $pdf->Cell(196, 7, 'LAPORAN PENGELOLAAN DAN PEMANTAUAN ', 0, 1, 'C');
        $pdf->Cell(196, 7, 'LINGKUNGAN / PERIZINAN LINGKUNGAN ', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(196, 7, $data['usaha']['nm_usaha'], 0, 1, 'C');
        $pdf->Cell(196, 7, 'PERIODE BULAN APRIL S/D JUNI 2019', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(196, 7, 'BAB 1. PENDAHULUAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Profil Usaha / Kegiatan', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'a. Nama Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['nm_usaha'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'b. Jenis Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, $data['usaha']['jenis'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'c. Nama Penanggung Jawab', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['owner'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'd. Alamat Kantor', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, 'Desa :  ' . $data['usaha']['almt_ktr'] . ',  Kecamatan:  ' . $data['usaha']['kec_ktr'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'e. Lokasi Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, 'Desa :  ' . $data['usaha']['almt_ush'] . ',  Kecamatan:  ' . $data['usaha']['kec_ush'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'f. No Telpon Kantor', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['telepon'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'g. Email', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['email_u'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'h. Tahun Operasi', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);

        $pdf->Cell(10, 6, $data['usaha']['tahun_opr'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'i. Jenis Dokumen Lingkungan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_dok'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(35, 6, 'j. Tahun Pengesahan Dokumen Lingkungan ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['tahun_sah'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'k. Luas Lahan Usaha / Kegiatan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['luas_lahan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'l. Jenis Produk', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_produk'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'm. Kapasitas Produksi', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['kapasitas'] . ' (ton/bln)', 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'n. Jenis Bahan Baku ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_bahan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'o. Penggunaan Bahan Baku', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['penggunaan'] . ' (ton/bln)', 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'p. Sumber Air Baku', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['sumber_air'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'q. Jumlah Karyawan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jml_karyawan'] . ' Orang', 0, 1);
        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '2. Perizinan Dan Non Perizinan Yang Dimiliki', 0, 1);
        $pdf->Ln(5);




        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 30, 40, 30, 30, 40));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Izin', 'Nomor Izin', 'Tgl. Terbit', 'Masa Berlaku', 'Keterangan'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['izin'] as $o) {

            $pdf->Row(array(
                $no,
                $o->j_izin,
                $o->nmr_izin,
                $o->tgl_terbit,
                $o->berlaku,
                $o->keterangan,
            ));

            $no++;
        }







        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Sarana Dan Prasarana Yang Dimiliki', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'a.  Bangunan (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['l_bangunan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'b.  Lahan Parkir (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['l_parkir'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'c.  Ruang Terbuka Hijau (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['ruang_hijau'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(25, 6, 'd.  Tempat Penyimpanan LB3 (m2)', 0, 0);
        $pdf->Cell(35);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['penyimpanan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'e.  Boiler', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);





        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 20, 25, 30, 30, 30, 25));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Nama Boiler', 'Kapasitas (Hp)', 'Bahan Bakar', 'Tinggi Cerobong', 'Bentuk Cerobong', 'Diameter Cerobong (m)', 'Waktu Operasi (jam)'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['boiler'] as $e) {

            $pdf->Row(array(
                $no,
                $e->nm_boiler,
                $e->kp_boiler,
                $e->b_bakar,
                $e->tinggi,
                $e->bentuk,
                $e->diameter,
                $e->w_opr
            ));

            $no++;
        }


        $pdf->SetFont('Arial', '', 10);

        $pdf->Ln(5);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'f.  Genset', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 40, 25, 25, 30));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Nama Genset', 'Kapasitas (KVA)', 'Bahan Bakar', 'Waktu Operasi (jam)'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['genset'] as $y) {

            $pdf->Row(array(
                $no,
                $y->nm_genset,
                $y->kp_genset,
                $y->bhn_bkrgent,
                $y->wkt_opr
            ));

            $no++;
        }



        $pdf->Output('I', 'bab1.pdf');
    }

    function print_profil_tiga($id)
    {
        $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();
        $data['izin'] = $this->mod_izin->selectByUsahaId($id)->result();
        $data['sarana'] = $this->mod_sarana->selectByUsahaId($id)->row_array();
        $data['boiler'] = $this->mod_boiler->selectByUsahaId($id)->result();
        $data['genset'] = $this->mod_genset->selectByUsahaId($id)->result();
        $pdf = new PDF_MC_Table();


        // membuat halaman baru
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Legal');
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 

        $pdf->Cell(196, 7, 'LAPORAN PENGELOLAAN DAN PEMANTAUAN ', 0, 1, 'C');
        $pdf->Cell(196, 7, 'LINGKUNGAN / PERIZINAN LINGKUNGAN ', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(196, 7, $data['usaha']['nm_usaha'], 0, 1, 'C');
        $pdf->Cell(196, 7, 'PERIODE BULAN JULI S/D SEPTEMBER 2019', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(196, 7, 'BAB 1. PENDAHULUAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Profil Usaha / Kegiatan', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'a. Nama Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['nm_usaha'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'b. Jenis Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, $data['usaha']['jenis'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'c. Nama Penanggung Jawab', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['owner'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'd. Alamat Kantor', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, 'Desa :  ' . $data['usaha']['almt_ktr'] . ',  Kecamatan:  ' . $data['usaha']['kec_ktr'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'e. Lokasi Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, 'Desa :  ' . $data['usaha']['almt_ush'] . ',  Kecamatan:  ' . $data['usaha']['kec_ush'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'f. No Telpon Kantor', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['telepon'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'g. Email', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['email_u'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'h. Tahun Operasi', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);

        $pdf->Cell(10, 6, $data['usaha']['tahun_opr'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'i. Jenis Dokumen Lingkungan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_dok'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(35, 6, 'j. Tahun Pengesahan Dokumen Lingkungan ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['tahun_sah'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'k. Luas Lahan Usaha / Kegiatan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['luas_lahan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'l. Jenis Produk', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_produk'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'm. Kapasitas Produksi', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['kapasitas'] . ' (ton/bln)', 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'n. Jenis Bahan Baku ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_bahan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'o. Penggunaan Bahan Baku', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['penggunaan'] . ' (ton/bln)', 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'p. Sumber Air Baku', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['sumber_air'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'q. Jumlah Karyawan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jml_karyawan'] . ' Orang', 0, 1);
        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '2. Perizinan Dan Non Perizinan Yang Dimiliki', 0, 1);
        $pdf->Ln(5);




        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 30, 40, 30, 30, 40));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Izin', 'Nomor Izin', 'Tgl. Terbit', 'Masa Berlaku', 'Keterangan'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['izin'] as $o) {

            $pdf->Row(array(
                $no,
                $o->j_izin,
                $o->nmr_izin,
                $o->tgl_terbit,
                $o->berlaku,
                $o->keterangan,
            ));

            $no++;
        }







        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Sarana Dan Prasarana Yang Dimiliki', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'a.  Bangunan (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['l_bangunan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'b.  Lahan Parkir (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['l_parkir'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'c.  Ruang Terbuka Hijau (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['ruang_hijau'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(25, 6, 'd.  Tempat Penyimpanan LB3 (m2)', 0, 0);
        $pdf->Cell(35);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['penyimpanan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'e.  Boiler', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);





        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 20, 25, 30, 30, 30, 25));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Nama Boiler', 'Kapasitas (Hp)', 'Bahan Bakar', 'Tinggi Cerobong', 'Bentuk Cerobong', 'Diameter Cerobong (m)', 'Waktu Operasi (jam)'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['boiler'] as $e) {

            $pdf->Row(array(
                $no,
                $e->nm_boiler,
                $e->kp_boiler,
                $e->b_bakar,
                $e->tinggi,
                $e->bentuk,
                $e->diameter,
                $e->w_opr
            ));

            $no++;
        }


        $pdf->SetFont('Arial', '', 10);

        $pdf->Ln(5);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'f.  Genset', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 40, 25, 25, 30));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Nama Genset', 'Kapasitas (KVA)', 'Bahan Bakar', 'Waktu Operasi (jam)'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['genset'] as $y) {

            $pdf->Row(array(
                $no,
                $y->nm_genset,
                $y->kp_genset,
                $y->bhn_bkrgent,
                $y->wkt_opr
            ));

            $no++;
        }



        $pdf->Output('I', 'bab1.pdf');
    }

    function print_profil_empat($id)
    {
        $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();
        $data['izin'] = $this->mod_izin->selectByUsahaId($id)->result();
        $data['sarana'] = $this->mod_sarana->selectByUsahaId($id)->row_array();
        $data['boiler'] = $this->mod_boiler->selectByUsahaId($id)->result();
        $data['genset'] = $this->mod_genset->selectByUsahaId($id)->result();
        $pdf = new PDF_MC_Table();


        // membuat halaman baru
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Legal');
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 

        $pdf->Cell(196, 7, 'LAPORAN PENGELOLAAN DAN PEMANTAUAN ', 0, 1, 'C');
        $pdf->Cell(196, 7, 'LINGKUNGAN / PERIZINAN LINGKUNGAN ', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(196, 7, $data['usaha']['nm_usaha'], 0, 1, 'C');
        $pdf->Cell(196, 7, 'PERIODE BULAN OKTOBER S/D DESEMBER 2019', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(196, 7, 'BAB 1. PENDAHULUAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Profil Usaha / Kegiatan', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'a. Nama Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['nm_usaha'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'b. Jenis Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, $data['usaha']['jenis'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'c. Nama Penanggung Jawab', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['owner'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'd. Alamat Kantor', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, 'Desa :  ' . $data['usaha']['almt_ktr'] . ',  Kecamatan:  ' . $data['usaha']['kec_ktr'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'e. Lokasi Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(20, 6, 'Desa :  ' . $data['usaha']['almt_ush'] . ',  Kecamatan:  ' . $data['usaha']['kec_ush'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'f. No Telpon Kantor', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['telepon'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'g. Email', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['email_u'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'h. Tahun Operasi', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);

        $pdf->Cell(10, 6, $data['usaha']['tahun_opr'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'i. Jenis Dokumen Lingkungan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_dok'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(35, 6, 'j. Tahun Pengesahan Dokumen Lingkungan ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['tahun_sah'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'k. Luas Lahan Usaha / Kegiatan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['luas_lahan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'l. Jenis Produk', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_produk'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'm. Kapasitas Produksi', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['kapasitas'] . ' (ton/bln)', 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'n. Jenis Bahan Baku ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jenis_bahan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'o. Penggunaan Bahan Baku', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['penggunaan'] . ' (ton/bln)', 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'p. Sumber Air Baku', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['sumber_air'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'q. Jumlah Karyawan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['jml_karyawan'] . ' Orang', 0, 1);
        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '2. Perizinan Dan Non Perizinan Yang Dimiliki', 0, 1);
        $pdf->Ln(5);




        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 30, 40, 30, 30, 40));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Jenis Izin', 'Nomor Izin', 'Tgl. Terbit', 'Masa Berlaku', 'Keterangan'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['izin'] as $o) {

            $pdf->Row(array(
                $no,
                $o->j_izin,
                $o->nmr_izin,
                $o->tgl_terbit,
                $o->berlaku,
                $o->keterangan,
            ));

            $no++;
        }







        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Sarana Dan Prasarana Yang Dimiliki', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'a.  Bangunan (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['l_bangunan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'b.  Lahan Parkir (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['l_parkir'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'c.  Ruang Terbuka Hijau (m2)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['ruang_hijau'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(25, 6, 'd.  Tempat Penyimpanan LB3 (m2)', 0, 0);
        $pdf->Cell(35);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['penyimpanan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'e.  Boiler', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);





        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 25, 20, 25, 30, 30, 30, 25));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Nama Boiler', 'Kapasitas (Hp)', 'Bahan Bakar', 'Tinggi Cerobong', 'Bentuk Cerobong', 'Diameter Cerobong (m)', 'Waktu Operasi (jam)'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['boiler'] as $e) {

            $pdf->Row(array(
                $no,
                $e->nm_boiler,
                $e->kp_boiler,
                $e->b_bakar,
                $e->tinggi,
                $e->bentuk,
                $e->diameter,
                $e->w_opr
            ));

            $no++;
        }


        $pdf->SetFont('Arial', '', 10);

        $pdf->Ln(5);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'f.  Genset', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 40, 25, 25, 30));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Nama Genset', 'Kapasitas (KVA)', 'Bahan Bakar', 'Waktu Operasi (jam)'
        ));
        $no = 1;
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['genset'] as $y) {

            $pdf->Row(array(
                $no,
                $y->nm_genset,
                $y->kp_genset,
                $y->bhn_bkrgent,
                $y->wkt_opr
            ));

            $no++;
        }



        $pdf->Output('I', 'bab1.pdf');
    }
    function sign($id)
    {
        $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();
        $pdf = new PDF_MC_Table();
        $pdf->AddPage('P', 'Legal');
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 

        $pdf->Cell(196, 7, 'BAB III. PENUTUP', 0, 1, 'C');
        $pdf->Ln(8);
        $pdf->SetFont('Arial', '', 10);
        $txt = "Demikian laporan Triwulan ini kami Sampaikan sebagai wujud peran serta kami dalam menyampaikan laporan pelaksanaan perizinan lingkungan sekaligus sebagai laporan pelaksanaan komitmen kami dalam pengelolaan dan pemantauan lingkungan hidup.";

        $pdf->MultiCell(196, 6, $txt, 0, 'J', 0, 0);
        $pdf->Cell(100, 6, 'Atas Perhatiannya kami ucapkan terima kasih.', 0, 1, 'L');
        $pdf->Ln(15);
        $pdf->SetX(90);
        $bln = date('M');
        $thn = date('Y');
        $nm = $data['usaha']['nm_usaha'];

        $pdf->Cell(100, 5, 'Gorontalo,                             ' . $thn, 0, 1, 'C');
        $pdf->SetX(90);
        $pdf->Cell(100, 5, 'Penanggung Jawab', 0, 1, 'C');
        $pdf->SetX(90);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(100, 5, $nm, 0, 1, 'C');
        $pdf->Ln(20);
        $pdf->SetX(90);
        $pdf->Cell(100, 5, '..........................', 0, 1, 'C');

        $pdf->Output('I', 'bab3.pdf');
    }

    function rekap()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['user_id'];
        $role = $data['user']['role_id'];
        if ($role == 4) {
            redirect('auth');
        } else if ($role == 1) {
            $data['usaha'] = $this->mod_pelptri->selectUsaha()->result_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/navbar', $data);
            $this->load->view('admin/template/sidebar', $data);
            $this->load->view('admin/c-laptri/r-view', $data);
            $this->load->view('admin/template/footer');
        }
    }
    function rekap_tri()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $role = $data['user']['role_id'];
        if ($role == 4) {
            redirect('auth');
        }
        $a = new Newpdf();
        $a->AliasNbPages();
        $a->AddPage('P', 'A4', 0);

        $a->SetFont('Arial', 'B', 8);
        $a->Cell(10, 10, 'No', 1, 0, 'C');
        $a->Cell(30, 10, 'Nama Usaha', 1, 0, 'C');
        $a->Cell(30, 10, 'Jenis', 1, 0, 'C');
        $a->Cell(50, 10, 'Alamat Kantor', 1, 0, 'C');
        $a->Cell(50, 10, 'Lokasi Usaha', 1, 0, 'C');
        $a->Cell(20, 10, 'Status', 1, 1, 'C');
        $no = 1;
        $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['record'] as $h) {
            if ($h->vlap == 0) {
                $x = "Draft";
            } elseif ($h->vlap == 1) {
                $x =  "Sudah";
            } else {
                $x = "Koreksi";
            }
            $a->SetFont('Arial', 'B', 8);
            $a->Cell(10, 10, $no, 1, 0, 'C');
            $a->Cell(30, 10, $h->nm_usaha, 1, 0, 'L');
            $a->Cell(30, 10, $h->jenis, 1, 0, 'C');
            $a->Cell(50, 10, $h->almt_ktr, 1, 0, 'C');
            $a->Cell(50, 10, $h->almt_ush, 1, 0, 'C');
            $a->Cell(20, 10, $x, 1, 1, 'C');
            $no++;
        }
        //footer
        /* $a->setY(-15);
               $a->setFont('Arial', '', 8);
               $a->Cell(0, 10, 'Page' . $a->PageNo() . '/{nb}', 0, 0, 'C');*/


        $a->Output();
    }
}
