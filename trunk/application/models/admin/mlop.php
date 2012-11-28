<?php
class Mlop extends CI_Model
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
    function get_khoa_from_masv($masv)
    {
        
        $khoa=$this->get_khoa();
        foreach($khoa as $row)
        {
            $makhoa=strtolower($row->MaKhoa);
            $this->db->select("MaSV");
            $this->db->where("MaSV",$masv);
            $num=$this->db->count_all_results("sv_".$makhoa);
            if($num>0) return $makhoa;    
        }
        return "";  
            
       
    }
    //for ajax
    function get_monhoc($loai="")
    {
        $this->db->select("MaMH, TenMH");
        
        if($loai=="th") $this->db->where("TCTH >",0);
        $query=$this->db->get("monhoc");
        return $query->result_object();        
    }
    //for ajax
    function get_giaovien()
    {
        $this->db->select("MaGV, TenGV");
        $query=$this->db->get("giaovien");
        return $query->result_object();        
    }
    //for ajax
    function get_thu()
    {        
        $query=$this->db->get("thu");
        return $query->result_object();        
    }
    //for ajax
    function get_ca($magv,$thu)
    {        
        $str_query="SELECT TenCa FROM ca
                    WHERE TenCa not in( SELECT Ca FROM loplt
                                        WHERE MaGV='".$magv."'
                                        AND   thu=".$thu.")
                    AND   TenCa not in ( SELECT Ca FROM lopth
                                        WHERE MaGV='".$magv."'
                                        AND   thu=".$thu.")";
        $query=$this->db->query($str_query);
        return $query->result_object();        
    }
    //for ajax
    function get_phong($thu,$ca)
    {
        $str_query="SELECT TenPhong FROM phong
                    WHERE TenPhong not in( SELECT Phong FROM loplt
                                        WHERE thu='".$thu."'
                                        AND   ca=".$ca.")
                    AND   TenPhong not in ( SELECT Phong FROM lopth
                                        WHERE thu='".$thu."'
                                        AND   ca=".$ca.")";
        $query=$this->db->query($str_query);
        return $query->result_object();               
    }   
   
    //lay monhoc $loai: tatca, DC, CN ho?c search
    function get_lop($search="",$loai="",$start=0,$limit=0)
    {
        if($search!="")
        {
            $str_query="SELECT MaLop,giaovien.MaGV,TenGV,monhoc.MaMH,TenMH,Phong,Thu,Ca,Min,Max,SLHT
                        FROM loplt,giaovien,monhoc
                        WHERE loplt.MaGV=giaovien.MaGV 
                              AND loplt.MaMH=monhoc.MaMH
                              AND MaLop like '".$search."%'";
            if($limit!=0) $str_query.="\n Limit ".$start.",".$limit;
            $query_lt=$this->db->query($str_query);
            
            
            $str_query="SELECT MaLop,giaovien.MaGV,TenGV,monhoc.MaMH,TenMH,Phong,Thu,Ca,Min,Max,SLHT
                        FROM lopth,giaovien,monhoc
                        WHERE lopth.MaGV=giaovien.MaGV 
                            AND lopth.MaMH=monhoc.MaMH
                            AND MaLop like '".$search."%'";
            if($limit!=0) $str_query.="\n Limit ".$start.",".$limit;          
            $query_th=$this->db->query($str_query);
            
            
            $array_loplt=$query_lt->result_object();
            $array_lopth=$query_th->result_object();
            
            $array_result=array_merge($array_loplt,$array_lopth);
            return $array_result;
        }       
        else
        {
             if($loai=="lt")
                 {
                    $str_query="SELECT MaLop,giaovien.MaGV,TenGV,monhoc.MaMH,TenMH,Phong,Thu,Ca,Min,Max,SLHT
                        FROM loplt,giaovien,monhoc
                        WHERE loplt.MaGV=giaovien.MaGV 
                              AND loplt.MaMH=monhoc.MaMH
                        ORDER BY TenMH";
                              
                    if($limit!=0) $str_query.="\n Limit ".$start.",".$limit;
                    $query_lt=$this->db->query($str_query);
                    return $query_lt->result_object();   
                 }
             else if($loai=="th")//th
                 {
                    $str_query="SELECT MaLop,giaovien.MaGV,TenGV,monhoc.MaMH,TenMH,Phong,Thu,Ca,Min,Max,SLHT
                                FROM lopth,giaovien,monhoc
                                WHERE lopth.MaGV=giaovien.MaGV 
                                AND lopth.MaMH=monhoc.MaMH
                                ORDER BY TenMH";
                                
                    if($limit!=0) $str_query.="\n Limit ".$start.",".$limit;          
                    $query_th=$this->db->query($str_query);
                    return $query_th->result_object();  
                 }
                 else //lop de nghi
                 {
                    $str_query="SELECT DISTINCT monhoc.MaMH,TenMH
                                FROM denghi,monhoc
                                WHERE denghi.MaMH=monhoc.MaMH"; 
                                
                                
                    if($limit!=0) $str_query.="\n Limit ".$start.",".$limit;          
                    $query_th=$this->db->query($str_query);
                    return $query_th->result_object();  
                 }
                     
        } 
    }
    
    //lay monhoc $loai: tatca, DC, CN ho?c search
    function get_lich($thu,$ca)
    {
        
        $str_query="SELECT MaLop,giaovien.MaGV,TenGV,monhoc.MaMH,TenMH,Phong,Thu,Ca,Min,Max,SLHT
                    FROM loplt,giaovien,monhoc
                    WHERE loplt.MaGV=giaovien.MaGV 
                    AND loplt.MaMH=monhoc.MaMH
                    AND loplt.Thu='$thu'
                    AND loplt.Ca='$ca'";         
                    
        $query_lt=$this->db->query($str_query);
        $result_lt=$query_lt->result_object(); 
                 
            
        $str_query="SELECT MaLop,giaovien.MaGV,TenGV,monhoc.MaMH,TenMH,Phong,Thu,Ca,Min,Max,SLHT
                    FROM lopth,giaovien,monhoc
                    WHERE lopth.MaGV=giaovien.MaGV 
                    AND lopth.MaMH=monhoc.MaMH
                    AND lopth.Thu='$thu'
                    AND lopth.Ca='$ca'";
                                
                              
        $query_th=$this->db->query($str_query);
        $result_th=$query_th->result_object();
        $result=array_merge($result_lt,$result_th);
        return $result;
       
    }
    
   
    //tinh tong so hang doi voi moi loai $search, tatca,CN,DC
    function get_num_rows($search="",$loai="")
    {  
        
        $num_rows=0;
        //truong hop tim kiem
        if($search!="") //co gia tri de tim kiem
        {
            $this->db->like("malop",$search);
            $num_rows+=$this->db->count_all_results("loplt");
            
            $this->db->like("malop",$search);
            $num_rows+=$this->db->count_all_results("lopth");
            
            
        }
        //truong hop liet ke
        else 
        {           
            if($loai=="lt")   $num_rows=$this->db->count_all_results("loplt");
            else if($loai=="th") $num_rows=$this->db->count_all_results("lopth");
                 else//lop denghi
                 {
                    $this->db->distinct();
                    $this->db->select("MaMH");                    
                    $query=$this->db->get("denghi");
                    return count($query->result_object());
                 }
            
        }
          
                  
        return $num_rows;
    }
   
    //lay du lieu 1 mon hoc
    function get_lop_data($malop,$loai="lt")
    {     
        $this->db->where("MaLop",$malop);
       
        if($loai=="lt")$query=$this->db->get("loplt");
        else $query=$this->db->get("lopth");
        return $query->result_object();
        
    }
    function get_tenmh($malop)
    {     
                
        $this->db->select("TenMH");           
        $this->db->from("monhoc");   
        $this->db->join("loplt","loplt.MaMH=monhoc.MaMH");
        $this->db->where("MaLop",$malop);
        $query_lt=$this->db->get();

        $this->db->select("TenMH");           
        $this->db->from("monhoc");   
        $this->db->join("lopth","lopth.MaMH=monhoc.MaMH");
        $this->db->where("MaLop",$malop);
        $query_th=$this->db->get();
        
        
        $array_lt=$query_lt->result_object();
        $array_th=$query_th->result_object();                            
        $result=array_merge($array_lt,$array_th);
        foreach($result as $row)
        {
            return $row->TenMH;
        }
        
    }
    
    function get_lop_danh_sach($malop)
    {
            $this->db->select("dangky_CNPM.MaSV,TenSV,GioDK");           
            $this->db->from("dangky_CNPM");
            $this->db->join("sv_CNPM","sv_CNPM.MaSV=dangky_CNPM.MaSV");
            $this->db->where("dangky_CNPM.MaLop",$malop);//$masv is a numberic string
            $query_CNPM=$this->db->get();
            
            $this->db->select("dangky_HTTT.MaSV,TenSV,GioDK");           
            $this->db->from("dangky_HTTT");
            $this->db->join("sv_HTTT","sv_HTTT.MaSV=dangky_HTTT.MaSV");
            $this->db->where("dangky_HTTT.MaLop",$malop);//$masv is a numberic string
            $query_HTTT=$this->db->get();
            
            $this->db->select("dangky_KHMT.MaSV,TenSV,GioDK");           
            $this->db->from("dangky_KHMT");
            $this->db->join("sv_KHMT","sv_KHMT.MaSV=dangky_KHMT.MaSV");
            $this->db->where("dangky_KHMT.MaLop",$malop);//$masv is a numberic string
            $query_KHMT=$this->db->get();
            
            $this->db->select("dangky_KTMT.MaSV,TenSV,GioDK");           
            $this->db->from("dangky_KTMT");
            $this->db->join("sv_KTMT","sv_KTMT.MaSV=dangky_KTMT.MaSV");
            $this->db->where("dangky_KTMT.MaLop",$malop);//$masv is a numberic string
            $query_KTMT=$this->db->get();
            
            
            $this->db->select("dangky_MMT.MaSV,TenSV,GioDK");           
            $this->db->from("dangky_MMT");
            $this->db->join("sv_MMT","sv_MMT.MaSV=dangky_MMT.MaSV");
            $this->db->where("dangky_MMT.MaLop",$malop);//$masv is a numberic string
            $query_MMT=$this->db->get();
            
            $array_CNPM=$query_CNPM->result_object();
            $array_HTTT=$query_HTTT->result_object();
            $array_KTMT=$query_KTMT->result_object();
            $array_KHMT=$query_KHMT->result_object();                
            $array_MMT=$query_MMT->result_object();
                
            $result=array_merge($array_CNPM,$array_HTTT,$array_KTMT,$array_KHMT,$array_MMT);
            return $result;
    }
    
