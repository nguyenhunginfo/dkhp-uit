<?php
class Mgiaovien extends CI_Model
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
    //get ten_khoa
    function ten_khoa($makhoa)
    {
        $this->db->where("MaKhoa",$makhoa);
        $this->db->select("TenKhoa");
        $query=$this->db->get("khoa");
        $row=$query->row();
        return $row->TenKhoa;
        
    }
    //get all sinh vien
    function get_giaovien($search="",$start=0,$limit=0)
    {
        if($search!="")
        {
            $this->db->like("magv",$search);
            $this->db->or_like("tengv",$search);
            if($limit!=0) $this->db->limit($limit,$start); 
            $query=$this->db->get("giaovien");
            return $query->result_object();   
        }
        else
        {
            if($limit!=0) $this->db->limit($limit,$start); 
            $query=$this->db->get("giaovien");
            return $query->result_object();
        }
    }
    
    function get_num_rows($search="")
    {
        if($search!="") 
        {
            $this->db->like("magv",$search);
            $this->db->or_like("tengv",$search);
            $query=$this->db->get("giaovien");
            return $query->num_rows();  
        }
        else
        {
           $query=$this->db->get("giaovien");
            return $query->num_rows(); 
        }     
        
    }
    
    //GET LICH GIANG DAY CUA GIAO VIEN
    function get_lich_giang_day($search="",$start=0,$limit=0)
    {
        if($search!="")
        {
            $this->db->where("magv",$search);            
            if($limit!=0) $this->db->limit($limit,$start); 
            $query=$this->db->get("giaovien");
            return $query->result_object();   
        }
        else
        {
            if($limit!=0) $this->db->limit($limit,$start); 
            $query=$this->db->get("giaovien");
            return $query->result_object();
        }
    }
//LAY SO LOP GIANG DAY THEO TUNG GIAO VIEN    
    function get_solop($magv="")
    {       
        //LY THUYET
        $str_query="SELECT MaLop
                    FROM loplt,giaovien
                    WHERE loplt.MaGV=giaovien.MaGV 
                    AND loplt.MaGV='$magv'";
                    
        $query_lt=$this->db->query($str_query);
        $result_lt=$query_lt->result_object(); 
                 
        //THUC HANH            
        $str_query="SELECT MaLop
                    FROM lopth,giaovien
                    WHERE lopth.MaGV=giaovien.MaGV 
                    AND lopth.MaGV='$magv'";
                                
                              
        $query_th=$this->db->query($str_query);
        $result_th=$query_th->result_object();
        $result=array_merge($result_lt,$result_th);
        return count($result);
       
    }
    function get_tkb($magv="",$thu,$ca)
    {
        //LY THUYET
        $str_query="SELECT MaLop,TenMH,Phong,Thu,Ca
                    FROM loplt,giaovien,monhoc
                    WHERE loplt.MaGV='$magv' 
                    AND loplt.MaGV=giaovien.MaGV
                    AND loplt.MaMH=monhoc.MaMH
                    AND loplt.Thu=$thu 
                    AND loplt.Ca=$ca";
                    
        $query_lt=$this->db->query($str_query);
        $result_lt=$query_lt->result_object(); 
                 
        //THUC HANH            
        $str_query="SELECT MaLop,TenMH,Phong,Thu,Ca
                    FROM lopth,giaovien,monhoc                    
                    WHERE lopth.MaGV='$magv' 
                    AND lopth.MaGV=giaovien.MaGV
                    AND lopth.MaMH=monhoc.MaMH
                    AND lopth.Thu=$thu 
                    AND lopth.Ca=$ca";            
                              
        $query_th=$this->db->query($str_query);
        $result_th=$query_th->result_object();
        $result=array_merge($result_lt,$result_th);
        return $result;
    }
    
    //for tkb
    function get_thu()
    {        
        $query=$this->db->get("thu");
        return $query->result_object();        
    }
    //for ajax
    function get_ca()
    {        
        $query=$this->db->get("ca");
        return $query->result_object();  
    }
    
    
    
	//xoa giaovien dua vao magv
    function delete_giaovien($magv_array)
    {
        if(count($magv_array)>0)
        {   
                foreach($magv_array as $key=>$value)
                {
                    if($key==0) $this->db->where("MaGV",$value);
                    else  $this->db->or_where("MaGV",$value);                    
                }     
                   
                $this->db->delete("giaovien");            
        }
    }
    function insert_giaovien($data)
    {
        $this->db->insert("giaovien",$data);
    }
    function import_giaovien($khoa,$data,$type)
    {
        if($type=="insert")
        {
            $this->db->insert_batch("SV_".$khoa,$data);
        }
        else
        {   
            $this->db->trans_start();
            $this->db->empty_table("SV_".$khoa);
            $this->db->insert_batch("SV_".$khoa,$data);
            $this->db->trans_complete();
        }
    }
    function update_giaovien($key,$data)
    {
       
        $this->db->update("giaovien",$data,array("MaGV"=>$key));
        
    }
    function magv_exist($magv)
    {
        $this->db->where("magv",$magv);            
        $query=$this->db->get("giaovien");
        if($query->num_rows()>0) return true;
        return false; 
    }
    function mssv_exist_condition($masv,$khoa)
    {
        if($masv!="")
        {
            if($this->get_num_rows($masv)>0)//ton tai giaovien
            {
                if($khoa!="")
                {                
                    $this->db->where("MaSV",$masv); 
                    $count=$this->db->count_all_results("SV_".$khoa);
                    if($count>0) return false;
                    else return true;   
                }
                else return true;
                 
            } 
        }
        
        return false;
    }
    function get_sv_table($masv)
    {
        $this->db->where("MaSV",$masv);
        if($this->db->count_all_results("sv_cnpm")>0) return "CNPM";
        $this->db->where("MaSV",$masv);
        if($this->db->count_all_results("sv_httt")>0) return "HTTT";
        $this->db->where("MaSV",$masv);
        if($this->db->count_all_results("sv_ktmt")>0) return "KTMT";
        $this->db->where("MaSV",$masv);
        if($this->db->count_all_results("sv_khmt")>0) return "KHMT";
        $this->db->where("MaSV",$masv);
        if($this->db->count_all_results("sv_mmt")>0) return "MMT";
    }
    
    
    
}
?>