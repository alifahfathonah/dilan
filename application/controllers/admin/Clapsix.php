<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clapsix extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/mod_usaha');
        $this->load->model('admin/mod_pelpsix');
        $this->load->model('admin/mod_air');
        $this->load->model('admin/mod_limbah');
        $this->load->model('admin/mod_udara');
        $this->load->model('admin/mod_izin');
        $this->load->model('admin/mod_sarana');
        $this->load->model('admin/mod_boiler');
        $this->load->model('admin/mod_genset');
        $this->load->model('admin/mod_kelola');
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
            $data['usaha'] = $this->mod_pelpsix->selectByUsaha($user)->result_array();
        } else if ($role == 1) {
            $data['usaha'] = $this->mod_pelpsix->selectUsaha()->result_array();
        }

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/c-lapsix/view', $data);
        $this->load->view('admin/template/footer');
    }

    function print_satu($id)
    {
        $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();
        $data['air'] = $this->mod_air->selectByUsahaId($id)->result();
        $data['udara'] = $this->mod_udara->selectByUsahaId($id)->result();
        $data['limbahj'] = $this->mod_limbah->selectByUsahaIdj($id)->result();
        $data['limbahf'] = $this->mod_limbah->selectByUsahaIdf($id)->result();
        $data['limbahm'] = $this->mod_limbah->selectByUsahaIdm($id)->result();
        $data['limbaha'] = $this->mod_limbah->selectByUsahaIda($id)->result();
        $data['limbahme'] = $this->mod_limbah->selectByUsahaIdme($id)->result();
        $data['limbahjn'] = $this->mod_limbah->selectByUsahaIdjn($id)->result();
        $data['kelola'] = $this->mod_kelola->selectv_usaha($id)->result();
        $InterLigne = 7;
        $pdf = new PDF_MC_Table();
        // membuat halaman baru
        $pdf->AddPage('P', 'Legal');
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'BAB II PELAKSANAAN DAN EVALUASI', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Pengelolaan dan Pemantauan Lingkungan', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $txt = 'Kegiatan pengelolaan dan pemantauan lingkungan yang telah dilaksanakan selama periode pelaporan dapat dilihat pada tabel berikut:';
        $pdf->MultiCell(196, 6, $txt, 0, 'J', 0, 0);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(30, 40, 60, 60));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'Sumber Dampak',
            'Jenis Dampak', 'Pengelolaan Lingkungan Yang Telah Dilaksanakan', 'Pemantauan Lingkungan Yang Telah Dilaksanakan'
        ));
        $pdf->SetAligns(array('L', 'L', 'L', 'L'));
        $pdf->SetFont('Arial', '', 10);
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['kelola'] as $e) {
            $pantau = strip_tags($e->pantau);
            $pdf->Row(array(

                $e->sumber,
                $e->jenis,
                $e->kelola,
                $pantau


            ));
        }


        // kualitas air limbah
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '2. Hasil Pemantauan Kualitas Air Limbah', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pengujian kualitas air limbah periode semester I adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 30, 20, 18, 18, 18, 18, 18, 18, 18));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Lokasi Sampling', 'Parameter', 'Baku Mutu (mg/l)', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'
        ));
        $pdf->SetFont('Arial', '', 10);

        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['air'] as $h) {

            $pdf->Row(array(
                $no,
                $h->titik_smp,
                $h->parameter_a,
                $h->bk_mutu,
                $h->b1,
                $h->b2,
                $h->b3,
                $h->b4,
                $h->b5,
                $h->b6,

            ));

            $no++;
        }


        //kualitas udara

        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Hasil Pemantauan Kualitas Udara', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pengujian kualitas udara periode semester II adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 30, 20, 18, 18, 18, 18, 18, 18, 18));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Lokasi Sampling', 'Parameter', 'Baku Mutu', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni'
        ));
        $pdf->SetFont('Arial', '', 10);




        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['udara'] as $d) {
            $pdf->Row(array(
                $no,
                $d->lokasi_smp,
                $d->parameter_u,
                $d->bk_mutu,
                $d->b1,
                $d->b2,
                $d->b3,
                $d->b4,
                $d->b5,
                $d->b6

            ));
            $no++;
        }

        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '4. Pengelolaan Limbah B3', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data limbah B3 yang dihasilkan selama periode pelaporan adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
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

        foreach ($data['limbaha'] as $h) {

            $pdf->Row(array(
                $no,
                $h->jenis_b3,
                $h->jml_bfr,
                $h->jml_now,
                $h->ttl_now,
                $h->used,
                $h->give_3,
                $h->sisa
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

        foreach ($data['limbahme'] as $i) {

            $pdf->Row(array(
                $no,
                $i->jenis_b3,
                $i->jml_bfr,
                $i->jml_now,
                $i->ttl_now,
                $i->used,
                $i->give_3,
                $i->sisa
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

        foreach ($data['limbahjn'] as $j) {

            $pdf->Row(array(
                $no,
                $j->jenis_b3,
                $j->jml_bfr,
                $j->jml_now,
                $j->ttl_now,
                $j->used,
                $j->give_3,
                $j->sisa
            ));

            $no++;
        }
        $pdf->Output('I', 'lap-smI.pdf');
    }

    function print_dua($id)
    {
        $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();
        $data['air'] = $this->mod_air->selectByUsahaId($id)->result();
        $data['udara'] = $this->mod_udara->selectByUsahaId($id)->result();
        $data['limbahju'] = $this->mod_limbah->selectByUsahaIdju($id)->result();
        $data['limbahag'] = $this->mod_limbah->selectByUsahaIdag($id)->result();
        $data['limbahse'] = $this->mod_limbah->selectByUsahaIdse($id)->result();
        $data['limbahok'] = $this->mod_limbah->selectByUsahaIdok($id)->result();
        $data['limbahno'] = $this->mod_limbah->selectByUsahaIdno($id)->result();
        $data['limbahde'] = $this->mod_limbah->selectByUsahaIdde($id)->result();
        $data['kelola'] = $this->mod_kelola->selectv_usahax($id)->result();

        $pdf = new PDF_MC_Table();
        // membuat halaman baru
        $pdf->AddPage('P', 'Legal');
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'BAB II PELAKSANAAN DAN EVALUASI', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Pengelolaan dan Pemantauan Lingkungan', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $txt = 'Kegiatan pengelolaan dan pemantauan lingkungan yang telah dilaksanakan selama periode pelaporan dapat dilihat pada tabel berikut:';
        $pdf->MultiCell(196, 6, $txt, 0, 'J', 0, 0);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(26, 40, 50, 50, 30));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'Sumber Dampak',
            'Jenis Dampak', 'Pengelolaan Lingkungan Yang Telah Dilaksanakan', 'Pemantauan Lingkungan Yang Telah Dilaksanakan', 'Lampiran'
        ));
        $pdf->SetAligns(array('L', 'L', 'L', 'L', 'L'));
        $pdf->SetFont('Arial', '', 10);
        //$data['limbahj'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['kelola'] as $e) {
            $pantau = strip_tags($e->pantau);
            $pdf->Row(array(

                $e->sumber,
                $e->jenis,
                $e->kelola,
                $pantau,
                $e->file

            ));
        }

        // kualitas air limbah
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 30, 20, 18, 18, 18, 18, 18, 18, 18));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Lokasi Sampling', 'Parameter', 'Baku Mutu (mg/l)', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ));
        $pdf->SetFont('Arial', '', 10);

        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['air'] as $h) {

            $pdf->Row(array(
                $no,
                $h->titik_smp,
                $h->parameter_a,
                $h->bk_mutu,
                $h->b7,
                $h->b8,
                $h->b9,
                $h->b10,
                $h->b11,
                $h->b12,

            ));

            $no++;
        }


        // kualitas udara
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Hasil Pemantauan Kualitas Udara', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pengujian kualitas udara periode pelaporan adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths(array(10, 30, 20, 18, 18, 18, 18, 18, 18, 18));
        $pdf->SetLineHeight(5);
        $pdf->Row(array(
            'No',
            'Lokasi Sampling', 'Parameter', 'Baku Mutu', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni'
        ));
        $pdf->SetFont('Arial', '', 10);




        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['udara'] as $d) {
            $pdf->Row(array(
                $no,
                $d->lokasi_smp,
                $d->parameter_u,
                $d->bk_mutu,
                $d->b1,
                $d->b2,
                $d->b3,
                $d->b4,
                $d->b5,
                $d->b6

            ));
            $no++;
        }



        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '4. Pengelolaan Limbah B3', 0, 1);
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

        foreach ($data['limbahok'] as $h) {

            $pdf->Row(array(
                $no,
                $h->jenis_b3,
                $h->jml_bfr,
                $h->jml_now,
                $h->ttl_now,
                $h->used,
                $h->give_3,
                $h->sisa
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

        foreach ($data['limbahno'] as $i) {

            $pdf->Row(array(
                $no,
                $i->jenis_b3,
                $i->jml_bfr,
                $i->jml_now,
                $i->ttl_now,
                $i->used,
                $i->give_3,
                $i->sisa
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

        foreach ($data['limbahde'] as $j) {

            $pdf->Row(array(
                $no,
                $j->jenis_b3,
                $j->jml_bfr,
                $j->jml_now,
                $j->ttl_now,
                $j->used,
                $j->give_3,
                $j->sisa
            ));

            $no++;
        }
        $pdf->Output('I', 'lap-smII.pdf');
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
        $txt = "Demikian laporan Semester ini kami sampaikan sebagai wujud peran serta kami dalam menyampaikan laporan pelaksanaan perizinan lingkungan sekaligus sebagai laporan pelaksanaan komitmen kami dalam pengelolaan dan pemantauan lingkungan hidup.";
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

        $pdf->Output('I', 'babIII.pdf');
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
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(196, 7, $data['usaha']['nm_usaha'], 0, 1, 'C');
        $pdf->Cell(196, 7, 'PERIODE BULAN JANUARI S/D JUNI 2019', 0, 1, 'C');
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
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(196, 7, $data['usaha']['nm_usaha'], 0, 1, 'C');
        $pdf->Cell(196, 7, 'PERIODE BULAN JULI S/D DESEMBER 2019', 0, 1, 'C');
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
}
