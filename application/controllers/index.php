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
		//Nếu đã có session
		$name = $this->session->userdata('name');
		if($name!= false)
		{
			if($name == 'admin')
			{
				header('Location: '.base_url().'trangchu');
			}
			else
			{
				$khoa = $this->session->userdata('khoa');
				$IsRegisterred = $this->mlogin->IsRegisterred($name, $khoa);
				if($IsRegisterred == '1')
				{
					header('Location: '.base_url().'ket-qua');
				}
				else
				{
					header('Location: '.base_url().'dang-ki-hoc-phan');
				}
			}
			return;
		}
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
							header('Location: '.base_url().'trangchu');
							return;
						}
						$array = explode("|",$login);
						$khoa = $array[1];
						$t = explode("|", $this->mlogin->getK($_POST['username'], $khoa));
						$K = $t[0];
						$MaCN = $t[1];
						//if($MaCN != "")
						//{
							//$TenCN = $this->mlogin->getCN($MaCN);
							//$this->session->set_userdata('TenCN', $TenCN);
						//}
						$this->session->set_userdata('K', $K);
						$this->session->set_userdata('MaCN', $MaCN);
						$this->session->set_userdata('khoa', $khoa);
						$IsRegisterred = $this->mlogin->IsRegisterred($_POST['username'], $khoa);
						if($IsRegisterred == '1')
						{
							header('Location: '.base_url().'ket-qua');
						}
						else
						{
							header('Location: '.base_url().'dang-ki-hoc-phan');
						}
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
			$data['formeload'] = '1';
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
		$this->session->unset_userdata('khoa');
		$this->session->unset_userdata('K');
		$this->session->unset_userdata('MaCN');
		header('Location: '.base_url());
	}
	
	function mcn()//hien ra popup mon cn
	{
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$this->load->library('session');
		$ID = $this->input->post("ID");
		$MSSV = $this->session->userdata('name');
		$khoa = $this->session->userdata('khoa');
		$MaCN = $this->session->userdata('MaCN');
		$K = $this->session->userdata('K');		
		$this->mlogin->tenCN($khoa, $K, $MaCN);
        //echo $khoa." ".$K." ".$MaCN;
        
		if($MaCN == "")//chưa đk cn
		{
			$this->mlogin->lopCNAll($khoa, $K, $ID);
			return;
		}
		//đã dk cn
        //echo $MSSV;
		$this->mlogin->lopCN($MSSV, $MaCN, $ID);
        
	}
	
	function mtc()//hien ra popup mon tc
	{
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$this->load->library('session');
		$ID = $_POST['ID'];
		$MaMH = $_POST['MaMH'];
		$MSSV = $this->session->userdata('name');
		$khoa = $this->session->userdata('khoa');
		$MaCN = $this->session->userdata('MaCN');
		$K = $this->session->userdata('K');		
		$this->mlogin->tenCN($khoa, $K, $MaCN);
		if($MaCN == "")//chưa đk cn
		{
			$this->mlogin->lopTCAll($khoa, $K, $ID, $MaMH);
			return;
		}
		//đã dk cn
		$this->mlogin->lopTC($MSSV, $MaCN, $ID, $MaMH);
	}
	
	function dkmn()
	{
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$this->load->library('session');
		$MaCN = $_POST['MaCN'];
		$IDnhom = $_POST['IDnhom'];
		$del = $_POST['del'];
		$ins = $_POST['ins'];
		$del = trim($del);
		$ins = trim($ins);
		if($del == "" && $ins == "")
			return;
		$MSSV = $this->session->userdata('name');
		$khoa = $this->session->userdata('khoa');
		$K = $this->session->userdata('K');
		if($this->session->userdata('MaCN') == "")
		{
			//chưa đk cn => đk lần đầu.
			if($this->mlogin->ins($MSSV, $khoa, $IDnhom, $ins) == false)
				return;
			$this->mlogin->setCN($MSSV, $khoa, $MaCN);
			$this->session->set_userdata('MaCN', $MaCN);
		}
		else
		{
			if($this->mlogin->ins($MSSV, $khoa, $IDnhom, $ins) == false)
				return;
			if($this->mlogin->del($MSSV, $khoa, $IDnhom, $del) == false)
			{
				//bỏ các môn cn => chưa đk cn
				$this->session->unset_userdata('MaCN');
			}
		}
	}
	
	function dkmd()
	{
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$this->load->library('session');
		$MaMH = $_POST['MaMH'];
		$del = $_POST['del'];
		$ins = $_POST['ins'];
		$del = trim($del);
		$ins = trim($ins);
		if($del == "" && $ins == "")
			return;
		$MSSV = $this->session->userdata('name');
		$khoa = $this->session->userdata('khoa');
		if($this->mlogin->dangky($MSSV, $khoa, $ins) == false)
				return;
		$this->mlogin->bodangky($MSSV, $khoa, $del);
	}
	
	function toVresult()
	{
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('index/mlogin');
		$MSSV = $data['MSSV'] = $this->session->userdata('name');	
		$khoa = $data['khoa'] = $this->session->userdata('khoa');
		$K = $this->session->userdata('K');
		if($K == false)
		{
			header('Location: '.base_url());
		}
		$data['TCTD'] = $this->mlogin->TCTD();
		switch($khoa)
		{
			case "mmt":
				$data['TenSV'] = $this->mlogin->getNameMMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtMMT($MSSV, $K);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['MonTH'] = $this->mlogin->getMonDKth($MSSV, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
			case "cnpm":
				$data['TenSV'] = $this->mlogin->getNameCNPM($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtCNPM($MSSV, $K);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['MonTH'] = $this->mlogin->getMonDKth($MSSV, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
			case "khmt":
				$data['TenSV'] = $this->mlogin->getNameKHMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtKHMT($MSSV, $K);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['MonTH'] = $this->mlogin->getMonDKth($MSSV, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
			case "ktmt":
				$data['TenSV'] = $this->mlogin->getNameKTMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtKTMT($MSSV, $K);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['MonTH'] = $this->mlogin->getMonDKth($MSSV, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
			case "httt":
				$data['TenSV'] = $this->mlogin->getNameHTTT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtHTTT($MSSV, $K);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['MonTH'] = $this->mlogin->getMonDKth($MSSV, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
		}
		$this->load->view('index/vresult', $data);	
	}
	
	public function toVindex($MSSV="", $khoa="")	//lấy những dữ liệu cần thiết đưa ra Vindex
	{
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$this->load->library('session');
		if($MSSV == "")
		{
			$MSSV = $this->session->userdata('name');
			$khoa = $this->session->userdata('khoa');
		}
		$data['MSSV'] = $MSSV;	
		$data['khoa'] = $khoa;
		$data['lopdn'] = $this->mlogin->getDeNghi($MSSV);
		$K = $this->session->userdata('K');
		$data['TCTD'] = $this->mlogin->TCTD();
		switch($khoa)
		{
			case "mmt":
				$data['TenSV'] = $this->mlogin->getNameMMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtMMT($MSSV, $K);
				$data['loplt'] = $this->mlogin->getLopltMMT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthMMT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['group'] = $this->mlogin->groupOpen($khoa, $K);
				$data['lopcn'] = $this->mlogin->getlopCN($MSSV, $K, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
			case "cnpm":
				$data['TenSV'] = $this->mlogin->getNameCNPM($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtCNPM($MSSV, $K);
				$data['loplt'] = $this->mlogin->getLopltCNPM($MSSV);
				$data['lopth'] = $this->mlogin->getLopthCNPM($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['group'] = $this->mlogin->groupOpen($khoa, $K);
				$data['lopcn'] = $this->mlogin->getlopCN($MSSV, $K, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
			case "khmt":
				$data['TenSV'] = $this->mlogin->getNameKHMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtKHMT($MSSV, $K);
				$data['loplt'] = $this->mlogin->getLopltKHMT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthKHMT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['group'] = $this->mlogin->groupOpen($khoa, $K);
				$data['lopcn'] = $this->mlogin->getlopCN($MSSV, $K, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
			case "ktmt":
				$data['TenSV'] = $this->mlogin->getNameKTMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtKTMT($MSSV, $K);
				$data['loplt'] = $this->mlogin->getLopltKTMT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthKTMT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['group'] = $this->mlogin->groupOpen($khoa, $K);
				$data['lopcn'] = $this->mlogin->getlopCN($MSSV, $K, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
			case "httt":
				$data['TenSV'] = $this->mlogin->getNameHTTT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtHTTT($MSSV, $K);
				$data['loplt'] = $this->mlogin->getLopltHTTT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthHTTT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				$data['group'] = $this->mlogin->groupOpen($khoa, $K);
				$data['lopcn'] = $this->mlogin->getlopCN($MSSV, $K, $khoa);
				$data['sotc'] = $this->mlogin->soTC($MSSV, $khoa);
				break;
		}
		$this->load->view('index/vindex', $data);	
	}
	
	function getLop()
	{		
		$this->load->model('index/mlogin');
		$this->mlogin->getLop($_POST['MaMH'], $_POST['MSSV'], $_POST['khoa']);
	}
	
	function sotc()
	{
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$this->load->library('session');
		$MSSV = $this->session->userdata('name');
		$khoa = $this->session->userdata('khoa');
		$sotc = $this->mlogin->soTC($MSSV, $khoa);
		echo $sotc;
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
		$this->mlogin->deNghi($_POST['MSSV'], $_POST['denghi']);
		switch($_POST['khoa'])
		{
			case "mmt":
				$this->mlogin->registerMMT($_POST['MSSV'], $_POST['DKHP']);
				break;
			case "khmt":
				$this->mlogin->registerKHMT($_POST['MSSV'], $_POST['DKHP']);
				break;
			case "ktmt":
				$this->mlogin->registerKTMT($_POST['MSSV'], $_POST['DKHP']);
				break;
			case "httt":
				$this->mlogin->registerHTTT($_POST['MSSV'], $_POST['DKHP']);
				break;
			case "cnpm":
				$this->mlogin->registerCNPM($_POST['MSSV'], $_POST['DKHP']);
				break;
		}		
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
			$this->load->helper('url');
			$this->load->model('index/mlogin');
			$data["TKB"] = $this->mlogin->showTKB($_GET['MSSV'], $_GET['khoa']);
			$this->load->view('index/vtkb', $data);	
		}
	}
	
	function in($data)
	{
		$array = explode("%20",$data);
		$this->load->library('session');
		$name = $this->session->userdata('name');
		if($name == false || count($array) != 2 || $name != $array[0])
		{
			return;
		}
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$result = $this->mlogin->getMonDK($array[0], $array[1]);
		$name = $this->mlogin->getNameMMT($array[0]);
		$TenKhoa = $this->mlogin->getTenKhoa($array[1]);	
    		
		$html = '<div style="text-align: center;">    
				<h1>Đại Học Quốc Gia Thành Phố Hồ Chí Minh</h1>
				<h2>Đại Học Công Nghệ Thông Tin</h2>
				<img src="'.static_url().'/images/index/uit.png" width="67px" height="70px" /> 
				</div>
                                <p style="text-align:center; font-size:18px">PHIẾU ĐĂNG KÝ HỌC PHẦN</p>
                                <p style="text-align:left; font-size:14px">MSSV:<b> '.$array[0].'</b>&nbsp;&nbsp;&nbsp;&nbsp;Họ Tên:<b> '.$name.'</b><br>Khoa:<b> '.$TenKhoa.'</b></p>
                                <table border="1" style="text-align:center">
                                <tr>
                                    <th style="width:50px;"><b>STT</b></th>
                                    <th style="width:80px;"><b>Mã Lớp</b></th>
                                    <th style="width:60px;"><b>Mã Môn</b></th>
                                    <th style="width:220px;"><b>Tên Môn Học</b></th>
                                    <th style="width:60px;"><b>Số TC</b></th>                                   
                                    
                                </tr>';
        $TongTC = 0;
		$i = 1;
		foreach($result->result() as $row)
		{
            $html=$html."<tr>
                            <td>".$i."</td>
                            <td>".$row->Malop."</td>
                            <td>".$row->MaMH."</td>
                            <td>".$row->TenMH."</td>
                            <td>".$row->SoTC."</td>
                        </tr>";
            $TongTC += $row->SoTC;
			$i++;
		}
                                
        //lay tong so tin chi
        $html=$html.'</table><p style="text-align:right;font-size:14px;">Tổng số TC: '.$TongTC.'</p>';
        $html=$html.'<p style="text-align:right;font-size:14px;">Chữ Ký Sinh Viên &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Xác Nhận PĐT<br><br><br><br><br><br><br><br><br><br><br> </p>';                 
        date_default_timezone_set("Asia/Ho_Chi_Minh");                   
        $html=$html.'<p style="text-align:left;font-size:14px;">Thời điểm in: '.date("d\/m\/Y, H:i:s a").'<br><u>Chú ý:</u> Sinh viên không tự ý thay đổi nội dung tập tin này</p>';                         
		echo $html;
	}
	
	function denghi()
	{
		$this->load->library('session');
		$MSSV = $this->session->userdata('name');
		$MaMH = $_POST['MaMH'];
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$this->mlogin->deNghi($MSSV, $MaMH);	
	}
	
	function updateTKB()
	{
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$this->load->library('session');
		$MSSV = $this->session->userdata('name');	
		$khoa = $this->session->userdata('khoa');
		if($MSSV == false)
			return;
		$TKB = $this->mlogin->getTKB($MSSV, $khoa);
		$this->mlogin->updateTKB($TKB);
	}
	
	function xuatfile()
	{
		$this->load->library('session');
		$MSSV = $this->session->userdata('name');
		$khoa = $this->session->userdata('khoa');
		if($MSSV == false)// || !isset($_POST['MSSV']) || !isset($_POST['khoa']))
		{
			echo "ko có session".$MSSV;
			//return;
		}
		
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$result = $this->mlogin->getMonDK($MSSV, $khoa);
		$name = $this->mlogin->getNameMMT($MSSV);
		$TenKhoa = $this->mlogin->getTenKhoa($khoa);
        $this->load->library('TCPDF/tcpdf.php'); 		
    
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);        
    
		// option
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetFont('freeserif', '', 12);
		$pdf->SetTextColor(0, 0, 0);   
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    
		// add a page
		$pdf->AddPage();
		
		$html = '<div style="text-align: center;">    
				<h3>Đại Học Quốc Gia Thành Phố Hồ Chí Minh</h3>
				<h4>Trường Đại Học Công Nghệ Thông Tin</h4>
				</div>';
				//<img src="logo.jpg" width="60px" height="50px" /> 
				//<img src="'.static_url().'/images/index/uit.png" width="67px" height="70px" /> 
				
		$html=$html.'
                                <p style="text-align:center; font-size:25px">PHIẾU ĐĂNG KÝ HỌC PHẦN</p>
                                <p style="text-align:left; font-size:20px">MSSV:<b> '.$MSSV.'</b>&nbsp;&nbsp;&nbsp;&nbsp;Họ Tên:<b> '.$name.'</b><br>Khoa:<b> '.$TenKhoa.'</b></p>
                                <table border="1" style="text-align:center">
                                <tr>
                                    <th style="width:50px;"><b>STT</b></th>
                                    <th style="width:80px;"><b>Mã Lớp</b></th>
                                    <th style="width:60px;"><b>Mã Môn</b></th>
                                    <th style="width:220px;text-align:left;"><b>Tên Môn Học</b></th>
                                    <th style="width:60px;"><b>Số TC</b></th>                                   
                                    
                                </tr>';
        $TongTC = 0;
		$i = 1;
		foreach($result->result() as $row)
		{
            $html=$html."<tr>
                            <td>".$i."</td>
                            <td>".$row->Malop."</td>
                            <td>".$row->MaMH."</td>
                            <td style='text-align:left;'>".$row->TenMH."</td>
                            <td>".$row->SoTC."</td>
                        </tr>";
            $TongTC += $row->SoTC;
			$i++;
		}
                                
        //lay tong so tin chi
        $html=$html.'</table><p style="text-align:right;font-size:14px;">Tổng số TC: '.$TongTC.'</p>';
        $html=$html.'<p style="text-align:right;font-size:14px;">Chữ Ký Sinh Viên &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Xác Nhận PĐT<br><br><br><br><br><br><br><br><br><br><br> </p>';                 
        date_default_timezone_set("Asia/Ho_Chi_Minh");                   
        $html=$html.'<p style="text-align:left;font-size:14px;">Thời điểm in: '.date("d\/m\/Y, H:i:s a").'<br><u>Chú ý:</u> Sinh viên không tự ý thay đổi nội dung tập tin này</p>';                         
                              
        $pdf->SetMargins(50,0,80);

				
		// write the text
		$pdf->writeHTML($html);
    
    
		//Close and output PDF document
		$pdf->Output("filename.pdf", 'I');
	}
}