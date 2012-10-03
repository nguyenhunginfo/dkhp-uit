<?php
class Pagination extends CI_Controller
{
    function index()
    {
       echo "This is index";
    }
    function test($start=0)
    {
        $this->load->helper("url");
        $this->load->model("mpagination");//get database
        $this->load->library("pagination");
        
        $config["base_url"]="http://dkhp.uit.edu.vn/pagination/ajax_test";
        $config["per_page"]=15;
        $config["total_rows"]=$this->mpagination->_total();
                     
		$result=$this->mpagination->get_mh(10,$start);
        $data["result"]=$result;
        
        $this->pagination->initialize($config);
        $this->load->view("vpagination",$data);
        
     
            
    }
    function ajax_test($start=0)
    {
        
        $this->load->model("mpagination");//get database
        $this->load->library("pagination");
        
        $config["base_url"]="http://dkhp.uit.edu.vn/pagination/ajax_test";
        $config["per_page"]=15;
        $config["total_rows"]=$this->mpagination->_total();
                     
		$result=$this->mpagination->get_mh(10,$start);
        $data["result"]=$result;
        
        echo "<table>
        
        <tr>
            <th style='width:100px'>Mã Môn Học</th>
            <th style='width:250px'>Tên Môn Học</th>
            
        </tr>";
    
		
        foreach($result as $row)
        {
            echo"<tr>";
            echo "<td>".$row->MaMH."</td>";
            echo "<td>".$row->TenMH."</td>";
           
            echo "</tr>";
        }
     
        echo "</table>";
        
        echo "<div id='pagination'>";
        $this->pagination->initialize($config);
        echo $this->pagination->create_links();
        echo"</div>";
    }
}




?>