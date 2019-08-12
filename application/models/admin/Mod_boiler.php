<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_boiler extends Ci_Model
{
    function selectByUsaha($user)
    {
        $sql = "select * from usaha, boiler where usaha.id_usaha=boiler.id_usaha and usaha.user_id='" . $user . "'";
        $query = $this->db->query($sql);
        return $query;
    }
    function selectByUsahaId($id)
    {
        $sql = "select * from usaha, boiler where usaha.id_usaha=boiler.id_usaha and usaha.id_usaha='" . $id . "'";
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
        $sql = "select * from usaha,  boiler where usaha.id_usaha=boiler.id_usaha and boiler.id_boiler='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan()
    {
        $data = [
            'id_usaha' => $this->input->post('id_usaha'),
            'nm_boiler' => $this->input->post('nm_boiler'),
            'kp_boiler' => $this->input->post('kp_boiler'),
            'b_bakar' => $this->input->post('b_bakar'),
            'tinggi' => $this->input->post('tinggi'),
            'bentuk' => $this->input->post('bentuk'),
            'diameter' => $this->input->post('diameter'),
            'w_opr' => $this->input->post('w_opr')


        ];


        $this->db->insert('boiler', $data);
    }

    function update()
    {

        $data = [

            'nm_boiler' => $this->input->post('nm_boiler'),
            'kp_boiler' => $this->input->post('kp_boiler'),
            'b_bakar' => $this->input->post('b_bakar'),
            'tinggi' => $this->input->post('tinggi'),
            'bentuk' => $this->input->post('bentuk'),
            'diameter' => $this->input->post('diameter'),
            'w_opr' => $this->input->post('w_opr')
        ];

        $this->db->where('id_boiler', $this->input->post('id_boiler'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('boiler', $data);
    }
}
