<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/giaovien_statistic.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    
    
            
	<title><?php echo $title ?></title>
</head>
<style type="text/css">

.box table{border-collapse: collapse;}
.box table{margin:10px 50px;}
.box table td{border:1px solid #e8e9e8;font-size:14px;}
.box table td{width:400px;}
</style>
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
            <li><a href="/quanly/giaovien/lich-giang-day">Lịch giảng dạy</a></li>
            <li><a href="/quanly/giaovien/nhap-du-lieu">Nhập dữ liệu</a></li>
            <li><a class="active" href="/quanly/giaovien/thongke">Thống kê</a></li>
            
            
        </ul>
        </div><!--end #left -->
        
        <div id="right"> 

                    <h3><?php echo $data_title; ?></h3>
                    <div class='box' style="margin:0px;">
                    <table>
                    <tr><td>Tổng số giáo viên:</td><td><?php echo $total_rows; ?></td></tr>
                    <tr><td>Tổng số giáo viên nam: </td><td><?php echo 10; ?></td></tr>
                    <tr><td>Tổng số giáo viên nữ:</td><td><?php echo $total_rows-10; ?></td></tr>
                    </table>
                   
                    </div><!--end  a .box -->
                
        </div><!--end #right --> 
    </div><!--end #data -->
    </div><!--#page -->
    
    <!-- #footer -->
    <?php include_once("vfooter.php"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   



</body>
</html>