//==========THAO TAC CAP NHAP THONG TIN CUA MOT LOP=====================================================================================    
    function update_lop($key,$data,$loai="lt")
    {
        if($loai=="lt")$this->db->update("loplt",$data,array("MaLop"=>$key));
        else $this->db->update("lopth",$data,array("MaLop"=>$key));
    }
//==========THAO TAC LUU LICH GIANG DAY SAU KHI THAY DOI(KEO/THA)=====================================================================================
    function update_lich($malop,$data)
    {
        $this->db->update("loplt",$data,array("MaLop"=>$malop));
        $this->db->update("lopth",$data,array("MaLop"=>$malop));
    }
//==========THAO TAC THEM MOT LOP==============================================================================================================
    function insert_lop($loai,$data)
    {
        if($loai=="lt")$this->db->insert("loplt",$data);
        else $this->db->insert("lopth",$data);
        
    }
//===========THAO TAC XU LY THEM LOP DE NGHI======================================================================================================
//          1.Them mot lop vao bang loplt
//          2.Di chuyen danh sach sv de nghi vao bang dang ky(mmt,ktmt,cnpm)
//          3.Xoa mon hoc de nghi o bang de nghi(mamh);
    function open_request_lop($loai,$data)
    {
         $mamh=$data["mamh"];
         $malop=$data["malop"];
         $this->db->trans_start();
         $this->insert_lop($loai,$data);
         $this->join_lop($mamh,$malop);
         $this->delete_denghi($mamh);
         $this->db->trans_complete();
    }
    
    function join_lop($mamh,$malop)
    {
        
        $this->db->where("MaMH",$mamh);
        $query=$this->db->get("denghi");
        $result=$query->result_object();
        
        
        foreach($result as $row)
        {
            $data["MaSV"]=$row->MaSV;
            $data["MaLop"]=$malop;//DANG KY DUA VAO MA LOP
            $data["GioDK"]=$row->GioDK;
            $khoa=$this->get_khoa_from_masv($row->MaSV);
            $this->db->insert("dangky_".$khoa,$data);
        }
        
        
    }
    function delete_denghi($mamh)
    {
        $this->db->where("MaMH",$mamh);
        $this->db->delete("denghi");
    }
    
