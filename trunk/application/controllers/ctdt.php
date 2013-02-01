<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ctdt extends CI_Controller {
    

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");        
        $this->load->model("admin/mctdt");
        $this->load->library('PHPExcel');
        
    }
	public function index($khoa="CNPM")
	{       //get khoa make menu
            $khoa_result=$this->mctdt->get_khoa();
            $k_result=$this->mctdt->get_K();
            //get data to dump into table
            $ctdt_result=$this->mctdt->get_danhsach_ctdt($khoa);//lay danh sach sinh vien cac khoa, thuoc cac k, 15 record dau tien
           
            
            $data['data_title']="Chương trình đào tạo khoa ".$this->mctdt->ten_khoa($khoa);            
            //data for view
                        
            $data["khoa"]=$khoa;
            $data["khoa_result"]=$khoa_result;
            
            $data["ctdt_result"]=$ctdt_result;            
            $data["title"]="Trang quản lý chương trình đào tạo";        
           // echo "<pre>";
           // print_r($ctdt_result);
          //echo "</pre>";
          
    		$this->load->view('admin/vctdt',$data);  
            
              
        
   	}
//==========THONG TIN CHI TIET VE CHUONG TRINH DAO TAO THEO KHOA, K=======================================================================    
    public function detail($khoa,$k)
	{       //get khoa make menu
            $khoa_result=$this->mctdt->get_khoa();
            $k_result=$this->mctdt->get_K();
            //get data to dump into table
            $ctdt_result=$this->mctdt->get_ctdt("",$khoa,$k);//lay danh sach sinh vien cac khoa, thuoc cac k, 15 record dau tien
           
            
               
            //data for view
                        
            $data["khoa"]=$khoa;
            $data["k"]=$k;
            $data["tenkhoa"]=$this->mctdt->ten_khoa($khoa);
            $data['data_title']="Chương trình đào tạo khoa ".$this->mctdt->ten_khoa($khoa);         
            $data["somon"]=count($ctdt_result);//so mon trong k
            $data["sotc"]=$this->mctdt->get_sotc($khoa,$k);//so tinh chi trong k
            $data["sohk"]=$this->mctdt->get_sohk($khoa,$k);
            $data["socn"]=$this->mctdt->get_socn($khoa,$k);
            $data["khoa_result"]=$khoa_result;
            $data["K_result"]=$k_result;
                      
            $data["title"]="Trang quản lý chương trình đào tạo";        
            //echo "<pre>";
          //  print_r($ctdt_result);
        //    echo "</pre>";
    		$this->load->view('admin/vctdt_detail',$data);         
   	}
//=====THAO TAC AJAX TAO CHUYEN NGANH CHO KHOA,K=================================================================    
    public function ajax_create_chuyennganh()
    {
        $khoa=$this->input->post("khoa");
        $k=$this->input->post("k");
        $socn=$this->input->post("socn");
        $tencn_array=$this->input->post("tencn_array");
        
        for($i=1;$i<=$socn;$i++)
        {
            $macn=$khoa."_".$k."_".$i;
            $tencn=$tencn_array[$i-1];
            $data["MaCN"]=$macn;
            $data["MaKhoa"]=$khoa;
            $data["MaK"]=$k;
            $data["TenCN"]=$tencn;
            $this->db->insert("chuyennganh",$data);
        }
        echo "success";
    }
    
//=====THAO TAC AJAX TAO CHUYEN NGANH CHO KHOA,K=================================================================    
    public function ajax_add_chuyennganh()
    {
        $khoa=$this->input->post("khoa");
        $k=$this->input->post("k");
        $tencn=$this->input->post("tencn");        
        $last_macn=$this->mctdt->get_last_macn($khoa,$k);
        
        if($last_macn=="") $i=1;
        else
        {
            //echo $last_macn;
            $arr=explode("_",$last_macn);
            $i= (int)$arr[2]+1;
            //echo $i;    
        }
        if($this->mctdt->is_tencn_exist($tencn)) echo "Tên chuyên ngành đã tồn tại. Vui lòng chọn tên khác";
        else
        {
        $macn=$khoa."_".$k."_".$i;           
        $data["MaCN"]=$macn;
        $data["MaKhoa"]=$khoa;
        $data["MaK"]=$k;
        $data["TenCN"]=$tencn;
        $this->db->insert("chuyennganh",$data);
        echo "success";
        }
    }

//=====THAO TAC AJAX HUY CHUYEN NGANH CHO KHOA,K=================================================================    
    public function ajax_delete_chuyennganh()
    {
        
        $macn=$this->input->post("macn");
        $this->db->where("MaCN",$macn);
        $this->db->delete("chuyennganh");
        echo "success";
    }    
    
    
