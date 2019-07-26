<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_izin extends Ci_Model
{
    function create()
    {
        $data = [

            'nm_usaha' => htmlspecialchars(($this->input->post('nm_usaha', true))),
            'created_at' => date('Y-m-d')
        ];
        $this->db->insert('usaha', $data);
    }
    function selectByUsaha()
    {
        $sql = "select * from usaha, perizinan where usaha.id_usaha=perizinan.id_usaha";
        $query = $this->db->query($sql);
        return $query;
    }

    function updateB()
    {
        $data = [
            'almt_ktr' => $this->input->post('almt_ktr'),
            'kec_ktr' => $this->input->post('kec_ktr'),
            'almt_ush' => $this->input->post('almt_ush'),
            'kec_ush' => $this->input->post('kec_ush'),
            'telepon' => $this->input->post('telepon'),
            'email_u' => $this->input->post('email_u'),
            'tahun_opr' => $this->input->post('tahun_opr')

        ];


        $this->db->where('id_usaha', $this->input->post('id'));
        $this->db->update('usaha', $data);
    }

    function updateC()
    {
        $data = [
            'jenis_dok' => $this->input->post('jenis_dok'),
            'tahun_sah' => $this->input->post('tahun_sah'),
            'luas_lahan' => $this->input->post('luas_lahan'),
            'jenis_produk' => $this->input->post('jenis_produk'),
            'kapasitas' => $this->input->post('kapasitas'),
            'jenis_bahan' => $this->input->post('jenis_bahan'),
            'penggunaan' => $this->input->post('penggunaan'),
            'sumber_air' => $this->input->post('sumber_air'),
            'jml_karyawan' => $this->input->post('jml_karyawan')

        ];
        $this->db->where('id_usaha', $this->input->post('id'));
        $this->db->update('usaha', $data);
    }
}
