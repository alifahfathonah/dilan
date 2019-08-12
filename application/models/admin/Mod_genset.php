<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_genset extends Ci_Model
{

    function selectByUsaha($user)
    {
        $sql = "select * from usaha, genset where usaha.id_usaha=genset.id_usaha and usaha.user_id='" . $user . "'";
        $query = $this->db->query($sql);
        return $query;
    }
    function selectByUsahaId($id)
    {
        $sql = "select * from usaha, genset where usaha.id_usaha=genset.id_usaha and usaha.id_usaha='" . $id . "'";
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
        $sql = "select * from usaha,  genset where usaha.id_usaha=genset.id_usaha and genset.id_genset='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan()
    {
        $data = [
            'id_usaha' => $this->input->post('id_usaha'),
            'nm_genset' => $this->input->post('nm_genset'),
            'kp_genset' => $this->input->post('kp_genset'),
            'bhn_bkrgent' => $this->input->post('bhn'),
            'wkt_opr' => $this->input->post('waktu_opr'),
            'penyimpanan' => $this->input->post('penyimpanan')

        ];


        $this->db->insert('genset', $data);
    }

    function update()
    {

        $data = [

            'id_usaha' => $this->input->post('id_usaha'),
            'nm_genset' => $this->input->post('nm_genset'),
            'kp_genset' => $this->input->post('kp_genset'),
            'bhn_bkrgent' => $this->input->post('bhn'),
            'wkt_opr' => $this->input->post('waktu_opr'),
            'penyimpanan' => $this->input->post('penyimpanan')
        ];

        $this->db->where('id_genset', $this->input->post('id_genset'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('genset', $data);
    }
}