//==========AJAX SO TC==================================================================================================================    
    public function ajax_sotc()
    {
        
        $khoa=$this->input->post("khoa");
        $k=$this->input->post("k");
        $sotc=$this->mctdt->get_sotc($khoa,$k);        
        echo $sotc;
    
      
    }//end ajax_full_data
//==========AJAX k from khoa==================================================================================================================      
    public function ajax_k_from_khoa()
    {
        
        $khoa=$this->input->post("khoa");   
             
        $result=$this->mctdt->get_K_empty($khoa);
        foreach($result as $row)
        {          
           echo "<option  value='".$row->MaK."'>".$row->TenK."</option>";
                               
        }
    }
//==========AJAX K EXIST FROM KHOA==================================================================================================================      
     public function ajax_k_exist_from_khoa()
    {
        
        $khoa=$this->input->post("khoa");   
             
        $result=$this->mctdt->get_K_exist($khoa);
        foreach($result as $row)
        {          
           echo "<option  value='".$row->MaK."'>".$row->TenK."</option>";
                               
        }
    }
//==========AJAX SO MON==================================================================================================================      
     public function ajax_somon()
    {
        
        $khoa=$this->input->post("khoa");
        $k=$this->input->post("k");
        
        //echo $search." ".$start." ".$limit;
       //get a record of masv OR all follow each $khoa,$k,$start and $limit
        $somon=$this->mctdt->get_somon($khoa,$k);        
        echo $somon;
    
      
    }//end ajax_full_data
    
//==============================================UPDATE MONHOC CHO CHUONG TRINH DAO TAO==========================================================================================================================================      
   public function ajax_update()
   {   
            $id_array=$this->input->post("id_array"); 
            $khoa=$this->input->post("khoa"); 
            $k=$this->input->post("k");
            $hk=$this->input->post("hk");
            
            
            $this->db->trans_start();
            $this->mctdt->delete_monhoc_ctdt($khoa,$k,$hk,$id_array);
            $this->mctdt->insert_monhoc_ctdt($khoa,$k,$hk,$id_array);
            $this->db->trans_complete();
           
     
   }//end ajax_update
   
   
   //==============================================UPDATE MONHOC CHO CHUYEN NGANH==========================================================================================================================================      
   public function ajax_update_monhoc_chuyennganh()
   {   
            $id_array=$this->input->post("id_array"); 
            
            $macn=$this->input->post("macn");
            
            
            $this->db->trans_start();
            $this->mctdt->delete_monhoc_chuyennganh($macn);
            $this->mctdt->insert_monhoc_chuyennganh($macn,$id_array);
            $this->db->trans_complete();
           
     
   }//end ajax_update
   
