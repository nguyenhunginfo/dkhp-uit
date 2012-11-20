<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monhoc extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");        
        $this->load->model("admin/mmonhoc");
        $this->load->library('PHPExcel');
    }
	public function index($loai="tatca")
	{  
	   //get khoa make menu
        $khoa_result=$this->mmonhoc->get_khoa();
        //get data to dump into table
        $monhoc_result=$this->mmonhoc->get_monhoc("",$loai,0,15);//lay danh sach monhoc cac loai 15 record dau tien
        
        if($loai=="DC") $data["data_title"]="Thao tác thêm môn học đại cương";
        else if($loai=="CN") $data["data_title"]="Thao tác thêm môn học chuyên nghành";
        else $data["data_title"]="Thao tác thêm môn học";
        
        
        //tong so hang de tao phan trang
        $num_rows=$this->mmonhoc->get_num_rows("",$loai);
        
        //make pagination
        $this->load->library("pagination");        
        $config["base_url"]="http://dkhp.uit.edu.vn/quanly/monhoc/ajax_full_data";
        $config["total_rows"]=$num_rows;
        
        $config["per_page"]=15;
        $this->pagination->initialize($config);
        $data["pagination"]=$this->pagination->create_links();
        //data for view
        $data["khoa_result"]=$khoa_result;        
        $data["monhoc_result"]=$monhoc_result;
        $data["loai"]=$loai;
        $data["total_rows"]=$num_rows;
        $data["title"]="Trang quản lý môn học";        
        
		$this->load->view('admin/vmonhoc',$data);        
   	}
    public function themmh($loai="")
    {
         $khoa_result=$this->mmonhoc->get_khoa();
        $data["khoa_result"]=$khoa_result;
        $data["loai"]=$loai;        
        if($loai=="DC") $data["data_title"]="Danh sách môn học đại cương";
        else if($loai=="CN") $data["data_title"]="Danh sách môn học chuyên nghành";
        else $data["data_title"]="Danh sách môn học";
        
        
        $data["title"]="Trang thêm môn học";  
        $this->load->view("admin/vmonhoc_add",$data);  
    }
    public function ajax_full_data($start=0)
    {
        $loai=$this->input->post("loai");
        $limit=$this->input->post("limit");
        $search=$this->input->post("search");
        $monhoc_result=$this->mmonhoc->get_monhoc($search,$loai,$start,$limit);//lay danh sach monhoc cac loai 15 record dau tien
        $count_rows=count($monhoc_result);
        
        if($count_rows>0)
        {
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/monhoc/ajax_full_data";
            $config["total_rows"]=$this->mmonhoc->get_num_rows($search,$loai);
            
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
                <th id="mamh"></th>
                <th id="tenmh"></th>
                <th id="sotc"></th>
                <th id="tclt"></th>
                <th id="tcth"></th>
                <th id="loai"></th>                
            </tr>';            
             foreach($monhoc_result as $row)
             {
                echo "<tr>";
                echo "<td class='checkbox'><input id='".$row->MaMH."' class='checkbox_row' type='checkbox' /></td>";
                echo "<td class='mamh' title='Sửa đổi'>".$row->MaMH."</td>";
                echo "<td class='tenmh' style='text-align:left' >".$row->TenMH."</td>";
                echo "<td class='sotc'>".$row->SoTC."</td>";
                echo "<td class='tclt'>".$row->TCLT."</td>";
                echo "<td class='tcth'>".$row->TCTH."</td>";
               if($row->Loai=="DC" )echo "<td class='loai'>Đại Cương</td>";
                            else  echo "<td class='loai'>Chuyên Nghành</td>";                
                echo "</tr>";
             }
                             
            echo '</table><!--end #table_data -->';
            echo '</div><!--end #scroll -->';
            
        }
        else echo "Dữ liệu trống.";
        
    }
    
    function ajax_data()
   {
        
        $mamh=$this->input->post("mamh");
        
        $data_result=$this->mmonhoc->get_monhoc_data($mamh);
        if(count($data_result)>0)
        {
            foreach($data_result as $row)
            {   
                echo "<table class='info' id='". $row->MaMH."'>";
                echo "<tr><td>Mã Môn Học</td>
                          <td><input  name='mamh'  id='mamh'  type='text' title='Mã môn học gồm 5 kí tự' value='". $row->MaMH."'/></td>
                          </tr>";
                echo "<tr><td>Tên Môn Học</td>      <td><input  name='tenmh' id='tenmh' type='text' value='". $row->TenMH."'/> </td></tr>";
                echo "<tr><td>Số Tín Chỉ</td>       <td><input  name='sotc' id='sotc' type='text' value='". $row->SoTC."'/> </td></tr>";
                echo "<tr><td>Tín Chỉ Lý Thuyết</td><td><input  name='tclt' id='tclt' type='text' value='". $row->TCLT."'/> </td></tr>";
                echo "<tr><td>Tín Chỉ Thực Hành</td><td><input  name='tcth' id='tcth' type='text' value='". $row->TCTH."' disabled='disabled'/> </td></tr>";
                if($row->Loai=="DC")
                {
                    echo "<tr><td>Loại Môn</td>
                             <td><select id='loai'>
                                <option value='DC' selected='selected'>Đại Cương</option>
                                <option value='CN' >Chuyên Nghành</option>
                                </select>
                             </td></tr>";   
                }
                else
                {
                    echo "<tr><td>Loại Môn</td>
                             <td><select id='loai'>
                                <option value='DC' >Đại Cương</option>
                                <option value='CN' selected='selected' >Chuyên Nghành</option>
                                </select>
                             </td></tr>";  
                }
                                       
                echo "</table>";
              
                
                
               // echo "<div class='error'></div>";
                echo "<table class='error'>";
                
                echo "</table>";
                
            }
        }
        else echo "Lỗi dữ liệu";
   }
   
   function ajax_update()
   {
            
            $this->load->library("form_validation");            
            $key=$this->input->post("key"); 
                 
            $this->form_validation->set_rules('mamh', 'Mã môn học', "required|exact_length[5]|callback_check_mamh[$key]");//kiem tra khoa chinh
            $this->form_validation->set_rules('tenmh', 'Tên môn học', 'required');
            $this->form_validation->set_rules('sotc', 'Số tín chỉ', 'numeric');
            $this->form_validation->set_rules('tclt', 'tín chỉ lý thuyết', 'numeric');
            $this->form_validation->set_rules('tcth', 'tín chỉ thực hành', 'numeric');
            
            if($this->form_validation->run() ==false)
            {
                //echo validation_errors();
                echo "<tr><td>".form_error("mamh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tenmh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("sotc","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tclt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tcth","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                                
            } 
            else 
            {
               
               $data["mamh"]=$this->input->post("mamh");
               $data["tenmh"]=$this->input->post("tenmh");
               $data["sotc"]=$this->input->post("sotc");
               $data["tclt"]=$this->input->post("tclt");
               $data["tcth"]=$this->input->post("tcth");
               $data["loai"]=$this->input->post("loai");
               
               $this->db->update("monhoc",$data,array("MaMH"=>$key));
               
               echo "success";
            }
    
     
   }
   
   function ajax_insert()
   {
            
            $this->load->library("form_validation");            
            $key=$this->input->post("key"); 
                 
            $this->form_validation->set_rules('mamh', 'Mã môn học', "required|exact_length[5]|callback_check_mamh[$key]");//kiem tra khoa chinh
            $this->form_validation->set_rules('tenmh', 'Tên môn học', 'required');
            $this->form_validation->set_rules('sotc', 'Số tín chỉ', 'required|numeric');
            $this->form_validation->set_rules('tclt', 'Số tín chỉ lý thuyết', 'required|numeric');
            $this->form_validation->set_rules('tcth', 'Số tín chỉ thực hành', 'required|numeric');
            
            
            if($this->form_validation->run() ==false)
            {
                //echo validation_errors();
                echo "<tr><td>".form_error("mamh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tenmh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("sotc","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tclt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("tcth","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            } 
            else 
            {
               
               $data["mamh"]=strtoupper($this->input->post("mamh"));
               $data["tenmh"]=$this->input->post("tenmh");
               $data["sotc"]=$this->input->post("sotc");
               $data["tclt"]=$this->input->post("tclt");
               $data["tcth"]=$this->input->post("tcth");
               $data["loai"]=$this->input->post("loai");
               $this->db->insert("monhoc",$data);
               echo "success";
            }
    
     
   }
   function ajax_delete()
   {
        $mamh_array=$this->input->post("mamh_array");
        if(count($mamh_array)>0)
        { 
            foreach($mamh_array as $key=>$value)
            {
                if($key==0) $this->db->where("MaMH",$value);
                else  $this->db->or_where("MaMH",$value);
                    
            }
            //$str_where="MaSV IN".array_values($mssv_array);
            //echo $str_where;
            $this->db->delete("monhoc");
            
        }
   }
   function check_mamh($new_mamh,$old_mamh)
   {
        if($new_mamh!=$old_mamh)
        {
            if($this->mmonhoc->mamh_exist($new_mamh)) 
            {
                $this->form_validation->set_message("check_mamh","<span title='Thông báo lỗi'><b style='color:red'>".$new_mamh."</b> đã tồn tại.</span>");
                return false;   
            }
            else return true;
        }
        else return true;
   }
//==============================================XUAT DU LIEU=================================================================================================================================================    
    function xuatdl()
	{  
	       
           $loai=$this->input->post("loai");
           $start=$this->input->post("start");
           $end=$this->input->post("end");
           $limit=$end-$start;        
           $search=$this->input->post("search");
           $file=$this->input->post("file");
           
           $this->form_validation->set_rules("file","File","required");
           if($this->form_validation->run())
            {
    //=================================================CSV================================================================================================================================================      
                if($file=="CSV")
                {
                    $objPHPExcel = new PHPExcel();
                    
                    
                    $monhoc_result=$this->mmonhoc->get_monhoc($search,$loai,$start,$limit);
                    $fields=array("MaMH","TenMH","SoTC","TCLT","TCTH","Loai");
                    $ncol=0;
                    $nrow=1;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);    
                    
                    foreach($monhoc_result as $row)
                    {
                                                                      
                        $sheet_dsmh->setCellValueByColumnAndRow(0,$nrow,$row->MaMH);
                        $sheet_dsmh->setCellValueByColumnAndRow(1,$nrow,$row->TenMH);
                        $sheet_dsmh->setCellValueByColumnAndRow(2,$nrow,$row->SoTC);
                        $sheet_dsmh->setCellValueByColumnAndRow(3,$nrow,$row->TCLT);
                        $sheet_dsmh->setCellValueByColumnAndRow(4,$nrow,$row->TCTH);                        
                        $sheet_dsmh->setCellValueByColumnAndRow(5,$nrow,$row->Loai);
                        
                        $nrow++; 
                        
                        
                    }
                   
                    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                    $objPHPExcel->setActiveSheetIndex(0);
                    $filename="Danh_Sach_MH_".$loai;
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
                    $monhoc_result=$this->mmonhoc->get_monhoc($search,$loai,$start,$limit);
                    $fields=array("MaMH","TenMH","SoTC","TCLT","TCTH","Loai");
                    $ncol=0;
                    $nrow=2;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);
            //======TITLE============================================================================================================            
                    $sheet_dsmh->getCell("A1")->setValue("Mã Môn Học"); 
                    $sheet_dsmh->getColumnDimension('A')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("B1")->setValue("Tên Môn Học");        
                    $sheet_dsmh->getColumnDimension('B')->setWidth(35);
                    
                    $sheet_dsmh->getCell("C1")->setValue("Số Tín Chỉ");
                    $sheet_dsmh->getColumnDimension('C')->setWidth(12);
                    
                    
                    $sheet_dsmh->getCell("D1")->setValue("Tín Chỉ LT");
                    $sheet_dsmh->getColumnDimension('D')->setWidth(12);
                    
                    $sheet_dsmh->getCell("E1")->setValue("Tín Chỉ TH");
                    $sheet_dsmh->getColumnDimension('E')->setWidth(12);
                    
                    $sheet_dsmh->getCell("F1")->setValue("Loại Môn");
                    $sheet_dsmh->getColumnDimension('F')->setWidth(20);
                    
                    $sheet_dsmh->getStyle("A1:F1")->getFont()->setSize(12)->setBold(true);
            //======DATA============================================================================================================            
                    foreach($monhoc_result as $row)
                    {
                        $ncol=0;
                        foreach($fields as $field)
                        {
                            if($field=="Loai" && $row->$field=="DC")$sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("Đại Cương");
                            else if($field=="Loai" && $row->$field=="CN") $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("Chuyên Nghành");
                            else $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue($row->$field);
                            $ncol++;
                        }                
                        $nrow++;
                    }
                    // Rename worksheet
                    $objPHPExcel->getActiveSheet()->setTitle('DSMH_'.$loai);
                    
                    
                    $objPHPExcel->setActiveSheetIndex(0);
                    $filename="Danh_Sach_MH_".$loai;
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
                    $monhoc_result=$this->mmonhoc->get_monhoc($search,$loai,$start,$limit);
                    $fields=array("MaMH","TenMH","SoTC","TCLT","TCTH","Loai");
                    $ncol=0;
                    $nrow=2;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);
            //======TITLE============================================================================================================            
                    $sheet_dsmh->getCell("A1")->setValue("Mã Môn Học"); 
                    $sheet_dsmh->getColumnDimension('A')->setAutoSize(true);
                    
                    $sheet_dsmh->getCell("B1")->setValue("Tên Môn Học");        
                    $sheet_dsmh->getColumnDimension('B')->setWidth(35);
                    
                    $sheet_dsmh->getCell("C1")->setValue("Số Tín Chỉ");
                    $sheet_dsmh->getColumnDimension('C')->setWidth(12);
                    
                    
                    $sheet_dsmh->getCell("D1")->setValue("Tín Chỉ LT");
                    $sheet_dsmh->getColumnDimension('D')->setWidth(12);
                    
                    $sheet_dsmh->getCell("E1")->setValue("Tín Chỉ TH");
                    $sheet_dsmh->getColumnDimension('E')->setWidth(12);
                    
                    $sheet_dsmh->getCell("F1")->setValue("Loại Môn");
                    $sheet_dsmh->getColumnDimension('F')->setWidth(20);
                    
                    $sheet_dsmh->getStyle("A1:F1")->getFont()->setSize(12)->setBold(true);
            //======DATA============================================================================================================            
                    foreach($monhoc_result as $row)
                    {
                        $ncol=0;
                        foreach($fields as $field)
                        {
                            if($field=="Loai" && $row->$field=="DC")$sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("Đại Cương");
                            else if($field=="Loai" && $row->$field=="CN") $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("Chuyên Nghành");
                            else $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue($row->$field);
                            $ncol++;
                        }                
                        $nrow++;
                    }
                    // Rename worksheet
                    $objPHPExcel->getActiveSheet()->setTitle('DSMH_'.$loai);
                    
                    
                    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                    $objPHPExcel->setActiveSheetIndex(0);
                    
                    $filename="Danh_Sach_MH_".$loai;
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
                $khoa_result=$this->mmonhoc->get_khoa();
                $data["khoa_result"]=$khoa_result;
        
                $data["title"]="Trang xuất dữ liệu";  
                $this->load->view("admin/vmonhoc_export",$data);   
                  
            }
	    
        
   	}//END EXPORT DATA
   
   
   function nhapdl()
    {
        $this->load->helper("url");
        $this->load->library("form_validation");
        $this->form_validation->set_rules("file_upload","Tập tin","callback_exist_file");              
        if($this->form_validation->run())
        {  
            
            $file_data=$this->upload->data();
            $import_type=$this->input->post("import_type");
            
            
            try
            {
                $monhoc_array=$this->read_import_file($file_data);    
                $num_errors=$this->check_error_data($monhoc_array,$import_type);
                
                //LOI=============================================================================================
                if($num_errors>0) 
                {
                    
                    $khoa_result=$this->mmonhoc->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["import_type"]=$import_type;
                    $data["error_data"]=$monhoc_array;
                    $data["num_errors"]=$num_errors;
                    $data['right_title']="Thao tác nhập dữ liệu từ tập tin <img src='".static_url()."/images/delete.png' />";   
                    
                    
                    $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vmonhoc_import_error",$data);    
                }
                //=OK IMPORT INTO DATA======================================================================================
                else
                {
                    
                    $this->mmonhoc->import_monhoc($monhoc_array,$import_type);                    
                    
                    $khoa_result=$this->mmonhoc->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["success_data"]=$monhoc_array;
                    $data["num_success"]=count($monhoc_array);
                    $data['right_title']="Thao tác nhập dữ liệu";
                     
                     $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vmonhoc_import_success",$data); 
                }
                
            }
            catch(exception $ex)
            {
                $khoa_result=$this->mmonhoc->get_khoa();
                $data["khoa_result"]=$khoa_result;
                
                
                $data["import_type"]=$import_type;//$_POST rebuild
                $data["error_array"]="Lỗi khi đọc tập tin";
                $data["error_data"]=array();
                $data["num_errors"]=0;
                $data["title"]="Trang nhập dữ liệu";  
                $this->load->view("admin/vmonhoc_import_error",$data); 
                
            }
            
            
             
           
        }
        else//load binh thuong khong co form
        {
            $khoa_result=$this->mmonhoc->get_khoa();
            $data["khoa_result"]=$khoa_result;
            
            $data["title"]="Trang nhập dữ liệu";  
            $this->load->view("admin/vmonhoc_import",$data);    
        }
           
    }//END IMPORT FROM FILE    
    
    
    //============VALID SINHVIEN WHEN IMPORT==============================================================================================================
    public function valid_mamh($mamh,$arr_unique,$type="insert")
       {
          if(in_array($mamh,$arr_unique)) return false;
          else if ($this->mmonhoc->mamh_exist($mamh,$type)) return false;
          return true;
       }
    public function check_error_data($data,$import_type="insert")
    {
        $num_errors=0;
        $array_unique=array();
        foreach($data as $row)
        {
            if($this->valid_mamh($row["MaMH"],$array_unique,$import_type)==false) $num_errors++;
            $array_unique[]=$row["MaMH"];
            
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

   public function read_import_file($file_data)   
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
                    $MaMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                    $TenMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                    $SoTC=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                    $TCLT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                    $TCTH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                    $Loai=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();                    
                    if($MaMH!="")
                    {
                        $tempt=array("MaMH"=>$MaMH,
                                 "TenMH"=>$TenMH,
                                 "SoTC"=>$SoTC,
                                 "TCLT"=>$TCLT,
                                 "TCTH"=>$TCTH,
                                 "Loai"=>$Loai);
                                 
                        $monhoc_array[]=$tempt;
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
                    
                    
                    
                    $monhoc_array=array();                
                          
                    for($row_index=2;$row_index<=$num_row;$row_index++)
                    {
                        
                        
                        $MaMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $TenMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                        $SoTC=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                        $TCLT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                        $TCTH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                        $Loai=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();    
                        if($Loai=="Đại Cương") $Loai="DC";
                        else $Loai="CN";                
                        if($MaMH!="")
                        {
                            $tempt=array("MaMH"=>$MaMH,
                                     "TenMH"=>$TenMH,
                                     "SoTC"=>$SoTC,
                                     "TCLT"=>$TCLT,
                                     "TCTH"=>$TCTH,
                                     "Loai"=>$Loai);
                                     
                            $monhoc_array[]=$tempt;
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
                    $monhoc_array=array();                
                          
                    for($row_index=2;$row_index<=$num_row;$row_index++)
                    {   
                        $MaMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $TenMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                        $SoTC=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                        $TCLT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                        $TCTH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                        $Loai=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();
                        if($Loai=="Đại Cương") $Loai="DC";
                        else $Loai="CN";                    
                        if($MaMH!="")
                        {
                            $tempt=array("MaMH"=>$MaMH,
                                     "TenMH"=>$TenMH,
                                     "SoTC"=>$SoTC,
                                     "TCLT"=>$TCLT,
                                     "TCTH"=>$TCTH,
                                     "Loai"=>$Loai);
                                     
                            $monhoc_array[]=$tempt;
                        }
                       
                       
                    }
                }
            return $monhoc_array;
    
   }
   public function thongke()
    {
         $khoa_result=$this->mmonhoc->get_khoa();
        $data["khoa_result"]=$khoa_result;              
        $data["data_title"]="Thống kê môn học";
        
        $data["title"]="Trang thêm môn học";  
        $this->load->view("admin/vmonhoc_statistic",$data);  
          
    }
   
}



?>