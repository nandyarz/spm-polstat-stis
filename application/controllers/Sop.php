<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sop extends CI_Controller
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model('dashboard_model', 'dashboard');
    // }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengajuan_track_model', 'pengajuan_track');
        $this->load->model('Unit_Model', 'unit');

        $this->load->helper(array('form', 'url', 'Cookie', 'String'));
        $this->load->library('form_validation');
        error_reporting(0);
        // $this->load->library('./controllers/email');
    }

    public function index()
    {
        $judul = [
            'title' => 'Manajemen SOP',
            'sub_title' => 'SOP'
        ];

        $data['status'] = [
            1 => 'Pending',
            2 => 'Syarat Tidak Terpenuhi',
            3 => 'Diterima dan Dilanjutkan',
            4 => 'Divalidasi',
            5 => 'Valid/<b>Selesai</b>',
        ];

        $data['data'] = $this->db->get('pengajuan_sop')->result_array();

        $this->load->view('templates/header', $judul);
        $this->load->view('sop/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $this->form_validation->set_rules('nama_sop', 'Nama SOP', 'required');
        $this->form_validation->set_rules('tempat_sop', 'Tempat SOP', 'required');
        $this->form_validation->set_rules('tanggal_sop', 'Tanggal SOP', 'required');
        $this->form_validation->set_rules('unit_sop', 'Unit', 'required');
        $this->form_validation->set_rules('file', 'File', 'required');

        if ($this->form_validation->run() == FALSE) {
            $judul = [
                'title' => 'Manajemen SOP',
                'sub_title' => 'SOP'
            ];

            $data['unit_sop'] = [
                'Pilih',
                'Bagian Umum:' => [
                    'SKP' => 'Subbagian Kepegawaian',
                    'SKU' => 'Subbagian Keuangan',
                    'STU' => 'Subbagian Tata Usaha dan Rumah Tangga',
                ],
                'Bagian Admininstrasi Akademik dan Kemahasiswaan:' => [
                    'SAAK' => 'Subbagian Administrasi Akademik dan Kerjasama',
                    'SAK' => 'Subbagian Administrasi Kemahasiswaan',
                ],
                'Pejabat Fungsional:' => [
                    'D3' => 'Program  Studi D3 Statistika',
                    'D4' => 'Program  Studi D4 Statistika',
                    'D4S' => 'Program  Studi D4 Komputasi Statistika',
                ],
                'Pusat Penelitian dan Pengabdian kepada Masyarakat:' => [
                    'UKSN' => 'Unit Kajian Statistik Nasional',
                    'UKSE' => 'Unit Kajian Statistik Ekonomi',
                    'UKMS' => 'Unit Kajian Metodologi Statistik',
                    'UKKS' => 'Unit Kajian Komputasi Statistik',
                    'KPM' => 'Koordinator PKL Mahasiswa',
                    'KJI' => 'Koordinator Jurnal Mahasiswa',
                ],
                'Unit Lain:' => [
                    'UTI' => 'Unit Teknologi Informasi',
                    'UP' => 'Unit Perpustakaan',
                ],
            ];

            $this->load->view('templates/header', $judul);
            $this->load->view('sop/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_sop = $this->input->post("nama_sop", TRUE);
            $tempat_sop = $this->input->post("tempat_sop", TRUE);
            $tanggal_sop = $this->input->post("tanggal_sop", TRUE);
            $unit_sop = $this->input->post("unit_sop", TRUE);
            $dateNow = date('Y-m-d');
            $file =  $this->input->post("file", TRUE);

            $config['upload_path'] = './uploads/berkas';
            $config['allowed_types'] = 'pdf|doc|docx';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {

                $data = array('upload_data' => $this->upload->data());
                $file = $data['upload_data']['file_name'];
                

                $save = [
                    'nama_sop' => $nama_sop,
                    'tempat_sop' => $tempat_sop,
                    'tanggal_sop' => date('Y-m-d', strtotime($tanggal_sop)),
                    'unit_sop' => $unit_sop,
                    'file' => $file,
                    'tanggal_upload' => date('Y-m-d', strtotime($dateNow))
                ];

                $this->db->insert('pengajuan_sop', $save);
                $this->session->set_flashdata('success', 'Berhasil Ditambahkan!');


                
                redirect(base_url("sop"));
            }
        }
    }

    public function ajukan()
    {
        $status = [
            1 => 1,
            // Pending
            2 => 2,
            // Diterima dan Dilanjutkan
            3 => 3,
            // Sudah Diketik dan Diparaf
            4 => 4, // Sudah Ditandatangani Lurah dan Selesai

        ];

        $nama_sop = $this->input->post('nama_sop', TRUE);
        $tempat_sop = $this->input->post('tempat_sop', TRUE);
        $tanggal_sop = $this->input->post('tanggal_sop', TRUE);
        $unit_sop = $this->input->post('unit_sop', TRUE);

        $cekid = $this->unit->cek_unit($unit_sop)->num_rows();
        $dateNow = date('Y-m-d');

        if ($cekid <= 0) {
            $save = [
                'nama_sop' => $nama_sop,
                'tempat_sop' => $tempat_sop,
                'tanggal_sop' => $tanggal_sop,
                'unit_sop' => $unit_sop,
                'tanggal_upload' => date('Y-m-d', strtotime($dateNow))
            ];

            $this->db->insert('unit', $save);
            // $this->session->set_flashdata('success', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-cross"></i> Maaf!</h5> NIK Anda tidak Terdaftar!</div>');
            // redirect(base_url("suratonline"));
        }

        //Output a v4 UUID 
        $rid = uniqid($unit_sop, TRUE);
        $rid2 = str_replace('.', '', $rid);
        $rid3 = substr(str_shuffle($rid2), 0, 3);

        $cc = $this->db->count_all('pengajuan_sop') + 1;
        $count = str_pad($cc, 3, STR_PAD_LEFT);
        $id = $unit_sop . "-";
        $d = date('d');
        $y = date('y');
        $mnth = date("m");
        $s = date('s');
        $randomize = $d + $y + $mnth + $s;
        $id = $id . $rid3 . $randomize . $count . $y;

        // var_dump($id);
        // die;

        if ($_FILES['file']['size'] >= 5242880) {
            $this->session->set_flashdata('success', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-ban"></i> MAAF!</h5> File Lebih 2MB!</div>');
            redirect(base_url("sop"));
        }

        
            $namafile = substr($_FILES['file']['name'], -7);
            $file = $unit_sop . uniqid() . $namafile;
            $config['upload_path'] = './uploads/berkas';
            $config['allowed_types'] = '*';
            $config['max_size'] = 5120; // 5MB
            $config['file_name'] = $file;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("file")) {
                $data = array('upload_data' => $this->upload->data());
                $berkas = $data['upload_data']['file_name'];
            }
        

        $data = [
            'id' => $id,
            // 'nama' => $nama,
            // 'no_hp' => $no_hp,
            'nama_sop' => $nama_sop,
            'tempat_sop' => $tempat_sop,
            'tanggal_sop' => $tanggal_sop,
            'unit_sop' => $unit_sop,
            'file' => $file,
            'status' => $status[1],
            'tanggal_upload' => date('Y-m-d', strtotime($dateNow))
        ];

        // var_dump($data);
        // die;

        
        $this->pengajuan_track->insert_sop($data);

        $pSop = $this->db->get_where('pengajuan_sop', ['id' => $id])->row_array();
        $pUnit = $this->db->get_where('unit', ['id_unit' => $pSop['unit_sop']])->row_array();
        
        $admin = $this->db->get_where('user', ['username' => 'admin'])->row_array();
        $email = $admin['email'];

        if($email){
            $subjek = "Pengajuan SOP Baru dari: ".$pUnit['nama'];
            $pesan = "
            <html>
                <head>
                    <title>PENGAJUAN SOP</title>
                </head>
                <body>
                    <p>Berikut adalah pengajuan SOP baru: <br>
                    ID : ".$id."<br>
                    Nama SOP : ".$nama_sop."<br>
                    Tempat : ".$tempat_sop."<br>
                    Tanggal : ".$tanggal_sop."<br>
                    Unit : ".$pUnit['nama']."<br>
                    <br>
                    Cek link berikut:
                    <a href='https://222011485.student.stis.ac.id/sop/pengajuan'>Pengajuan SOP</a>
                    </p>
                </body>
            </html>
            ";

            $this->sendMail($email, $subjek, $pesan);
        }
        
        $this->db->get_where('pengajuan_sop', ['id' => $data['id']])->row_array();
        $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-check"></i> Selamat!</h5> Berhasil Mengajukan Surat! Berikut <b>ID</b> anda: <b>' . $id . '</b></div>');
        redirect(base_url("sop"));
    }

    public function hapus($id)
    {

        $data = $this->db->get_where('pengajuan_sop', ['id' => $id])->row_array();

        unlink("./uploads/berkas/" . $data['file']);

        $this->db->where(['id' => $id]);

        $this->db->delete('pengajuan_sop');

        $this->session->set_flashdata('success', 'Berhasil Dihapus!');

        redirect(base_url('sop'));
    }

    public function edit($id)
    {

        $this->form_validation->set_rules('nama_sop', 'Nama SOP', 'required');
        $this->form_validation->set_rules('tempat_sop', 'Tempat SOP', 'required');
        $this->form_validation->set_rules('tanggal_sop', 'Tanggal SOP', 'required');
        $this->form_validation->set_rules('unit_sop', 'Unit', 'required');
        // $this->form_validation->set_rules('file_surat', 'Keterangan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $judul = [
                'title' => 'Manajemen SOP',
                'sub_title' => 'SOP'
            ];
            $data['sop'] = $this->db->get_where('pengajuan_sop', ['id' => $id])->row_array();

            $this->load->view('templates/header', $judul);
            $this->load->view('sop/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_sop = $this->input->post("nama_sop", TRUE);
            $tempat_sop = $this->input->post("tempat_sop", TRUE);
            $tanggal_sop = $this->input->post("tanggal_sop", TRUE);
            $unit_sop = $this->input->post("unit_sop", TRUE);
            // $file_surat =  $this->input->post("file_surat", TRUE);

            $config['upload_path'] = './uploads/berkas';
            $config['allowed_types'] = 'pdf|doc|docx';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $data = $this->db->get_where('pengajuan_sop', ['id' => $id])->row_array();
                unlink("./uploads/berkas/" . $data['file']);

                $data = array('upload_data' => $this->upload->data());
                $file = $data['upload_data']['file_name'];

                $update = [
                    'nama_sop' => $nama_sop,
                    'tempat_sop' => $tempat_sop,
                    'tanggal_sop' => date('Y-m-d', strtotime($tanggal_sop)),
                    'unit_sop' => $unit_sop,
                    'file' => $file,
                    'status' => 1
                ];

                $this->db->where('id', $id);
                $this->db->update('pengajuan_sop', $update);
                $this->session->set_flashdata('success', 'Berhasil Diedit!');
                redirect(base_url("sop"));
            } else {

                $update = [
                    'nama_sop' => $nama_sop,
                    'tempat_sop' => $tempat_sop,
                    'tanggal_sop' => date('Y-m-d', strtotime($tanggal_sop)),
                    'unit_sop' => $unit_sop,
                ];

                $this->db->where('id_sop', $id);
                $this->db->update('sop', $update);
                $this->session->set_flashdata('success', 'Berhasil Diedit!');
                redirect(base_url("sop"));
            }
        }
    }

    public function pengajuan()
    {
        $judul = [
            'title' => 'Manajemen SOP',
            'sub_title' => 'Pengajuan SOP'
        ];

        $data['status'] = [
            1 => 'Pending',
            2 => 'Syarat Tidak Terpenuhi',
            3 => 'Diterima dan Dilanjutkan',
            4 => 'Divalidasi',
            5 => 'Valid/<b>Selesai</b>',
        ];

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

        $this->db->select('*');
        $this->db->from('pengajuan_sop');
        $this->db->join('unit', 'unit.id_unit=pengajuan_sop.unit_sop');
        $this->db->order_by("tanggal_upload", "desc");
        $query = $this->db->get();
        $data['data'] = $query->result_array();

        $this->load->view('templates/header', $judul);
        $this->load->view('sop/pengajuan_sop', $data);
        $this->load->view('templates/footer');
    }


    public function updateStatus($id)
    {
        $options = [
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

        $status = $this->input->post('status');
        if (!$this->input->post('note')){
            $note = '-';
        } else {
            $note = $this->input->post('note');
        }
        

        // var_dump($status);
        // die;
        $pSop = $this->db->get_where('pengajuan_sop', ['id' => $id])->row_array();
        $pUnit = $this->db->get_where('unit', ['id_unit' => $pSop['unit_sop']])->row_array();
        $dateNow = date('Y-m-d');

        if ($status == 5) {
            $save = [
                'id' => $pSop['id'],
                'nama_sop' => $pSop['nama_sop'],
                'unit_sop' => $pUnit['nama'],
                'tanggal_selesai' => date('Y-m-d', strtotime($dateNow)),
                'file' => $pSop['file'],
            ];

            $this->db->insert('sop_selesai', $save);

            
            $email = $pUnit['email'];

            if($email){
                $subjek = "Status Pengajuan SOP ".$id." diperbarui";
                $pesan = "
                <html>
                    <head>
                        <title>UPDATE STATUS</title>
                    </head>
                    <body>
                        <p>SOP dengan informasi: <br>
                        ID : ".$id."<br>
                        Nama SOP : ".$pSop['nama_sop']."<br>
                        Tempat : ".$pSop['$tempat_sop']."<br>
                        Tanggal : ".$pSop['tanggal_sop']."<br>
                        Unit : ".$pUnit['nama']."<br>
                        <br>
                        Telah divalidasi dan diterima. Dengan catatan sebagai berikut: <br>".$note."<br><br>                    
                        
                        Cek link berikut:
                        <a href='https://222011485.student.stis.ac.id/tracking/tracked/".$id."'>SOP</a>
                        </p>
                    </body>
                </html>
                ";
                $this->sendMail($email, $subjek, $pesan);
            }
            
        } elseif ($status == 2) {
            $email = $pUnit['email'];
            if($email){
                $subjek = "Pengajuan SOP ".$id." Tidak Memenuhi Syarat";
                $pesan = "
                <html>
                    <head>
                        <title>SOP DITOLAK</title>
                    </head>
                    <body>
                        <p>SOP dengan informasi: <br>
                        ID : ".$id."<br>
                        Nama SOP : ".$pSop['nama_sop']."<br>
                        Tempat : ".$pSop['$tempat_sop']."<br>
                        Tanggal : ".$pSop['tanggal_sop']."<br>
                        Unit : ".$pUnit['nama']."<br>
                        <br>
                        Tidak memenuhi syarat dan ditolak. Dengan catatan sebagai berikut: <br>".$note."<br><br>                    
                        
                        Cek link berikut:
                        <a href='https://222011485.student.stis.ac.id/tracking/tracked/".$id."'>SOP</a>
                        </p>
                    </body>
                </html>
                ";

                $this->sendMail($email, $subjek, $pesan);
            }
            
        }

        $this->db->set('status', $status);

        $this->db->where(['id' => $id]);
        $this->db->update('pengajuan_sop');

        $this->session->set_flashdata('success', 'Status Pengajuan ID: ' . $id . ' Telah Diupdate!');
        redirect(base_url('sop/pengajuan'));
        
    }

    public function hapusPengajuan($id)
    {

        $data = $this->db->get_where('pengajuan_sop', ['id' => $id])->row_array();

        unlink("./uploads/berkas/" . $data['file']);

        $this->db->where(['id' => $id]);

        $this->db->delete('pengajuan_sop');

        $this->session->set_flashdata('success', 'Pengajuan ID: ' . $id . ' Telah Dihapus!');
        redirect(base_url('sop/pengajuan'));
    }

    public function selesai()
    {
        $judul = [
            'title' => 'Manajemen SOP',
            'sub_title' => 'SOP'
        ];

        $data['data'] = $this->db->get('sop_selesai')->result_array();

        $this->load->view('templates/header', $judul);
        $this->load->view('sop/selesai', $data);
        $this->load->view('templates/footer');
    }

    public function hapusSopSelesai($id)
    {

        $data = $this->db->get_where('sop_selesai', ['id' => $id])->row_array();

        unlink("./uploads/berkas/" . $data['file']);

        $this->db->where(['id' => $id]);

        $this->db->delete('sop_selesai');

        $this->session->set_flashdata('success', 'Berhasil Dihapus!');

        redirect(base_url('sop/selesai'));
    }

    public function sendMail($email, $subjek, $pesan)
    {
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
        $this->email->subject($subjek);
        $this->email->message($pesan);

        if($this->email->send()){
        } else{
            show_error($this->email->print_debugger());
        }
    
        
    }
}