//==============================================INSERT CTDT MOI====================================================================================================================================================    
   public function ajax_insert()
   {
            $this->load->library("form_validation");
            $this->form_validation->set_rules('sohk', 'Số học kỳ', 'required|is_natural_no_zero');            
            
            if($this->form_validation->run() ==false)
            {
                //echo validation_errors();
                echo "<tr><td></td></tr>";
                echo "<tr><td></td></tr>";
                echo "<tr><td>".form_error("sohk","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
               
            } 
            else 
            {
               $khoa=$this->input->post("khoa");
               $data["MaKhoa"]=$khoa;               
               $data["MaK"]=$this->input->post("k");               
               $data["SoHK"]=$this->input->post("sohk");
               $this->mctdt->insert_ctdt($data);
               echo "success";
            }
    
     
   }//end ajax insert
//==============THAO TAC SAO CHEP CHUONG TRINH DAO TAO========================================================================================   
    public function ajax_copy()
   {
               $khoa_new=$this->input->post("khoa_new");
               $khoa_old=$this->input->post("khoa_old");
               
               $k_new=$this->input->post("k_new");
               $k_old=$this->input->post("k_old");
               
              // echo $khoa_new." ".$k_new." ".$khoa_old." ".$k_old;
               $ctdt_old=$this->mctdt->get_ctdt("",$khoa_old,$k_old);
               $data=array();
               foreach($ctdt_old as $row)
               {
                    $tempt=array();
                    $tempt["ID"]=$row->ID;
                    $tempt["HK"]=$row->HK;
                    $tempt["K"]=$k_old;
                    
                    $data[]=$tempt;
               }
              // echo "<pre>";
               //print_r($data);
               //echo "</pre>";
               
               $this->mctdt->import_ctdt($khoa_new,$k_new,$data);
               echo "success";
           
   }//end ajax insert
//==============================================DELETE CTDT====================================================================================================================================================   
   public function ajax_delete()
   {
        $k_array=$this->input->post("k_array");
        $khoa=$this->input->post("khoa");
        $this->mctdt->delete_ctdt($k_array,$khoa);
   }



//==============================================DIEU CHINH CHUONG TRINH DAO TAO====================================================================================================================================================
    function dieuchinh($khoa,$k,$hk=0)
    {
         //get khoa make menu
            $khoa_result=$this->mctdt->get_khoa();
            $k_result=$this->mctdt->get_K();
            //get data to dump into table
            $ctdt_result=$this->mctdt->get_ctdt("",$khoa,$k,$hk);//lay danh sach monhoc cac khoa, thuoc cac k
            $monhoc_result=$this->mctdt->get_monhoc_empty($khoa,$k);//lay danh sach mon hoc con lai
            $loai_monhoc_result=$this->mctdt->get_loai_monhoc();
            
            $data['data_title']="Thao tác điều chỉnh chương trình đào tạo";
            
            //data for view
                        
            $data["khoa"]=$khoa;
            
           $data["tenkhoa"]=$this->mctdt->ten_khoa($khoa);
            $data["k"]=$k;
            $data["hk"]=$hk;
            
            $data["somon"]=count($ctdt_result);
            $data["sotc"]=$this->mctdt->get_sotc($khoa,$k,$hk);
            $data["sohk"]=$this->mctdt->get_sohk($khoa,$k,$hk);
            
            $data["khoa_result"]=$khoa_result;            
            $data["K_result"]=$k_result;
            $data["loai_monhoc_result"]=$loai_monhoc_result;
            $data["monhoc_result"]=$monhoc_result;
            $data["ctdt_result"]=$ctdt_result;
            
            $data["title"]="Trang điều chỉnh chương trình đào tạo";        
            //echo "<pre>";
          //  print_r($ctdt_result);
        //    echo "</pre>";
    		$this->load->view('admin/vctdt_edit',$data); 
    }

//==============================================DIEU CHINH CHUONG TRINH DAO TAO====================================================================================================================================================
    function dieuchinhchuyennganh($macn)
    {
           $arr=explode("_",$macn);
           $khoa=$arr[0];
           $k=$arr[1];
         //get khoa make menu
            $khoa_result=$this->mctdt->get_khoa();            
            //get data to dump into table
            $ctdt_result=$this->mctdt->get_monhoc_chuyennganh($macn);//lay danh sach monhoc thuoc chuyen nganh $macn
            $monhoc_result=$this->mctdt->get_monhoc_chuyennganh_empty($macn);//lay danh sach mon hoc con lai
            $loai_monhoc_result=$this->mctdt->get_loai_monhoc();//make button
            
            $data['data_title']="Thao tác điều chỉnh chuyên nghành";
            
            //data for view
            $data["macn"]=$macn;
            $data["tencn"]=$this->mctdt->ten_chuyennganh($macn);                        
            $data["khoa"]=$khoa;            
            $data["tenkhoa"]=$this->mctdt->ten_khoa($khoa);
            $data["k"]=$k;
            $data["somon"]=count($ctdt_result);
            
            
            $data["khoa_result"]=$khoa_result; 
            $data["loai_monhoc_result"]=$loai_monhoc_result;
            $data["monhoc_result"]=$monhoc_result;
            $data["ctdt_result"]=$ctdt_result;
            
            $data["title"]="Trang điều chỉnh chuyên ngành chương trình đào tạo";        
            //echo "<pre>";
          //  print_r($ctdt_result);
        //    echo "</pre>";
    		$this->load->view('admin/vctdt_chuyennganh_edit',$data); 
    }    

    
//======================THAO TAC XOA MON HOC TRONG HOC KY================================================================================================
    function xoa_hocky($khoa,$k,$hk=0)
    {
            $this->mctdt->xoa_monhoc_ctdt($khoa,$k,$hk);
            header("location:/quanly/chuong-trinh-dao-tao/$khoa/$k");
    }
        
   

//===========================THAO TAC THEM CTDT==========================================================================================================
    function themctdt($khoa="CNPM",$k=4)
    {
        $khoa_result=$this->mctdt->get_khoa();
        $k_result=$this->mctdt->get_K_empty($khoa);//lay k chua co ctdt
        
        $data["khoa_result"]=$khoa_result;
        $data["k_result"]=$k_result;
        $data["khoa"]=$khoa;
        $data["k"]=$k;
        $data['data_title']="Thao tác thêm chương trình đào tạo";
        
        $data["title"]="Trang thêm chương trình đào tạo";  
        $this->load->view("admin/vctdt_add",$data);   
    }
//===========================THAO TAC SAO CHEP CTDT=================================================================================================    
   function saochepctdt($khoa="CNPM",$k=4)
    {
        
        $khoa_result=$this->mctdt->get_khoa();
        $k_empty_result=$this->mctdt->get_K_empty($khoa);//lay k chua co ctdt
        $k_exist_result=$this->mctdt->get_K_exist($khoa);
        $data["khoa_result"]=$khoa_result;
        $data["k_empty_result"]=$k_empty_result;
        $data["k_exist_result"]=$k_exist_result;
        $data["khoa"]=$khoa;
        $data["k"]=$k;
        $data['data_title']="Thao tác sao chép chương trình đào tạo";
        
        $data["title"]="Trang thêm chương trình đào tạo";  
        $this->load->view("admin/vctdt_add_copy",$data);   
    }
//==============================================NHAP DU LIEU CHUONG TRINH DAO TAO====================================================================================================================================================
   //them sv page
   function nhapdl($khoa_active="CNPM",$k_active=4)
    {
        $this->load->helper("url");
        $this->load->library("form_validation");        
        $this->form_validation->set_rules("khoa","Khoa","required");
        $this->form_validation->set_rules("file_upload","Tập tin","callback_exist_file");              
        if($this->form_validation->run())
        {            
            $file_data=$this->upload->data();
            $khoa=$this->input->post("khoa");
            $k=$this->input->post("k");
            
           // echo $import_type." ".$khoa;
            
            try
            {
                $ctdt_array=$this->read_import_file($file_data,$k);  //doc du lieu tu file  
                $num_errors=$this->check_error_data($ctdt_array,$khoa,$k);//kiem tra trung ID, va ID exist
                
                //LOI=============================================================================================
                if($num_errors>0) 
                {                    
                    $khoa_result=$this->mctdt->get_khoa();
                    $k_result=$this->mctdt->get_K();//lay k chua co ctdt
                    
                    $data["khoa_result"]=$khoa_result;
                    $data["k_result"]=$k_result;
                    
                    $data["khoa"]=$khoa;                    
                    $data["k"]=$k;
                    $data["error_data"]=$ctdt_array;
                    $data["num_errors"]=$num_errors;                   
                    
                    $data['data_title']="Thao tác nhập dữ liệu khoa ".$this->mctdt->ten_khoa($khoa)." <img src='".static_url()."/images/delete.png' title='Thao tác nhập dữ liệu thât bại' />";
                        
                    
                    
                    $data["title"]="Trang nhập dữ liệu";
                    
                    $this->load->view("admin/vctdt_import_error",$data);    
                }
                //=OK IMPORT INTO DATA======================================================================================
                else
                {                    
                    $this->mctdt->import_ctdt($khoa,$k,$ctdt_array);
                    $khoa_result=$this->mctdt->get_khoa();                    
                    $k_result=$this->mctdt->get_K();//lay k chua co ctdt
                    
                    $data["khoa_result"]=$khoa_result;
                    $data["k_result"]=$k_result;
                    $data["khoa"]=$khoa;
                    $data["TenKhoa"]=$this->mctdt->ten_khoa($khoa);
                    $data["k"]=$k;
                    $data["success_data"]=$ctdt_array;
                    $data["num_success"]=count($ctdt_array);
                    $data['right_title']="Thao tác nhập dữ liệu <img title='Thao tác nhập dữ liệu thành công' src='".static_url()."/images/ok.png' />";
                     
                    $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vctdt_import_success",$data);
                    
                    
                   // echo"<pre>";
                   // print_r($ctdt_array);
                   // print_r($file_data);
                   // echo $num_errors;
                   // echo"</pre>";
                       
                   
                } 
            }
            catch(exception $ex)//xuat hien loi
            {
                $khoa_result=$this->mctdt->get_khoa();                 
                 $k_result=$this->mctdt->get_K();//lay k chua co ctdt
                    
                 $data["khoa_result"]=$khoa_result;
                 $data["k_result"]=$k_result;
                 $data["khoa"]=$khoa;
                 $data["k"]=$k;
                 $data['data_title']="Thao tác nhập dữ liệu chương trình đào tạo";
                    
                 $data["title"]="Trang nhập dữ liệu chương trình đào tạo"; 
                
                $data["error_array"]="Lỗi khi đọc tập tin";
                $data["error_data"]=array();
                $data["num_errors"]=0;
               
                $data['right_title']="Thao tác nhập dữ liệu từ tập tin";  
                $data["title"]="Trang nhập dữ liệu";  
                $this->load->view("admin/vctdt_import_error",$data); 
                
            }
            
            
             
           
        }
        else//load binh thuong khong co form run
        {
            $khoa_result=$this->mctdt->get_khoa();
            $k_result=$this->mctdt->get_K();//lay k chua co ctdt
            
            $data["khoa_result"]=$khoa_result;
            $data["k_result"]=$k_result;
            $data["khoa"]=$khoa_active;
            $data["k"]=$k_active;
            $data['data_title']="Thao tác nhập dữ liệu chương trình đào tạo";
            
            
            $data["title"]="Trang nhập dữ liệu chương trình đào tạo";  
            $this->load->view("admin/vctdt_import",$data);    
        }
           
    }//END IMPORT FROM FILE  
    
    
      
//==============================================XUAT DU LIEU=================================================================================================================================================    
    function xuatdl()
	{  
	   
           $khoa=$this->input->post("khoa");
           $k=$this->input->post("k");
           $file=$this->input->post("file");
           //echo $khoa." ".$k." ".$file;
           $this->form_validation->set_rules("file","File","required");
           if($this->form_validation->run())
            {
    //=================================================CSV================================================================================================================================================      
                if($file=="CSV")
                {
                    $objPHPExcel = new PHPExcel();
                    
                    
                    $ctdt_result=$this->mctdt->get_ctdt("",$khoa,$k);
                    $fields=array("HK","MaMH","TenMH","SoTC","TCLT","TCTH","TenLoai","KieuMH");
                    $ncol=0;
                    $nrow=1;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);    
                    
                    foreach($ctdt_result as $row)
                    {
                        //$sheet_dsmh->setCellValueByColumnAndRow(0,$nrow,$row->ID);  
                        $sheet_dsmh->setCellValueByColumnAndRow(0,$nrow,$row->HK);                                              
                        $sheet_dsmh->setCellValueByColumnAndRow(1,$nrow,$row->MaMH);
                        $sheet_dsmh->setCellValueByColumnAndRow(2,$nrow,$row->TenMH);
                        $sheet_dsmh->setCellValueByColumnAndRow(3,$nrow,$row->SoTC);
                        $sheet_dsmh->setCellValueByColumnAndRow(4,$nrow,$row->TCLT);
                        $sheet_dsmh->setCellValueByColumnAndRow(5,$nrow,$row->TCTH);                        
                        $sheet_dsmh->setCellValueByColumnAndRow(6,$nrow,$row->TenLoai);
                        $sheet_dsmh->setCellValueByColumnAndRow(7,$nrow,$row->KieuMH);
                        //$sheet_dsmh->setCellValueByColumnAndRow(8,$nrow,$row->HK);
                        $nrow++; 
                        
                        
                    }
                   
                    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                    $objPHPExcel->setActiveSheetIndex(0);
                    $filename="Danh_Sach_MH_".$khoa."_".$k;
                    header('Content-Type: text/csv');
                    header('Content-Disposition: attachment;filename="'.$filename.'.csv"');
                    header('Cache-Control: max-age=0');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
                    $objWriter->setDelimiter(',');
                    $objWriter->setEnclosure('');
                    $objWriter->setLineEnding("\r\n");
                    $objWriter->setSheetIndex(0);
                    
                    $objWriter->save('php://output');
                    exit();
                }
                
                
    //============================================EXCEL 2003============================================================================================================           
                else if($file=="EXCEL2003")
                {
                    
                    $objPHPExcel = new PHPExcel();
                    // Add some data
                    $ctdt_result=$this->mctdt->get_ctdt("",$khoa,$k);
                    $fields=array("HK","MaMH","TenMH","SoTC","TCLT","TCTH","TenLoai","KieuMH");
                    $ncol=0;
                    $nrow=2;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);
            //======TITLE============================================================================================================            
                    $sheet_dsmh->getCell("A1")->setValue("Học Kỳ"); 
                    $sheet_dsmh->getColumnDimension('A')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("B1")->setValue("Mã Môn Học"); 
                    $sheet_dsmh->getColumnDimension('B')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("C1")->setValue("Tên Môn Học");        
                    $sheet_dsmh->getColumnDimension('C')->setWidth(35);
                    
                    $sheet_dsmh->getCell("D1")->setValue("Số Tín Chỉ");
                    $sheet_dsmh->getColumnDimension('D')->setWidth(12);
                    
                    
                    $sheet_dsmh->getCell("E1")->setValue("Tín Chỉ LT");
                    $sheet_dsmh->getColumnDimension('E')->setWidth(12);
                    
                    $sheet_dsmh->getCell("F1")->setValue("Tín Chỉ TH");
                    $sheet_dsmh->getColumnDimension('F')->setWidth(12);
                    
                    $sheet_dsmh->getCell("G1")->setValue("Loại Môn Học");
                    $sheet_dsmh->getColumnDimension('G')->setWidth(20);
                    
                    $sheet_dsmh->getCell("H1")->setValue("Kiểu Môn Học");
                    $sheet_dsmh->getColumnDimension('H')->setWidth(20);
                    
                    //$sheet_dsmh->getCell("I1")->setValue("Học kỳ");
                    //$sheet_dsmh->getColumnDimension('I')->setWidth(10);
                    
                    $sheet_dsmh->getStyle("A1:H1")->getFont()->setSize(12)->setBold(true);
            //======DATA============================================================================================================            
                    foreach($ctdt_result as $row)
                    {
                        $ncol=0;
                        foreach($fields as $field)
                        {
                            if($field=="KieuMH" && $row->$field=="DON")$sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("Đơn");
                            else if($field=="KieuMH" && $row->$field=="NHOM") $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("Nhóm");
                            else $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue($row->$field);
                            $ncol++;
                        }                
                        $nrow++;
                    }
                    // Rename worksheet
                    $objPHPExcel->getActiveSheet()->setTitle('DSMH_'.$khoa.'_'.$k);
                    
                    
                    $objPHPExcel->setActiveSheetIndex(0);
                    $filename="Danh_Sach_MH_".$khoa.'_'.$k;
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
                    header('Cache-Control: max-age=0');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                    $objWriter->save('php://output');
                    exit();
                    
                }//END 2003 OUTPUT
                
                
                
                
//==============================================EXCEL 2007===================================================================================================================================            
                else if($file=="EXCEL2007")
                {
                    
                    $objPHPExcel = new PHPExcel();
                    // Add some data
                    $ctdt_result=$this->mctdt->get_ctdt("",$khoa,$k);
                    $fields=array("HK","MaMH","TenMH","SoTC","TCLT","TCTH","TenLoai","KieuMH");
                    $ncol=0;
                    $nrow=2;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);
            //======TITLE============================================================================================================            
                    $sheet_dsmh->getCell("A1")->setValue("Học Kỳ"); 
                    $sheet_dsmh->getColumnDimension('A')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("B1")->setValue("Mã Môn Học"); 
                    $sheet_dsmh->getColumnDimension('B')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("C1")->setValue("Tên Môn Học");        
                    $sheet_dsmh->getColumnDimension('C')->setWidth(35);
                    
                    $sheet_dsmh->getCell("D1")->setValue("Số Tín Chỉ");
                    $sheet_dsmh->getColumnDimension('D')->setWidth(12);
                    
                    
                    $sheet_dsmh->getCell("E1")->setValue("Tín Chỉ LT");
                    $sheet_dsmh->getColumnDimension('E')->setWidth(12);
                    
                    $sheet_dsmh->getCell("F1")->setValue("Tín Chỉ TH");
                    $sheet_dsmh->getColumnDimension('F')->setWidth(12);
                    
                    $sheet_dsmh->getCell("G1")->setValue("Loại Môn Học");
                    $sheet_dsmh->getColumnDimension('G')->setWidth(20);
                    
                    $sheet_dsmh->getCell("H1")->setValue("Kiểu Môn Học");
                    $sheet_dsmh->getColumnDimension('H')->setWidth(20);
                    
                    //$sheet_dsmh->getCell("I1")->setValue("Học kỳ");
                    //$sheet_dsmh->getColumnDimension('I')->setWidth(10);
                    
                    $sheet_dsmh->getStyle("A1:H1")->getFont()->setSize(12)->setBold(true);
            //======DATA============================================================================================================            
                    foreach($ctdt_result as $row)
                    {
                        $ncol=0;
                        foreach($fields as $field)
                        {
                            if($field=="KieuMH" && $row->$field=="DON")$sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("Đơn");
                            else if($field=="KieuMH" && $row->$field=="NHOM") $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("Nhóm");
                            else $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue($row->$field);
                            $ncol++;
                        }                
                        $nrow++;
                    }
                    // Rename worksheet
                    $objPHPExcel->getActiveSheet()->setTitle('DSMH_'.$khoa.'_'.$k);
                    
                    
                    $objPHPExcel->setActiveSheetIndex(0);
                    $filename="Danh_Sach_MH_".$khoa.'_'.$k;
                    
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
                    header('Cache-Control: max-age=0');                
                    
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    $objWriter->save('php://output');
                    exit();
                }//END 2007 OUTPUT
                
            }
            else
            {
                $khoa_result=$this->mctdt->get_khoa();
                $data["khoa_result"]=$khoa_result;
        
                $data["title"]="Trang xuất dữ liệu";  
                $this->load->view("admin/vctdt_export",$data);   
                  
            }
	    
        
   	}//END EXPORT DATA
 //================================================THONG KE==================================================================================================================================================
    public function count_sv($khoa="tatca",$k=0)
    {
         return $this->mctdt->get_num_rows("",$khoa,$k);
    }
    public function thongke()
    {
        $khoa_result=$this->mctdt->get_khoa();
        $K_result=$this->mctdt->get_K();
         $SL["total"]=$this->mctdt->get_num_rows();
        foreach($khoa_result as $row)
        {
            $SL[$row->MaKhoa][0]=$this->mctdt->get_num_rows("",$row->MaKhoa);
            foreach($K_result as $k_row)
            {                
                $SL[$row->MaKhoa][$k_row->MaK]=$this->mctdt->get_num_rows("",$row->MaKhoa,$k_row->MaK);
            }
        }
       // echo "<pre>";
        // print_r($SL);
       // echo "</pre>";
        
        $data["khoa_result"]=$khoa_result;
        $data["K_result"]=$K_result;
        $data["SL"]=$SL;
        $data["title"]="Trang thống kê tổng quát sinh viên";
        $data["data_title"]="Thống kê tổng quát";    
        $this->load->view("admin/vctdt_statistic",$data); 
          
    }
