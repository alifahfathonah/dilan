<?php
class Mod_konsul extends Ci_Model
{

    function select_all()
    {
        return $this->db->get('konsul');
    }


    function selectById($id)
    {
        $sql = " select usaha.nm_usaha, users.nama, users.user_id, konsul.email, konsul.kontak, konsul.perihal, konsul.isi,
         konsul.id_k, konsul.perihal from users, konsul, usaha where users.user_id=konsul.user_id and usaha.user_id=users.user_id and konsul.id_k='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function simpan()
    {
        $data = [
            'user_id' => htmlspecialchars(($this->input->post('user_id', true))),
            'email' => htmlspecialchars(($this->input->post('email', true))),
            'kontak' => htmlspecialchars(($this->input->post('kontak', true))),
            'perihal' => htmlspecialchars(($this->input->post('perihal', true))),
            'isi' => htmlspecialchars(($this->input->post('isi', true))),
            'created_at' => date('Y-m-d')
        ];
        $this->db->insert('konsul', $data);
    }

    function selectByUser()
    {
        $sql = " select usaha.nm_usaha, users.nama, users.user_id, konsul.email, konsul.id_k, konsul.perihal from users, konsul, usaha where users.user_id=konsul.user_id and usaha.user_id=users.user_id";
        $query = $this->db->query($sql);
        return $query;
    }
}
