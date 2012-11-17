<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tkb extends CI_Controller 
{
	function _construct()
	{
		parent::_construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}
	
	function index()
	{
		$this->load->library('session');
		$this->load->helper('url');	
		$MSSV = $this->session->userdata('name');
		if($MSSV == false)
		{
			header('Location: '.base_url());
			return;
		}
		$khoa = $this->session->userdata('khoa');	
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
				$data['TKBfull'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
			case "cnpm":
				$data['TenSV'] = $this->mlogin->getNameCNPM($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtCNPM($MSSV);
				$data['loplt'] = $this->mlogin->getLopltCNPM($MSSV);
				$data['lopth'] = $this->mlogin->getLopthCNPM($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['TKBfull'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
			case "khmt":
				$data['TenSV'] = $this->mlogin->getNameKHMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtKHMT($MSSV);
				$data['loplt'] = $this->mlogin->getLopltKHMT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthKHMT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['TKBfull'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
			case "ktmt":
				$data['TenSV'] = $this->mlogin->getNameKTMT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtKTMT($MSSV);
				$data['loplt'] = $this->mlogin->getLopltKTMT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthKTMT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['TKBfull'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
			case "httt":
				$data['TenSV'] = $this->mlogin->getNameHTTT($MSSV);
				$data['ctdt'] = $this->mlogin->getCtdtHTTT($MSSV);
				$data['loplt'] = $this->mlogin->getLopltHTTT($MSSV);
				$data['lopth'] = $this->mlogin->getLopthHTTT($MSSV);
				$data['TKB'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['TKBfull'] = $this->mlogin->getTKB($MSSV, $khoa);
				$data['MonDK'] = $this->mlogin->getMonDK($MSSV, $khoa);
				break;
		}
		$data["TKB"] = $this->mlogin->showTKB($MSSV, $khoa);
		$this->load->view('index/vtkb', $data);		
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
				<h1>�?i H?c Qu?c Gia Th�nh Ph? H? Ch� Minh</h1>
				<h2>�?i H?c C�ng Ngh? Th�ng Tin</h2>
				<img src="'.static_url().'/images/index/uit.png" width="67px" height="70px" /> 
				</div>
                                <p style="text-align:center; font-size:18px">PHI?U �ANG K� H?C PH?N</p>
                                <p style="text-align:left; font-size:14px">MSSV:<b> '.$array[0].'</b>&nbsp;&nbsp;&nbsp;&nbsp;H? T�n:<b> '.$name.'</b><br>Khoa:<b> '.$TenKhoa.'</b></p>
                                <table border="1" style="text-align:center">
                                <tr>
                                    <th style="width:50px;"><b>STT</b></th>
                                    <th style="width:80px;"><b>M� L?p</b></th>
                                    <th style="width:60px;"><b>M� M�n</b></th>
                                    <th style="width:220px;"><b>T�n M�n H?c</b></th>
                                    <th style="width:60px;"><b>S? TC</b></th>                                   
                                    
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
        $html=$html.'</table><p style="text-align:right;font-size:14px;">T?ng s? TC: '.$TongTC.'</p>';
        $html=$html.'<p style="text-align:right;font-size:14px;">Ch? K� Sinh Vi�n &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X�c Nh?n P�T<br><br><br><br><br><br><br><br><br><br><br> </p>';                 
        date_default_timezone_set("Asia/Ho_Chi_Minh");                   
        $html=$html.'<p style="text-align:left;font-size:14px;">Th?i di?m in: '.date("d\/m\/Y, H:i:s a").'<br><u>Ch� �:</u> Sinh vi�n kh�ng t? � thay d?i n?i dung t?p tin n�y</p>';                         
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
				<h1>�?i H?c Qu?c Gia Th�nh Ph? H? Ch� Minh</h1>
				<h2>�?i H?c C�ng Ngh? Th�ng Tin</h2>
				</div>';
				//<img src="logo.jpg" width="60px" height="50px" /> 
				//<img src="'.static_url().'/images/index/uit.png" width="67px" height="70px" /> 
				
		$html=$html.'
                                <p style="text-align:center; font-size:18px">PHI?U �ANG K� H?C PH?N</p>
                                <p style="text-align:left; font-size:14px">MSSV:<b> '.$_POST['MSSV'].'</b>&nbsp;&nbsp;&nbsp;&nbsp;H? T�n:<b> '.$name.'</b><br>Khoa:<b> '.$TenKhoa.'</b></p>
                                <table border="1" style="text-align:center">
                                <tr>
                                    <th style="width:50px;"><b>STT</b></th>
                                    <th style="width:80px;"><b>M� L?p</b></th>
                                    <th style="width:60px;"><b>M� M�n</b></th>
                                    <th style="width:220px;"><b>T�n M�n H?c</b></th>
                                    <th style="width:60px;"><b>S? TC</b></th>                                   
                                    
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
        $html=$html.'</table><p style="text-align:right;font-size:14px;">T?ng s? TC: '.$TongTC.'</p>';
        $html=$html.'<p style="text-align:right;font-size:14px;">Ch? K� Sinh Vi�n &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X�c Nh?n P�T<br><br><br><br><br><br><br><br><br><br><br> </p>';                 
        date_default_timezone_set("Asia/Ho_Chi_Minh");                   
        $html=$html.'<p style="text-align:left;font-size:14px;">Th?i di?m in: '.date("d\/m\/Y, H:i:s a").'<br><u>Ch� �:</u> Sinh vi�n kh�ng t? � thay d?i n?i dung t?p tin n�y</p>';                         
                              
        $pdf->SetMargins(50,0,80);

				
		// write the text
		$pdf->writeHTML($html);
    
    
		//Close and output PDF document
		$pdf->Output("filename.pdf", 'I');
	}
}