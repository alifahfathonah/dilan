<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_izin extends Ci_Model
{
    function create()
    {
        $data = [

            'nm_usaha' => htmlspecialchars(($this->input->post('nm_usaha', true))),
            'created_at' => date('Y-m-d')
        ];
        $this->db->insert('usaha', $data);
    }
    function selectByUsaha($user)
    {
        $sql = "select * from usaha, perizinan where usaha.id_usaha=perizinan.id_usaha and usaha.user_id='".$user."'";
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
