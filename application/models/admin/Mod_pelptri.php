<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_pelptri extends Ci_Model
{

    function selectByUsaha($user)
    {
        $sql = "select * from usaha, lapor where usaha.id_usaha=lapor.id_usaha and usaha.user_id='".$user."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function selectByUsahaId($id)
    {
        $sql = "select * from usaha, lapor where usaha.id_usaha=lapor.id_usaha and lapor.id_lapor='" . $id . "'";
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
        $sql = "select * from lapor, usaha where usaha.id_usaha=lapor.id_usaha and lapor.id_lapor='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan($data)
    {
        $this->db->insert('lapor', $data);
    }

    function update($data)
    {


        $this->db->where('id_lapor', $this->input->post('id_lapor'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('lapor', $data);
    }

    function selectFile($id)
    {
        $sql = "select lampiran from lapor where id_lapor='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function selectv_usaha($id)
    {
        $sql = "select * from usaha, lapor where usaha.id_usaha=lapor.id_usaha and usaha.id_usaha='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }
  

    function verify($data)
    {
        $this->db->where('id_lapor', $this->input->post('id_lapor'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('lapor', $data);
    }
}
