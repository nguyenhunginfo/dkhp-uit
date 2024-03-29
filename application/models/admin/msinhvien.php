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
    //return tat ca lop thuoc k, khoa
    function get_lop($k="",$khoa="")
    {
        if($k!="") $this->db->where("MaK",$k);
        if($khoa!="") $this->db->where("MaKhoa",$khoa);
        $query=$this->db->get("lophoc");
        return $query->result_object();
        
    }
    //get gia tri K
    function get_K()
    {        
        $query=$this->db->get("k");
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
    function get_sinhvien($search="",$khoa,$k=0,$start=0,$limit=0)
    {
        $result=null;
        //find by $masv
        
        if($search!="") 
        {
            
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);  
            if($k!=0) $this->db->where("K",$k);  
                    
            $query_CNPM=$this->db->get("sv_cnpm");
            
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);
            if($k!=0) $this->db->where("K",$k);  
            
            $query_HTTT=$this->db->get("sv_httt");
            
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);  
            if($k!=0) $this->db->where("K",$k);  
                        
            $query_KTMT=$this->db->get("sv_ktmt");
            
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);
            if($k!=0) $this->db->where("K",$k);  
            
            $query_KHMT=$this->db->get("sv_khmt");
            
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);
            if($k!=0) $this->db->where("K",$k);  
            
            $query_MMT=$this->db->get("SV_MMT");
            
            $array_cnmp=$query_CNPM->result_object();
            $array_HTTT=$query_HTTT->result_object();
            $array_KTMT=$query_KTMT->result_object();
            $array_KHMT=$query_KHMT->result_object();                
            $array_MMT=$query_MMT->result_object();
                
            $result=array_merge($array_cnmp,$array_HTTT,$array_KTMT,$array_KHMT,$array_MMT);
            
            
                     
        }
        else//find by each of $khoa,$k
        {
            if($k!=0) $this->db->where("K",$k);  
            if($limit!=0) $this->db->limit($limit,$start);  
            $query=$this->db->get("SV_".$khoa);
            $result=$query->result_object();
            
            
        } 
        
        return $result;
        
    }
    
    function get_num_rows($search="",$khoa="tatca",$k=0)
    {
        $num_rows=0;
        //truong hop tim kiem
        if($search!="") //co gia tri de tim kiem
        {
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);  
            if($k!=0) $this->db->where("K",$k);           
            $num_rows+=$this->db->count_all_results("sv_cnpm");
            
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);
            if($k!=0) $this->db->where("K",$k); 
            $num_rows+=$this->db->count_all_results("sv_httt");
            
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);
            if($k!=0) $this->db->where("K",$k); 
            $num_rows+=$this->db->count_all_results("sv_ktmt");
            
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);
            if($k!=0) $this->db->where("K",$k); 
            $num_rows+=$this->db->count_all_results("sv_khmt");
            
            if(is_numeric($search))$this->db->like("MaSV",$search,"after");//$masv is a numberic string
            else $this->db->like("TenSV",$search);
            if($k!=0) $this->db->where("K",$k); 
            $num_rows+=$this->db->count_all_results("sv_mmt");
            
        }
        //truong hop liet ke
        else 
        {
            
            if($khoa!="tatca")
            {
                if($k!=0) $this->db->where("K",$k); 
                $num_rows=$this->db->count_all_results("SV_".$khoa);
            }
            else
            {
                if($k!=0) $this->db->where("K",$k); 
                $num_rows+=$this->db->count_all_results("sv_cnpm");
                if($k!=0) $this->db->where("K",$k); 
                $num_rows+=$this->db->count_all_results("sv_httt");
                if($k!=0) $this->db->where("K",$k); 
                $num_rows+=$this->db->count_all_results("sv_ktmt");
                if($k!=0) $this->db->where("K",$k); 
                $num_rows+=$this->db->count_all_results("sv_khmt");
                if($k!=0) $this->db->where("K",$k); 
                $num_rows+=$this->db->count_all_results("sv_mmt");
            }    
            
        }
          
                  
        return $num_rows;
    }
	//xoa sinh vien dua vao masv
    function delete_sinhvien($mssv_array,$khoa)
    {
        if(count($mssv_array)>0)
        { 
            if($khoa!="")//biet truoc khoa
            {
                foreach($mssv_array as $key=>$value)
                {
                if($key==0) $this->db->where("MaSV",$value);
                else  $this->db->or_where("MaSV",$value);                    
                }        
                $this->db->delete("SV_".$khoa);
            }
            else//khong biet khoa
            {
                foreach($mssv_array as $key=>$value)
                {
                    if($key==0) $this->db->where("MaSV",$value);
                    else  $this->db->or_where("MaSV",$value);                    
                }     
                $table=array("sv_cnpm","sv_httt","sv_ktmt","sv_khmt","sv_mmt");   
                $this->db->delete($table);
            }
            
            
            //delete gi thi delete
        }
    }
    function insert_sinhvien($khoa,$data)
    {
        $this->db->insert("SV_".$khoa,$data);
    }
    function import_sinhvien($khoa,$data,$type)
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
    function update_sinhvien($key,$khoa_old,$khoa_new,$data)
    {
        //chuyen khoa
        if($khoa_old!=$khoa_new)
        {
           // print_r($data);
           $mssv_array=array($key);                       
           $this->delete_sinhvien($mssv_array,$khoa_old);
           $this->insert_sinhvien($khoa_new,$data);
            
            
        }
        else $this->db->update("SV_".$khoa_old,$data,array("MaSV"=>$key));
        
    }
    function mssv_exist($masv)
    {
        if($this->get_num_rows($masv)>0) return true;
        return false;
    }
    function mssv_exist_condition($masv,$khoa)
    {
        if($masv!="")
        {
            if($this->get_num_rows($masv)>0)//ton tai sinhvien
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
    
    function _get()
    {
        $this->load->database();
        $query=$this->db->get("monhoc");
        return $query;
    }
    
    
}
?>