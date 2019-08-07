<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_download extends Ci_Model
{



    function selectAll()
    {
        return $this->db->get('download');
    }



    function simpan($data)
    {
        $this->db->insert('download', $data);
    }

    function update($data)
    {


        $this->db->where('id_lapor', $this->input->post('id_lapor'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('lapor', $data);
    }

    function selectFile($id)
    {
        $sql = "select nm_file from download where id_d='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }
}
