<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/giaovien_tkb.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jgiaovien_tkb.js"></script>        
	<title><?php echo $title ?></title>
</head>

<body>
<div id="wrapper">
    <div id="header">
    <img src="<?php echo static_url(); ?>/images/logo.gif" alt="logo.gif" id="logo" />     
    <img src="<?php echo static_url(); ?>/images/header_pic.png" alt="header_" id="header_pic" />
     <p>Trường Đại Học Công Nghệ Thông Tin<br />
       Trường Đại Học Quốc Gia Thành Phố Hồ Chí Minh<br />
       Hệ Thống Đăng Ký Học Phần
    </p>
    </div><!--#header -->
    <div id="page">
    
    <!--div #main_menu -->    
    <?php include_once("vmain_menu.php"); ?>
    <!--END div #main_menu --> 
       
    <div id="data">
        <div id="left">
        <h3>Quản lý giáo viên</h3>
        <ul>
            <li><a href="/quanly/giaovien">Danh sách giáo viên<?php echo "(".$total_rows.")"; ?></a></li>
            <li><a href="/quanly/giaovien/them-giao-vien">Thêm giáo viên</a></li>
            <li><a class="active" href="/quanly/giaovien/lich-giang-day">Lịch giảng dạy</a></li>
            <li><a href="/quanly/giaovien/nhap-du-lieu">Nhập dữ liệu</a></li>
            <li><a href="/quanly/giaovien/thongke">Thống kê</a></li>
            
            
        </ul>
        </div><!--end #left -->
        
        <div id="right">
            <div id="tool">
                <p id="data_title">&#187;&#187;<?php echo $data_title; ?></p>
                <img id="mail" title="Gửi thời khóa biểu giảng dạy cho giáo viên" src="<?php echo static_url(); ?>/images/mail.png" alt="mail" />
                <img id="export" title="Xuất thời khóa biểu thành file(Excel,PDF)" src="<?php echo static_url(); ?>/images/export.png" alt="export" />
                <img id="print" title="In thời khóa biểu này(PDF)" src="<?php echo static_url(); ?>/images/print.png" alt="print" />
            </div><!--end #tool -->
            
            <div id="content">
                <?php 
                echo "<table>";                    
                    echo "<tr id='first'>";
                    echo "<th id='ca'></th>";
                    foreach($thu_result as $thu_row)
                    {
                        echo "<th>Thứ ".$thu_row->TenThu."</th>";
                    } 
                    echo "</tr>";
                    //Trong tung hang ca
                    foreach($ca_result as $ca_row)
                    {                      
                        echo "<tr>";
                        echo "<td class='ca' title='Ca $ca_row->TenCa'>$ca_row->TenCa</td>";
                        //trong tung cot thu
                        foreach($thu_result as $thu_row)
                        {
                            $id=$ca_row->TenCa.$thu_row->TenThu;
                            $lop_result=$this->mgiaovien->get_tkb($magv,$thu_row->TenThu,$ca_row->TenCa);
                            
                            echo "<td class='info'>";                           
                            foreach($lop_result as $lop_row)
                            {
                                $malop=$lop_row->MaLop;
                                $tenmh=$lop_row->TenMH;
                                $phong=$lop_row->Phong;
                                
                                $title="$tenmh \n$malop P.$phong";
                                $text="$tenmh<br \>$malop P.$phong";
                                echo "<p class='item' title='$title'>$text</p>";
                            }                                                   
                            echo "</td>";                      
                        } 
                        echo "</tr>";
                          
                    }
                    echo "</table>";//end table 
                    ?>
            </div><!--end #content -->
        </div><!--end #right -->        
    </div><!--end #data -->
    </div><!--#page -->
    
    <!-- #footer -->
    <?php include_once("vfooter.php"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   

<?php include_once("vpopup.php"); ?>

</body>
</html>