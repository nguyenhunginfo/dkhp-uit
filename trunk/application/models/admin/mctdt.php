<?php
class Mctdt extends CI_Model
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
//==============get gia tri K=====================================================================================================================
    function get_K()
    {        
        $query=$this->db->get("k");
        return $query->result_object();
        
    }
//==============TRA VE K CHUA CO CTDT================================================================================================================    
    function get_K_empty($khoa="CNPM")
    {        
        $result=null;
        $str_query="SELECT MaK,TenK
                    FROM k
                    
                    WHERE MaK not in(SELECT MaK FROM ctdt WHERE MaKhoa='$khoa' )";
                    
        $query=$this->db->query($str_query);
        $result=$query->result_object();
        
        return $result;
        
    }
//==============TRA VE K DA CO CTDT================================================================================================================    
    function get_K_exist($khoa)
    {        
        $result=null;
        $str_query="SELECT MaK,TenK
                    FROM k
                    
                    WHERE MaK in(SELECT MaK FROM ctdt WHERE MaKhoa='$khoa' )";
                    
        $query=$this->db->query($str_query);
        $result=$query->result_object();
        
        return $result;
    }
//==============TRA VE TEN KHOA = $MAKHOA================================================================================================================
    function ten_khoa($makhoa)
    {
        $this->db->select("TenKhoa");
        $this->db->where("MaKhoa",$makhoa);        
        $query=$this->db->get("khoa");
        $row=$query->row();
        return $row->TenKhoa;
        
    }
//==============TRA VE TEN CHUYEN NGANH = $MACN================================================================================================================
    function ten_chuyennganh($macn)
    {
        $this->db->select("TenCN");
        $this->db->where("MaCN",$macn);        
        $query=$this->db->get("chuyennganh");
        $row=$query->row();
        return $row->TenCN;
        
    }
//==============LAY DANH SACH CHUONG TRINH DAO TAO=======================================================================================================
    function get_danhsach_ctdt($khoa)
    {
        $result=null;
        $str_query="SELECT ctdt.MaK,SoHK,TenK
                    FROM  ctdt,k                    
                    WHERE   ctdt.MaKhoa='$khoa'
                    AND     ctdt.MaK=k.MaK";
                    
        $query=$this->db->query($str_query);
        $result=$query->result_object();
        
        return $result;
    }
//==============get ctdt the khoa va k======================================================================================================================
    function get_ctdt($search="",$khoa,$k=4,$hk=0)
    {
        $result=null;
        
        $table="ctdt_".$khoa;
        $str_query="SELECT HK,monhoc.ID,MaMH,TenMH,SoTC,TCLT,TCTH,MaLoai,TenLoai,KieuMH
                    FROM $table, monhoc,loai_monhoc 
                    WHERE $table.ID=monhoc.ID
                    AND k=$k
                    AND monhoc.Loai=loai_monhoc.MaLoai";
                    
        if($hk!=0) $str_query.=" AND HK= $hk";
        
        $str_query.=" ORDER BY HK,MaMH";      
        $query=$this->db->query($str_query);
        $result=$query->result_object();
        
        return $result;        
    }
    function get_chuyennganh($khoa,$k=4)
    {
        $result=null;
        $str_query="SELECT chuyennganh.MaCN,TenCN
                    FROM chuyennganh 
                    WHERE chuyennganh.MaKhoa='$khoa'
                    AND chuyennganh.MaK=$k";
        $str_query.=" ORDER BY chuyennganh.MaCN";      
        $query=$this->db->query($str_query);
        $result=$query->result_object();        
        return $result;        
    }
//LAY MACN CUOI CUNG KHOA,K DE LAY CHI SO TAO CN MOI    
     function get_last_macn($khoa,$k)
    {
        $macn="";
        $this->db->select("MaCN");
        $this->db->where("MaKhoa",$khoa);
        $this->db->where("MaK",$k);
        $this->db->order_by("MaCN","DESC");
        $query=$this->db->get("chuyennganh");
        $result=$query->row();
        if($result!=null) $macn=$result->MaCN;        
        return $macn;        
    }
//==============LAY MONHOC CHUYEN NGANH = $MACN========================================================
    
    function get_monhoc_chuyennganh($macn)
    { 
        $result=null;
        
        
        $str_query="SELECT monhoc.ID,MaMH,TenMH,SoTC,TCLT,TCTH,MaLoai,TenLoai,KieuMH
                    FROM moncn, monhoc,loai_monhoc 
                    WHERE moncn.MaCN='$macn'
                    AND moncn.ID=monhoc.ID
                    AND monhoc.Loai=loai_monhoc.MaLoai";
                    
        
        $str_query.=" ORDER BY MaMH";      
        $query=$this->db->query($str_query);
        $result=$query->result_object();
        
        return $result;
        
    }
    
