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
				$this->toVindex($name, $khoa);
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
						$this->session->set_userdata('khoa', $khoa);
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
		header('Location: '.base_url());
	}
	
	private function toVindex($MSSV, $khoa)	//lấy những dữ liệu cần thiết đưa ra Vindex
	{
		$this->load->model('index/mlogin');
		$data['MSSV'] = $MSSV;	
		$data['khoa'] = $khoa;
		$data['lopdn'] = $this->mlogin->getDeNghi($MSSV);
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
	
	function xuatfile()
	{
		$this->load->library('session');
		$name = $this->session->userdata('name');
		if($name == false || !isset($_POST['MSSV']) || !isset($_POST['khoa']))
		{
			return;
		}
		else
		{
			if($name != $_POST['MSSV'])
				return;
		}
		
		$this->load->helper('url');
		$this->load->model('index/mlogin');
		$result = $this->mlogin->getMonDK($_POST['MSSV'], $_POST['khoa']);
		$name = $this->mlogin->getNameMMT($_POST['MSSV']);
		$TenKhoa = $this->mlogin->getTenKhoa($_POST['khoa']);
        $this->load->library('TCPDF/tcpdf.php'); 		
    
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);        
    
		// option
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetFont('freeserif', '', 12);
		$pdf->SetTextColor(0, 0, 0);    
    
		// add a page
		$pdf->AddPage();
		
		$html = '<div style="text-align: center;">    
				<h1>Đại Học Quốc Gia Thành Phố Hồ Chí Minh</h1>
				<h2>Đại Học Công Nghệ Thông Tin</h2>
				</div>';
				//<img src="logo.jpg" width="60px" height="50px" /> 
				//<img src="'.static_url().'/images/index/uit.png" width="67px" height="70px" /> 
				
		$html=$html.'
                                <p style="text-align:center; font-size:18px">PHIẾU ĐĂNG KÝ HỌC PHẦN</p>
                                <p style="text-align:left; font-size:14px">MSSV:<b> '.$_POST['MSSV'].'</b>&nbsp;&nbsp;&nbsp;&nbsp;Họ Tên:<b> '.$name.'</b><br>Khoa:<b> '.$TenKhoa.'</b></p>
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
                              
        $pdf->SetMargins(50,0,80);

				
		// write the text
		$pdf->writeHTML($html);
    
    
		//Close and output PDF document
		$pdf->Output("filename.pdf", 'I');
	}
}