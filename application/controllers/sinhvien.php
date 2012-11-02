<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sinhvien extends CI_Controller {
    var $file_upload_ext="";

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");        
        $this->load->model("admin/msinhvien");
        $this->load->library('PHPExcel');
        
    }
	public function index($khoa="CNPM")
	{       //get khoa make menu
            $khoa_result=$this->msinhvien->get_khoa();
            //get data to dump into table
            $sinhvien_result=$this->msinhvien->get_sinhvien("",$khoa,0,0,15);//lay danh sach sinh vien cac khoa, thuoc cac k, 15 record dau tien
           
            
            $data['data_title']="Danh sách sinh viên khoa ".$this->msinhvien->ten_khoa($khoa);
            
            
            //tong so hang de tao phan trang
            $num_rows=$this->msinhvien->get_num_rows("",$khoa);
            
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/sinhvien/ajax_full_data";
            $config["total_rows"]=$num_rows;
            $config["per_page"]=15;
            $this->pagination->initialize($config);
            $data["pagination"]=$this->pagination->create_links();
            //data for view
            $data["khoa_result"]=$khoa_result;
            $data["khoa"]=$khoa;
            $data["sinhvien_result"]=$sinhvien_result;
            $data["total_rows"]=$num_rows;
            $data["title"]="Trang quản lý sinh viên";        
            
    		$this->load->view('admin/vsinhvien',$data);  
              
        
   	}
        
//DANH SACH SINHVIEN====================================================================================================================================================
    //ajax load lai datas
    public function ajax_full_data($start=0)
    {
        
        $khoa=$this->input->post("khoa");
        $k=$this->input->post("k");
        $limit=$this->input->post("limit");        
        $search=$this->input->post("search");
        
       //get a record of masv OR all follow each $khoa,$k,$start and $limit
        $sinhvien_result=$this->msinhvien->get_sinhvien($search,$khoa,$k,$start,$limit);        
        $count_rows=count($sinhvien_result);
        
        if($count_rows>0)
        {
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/sinhvien/ajax_full_data";
            $config["total_rows"]=$this->msinhvien->get_num_rows($search,$khoa,$k);
            
            $config["per_page"]=$limit;
            $this->pagination->initialize($config);
            
          
            echo "<div id='pagination' class='".$config["total_rows"]."'>";
            echo $this->pagination->create_links();
		    echo "</div><!--end #pagintion -->";
            
            //make table data	
            echo '<div id="scroll">';
            echo ' <table id="table_data">
            <tr id="first">
                <th id="textbox"></th>
                <th id="mssv"></th>
                <th id="tensv"></th>                
                <th id="lop"></th>
                <th id="k"></th>
                <th id="ngaysinh"></th>
                <th id="noisinh"></th>
                <th id="sdt"></th>
                <th id="email"></th>
            </tr>';            
             foreach($sinhvien_result as $row)
             {
                $khoa=$this->msinhvien->get_sv_table($row->MaSV);
                echo "<tr id='$khoa'>";
                echo "<td><input id='".$row->MaSV."' class='checkbox_row' type='checkbox' /></td>";
                echo "<td class='masv' title='Sửa đổi'>".$row->MaSV."</td>";
                echo "<td class='tensv' style='text-align:left' >".$row->TenSV."</td>";                
                echo "<td class='lop'>".$row->Lop."</td>";
                echo "<td class='k'>".$row->K."</td>";
                echo "<td class='ngaysinh'>".$row->NgaySinh."</td>";
                echo "<td class='noisinh'>".$row->NoiSinh."</td>";
                echo "<td class='sdt'>".$row->SDT."</td>";
                echo "<td class='email' title='".$row->email."'>".$row->email."</td>";
                echo "</tr>";
             }
                             
            echo '</table><!--end #table_data -->';
            echo '</div><!--end #scroll -->';
            
        }
        else echo "Dữ liệu trống.";
    
      
    }//end ajax_full_data
    