//==============LAY MON HOC CON LAI CHUA BO TRI CHO CTDT====================================================================================
    function get_monhoc_empty($khoa,$k)
    {        
        $table="ctdt_".$khoa;
        //chon nhung mon chua bo tri cho k nay
        $str_query="SELECT ID,MaMH,TenMH,SoTC,TCLT,TCTH,MaLoai,TenLoai,KieuMH
                    FROM monhoc,loai_monhoc 
                    WHERE monhoc.loai=loai_monhoc.MaLoai 
                    AND ID NOT IN(SELECT ID
                                      FROM $table
                                      WHERE k=$k)
                    ORDER BY MaMH";
                                      
                    
                           
        $query=$this->db->query($str_query);
        $result=$query->result_object();
        
        return $result;
        
    }

//==============LAY MON HOC CON LAI CHUA BO TRI CHO CHUYENNGANH $MACN====================================================================================
    function get_monhoc_chuyennganh_empty($macn)
    {        
        $table="moncn";
        //chon nhung mon chua bo tri cho k nay
        $str_query="SELECT ID,MaMH,TenMH,SoTC,TCLT,TCTH,MaLoai,TenLoai,KieuMH
                    FROM monhoc,loai_monhoc 
                    WHERE monhoc.loai=loai_monhoc.MaLoai 
                    AND ID NOT IN(SELECT ID
                                      FROM $table
                                      WHERE MaCN='$macn')
                    ORDER BY MaMH";
                                      
                    
                           
        $query=$this->db->query($str_query);
        $result=$query->result_object();
        
        return $result;
        
    }    
//==============LAY LOAI MON HOC================================================================================================================    
    function get_loai_monhoc()
    {        
        
        
        $query=$this->db->get("loai_monhoc");
        $result=$query->result_object();
        
        return $result;
        
    }
//==============lay du lieu la tong so tin chi cua 1 chuong trinh dao tao====================================================================================
    function get_sotc($khoa="",$k=4,$hk=0)
    {
        $result=null;
        
        $table="ctdt_".$khoa;
        $str_query="SELECT SUM(SoTC) as sotc
                    FROM $table, monhoc 
                    WHERE $table.ID=monhoc.ID
                    AND k=$k
                    ";
        if($hk!=0) $str_query.=" AND HK= $hk";        
         
        $query=$this->db->query($str_query);
        $result=$query->row();
        if($result->sotc!="") $num=$result->sotc;
        else $num=0;
        return $num;
    }
    
//==============LAY TONG SO MON CUA CTDT KHOA,K,HK======================================================================
    function get_somon($khoa="",$k=4,$hk=0)
    {
        $result=null;
        
        $table="ctdt_".$khoa;
        $str_query="SELECT COUNT(ID) as somon
                    FROM $table                    
                    WHERE k=$k
                    ";
        if($hk!=0) $str_query.=" AND HK= $hk";
        
          
        $query=$this->db->query($str_query);
        $result=$query->row();
        $num=$result->somon;
        return $num;
    }
//========LAY SO CHUYEN NGANH CUA 1 CTDT KHOA,K==================================================================================================    
    function get_socn($khoa="",$k=4)
    {
        $result=null;
        
        $table="chuyennganh";
        $str_query="SELECT COUNT(MaCN) as socn
                    FROM $table                    
                    WHERE  MaKhoa='$khoa'
                    AND MaK='$k'";
          
        $query=$this->db->query($str_query);
        $result=$query->row();
        $num=$result->socn;
        return $num;
    }
//==============lay du lieu la tong so hoc ky cua 1 chuong trinh dao tao====================================================================================
    function get_sohk($khoa,$k)
    {
        $num=0;
        
        $this->db->select("SoHK");
        $this->db->where("MaKhoa",$khoa);
        $this->db->where("MaK",$k);            
        $query=$this->db->get("ctdt");
        $result=$query->row();
        if($result!=NULL)$num=$result->SoHK;        
        return $num;
    }
//==============DELETE 1 HOAC NHIEU CTDT================================================================================================================
    function delete_ctdt($k_array,$khoa)
    {
        $table1="ctdt_".$khoa;
        $table2="ctdt";
        if(count($k_array)>0)
        {            
               $this->db->trans_start();
                foreach($k_array as $key=>$value)
                {
                    
                    $this->db->delete($table1,array("K"=>$value));
                    $this->db->delete($table2,array("MaKhoa"=>$khoa,"MaK"=>$value));                     
                }   
                $this->db->trans_complete();     
                
        }
    }
