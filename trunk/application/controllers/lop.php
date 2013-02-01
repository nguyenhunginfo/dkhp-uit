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
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/lop/ajax_full_data";
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
        
//=========DANH SACH LOP ======================================================================================================================================
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
                echo "<td class='slht'><a href='/quanly/lop/danh-sach/".$row->MaLop."' title='Xem danh sách' target='_blank'>".$row->SLHT."</a></td>";           
                echo "</tr>";
             }
                             
            echo '</table><!--end #table_data -->';
            echo '</div><!--end #scroll -->';
            
        }
        else echo "Dữ liệu trống.";
    
      
    }//end ajax_full_data
    
//==============================================DATA POPUP======================================================================================================   
    //tra ve 1 record sinh vien theo malop
    public function ajax_data()
   {

        $malop=$this->input->post("malop");
        $loai=$this->input->post("loai");
        //echo "$malop $loai";
        $data_result=$this->mlop->get_lop_data($malop);        
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
        
   }//end ajax data
   
//============TAO GIAO DIEN MO LOP==============================================================================================================
    public function ajax_lop_request()
   {

        $mamh=$this->input->post("mamh");
        $tenmh=$this->input->post("tenmh");
        $slht=$this->input->post("slht");
        
        echo "<table class='info'>";
        echo "<tr><td>Mã Lớp</td>
                  <td><input  name='malop'  id='malop'  type='text' title='Mã Lớp' value=''/></td>
             </tr>";
                //===============================================================================================
        
        echo "<tr><td>Tên Môn Học</td>
                  <td>$tenmh</td>
             </tr>";
                //==============================================================================================
                $giaovien_result=$this->mlop->get_giaovien();
                        echo "<tr><td>Tên Giáo Viên</td>
                                  <td>
                                  <select name='magv' id='magv' >";
                                      echo "<option value=''>Chọn giáo viên</option>";
                                      foreach($giaovien_result as $giaovien_row)
                                      {                                        
                                        echo "<option value='".$giaovien_row->MaGV."'>".$giaovien_row->TenGV."</option>";                                       
                                      }
                        echo     "</select>
                                  </td>
                              </tr>";
                        //==============================================================================================                        
                       $thu_result=$this->mlop->get_thu();
                        echo "<tr><td>Thứ</td>
                                  <td>
                                  <select name='thu' id='thu'>";
                                      foreach($thu_result as $thu_row)
                                      {                                        
                                        echo "<option value='".$thu_row->TenThu."'>".$thu_row->TenThu."</option>";                                       
                                      }
                        echo     "</select>
                                  </td>
                              </tr>";
                              
                        //==============================================================================================
                        
                        echo "<tr><td>Ca</td>
                                  <td>
                                  <select name='ca' id='ca'>";
                                      echo "<option value=''>Chọn ca</option>";                                      
                        echo     "</select>
                                  </td>
                              </tr>";
                        //==============================================================================================
                        
                        echo "<tr><td>Phòng</td>
                                  <td>
                                  <select name='phong' id='phong'>";
                                      echo "<option value=''>Chọn phòng</option>";                                      
                        echo     "</select>
                                  </td>
                              </tr>";
                      
                echo "<tr><td>Min</td>
                          <td><input  name='min'  id='min'  type='text' title='Số lượng tối thiểu' value='30'/></td>
                      </tr>";
                echo "<tr><td>Max</td>
                          <td><input  name='max'  id='max'  type='text' title='Số lượng tối đa' value='100'/></td>
                      </tr>";   
                 echo "<tr><td>SLHT</td>
                          <td title='$slht sinh viên đã đề nghị'>$slht</td>
                      </tr>";               
                               
                echo "</table>";
              
                
                
               // echo "<div class='error'></div>";
                echo "<table class='error'>";
                
                echo "</table>";
                
            
        
        
        
   }//end ajax data
   
     
