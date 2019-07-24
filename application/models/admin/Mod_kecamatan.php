<?php
class Mod_kecamatan extends Ci_Model
{

    function select_all()
    {
        return $this->db->get('kecamatan');
    }

    function select_parent()
    {
        return $this->db->get_where('kecamatan', array('parent' => 0));
    }


    function simpan()
    {
        $data = array(
            'nama_kec'     =>  $this->input->post('kecamatan'),

        );
        $this->db->insert('kecamatan', $data);
    }


    function update()
    {
        $data = array(
            'nama_kec'     =>  $this->input->post('kecamatan')

        );
        $this->db->where('kec_id', $this->input->post('id'));
        $this->db->update('kecamatan', $data);
    }
}
