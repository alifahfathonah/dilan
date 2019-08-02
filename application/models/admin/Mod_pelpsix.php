<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_pelpsix extends Ci_Model
{

    function selectByUsaha($user)
    {
        $sql = "select * from usaha, laporsm where usaha.id_usaha=laporsm.id_usaha and usaha.user_id='".$user."'";
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
        $sql = "select * from laporsm, usaha where usaha.id_usaha=laporsm.id_usaha and laporsm.id_laporsm='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan($data)
    {
        $this->db->insert('laporsm', $data);
    }

    function update($data)
    {


        $this->db->where('id_laporsm', $this->input->post('id_laporsm'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('laporsm', $data);
    }
    function selectFile($id)
    {
        $sql = "select lampiran from laporsm where id_laporsm='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function selectv_usaha($id)
    {
        $sql = "select * from usaha, laporsm where usaha.id_usaha=laporsm.id_usaha and usaha.id_usaha='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }

    function verify($data)
    {
        $this->db->where('id_laporsm', $this->input->post('id_laporsm'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('laporsm', $data);
    }
}
