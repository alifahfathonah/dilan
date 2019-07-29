<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_pelpsix extends Ci_Model
{

    function selectByUsaha()
    {
        $sql = "select * from usaha, laporsm where usaha.id_usaha=laporsm.id_usaha";
        $query = $this->db->query($sql);
        return $query;
    }
    function selectByUser($id)
    {
        $sql = "select * from usaha where user_id='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }
    function selectById($id)
    {
        $sql = "select * from lapor where id_lapor='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan($data)
    {
        $this->db->insert('lapor', $data);
    }

    function update()
    {
        $m1 = $this->input->post('m1');
        $m2 = $this->input->post('m2');
        $g = $m1 . "-" . $m2;
        $data = [
            'id_usaha' => $this->input->post('id_usaha'),
            'periode' => $g,
            'tahun' => $this->input->post('tahun'),
            'PH' => $this->input->post('PH'),
            'tgl_pantau' => $this->input->post('tgl_pantau'),
            'parameter' => $this->input->post('parameter'),
            'b_mutu' => $this->input->post('b_mutu'),
            'h_pantau' => $this->input->post('h_pantau')

        ];

        $this->db->where('id_lapor', $this->input->post('id_lapor'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('lapor', $data);
    }
}
