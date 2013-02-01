<?php

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
//$pdf->SetFont('dejavusans', 'B', 20);
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();


$html = '<p style="text-align: center;font-size: 45px;">ĐẠI HỌC QUỐC GIA THÀNH PHỐ HỒ CHÍ MINH</p>
<p style="text-align: center;font-size: 45px;">TRƯỜNG ĐẠI HỌC CÔNG NGHỆ THÔNG TIN</p></br>
<p style="text-align: center;font-size: 45px;font-weight:bold;">GIẤY ĐĂNG KÝ HỌC PHẦN</p>
<p style="font-size: 40px;">Sinh viên: Nguyễn Quý Danh MSSV: 09520032</p></br>';
$pdf->writeHTML($html, true, false, false, false, '');

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table style="text-align: center;width:500px;" cellspacing="0" cellpadding="1" border="1">
						<tr >
                            <th style="text-align: center;width:30px;" >STT</th>
                            <th style="width:50px;">Mã Lớp</th>
                            <th style="width:150px;">Tên Môn Học</th>
                            <th style="width:30px;">Số TC</th>
                            <th style="width:150px;">Giảng Viên</th>
                            <th style="width:30px;">Thứ</th>
                            <th style="width:30px;">Ca</th>
                            <th style="width:50px;">Phòng</th>
                        </tr>
  
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
