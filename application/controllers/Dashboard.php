<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model', 'dashboard');
        if ($this->session->userdata('id_user') == FALSE) {
            redirect(base_url("auth/login"));
        }
    }

    public function index()
    {
        $judul = [
            'title' => 'Dashboard',
            'sub_title' => ''
        ];

        $this->load->view('templates/header', $judul);
        $this->load->view('dashboard/index');
        $this->load->view('templates/footer');
    }
}
