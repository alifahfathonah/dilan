<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Newpdf extends FPDF
{
    function __construct()
    {
        parent::__construct();
    }

    function header()
    {

        // $a->header();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(196, 5, 'REKAP LAPORAN TRIWUAN ', 0, 0, 'C');
        $this->ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(196, 10, 'IZIN USAHA DAN PENGELOLAAN LINGKUNGAN USAHA', 0, 0, 'C');
        $this->ln(30);
    }
    function footer()
    {
        //footer
        $this->setY(-15);
        $this->setFont('Arial', '', 8);
        $this->Cell(0, 10, 'Page' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function WordWrap(&$text, $maxwidth)
    {
        $text = trim($text);
        if ($text === '')
            return 0;
        $space = $this->GetStringWidth(' ');
        $lines = explode("\n", $text);
        $text = '';
        $count = 0;

        foreach ($lines as $line) {
            $words = preg_split('/ +/', $line);
            $width = 0;

            foreach ($words as $word) {
                $wordwidth = $this->GetStringWidth($word);
                if ($wordwidth > $maxwidth) {
                    // Word is too long, we cut it
                    for ($i = 0; $i < strlen($word); $i++) {
                        $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                        if ($width + $wordwidth <= $maxwidth) {
                            $width += $wordwidth;
                            $text .= substr($word, $i, 1);
                        } else {
                            $width = $wordwidth;
                            $text = rtrim($text) . "\n" . substr($word, $i, 1);
                            $count++;
                        }
                    }
                } elseif ($width + $wordwidth <= $maxwidth) {
                    $width += $wordwidth + $space;
                    $text .= $word . ' ';
                } else {
                    $width = $wordwidth + $space;
                    $text = rtrim($text) . "\n" . $word . ' ';
                    $count++;
                }
            }
            $text = rtrim($text) . "\n";
            $count++;
        }
        $text = rtrim($text);
        return $count;
    }
}
