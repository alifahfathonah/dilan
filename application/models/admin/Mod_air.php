<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_air extends Ci_Model
{



    function selectByUsaha($user)
    {
        $sql = "select * from usaha, p_air, users where usaha.id_usaha=p_air.id_usaha and usaha.user_id=users.user_id and users.user_id='" . $user . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function selectByUsahaId($id)
    {
        $sql = "select * from usaha, p_air, users where usaha.id_usaha=p_air.id_usaha and usaha.user_id='" . $id . "'";
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
        $sql = "select * from p_air, usaha where usaha.id_usaha=p_air.id_usaha and p_air.id_p='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan($data)
    {
        $this->db->insert('p_air', $data);
    }

    function update($data)
    {


        $this->db->where('id_p', $this->input->post('id_p'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('p_air', $data);
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
