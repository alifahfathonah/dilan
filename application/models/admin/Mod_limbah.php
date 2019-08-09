<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_limbah extends Ci_Model
{



    function selectByUsaha($user)
    {
        $sql = "select * from usaha, p_b3, users where usaha.id_usaha=p_b3.id_usaha and usaha.user_id=users.user_id and usaha.user_id='" . $user . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function selectByUsahaId($id)
    {
        $sql = "select * from usaha, p_air, users where usaha.id_usaha=p_air.id_usaha and usaha.user_id='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }
    function selectByUsahaIdj($id)
    {
        $sql = "select * from usaha, p_b3 where usaha.id_usaha=p_b3.id_usaha and
                p_b3.bln='01' and usaha.id_usaha='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }
    function selectByUsahaIdf($id)
    {
        $sql = "select * from usaha, p_b3 where usaha.id_usaha=p_b3.id_usaha and
        p_b3.bln='02' and usaha.id_usaha='" . $id . "'";
        $query = $this->db->query($sql);

        return $query;
    }
    function selectByUsahaIdm($id)
    {
        $sql = "select * from usaha, p_b3 where usaha.id_usaha=p_b3.id_usaha and
                p_b3.bln='03' and usaha.id_usaha='" . $id . "'";
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
        $sql = "select * from p_b3, usaha where usaha.id_usaha=p_b3.id_usaha and p_b3.id_b3='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan($data)
    {
        $this->db->insert('p_b3', $data);
    }

    function update($data)
    {


        $this->db->where('id_b3', $this->input->post('id_b3'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('p_b3', $data);
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

    function selectUsaha()
    {
        $sql = "select * from usaha, lapor where usaha.id_usaha=lapor.id_usaha";
        $query = $this->db->query($sql);

        return $query;
    }
}
