<?php
class Mod_aduan extends Ci_Model
{

    function select_all()
    {
        // return $this->db->get('aduan');
        $query = "SELECT tb1.aduan_id,tb1.tgl_aduan,tb1.judul,tb1.tgl_aduan,tb2.nama_kec,tb3.status, tb3.sts_id
       FROM aduan as tb1,kecamatan as tb2, sts_aduan as tb3 
       WHERE tb1.kec_id=tb2.kec_id and tb1.sts_id=tb3.sts_id";
        return $this->db->query($query);
    }

    function select_by_user($id)
    {
        // return $this->db->get('aduan');
        // $data['user']['user_id'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $query = "SELECT tb1.aduan_id,tb1.tgl_aduan,tb1.judul,tb1.tgl_aduan,tb2.nama_kec,tb3.status, tb3.sts_id,tb4.user_id
       FROM aduan as tb1,kecamatan as tb2, sts_aduan as tb3, users as tb4   
       WHERE tb1.kec_id=tb2.kec_id and tb1.sts_id=tb3.sts_id and tb1.user_id=tb4.user_id and tb4.user_id='" . $id . "'";
        return $this->db->query($query);
    }

    function select_kec($id)
    {
        // return $this->db->get('aduan');
        $query = "SELECT tb1.aduan_id,tb1.tgl_aduan,tb1.judul,tb1.tgl_aduan,tb2.nama_kec,
        tb3.status, tb3.sts_id
       FROM aduan as tb1,kecamatan as tb2, sts_aduan as tb3
       WHERE tb1.kec_id=tb2.kec_id and tb1.sts_id=tb3.sts_id and tb1.sts_id='1'
       or tb1.sts_id='2' or tb1.sts_id='4' or tb1.sts_id='6' or tb1.sts_id='7' or tb1.sts_id='8' and tb2.kec_id=$id";
        return $this->db->query($query);
    }

    function select_lap($id)
    {
        $query = "SELECT tb1.aduan_id,tb1.no_hp,tb1.alamat_aduan,tb1.tgl_aduan,tb1.judul,tb1.tgl_aduan,
        tb1.keterangan,tb2.nama_kec,
        tb3.status, tb3.sts_id, tb4.nama, tb4.email from aduan as tb1, kecamatan as tb2,sts_aduan as tb3,
        users as tb4 WHERE tb1.kec_id=tb2.kec_id and tb1.user_id=tb4.user_id and tb1.aduan_id=$id";
        return $this->db->query($query);
    }

    function select_kds()
    {
        // return $this->db->get('aduan');
        $query = "SELECT tb1.aduan_id,tb1.tgl_aduan,tb1.judul,tb1.tgl_aduan,tb2.nama_kec,tb3.status, tb3.sts_id
       FROM aduan as tb1,kecamatan as tb2, sts_aduan as tb3 
       WHERE tb1.kec_id=tb2.kec_id and tb1.sts_id=tb3.sts_id and tb1.sts_id='3'";
        return $this->db->query($query);
    }

    function select_one($id)
    {
        $query = "SELECT tb1.aduan_id,tb1.judul,tb1.alamat_aduan,tb1.keterangan,tb1.tgl_aduan,tb1.no_hp,tb2.nama_kec,tb3.status, tb3.sts_id
        FROM aduan as tb1,kecamatan as tb2, sts_aduan as tb3 
        WHERE tb1.kec_id=tb2.kec_id and tb1.sts_id=tb3.sts_id and tb1.aduan_id='$id'";
        return $this->db->query($query);
        //return $this->db->get_where('aduan', array('aduan_id' => $id));

    }


    function simpan()
    {
        $data = [
            'user_id' => $this->input->post('id_user'),
            'no_hp' => htmlspecialchars(($this->input->post('telp', true))),
            'kec_id' => htmlspecialchars(($this->input->post('kec', true))),
            'judul' => htmlspecialchars(($this->input->post('judul', true))),
            'alamat_aduan' => htmlspecialchars(($this->input->post('alamat', true))),
            'kateg_id' => htmlspecialchars(($this->input->post('jenis', true))),
            'keterangan' => htmlspecialchars(($this->input->post('ket', true))),
            'sts_id' => 1,
            'tgl_aduan' => date('Y-m-d')
        ];
        $this->db->insert('aduan', $data);
    }


    function update()
    {
        $data = array(
            'sts_id'     =>  $this->input->post('status')

        );
        $this->db->where('aduan_id', $this->input->post('id'));
        $this->db->update('aduan', $data);
    }

    function update_adm()
    {
        $data = array(
            'sts_id'     =>  $this->input->post('status')

        );
        $this->db->where('aduan_id', $this->input->post('id'));
        $this->db->update('aduan', $data);
    }

    function update_kds()
    {
        $data = array(
            'sts_id'     =>  $this->input->post('status')

        );
        $this->db->where('aduan_id', $this->input->post('id'));
        $this->db->update('aduan', $data);
    }
}
