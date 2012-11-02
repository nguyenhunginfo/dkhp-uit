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
		$khoa = $this->session->userdata('khoa');
		if($name!= false)
		{
			if($name == 'admin')
			{
				$this->load->view('admin/vtrangchu');
			}
			else
			{
				$this->toVindex($name, $khoa);
			}
			return;
		}
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
}