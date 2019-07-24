<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Lap_a extends CI_Controller
{



    function __construct()
    {
        parent::__construct();
        $this->load->library('fpdf_lib');
        $this->load->model('admin/mod_aduan');
        include_once APPPATH . 'libraries/Mypdf.php';
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



    function aduan($id)
    {

        $data['aduan'] = $this->mod_aduan->select_lap($id)->row_array();

        $InterLigne = 7;
        $pdf = new FPDF();
        // membuat halaman baru
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Ln(10);
        $pdf->Cell(196, 7, 'DATA ADUAN MASYARAKAT ', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(196, 7, 'DINAS LINGKUNGAN HIDUP ', 0, 1, 'C');
        $pdf->Cell(196, 1, '', 0, 1, 'C', true);


        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Ln(5);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NAMA PELAPOR', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['aduan']['nama'], 0, 1);
        $pdf->Cell(10, 6, 'Tanggal Aduan', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['aduan']['tgl_aduan'], 0, 1);
        $pdf->Cell(10, 6, 'Kontak', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['aduan']['email'] . '  ,' . $data['aduan']['no_hp'], 0, 1);
        $pdf->Cell(10, 6, 'Tempat Aduan ', 0, 0);
        $pdf->Cell(40);
        $pdf->Cell(2, 6, ':', 0, 0);
        $pdf->Cell(10, 6, $data['aduan']['alamat_aduan'] . ' ' . '(' . $data['aduan']['nama_kec'] . ')', 0, 1);
        $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 12);
        $txt = $data['aduan']['judul'];
        $pdf->Cell(196, 7, $txt, 0, 1, 'C');
        $pdf->ln(3);
        $pdf->SetFont('Arial', '', 10);
        $txt = $data['aduan']['keterangan'];
        $pdf->MultiCell(0, $InterLigne, $txt, 0, 'L', 0, 15);




        $pdf->Output();
    }


    function aduanAll()
    {
        $a = new Mypdf();
        $a->AliasNbPages();
        $a->AddPage('P', 'A4', 0);
        // $a->header();
        /* $a->SetFont('Arial', 'B', 10);
       $a->Cell(196, 5, 'DATA ADUAN MASYARAKAT', 0, 0, 'C');
       $a->ln();
       $a->SetFont('Times', '', 12);
       $a->Cell(196, 10, 'Dinas Lingkungan Hidup', 0, 0, 'C');
       $a->ln(30);*/

        //body
        $a->SetFont('Arial', 'B', 8);
        $a->Cell(10, 10, 'NO', 1, 0, 'C');
        $a->Cell(80, 10, 'JUDUL', 1, 0, 'C');
        $a->Cell(30, 10, 'KECAMATAN', 1, 0, 'C');
        $a->Cell(40, 10, 'TANGGAL ADUAN', 1, 0, 'C');
        $a->Cell(30, 10, 'STATUS', 1, 1, 'C');
        $no = 1;
        $data['record'] = $this->mod_aduan->select_all()->result();
        foreach ($data['record'] as $h) {
            $a->SetFont('Arial', 'B', 8);
            $a->Cell(10, 10, $no, 1, 0, 'C');
            $a->Cell(80, 10, $h->judul, 1, 0, 'L');
            $a->Cell(30, 10, $h->nama_kec, 1, 0, 'C');
            $a->Cell(40, 10, $h->tgl_aduan, 1, 0, 'C');
            $a->Cell(30, 10, $h->status, 1, 1, 'C');
            $no++;
        }
        //footer
        /* $a->setY(-15);
               $a->setFont('Arial', '', 8);
               $a->Cell(0, 10, 'Page' . $a->PageNo() . '/{nb}', 0, 0, 'C');*/


        $a->Output();
    }
}
