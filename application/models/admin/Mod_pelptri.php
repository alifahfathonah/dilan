<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_pelptri extends Ci_Model
{

    function selectByUsaha()
    {
        $sql = "select * from usaha, lap_tri where usaha.id_usaha=lap_tri.id_usaha";
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
            'ruang_hijau' => $this->input->post('ruang_hijau'),
            'penyimpanan' => $this->input->post('penyimpanan'),
            'nm_boiler' => $this->input->post('nm_boiler'),
            'kp_boiler' => $this->input->post('kp_boiler'),
            'jml_crb' => $this->input->post('jml_crb'),
            'tinggi_crb' => $this->input->post('tinggi_crb'),
            'bentuk_crb' => $this->input->post('bentuk_crb'),
            'diameter_crb' => $this->input->post('diameter_crb'),
            'wktu_o' => $this->input->post('wktu_o'),
            'nm_genset' => $this->input->post('nm_genset'),
            'kp_genset' => $this->input->post('kp_genset'),
            'waktu_opr' => $this->input->post('waktu_opr'),
            'created_at' => date("Y-m-d")

        ];


        $this->db->insert('sarana', $data);
    }

    function update()
    {

        $data = [

            'l_bangunan' => $this->input->post('l_bangunan'),
            'l_parkir' => $this->input->post('l_parkir'),
            'ruang_hijau' => $this->input->post('ruang_hijau'),
            'penyimpanan' => $this->input->post('penyimpanan'),
            'nm_boiler' => $this->input->post('nm_boiler'),
            'kp_boiler' => $this->input->post('kp_boiler'),
            'jml_crb' => $this->input->post('jml_crb'),
            'tinggi_crb' => $this->input->post('tinggi_crb'),
            'bentuk_crb' => $this->input->post('bentuk_crb'),
            'diameter_crb' => $this->input->post('diameter_crb'),
            'wktu_o' => $this->input->post('wktu_o'),
            'nm_genset' => $this->input->post('nm_genset'),
            'kp_genset' => $this->input->post('kp_genset'),
            'waktu_opr' => $this->input->post('waktu_opr'),
            'updated_at' => date("Y-m-d")

        ];

        $this->db->where('id_sarana', $this->input->post('id_sarana'), 'id_usaha', $this->input->post('id_usaha'));
        $this->db->update('sarana', $data);
    }
}
