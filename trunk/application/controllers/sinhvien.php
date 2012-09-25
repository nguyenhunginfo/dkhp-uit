<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sinhvien extends CI_Controller {

    function __construct()
    {
        parent::__construct();
       $this->load->helper(array("url","form","cookie"));
        $this->load->model("admin/msinhvien");
    }
	public function index($khoa="tatca")
	{  
        $khoa_result=$this->msinhvien->get_khoa();
        $sinhvien_result=$this->msinhvien->get_sinhvien($khoa,0,0,15);
        
        if($khoa!="tatca") $data['data_title']="Danh sách sinh viên khoa ".$this->msinhvien->ten_khoa($khoa);
        else $data['data_title']="Danh sách sinh viên";
        
        $num_rows=$this->msinhvien->get_num_rows($khoa);//tong so hang de tao phan trang
        
        $data["khoa_result"]=$khoa_result;
        $data["khoa"]=$khoa;
        $data["sinhvien_result"]=$sinhvien_result;
        $data["num_rows"]=$num_rows;
        $data["title"]="Trang quản lý sinh viên";        
        
		$this->load->view('admin/sinhvien/vsinhvien',$data);        
   	}
    public function suadoi($str_mssv)
    {
        
            
            //controller load library form_validation
            $this->load->library("form_validation");
            
            //set rules manually
            $this->form_validation->set_rules("masv","MSSV","required");
            //$this->form_validation->set_rules("password","Password","required");
           // $this->form_validation->set_rules("passconf","Password confirm","required");
            //$this->form_validation->set_rules("email","Email-address","required");
    
            
                        
            //Ok check where the form is submitted by run() function
            if($this->form_validation->run()==false)
            {
                $array_mssv=explode("|",$str_mssv);
                $data["title"]="Trang thông tin chi tiết sinh viên"; 
                $data["data_result"]=$this->msinhvien->get_sinhvien_datas($array_mssv);        
                $this->load->view("admin/sinhvien/vsinhvien_edit",$data);
            }
            else//submitted success without any error
            {     
                $array_mssv=explode("|",$str_mssv);
                $data["title"]="Trang thông tin chi tiết sinh viên"; 
                $data["data_result"]=$this->msinhvien->get_sinhvien_datas($array_mssv);        
                $this->load->view("admin/sinhvien/vsinhvien_edit",$data);
            } 
        
        
        
        
    }
    //ajax load lai data
    public function ajax_full_data()
    {
        
        $khoa=$this->input->post("khoa");
        $k=$this->input->post("k");
        $limit=$this->input->post("limit");
        $start=$this->input->post("start");
        $sinhvien_result=$this->msinhvien->get_sinhvien($khoa,$k,$start,$limit);        
        $count_rows=count($sinhvien_result);
        
        if($count_rows>0)
        {
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
                <th id="cmnd"></th>
            </tr>
            ';
            
            
             foreach($sinhvien_result as $row)
             {
                echo "<tr>";
                echo "<td><input id='".$row->MaSV."' class='checkbox_row' type='checkbox' /></td>";
                echo "<td class='masv' title='Xem chi tiết'>".$row->MaSV."</td>";
                echo "<td class='tensv' style='text-align:left' >".$row->TenSV."</td>";
                echo "<td class='khoa'>".$row->Khoa."</td>";
                echo "<td class='lop'>".$row->Lop."</td>";
                echo "<td class='k'>".$row->K."</td>";
                echo "<td class='ngaysinh'>".$row->NgaySinh."</td>";
                echo "<td class='noisinh'>".$row->NoiSinh."</td>";
                echo "<td class='cmnd'>".$row->CMND."</td>";
                echo "</tr>";
             }
                             
            echo '</table>';
            echo '</div>';
            
            
            
            $num_rows=$this->msinhvien->get_num_rows($khoa,$k);
			$page=ceil($num_rows/$limit);//tổng số trang
			$current=($start/$limit)+1;
            
			if($page>1)
            {
                
			echo "<div id='pagination'>";
                
				echo "<ul>";
                    if($current!=1)echo "<li style='visibility:visible' id='prev'>Prev</li>";
                    else echo "<li style='visibility:hidden' id='prev'>Prev</li>";
					for($i=1;$i<=$page;$i++)
					{
						$id=($i-1)*$limit;//chỉ số start
						if($i==$current) echo "<li class='active' id='$id'>$i</li>";
						else echo "<li id='$id'>$i</li>";
						
					}				
					 if($current!=$page) echo "<li style='visibility:visible' id='next'>Next</li>"	;
                     else echo "<li style='visibility:hidden' id='next'>Next</li>"	;			
				echo "</ul>";
			echo "</div>";	
            }	
            
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
        
        if(count($data_result)>0)
        {
            foreach($data_result as $row)
            {
                echo "<table id='text'";
                echo "<tr><td >MSSV</td>      <td   id='masv'>". $row->MaSV."</td></tr>";
                echo "<tr><td >Họ Tên</td>    <td   id='tensv'>". $row->TenSV."</td></tr>";
                echo "<tr><td >Khoa</td>      <td   id='khoa'>". $row->Khoa."</td></tr>";
                echo "<tr><td >Lớp</td>       <td   id='lop'>". $row->Lop."</td></tr>";
                echo "<tr><td >Khóa</td>      <td   id='k'>". $row->K."</td></tr>";
                echo "<tr><td >Ngày sinh</td> <td   id='ngaysinh'>". $row->NgaySinh."</td></tr>";
                echo "<tr><td >Nơi sinh</td>  <td   id='noisinh'>". $row->NoiSinh."</td></tr>";
                echo "<tr><td >CMND</td>      <td   id='cmnd'>". $row->CMND."</td></tr>";
                echo "</table>";
                
                
                echo "<table id='edit'";
                echo "<tr><td>MSSV</td><td><input title='". $row->MaSV."'    id='masv' type='text' value='". $row->MaSV."'/> </td></tr>";
                echo "<tr><td>Họ Tên</td><td><input id='tensv' type='text' value='". $row->TenSV."'/> </td></tr>";
                echo "<tr><td>Khoa</td>
                          <td>
                              <select id='khoa'>";
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
                              <select id='lop'>";
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
                              <select id='k'>";
                              foreach($K_result as $K_row)
                              {
                                if($K_row->MaK==$row->K) echo "<option selected='selected' title='".$K_row->TenK."' value='".$K_row->MaK."'>".$K_row->MaK."</option>";
                                else echo "<option title='".$K_row->TenK."'  value='".$K_row->MaK."'>".$K_row->MaK."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                          
                echo "<tr><td>Ngày Sinh</td><td><input id='ngaysinh' type='text' value='". $row->NgaySinh."'/> </td></tr>";
                echo "<tr><td>Nơi Sinh</td><td><textarea id='noisinh' cols='25' rows='4'>".$row->NoiSinh."</textarea></td></tr>";
                echo "<tr><td>CMND</td><td><input type='text' id='cmnd' value='". $row->CMND."'/> </td></tr>";
                echo "</table>";
            }
            
        }
        else echo "Lỗi dữ liệu";
   }
    
    
    
    
    //tra ve nhieu records
   function ajax_datas()
   {
        sleep(1);
        $array_mssv=$this->input->post("array_mssv");
        $data_result=$this->msinhvien->get_sinhvien_data($array_mssv);
        
        if(count($data_result)>0)
        {
            foreach($data_result as $row)
            {
                echo "<table class='text' id='".$row->MaSV."'>";
                echo "<tr><td>MSSV</td><td>". $row->MaSV."</td></tr>";
                echo "<tr><td>Họ Tên</td><td>". $row->TenSV."</td></tr>";
                echo "</table>";
            }
            
        }
        else echo "Lỗi dữ liệu";
   }
   
   
   
   
   function ajax_update_data()
   {
        $key=$this->input->post("key");
        $data["masv"]=$this->input->post("masv");
        $data["tensv"]=$this->input->post("tensv");
        $data["khoa"]=$this->input->post("khoa");
        $data["lop"]=$this->input->post("lop");
        $data["k"]=$this->input->post("k");
        $data["noisinh"]=$this->input->post("noisinh");
        $data["ngaysinh"]=$this->input->post("ngaysinh");
        $data["cmnd"]=$this->input->post("cmnd");
        
        $this->db->update("sinhvien",$data,array("MaSV"=>$key));
        echo $this->db->affected_rows();
        
   }
}



?>