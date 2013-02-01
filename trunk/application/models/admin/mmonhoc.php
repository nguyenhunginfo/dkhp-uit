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
        if($loai!="TD")
        {
            if($search!="")
            {
             $this->db->like("tenmh",$search);
             $this->db->or_like("mamh",$search);   
            }
           
            else if($loai!="tatca") $this->db->where("Loai",$loai);    
          
            if($limit!=0) $this->db->limit($limit,$start); 
            $this->db->select("ID,MaMH,TenMH,SoTC,TCLT,TCTH,MaLoai,TenLoai,KieuMH");
            $this->db->from("monhoc");
            $this->db->join("loai_monhoc","loai_monhoc.MaLoai=monhoc.Loai");
            $this->db->order_by("MaMH");
            $query=$this->db->get();
            return $query->result_object();    
        }
        else
        {
            $str_query="SELECT A.MaMH as MaMH_OLD, A.TenMH as TenMH_OLD,B.MaMH as MaMH_NEW,B.TenMH as TenMH_NEW
                        FROM  mhtuongduong, monhoc A, monhoc B
                        WHERE ID_OLD=A.ID AND ID_NEW=B.ID";
            $query=$this->db->query($str_query);
            
            return $query->result_object();    
        }
        
        
    }
    
    //lay monhoc $loai: tatca, DC, CN ho?c search
    
    
    //tinh tong so hang doi voi moi loai $search, tatca,CN,DC
    function get_num_rows($search="",$loai="tatca")
    {                  
        if($loai!="TD")
        {
            
            if($search!="")//tim theo tenmh va mamh
            {
              $this->db->like("tenmh",$search); 
              $this->db->or_like("mamh",$search);  
            } 
            else if($loai!="tatca") $this->db->where("Loai",$loai);
                  
            $query=$this->db->get("monhoc");
            return $query->num_rows();
        }
        else
        {            
            
            $query=$this->db->get("mhtuongduong");
            return $query->num_rows();
        }
    }
    
    function get_danhsach_monhoc_nhom($manhom="")
    {
        $this->db->select("MaNhom,TenNhom");
        if($manhom!="") $this->db->where("MaNhom",$manhom);
        $query=$this->db->get("monhoc_nhom_info");
        return $query->result_object();
    }
    function get_monhoc_nhom($manhom)
    {
        $this->db->select("monhoc_nhom.MaNhom,monhoc_nhom.ID,MaMH,TenMH,SoTC,TCLT,TCTH,MaLoai,TenLoai") ;
        $this->db->from("monhoc_nhom");
        $this->db->where("monhoc_nhom.MaNhom",$manhom);
        $this->db->join("monhoc","monhoc_nhom.ID=monhoc.ID","left");  
        $this->db->join("loai_monhoc","monhoc.Loai=loai_monhoc.MaLoai");        
        $this->db->order_by("monhoc_nhom.MaNhom,MaMH","ASC");
        $query=$this->db->get();
        return $query->result_object();    
    }
    function get_num_monhoc_nhom($search="")
    {
        
        if($search!="") $this->db->like("manhom",$search);        
        
        $this->db->select("MaNhom") ;       
        $query=$this->db->get("monhoc_nhom");
        return $query->num_rows();
        
        
        
    }
    
    //lay cac mon hoc con lai khong thuoc nhom $manhom
    function get_monhoc_empty($manhom)
    {        
        $table="monhoc_nhom";
        $str_query="SELECT ID,MaMH,TenMH,SoTC,TCLT,TCTH,MaLoai,TenLoai,KieuMH
                    FROM monhoc,loai_monhoc 
                    WHERE monhoc.loai=loai_monhoc.MaLoai 
                    AND ID NOT IN(SELECT ID
                                      FROM $table
                                      WHERE MaNhom='$manhom')
                    ORDER BY MaMH";
                                      
                    
                           
        $query=$this->db->query($str_query);
        $result=$query->result_object();
        
        return $result;
        
    }
    
    function get_ten_monhoc_nhom($manhom)
    {
          
        $this->db->select("TenNhom");
        $this->db->where("MaNhom",$manhom);
        $query=$this->db->get("monhoc_nhom_info");
        $result=$query->row();
        $tennhom=$result->TenNhom;
        return $tennhom;
    }
    
    function get_ma_monhoc_nhom()
    {
        $this->db->distinct();   
        $this->db->select("MaNhom");
        $query=$this->db->get("monhoc_nhom");
        return $query->result_object();
    }
    
    function get_loai_monhoc()
    {        
        
        
        $this->db->order_by("STT","ASC");
        $query=$this->db->get("loai_monhoc");
        
        $result=$query->result_object();
        
        return $result;
        
    }
    
    //lay du lieu 1 mon hoc ID
    function get_monhoc_data($ID)
    {     
        $this->db->where("ID",$ID);        
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
    
    function mamh_nhom_exist($mamh,$condition="insert")
    {
        if($condition=="new") return false;
        $this->db->where("manhom",$mamh);
        $this->db->select("manhom");
        $query=$this->db->get("monhoc_nhom_info");
        if($query->num_rows()>0) return true;
        else return false;
    }
    function mamh_tenmh_exist($mamh,$tenmh,$condition="insert")
    {
        if($condition=="new") return false;
        $this->db->where("mamh",$mamh);
        $this->db->where("tenmh",$tenmh);
        $this->db->select("mamh");
        $query=$this->db->get("monhoc");
        if($query->num_rows()>0) return true;
        else return false;
    }
    
   function delete_monhoc_nhom($manhom,$id_array)
    {
        $table="monhoc_nhom";        
        $this->db->where("MaNhom",$manhom);
        $this->db->delete($table);
    }
    function insert_monhoc_nhom($manhom,$id_array)
    {
         $table="monhoc_nhom";
         
         if($id_array!=NULL)
         {
            foreach($id_array as $key=>$value)
             {
                
                $data["ID"]=$value;
                $data["MaNhom"]=$manhom;                                
                $this->db->insert($table,$data);
                
             }
         }
         
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