//=======XOA MOT LOP(CHUA XONG)==============================================================================================
    function delete_lop($malop_array,$loai)
    {
        if(count($malop_array)>0)
        {            
                foreach($malop_array as $key=>$value)
                {
                if($key==0) $this->db->where("MaLop",$value);
                else  $this->db->or_where("MaLop",$value);                    
                }        
                $this->db->delete("loplt");
                
                foreach($malop_array as $key=>$value)
                {
                if($key==0) $this->db->where("MaLop",$value);
                else  $this->db->or_where("MaLop",$value);                    
                }        
                $this->db->delete("lopth");
           
            //delete gi thi delete
            $this->delete_dangky($malop_array);
        }
    }
    //xoa rang buoc trong bang dang ky KHI XOA LOP
    function delete_dangky($malop_array)
    {        
                
        foreach($malop_array as $key=>$value)
        {
            if($key==0) $this->db->where("MaLop",$value);
            else  $this->db->or_where("MaLop",$value);                    
        }        
        $this->db->delete("dangky_cnpm");
                
        foreach($malop_array as $key=>$value)
        {
            if($key==0) $this->db->where("MaLop",$value);
            else  $this->db->or_where("MaLop",$value);                    
        }        
        $this->db->delete("dangky_httt");
                
        foreach($malop_array as $key=>$value)
        {
            if($key==0) $this->db->where("MaLop",$value);
            else  $this->db->or_where("MaLop",$value);                    
        }        
        $this->db->delete("dangky_ktmt");
                
        foreach($malop_array as $key=>$value)
        {
            if($key==0) $this->db->where("MaLop",$value);
            else  $this->db->or_where("MaLop",$value);                    
        }        
        $this->db->delete("dangky_khmt");
                
        foreach($malop_array as $key=>$value)
        {
            if($key==0) $this->db->where("MaLop",$value);
            else  $this->db->or_where("MaLop",$value);                    
        }        
        $this->db->delete("dangky_mmt");
                
    }
    //kiem tra ma lop co ton tai hay ko?(co dieu kien)
    function malop_exist($malop)
    {
        
        $num_rows=0;
        $this->db->select("MaLop");
        $this->db->where("MaLop",$malop);                
        $num_rows+=$this->db->count_all_results("loplt");
        
        $this->db->select("MaLop");
        $this->db->where("MaLop",$malop);                
        $num_rows+=$this->db->count_all_results("lopth");
        if($num_rows>0) return true;
        else return false;
    }
    function malop_exist_condition($malop,$import_type,$loai)
    {
        if($import_type=="insert")
        {            
            return $this->malop_exist($malop);
        }
        else//new
        {
            //lop ly thuyet
            if($loai=="lt")
            {
                $num_rows=0;
                $this->db->select("MaLop");
                $this->db->where("MaLop",$malop);                
                $num_rows=$this->db->count_all_results("lopth");
                if($num_rows>0) return true;
                else return false;
            }
            else//thuc hanh
            {
                $num_rows=0;
                $this->db->select("MaLop");
                $this->db->where("MaLop",$malop);                
                $num_rows=$this->db->count_all_results("loplt");
                if($num_rows>0) return true;
                else return false;
            }
        }//end new
    }
    //kiem tra co ton tai mot bo ba magv_thu_ca nao ko???
    function magv_thu_ca_exist($lop,$import_type,$loai)
    {
        $magv=$lop["MaGV"];
        $thu=$lop["Thu"];
        $ca=$lop["Ca"];
        if($import_type=="insert")
        {
            
            
            $num_rows=0;
            $this->db->select("MaLop");
            $this->db->where("MaGV",$magv);
            $this->db->where("Thu",$thu);
            $this->db->where("Ca",$ca);                
            $num_rows+=$this->db->count_all_results("loplt");
            
            $this->db->select("MaLop");
             $this->db->where("MaGV",$magv);
            $this->db->where("Thu",$thu);
            $this->db->where("Ca",$ca);                 
            $num_rows+=$this->db->count_all_results("lopth");
            if($num_rows>0) return true;
            else return false;
        }
        else//new
        {
            //lop ly thuyet
            if($loai=="lt")
            {
                $num_rows=0;
                $this->db->select("MaLop");
                $this->db->where("MaGV",$magv);
                $this->db->where("Thu",$thu);
                $this->db->where("Ca",$ca);                
                $num_rows=$this->db->count_all_results("lopth");//kiem tra trong lop thuc hanh
                if($num_rows>0) return true;
                else return false;
            }
            else//thuc hanh
            {
                $num_rows=0;
                $this->db->select("MaLop");
                $this->db->where("MaGV",$magv);
                $this->db->where("Thu",$thu);
                $this->db->where("Ca",$ca);                
                $num_rows=$this->db->count_all_results("loplt");//kiem tra trong lop ly thuyet
                if($num_rows>0) return true;
                else return false;
            }
        }
    }    
    //kiem tra co ton tai mot bo ba magv_thu_ca nao ko???
    function thu_ca_phong_exist($lop,$import_type,$loai)
    {
        $thu=$lop["Thu"];
        $ca=$lop["Ca"];
        $phong=$lop["Phong"];
        if($import_type=="insert")
        {
            
            
            $num_rows=0;
            $this->db->select("MaLop");
            $this->db->where("Thu",$thu);
            $this->db->where("Ca",$ca);
            $this->db->where("Phong",$phong);                
            $num_rows+=$this->db->count_all_results("loplt");
            
            $this->db->select("MaLop");            
            $this->db->where("Thu",$thu);
            $this->db->where("Ca",$ca);
            $this->db->where("Phong",$phong);                 
            $num_rows+=$this->db->count_all_results("lopth");
            if($num_rows>0) return true;
            else return false;
        }
        else//new
        {
            //lop ly thuyet
            if($loai=="lt")
            {
                $num_rows=0;
                $this->db->select("MaLop");
                $this->db->where("Thu",$thu);
                $this->db->where("Ca",$ca);
                $this->db->where("Phong",$phong);               
                $num_rows=$this->db->count_all_results("lopth");//kiem tra trong lop thuc hanh
                if($num_rows>0) return true;
                else return false;
            }
            else//thuc hanh
            {
                $num_rows=0;
               $this->db->select("MaLop");
                $this->db->where("Thu",$thu);
                $this->db->where("Ca",$ca);
                $this->db->where("Phong",$phong);               
                $num_rows=$this->db->count_all_results("loplt");//kiem tra trong lop ly thuyet
                if($num_rows>0) return true;
                else return false;
            }
        }
    }
    function thu_exist($thu)
    {
        
        $this->db->where("TenThu",$thu);
        $num_rows=$this->db->count_all_results("thu");//kiem tra trong lop ly thuyet
        if($num_rows>0) return true;
        else return false;
        
    }
    
    function ca_exist($ca)
    {
        
        $this->db->where("TenCa",$ca);
        $num_rows=$this->db->count_all_results("ca");//kiem tra trong lop ly thuyet
        if($num_rows>0) return true;
        else return false;
        
    }
    
    function phong_exist($phong)
    {
        
        $this->db->where("TenPhong",$phong);
        $num_rows=$this->db->count_all_results("phong");//kiem tra trong lop ly thuyet
        if($num_rows>0) return true;
        else return false;
        
    }
    
    function get_MaGV($TenGV)
    {
        $MaGV="";
        $this->db->select("MaGV");
        $this->db->where("TenGV",$TenGV);
        $query=$this->db->get("giaovien");
        $result=$query->result_object();
        foreach($result as $row)
        {
            $MaGV=$row->MaGV;
        }
        
        return $MaGV;
    }
    function get_MaMH($TenMH)
    {
        $MaMH="";
        $this->db->select("MaMH");
        $this->db->where("TenMH",$TenMH);
        $query=$this->db->get("monhoc");
        $result=$query->result_object();
        foreach($result as $row)
        {
            $MaMH=$row->MaMH;
        }
        
        return $MaMH;
    }
    
    
    //nhap du lieu 
    function import_lop($data,$import_type,$loai)
    {
        $num_rows=count($data);
        for($i=0;$i<$num_rows;$i++)
        {
            unset($data[$i]["TenMH"]);
            unset($data[$i]["TenGV"]);
            unset($data[$i]["error"]);
        }
        /*
        echo $import_type;
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        echo $loai;
        */
        if($import_type=="insert")
        {
            $this->db->insert_batch("lop".$loai,$data);
        }
        else
        {   
            $this->db->trans_start();
            $this->db->empty_table("lop".$loai);
            $this->db->insert_batch("lop".$loai,$data);
            $this->db->trans_complete();
        }
        
    }
