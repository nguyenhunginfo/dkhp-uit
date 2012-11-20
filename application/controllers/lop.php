<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Lop extends CI_Controller {
    

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");        
        $this->load->model("admin/mlop");
        $this->load->library('PHPExcel');
        
    }
	public function index($loai="lt")
	{       //get khoa make menu
            $khoa_result=$this->mlop->get_khoa();
            //get data to dump into table
            $lop_result=$this->mlop->get_lop("",$loai,0,15);//lay danh sach sinh vien cac khoa, thuoc cac k, 15 record dau tien
           
            //tong so hang de tao phan trang
            $num_rows=$this->mlop->get_num_rows("",$loai);
            
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/sinhvien/ajax_full_data";
            $config["total_rows"]=$num_rows;
            $config["per_page"]=15;
            $this->pagination->initialize($config);
            $data["pagination"]=$this->pagination->create_links();
            //data for view
            $data["khoa_result"]=$khoa_result;
            $data["loai"]=$loai;
            $data["lop_result"]=$lop_result;
            $data["total_rows"]=$num_rows;//get total rows to export function
            if($loai=="lt") $data["data_title"]="Danh sách lớp lý thuyết";
            else $data["data_title"]="Danh sách lớp thực hành";
            $data["title"]="Trang quản lý lớp";        
            
    		$this->load->view('admin/vlop',$data);  
              
        
   	}
        
