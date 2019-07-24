<?php

use PHPMailer\PHPMailer\PHPMailer;

defined('BASEPATH') or exit('No direct script access allowed');

class Phpmailer_lib
{

    function __construct()
    {
        log_message('debug', 'Phpmailer is loaded');
    }

    public function load()
    {
        require_once APPPATH . 'third_party/PHPMailer/Exception.php';
        require_once APPPATH . 'third_party/PHPMailer/OAuth.php';
        require_once APPPATH . 'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH . 'third_party/PHPMailer/POP3.php';
        require_once APPPATH . 'third_party/PHPMailer/SMTP.php';

        $mail = new PHPMailer();
        return $mail;
    }
}
