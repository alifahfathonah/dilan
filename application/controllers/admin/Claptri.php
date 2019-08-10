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
            // $data['air'] = $this->mod_air->selectByUsahaId($user)->result_array();
            //$data['udara'] = $this->mod_udara->selectByUsahaId($user)->result_array();
            //$data['limbah'] = $this->mod_limbah->selectByUsahaId($user)->result_array();
        } else if ($role == 1) {
            $data['usaha'] = $this->mod_pelptri->selectByUsaha($user)->result_array();
            // $data['air'] = $this->mod_air->selectUsaha()->result_array();
            //$data['udara'] = $this->mod_udara->selectUsaha()->result_array();
            // $data['limbah'] = $this->mod_limbah->selectUsaha()->result_array();
        }

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/navbar', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/c-laptri/view', $data);
        $this->load->view('admin/template/footer');
    }

    function MultiCell($w, $h, $txt, $border = 0, $align = 'J', $fill = false, $indent = 0)
    {
        //Output text with automatic or explicit line breaks
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;

        $wFirst = $w - $indent;
        $wOther = $w;

        $wmaxFirst = ($wFirst - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $wmaxOther = ($wOther - 2 * $this->cMargin) * 1000 / $this->FontSize;

        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        $b = 0;
        if ($border) {
            if ($border == 1) {
                $border = 'LTRB';
                $b = 'LRT';
                $b2 = 'LR';
            } else {
                $b2 = '';
                if (is_int(strpos($border, 'L')))
                    $b2 .= 'L';
                if (is_int(strpos($border, 'R')))
                    $b2 .= 'R';
                $b = is_int(strpos($border, 'T')) ? $b2 . 'T' : $b2;
            }
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $ns = 0;
        $nl = 1;
        $first = true;
        while ($i < $nb) {
            //Get next character
            $c = $s[$i];
            if ($c == "\n") {
                //Explicit line break
                if ($this->ws > 0) {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                $this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
                $nl++;
                if ($border && $nl == 2)
                    $b = $b2;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
                $ls = $l;
                $ns++;
            }
            $l += $cw[$c];

            if ($first) {
                $wmax = $wmaxFirst;
                $w = $wFirst;
            } else {
                $wmax = $wmaxOther;
                $w = $wOther;
            }

            if ($l > $wmax) {
                //Automatic line break
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                    if ($this->ws > 0) {
                        $this->ws = 0;
                        $this->_out('0 Tw');
                    }
                    $SaveX = $this->x;
                    if ($first && $indent > 0) {
                        $this->SetX($this->x + $indent);
                        $first = false;
                    }
                    $this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
                    $this->SetX($SaveX);
                } else {
                    if ($align == 'J') {
                        $this->ws = ($ns > 1) ? ($wmax - $ls) / 1000 * $this->FontSize / ($ns - 1) : 0;
                        $this->_out(sprintf('%.3f Tw', $this->ws * $this->k));
                    }
                    $SaveX = $this->x;
                    if ($first && $indent > 0) {
                        $this->SetX($this->x + $indent);
                        $first = false;
                    }
                    $this->Cell($w, $h, substr($s, $j, $sep - $j), $b, 2, $align, $fill);
                    $this->SetX($SaveX);
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
                $nl++;
                if ($border && $nl == 2)
                    $b = $b2;
            } else
                $i++;
        }
        //Last chunk
        if ($this->ws > 0) {
            $this->ws = 0;
            $this->_out('0 Tw');
        }
        if ($border && is_int(strpos($border, 'B')))
            $b .= 'B';
        $this->Cell($w, $h, substr($s, $j, $i), $b, 2, $align, $fill);
        $this->x = $this->lMargin;
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
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'BAB II PEMANTAUAN KUALITAS LINGKUNGAN', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(196, 7, 'PEMANTAUAN KUALITAS AIR DAN PENGELOLAAN LIMBAH ', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


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

        $pdf->Output();
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
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'BAB II PEMANTAUAN KUALITAS LINGKUNGAN', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(196, 7, 'PEMANTAUAN KUALITAS AIR DAN PENGELOLAAN LIMBAH ', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '1. Hasil Pemantauan Kualitas Air Limbah', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data hasil pemantauan kualitas air limbah periode April s/d Juni 2019 adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);
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

        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Pengelolaan Limbah B3', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data limbah B3 yang dihasilkan selama periode pelaporan adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
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
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, '3. Pengelolaan Limbah B3', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, 'Data limbah B3 yang dihasilkan selama periode pelaporan adalah sebagai berikut :', 0, 1);
        $pdf->Ln(5);
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






        $pdf->Output();
    }

    function print_tiga($id)
    {
        $data['usaha'] = $this->mod_pelptri->selectByUsahaId($id)->row_array();

        $InterLigne = 7;
        $pdf = new FPDF();
        // membuat halaman baru
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'LAPORAN TRIWULAN ', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(196, 7, 'PEMANTAUAN KUALITAS AIR DAN PENGELOLAAN LIMBAH ', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'Nama Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['nm_usaha'], 0, 1);
        $pdf->Cell(10, 6, 'Nama Penanggung Jawab', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['owner'], 0, 1);
        $pdf->Cell(10, 6, 'periode', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['periode'] . '  ,' . $data['usaha']['tahun'], 0, 1);
        $pdf->Cell(10, 6, 'Alamat Kantor ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['almt_ktr'] . ' ' . '(' . $data['usaha']['kec_ktr'] . ')', 0, 1);
        $pdf->Ln(15);

        $pdf->Cell(10, 6, 'HASIL PEMANTAUAN KUALITAS AIR DAN PENGELOLAAN LIMBAH', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, '- Tgl Pemantauan ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['tgl_pantau'], 0, 1);
        $pdf->Cell(10, 6, '- Parameter Yang Dipantau', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['parameter'], 0, 1);
        $pdf->Cell(10, 6, '- Baku Mutu (mg/liter)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['b_mutu'], 0, 1);
        $pdf->Cell(10, 6, '- Hasil Pemantauan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['h_pantau'], 0, 1);
        $pdf->Cell(10, 6, '- Pemantauan PH ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['PH'], 0, 1);

        /*$pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 12);
        $txt = $data['usaha']['telepon'];
        $pdf->Cell(196, 7, $txt, 0, 1, 'C');
        /* $pdf->ln(3);
        $pdf->SetFont('Arial', '', 10);
        $txt = $data['aduan']['keterangan'];
        $pdf->MultiCell(0, $InterLigne, $txt, 0, 'L', 0, 15);*/




        $pdf->Output();
    }

    function print_empat($id)
    {
        $data['usaha'] = $this->mod_pelptri->selectByUsahaId($id)->row_array();

        $InterLigne = 7;
        $pdf = new FPDF();
        // membuat halaman baru
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'LAPORAN TRIWULAN ', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(196, 7, 'PEMANTAUAN KUALITAS AIR DAN PENGELOLAAN LIMBAH ', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'Nama Usaha', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['nm_usaha'], 0, 1);
        $pdf->Cell(10, 6, 'Nama Penanggung Jawab', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['owner'], 0, 1);
        $pdf->Cell(10, 6, 'periode', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['periode'] . '  ,' . $data['usaha']['tahun'], 0, 1);
        $pdf->Cell(10, 6, 'Alamat Kantor ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['almt_ktr'] . ' ' . '(' . $data['usaha']['kec_ktr'] . ')', 0, 1);
        $pdf->Ln(15);

        $pdf->Cell(10, 6, 'HASIL PEMANTAUAN KUALITAS AIR DAN PENGELOLAAN LIMBAH', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 6, '- Tgl Pemantauan ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['tgl_pantau'], 0, 1);
        $pdf->Cell(10, 6, '- Parameter Yang Dipantau', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['parameter'], 0, 1);
        $pdf->Cell(10, 6, '- Baku Mutu (mg/liter)', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['b_mutu'], 0, 1);
        $pdf->Cell(10, 6, '- Hasil Pemantauan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['h_pantau'], 0, 1);
        $pdf->Cell(10, 6, '- Pemantauan PH ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['usaha']['PH'], 0, 1);

        /*$pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 12);
        $txt = $data['usaha']['telepon'];
        $pdf->Cell(196, 7, $txt, 0, 1, 'C');
        /* $pdf->ln(3);
        $pdf->SetFont('Arial', '', 10);
        $txt = $data['aduan']['keterangan'];
        $pdf->MultiCell(0, $InterLigne, $txt, 0, 'L', 0, 15);*/




        $pdf->Output();
    }

    function print_profil($id)
    {
        $data['usaha'] = $this->mod_usaha->selectById($id)->row_array();
        $data['izin'] = $this->mod_izin->selectByUsahaId($id)->result();
        $data['sarana'] = $this->mod_sarana->selectByUsahaId($id)->row_array();
        $data['boiler'] = $this->mod_boiler->selectByUsahaId($id)->result();
        $data['genset'] = $this->mod_genset->selectByUsahaId($id)->result();
        $pdf = new Mypdf();


        // membuat halaman baru
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Legal');
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string 

        $pdf->Cell(196, 7, 'LAPORAN PENGELOLAAN DAN PEMANTAUAN ', 0, 1, 'C');
        $pdf->Cell(196, 7, 'LINGKUNGAN / PERIZINAN LINGKUNGAN ', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(196, 7, $data['usaha']['nm_usaha'], 0, 1, 'C');
        $pdf->Cell(196, 7, 'PERIODE BULAN JANUARI S/D MARET 2019', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(196, 7, 'BAB 1. PENDAHULUAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Ln(5);
        $pdf->Cell(10, 6, '1. Profil Usaha / Kegiatan', 0, 1);
        $pdf->SetFont('Arial', '', 12);
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
        $pdf->Cell(45, 6, 'j. Tahun Pengesahan Dokumen Lingkungan ', 0, 0);
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
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 6, '2. Perizinan Dan Non Perizinan Yang Dimiliki', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Jenis Izin', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nomor Izin', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Tgl. Terbit', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Masa Berlaku', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Keterangan', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['izin'] as $h) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->j_izin, 1, 0, 'L');
            $pdf->Cell(40, 10, $h->nmr_izin, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->tgl_terbit, 1, 0, 'C');
            $pdf->Cell(30, 10, $h->berlaku, 1, 0, 'C');
            $pdf->Cell(40, 10, $h->keterangan, 1, 1, 'L');
            $no++;
        }
        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 6, '3. Sarana Dan Prasarana Yang Dimiliki', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 12);
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
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['sarana']['penyimpanan'], 0, 1);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'e.  Boiler', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 9);



        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Nama Boiler', 1, 0, 'C');
        $pdf->CellFitScale(20, 10, 'Kapasitas (Hp)', 1, 0, '');
        $pdf->CellFitScale(25, 10, 'Bahan Bakar', 1, 0, '');
        $pdf->CellFitScale(30, 10, 'Tinggi Cerobong (m)', 1, 0, '');
        $pdf->CellFitScale(30, 10, 'Bentuk Cerobong', 1, 0, '');
        $pdf->CellFitScale(30, 10, 'Diameter Cerobong (m)', 1, 0, 'C');
        $pdf->CellFitScale(25, 10, 'Waktu Operasi (jam)', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['boiler'] as $j) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(25, 10, $j->nm_boiler, 1, 0, 'L');
            $pdf->Cell(20, 10, $j->kp_boiler, 1, 0, 'C');
            $pdf->Cell(25, 10, $j->b_bakar, 1, 0, 'C');
            $pdf->Cell(30, 10, $j->tinggi, 1, 0, 'C');
            $pdf->Cell(30, 10, $j->bentuk, 1, 0, 'C');
            $pdf->Cell(30, 10, $j->diameter, 1, 0, 'C');
            $pdf->Cell(25, 10, $j->w_opr, 1, 1, 'C');
            $no++;
        }
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(5);
        $pdf->Cell(20, 6, 'f.  Genset', 0, 1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nama Genset', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Kapasitas (KVA)', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Bahan Bakar', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Waktu Operasi (jam)', 1, 1, 'C');
        $no = 1;
        // $data['record'] = $this->mod_pelptri->selectUsaha()->result();
        foreach ($data['genset'] as $k) {

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(40, 10, $k->nm_genset, 1, 0, 'L');
            $pdf->Cell(25, 10, $k->kp_genset, 1, 0, 'C');
            $pdf->Cell(25, 10, $k->bhn_bkrgent, 1, 0, 'C');
            $pdf->Cell(30, 10, $k->wkt_opr, 1, 1, 'L');
            $no++;
        }
        $pdf->Output();
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
