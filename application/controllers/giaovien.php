<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class giaovien extends CI_Controller {
    

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");        
        $this->load->model("admin/mgiaovien");
        $this->load->library('PHPExcel');
        
    }
	public function index()
	{       //get khoa make menu
            $khoa_result=$this->mgiaovien->get_khoa();
            //get data to dump into table
            $giaovien_result=$this->mgiaovien->get_giaovien("",0,15);//lay danh sach sinh vien cac khoa, thuoc cac k, 15 record dau tien
           
            
            $data['data_title']="Danh sách giáo viên ";
            
            
            //tong so hang de tao phan trang
            $num_rows=$this->mgiaovien->get_num_rows("");
            
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/giaovien/ajax_full_data";
            $config["total_rows"]=$num_rows;
            $config["per_page"]=15;
            $this->pagination->initialize($config);
            $data["pagination"]=$this->pagination->create_links();
            //data for view
            $data["khoa_result"]=$khoa_result;
            
            $data["giaovien_result"]=$giaovien_result;
            $data["total_rows"]=$num_rows;
            $data["title"]="Trang quản lý giáo viên";        
            
    		$this->load->view('admin/vgiaovien',$data);  
              
        
   	}
    public function tkb($magv)
	{       //get khoa make menu
            $khoa_result=$this->mgiaovien->get_khoa();
            $giaovien_info=$this->mgiaovien->get_giaovien($magv);
            //get data to dump into table            
            $tengv="";
            foreach($giaovien_info as $row)
            {
                $tengv=$row->TenGV;
            }
            $data['data_title']="Thời khóa biểu giảng dạy của giáo viên <b>$tengv($magv)</b>";
            
            $num_rows=$this->mgiaovien->get_num_rows("");
            //data for view
            $data["khoa_result"]=$khoa_result;
            $data["thu_result"]=$this->mgiaovien->get_thu();
            $data["ca_result"]=$this->mgiaovien->get_ca();
            $data["magv"]=$magv; 
            $data["total_rows"]=$num_rows;        
            $data["title"]="Trang quản lý giáo viên";
    		$this->load->view('admin/vgiaovien_tkb',$data);  
              
        
   	}
        
