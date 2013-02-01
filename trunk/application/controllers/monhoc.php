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
//==========================INDEX============================================================================================================
	public function index($loai="tatca")
	{  
	        //get khoa make menu
            $khoa_result=$this->mmonhoc->get_khoa();
            //get data to dump into table
            $monhoc_result=$this->mmonhoc->get_monhoc("",$loai,0,15);//lay danh sach monhoc cac loai 15 record dau tien
            
            
            if($loai=="DC") $data["data_title"]="Danh sách môn học đại cương";
            else if($loai=="CN") $data["data_title"]="Danh sách môn học chuyên nghành";
            else $data["data_title"]="Danh sách môn học";
            
            
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
            $data["loai_monhoc_result"]=$this->mmonhoc->get_loai_monhoc();  
            $data["monhoc_result"]=$monhoc_result;
            
            $data["loai_monhoc"]=$loai;
            $data["total_rows"]=$num_rows;
            $data["title"]="Trang quản lý môn học";        
            
    		$this->load->view('admin/vmonhoc',$data); 
       
	          
   	}
    
//========================MON HOC NHOM============================================================================================================    
    public function monhocnhom($manhom="")
    {
            
        //get khoa make menu
            $khoa_result=$this->mmonhoc->get_khoa();
            //get data to dump into table
            $danhsach_monhoc_result=$this->mmonhoc->get_danhsach_monhoc_nhom($manhom);//lay danh sach monhoc cac loai 15 record dau tien
            
            
            $data["data_title"]="Danh sách nhóm môn học";
            
            
            //tong so hang de tao phan trang
            $num_rows=$this->mmonhoc->get_num_monhoc_nhom();
            
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/monhoc/ajax_full_data";
            $config["total_rows"]=$num_rows;
            
            $config["per_page"]=15;
            $this->pagination->initialize($config);
            $data["pagination"]=$this->pagination->create_links();
            //data for view
            $data["khoa_result"]=$khoa_result;    
            $data["loai_monhoc_result"]=$this->mmonhoc->get_loai_monhoc();      
            $data["danhsach_monhoc_result"]=$danhsach_monhoc_result;
            
            
            $data["total_rows"]=$num_rows;
            $data["title"]="Trang quản lý môn học"; 
            //echo "<pre>";    
               
            //print_r($monhoc_result);
            //echo "</pre>";
    		$this->load->view('admin/vmonhoc_nhom',$data); 
    }
    
//========================DIEU CHINH NHOM=======================================================================================================
function dieuchinhnhom($manhom)
    {
         //get khoa make menu
            $khoa_result=$this->mmonhoc->get_khoa();            
            //get data to dump into table
            $danhsach_result=$this->mmonhoc->get_monhoc_nhom($manhom);//lay danh sach monhoc cua nhom
            $monhoc_result=$this->mmonhoc->get_monhoc_empty($manhom);//lay danh sach mon hoc con lai
            $loai_monhoc_result=$this->mmonhoc->get_loai_monhoc();
            
            $data['data_title']="Thao tác điều chỉnh môn học nhóm";
            
            //data for view
            $data["manhom"]=$manhom;
            $data["tennhom"]=$this->mmonhoc->get_ten_monhoc_nhom($manhom);
            $data["somon"]=count($danhsach_result);                     
            
            $data["khoa_result"]=$khoa_result;            
            
            $data["loai_monhoc_result"]=$loai_monhoc_result;
            $data["monhoc_result"]=$monhoc_result;
            $data["danhsach_result"]=$danhsach_result;
            
            $data["title"]="Trang điều chỉnh môn học nhóm";        
            //echo "<pre>";
          //  print_r($ctdt_result);
        //    echo "</pre>";
    		$this->load->view('admin/vmonhoc_nhom_edit',$data); 
    }
        
