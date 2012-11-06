<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
    }
	public function index()
	{  
	   $data["title"]="Trang quản lý giáo viên";
		$this->load->view('admin/vgiaovien',$data);           
   	}
   
}



?>