//==============================================DATA POPUP======================================================================================================   
    //tra ve 1 record sinh vien theo masv
    public function ajax_data()
   {

        $masv=$this->input->post("masv");
        $khoa=$this->input->post("khoa");
        $data_result=$this->msinhvien->get_sinhvien($masv,$khoa);
        $khoa_result=$this->msinhvien->get_khoa();
        if(count($data_result)>0)
        {
            foreach($data_result as $row)
            {   
                echo "<table class='info' id='". $row->MaSV."'>";
                echo "<tr><td>MSSV</td>
                          <td><input  name='masv'  id='masv'  type='text' title='MSSV gồm 8 kí tự' value='". $row->MaSV."'/></td>
                          </tr>";
                echo "<tr><td>Họ Tên</td><td><input  name='tensv' id='tensv' type='text' value='". $row->TenSV."'/> </td></tr>";
                //==============================================================================================
                $K_result=$this->msinhvien->get_K();
                echo "<tr><td>Khóa</td>
                          <td>
                              <select name='k' id='k'>";
                              foreach($K_result as $K_row)
                              {
                                if($K_row->MaK==$row->K) echo "<option selected='selected' title='".$K_row->TenK."' value='".$K_row->MaK."'>".$K_row->TenK."</option>";
                                else echo "<option title='".$K_row->TenK."'  value='".$K_row->MaK."'>".$K_row->TenK."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                          
                 //==============================================================================================          
                echo "<tr><td>Khoa</td>
                          <td>
                              <select name='khoa' class='".$khoa."' id='khoa'>";
                              foreach($khoa_result as $khoa_row)
                              {
                                if($khoa_row->MaKhoa==$khoa) 
                                     echo "<option title='".$khoa_row->TenKhoa."' selected='selected' value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                                else echo "<option title='".$khoa_row->TenKhoa."'  value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                  //==============================================================================================
                         
                $lop_result=$this->msinhvien->get_lop("",$khoa);
                
                echo "<tr><td>Lớp</td>
                          <td>
                              <select name='lop' id='lop'>";
                              foreach($lop_result as $lop_row)
                              {
                                if($lop_row->TenLop==$row->Lop) echo "<option selected='selected' value='".$lop_row->TenLop."'>".$lop_row->TenLop."</option>";
                                else echo "<option  value='".$lop_row->TenLop."'>".$lop_row->TenLop."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                 //==============================================================================================
                          
                echo "<tr><td>Ngày Sinh</td><td><input   name='ngaysinh' id='ngaysinh' type='text' title='vd: 20/10/2000, 20-10-2000' value='". $row->NgaySinh."'/> </td></tr>";
                echo "<tr><td>Nơi Sinh</td><td><textarea name='noisinh'  id='noisinh' cols='25' rows='4'>".$row->NoiSinh."</textarea></td></tr>";
                echo "<tr><td>SĐT</td><td><input         name='sdt'      id='sdt'     type='text' title='vd: 016 9993 8919,0123 023 789' value='". $row->SDT."'/> </td></tr>"; 
                echo "<tr><td>Email</td><td><input       name='email'    id='email'   type='text' title='vd:abc@yahoo.com.vn,xyz@gmail.com...\n Tối đa 40 kí tự' 
                                                         value='". $row->email."'/> </td></tr>";               
                echo "</table>";
              
                
                
               // echo "<div class='error'></div>";
                echo "<table class='error'>";
                
                echo "</table>";
                
            }
        }
        else echo "Lỗi dữ liệu";
        
   }
//==============================================UPDATE SINHVIEN==========================================================================================================================================      
   public function ajax_update()
   {

            $this->load->library("form_validation");            
            $key=$this->input->post("key"); 
                 
            $this->form_validation->set_rules('masv', 'MSSV', "required|exact_length[8]|callback_check_mssv[$key]");//kiem tra khoa chinh
            $this->form_validation->set_rules('tensv', 'Tên sinh viên', 'required');
            $this->form_validation->set_rules('sdt', 'Số điện thoại', 'numeric');
            $this->form_validation->set_rules('email', 'Địa chỉ Email', 'valid_email|max_length[40]');
           // $this->form_validation->set_rules("noisinh","Nơi sinh","required");
           // $this->form_validation->set_rules("cmnd","CMND","required|exact_length[9]");
            
            
            if($this->form_validation->run() ==false)
            {
                //echo validation_errors();
                echo "<tr><td>".form_error("masv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tensv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("k","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("khoa","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("lop","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                
                echo "<tr><td>".form_error("ngaysinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr style='height:92px;'><td>".form_error("noisinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("sdt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("email","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                
            } 
            else 
            {
               
               $data["masv"]=$this->input->post("masv");
               $data["tensv"]=$this->input->post("tensv");               
               $data["lop"]=$this->input->post("lop");
               $data["k"]=$this->input->post("k");
               $data["noisinh"]=trim($this->input->post("noisinh"));
               $data["ngaysinh"]=$this->input->post("ngaysinh");
               $data["sdt"]=$this->input->post("sdt");
               $data["email"]=$this->input->post("email");
               
               $khoa_old=$this->input->post("khoa_old");
               $khoa_new=$this->input->post("khoa_new");
               $this->msinhvien->update_sinhvien($key,$khoa_old,$khoa_new,$data);
               
               
               echo "success";
            }
    
     
   }//end ajax_update
   
//==============================================INSERT SINHVIEN====================================================================================================================================================    
   public function ajax_insert()
   {

            $this->load->library("form_validation");            
            $key=$this->input->post("key"); 
                 
            $this->form_validation->set_rules('masv', 'MSSV', "required|exact_length[8]|callback_check_mssv[$key]");//kiem tra khoa chinh
            $this->form_validation->set_rules('tensv', 'Tên sinh viên', 'required');
            $this->form_validation->set_rules('khoa', 'Khoa', 'required');
            $this->form_validation->set_rules('lop', 'Lớp', 'required');
            $this->form_validation->set_rules('sdt', 'Số điện thoại', 'numeric');
            $this->form_validation->set_rules('email', 'Địa chỉ Email', 'valid_email|max_length[40]');
            //$this->form_validation->set_rules("noisinh","Nơi sinh","required");
            //$this->form_validation->set_rules("cmnd","CMND","required|exact_length[9]");
            
            
            if($this->form_validation->run() ==false)
            {
                //echo validation_errors();
                echo "<tr><td>".form_error("masv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tensv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("k","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("khoa","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("lop","<span title='Thông báo lỗi'>","</span>")."</td></tr>";                
                echo "<tr><td>".form_error("ngaysinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr style='height:92px;'><td>".form_error("noisinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("sdt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("email","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            } 
            else 
            {
               
               $data["masv"]=$this->input->post("masv");
               $data["tensv"]=$this->input->post("tensv");
               $data["k"]=$this->input->post("k");               
               $data["lop"]=$this->input->post("lop");               
               $data["noisinh"]=trim($this->input->post("noisinh"));
               $data["ngaysinh"]=$this->input->post("ngaysinh");
               $data["sdt"]=$this->input->post("sdt");
               $data["email"]=$this->input->post("email");
               
               $khoa=$this->input->post("khoa");
               $this->db->insert("sv_".$khoa,$data);
               echo "success";
            }
    
     
   }//end ajax insert
//==============================================DELETE SINHVIEN====================================================================================================================================================   
   public function ajax_delete()
   {
        $mssv_array=$this->input->post("mssv_array");
        $khoa=$this->input->post("khoa");
        $this->msinhvien->delete_sinhvien($mssv_array,$khoa);
   }

//====================================================================================================================================================
   public function ajax_lop_from_khoa()
   {
        $k=$this->input->post("k");  
        $khoa=$this->input->post("khoa");   
             
        $lop_result=$this->msinhvien->get_lop($k,$khoa);
        foreach($lop_result as $lop_row)
        {          
           echo "<option  value='".$lop_row->TenLop."'>".$lop_row->TenLop."</option>";
                               
        }
   }


//==============================================THEM SINHVIEN====================================================================================================================================================
    function themsv($khoa="")
    {
        $khoa_result=$this->msinhvien->get_khoa();
        $data["khoa_result"]=$khoa_result;
        $data["khoa"]=$khoa;
        if($khoa!="") $data['data_title']="Thao tác thêm sinh viên khoa ".$this->msinhvien->ten_khoa($khoa);
        else $data['data_title']="Thao tác thêm sinh viên";
        $data["title"]="Trang thêm sinh viên";  
        $this->load->view("admin/vsinhvien_add",$data);   
    }
    
   
    
    
    
//==============================================NHAP DU LIEU SINHVIEN====================================================================================================================================================
   //them sv page
   function nhapdl($khoa_active="")
    {
        $this->load->helper("url");
        $this->load->library("form_validation");        
        $this->form_validation->set_rules("khoa","Khoa","required");
        $this->form_validation->set_rules("file_upload","Tập tin","callback_exist_file");              
        if($this->form_validation->run())
        {            
            $file_data=$this->upload->data();
            $khoa=$this->input->post("khoa");
            $import_type=$this->input->post("import_type");
            
            
            try
            {
                $sinhvien_array=$this->read_import_file($file_data);    
                if($import_type=="insert")$num_errors=$this->check_error_data($sinhvien_array);
                else $num_errors=$this->check_error_data($sinhvien_array,$khoa);
                //LOI=============================================================================================
                if($num_errors>0) 
                {
                    
                    $khoa_result=$this->msinhvien->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["khoa_active"]=$khoa_active;
                    $data["khoa"]=$khoa;
                    $data["import_type"]=$import_type;
                    $data["error_data"]=$sinhvien_array;
                    $data["num_errors"]=$num_errors;                   
                    
                    if($khoa!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->msinhvien->ten_khoa($khoa)."   <img src='".static_url()."/images/delete.png' />";
                    else $data['right_title']="Thao tác nhập dữ liệu từ tập tin";    
                    
                    
                    $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vsinhvien_import_error",$data);    
                }
                //=OK IMPORT INTO DATA======================================================================================
                else
                {
                    $this->msinhvien->import_sinhvien($khoa,$sinhvien_array,$import_type);
                    $khoa_result=$this->msinhvien->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["khoa"]=$khoa;
                    $data["TenKhoa"]=$this->msinhvien->ten_khoa($khoa);
                    $data["success_data"]=$sinhvien_array;
                    $data["num_success"]=count($sinhvien_array);
                    if($khoa!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->msinhvien->ten_khoa($khoa)."   <img src='".static_url()."/images/ok.png' />";
                    else $data['right_title']="Thao tác nhập dữ liệu từ tập tin"; 
                     $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vsinhvien_import_success",$data);    
                    /*
                    echo"<pre>";
                    print_r($sinhvien_array);
                    print_r($file_data);
                    echo $num_errors;
                    echo"</pre>";
                    */   
                }
            }
            catch(exception $ex)
            {
                $khoa_result=$this->msinhvien->get_khoa();
                $data["khoa_result"]=$khoa_result;
                $data["khoa_active"]=$khoa_active;//neu co
                $data["khoa"]=$khoa;//$_POST rebuild
                $data["import_type"]=$import_type;//$_POST rebuild
                $data["error_array"]="Lỗi khi đọc tập tin";
                $data["error_data"]=array();
                $data["num_errors"]=1;
               
                if($khoa!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->msinhvien->ten_khoa($khoa)."   <img src='".static_url()."/images/delete.png' />";
                else $data['right_title']="Thao tác nhập dữ liệu từ tập tin";  
                $data["title"]="Trang nhập dữ liệu";  
                $this->load->view("admin/vsinhvien_import_error",$data); 
                
            }
            
            
             
           
        }
        else//load binh thuong khong co form
        {
            $khoa_result=$this->msinhvien->get_khoa();
            $data["khoa_result"]=$khoa_result;
            $data["khoa_active"]=$khoa_active;
            if($khoa_active!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->msinhvien->ten_khoa($khoa_active);
            else $data['right_title']="Thao tác nhập dữ liệu từ tập tin";
            $data["title"]="Trang nhập dữ liệu";  
            $this->load->view("admin/vsinhvien_import",$data);    
        }
           
    }//END IMPORT FROM FILE    
//==============================================XUAT DU LIEU=================================================================================================================================================    
    function xuatdl()
	{  
	   
           $khoa=$this->input->post("khoa");
           $k=$this->input->post("k");
           $start=$this->input->post("start");
           $end=$this->input->post("end");
           $limit=$end-$start;        
           $search=$this->input->post("search");
           $file=$this->input->post("file");
           
           $this->form_validation->set_rules("khoa","khoa","required");
           if($this->form_validation->run())
            {
    //=================================================CSV================================================================================================================================================      
                if($file=="CSV")
                {
                    $objPHPExcel = new PHPExcel();
                    
                    
                    $sinhvien_result=$this->msinhvien->get_sinhvien($search,$khoa,$k,$start,$limit);
                    $fields=array("MaSV","TenSV","Lop","K","NgaySinh","NoiSinh","SDT","email");
                    $ncol=0;
                    $nrow=1;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);    
                    
                    foreach($sinhvien_result as $row)
                    {
                                                                      
                        $sheet_dsmh->setCellValueByColumnAndRow(0,$nrow,"'".$row->MaSV);
                        $sheet_dsmh->setCellValueByColumnAndRow(1,$nrow,$row->TenSV);
                        $sheet_dsmh->setCellValueByColumnAndRow(2,$nrow,$row->Lop);
                        $sheet_dsmh->setCellValueByColumnAndRow(3,$nrow,$row->K);
                        $sheet_dsmh->setCellValueByColumnAndRow(4,$nrow,$row->NgaySinh);                        
                        $sheet_dsmh->setCellValueByColumnAndRow(5,$nrow,trim($row->NoiSinh));
                        $sheet_dsmh->setCellValueByColumnAndRow(6,$nrow,"'".$row->SDT);
                        $sheet_dsmh->setCellValueByColumnAndRow(7,$nrow,$row->email);
                        
                        
                        $nrow++; 
                        
                        
                    }
                   
                    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                    $objPHPExcel->setActiveSheetIndex(0);
                    $filename="Danh sach sv ".$khoa;
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
                    $sinhvien_result=$this->msinhvien->get_sinhvien($search,$khoa,$k,$start,$limit);
                    $fields=array("MaSV","TenSV","Lop","K","NgaySinh","NoiSinh","SDT","email");
                    $ncol=0;
                    $nrow=2;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);
            //======TITLE============================================================================================================            
                    $sheet_dsmh->getCell("A1")->setValue("MSSV"); 
                    $sheet_dsmh->getColumnDimension('A')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("B1")->setValue("Họ Tên");        
                    $sheet_dsmh->getColumnDimension('B')->setWidth(25);
                    
                    $sheet_dsmh->getCell("C1")->setValue("Lớp");
                    $sheet_dsmh->getColumnDimension('C')->setWidth(12);
                    
                    $sheet_dsmh->getCell("D1")->setValue("K");
                    $sheet_dsmh->getColumnDimension('D')->setWidth(10);
                    
                    $sheet_dsmh->getCell("E1")->setValue("Ngày Sinh");
                    $sheet_dsmh->getColumnDimension('E')->setWidth(20);
                    
                    $sheet_dsmh->getCell("F1")->setValue("Nơi sinh");
                    $sheet_dsmh->getColumnDimension('F')->setWidth(25);
                    
                    $sheet_dsmh->getCell("G1")->setValue("Số ĐT");
                    $sheet_dsmh->getColumnDimension('G')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("H1")->setValue("Email");
                    $sheet_dsmh->getColumnDimension('H')->setAutoSize(true);
                    
                    $sheet_dsmh->getStyle("A1:H1")->getFont()->setSize(12)->setBold(true);
            //======DATA============================================================================================================            
                    foreach($sinhvien_result as $row)
                    {
                        $ncol=0;
                        foreach($fields as $field)
                        {
                            $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValueExplicit(trim($row->$field),PHPExcel_Cell_DataType::TYPE_STRING);
                            $ncol++;
                        }                
                        $nrow++;
                    }
                    // Rename worksheet
                    $objPHPExcel->getActiveSheet()->setTitle('DSSV '.$khoa);
                    
                    
                    $objPHPExcel->setActiveSheetIndex(0);
                    $filename="Danh sach sv ".$khoa;
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
                    $sinhvien_result=$this->msinhvien->get_sinhvien($search,$khoa,$k,$start,$limit);
                    $fields=array("MaSV","TenSV","Lop","K","NgaySinh","NoiSinh","SDT","email");
                    $ncol=0;
                    $nrow=2;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);
            //=======TITLE============================================================================================================            
                    $sheet_dsmh->getCell("A1")->setValue("MSSV"); 
                    $sheet_dsmh->getColumnDimension('A')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("B1")->setValue("Họ Tên");        
                    $sheet_dsmh->getColumnDimension('B')->setWidth(25);
                    
                    $sheet_dsmh->getCell("C1")->setValue("Lớp");
                    $sheet_dsmh->getColumnDimension('C')->setWidth(12);
                    
                    $sheet_dsmh->getCell("D1")->setValue("K");
                    $sheet_dsmh->getColumnDimension('D')->setWidth(10);
                    
                    $sheet_dsmh->getCell("E1")->setValue("Ngày Sinh");
                    $sheet_dsmh->getColumnDimension('E')->setWidth(20);
                    
                    $sheet_dsmh->getCell("F1")->setValue("Nơi sinh");
                    $sheet_dsmh->getColumnDimension('F')->setWidth(25);
                    
                    $sheet_dsmh->getCell("G1")->setValue("Số ĐT");
                    $sheet_dsmh->getColumnDimension('G')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("H1")->setValue("Email");
                    $sheet_dsmh->getColumnDimension('H')->setAutoSize(true);
                    
                    $sheet_dsmh->getStyle("A1:H1")->getFont()->setSize(12)->setBold(true);
        //==========DATA============================================================================================================            
                    foreach($sinhvien_result as $row)
                    {
                        $ncol=0;
                        foreach($fields as $field)
                        {
                            $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValueExplicit($row->$field,PHPExcel_Cell_DataType::TYPE_STRING);
                            $ncol++;
                        }                
                        $nrow++;
                    }
                   
                    
                    // Rename worksheet
                    $objPHPExcel->getActiveSheet()->setTitle('DSSV '.$khoa);
                    
                    
                    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                    $objPHPExcel->setActiveSheetIndex(0);
                    
                    $filename="Danh sach sv ".$khoa;
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
                $khoa_result=$this->msinhvien->get_khoa();
                $data["khoa_result"]=$khoa_result;
        
                $data["title"]="Trang xuất dữ liệu";  
                $this->load->view("admin/vsinhvien_export",$data);   
                  
            }
	    
        
   	}//END EXPORT DATA
 //================================================THONG KE==================================================================================================================================================
    public function count_sv($khoa="tatca",$k=0)
    {
         return $this->msinhvien->get_num_rows("",$khoa,$k);
    }
    public function thongke()
    {
        $khoa_result=$this->msinhvien->get_khoa();
        $K_result=$this->msinhvien->get_K();
         $SL["total"]=$this->msinhvien->get_num_rows();
        foreach($khoa_result as $row)
        {
            $SL[$row->MaKhoa][0]=$this->msinhvien->get_num_rows("",$row->MaKhoa);
            foreach($K_result as $k_row)
            {                
                $SL[$row->MaKhoa][$k_row->MaK]=$this->msinhvien->get_num_rows("",$row->MaKhoa,$k_row->MaK);
               
            }
           
        }
       // echo "<pre>";
        // print_r($SL);
       // echo "</pre>";
        
        $data["khoa_result"]=$khoa_result;
        $data["K_result"]=$K_result;
        $data["SL"]=$SL;
        $data["title"]="Trang thống kê tổng quát sinh viên";  
        $this->load->view("admin/vsinhvien_statistic",$data); 
          
    }
//============VALID SINHVIEN WHEN IMPORT==============================================================================================================
    public function valid_mssv($mssv,$arr_unique,$khoa="")
       {
          if(in_array($mssv,$arr_unique)) return false;
          else if ($this->msinhvien->mssv_exist_condition($mssv,$khoa)) return false;
          return true;
       }
    public function check_error_data($data,$khoa="")
    {
        $num_errors=0;
        $array_unique=array();
        foreach($data as $row)
        {
            if($this->valid_mssv($row["MaSV"],$array_unique,$khoa)==false) $num_errors++;
            $array_unique[]=$row["MaSV"];
            
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
            if($this->msinhvien->mssv_exist($new_mssv)) 
            {
                $this->form_validation->set_message("check_mssv","<span title='Thông báo lỗi'><b style='color:red'>".$new_mssv."</b> đã tồn tại.</span>");
                return false;   
            }
            else return true;
        }
        else return true;
   }
   public function read_import_file($file_data)   
   {
        $file_name=$file_data["file_name"];
        $full_name=$file_data["full_path"];
        $file_ext=$file_data["file_ext"];
            
            
        $objPHPExcel = new PHPExcel();
        $sinhvien_array=array();  
        
   
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
                    $MaSV=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                    $TenSV=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                    $Lop=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                    $K=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                    $NgaySinh=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                    $NoiSinh=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();
                    $SoDT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();
                    $Email=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7,$row_index)->getValue();
                            
                          
                    $MaSV=ltrim($MaSV,"'");
                    $SoDT=ltrim($SoDT,"'");
                    if($MaSV!="")
                    {
                        $tempt=array("MaSV"=>$MaSV,
                                 "TenSV"=>$TenSV,
                                 "Lop"=>$Lop,
                                 "K"=>$K,
                                 "NgaySinh"=>$NgaySinh,
                                 "NoiSinh"=>$NoiSinh,
                                 "SDT"=>$SoDT,
                                 "Email"=>$Email);
                        $sinhvien_array[]=$tempt;
                    }
                   
                       
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
                    
                    
                    
                    $sinhvien_array=array();                
                          
                    for($row_index=2;$row_index<=$num_row;$row_index++)
                    {
                        
                        
                        $MaSV=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $TenSV=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                        $Lop=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                        $K=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                        $NgaySinh=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                        $NoiSinh=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();
                        $SoDT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();
                        $Email=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7,$row_index)->getValue();
                        
                        $MaSV=ltrim($MaSV,"'");
                        $SoDT=ltrim($SoDT,"'");
                        if($MaSV!="")
                        {
                            $tempt=array("MaSV"=>$MaSV,
                                     "TenSV"=>$TenSV,
                                     "Lop"=>$Lop,
                                     "K"=>$K,
                                     "NgaySinh"=>$NgaySinh,
                                     "NoiSinh"=>$NoiSinh,
                                     "SDT"=>$SoDT,
                                     "Email"=>$Email);
                            $sinhvien_array[]=$tempt;
                        }
                       
                    }
                
                }
            
           
            
            return $sinhvien_array;
    
   }
}//end CONTROLLER SINHVIEN
    
    

 
?>
