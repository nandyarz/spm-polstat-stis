<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katalog extends CI_Controller
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model('dashboard_model', 'dashboard');
    // }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('galery_model', 'galery');
        $this->load->model('pengajuan_track_model', 'pengajuan_track');
        $this->load->model('Unit_Model', 'unit');

        $this->load->helper(array('form', 'url', 'Cookie', 'String'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $judul = [
            'title' => 'Katalog SOP',
            'sub_title' => 'SOP'
        ];

        $data['data'] = $this->db->get('sop_selesai')->result_array();

        $this->load->view('frontend/header2', $judul);
        $this->load->view('frontend/katalog', $data);
        $this->load->view('frontend/footer2');
    }
}