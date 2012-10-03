<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
    }
	public function index()
	{  
		$this->load->view('admin/vlog');//default to to log's page        
   	}
   
}



?>