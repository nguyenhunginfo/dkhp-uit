<?php
class Msinhvien extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database(); //connect to database       
    }
    //return danh sach khoa
    function get_khoa()
    {
        $query=$this->db->get("khoa");
        return $query->result_object();
        
    }
    
    function get_lop($khoa="")
    {
        if($khoa!="") $this->db->where("MaKhoa",$khoa);
        $query=$this->db->get("lophoc");
        return $query->result_object();
        
    }
    function get_K()
    {
        
        $query=$this->db->get("k");
        return $query->result_object();
        
    }
    
    function ten_khoa($makhoa)
    {
        $this->db->where("MaKhoa",$makhoa);
        $this->db->select("TenKhoa");
        $query=$this->db->get("khoa");
        $row=$query->row();
        return $row->TenKhoa;
        
    }
    function get_sinhvien($khoa="tatca",$k=0,$start=0,$limit=0)
    {
        if($khoa!="tatca")$this->db->where("Khoa",$khoa);       
        if($k!=0) $this->db->where("K",$k);
        if($limit!=0) $this->db->limit($limit,$start);    
        $query=$this->db->get("sinhvien");
        return $query->result_object();
        
    }
    
    function get_sinhvien_data($masv)
    {     
         $this->db->where("MaSV",$masv);
               
          
        $query=$this->db->get("sinhvien");
        return $query->result_object();
        
    }
    
    function get_sinhvien_datas($array_mssv)
    {
        $ncount=count($array_mssv);
        for($i=0;$i<$ncount;$i++)
        {
           if($i==0) $this->db->where("MaSV",$array_mssv[$i]);
           else $this->db->or_where("MaSV",$array_mssv[$i]);
        }
          
        $query=$this->db->get("sinhvien");
        return $query->result_object();
        
    }
    function get_num_rows($khoa="tatca",$k=0)
    {
        if($khoa!="tatca")$this->db->where("Khoa",$khoa);       
        if($k!=0) $this->db->where("K",$k);           
        $query=$this->db->get("sinhvien");
        return $query->num_rows();
    }
    
    
}
?>