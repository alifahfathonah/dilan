<?php
class Mod_kategori extends Ci_Model
{

    function select_all()
    {
        return $this->db->get('kategori_aduan');
    }

    /*function select_parent()
    {
        return $this->db->get_where('tabel_kategori', array('parent' => 0));
    }*/


    function simpan()
    {
        $data = array(
            'kategori'     =>  $this->input->post('kategori')

        );
        $this->db->insert('kategori_aduan', $data);
    }


    function update()
    {
        $data = array(
            'kategori'     =>  $this->input->post('kategori')

        );
        $this->db->where('kateg_id', $this->input->post('id'));
        $this->db->update('kategori_aduan', $data);
    }
}