//============VALID MONHOC WHEN IMPORT==============================================================================================================    
    //dem so loi sinh ra
    public function check_error_data($data,$khoa,$k)
    {
        $num_errors=0;
        $array_unique=array();
        foreach($data as $row)
        {
            //valid_monhoc kiem tra monhoc co hop le hay ko?true/false
                $id=$row["ID"];//lay id cua mon hoc nay
                $mamh=$row["MaMH"];
                $tenmh=$row["TenMH"];
                $hk=$row["HK"];
                $monhoc["MaMH"]=$mamh;
                $monhoc["TenMH"]=$tenmh;
                
                if($id==0) 
                {
                    $num_errors++;//mon hoc khong ton tai
                }
                else
                {
                    $is_valid_monhoc=$this->mctdt->valid_monhoc($id,$monhoc,$array_unique,$khoa,$k);//true -> OK
                    $is_valid_hk=$this->mctdt->valid_hk($hk,$khoa,$k);//true -> OK
                    if($is_valid_monhoc==false||$is_valid_hk==false) $num_errors++;                    
                    
                }
                $array_unique[]=$monhoc;    
            
        }
        return $num_errors;
    }
//============VALID FILE_UPLOAD WHEN IMPORT==============================================================================================================
    public function exist_file()
       {   
           if($_FILES["file_upload"])
            {
                $config["upload_path"]="C:\\xampp\\htdocs\\dkhp\\application\\uploads";
                $config["allowed_types"]="xls|xlsx|csv";
                $config["max_size"]="2048";
                $config["file_name"]="upload_file";                
                $config["max_filename"]="30";
                $config["overwrite"]=true;
                $this->load->library("upload",$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload("file_upload"))
                {                      
                    return true;
                }
                else
                {
                    $error=$this->upload->display_errors("<span title='Thông báo lỗi'>","</span>");
                    $this->form_validation->set_message("exist_file",$error);
                    return false;
                }
            }
            else
            {
                $this->form_validation->set_message("exist_file","<span title='Thông báo lỗi'> Hãy chọn tập tin.</span>");
                return false;
            }
            
       }