//DANH SACH GIAOVIEN====================================================================================================================================================
    //ajax load lai datas
    public function ajax_full_data($start=0)
    {
        
        $limit=$this->input->post("limit");        
        $search=$this->input->post("search");
        
       //get a record of masv OR all follow each $khoa,$k,$start and $limit
        $giaovien_result=$this->mgiaovien->get_giaovien($search,$start,$limit);        
        $count_rows=count($giaovien_result);
        
        if($count_rows>0)
        {
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/giaovien/ajax_full_data";
            $config["total_rows"]=$this->mgiaovien->get_num_rows($search);
            
            $config["per_page"]=$limit;
            $this->pagination->initialize($config);
            
          
            echo "<div id='pagination' class='".$config["total_rows"]."'>";
            echo $this->pagination->create_links();
		    echo "</div><!--end #pagintion -->";
            
            //make table data	
            echo '<div id="scroll">';
            echo ' <table id="table_data">
            <tr id="first">
                <th id="checkbox"></th>
                <th id="magv"></th>
                <th id="tengv"></th>
                <th id="ngaysinh"></th>
                <th id="noisinh"></th>
                <th id="sodt"></th>
                <th id="email"></th>
            </tr>';            
             foreach($giaovien_result as $row)
             {
                
                echo "<tr>";
                echo "<td class='checkbox'><input id='".$row->MaGV."' class='checkbox_row' type='checkbox' /></td>";
                echo "<td class='magv' title='Sửa đổi'>".$row->MaGV."</td>";
                echo "<td class='tengv' style='text-align:left' >".$row->TenGV."</td>"; 
                echo "<td class='ngaysinh'>".$row->NgaySinh."</td>";
                echo "<td class='noisinh'>".$row->NoiSinh."</td>";
                echo "<td class='sodt'>".$row->SoDT."</td>";
                echo "<td class='email' title='".$row->email."'>".$row->email."</td>";
                echo "</tr>";
             }
                             
            echo '</table><!--end #table_data -->';
            echo '</div><!--end #scroll -->';
            
        }
        else echo "Dữ liệu trống.";
    
      
    }//end ajax_full_data
    //AJAX FOR SEARCH,PAGINATION OF SCHEDULE
    public function ajax_full_lich_data($start=0)
    {
        
        $limit=$this->input->post("limit");        
        $search=$this->input->post("search");
        
       //get a record of masv OR all follow each $khoa,$k,$start and $limit
        $giaovien_result=$this->mgiaovien->get_giaovien($search,$start,$limit);        
        $count_rows=count($giaovien_result);
        
        if($count_rows>0)
        {
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/giaovien/ajax_full_data";
            $config["total_rows"]=$this->mgiaovien->get_num_rows($search);
            
            $config["per_page"]=$limit;
            $this->pagination->initialize($config);
            
          
            echo "<div id='pagination' class='".$config["total_rows"]."'>";
            echo $this->pagination->create_links();
		    echo "</div><!--end #pagintion -->";
            
            //make table data	
            echo '<div id="scroll">';
            echo ' <table id="table_data">
            <tr id="first">
                <th id="checkbox"></th>
                <th id="magv"></th>
                <th id="tengv"></th>
                <th id="ngaysinh"></th>
                <th id="noisinh"></th>
                <th id="sodt"></th>
                <th id="email"></th>
            </tr>';            
             foreach($giaovien_result as $row)
             {
                
                echo "<tr>";
                echo "<td class='checkbox'><input id='".$row->MaGV."' class='checkbox_row' type='checkbox' /></td>";
                echo "<td class='magv' title='Sửa đổi'>".$row->MaGV."</td>";
                echo "<td class='tengv' style='text-align:left' >".$row->TenGV."</td>"; 
                echo "<td class='ngaysinh'>".$row->NgaySinh."</td>";
                echo "<td class='noisinh'>".$row->NoiSinh."</td>";
                echo "<td class='sodt'>".$row->SoDT."</td>";
                echo "<td class='email' title='".$row->email."'>".$row->email."</td>";
                echo "</tr>";
             }
                             
            echo '</table><!--end #table_data -->';
            echo '</div><!--end #scroll -->';
            
        }
        else echo "Dữ liệu trống.";
    
      
    }//end ajax_full_lich_data
    
