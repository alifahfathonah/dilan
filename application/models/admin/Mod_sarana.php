<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_sarana extends Ci_Model
{

    function selectByUsaha($user)
    {
        $sql = "select * from usaha, sarana where usaha.id_usaha=sarana.id_usaha and usaha.user_id='" . $user . "'";
        $query = $this->db->query($sql);
        return $query;
    }
    function selectByUsahaId($id)
    {
        $sql = "select * from usaha, sarana where usaha.id_usaha=sarana.id_usaha and usaha.id_usaha='" . $id . "'";
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
        $sql = "select * from sarana where id_sarana='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan()
    {
        $data = [
            'id_usaha' => $this->input->post('id_usaha'),
            'l_bangunan' => $this->input->post('l_bangunan'),
            'l_parkir' => $this->input->post('l_parkir'),
            'ruang_hijau' => $this->input->post('ruang_hijau')


        ];


        $this->db->insert('sarana', $data);
    }

    function update()
    {

        $data = [

            'l_bangunan' => $this->input->post('l_bangunan'),
            'l_parkir' => $this->input->post('l_parkir'),
            'ruang_hijau' => $this->input->post('ruang_hijau')

        ];

        $this->db->where('id_sarana', $this->input->post('id_sarana'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('sarana', $data);
    }
}
