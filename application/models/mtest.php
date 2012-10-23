<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mtest extends CI_Model {

	function _get()
    {
        $this->load->database();
        $query=$this->db->get("monhoc");
        return $query;
    }
}

?>