//========================MON HOC TUONG DUONG_THAY THE============================================================================================================    
    public function monhoctuongduong()
    {
            $loai="TD";
        //get khoa make menu
            $khoa_result=$this->mmonhoc->get_khoa();
            //get data to dump into table
            $monhoc_result=$this->mmonhoc->get_monhoc("",$loai,0,15);//lay danh sach monhoc cac loai 15 record dau tien
            $loai_monhoc_result=$this->mmonhoc->get_loai_monhoc();
            
            $data["data_title"]="Danh sách môn học tương đương(thay thế)";
            
            
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
            $data["loai_monhoc_result"]=$loai_monhoc_result;
            $data["loai"]=$loai;
            $data["total_rows"]=$num_rows;
            $data["title"]="Trang quản lý môn học"; 
            echo "<pre>";       
            //print_r($monhoc_result);
            echo "</pre>";
    		$this->load->view('admin/vmonhoc_tuongduong',$data); 
    }
//========================THAO TAC THEM MON HOC============================================================================================================        
    public function themmh($loai="")
    {
        $khoa_result=$this->mmonhoc->get_khoa();
        $loai_monhoc_result=$this->mmonhoc->get_loai_monhoc();
        $nhom_monhoc_result=$this->mmonhoc->get_ma_monhoc_nhom();
        $data["khoa_result"]=$khoa_result;
        $data["loai_monhoc_result"]=$loai_monhoc_result;
        $data["nhom_monhoc_result"]=$nhom_monhoc_result;
        $data["loai"]=$loai;        
        
        
        $data["data_title"]="Thao tác thêm môn học";
        
        
        $data["title"]="Trang thêm môn học";  
        $this->load->view("admin/vmonhoc_add",$data);  
    }
//========================THAO TAC THEM NHOM MON HOC============================================================================================================    
    public function them_nhom_monhoc()
    {
        $khoa_result=$this->mmonhoc->get_khoa();
        $loai_monhoc_result=$this->mmonhoc->get_loai_monhoc();
        
        $data["khoa_result"]=$khoa_result;
        $data["loai_monhoc_result"]=$loai_monhoc_result;
        
        $data["data_title"]="Thao tác thêm nhóm môn học";
        
        
        $data["title"]="Trang thêm nhóm môn học";  
        $this->load->view("admin/vmonhoc_nhom_add",$data);  
    }
