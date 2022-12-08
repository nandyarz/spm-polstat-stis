<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('galery_model','galery');
        $this->load->model('pengajuan_track_model','pengajuan_track');

        $this->load->helper(array('form', 'url','Cookie', 'String'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        // $data = $this->dashboard->user();
        $data['profil'] = $this->galery->profil();
        $judul = [
            'title' => 'Tracking',
            'sub_title' => ''
        ];

        // $data['sm'] = $this->db->get('surat_masuk')->row_array();
        // var_dump($data);
        $this->load->view('templates/header', $judul);
        $this->load->view('sop/tracking',$data);
        $this->load->view('templates/footer');
    }

    public function cari()
    {

        $id = $this->input->post('trackid',TRUE);
        $row = $this->pengajuan_track->findById($id);

        $data = [ 
            'id' => $id,
            'row' => $row
        ];

        // var_dump($row);
        // die;

        if ($row === null) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-bank"></i> Maaf!</h5> ID yang anda masukkan Salah! <b>ID: </b><b>'.$id.'</b> <i>tidak ditemukan</i></div>');
            redirect(base_url("tracking"));
        }else {
            redirect(base_url("tracking/tracked/").$id);
        }

    }

    public function tracked()
    {
        $id = $this->uri->segment(3);
        $data['row'] = $this->pengajuan_track->showById($id);
        $data['options'] = [
            'SKP' => 'Subbagian Kepegawaian',
            'SKU' => 'Subbagian Keuangan',
            'STU' => 'Subbagian Tata Usaha dan Rumah Tangga',
            'SAAK' => 'Subbagian Administrasi Akademik dan Kerjasama',
            'SAK' => 'Subbagian Administrasi Kemahasiswaan',
            'D3' => 'Program  Studi D3 Statistika',
            'D4' => 'Program  Studi D4 Statistika',
            'D4S' => 'Program  Studi D4 Komputasi Statistika',
            'UKSN' => 'Unit Kajian Statistik Nasional',
            'UKSE' => 'Unit Kajian Statistik Ekonomi',
            'UKMS' => 'Unit Kajian Metodologi Statistik',
            'UKKS' => 'Unit Kajian Komputasi Statistik',
            'KPM' => 'Koordinator PKL Mahasiswa',
            'KJI' => 'Koordinator Jurnal Mahasiswa',
            'UTI' => 'Unit Teknologi Informasi',
            'UP' => 'Unit Perpustakaan',
        ];
        $judul = [
            'title' => 'Tracking',
            'sub_title' => ''
        ];


        // $data['sm'] = $this->db->get('surat_masuk')->row_array();
        // var_dump($data);
        $this->load->view('templates/header', $judul);
        $this->load->view('sop/result',$data);
        $this->load->view('templates/footer');
    }

}
