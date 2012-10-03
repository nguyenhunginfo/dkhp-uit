<?php
class Mpagination extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database(); //connect to database           
    }
    
	function get_mh($limit=10,$start=0)
    {
        $this->db->limit($limit,$start);
        $query=$this->db->get("monhoc");
        return $query->result_object();
        
    }
    function _total()
    {
        $this->db->select("count(MaMH) as num");
        $query=$this->db->get("monhoc");
        $row=$query->row();
        return $row->num;
        
    }
   
    
}
?>