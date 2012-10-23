<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monhoc extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("admin/mmonhoc");
    }
	public function index($loai="tatca")
	{  
	   //get khoa make menu
        $khoa_result=$this->mmonhoc->get_khoa();
        //get data to dump into table
        $monhoc_result=$this->mmonhoc->get_monhoc("",$loai,0,15);//lay danh sach monhoc cac loai 15 record dau tien
        
        $data['data_title']="Danh sách môn học";
        
        
        //tong so hang de tao phan trang
        $num_rows=$this->mmonhoc->get_num_rows();
        
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
        $data["title"]="Trang quản lý môn học";        
        
		$this->load->view('admin/vmonhoc',$data);        
   	}
    public function themmh()
    {
         $khoa_result=$this->mmonhoc->get_khoa();
        $data["khoa_result"]=$khoa_result;
        
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
            
          
            echo "<div id='pagination'>";
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
            
            
           // $this->form_validation->set_rules("noisinh","Nơi sinh","required");
           // $this->form_validation->set_rules("cmnd","CMND","required|exact_length[9]");
            
            
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
               
               $data["mamh"]=$this->input->post("mamh");
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
   
}



?>