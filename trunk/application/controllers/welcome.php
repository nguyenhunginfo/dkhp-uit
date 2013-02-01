<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	function _construct()
	{
		parent::_construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}
	
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		//dã có session
		$name = $this->session->userdata('name');
		if($name!= false)
		{
			header('Location: '.base_url().'index/login');
			return;
		}
		$this->load->model('index/mlogin');
		$data['cap'] = $this->mlogin->getCaptcha(33, 200, 3000);
		$this->load->view('index/vlogin', $data);
	}
}