//======HAM XOA CAC MON HOC TRONG 1 HOCK THUOC 1 CTDT=====================================================================================    
    function xoa_monhoc_ctdt($khoa="",$k=0,$hk=0)
    {   
        $table="ctdt_".$khoa;        
        if($k!=0)  $this->db->where("K",$k) ;      
        if($hk!=0)  $this->db->where("HK",$hk) ; 
        $this->db->delete($table);
        $sohk=$this->mctdt->get_sohk($khoa,$k);
        $sohk=$sohk-1;
        $this->db->update("ctdt",array("SoHK"=>$sohk),array("MaKhoa"=>$khoa,"MaK"=>$k));
        
    }
//==============THEM CTDT=================================================================================================================        
    function insert_ctdt($data)
    {
        //print_r($data);
        $this->db->insert("ctdt",$data);
    }
    function import_ctdt($khoa,$k,$data)
    {   
        $table="ctdt_".$khoa;
        
        $this->db->trans_start();
        $this->db->where("K",$k);
        $this->db->delete($table);
        $max_HK=1;
        
        foreach($data as $row)
        {   
            $monhoc=array();
            $hk=$row["HK"];
            $monhoc["ID"]=$row["ID"];
            $monhoc["HK"]=$hk;
            $monhoc["K"]=$k;
            $this->db->insert($table,$monhoc);
            if($hk>$max_HK) $max_HK=$hk;
        }
        $query_str="INSERT INTO ctdt value('$khoa',$k,$hk) 
                    ON DUPLICATE KEY UPDATE SOHK=$hk";
        $this->db->query($query_str);
        $this->db->trans_complete();
    }
//=====HAM PHUC VU CHO UPDATE MON HOC CHUONG TRINH DAO TAO
    function delete_monhoc_ctdt($khoa,$k,$hk,$id_array)
    {
        $table="ctdt_".$khoa;
        $this->db->where("HK",$hk);
        $this->db->where("K",$k);
        $this->db->delete($table);
    }
    function insert_monhoc_ctdt($khoa,$k,$hk,$id_array)
    {
         $table="ctdt_".$khoa;
         
         if($id_array!=NULL)
         {
            foreach($id_array as $key=>$value)
             {
                $data["ID"]=$value;
                $data["K"]=$k;
                $data["HK"]=$hk;                
                $this->db->insert($table,$data);
             }
         }
    }
    
//=====HAM PHUC VU CHO UPDATE MON HOC CHUONG TRINH DAO TAO=============================================
    function delete_monhoc_chuyennganh($macn)
    {
        $table="moncn";        
        $this->db->where("MaCN",$macn);
        $this->db->delete($table);
    }
    function insert_monhoc_chuyennganh($macn,$id_array)
    {
         $table="moncn";
         
         if($id_array!=NULL)
         {
            foreach($id_array as $key=>$value)
             {
                $data["ID"]=$value;
                $data["MaCN"]=$macn;
                $this->db->insert($table,$data);
             }
         }
    }
    
//=================================================FUNCTION FOR IMPORT VALIDATION=====================================================================    
    
    public function get_id($monhoc)
    {
        
        $id=0;
        $this->db->select("ID");
        $this->db->where("MaMH",$monhoc["MaMH"]);
        $this->db->where("TenMH",$monhoc["TenMH"]);
        $query=$this->db->get("monhoc");
        $result=$query->row();
        if($result!=NULL) $id=$result->ID;
        return $id;
    }
    //true->OK / false
     public function valid_hk($hk,$khoa,$k)
       {
            if(is_numeric($hk)==false)
            {
                return false;
            }
            else
            {
                //$sohk=$this->mctdt->get_sohk($khoa,$k);                
                if($hk>0) return true;
                else return false;    
            }
       }
   
    public function valid_monhoc($id,$monhoc,$arr_unique,$khoa,$k)
       {
            
          if(in_array($monhoc,$arr_unique)) return false;//KHONG TRUNG MaMH & TenMH TRONG DANH SACH          
          //else if ($this->mctdt->monhoc_exist($id,$khoa,$k)) return false;//KIEM TRA COI ID NAY DA DUOC BO TRI CHUA
          return true;
       }
    
    
    
     function is_tencn_exist($tencn)
    {   
            $table="chuyennganh";
            $this->db->where("TenCN",$tencn);            
            $count=$this->db->count_all_results($table);
            if($count>0) return true;
            else return false;
  
    }
    
    //kiem tra mon hoc da duoc bo tri cho k chua?
    function monhoc_exist($id,$khoa,$k)
    {   
            $table="ctdt_".$khoa;
            $this->db->where("ID",$id);
            $this->db->where("K",$k); 
            $count=$this->db->count_all_results($table);
            if($count>0) return true;
            else return false;
  
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