//========================THAO TAC AJAX TABLE MON HOC(PHAN TRANG)============================================================================================================    
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
           // echo $config["total_rows"];
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
                <th id="kieumh"></th>                
            </tr>';            
              foreach($monhoc_result as $row)
                         {
                            $ID=$row->ID;
                            
                            $mamh=$row->MaMH;
                            $tenmh=$row->TenMH;
                            
                            $maloai=$row->MaLoai; 
                            $tenloai=$row->TenLoai;
                                     
                            $kieumh=$row->KieuMH;
                                   
                               
                            echo "<tr>";
                            echo "<td class='checkbox'><input id='$ID' class='checkbox_row' type='checkbox' /></td>";
                            echo "<td class='mamh' id='$ID' title='Xem chi tiết'>$mamh</td>";
                            echo "<td class='tenmh' style='text-align:left' >$tenmh</td>";
                            echo "<td class='sotc'>".$row->SoTC."</td>";
                            echo "<td class='tclt'>".$row->TCLT."</td>";
                            echo "<td class='tcth'>".$row->TCTH."</td>";  
                                            
                            echo "<td class='loai' id='$maloai'>$tenloai</td>";
                            
                            if($kieumh=="DON")
                            {
                              $ten_kieumh="Đơn";
                              echo "<td class='kieumh' id='$kieumh'>$ten_kieumh</td>";  
                            } 
                            else
                            {
                              $ten_kieumh="Nhóm";
                              echo "<td class='kieumh' id='$kieumh'><a href='/quanly/mon-hoc-nhom/$mamh'>$ten_kieumh</a></td>";  
                            }  
                                                       
                            echo "</tr>";
                         }
                         
                             
            echo '</table><!--end #table_data -->';
            echo '</div><!--end #scroll -->';
            
        }
        else echo "Dữ liệu trống.";
        
    }
 //=============HIEN THI THONG TIN LEN POPUP=======================================================================================================
    function ajax_data()
   {    
        $ID=$this->input->post("id");
        $loai_monhoc_result=$this->mmonhoc->get_loai_monhoc();
        $nhom_monhoc_result=$this->mmonhoc->get_ma_monhoc_nhom();
        $data_result=$this->mmonhoc->get_monhoc_data($ID);
        
        if(count($data_result)>0)
        {
            foreach($data_result as $row)
            {   
                $kieumh=$row->KieuMH;
                $mamh=$row->MaMH;
                $tenmh=$row->TenMH;
                
                echo "<table class='info' id='$ID,$mamh,$tenmh'>"; 
                //==========KIEU MON HOC=============================
                echo "<tr><td>Kiểu môn học</td>
                        <td><select id='kieumh'>";
                if($kieumh=="DON")
                {
                    echo "<option value='DON' selected='selected'>Môn học đơn</option>";
                    echo "<option value='NHOM'>Môn học nhóm</option>";  
                }      
                else
                {
                    echo "<option value='DON'>Môn học đơn</option>";
                    echo "<option value='NHOM' selected='selected'>Môn học nhóm</option>";
                }
                echo "</select></td></tr>";              
                 
                //==========MA MON HOC=============================
                echo "<tr><td>Mã Môn Học</td>";
                echo "<td id='mamh_change'>";
                if($kieumh!="NHOM")// monhoc don
                {                    
                    echo "<input  name='mamh'  id='mamh'  type='text' title='Mã môn học gồm 5 kí tự' value='". $row->MaMH."'/></td>";                              
                }
                else// mon hoc nhom
                {                    
                    echo "<select id='mamh' name='mamh'>";
                    foreach($nhom_monhoc_result as $nhom_row)
                    {                                    
                        $manhom=$nhom_row->MaNhom;
                        if($mamh==$manhom)echo "<option value='$manhom' selected='selected'>$manhom</option>";                         
                        else echo "<option value='$manhom'>$manhom</option>";
                    }
                    echo "</select>";
                }
                echo "</td>";
                echo "</tr>";//end row MaMH
                          
                //===========================================          
                echo "<tr><td>Tên Môn Học</td>      <td><input  name='tenmh' id='tenmh' type='text' value='". $row->TenMH."'/> </td></tr>";
                echo "<tr><td>Số Tín Chỉ</td>       <td><input  name='sotc' id='sotc' type='text' value='". $row->SoTC."'/> </td></tr>";
                echo "<tr><td>Tín Chỉ Lý Thuyết</td><td><input  name='tclt' id='tclt' type='text' value='". $row->TCLT."'/> </td></tr>";
                echo "<tr><td>Tín Chỉ Thực Hành</td><td><input  name='tcth' id='tcth' type='text' value='". $row->TCTH."' disabled='disabled'/> </td></tr>";
                //==========LOAI MON HOC=============================
                echo "<tr><td>Loại Môn</td>
                        <td><select id='loai'>";
                    foreach($loai_monhoc_result as $loai_monhoc_row)
                    {
                        $maloai=$loai_monhoc_row->MaLoai;
                        $tenloai=$loai_monhoc_row->TenLoai;
                        $num=$this->mmonhoc->get_num_rows("",$maloai);
                        
                        if($maloai==$row->Loai)echo "<option value='$maloai' selected='selected'>$tenloai</option>";
                        else echo "<option value='$maloai' >$tenloai</option>";
                    }
                echo "</select></td></tr>";
                                       
                echo "</table>";
                
               // echo "<div class='error'></div>";
                echo "<table class='error'>";
                
                echo "</table>";
                
            }
        }
        else echo "Lỗi dữ liệu";
   }
