<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sinhvien extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("admin/msinhvien");
    }
	public function index($khoa="tatca")
	{  
	   //get khoa make menu
        $khoa_result=$this->msinhvien->get_khoa();
        //get data to dump into table
        $sinhvien_result=$this->msinhvien->get_sinhvien("",$khoa,0,0,15);//lay danh sach sinh vien cac khoa, thuoc cac k, 15 record dau tien
        
        if($khoa!="tatca") $data['data_title']="Danh sách sinh viên khoa ".$this->msinhvien->ten_khoa($khoa);
        else $data['data_title']="Danh sách sinh viên";
        
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
        
        $data["title"]="Trang quản lý sinh viên";        
        
		$this->load->view('admin/vsinhvien',$data);        
   	}
    
    
    
    //ajax load lai datas
    public function ajax_full_data($start=0)
    {
        
        $khoa=$this->input->post("khoa");
        $k=$this->input->post("k");
        $limit=$this->input->post("limit");        
        $masv=$this->input->post("masv");
        
       //get a record of masv OR all follow each $khoa,$k,$start and $limit
        $sinhvien_result=$this->msinhvien->get_sinhvien($masv,$khoa,$k,$start,$limit);        
        $count_rows=count($sinhvien_result);
        
        if($count_rows>0)
        {
            //make pagination
            $this->load->library("pagination");        
            $config["base_url"]="http://dkhp.uit.edu.vn/quanly/sinhvien/ajax_full_data";
            $config["total_rows"]=$this->msinhvien->get_num_rows($masv,$khoa);
            
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
                <th id="mssv"></th>
                <th id="tensv"></th>
                <th id="khoa"></th>
                <th id="lop"></th>
                <th id="k"></th>
                <th id="ngaysinh"></th>
                <th id="noisinh"></th>
                <th id="sdt"></th>
                <th id="email"></th>
            </tr>';            
             foreach($sinhvien_result as $row)
             {
                echo "<tr>";
                echo "<td><input id='".$row->MaSV."' class='checkbox_row' type='checkbox' /></td>";
                echo "<td class='masv' title='Sửa đổi'>".$row->MaSV."</td>";
                echo "<td class='tensv' style='text-align:left' >".$row->TenSV."</td>";
                echo "<td class='khoa'>".$row->Khoa."</td>";
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
        
    sleep(1);   
        
    }//end ajax_full_data
    //tra ve 1 record sinh vien theo masv
    function ajax_data()
   {
        sleep(0.5);
        $masv=$this->input->post("masv");
        
        $data_result=$this->msinhvien->get_sinhvien_data($masv);
        $khoa_result=$this->msinhvien->get_khoa();
        
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
                echo "<tr><td>Khoa</td>
                          <td>
                              <select name='khoa' id='khoa'>";
                              foreach($khoa_result as $khoa_row)
                              {
                                if($khoa_row->MaKhoa==$row->Khoa) 
                                     echo "<option title='".$khoa_row->TenKhoa."' selected='selected' value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                                else echo "<option title='".$khoa_row->TenKhoa."'  value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                          
                $lop_result=$this->msinhvien->get_lop($row->Khoa);
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
      
   function ajax_update()
   {
            sleep(1);
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
                echo "<tr><td>".form_error("khoa","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("lop","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("k","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("ngaysinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr style='height:92px;'><td>".form_error("noisinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("sdt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("email","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                
            } 
            else 
            {
               
               $data["masv"]=$this->input->post("masv");
               $data["tensv"]=$this->input->post("tensv");
               $data["khoa"]=$this->input->post("khoa");
               $data["lop"]=$this->input->post("lop");
               $data["k"]=$this->input->post("k");
               $data["noisinh"]=$this->input->post("noisinh");
               $data["ngaysinh"]=$this->input->post("ngaysinh");
               $data["sdt"]=$this->input->post("sdt");
               $data["email"]=$this->input->post("email");
               $this->db->update("sinhvien",$data,array("MaSV"=>$key));
               
               echo "success";
            }
    
     
   }
   
   function ajax_insert()
   {
            sleep(1);
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
                echo "<tr><td>".form_error("khoa","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("lop","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("k","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("ngaysinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr style='height:92px;'><td>".form_error("noisinh","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("sdt","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
                echo "<tr><td>".form_error("email","<span title='Thông báo lỗi'>","</span>")."</td></tr>";
            } 
            else 
            {
               
               $data["masv"]=$this->input->post("masv");
               $data["tensv"]=$this->input->post("tensv");
               $data["khoa"]=$this->input->post("khoa");
               $data["lop"]=$this->input->post("lop");
               $data["k"]=$this->input->post("k");
               $data["noisinh"]=$this->input->post("noisinh");
               $data["ngaysinh"]=$this->input->post("ngaysinh");
               $data["sdt"]=$this->input->post("sdt");
               $data["email"]=$this->input->post("email");
               $this->db->insert("sinhvien",$data);
               echo "success";
            }
    
     
   }
   function ajax_delete()
   {
        $mssv_array=$this->input->post("mssv_array");
        if(count($mssv_array)>0)
        { 
            foreach($mssv_array as $key=>$value)
            {
                if($key==0) $this->db->where("MaSV",$value);
                else  $this->db->or_where("MaSV",$value);
                    
            }
            //$str_where="MaSV IN".array_values($mssv_array);
            //echo $str_where;
            $this->db->delete("sinhvien");
            echo "Xóa thành công";
        }
   }
   function ajax_lop_from_khoa()
   {
        $khoa=$this->input->post("khoa");   
             
        $lop_result=$this->msinhvien->get_lop($khoa);
        foreach($lop_result as $lop_row)
        {          
           echo "<option  value='".$lop_row->TenLop."'>".$lop_row->TenLop."</option>";
                               
        }
   }
   function check_mssv($new_mssv,$old_mssv)
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
   
   //them sv page
   public function themsv()
    {
        $khoa_result=$this->msinhvien->get_khoa();
        $data["khoa_result"]=$khoa_result;
        
        $data["title"]="Trang thêm sinh viên";  
        $this->load->view("admin/vsinhvien_add",$data);   
    }
    //thong ke page
    
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
            $SL[$row->MaKhoa][0]=$this->msinhvien->get_num_rows("",$row->MaKhoa,0);
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
    
}



?>