<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_pelpsix extends Ci_Model
{

    function selectByUsaha($user)
    {
        $sql = "select * from usaha, users where usaha.user_id=users.user_id and usaha.user_id='" . $user . "'";
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
        $sql = "select * from lap_sm, usaha where usaha.id_usaha=lap_sm.id_usaha and lap_sm.id_lapsm='" . $id . "'";
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
        $sql = "select * from usaha, lap_sm where usaha.id_usaha=lap_sm.id_usaha and usaha.id_usaha='" . $id . "' limit 1";
        $query = $this->db->query($sql);

        return $query;
    }
    function update_six($data)
    {

        $param = array('id_lapsm' => $this->input->post('id_lapsm'), 'id_usaha' => $this->input->post('id_usaha'));
        $this->db->where($param);
        $this->db->update('lap_sm', $data);
    }
    function create_six($data)
    {
        $this->db->insert('lap_sm', $data);
    }

    function verify1($data)
    {
        $this->db->where('id_laporsm', $this->input->post('id_laporsm'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('laporsm', $data);
    }
    /* function selectUsaha()
    {
        $sql = "select * from usaha, lap_sm where usaha.id_usaha=lap_sm.id_usaha";
        $query = $this->db->query($sql);

        return $query;
    }*/
    function selectv_six($id, $param)
    {
        $sql = "select * from usaha, lap_sm  where usaha.id_usaha=lap_sm.id_usaha and lap_sm.periode_sm='" . $param . "' and usaha.id_usaha='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }

    function verify($data)
    {
        $param = array('id_lapsm' => $this->input->post('id_lapsm'), 'id_usaha' => $this->input->post('id_usaha'));
        $this->db->where($param);
        $this->db->update('lap_sm', $data);
    }

    function correct($data)
    {
        $param = array('id_lapsm' => $this->input->post('id_lapsm'), 'id_usaha' => $this->input->post('id_usaha'));
        $this->db->where($param);
        $this->db->update('lap_sm', $data);
    }

    function selectsm_usaha($idu, $id)
    {
        $sql = "select * from usaha, lap_sm  where usaha.id_usaha=lap_sm.id_usaha and usaha.id_usaha='" . $idu . "' and lap_sm.id_lapsm='$id'";
        $query = $this->db->query($sql);

        return $query;
    }

    function selectUsaha($user)
    {
        $sql = "select * from usaha, users, lap_sm where usaha.user_id=users.user_id and
        usaha.id_usaha=lap_sm.id_usaha and usaha.user_id='" . $user . "'";
        $query = $this->db->query($sql);

        return $query;
    }
}
