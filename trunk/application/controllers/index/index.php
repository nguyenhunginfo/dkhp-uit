<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller 
{
	function _construct()
	{
		parent::_construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}
	
	function login()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->model('index/mlogin');
		$this->load->library('session');
		$data['cap'] = $this->mlogin->getCaptcha(33, 200, 3000);
		if(!isset($_POST['captcha']))
		{
			$this->load->view('index/vlogin',$data);
			return;
		}
		if($_POST['captcha']==$_POST['captchavalue'])
		{
			//nhập đúng captcha			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|md5');
			if ($this->form_validation->run() == FALSE)
			{
				//điều kiện sai
				$data['formeload'] = '1';
				$this->load->view('index/vlogin',$data);
			}
			else
			{
				//diều kiện đúng
				$login = $this->mlogin->login($_POST['username'], $_POST['password']);
				switch($login)
				{
					case '0': 
						$data['formeload'] = '1';
						$data['accounterror'] = "Tài khoản đang bị khóa!";
						$this->load->view('index/vlogin', $data);
						break;
					case '2':						
						$data['formeload'] = '1';
						$data['accounterror'] = "Tài khoản hoặc mật khẩu sai!";
						$this->load->view('index/vlogin', $data);			
						break;
					default:
						$this->session->set_userdata('name', $_POST['username']);
						if($_POST['username'] == 'admin')
						{
							$this->load->view('admin/vtrangchu');
							return;
						}
						$this->session->set_userdata('khoa', $khoa);
						$array = explode("|",$login);
						$khoa = $array[1];
						$this->toVindex($_POST['username'], $khoa);
						break;
				}
			}
		}
		else
		{
			//captcha sai	
			$data['old'] = $_POST['captcha'];
			$data['new'] = $_POST['captchavalue'];
			$data['cap'] = $this->mlogin->getCaptcha(33, 200, 3000);
			$data['formerror'] = '1';
			$data['captchaerror'] = '1';
			$this->load->view('index/vlogin', $data);
		}
	}
	
	function logout()
	{
		$this->load->helper('url');
		$this->load->library('session');
		$this->session->unset_userdata('name');
		$this->load->model('index/mlogin');
		$data['cap'] = $this->mlogin->getCaptcha(33, 200, 3000);
		$this->load->view('index/vlogin', $data);
	}
	
	private function toVindex($MSSV, $khoa)	//lấy những dữ liệu cần thiết đưa ra Vindex
	{
		$this->load->model('index/mlogin');
		$data['MSSV'] = $MSSV;	
		$data['khoa'] = $khoa;
		switch($khoa)
		{
			case "mmt":
				$data['TenSV'] = $this->mlogin->getNameMMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtMMT($MSSV);
				$data['loplt'] = $this->mlogin->getLopltMMT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthMMT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
			case "cnpm":
				$data['TenSV'] = $this->mlogin->getNameCNPM($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtCNPM($MSSV);
				$data['loplt'] = $this->mlogin->getLopltCNPM($MSSV);
				$data['lopth'] = $this->mlogin->getLopthCNPM($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
			case "khmt":
				$data['TenSV'] = $this->mlogin->getNameKHMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtKHMT($MSSV);
				$data['loplt'] = $this->mlogin->getLopltKHMT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthKHMT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
			case "ktmt":
				$data['TenSV'] = $this->mlogin->getNameKTMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtKTMT($MSSV);
				$data['loplt'] = $this->mlogin->getLopltKTMT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthKTMT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
			case "httt":
				$data['TenSV'] = $this->mlogin->getNameHTTT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtHTTT($MSSV);
				$data['loplt'] = $this->mlogin->getLopltHTTT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthHTTT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
		}
		$this->load->view('index/vindex', $data);		
	}
	
	function getLop()
	{		
		$this->load->model('index/mlogin');
		$this->mlogin->getLop($_POST['MaMH'], $_POST['MSSV'], $_POST['khoa']);
	}
	
	function register()
	{
		$this->load->helper('url');
		$this->load->library('session');
		$name = $this->session->userdata('name');
		if($name == false || !isset($_POST['MSSV']))
		{
			return;
		}
		else
		{
			if($name != $_POST['MSSV'])
				return;
		}
		
		$this->load->model('index/mlogin');
		$this->mlogin->registerMMT($_POST['MSSV'], $_POST['DKHP']);
		
		header('Location: '.base_url());
	}
	
	function changePass()
	{
		$this->load->library('session');
		$name = $this->session->userdata('name');
		if($name == false || !isset($_POST['MSSV']))
		{
			return;
		}
		else
		{
			if($name != $_POST['MSSV'])
				return;
		}
		if(isset($_POST['Pass']))
		{
			$this->load->model('index/mlogin');
			$this->mlogin->changePass($_POST['MSSV'], $_POST['Pass']);
			echo "OK";
		}
	}
	
	function showTKB()
	{
		$this->load->helper('url');
		$this->load->library('session');
		$name = $this->session->userdata('name');
		if($name == false || !isset($_GET['MSSV']))
		{
			return;
		}
		else
		{
			if($name != $_GET['MSSV'])
				return;
		}
		if(isset($_GET['khoa']))
		{
			$this->load->model('index/mlogin');
			$data["TKB"] = $this->mlogin->showTKB($_GET['MSSV'], $_GET['khoa']);
			$this->load->view('index/vtkb', $data);	
		}
	}
}