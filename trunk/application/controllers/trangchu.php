<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trangchu extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
    }
	public function index()
	{  
		$this->load->model("admin/mtrangchu");
        
        $khoa_result=$this->mtrangchu->get_khoa();
        $data["khoa_result"]=$khoa_result;
        $data["title"]="Trang chủ hệ thống đăng ký học phần";
        $this->load->view('admin/vtrangchu',$data);//default to to log's page        
   	}
   
}



?>