//==========================CALLBACK OF FORM VALIDATTION==========================================================================================================================
  public function check_mssv($new_mssv,$old_mssv)
   {
        if($new_mssv!=$old_mssv)
        {
            if($this->mctdt->mssv_exist($new_mssv)) 
            {
                $this->form_validation->set_message("check_mssv","<span title='Thông báo lỗi'><b style='color:red'>".$new_mssv."</b> đã tồn tại.</span>");
                return false;   
            }
            else return true;
        }
        else return true;
   }
   public function read_import_file($file_data,$k)   
   {
        $file_name=$file_data["file_name"];
        $full_name=$file_data["full_path"];
        $file_ext=$file_data["file_ext"];
            
            
        $objPHPExcel = new PHPExcel();
        $monhoc_array=array();  
        
   
            if($file_ext==".csv")
            {                                    
                $inputFileType = 'CSV';
                    
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);                 
                $objReader->setDelimiter(',');
                $objReader->setEnclosure('');
                $objReader->setLineEnding("\r\n");
                $objReader->setSheetIndex(0);                
                    
                    
                    
                $objPHPExcel = $objReader->load($full_name);
    
                $str_col= $objPHPExcel->getActiveSheet()->getHighestColumn();
                $num_col=PHPExcel_Cell::columnIndexFromString($str_col);
                $num_row=$str_row=$objPHPExcel->getActiveSheet()->getHighestRow();
                    
                    
                    
                                  
                          
                for($row_index=1;$row_index<=$num_row;$row_index++)
                {
                        //$ID=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $HK=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $MaMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                        $TenMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                        $monhoc["MaMH"]=$MaMH;
                        $monhoc["TenMH"]=$TenMH;             
                        $id=$this->mctdt->get_id($monhoc);  
                        
                        $SoTC=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                        $TCLT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                        $TCTH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();
                        $Loai=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();
                        $KieuMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7,$row_index)->getValue();    
                        if($Loai=="Đại Cương") $Loai="DC";
                        else $Loai="CN"; 
                        
                        if($KieuMH=="Đơn") $KieuMH="DON";
                        else $KieuMH="NHOM";       
                                                   
                        $tempt=array("ID"=>$id,
                                    "MaMH"=>$MaMH,
                                    "TenMH"=>$TenMH,
                                    "SoTC"=>$SoTC,
                                    "TCLT"=>$TCLT,
                                    "TCTH"=>$TCTH,
                                    "Loai"=>$Loai,
                                    "KieuMH"=>$KieuMH,
                                    "HK"=>$HK,
                                    "K"=>$k);                                  
                        $monhoc_array[]=$tempt;
                        
                }//end for
            }//end extension .csv
            
            else if($file_ext==".xls")
                {
                    $inputFileType = 'EXCEL5';
                    
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($full_name);
                    
                    $str_col= $objPHPExcel->getActiveSheet()->getHighestColumn();
                    $num_col=PHPExcel_Cell::columnIndexFromString($str_col);
                    $num_row=$str_row=$objPHPExcel->getActiveSheet()->getHighestRow();
                    
                    
                    
                    $monhoc_array=array();                
                          
                    for($row_index=2;$row_index<=$num_row;$row_index++)
                    {   
                        //$ID=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $HK=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $MaMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                        $TenMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                        $monhoc["MaMH"]=$MaMH;
                        $monhoc["TenMH"]=$TenMH;             
                        $id=$this->mctdt->get_id($monhoc);  
                        
                        $SoTC=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                        $TCLT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                        $TCTH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();
                        $Loai=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();
                        $KieuMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7,$row_index)->getValue();    
                        if($Loai=="Đại Cương") $Loai="DC";
                        else $Loai="CN"; 
                        
                        if($KieuMH=="Đơn") $KieuMH="DON";
                        else $KieuMH="NHOM";       
                                                   
                        $tempt=array("ID"=>$id,
                                    "MaMH"=>$MaMH,
                                    "TenMH"=>$TenMH,
                                    "SoTC"=>$SoTC,
                                    "TCLT"=>$TCLT,
                                    "TCTH"=>$TCTH,
                                    "Loai"=>$Loai,
                                    "KieuMH"=>$KieuMH,
                                    "HK"=>$HK,
                                    "K"=>$k);                                  
                        $monhoc_array[]=$tempt;
                       
                    }//end for
                
                }//end extension .xls
                else//word 2007
                {
                    $inputFileType = 'EXCEL2007';
                    
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($full_name);
                    
                    $str_col= $objPHPExcel->getActiveSheet()->getHighestColumn();
                    $num_col=PHPExcel_Cell::columnIndexFromString($str_col);
                    $num_row=$str_row=$objPHPExcel->getActiveSheet()->getHighestRow();
                    $monhoc_array=array();                
                          
                   for($row_index=2;$row_index<=$num_row;$row_index++)
                    {   
                        //$ID=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $HK=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $MaMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                        $TenMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                        $monhoc["MaMH"]=$MaMH;
                        $monhoc["TenMH"]=$TenMH;             
                        $id=$this->mctdt->get_id($monhoc);  
                        
                        $SoTC=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                        $TCLT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                        $TCTH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();
                        $Loai=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();
                        $KieuMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7,$row_index)->getValue();    
                        if($Loai=="Đại Cương") $Loai="DC";
                        else $Loai="CN"; 
                        
                        if($KieuMH=="Đơn") $KieuMH="DON";
                        else $KieuMH="NHOM";       
                                                   
                        $tempt=array("ID"=>$id,
                                    "MaMH"=>$MaMH,
                                    "TenMH"=>$TenMH,
                                    "SoTC"=>$SoTC,
                                    "TCLT"=>$TCLT,
                                    "TCTH"=>$TCTH,
                                    "Loai"=>$Loai,
                                    "KieuMH"=>$KieuMH,
                                    "HK"=>$HK,
                                    "K"=>$k);                                  
                        $monhoc_array[]=$tempt;
                       
                    }//end for
                    
                }//edn els
            return $monhoc_array;
    
   }//end read file
}//end CONTROLLER SINHVIEN
?>