//DANH SACH SINHVIEN====================================================================================================================================================
    //ajax load lai datas
    public function ajax_full_data($start=0)
    {
        
        $loai=$this->input->post("loai");
        $limit=$this->input->post("limit");
        $search=$this->input->post("search");
        $lop_result=$this->mlop->get_lop($search,$loai,$start,$limit);//lay danh sach monhoc cac loai 15 record dau tien
        $count_rows=count($lop_result);
        
        if($count_rows>0)
        {
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/lop/ajax_full_data";
            $config["total_rows"]=$this->mlop->get_num_rows($search,$loai);
            
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
                <th id="malop"></th>                
                <th id="tenmh"></th>
                <th id="tengv"></th>                
                <th id="thu"></th>
                <th id="ca"></th>
                <th id="phong"></th>
                <th id="min"></th>
                <th id="max"></th>
                <th id="slht"></th>                
            </tr>';            
             foreach($lop_result as $row)
             {
                echo "<tr>";
                echo "<td class='checkbox'><input id='".$row->MaLop."' class='checkbox_row' type='checkbox' /></td>";
                echo "<td class='malop' title='Sửa đổi'>".$row->MaLop."</td>";
                echo "<td class='tenmh' style='text-align:left' >".$row->TenMH."</td>";
                echo "<td class='tengv' style='text-align:left'>".$row->TenGV."</td>";                                
                echo "<td class='thu'>".$row->Thu."</td>";
                echo "<td class='ca'>".$row->Ca."</td>";
                echo "<td class='phong'>".$row->Phong."</td>";
                echo "<td class='min'>".$row->Min."</td>";
                echo "<td class='max'>".$row->Max."</td>";
                echo "<td class='slht'>".$row->SLHT."</td>" ;           
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

        $malop=$this->input->post("malop");
        $loai=$this->input->post("loai");
        
        $data_result=$this->mlop->get_lop_data($malop,$loai);        
        if(count($data_result)>0)
        {
            foreach($data_result as $row)
            {   
                echo "<table class='info' id='". $row->MaLop."'>";
                echo "<tr><td>Mã Lớp</td>
                          <td><input  name='malop'  id='malop'  type='text' title='Mã Lớp' value='". $row->MaLop."'/></td>
                      </tr>";
                //===============================================================================================
                $monhoc_result=$this->mlop->get_monhoc();
                echo "<tr><td>Tên Môn Học</td>
                          <td>
                          <select name='mamh' id='mamh'>";
                              foreach($monhoc_result as $monhoc_row)
                              {
                                if($monhoc_row->MaMH==$row->MaMH) echo "<option selected='selected' value='".$monhoc_row->MaMH."'>".$monhoc_row->TenMH."</option>";
                                else echo "<option value='".$monhoc_row->MaMH."'>".$monhoc_row->TenMH."</option>";
                               
                              }
                echo     "</select>
                          </td>
                      </tr>";
                //==============================================================================================
                $giaovien_result=$this->mlop->get_giaovien();
                echo "<tr><td>Tên Giáo Viên</td>
                          <td>
                          <select name='magv' id='magv' class='".$row->MaGV."'>";
                              foreach($giaovien_result as $giaovien_row)
                              {
                                if($giaovien_row->MaGV==$row->MaGV) echo "<option selected='selected' value='".$giaovien_row->MaGV."'>".$giaovien_row->TenGV."</option>";
                                else echo "<option value='".$giaovien_row->MaGV."'>".$giaovien_row->TenGV."</option>";
                               
                              }
                echo     "</select>
                          </td>
                      </tr>";
                //==============================================================================================
                $thu_result=$this->mlop->get_thu();
                echo "<tr><td>Thứ</td>
                          <td>
                          <select name='thu' id='thu' class='".$row->Thu."'>";
                              foreach($thu_result as $thu_row)
                              {
                                if($thu_row->TenThu==$row->Thu) echo "<option selected='selected' value='".$thu_row->TenThu."'>".$thu_row->TenThu."</option>";
                                else echo "<option value='".$thu_row->TenThu."'>".$thu_row->TenThu."</option>";
                               
                              }
                echo     "</select>
                          </td>
                      </tr>";
                      
                //==============================================================================================
                $ca_result=$this->mlop->get_ca($row->MaGV,$row->Thu);
                echo "<tr><td>Ca</td>
                          <td>
                          <select name='ca' id='ca' class='".$row->Ca."'>";
                              echo "<option selected='selected' value='".$row->Ca."'>".$row->Ca."</option>";
                              foreach($ca_result as $ca_row)
                              {                                
                                echo "<option value='".$ca_row->TenCa."'>".$ca_row->TenCa."</option>";
                               
                              }
                echo     "</select>
                          </td>
                      </tr>";
                //==============================================================================================
                $phong_result=$this->mlop->get_phong($row->Thu,$row->Ca);
                echo "<tr><td>Phòng</td>
                          <td>
                          <select name='phong' id='phong' class='".$row->Phong."'>";
                              echo "<option selected='selected' value='".$row->Phong."'>".$row->Phong."</option>";
                              foreach($phong_result as $phong_row)
                              {                                
                                echo "<option value='".$phong_row->TenPhong."'>".$phong_row->TenPhong."</option>";
                               
                              }
                echo     "</select>
                          </td>
                      </tr>";
                echo "<tr><td>Min</td>
                          <td><input  name='min'  id='min'  type='text' title='Số lượng tối thiểu' value='". $row->Min."'/></td>
                      </tr>";
                echo "<tr><td>Max</td>
                          <td><input  name='max'  id='max'  type='text' title='Số lượng tối đa' value='". $row->Max."'/></td>
                      </tr>";                
                               
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
            $min=$this->input->post("min");     
            $this->form_validation->set_rules('malop', 'Mã Lớp', "required|callback_check_malop[$key]");//kiem tra khoa chinh
            $this->form_validation->set_rules('mamh', 'Tên môn học', 'required');
            $this->form_validation->set_rules('magv', 'Tên giáo viên', 'required');
            $this->form_validation->set_rules('thu', 'Thứ', 'required');
            $this->form_validation->set_rules('ca', 'Ca', 'required');
            $this->form_validation->set_rules('phong', 'Phòng', 'required');
            $this->form_validation->set_rules('min', 'Số lượng tối thiểu', 'required|numeric');
            $this->form_validation->set_rules('max', 'Số lượng tối đa', "required|numeric|callback_check_max[$min]");
            
           
            
            
            if($this->form_validation->run() ==false)
            {
                //echo validation_errors();
                echo "<tr><td>".form_error("malop","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("mamh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("magv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("thu","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("ca","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("phong","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("min","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("max","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                                               
            } 
            else 
            {
               $loai=$this->input->post("loai");
               $data["malop"]=$this->input->post("malop");
               $data["mamh"]=$this->input->post("mamh");
               $data["magv"]=$this->input->post("magv");
               $data["thu"]=$this->input->post("thu");               
               $data["ca"]=$this->input->post("ca");
               $data["phong"]=$this->input->post("phong");
               $data["min"]=$this->input->post("min");
               $data["max"]=$this->input->post("max");
                             
               
               $this->mlop->update_lop($key,$data,$loai);
               echo "success";
            }
    
     
   }//end ajax_update
   //==========================CALLBACK OF FORM VALIDATTION==========================================================================================================================
  public function check_malop($new_malop,$old_malop)
   {
        if($new_malop!=$old_malop)
        {
            if($this->mlop->malop_exist($new_malop)) 
            {
                $this->form_validation->set_message("check_malop","<span title='Thông báo lỗi'><b style='color:red'>".$new_malop."</b> đã tồn tại.</span>");
                return false;   
            }
            else return true;
        }
        else return true;
   }
   public function check_max($max,$min)
   {
        if($max<=$min)
        {            
            $this->form_validation->set_message("check_max","<span title='Thông báo lỗi'><b style='color:red'>giá trị max </b> phải lớn hơn min.</span>");
            return false;   
            
        }
        else return true;
   }
    
//==============================================INSERT SINHVIEN====================================================================================================================================================    
   public function ajax_insert()
   {
        $this->load->library("form_validation");            
        $key=$this->input->post("key"); 
        $min=$this->input->post("min");     
        $this->form_validation->set_rules('loai', 'Loại', 'required');
        $this->form_validation->set_rules('malop', 'Mã Lớp', "required|callback_check_malop[$key]");//kiem tra khoa chinh
        $this->form_validation->set_rules('mamh', 'Tên môn học', 'required');
        $this->form_validation->set_rules('magv', 'Tên giáo viên', 'required');
        $this->form_validation->set_rules('thu', 'Thứ', 'required');
        $this->form_validation->set_rules('ca', 'Ca', 'required');
        $this->form_validation->set_rules('phong', 'Phòng', 'required');
        $this->form_validation->set_rules('min', 'Số lượng tối thiểu', 'required|numeric');
        $this->form_validation->set_rules('max', 'Số lượng tối đa', "required|numeric|callback_check_max[$min]");
            
        if($this->form_validation->run() ==false)
        {
                //echo validation_errors();
            echo "<tr><td>".form_error("loai","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            echo "<tr><td>".form_error("malop","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            echo "<tr><td>".form_error("mamh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            echo "<tr><td>".form_error("magv","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            echo "<tr><td>".form_error("thu","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            echo "<tr><td>".form_error("ca","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            echo "<tr><td>".form_error("phong","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            echo "<tr><td>".form_error("min","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            echo "<tr><td>".form_error("max","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                                               
        } 
        else 
        {
            $loai=$this->input->post("loai");
            $data["malop"]=strtoupper($this->input->post("malop"));
            $data["mamh"]=$this->input->post("mamh");
            $data["magv"]=$this->input->post("magv");
            $data["thu"]=$this->input->post("thu");               
            $data["ca"]=$this->input->post("ca");
            $data["phong"]=$this->input->post("phong");
            $data["min"]=$this->input->post("min");
            $data["max"]=$this->input->post("max");
            $data["slht"]=0;               
               
            $this->mlop->insert_lop($loai,$data);
            echo "success";
        }
    
     
   }//end ajax insert
   
//==============================================DELETE SINHVIEN====================================================================================================================================================   
   public function ajax_delete()
   {
        $malop_array=$this->input->post("malop_array");
        $loai=$this->input->post("loai");
        $this->mlop->delete_lop($malop_array,$loai);
   }
   public function ajax_monhoc()
   {
        $loai=$this->input->post("loai");        
        
        $monhoc_result=$this->mlop->get_monhoc($loai);
                  
        foreach($monhoc_result as $monhoc_row)
        {
            echo "<option value='".$monhoc_row->MaMH."'>".$monhoc_row->TenMH."</option>";
        }
                
        
        
        
   }
   public function ajax_ca()
   {
        $magv=$this->input->post("magv");
        $thu=$this->input->post("thu");
        $ca_old=$this->input->post("ca_old");
        $ca_result=$this->mlop->get_ca($magv,$thu);
        if(count($ca_result)>0)
        {
            if($ca_old!="")echo "<option value='".$ca_old."'>".$ca_old."</option>";
            foreach($ca_result as $ca_row)
            {
                echo "<option value='".$ca_row->TenCa."'>".$ca_row->TenCa."</option>";
            }
                
        }
        else
        {
            if($ca_old!="")echo "<option value='".$ca_old."'>".$ca_old."</option>";
            else echo "<option value=''>Hết ca</option>";
             
        }
        
   }
    public function ajax_phong()
   {
        $thu=$this->input->post("thu");
        $ca=$this->input->post("ca");
        $phong_old=$this->input->post("phong_old");
        $phong_result=$this->mlop->get_phong($thu,$ca);//luu gia tri phong cu de tai tao lai(xem nhu chua thay doi)
        if(count($phong_result)>0)
        {
            if($phong_old!="")echo "<option value='".$phong_old."'>".$phong_old."</option>";
            foreach($phong_result as $phong_row)
            {
                echo "<option value='".$phong_row->TenPhong."'>".$phong_row->TenPhong."</option>";
            }
                
        }
        else
        {
            if($phong_old!="")echo "<option value='".$phong_old."'>".$phong_old."</option>";
            else echo "<option value=''>Hết phòng</option>";
             
        }
        
   }


//==============================================THEM SINHVIEN====================================================================================================================================================
    function themlop($loai="lt")
    {
        $khoa_result=$this->mlop->get_khoa();
        $data["khoa_result"]=$khoa_result;
        $data["loai"]=$loai;
        $data['data_title']="Thao tác thêm lớp";
        $data["title"]="Trang thêm lớp";  
        $this->load->view("admin/vlop_add",$data);   
    }
    
   
    /*
    
    
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
                    
                    $khoa_result=$this->mlop->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["khoa_active"]=$khoa_active;
                    $data["khoa"]=$khoa;
                    $data["import_type"]=$import_type;
                    $data["error_data"]=$sinhvien_array;
                    $data["num_errors"]=$num_errors;                   
                    
                    if($khoa!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->mlop->ten_khoa($khoa)."   <img src='".static_url()."/images/delete.png' />";
                    else $data['right_title']="Thao tác nhập dữ liệu từ tập tin";    
                    
                    
                    $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vsinhvien_import_error",$data);    
                }
                //=OK IMPORT INTO DATA======================================================================================
                else
                {
                    $this->mlop->import_sinhvien($khoa,$sinhvien_array,$import_type);
                    $khoa_result=$this->mlop->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["khoa"]=$khoa;
                    $data["TenKhoa"]=$this->mlop->ten_khoa($khoa);
                    $data["success_data"]=$sinhvien_array;
                    $data["num_success"]=count($sinhvien_array);
                    if($khoa!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->mlop->ten_khoa($khoa)."   <img src='".static_url()."/images/ok.png' />";
                    else $data['right_title']="Thao tác nhập dữ liệu từ tập tin"; 
                     $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vsinhvien_import_success",$data);    
                    
                }
            }
            catch(exception $ex)
            {
                $khoa_result=$this->mlop->get_khoa();
                $data["khoa_result"]=$khoa_result;
                $data["khoa_active"]=$khoa_active;//neu co
                $data["khoa"]=$khoa;//$_POST rebuild
                $data["import_type"]=$import_type;//$_POST rebuild
                $data["error_array"]="Lỗi khi đọc tập tin";
                $data["error_data"]=array();
                $data["num_errors"]=0;
               
                if($khoa!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->mlop->ten_khoa($khoa)."   <img src='".static_url()."/images/delete.png' />";
                else $data['right_title']="Thao tác nhập dữ liệu từ tập tin";  
                $data["title"]="Trang nhập dữ liệu";  
                $this->load->view("admin/vsinhvien_import_error",$data); 
                
            }
            
            
             
           
        }
        else//load binh thuong khong co form
        {
            $khoa_result=$this->mlop->get_khoa();
            $data["khoa_result"]=$khoa_result;
            $data["khoa_active"]=$khoa_active;
            if($khoa_active!="") $data['right_title']="Thao tác nhập dữ liệu khoa ".$this->mlop->ten_khoa($khoa_active);
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
           
           $this->form_validation->set_rules("file","file","required");
           if($this->form_validation->run())
            {
    //=================================================CSV================================================================================================================================================      
                if($file=="CSV")
                {
                    $objPHPExcel = new PHPExcel();
                    
                    
                    $sinhvien_result=$this->mlop->get_sinhvien($search,$khoa,$k,$start,$limit);
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
                    $sinhvien_result=$this->mlop->get_sinhvien($search,$khoa,$k,$start,$limit);
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
                    $sinhvien_result=$this->mlop->get_sinhvien($search,$khoa,$k,$start,$limit);
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
                $khoa_result=$this->mlop->get_khoa();
                $data["khoa_result"]=$khoa_result;
        
                $data["title"]="Trang xuất dữ liệu";  
                $this->load->view("admin/vsinhvien_export",$data);   
                  
            }
	    
        
   	}//END EXPORT DATA
 //================================================THONG KE==================================================================================================================================================
    public function count_sv($khoa="tatca",$k=0)
    {
         return $this->mlop->get_num_rows("",$khoa,$k);
    }
    public function thongke()
    {
        $khoa_result=$this->mlop->get_khoa();
        $K_result=$this->mlop->get_K();
         $SL["total"]=$this->mlop->get_num_rows();
        foreach($khoa_result as $row)
        {
            $SL[$row->MaKhoa][0]=$this->mlop->get_num_rows("",$row->MaKhoa);
            foreach($K_result as $k_row)
            {                
                $SL[$row->MaKhoa][$k_row->MaK]=$this->mlop->get_num_rows("",$row->MaKhoa,$k_row->MaK);
               
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
        $this->load->view("admin/vsinhvien_statistic",$data); 
          
    }
//============VALID SINHVIEN WHEN IMPORT==============================================================================================================
    public function valid_mssv($mssv,$arr_unique,$khoa="")
       {
          if(in_array($mssv,$arr_unique)) return false;
          else if ($this->mlop->mssv_exist_condition($mssv,$khoa)) return false;
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
       */

   /*
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
                else//word 2007
                {
                    $inputFileType = 'EXCEL2007';
                    
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
   */
}//end CONTROLLER SINHVIEN

?>