//=============================NHOM HAM THONG KE==============================================================================
    function get_danhsach_monhoc()
    {
             
        $str_query="SELECT DISTINCT monhoc.MaMH,TenMH
                    FROM loplt,monhoc
                    WHERE loplt.MaMH=monhoc.MaMH"; 
                   
        $query_lt=$this->db->query($str_query);
        $result_lt=$query_lt->result_object(); 
                 
            
         $str_query="SELECT DISTINCT monhoc.MaMH,TenMH
                     FROM lopth,monhoc
                     WHERE lopth.MaMH=monhoc.MaMH"; 
                                
                              
        $query_th=$this->db->query($str_query);
        $result_th=$query_th->result_object();
        $result=array_merge($result_lt,$result_th);
        return $result;
    }
    function get_danhsach_giaovien($loai)
    {
             
        if($loai=="lt")
        {
            $str_query="SELECT DISTINCT giaovien.MaGV,TenGV
                    FROM loplt,giaovien
                    WHERE loplt.MaGV=giaovien.MaGV"; 
                   
            $query_lt=$this->db->query($str_query);
            $result_lt=$query_lt->result_object();
            return $result_lt; 
        }
        else
        {
            $str_query="SELECT DISTINCT giaovien.MaGV,TenGV
                    FROM lopth,giaovien
                    WHERE lopth.MaGV=giaovien.MaGV"; 
                                
                              
            $query_th=$this->db->query($str_query);
            $result_th=$query_th->result_object();
            return $result_th;
        }
    }
    function num_lop_mh($mamh)
    {
        $str_query="SELECT MaLop
                    FROM loplt
                    WHERE MaMH='$mamh'"; 
                   
        $query_lt=$this->db->query($str_query);
        $result_lt=$query_lt->result_object(); 
                 
            
         $str_query="SELECT MaLop
                    FROM lopth
                    WHERE MaMH='$mamh'";
                                
                              
        $query_th=$this->db->query($str_query);
        $result_th=$query_th->result_object();
        $result=array_merge($result_lt,$result_th);
        return count($result);
    }
    
    function num_lop_gv($magv)
    {
        $str_query="SELECT MaLop
                    FROM loplt
                    WHERE MaGV='$magv'"; 
                   
        $query_lt=$this->db->query($str_query);
        $result_lt=$query_lt->result_object(); 
                 
            
         $str_query="SELECT MaLop
                    FROM lopth
                    WHERE MaGV='$magv'";
                                
                              
        $query_th=$this->db->query($str_query);
        $result_th=$query_th->result_object();
        $result=array_merge($result_lt,$result_th);
        return count($result);
    }
    
    
}//end mlop
?>