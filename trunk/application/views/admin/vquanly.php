<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />      
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
    <?php $this->load->view("template/vmain_menu"); ?>
    <!--END div #main_menu --> 
    
    <div id="data">
        <div class="data_box">
            <h3>Chức năng quản lý</h3>
            <ul>
            <li><a href="/quanly/sinhvien">Quản lý sinh viên</a></li>
            <li><a href="/quanly/giaovien">Quản lý giáo viên</a></li>
            <li><a href="/quanly/monhoc">Quản lý môn học</a></li>
            <li><a href="/quanly/lophoc">Quản lý lớp học</a></li>
            <li><a href="/quanly/he-thong-diem">Quản lý hệ thống điểm</a></li>
            <li><a href="/quanly/chuong-trinh-dao-tao">Quản lý chương trình đào tạo</a></li>  
            <li><a href="/quanly/qua-trinh-dang-ky">Quản lý quá trình đăng ký</a></li>             
            </ul>
        </div>
    </div><!--end #data -->
    </div><!--#page -->
    
    
    <!-- #footer -->
    <?php $this->load->view("template/vfooter"); ?>
    <!-- End #footer-->
</div><!--end #wrapper -->   

</body>
</html>