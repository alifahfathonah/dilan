<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_lampsm extends Ci_Model
{

    function selectByUsaha($user)
    {
        $sql = "select * from usaha, lamp_sm where usaha.id_usaha=lamp_sm.id_usaha and usaha.user_id='" . $user . "'";
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
        $sql = "select * from usaha, lamp_sm where usaha.id_usaha=lamp_sm.id_usaha and lamp_sm.idl_sm='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }
    function selectsm_usaha($id)
    {
        $sql = "select * from usaha, lamp_sm  where usaha.id_usaha=lamp_sm.id_usaha and usaha.id_usaha='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }
    function simpan($data)
    {
        $this->db->insert('lamp_sm', $data);
    }

    function update($data)
    {
        $this->db->where('idl_sm', $this->input->post('id_sm'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('lamp_sm', $data);
    }
    function selectFile($id)
    {
        $sql = "select file_sm from lamp_sm where idl_sm='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    /*function selectv_usaha($id)
    {
        $sql = "select * from usaha, kelola_pantau where usaha.id_usaha=kelola_pantau.id_usaha and kelola_pantau.periode='01' and usaha.id_usaha='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }
    function selectv_usahax($id)
    {
        $sql = "select * from usaha, kelola_pantau where usaha.id_usaha=kelola_pantau.id_usaha and kelola_pantau.periode='02' and usaha.id_usaha='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }

    function verify($data)
    {
        $this->db->where('id_laporsm', $this->input->post('id_laporsm'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('laporsm', $data);
    }
    function selectUsaha()
    {
        $sql = "select * from usaha, laporsm where usaha.id_usaha=laporsm.id_usaha";
        $query = $this->db->query($sql);

        return $query;
    }*/
}