//==============================================DATA POPUP======================================================================================================   
    //tra ve 1 record sinh vien theo masv
    public function ajax_data()
   {

        $magv=$this->input->post("magv");        
        $data_result=$this->mgiaovien->get_giaovien($magv);        
        if(count($data_result)>0)
        {
            foreach($data_result as $row)
            {   
                echo "<table class='info' id='". $row->MaGV."'>";
                echo "<tr><td>Mã GV</td>
                          <td><input  name='magv'  id='magv'  type='text' title='Mã số giáo viên ít nhất 4 kí tự' value='". $row->MaGV."'/></td>
                          </tr>";
                echo "<tr><td>Tên giáo viên</td><td><input  name='tengv' id='tengv' type='text' value='". $row->TenGV."'/> </td></tr>";                
                 //==============================================================================================
                          
                echo "<tr><td>Ngày Sinh</td><td><input   name='ngaysinh' id='ngaysinh' type='text' title='vd: 20/10/2000, 20-10-2000' value='". $row->NgaySinh."'/> </td></tr>";
                echo "<tr><td>Nơi Sinh</td><td><textarea name='noisinh'  id='noisinh' cols='25' rows='4'>".$row->NoiSinh."</textarea></td></tr>";
                echo "<tr><td>Số ĐT</td><td><input         name='sodt'      id='sodt'     type='text' title='vd: 016 9993 8919,0123 023 789' value='". $row->SoDT."'/> </td></tr>"; 
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
                 
            $this->form_validation->set_rules('magv', 'Mã GV', "required|min_length[4]|callback_check_magv[$key]");//kiem tra khoa chinh
            $this->form_validation->set_rules('tengv', 'Tên giáo viên', 'required');            
            $this->form_validation->set_rules('sodt', 'Số điện thoại', 'numeric');
            $this->form_validation->set_rules('email', 'Địa chỉ Email', 'valid_email|max_length[40]');
           // $this->form_validation->set_rules("noisinh","Nơi sinh","required");
           // $this->form_validation->set_rules("cmnd","CMND","required|exact_length[9]");
            
            
            if($this->form_validation->run() ==false)
            {
                //echo validation_errors();
                echo "<tr><td>".form_error("magv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tengv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("ngaysinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr style='height:92px;'><td>".form_error("noisinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("sodt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("email","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                
            } 
            else 
            {
               
               $data["magv"]=strtoupper($this->input->post("magv"));
               $data["tengv"]=$this->input->post("tengv");
               $data["noisinh"]=trim($this->input->post("noisinh"));
               $data["ngaysinh"]=$this->input->post("ngaysinh");
               $data["sodt"]=$this->input->post("sodt");
               $data["email"]=$this->input->post("email");               
               
               $this->mgiaovien->update_giaovien($key,$data);               
               
               echo "success";
            }
    
     
   }//end ajax_update
   
//==============================================INSERT SINHVIEN====================================================================================================================================================    
   public function ajax_insert()
   {

            $this->load->library("form_validation");            
            $key=$this->input->post("key"); 
                 
            $this->form_validation->set_rules('magv', 'Mã số GV', "required|min_length[4]|callback_check_magv[$key]");//kiem tra khoa chinh
            $this->form_validation->set_rules('tengv', 'Tên giáo viên', 'required');
            $this->form_validation->set_rules('sodt', 'Số điện thoại', 'numeric');
            $this->form_validation->set_rules('email', 'Địa chỉ Email', 'valid_email|max_length[40]');
            
            if($this->form_validation->run() ==false)
            {
               //echo validation_errors();
                echo "<tr><td>".form_error("magv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tengv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("ngaysinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr style='height:92px;'><td>".form_error("noisinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("sodt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("email","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            } 
            else 
            {
               
               $data["magv"]=strtoupper($this->input->post("magv"));
               $data["tengv"]=$this->input->post("tengv");
               $data["noisinh"]=trim($this->input->post("noisinh"));
               $data["ngaysinh"]=$this->input->post("ngaysinh");
               $data["sodt"]=$this->input->post("sodt");
               $data["email"]=$this->input->post("email");
               
               $this->mgiaovien->insert_giaovien($data);
               echo "success";
            }
    
     
   }//end ajax insert
//==============================================DELETE GIAO VIEN====================================================================================================================================================   
   public function ajax_delete()
   {
        $msgv_array=$this->input->post("magv_array");        
        $this->mgiaovien->delete_giaovien($msgv_array);
        
   }


//==============================================THEM SINHVIEN====================================================================================================================================================
    function themgv($khoa="")
    {
        $num_rows=$this->mgiaovien->get_num_rows("");
        $khoa_result=$this->mgiaovien->get_khoa();
        $data["khoa_result"]=$khoa_result;        
        $data["total_rows"]=$num_rows;
        $data['data_title']="Thao tác thêm giáo viên";
        $data["title"]="Trang thêm giáo viên";  
        $this->load->view("admin/vgiaovien_add",$data);   
    }
    function lich_giang_day()
    {
        //get khoa make menu
        $khoa_result=$this->mgiaovien->get_khoa();
            //get data to dump into table
        $giaovien_result=$this->mgiaovien->get_lich_giang_day("",0,15);//lay danh sach sinh vien cac khoa, thuoc cac k, 15 record dau tien
           
            
        $data['data_title']="Danh sách lịch giảng dạy giáo viên ";
            
            
            //tong so hang de tao phan trang
        $num_rows=$this->mgiaovien->get_num_rows("");
            
            //make pagination
        $this->load->library("pagination");        
        $config["base_url"]="http://dkhp.uit.edu.vn/quanly/giaovien/ajax_full_data";
        $config["total_rows"]=$num_rows;
        $config["per_page"]=15;
        $this->pagination->initialize($config);
        $data["pagination"]=$this->pagination->create_links();
            //data for view
        $data["khoa_result"]=$khoa_result;
            
        $data["giaovien_result"]=$giaovien_result;
        $data["total_rows"]=$num_rows;
        $data["title"]="Trang quản lý giáo viên";        
            
  		$this->load->view('admin/vgiaovien_lich_giang_day',$data);  
    }
    
   
    
    
    
//==============================================NHAP DU LIEU SINHVIEN====================================================================================================================================================
   //them gv page
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
                $giaovien_array=$this->read_import_file($file_data);    
                if($import_type=="insert")$num_errors=$this->check_error_data($giaovien_array);
                else $num_errors=$this->check_error_data($giaovien_array,$khoa);
                //LOI=============================================================================================
                if($num_errors>0) 
                {
                    
                    $khoa_result=$this->mgiaovien->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["khoa_active"]=$khoa_active;
                    $data["khoa"]=$khoa;
                    $data["import_type"]=$import_type;
                    $data["error_data"]=$giaovien_array;
                    $data["num_errors"]=$num_errors;                   
                    
                    if($khoa!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->mgiaovien->ten_khoa($khoa)."   <img src='".static_url()."/images/delete.png' />";
                    else $data['right_title']="Thao tác nhập dữ liệu từ tập tin";    
                    
                    
                    $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vgiaovien_import_error",$data);    
                }
                //=OK IMPORT INTO DATA======================================================================================
                else
                {
                    $this->mgiaovien->import_giaovien($khoa,$giaovien_array,$import_type);
                    $khoa_result=$this->mgiaovien->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["khoa"]=$khoa;
                    $data["TenKhoa"]=$this->mgiaovien->ten_khoa($khoa);
                    $data["success_data"]=$giaovien_array;
                    $data["num_success"]=count($giaovien_array);
                    if($khoa!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->mgiaovien->ten_khoa($khoa)."   <img src='".static_url()."/images/ok.png' />";
                    else $data['right_title']="Thao tác nhập dữ liệu từ tập tin"; 
                     $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vgiaovien_import_success",$data);    
                    /*
                    echo"<pre>";
                    print_r($giaovien_array);
                    print_r($file_data);
                    echo $num_errors;
                    echo"</pre>";
                    */   
                }
            }
            catch(exception $ex)
            {
                $khoa_result=$this->mgiaovien->get_khoa();
                $data["khoa_result"]=$khoa_result;
                $data["khoa_active"]=$khoa_active;//neu co
                $data["khoa"]=$khoa;//$_POST rebuild
                $data["import_type"]=$import_type;//$_POST rebuild
                $data["error_array"]="Lỗi khi đọc tập tin";
                $data["error_data"]=array();
                $data["num_errors"]=0;
               
                if($khoa!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->mgiaovien->ten_khoa($khoa)."   <img src='".static_url()."/images/delete.png' />";
                else $data['right_title']="Thao tác nhập dữ liệu từ tập tin";  
                $data["title"]="Trang nhập dữ liệu";  
                $this->load->view("admin/vgiaovien_import_error",$data); 
                
            }
            
            
             
           
        }
        else//load binh thuong khong co form
        {
            $khoa_result=$this->mgiaovien->get_khoa();
            $data["khoa_result"]=$khoa_result;
            $data["khoa_active"]=$khoa_active;
            if($khoa_active!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->mgiaovien->ten_khoa($khoa_active);
            else $data['right_title']="Thao tác nhập dữ liệu từ tập tin";
            $data["title"]="Trang nhập dữ liệu";  
            $this->load->view("admin/vgiaovien_import",$data);    
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
           
           $this->form_validation->set_rules("file","file","required");
           if($this->form_validation->run())
            {
    //=================================================CSV================================================================================================================================================      
                if($file=="CSV")
                {
                    $objPHPExcel = new PHPExcel();
                    
                    
                    $giaovien_result=$this->mgiaovien->get_giaovien($search,$khoa,$k,$start,$limit);
                    $fields=array("MaSV","TenSV","Lop","K","NgaySinh","NoiSinh","SDT","email");
                    $ncol=0;
                    $nrow=1;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);    
                    
                    foreach($giaovien_result as $row)
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
                    $filename="Danh sach gv ".$khoa;
                    header('Content-Type: text/cgv');
                    header('Content-Disposition: attachment;filename="'.$filename.'.cgv"');
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
                    $giaovien_result=$this->mgiaovien->get_giaovien($search,$khoa,$k,$start,$limit);
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
                    foreach($giaovien_result as $row)
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
                    $filename="Danh sach gv ".$khoa;
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
                    $giaovien_result=$this->mgiaovien->get_giaovien($search,$khoa,$k,$start,$limit);
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
                    foreach($giaovien_result as $row)
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
                    
                    $filename="Danh sach gv ".$khoa;
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
                $khoa_result=$this->mgiaovien->get_khoa();
                $data["khoa_result"]=$khoa_result;
        
                $data["title"]="Trang xuất dữ liệu";  
                $this->load->view("admin/vgiaovien_export",$data);   
                  
            }
	    
        
   	}//END EXPORT DATA
 //================================================THONG KE==================================================================================================================================================
    public function count_gv($khoa="tatca",$k=0)
    {
         return $this->mgiaovien->get_num_rows("",$khoa,$k);
    }
    public function thongke()
    {
        $num_rows=$this->mgiaovien->get_num_rows("");
        $khoa_result=$this->mgiaovien->get_khoa();
        $data["khoa_result"]=$khoa_result;        
        $data["total_rows"]=$num_rows;
        $data['data_title']="Thống kê tổng quát giáo viên";
        $data["title"]="Trang thống kê giáo viên";  
        $this->load->view("admin/vgiaovien_statistic",$data); 
          
    }
//============VALID SINHVIEN WHEN IMPORT==============================================================================================================
    public function valid_msgv($msgv,$arr_unique,$khoa="")
       {
          if(in_array($msgv,$arr_unique)) return false;
          else if ($this->mgiaovien->msgv_exist_condition($msgv,$khoa)) return false;
          return true;
       }
    public function check_error_data($data,$khoa="")
    {
        $num_errors=0;
        $array_unique=array();
        foreach($data as $row)
        {
            if($this->valid_msgv($row["MaSV"],$array_unique,$khoa)==false) $num_errors++;
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
                $config["allowed_types"]="xls|xlsx|cgv";
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
//KIEM TRA MAGV TON TAI CHUA?
  public function check_magv($new_magv,$old_magv)
   {
        if($new_magv!=$old_magv)
        {
            if($this->mgiaovien->magv_exist($new_magv)) 
            {
                $this->form_validation->set_message("check_magv","<span title='Thông báo lỗi'><b style='color:red'>".$new_magv."</b> đã tồn tại.</span>");
                return false;   
            }
            else return true;
        }
        else return true;
   }
   //KIEM TRA KIEU NGAY DD/MM/YYYY (NEW)
   function check_date($str)
    {    
         if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $str))
         {
            if(checkdate(substr($str, 3, 2), substr($str, 0, 2), substr($str, 6, 4)))
            {
                return true;
            }
                    
            else
            {
                $this->form_validation->set_message('check_date','Ngày tháng không hợp lệ(dd/mm/yyyy)');
                return false;
            }
                   
         }
         else
         {
                $this->form_validation->set_message('check_date','Ngày tháng không hợp lệ(dd/mm/yyyy)');
                return false;
         }
        
    } 
   public function read_import_file($file_data)   
   {
        $file_name=$file_data["file_name"];
        $full_name=$file_data["full_path"];
        $file_ext=$file_data["file_ext"];
            
            
        $objPHPExcel = new PHPExcel();
        $giaovien_array=array();  
        
   
            if($file_ext==".cgv")
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
                        $giaovien_array[]=$tempt;
                    }
                   
                       
                }//end for
            }//end extension .cgv
            
            else if($file_ext==".xls")
                {
                    $inputFileType = 'EXCEL5';
                    
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($full_name);
                    
                    $str_col= $objPHPExcel->getActiveSheet()->getHighestColumn();
                    $num_col=PHPExcel_Cell::columnIndexFromString($str_col);
                    $num_row=$str_row=$objPHPExcel->getActiveSheet()->getHighestRow();
                    
                    
                    
                    $giaovien_array=array();                
                          
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
                            $giaovien_array[]=$tempt;
                        }
                       
                    }
                
                }
                else//word 2007
                {
                    $inputFileType = 'EXCEL2007';
                    
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($full_name);
                    
                    $str_col= $objPHPExcel->getActiveSheet()->getHighestColumn();
                    $num_col=PHPExcel_Cell::columnIndexFromString($str_col);
                    $num_row=$str_row=$objPHPExcel->getActiveSheet()->getHighestRow();
                    $giaovien_array=array();                
                          
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
                            $giaovien_array[]=$tempt;
                        }
                       
                    }
                }
            return $giaovien_array;
    
   }
}//end CONTROLLER SINHVIEN
?>
