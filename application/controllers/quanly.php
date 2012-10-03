<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quanly extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
    }
	public function index()
	{  
		$data["title"]="Trang quản lý";
        $this->load->view('admin/vquanly',$data);//default to to log's page        
   	}
    
}



?>