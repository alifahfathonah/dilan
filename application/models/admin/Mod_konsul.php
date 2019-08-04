<?php
class Mod_konsul extends Ci_Model
{

    function select_all()
    {
        return $this->db->get('konsul');
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


    /* function update()
    {
        $data = array(
            'nama'     =>  $this->input->post('nama'),
            'email'            =>  $this->input->post('email'),
            'kec_id'    => $this->input->post('kecamatan'),
            'is_active'              =>  $this->input->post('status'),
            'role_id' =>  $this->input->post('level')
        );
        $this->db->where('user_id', $this->input->post('id'));
        $this->db->update('users', $data);
    }

    function getKode()
    {
        $sql = "select max(user_id) as max_id from users";
        $query = $this->db->query($sql);
        return $query;
    }*/
}