//==============================================OPEN REQUEST LOP==========================================================================================================================================      
   public function ajax_open_lop()
   {

            $this->load->library("form_validation");            
             
            $min=$this->input->post("min");     
            $this->form_validation->set_rules('malop', 'Mã Lớp', "required|max_length[12]|callback_check_malop['']");//kiem tra khoa chinh            
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
               $data["malop"]=$this->input->post("malop");
               $data["mamh"]=$this->input->post("mamh");
               $data["magv"]=$this->input->post("magv");
               $data["thu"]=$this->input->post("thu");               
               $data["ca"]=$this->input->post("ca");
               $data["phong"]=$this->input->post("phong");
               $data["min"]=$this->input->post("min");
               $data["max"]=$this->input->post("max");
               $data["slht"]=$this->input->post("slht");                            
            
                $this->mlop->open_request_lop("lt",$data);
               
               echo "success";
            }
    
     
   }//end ajax_update
  
//==============================================UPDATE LOP==========================================================================================================================================      
   public function ajax_update()
   {

            $this->load->library("form_validation");            
            $key=$this->input->post("key"); 
            $min=$this->input->post("min");     
            $this->form_validation->set_rules('malop', 'Mã Lớp', "required|max_length[12]|callback_check_malop[$key]");//kiem tra khoa chinh
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
    
//==============================================INSERT LOP====================================================================================================================================================    
   public function ajax_insert()
   {
        $this->load->library("form_validation");            
        $key=$this->input->post("key"); 
        $min=$this->input->post("min");     
        $this->form_validation->set_rules('loai', 'Loại', 'required');
        $this->form_validation->set_rules('malop', 'Mã Lớp', "required|max_length[12]|callback_check_malop[$key]");//kiem tra khoa chinh
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
   
//==============================================DELETE LOP====================================================================================================================================================   
   public function ajax_delete()
   {
        $malop_array=$this->input->post("malop_array");
        $loai=$this->input->post("loai");
        $this->mlop->delete_lop($malop_array,$loai);
        //$this->mlop->delete_dangky($malop_array);
   }
//==============================================HO TRO AJAX==========================================================================
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


//==============================================THEM LOP====================================================================================================================================================
    function themlop($loai="lt")
    {
        $khoa_result=$this->mlop->get_khoa();
        $data["khoa_result"]=$khoa_result;
        $data["loai"]=$loai;
        $data['data_title']="Thao tác thêm lớp";
        $data["title"]="Trang thêm lớp";  
        $this->load->view("admin/vlop_add",$data);   
    }
    
   
    
    
    
//==============================================NHAP DU LIEU ====================================================================================================================================================
   //them sv page
   function nhapdl($loai_active="lt")
    {
        $this->load->helper("url");
        $this->load->library("form_validation");
        $this->form_validation->set_rules("file_upload","Tập tin","callback_exist_file");              
        if($this->form_validation->run())
        {            
            $file_data=$this->upload->data();
            $loai=$this->input->post("loai");
            $import_type=$this->input->post("import_type");
            
            try
            {
                $lop_array=$this->read_import_file($file_data); 
                $num_errors=$this->check_error_data($lop_array,$import_type,$loai);
               
                //LOI=============================================================================================
                if($num_errors>0) 
                {
                    
                    $khoa_result=$this->mlop->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["loai_active"]=$loai_active;
                    $data["loai"]=$loai;
                    $data["import_type"]=$import_type;
                    $data["error_data"]=$lop_array;
                    $data["num_errors"]=$num_errors;                   
                    
                    if($loai_active=="lt")      $data['right_title']="Thao tác nhập dữ liệu lớp lý thuyết <img src='".static_url()."/images/delete.png' />";
                    else if($loai_active=="th") $data['right_title']="Thao tác nhập dữ liệu từ lớp thực hành <img src='".static_url()."/images/delete.png' />";
                         else $data['right_title']="Thao tác nhập dữ liệu <img src='".static_url()."/images/delete.png' />";
                    
                    $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vlop_import_error",$data);    
                }
                //=OK IMPORT INTO DATA======================================================================================
                else
                {   
                    $this->mlop->import_lop($lop_array,$import_type,$loai);
                    
                    $khoa_result=$this->mlop->get_khoa();
                    $data["khoa_result"]=$khoa_result;
                    $data["loai_active"]=$loai_active;
                    $data["loai"]=$loai;
                    $data["import_type"]=$import_type;
                    $data["success_data"]=$lop_array;
                    $data["num_success"]=count($lop_array);                   
                    
                    if($loai_active=="lt")      $data['right_title']="Thao tác nhập dữ liệu lớp lý thuyết <img src='".static_url()."/images/ok.png' />";
                    else if($loai_active=="th") $data['right_title']="Thao tác nhập dữ liệu từ lớp thực hành <img src='".static_url()."/images/ok.png' />";
                         else $data['right_title']="Thao tác nhập dữ liệu <img src='".static_url()."/images/ok.png' />";
                    
                    $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vlop_import_success",$data);   
                    
                   // header("Location:/quanly/lop");    
                    
                }
                
            }
            catch(exception $ex)
            {
                $khoa_result=$this->mlop->get_khoa();
                $data["khoa_result"]=$khoa_result;
                $data["khoa_active"]=$loai_active;//neu co                
                $data["import_type"]=$import_type;//$_POST rebuild
                $data["error_array"]="Lỗi khi đọc tập tin";
                $data["error_data"]=array();
                $data["num_errors"]=0;
               
                if($loai_active=="lt")      $data['right_title']="Thao tác nhập dữ liệu lớp lý thuyết <img src='".static_url()."/images/delete.png' />";
                    else if($loai_active=="th") $data['right_title']="Thao tác nhập dữ liệu từ lớp thực hành <img src='".static_url()."/images/delete.png' />";
                         else $data['right_title']="Thao tác nhập dữ liệu <img src='".static_url()."/images/delete.png' />";
                         
                $data["title"]="Trang nhập dữ liệu";  
                $this->load->view("admin/vlop_import_error",$data); 
                
            }
        }
        else//load binh thuong khong co form
        {
            
            
            
            $khoa_result=$this->mlop->get_khoa();
            $data["khoa_result"]=$khoa_result;
            $data["loai_active"]=$loai_active;
            
            if($loai_active=="lt")      $data['right_title']="Thao tác nhập dữ liệu lớp lý thuyết";
            else if($loai_active=="th") $data['right_title']="Thao tác nhập dữ liệu từ lớp thực hành";
                 else $data['right_title']="Thao tác nhập dữ liệu";
                 
            $data["title"]="Trang nhập dữ liệu";  
            $this->load->view("admin/vlop_import",$data);    
        }
           
    }//END IMPORT FROM FILE   
     

//============VALID LOP WHEN IMPORT==============================================================================================================
    public function valid_lop($lop,$arr_unique,$import_type,$loai)
       {
        
          $malop=$lop["MaLop"];
          $array_malop=$arr_unique["MaLop"];
          
          $magv_thu_ca=$lop["MaGV"].$lop["Thu"].$lop["Ca"];
          $array_magv_thu_ca=$arr_unique["MaGV_Thu_Ca"];
          
          $thu_ca_phong=$lop["Thu"].$lop["Ca"].$lop["Phong"];
          $array_thu_ca_phong=$arr_unique["Thu_Ca_Phong"];
          
          
          //0: no error
          //1: data_error
          //2: malop error
          //3: magv_thu_ca error
          //4: thu_ca_phong_error
          
          //CHECK 1 CHECK DATA TYPE
          if($lop["MaGV"]=="") return 11;//loai khi nhap ten giao vien ko ton tai;
          if($lop["MaMH"]=="") return 12;//loai khi nhap ten giao vien ko ton tai;
          if($this->mlop->thu_exist($lop["Thu"])==false) return 13;
          if($this->mlop->ca_exist($lop["Ca"])==false) return 14;
          if($this->mlop->phong_exist($lop["Phong"])==false) return 15;
          if(is_numeric($lop["Min"])==false) return 16;
          if(is_numeric($lop["Max"])==false) return 17;
          if(is_numeric($lop["SLHT"])==false) return 18;
          
          
          //CHECK 2 CHECK MALOP
          if(in_array($malop,$array_malop)) return 2;
          else
          {
            $tempt=$this->mlop->malop_exist_condition($malop,$import_type,$loai);            
            if($tempt==true) return 2;
          }
          
          //CHECK 3 KIEM TRA BO 3 MAGV,THU,CA
          if(in_array($magv_thu_ca,$array_magv_thu_ca)) return 3;
          else
          {
            $tempt=$this->mlop->magv_thu_ca_exist($lop,$import_type,$loai);
            if($tempt==true) return 3;
          }
          
          //CHECK 3 KIEM TRA BO 3 THU,CA,PHONG 
          if(in_array($thu_ca_phong,$array_thu_ca_phong)) return 4;
          else
          {
            $tempt=$this->mlop->thu_ca_phong_exist($lop,$import_type,$loai);
            if($tempt==true) return 4;
          }
          return 0;
          
          
       }
//============HAM KIEM TRA LOI CUA DATA===========================================================================================================
    public function check_error_data(&$data,$import_type,$loai)
    {
        $num_errors=0;
        $array_unique=array(
                            "MaLop"=>array(),
                            "MaGV_Thu_Ca"=>array(),
                            "Thu_Ca_Phong"=>array()
                        );
        $i=0;
        foreach($data as $row)
        {
            $lop=array();
            $lop["MaLop"]=$row["MaLop"];
            $lop["MaMH"]=$row["MaMH"];
            $lop["MaGV"]=$row["MaGV"];
            $lop["Thu"]=$row["Thu"];
            $lop["Ca"]=$row["Ca"];
            $lop["Phong"]=$row["Phong"];
            $lop["Min"]=$row["Min"];
            $lop["Max"]=$row["Max"];
            $lop["SLHT"]=$row["SLHT"];
            
            $result=$this->valid_lop($lop,$array_unique,$import_type,$loai);
            if($result!=0)
            {
                $data[$i]["error"]=$result;
                $num_errors++;  
            }  
            
            $array_unique["MaLop"][]=$row["MaLop"];
            $array_unique["MaGV_Thu_Ca"][]=$row["MaGV"].$row["Thu"].$row["Ca"];
            $array_unique["Thu_Ca_Phong"][]=$row["Thu"].$row["Ca"].$row["Phong"];
            $i++;    
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
        $lop_array=array();  
        
   
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
                    $MaLop=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                    $TenMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                    $TenGV=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                    $Thu=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                    $Ca=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                    $Phong=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();
                    $Min=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();
                    $Max=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7,$row_index)->getValue();
                    $SLHT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8,$row_index)->getValue();        
                          
                    
                    if($MaLop!="")//it nhat phai co ma lop
                    {
                        $MaGV=$this->mlop->get_MaGV($TenGV);
                        $MaMH=$this->mlop->get_MaMH($TenMH);
                        $tempt=array("MaLop"=>$MaLop,
                                 "MaMH"=>$MaMH,
                                 "TenMH"=>$TenMH,
                                 "MaGV"=>$MaGV,
                                 "TenGV"=>$TenGV,
                                 "Thu"=>$Thu,
                                 "Ca"=>$Ca,
                                 "Phong"=>$Phong,
                                 "Min"=>$Min,
                                 "Max"=>$Max,
                                 "SLHT"=>$SLHT,
                                 "error"=>0);
                        $lop_array[]=$tempt;
                    }//end if
                   
                       
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
                    
                    
                    
                    $lop_array=array();                
                          
                    for($row_index=2;$row_index<=$num_row;$row_index++)
                    {
                        
                        
                        $MaLop=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $TenMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                        $TenGV=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                        $Thu=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                        $Ca=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                        $Phong=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();
                        $Min=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();
                        $Max=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7,$row_index)->getValue();
                        $SLHT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8,$row_index)->getValue();
                        
                        if($MaLop!="")//it nhat phai co ma lop
                        {
                            $MaGV=$this->mlop->get_MaGV($TenGV);
                            $MaMH=$this->mlop->get_MaMH($TenMH);
                            $tempt=array("MaLop"=>$MaLop,
                                     "MaMH"=>$MaMH,
                                     "TenMH"=>$TenMH,
                                     "MaGV"=>$MaGV,
                                     "TenGV"=>$TenGV,
                                     "Thu"=>$Thu,
                                     "Ca"=>$Ca,
                                     "Phong"=>$Phong,
                                     "Min"=>$Min,
                                     "Max"=>$Max,
                                     "SLHT"=>$SLHT,
                                     "error"=>0);
                            $lop_array[]=$tempt;
                        }//end if
                    }//end for
                
                }
                else//word 2007
                {
                    $inputFileType = 'EXCEL2007';
                    
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($full_name);
                    
                    $str_col= $objPHPExcel->getActiveSheet()->getHighestColumn();
                    $num_col=PHPExcel_Cell::columnIndexFromString($str_col);
                    $num_row=$str_row=$objPHPExcel->getActiveSheet()->getHighestRow();
                    $lop_array=array();                
                          
                    for($row_index=2;$row_index<=$num_row;$row_index++)
                    {   
                        $MaLop=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$row_index)->getValue();
                        $TenMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$row_index)->getValue();
                        $TenGV=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$row_index)->getValue();
                        $Thu=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$row_index)->getValue();
                        $Ca=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4,$row_index)->getValue();
                        $Phong=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5,$row_index)->getValue();
                        $Min=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();
                        $Max=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7,$row_index)->getValue();
                        $SLHT=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8,$row_index)->getValue();        
                              
                        
                        if($MaLop!="")
                        {
                            $MaGV=$this->mlop->get_MaGV($TenGV);
                            $MaMH=$this->mlop->get_MaMH($TenMH);
                            $tempt=array("MaLop"=>$MaLop,
                                     "MaMH"=>$MaMH,
                                     "TenMH"=>$TenMH,
                                     "MaGV"=>$MaGV,
                                     "TenGV"=>$TenGV,
                                     "Thu"=>$Thu,
                                     "Ca"=>$Ca,
                                     "Phong"=>$Phong,
                                     "Min"=>$Min,
                                     "Max"=>$Max,
                                     "SLHT"=>$SLHT,
                                     "error"=>0);
                            $lop_array[]=$tempt;
                        }
                    }
                }
            return $lop_array;
    
   }//end read_data_file
   
