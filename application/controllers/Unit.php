<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->load->model('Unit_Model');
    }

    public function index()
    {

        $judul = [
            'title' => 'Unit',
            'sub_title' => ''
        ];

        $data['data'] = $this->db->get('unit')->result_array();
        $this->load->view('templates/header', $judul);
        $this->load->view('unit/index', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {

        $data = $this->db->get_where('unit', ['id_unit' => $id])->row_array();

        $this->db->where(['id_unit' => $id]);
        $this->db->delete('unit');
        $this->session->set_flashdata('success', 'Berhasil Dihapus!');
        redirect(base_url('unit'));
    }

    public function tambah()
    {

        $this->form_validation->set_rules('id_unit', 'ID Unit', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');


        if ($this->form_validation->run() == FALSE) {
            $judul = [
                'title' => 'Unit',
                'sub_title' => 'Tambah Unit '
            ];
            $this->load->view('templates/header', $judul);
            $this->load->view('unit/tambah');
            $this->load->view('templates/footer');
        } else {
            $id_unit =  $this->input->post("id_unit", TRUE);
            $nama =  $this->input->post("nama", TRUE);
            $email =  $this->input->post("email", TRUE);

            $save = [
                'id_unit' => $id_unit,
                'nama' => $nama,
                'email' => $email
            ];

            $this->db->insert('unit', $save);
            $this->session->set_flashdata('success', 'Berhasil Ditambahkan!');
            redirect(base_url("unit"));
            
        }
    }

    public function edit($id)
    {
        
        $this->form_validation->set_rules('id_unit', 'ID Unit', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');


        if ($this->form_validation->run() == FALSE) {
            $judul = [
                'title' => 'Unit',
                'sub_title' => 'Edit Unit'
            ];

            $data['unit'] = $this->db->get_where('unit', ['id_unit' => $id])->row_array();
            $this->load->view('templates/header', $judul);
            $this->load->view('unit/edit', $data);
            $this->load->view('templates/footer');
        } else {

            $id_unit =  $this->input->post("id_unit", TRUE);
            $nama =  $this->input->post("nama", TRUE);
            $email =  $this->input->post("email", TRUE);

            $update = [
                'id_unit' => $id_unit,
                'nama' => $nama,
                'email' => $email
            ];

            $this->db->where('id_unit', $id);
            $this->db->update('unit', $update);
            
            $this->session->set_flashdata('success', 'Berhasil Diedit!');
            redirect(base_url("unit"));
        }
    }

    function get_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->Unit_Model->search_id($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->id_unit,
                        'nama' => $row->nama,
                        'email' => $row->email,
                 );
                    echo json_encode($arr_result);
            }
        }
    }

}
