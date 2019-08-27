<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter_model extends CI_Model {

    public function get_dokter_detail($id)
    {
        $this->db->where('no_dr', $id);
        return $this->db->get('dokter')->row();
    }

    public function get_all_dokter()
    {
        return $this->db->get('dokter')->result();
    }

}

/* End of file Dokter_model.php */