//========================THAO TAC AJAX UPDATE THONG TIN MON HOC============================================================================================================   
   function ajax_update()
   {
            
            $kieumh=$this->input->post("kieumh");
            if($kieumh!="NHOM")//mon hoc binh thuong mamh lam khoa chinh
            {
                $this->load->library("form_validation");            
                $key=$this->input->post("key");
                $arr=explode(",",$key);
                $id=$arr[0];
                $old_mamh=$arr[1];
                $old_tenmh=$arr[2];
                
                $this->form_validation->set_rules('mamh', 'Mã môn học', "required|exact_length[5]|callback_check_mamh[$old_mamh]");//kiem tra khoa chinh
                $this->form_validation->set_rules('tenmh', 'Tên môn học', 'required');
                $this->form_validation->set_rules('sotc', 'Số tín chỉ', 'numeric');
                $this->form_validation->set_rules('tclt', 'tín chỉ lý thuyết', 'numeric');
                $this->form_validation->set_rules('tcth', 'tín chỉ thực hành', 'numeric');
                
                if($this->form_validation->run() ==false)
                {
                    //echo validation_errors();
                    echo "<tr><td></td></tr>";
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
                   $data["kieumh"]=$this->input->post("kieumh");
                   
                   $this->db->update("monhoc",$data,array("ID"=>$id));
                   
                   echo "success";
                }
            }
            else//update mon hoc nhom xu ly hoi khac
            {
                $this->load->library("form_validation");            
                $key=$this->input->post("key");
                
                $arr=explode(",",$key);
                $id=$arr[0];
                $old_mamh=$arr[1];
                $old_tenmh=$arr[2];
                
                 
                $new_mamh=$this->input->post("mamh");
                $key=$key.",".$new_mamh;//$old_mamh|$old_tenmh|$new_mamh 
                 
                //echo $key;     
                
                $this->form_validation->set_rules('mamh', 'Mã môn học', "required");//kiem tra khoa chinh
                $this->form_validation->set_rules('tenmh', 'Tên môn học', "required|callback_check_mamh_tenmh[$key]");
                $this->form_validation->set_rules('sotc', 'Số tín chỉ', 'numeric');
                $this->form_validation->set_rules('tclt', 'tín chỉ lý thuyết', 'numeric');
                $this->form_validation->set_rules('tcth', 'tín chỉ thực hành', 'numeric');
                
                if($this->form_validation->run() ==false)
                {
                    //echo validation_errors();
                    echo "<tr><td></td></tr>";
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
                   $data["kieumh"]=$this->input->post("kieumh");
                   
                   $this->db->update("monhoc",$data,array("ID"=>$id));
                   
                   echo "success";
                   
                }
                
            }
            
    
     
   }//end ajax_update
   
   public function ajax_update_nhom_monhoc()
   {   
            $id_array=$this->input->post("id_array"); //id chua mon hoc
            $manhom=$this->input->post("manhom"); 
            
            
            $this->db->trans_start();
            $this->mmonhoc->delete_monhoc_nhom($manhom,$id_array);
            $this->mmonhoc->insert_monhoc_nhom($manhom,$id_array);
            $this->db->trans_complete();
            echo "success";
           
     
   }//end ajax_update
