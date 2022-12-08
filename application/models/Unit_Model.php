<?php

class Unit_Model extends CI_Model
{
    function search_id($id_unit){
        $this->db->like('id_unit', $id_unit , 'both');
        $this->db->order_by('id_unit', 'ASC');
        $this->db->limit(10);
        return $this->db->get('unit')->result();
    }

    public function cek_unit($id_unit)
    {
        return $this->db->get_where('unit', array('id_unit' => $id_unit));
    }

}
