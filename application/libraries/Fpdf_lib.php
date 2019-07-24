<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Fpdf_lib extends CI_Controller
{

    function __construct()
    {
        // parent::__construct();
        include_once APPPATH . '/third_party/FPDF/fpdf.php';
        $ci = &get_instance();
    }
}