//==============================================XUAT DU LIEU=================================================================================================================================================    
    function xuatdl()
	{  
	   
           
           $malop=$this->input->post("malop");
           //get data to dump into table             
           
           $file=$this->input->post("file");
           
           $this->form_validation->set_rules("file","file","required");
           if($this->form_validation->run())
            {    
                
    //============================================EXCEL 2003============================================================================================================           
                if($file=="EXCEL2003")
                {
                    
                    $objPHPExcel = new PHPExcel();
                    // Add some data
                    $danhsach_result=$this->mlop->get_lop_danh_sach($malop);    
                    $fields=array("STT","MaSV","TenSV","diemgk","diemth","diemck","diemhp","ghichu");
                    $ncol=0;
                    $nrow=2;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);
            //======TITLE============================================================================================================            
                    $sheet_dsmh->getCell("A1")->setValue("STT"); 
                    $sheet_dsmh->getColumnDimension('A')->setWidth(6);
                    
                    $sheet_dsmh->getCell("B1")->setValue("MSSV");        
                    $sheet_dsmh->getColumnDimension('B')->setWidth(20);
                    
                    $sheet_dsmh->getCell("C1")->setValue("Tên sinh viên");
                    $sheet_dsmh->getColumnDimension('C')->setWidth(30);
                    
                    $sheet_dsmh->getCell("D1")->setValue("Điểm giữa kỳ");
                    $sheet_dsmh->getStyle("D1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('D')->setWidth(20);
                    
                    $sheet_dsmh->getCell("E1")->setValue("Điểm thực hành");
                    $sheet_dsmh->getStyle("E1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('E')->setWidth(20);
                    
                    $sheet_dsmh->getCell("F1")->setValue("Cuối kỳ");
                    $sheet_dsmh->getStyle("F1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('F')->setWidth(20);
                    
                    $sheet_dsmh->getCell("G1")->setValue("Điểm học phần");
                    $sheet_dsmh->getStyle("G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('G')->setWidth(20);
                    
                    $sheet_dsmh->getCell("H1")->setValue("Ghi chú");
                    $sheet_dsmh->getStyle("H1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('H')->setWidth(20);                     
                    
                    $sheet_dsmh->getStyle("A1:H1")->getFont()->setSize(12)->setBold(true);
            //======DATA============================================================================================================
                          
                    foreach($danhsach_result as $row)
                    {
                        $ncol=0;
                        foreach($fields as $field)
                        {
                            if($field=="STT") $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue($nrow-1);
                            else 
                                if($field=="diemgk"||$field=="diemth"||$field=="diemck"||$field=="diemhp"||$field=="ghichu")
                                {
                                    $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("");
                                }
                                else
                                {
                                    $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValueExplicit(trim($row->$field),PHPExcel_Cell_DataType::TYPE_STRING);        
                                }
                            
                            $ncol++;
                        }                
                        $nrow++;
                    }
                    // Rename worksheet
                    $objPHPExcel->getActiveSheet()->setTitle('DSLOP_'.$malop);
                    
                    
                    $objPHPExcel->setActiveSheetIndex(0);
                    $filename="Danh sach lop_".$malop;
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
                    $danhsach_result=$this->mlop->get_lop_danh_sach($malop);    
                    $fields=array("STT","MaSV","TenSV","diemgk","diemth","diemck","diemhp","ghichu");
                    $ncol=0;
                    $nrow=2;
                    $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);
            //======TITLE============================================================================================================            
                    $sheet_dsmh->getCell("A1")->setValue("STT");                     
                    $sheet_dsmh->getColumnDimension('A')->setWidth(6);
                    
                    $sheet_dsmh->getCell("B1")->setValue("MSSV");        
                    $sheet_dsmh->getColumnDimension('B')->setWidth(20);
                    
                    $sheet_dsmh->getCell("C1")->setValue("Tên sinh viên");
                    
                    $sheet_dsmh->getColumnDimension('C')->setWidth(30);
                    
                    $sheet_dsmh->getCell("D1")->setValue("Điểm giữa kỳ");
                    $sheet_dsmh->getStyle("D1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('D')->setWidth(20);
                    
                    $sheet_dsmh->getCell("E1")->setValue("Điểm thực hành");
                    $sheet_dsmh->getStyle("E1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('E')->setWidth(20);
                    
                    $sheet_dsmh->getCell("F1")->setValue("Cuối kỳ");
                    $sheet_dsmh->getStyle("F1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('F')->setWidth(20);
                    
                    $sheet_dsmh->getCell("G1")->setValue("Điểm học phần");
                    $sheet_dsmh->getStyle("G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('G')->setWidth(20);
                    
                    $sheet_dsmh->getCell("H1")->setValue("Ghi chú");
                    $sheet_dsmh->getStyle("H1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet_dsmh->getColumnDimension('H')->setWidth(20);                    
                    
                    $sheet_dsmh->getStyle("A1:H1")->getFont()->setSize(12)->setBold(true);
            //======DATA============================================================================================================
                          
                    foreach($danhsach_result as $row)
                    {
                        $ncol=0;
                        foreach($fields as $field)
                        {
                            if($field=="STT") $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue($nrow-1);
                            else 
                                if($field=="diemgk"||$field=="diemth"||$field=="diemck"||$field=="diemhp"||$field=="ghichu")
                                {
                                    $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValue("");
                                }
                                else
                                {
                                    $sheet_dsmh->getCellByColumnAndRow($ncol, $nrow)->setValueExplicit(trim($row->$field),PHPExcel_Cell_DataType::TYPE_STRING);        
                                }
                            
                            $ncol++;
                        }                
                        $nrow++;
                    }
                    // Rename worksheet
                    $objPHPExcel->getActiveSheet()->setTitle('DSLOP_'.$malop);
                    
                    
                    $objPHPExcel->setActiveSheetIndex(0);
                    $filename="Danh sach lop_".$malop;
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
                $this->load->view("admin/vlop_export",$data);   
                  
            }
	    
        
   	}//END EXPORT DATA
    

//================================================BO TRI LICH GIANG DAY====================================================================================================

    public function lichgiangday()
    {
        $khoa_result=$this->mlop->get_khoa();
        $data["khoa_result"]=$khoa_result;
        $data["thu_result"]=$this->mlop->get_thu();
        $data["ca_result"]=$this->mlop->get_ca("*",0);
        $data["title"]="Trang bố trí lịch giảng dạy";
        $data["data_title"]="Thao tác bố trí lịch giảng dạy";   
        $this->load->view("admin/vlich_giang_day",$data);     
    } 
//================================================LUU LICH GIANG DAY====================================================================================================

    public function luu_lich_giang_day()
    {
        $array_change=$this->input->post();        
        
        foreach($array_change as $malop=>$value)
        {
            $malop=str_replace("_",".",$malop);
            $this->mlop->update_lich($malop,$value);
        }
        
        echo "success";
        
        
    }
//================================================DANH SACH LOP==================================================================================================================================================
    public function danh_sach($malop)
    {
            $khoa_result=$this->mlop->get_khoa();
            $tenmh=$this->mlop->get_tenmh($malop);
            //get data to dump into table
            $danhsach_result=$this->mlop->get_lop_danh_sach($malop);           
            
            $data["khoa_result"]=$khoa_result;
            
            $data["danhsach_result"]=$danhsach_result;  
            $data["total_rows"]=count($danhsach_result);          
            $data["data_title"]="Danh sách sinh viên đăng ký lớp <span id='malop'>".$malop."</span>(<span id='tenmh'>".$tenmh."</span>)";
            
            $data["title"]="Trang quản lý lớp";        
            
    		$this->load->view('admin/vlop_danhsach',$data);                  
        
                        
    } 
//================================================THONG KE==================================================================================================================================================   
    public function thongke()
    {
        
        $khoa_result=$this->mlop->get_khoa();
        $danhsach_mh=$this->mlop->get_danhsach_monhoc();           
        $danhsach_gv=$this->mlop->get_danhsach_giaovien("lt");//chua chinh xac
        $data["khoa_result"]=$khoa_result;
        $data["danhsach_mh"]=$danhsach_mh;
        $data["total_mh"]=count($danhsach_mh);
        
        $data["danhsach_gv"]=$danhsach_gv;
        $data["total_gv"]=count($danhsach_gv);
        
        $data["title"]="Trang thống kê tổng quát lớp";
        $data["data_title"]="Thống kê tổng quát lớp";    
        $this->load->view("admin/vlop_statistic",$data); 
        
       
          
    }//end thong ke
   
   
//================================================XU LY LOP DE NGHI==================================================================================================================================================   
    public function denghi()
    {
            $loai="denghi";
        //get khoa make menu
            $khoa_result=$this->mlop->get_khoa();
            //get data to dump into table
            $lop_result=$this->mlop->get_lop("",$loai,0,15);//lay danh sach sinh vien cac khoa, thuoc cac k, 15 record dau tien
           
            //tong so hang de tao phan trang
            $num_rows=$this->mlop->get_num_rows("",$loai);
            
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/lop/ajax_full_data";
            $config["total_rows"]=$num_rows;
            $config["per_page"]=15;
            $this->pagination->initialize($config);
            $data["pagination"]=$this->pagination->create_links();
            
            //data for view
            
            $data["khoa_result"]=$khoa_result;
            
            $data["lop_result"]=$lop_result;
            $data["total_rows"]=$num_rows;//get total rows to export function
            $data["data_title"]="Danh sách môn học đề nghị";
            
            $data["title"]="Trang quản lý lớp đề nghị";        
            
    		$this->load->view('admin/vlop_request',$data);  
        
       
          
    }//end thong ke

}//end CONTROLLER LOP

?>
