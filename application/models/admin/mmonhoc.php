<?php
class Mmonhoc extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database(); //connect to database       
    }
    //==return danh sach khoa
    function get_khoa()
    {
        $query=$this->db->get("khoa");
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
    //lay monhoc $loai: tatca, DC, CN ho?c search
    function get_monhoc($search="",$loai="tatca",$start=0,$limit=0)
    {
        if($search!="")
        {
         $this->db->like("tenmh",$search);
         $this->db->or_like("mamh",$search);   
        }
       
        else if($loai!="tatca") $this->db->where("Loai",$loai);    
      
        if($limit!=0) $this->db->limit($limit,$start); 
        $query=$this->db->get("monhoc");
        return $query->result_object();
        
    }
    //tinh tong so hang doi voi moi loai $search, tatca,CN,DC
    function get_num_rows($search="",$loai="tatca")
    {                          
        if($search!="") $this->db->like("tenmh",$search);
        else if($loai!="tatca") $this->db->where("Loai",$loai);
              
        $query=$this->db->get("monhoc");
        return $query->num_rows();
    }
    
    //lay du lieu 1 mon hoc
    function get_monhoc_data($mamh)
    {     
        $this->db->where("MaMH",$mamh);
        $query=$this->db->get("monhoc");
        return $query->result_object();
        
    }
    //kiem tra mon hoc co ton tai hay ko?(co dieu kien)
    function mamh_exist($mamh,$condition="insert")
    {
        if($condition=="new") return false;
        $this->db->where("mamh",$mamh);
        $this->db->select("mamh");
        $query=$this->db->get("monhoc");
        if($query->num_rows()>0) return true;
        else return false;
    }
    //nhap du lieu 
    function import_monhoc($data,$type)
    {
        if($type=="insert")
        {
            $this->db->insert_batch("monhoc",$data);
        }
        else
        {   
            $this->db->trans_start();
            $this->db->empty_table("monhoc");
            $this->db->insert_batch("monhoc",$data);
            $this->db->trans_complete();
        }
    }
    
    
}
?>