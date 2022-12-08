<?php

class Pengajuan_track_model extends CI_Model
{
    public function insert_sop($data)
    {
        $query= $this->db->insert('pengajuan_sop',$data);
        if($query){
            return true;
            return $query;
        }else{
            return false;
        }
    }

    public function findById($id)
    {
        $query = $this->db->get_where('pengajuan_sop', ['id' => $id])->row_array();
        return $query;
    }

    public function showById($id)
    {
        $this->db->select('*');
        $this->db->join('unit','unit.id_unit=pengajuan_sop.unit_sop');
        $query = $this->db->get_where('pengajuan_sop', ['id' => $id])->row_array();
        return $query;
    }
}