//========================THAO TAC AJAX THEM MON HOC============================================================================================================   
   function ajax_insert()
   {
            $kieumh=$this->input->post("kieumh");
            //mon hoc DON binh thuong            
            if($kieumh!="NHOM")
            {
                $this->load->library("form_validation");            
                $key=$this->input->post("key"); 
                $arr=explode(",",$key);
                $old_mamh=$arr[0];
                
                 
                     
                $this->form_validation->set_rules('mamh', 'Mã môn học', "required|exact_length[5]|callback_check_mamh[$old_mamh]");//kiem tra khoa chinh
                $this->form_validation->set_rules('tenmh', 'Tên môn học', 'required');
                $this->form_validation->set_rules('sotc', 'Số tín chỉ', 'required|numeric');
                $this->form_validation->set_rules('tclt', 'Số tín chỉ lý thuyết', 'required|numeric');
                $this->form_validation->set_rules('tcth', 'Số tín chỉ thực hành', 'required|numeric');
                
                
                if($this->form_validation->run() ==false)
                {
                    //echo validation_errors();
                    echo "<tr><td></td></tr>";
                    echo "<tr><td>".form_error("mamh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                    echo "<tr><td>".form_error("tenmh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                    echo "<tr><td>".form_error("sotc","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                    echo "<tr><td>".form_error("tclt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                    echo "<tr><td>".form_error("tcth","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                } 
                else 
                {
                   $data["id"]="";
                   $data["mamh"]=strtoupper($this->input->post("mamh"));
                   $data["tenmh"]=$this->input->post("tenmh");
                   $data["sotc"]=$this->input->post("sotc");
                   $data["tclt"]=$this->input->post("tclt");
                   $data["tcth"]=$this->input->post("tcth");
                   $data["loai"]=$this->input->post("loai");
                   $data["kieumh"]=$this->input->post("kieumh");
                   $this->db->insert("monhoc",$data);
                   echo "success";
                }
            }
             
            else//day la mon hoc nhom, can xet ky hon mamh, tenmh ko duoc trung
            {
                $this->load->library("form_validation");            
                //$key=$this->input->post("key");//key is empty string
                                
                
                $new_mamh=$this->input->post("mamh"); 
                $key=" , , ,".$new_mamh; //old_mamh,old_tenmh,new_mamh
                     
                $this->form_validation->set_rules('mamh', 'Mã môn học', "required");//kiem tra khoa chinh
                $this->form_validation->set_rules('tenmh', 'Tên môn học', "required|callback_check_mamh_tenmh[$key]");
                $this->form_validation->set_rules('sotc', 'Số tín chỉ', 'required|numeric');
                $this->form_validation->set_rules('tclt', 'Số tín chỉ lý thuyết', 'required|numeric');
                $this->form_validation->set_rules('tcth', 'Số tín chỉ thực hành', 'required|numeric');
                
                
                if($this->form_validation->run() ==false)
                {
                    //echo validation_errors();
                    echo "<tr><td></td></tr>";
                    echo "<tr><td>".form_error("mamh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                    echo "<tr><td>".form_error("tenmh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                    echo "<tr><td>".form_error("sotc","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                    echo "<tr><td>".form_error("tclt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                    echo "<tr><td>".form_error("tcth","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                } 
                else 
                {
                   $data["id"]="";
                   $data["mamh"]=strtoupper($this->input->post("mamh"));
                   $data["tenmh"]=$this->input->post("tenmh");
                   $data["sotc"]=$this->input->post("sotc");
                   $data["tclt"]=$this->input->post("tclt");
                   $data["tcth"]=$this->input->post("tcth");
                   $data["loai"]=$this->input->post("loai");
                   $data["kieumh"]=$this->input->post("kieumh");
                   $this->db->insert("monhoc",$data);
                   echo "success";
                }
                            
              
            }//end else
    
     
   }//end ajax inser monhoc
//========================THAO TAC AJAX THEM MON HOC NHOM=========================================================================================
function ajax_insert_monhoc_nhom()
   {
           
                $this->load->library("form_validation");            
                $key="";
                $this->form_validation->set_rules('mamh', 'Mã nhóm môn học', "required|exact_length[5]|callback_check_mamh_nhom[$key]");//kiem tra khoa chinh
                $this->form_validation->set_rules('tenmh', 'Tên nhóm môn học', 'required');
                
                
                
                if($this->form_validation->run() ==false)
                {             //echo validation_errors();
                    
                    echo "<tr><td>".form_error("mamh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                    echo "<tr><td>".form_error("tenmh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                } 
                else 
                {
                   
                   $data["manhom"]=strtoupper($this->input->post("mamh"));
                   $data["tennhom"]=$this->input->post("tenmh");                   
                   $this->db->insert("monhoc_nhom_info",$data);
                   echo "success";
                }
                 
   }//end ajax inser monhoc
//========================THAO TAC AJAX DELETE MON HOC============================================================================================================   
   function ajax_delete()
   {
        $id_array=$this->input->post("id_array");
        if($id_array!=NULL)
        { 
           
            $this->db->where_in("ID",$id_array);
            //$str_where="MaSV IN".array_values($mssv_array);
            //echo $str_where;
            $this->db->delete("monhoc");
            
        }
   }
   
//========================THAO TAC AJAX DELETE MON HOC NHOM============================================================================================================   
   function ajax_delete_monhoc_nhom()
   {
        $manhom_array=$this->input->post("manhom_array");
        if($manhom_array!=NULL)
        { 
           
            $this->db->where_in("MaNhom",$manhom_array);
            //$str_where="MaSV IN".array_values($mssv_array);
            //echo $str_where;
            $this->db->delete("monhoc_nhom_info");
            
        }
   }
//========================THAO TAC AJAX THONG TIN MAMH PHUC VU CHO POPUP============================================================================================================
   function ajax_mamh()
   {
        $kieumh=$this->input->post("kieumh");
        $mamh=$this->input->post("mamh");
        $nhom_monhoc_result=$this->mmonhoc->get_ma_monhoc_nhom();
        
        if($kieumh!="NHOM")// khong phai mon hoc dai dien
        {                    
            echo "<input  name='mamh'  id='mamh'  type='text' title='Mã môn học gồm 5 kí tự' value=''/></td>";                              
        }
        else// mon hoc dai dien
        {                    
            echo "<select id='mamh' name='mamh'>";
            foreach($nhom_monhoc_result as $nhom_row)
            {                                    
                $manhom=$nhom_row->MaNhom;
                if($mamh==$manhom)echo "<option value='$manhom' selected='selected'>$manhom</option>";                         
                else echo "<option value='$manhom'>$manhom</option>";
            }
            echo "</select>";
        }
   }
//========================CALLBACK CUA HAM KIEM TRA MAMH============================================================================================================   
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
   
   function check_mamh_nhom($new_mamh,$old_mamh)
   {
        if($new_mamh!=$old_mamh)
        {
            
            if($this->mmonhoc->mamh_nhom_exist($new_mamh)) 
            {
                $this->form_validation->set_message("check_mamh_nhom","<span title='Thông báo lỗi'><b style='color:red'>".$new_mamh."</b> đã tồn tại.</span>");
                return false;   
            }
            else return true;
        }
        else return true;
   }
//========================CALL BACK KIEM TRA MAMH VA TENMH CUA MON HOC DAI DIEN============================================================================================================   
   function check_mamh_tenmh($new_tenmh,$key)
   {
        $arr=explode(",",$key);
        $old_mamh=$arr[1];
        $old_tenmh=$arr[2];
        $new_mamh=$arr[3];
       
        
        if($new_mamh!=$old_mamh||$new_tenmh!=$old_tenmh)
        {            
            if($this->mmonhoc->mamh_tenmh_exist($new_mamh,$new_tenmh)) 
            {
                $this->form_validation->set_message("check_mamh_tenmh","<span title='Thông báo lỗi'><b style='color:red'>Môn học đã tồn tại</b>.</span>");
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
                    $fields=array("MaMH","TenMH","SoTC","TCLT","TCTH","TenLoai","KieuMH");
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
                        $sheet_dsmh->setCellValueByColumnAndRow(5,$nrow,$row->TenLoai);
                        $sheet_dsmh->setCellValueByColumnAndRow(6,$nrow,$row->KieuMH);
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
                    $fields=array("MaMH","TenMH","SoTC","TCLT","TCTH","TenLoai","KieuMH");
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
                    
                    $sheet_dsmh->getCell("F1")->setValue("Loại Môn Học");
                    $sheet_dsmh->getColumnDimension('F')->setWidth(20);
                    
                    $sheet_dsmh->getCell("G1")->setValue("Kiểu Môn Học");
                    $sheet_dsmh->getColumnDimension('G')->setWidth(20);
                    
                    $sheet_dsmh->getStyle("A1:G1")->getFont()->setSize(12)->setBold(true);
            //======DATA============================================================================================================            
                    foreach($monhoc_result as $row)
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
                    $fields=array("MaMH","TenMH","SoTC","TCLT","TCTH","TenLoai","KieuMH");
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
                    
                    $sheet_dsmh->getCell("F1")->setValue("Loại Môn Học");
                    $sheet_dsmh->getColumnDimension('F')->setWidth(20);
                    
                    $sheet_dsmh->getCell("G1")->setValue("Kiểu Môn Học");
                    $sheet_dsmh->getColumnDimension('G')->setWidth(20);
                    
                    $sheet_dsmh->getStyle("A1:G1")->getFont()->setSize(12)->setBold(true);
            //======DATA============================================================================================================            
                    foreach($monhoc_result as $row)
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
   
//========================THAO TAC NHAP DU LIEU============================================================================================================   
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
                    $data["loai_monhoc_result"]=$this->mmonhoc->get_loai_monhoc();
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
                    $data["loai_monhoc_result"]=$this->mmonhoc->get_loai_monhoc();
                    $data['right_title']="Thao tác nhập dữ liệu";
                     
                     $data["title"]="Trang nhập dữ liệu";  
                    $this->load->view("admin/vmonhoc_import_success",$data); 
                }
                
            }
            catch(exception $ex)
            {
                $khoa_result=$this->mmonhoc->get_khoa();
                $data["khoa_result"]=$khoa_result;
                
                $data["loai_monhoc_result"]=$this->mmonhoc->get_loai_monhoc();  
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
            $data["loai_monhoc_result"]=$this->mmonhoc->get_loai_monhoc();  
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
    //dem so loi sinh ra
    public function check_error_data($data,$import_type="insert")
    {
        $num_errors=0;
        $array_unique=array();
        foreach($data as $row)
        {
            if($row["KieuMH"]!="NHOM")
            {
                if($this->valid_mamh($row["MaMH"],$array_unique,$import_type)==false) $num_errors++;
                $array_unique[]=$row["MaMH"];    
            }
            
            
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
                        $KieuMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();    
                        
                        switch($Loai)
                        {
                            case "Đại Cương": $Loai="DC";break;
                            case "Chuyên Nghành": $Loai="CN";break;
                            case "Cơ Sở Nghành": $Loai="CSN";break;
                            case "Tự Chọn":$Loai="TC";break;
                        }
                        
                        if($KieuMH=="Đơn") $KieuMH="DON";
                        else $KieuMH="NHOM";                
                        if($MaMH!="")
                        {
                            $tempt=array("ID"=>NULL,
                                    "MaMH"=>$MaMH,
                                    "TenMH"=>$TenMH,
                                    "SoTC"=>$SoTC,
                                    "TCLT"=>$TCLT,
                                    "TCTH"=>$TCTH,
                                    "Loai"=>$Loai,
                                    "KieuMH"=>$KieuMH);
                                     
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
                        $KieuMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();    
                        switch($Loai)
                        {
                            case "Đại Cương": $Loai="DC";break;
                            case "Chuyên Nghành": $Loai="CN";break;
                            case "Cơ Sở Nghành": $Loai="CSN";break;
                            case "Tự Chọn":$Loai="TC";break;
                        } 
                        
                        if($KieuMH=="Đơn") $KieuMH="DON";
                        else $KieuMH="NHOM";                
                        if($MaMH!="")
                        {
                            $tempt=array("ID"=>NULL,
                                    "MaMH"=>$MaMH,
                                    "TenMH"=>$TenMH,
                                    "SoTC"=>$SoTC,
                                    "TCLT"=>$TCLT,
                                    "TCTH"=>$TCTH,
                                    "Loai"=>$Loai,
                                    "KieuMH"=>$KieuMH);
                                     
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
                        $KieuMH=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6,$row_index)->getValue();    
                        if($Loai=="Đại Cương") $Loai="DC";
                        else $Loai="CN"; 
                        
                        if($KieuMH=="Đơn") $KieuMH="DON";
                        else $KieuMH="NHOM";                
                        if($MaMH!="")
                        {
                            $tempt=array("ID"=>NULL,
                                    "MaMH"=>$MaMH,
                                    "TenMH"=>$TenMH,
                                    "SoTC"=>$SoTC,
                                    "TCLT"=>$TCLT,
                                    "TCTH"=>$TCTH,
                                    "Loai"=>$Loai,
                                    "KieuMH"=>$KieuMH);
                                     
                            $monhoc_array[]=$tempt;
                        }
                    }
                }
            return $monhoc_array;
    
   }//end read file
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