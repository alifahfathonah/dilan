<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_sarana extends Ci_Model
{

    function selectByUsaha()
    {
        $sql = "select * from usaha, sarana where usaha.id_usaha=sarana.id_usaha";
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
        $sql = "select * from perizinan where id_izin='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan()
    {
        $data = [
            'id_usaha' => $this->input->post('id_usaha'),
            'j_izin' => $this->input->post('j_izin'),
            'nmr_izin' => $this->input->post('nmr_izin'),
            'tgl_terbit' => $this->input->post('tgl_terbit'),
            'berlaku' => $this->input->post('berlaku'),
            'keterangan' => $this->input->post('keterangan')

        ];



        $this->db->insert('perizinan', $data);
    }

    function update()
    {
        $data = [
            'id_usaha' => $this->input->post('id_usaha'),
            'j_izin' => $this->input->post('j_izin'),
            'nmr_izin' => $this->input->post('nmr_izin'),
            'tgl_terbit' => $this->input->post('tgl_terbit'),
            'berlaku' => $this->input->post('berlaku'),
            'keterangan' => $this->input->post('keterangan')

        ];
        $this->db->where('id_izin', $this->input->post('id_izin'));
        $this->db->update('perizinan', $data);
    }
}
