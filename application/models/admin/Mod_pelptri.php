<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_pelptri extends Ci_Model
{

    function selectByUsaha($user)
    {
        $sql = "select * from usaha, users where usaha.user_id=users.user_id and usaha.user_id='" . $user . "'";
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
        $sql = "select * from lap_tri, usaha where usaha.id_usaha=lap_tri.id_usaha and lap_tri.id_laptri='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan($data)
    {
        $this->db->insert('lapor', $data);
    }

    function update_tri($data)
    {


        $this->db->where('id_laptri', $this->input->post('id_laptri'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('lap_tri', $data);
    }

    function selectFile($id)
    {
        $sql = "select lampiran from lapor where id_lapor='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function selectv_usaha($id)
    {
        $sql = "select * from usaha  where id_usaha='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }


    function verify($data)
    {
        $this->db->where('id_', $this->input->post('id_lapor'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('lapor', $data);
    }

    function create_tri($data)
    {
        $this->db->insert('lap_tri', $data);
    }

    function selectUsaha($user)
    {
        $sql = "select * from usaha, users, lap_tri where usaha.user_id=users.user_id and
        usaha.id_usaha=lap_tri.id_usaha and usaha.user_id='" . $user . "'";
        $query = $this->db->query($sql);

        return $query;
    }
}
