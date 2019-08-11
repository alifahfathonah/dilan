<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_kelola extends Ci_Model
{

    function selectByUsaha($user)
    {
        $sql = "select * from usaha, kelola_pantau where usaha.id_usaha=kelola_pantau.id_usaha and usaha.user_id='" . $user . "'";
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
        $sql = "select usaha.id_usaha, usaha.nm_usaha, usaha.user_id, kelola_pantau.id_kelola, kelola_pantau.periode, kelola_pantau.tahun, 
        kelola_pantau.sumber, kelola_pantau.jenis, kelola_pantau.kelola, kelola_pantau.pantau, 
        kelola_pantau.file from kelola_pantau, usaha where usaha.id_usaha=kelola_pantau.id_usaha and kelola_pantau.id_kelola='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan($data)
    {
        $this->db->insert('kelola_pantau', $data);
    }

    function update($data)
    {


        $this->db->where('id_kelola', $this->input->post('id_kelola'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('kelola_pantau', $data);
    }
    function selectFile($id)
    {
        $sql = "select kelola_pantau from laporsm where id_kelola='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function selectv_usaha($id)
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
    }
}
