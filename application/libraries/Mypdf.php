<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mypdf extends FPDF
{
    function __construct()
    {
        parent::__construct();
    }

    function header()
    {

        // $a->header();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(196, 5, 'DATA ADUAN MASYARAKAT', 0, 0, 'C');
        $this->ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(196, 10, 'Dinas Lingkungan Hidup', 0, 0, 'C');
        $this->ln(30);
    }
    function footer()
    {
        //footer
        $this->setY(-15);
        $this->setFont('Arial', '', 8);
        $this->Cell(0, 10, 'Page' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
