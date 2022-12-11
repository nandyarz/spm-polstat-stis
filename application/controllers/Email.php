<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->helper('url');
        error_reporting(0);

    }

    public function index() {
        $judul = [
            'title' => 'Halaman Email',
            'sub_title' => 'Email'
        ];
        
        $this->load->view('templates/header', $judul);
        $this->load->view('templates/email');
        $this->load->view('templates/footer');
    }

    public function sendMail()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');

        if($this->form_validation->run()) {
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $pesan = $this->input->post('pesan');

            if(!empty($email)){
                // configuration to email & process
                $config = Array(
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'protocol' => 'smtp',
                    'crlf' => "rn",
                    'mewline' => "rn",
                    'smtp_host' => 'smtp.googlemail.com',
                    'smtp_user' => 'nandyarzutami@gmail.com',
                    'smtp_pass' => 'rrzbtgftrcclcmkq',
                    'smtp_port' => 465,
                    'smtp_crypto' => 'ssl',
                    'smtp_timeout' => 5

                );

                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->initialize($config);

                // end config

                $this->email->from('emailfrom');
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($pesan);

                if($this->email->send()){
                    echo "email berhasil";
                } else{
                    show_error($this->email->print_debugger());
                }
            }
        }
    }
}