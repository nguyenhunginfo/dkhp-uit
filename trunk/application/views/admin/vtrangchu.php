<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/trangchu.css" />      
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
         <?php $this->load->view("template/vtrangchu_menu"); ?>     
        <!--END div #main_menu --> 
    
        <div id="data">
            <div id="left">
            <h3>Chức năng</h3>
                <div id="ttlop" class="data_box">
                    <h4>Quản lý</h4>
                    <ul>
                        <li><a href="/quanly/sinhvien">Quản lý sinh viên</a></li>
                        <li><a href="/quanly/giaovien">Quản lý giáo viên</a></li>
                        <li><a href="/quanly/monhoc">Quản lý môn học</a></li>
                        <li><a href="/quanly/lophoc">Quản lý lớp học</a></li>
                        <li><a href="/quanly/he-thong-diem">Quản lý hệ thống điểm</a></li>
                        <li><a href="/quanly/chuong-trinh-dao-tao">Quản lý chương trình đào tạo</a></li>
                        <li><a href="/quanly/qua-trinh-dang-ky">Quản lý quá trình đăng ký</a></li>             
                    </ul>
                </div><!--end #ttlop -->
                
                <div id="ttlop" class="data_box">
                    <h4>Thống kê tổng quát</h4>
                    <ul>
                    <li><a href="#">Tình trạng sinh viên</a></li>
                    <li><a href="#">Tình trạng giáo viên</a></li>
                    <li><a href="#">Tình trạng môn học</a></li>
                    <li><a href="#">Tình trạng lớp học</a></li>
                    <li><a href="#">Tình trạng hệ thống điểm</a></li>
                    <li><a href="#">Tình trạng chương trình đào tạo</a></li>                
                    </ul>
                </div><!--end #ttlop -->
                
                <div id="ttlop" class="data_box">
                    <h4>Liên kết</h4>
                    <ul>
    				<li><a href="http://www.daa.uit.edu.vn">Phòng Đào tạo</a></li>
                    <li><a href="http://www.ctsv.uit.edu.vn">Phòng CTSV</a></li>
    				<li><a href="http://gxn.uit.edu.vn">Hệ thống giấy xác nhận</a></li>
                    <li><a href="http://courses.uit.edu.vn">Hệ thống Modules</a></li>
                    </ul>
                </div><!--end #ttlop -->
                <div id="ttlop" class="data_box">
                    <h4>Cấu hình</h4>
                    <ul>
    				<li><a href="#">Quy định và kế hoạch đăng ký học phần</a></li>
                    <li><a href="#">Bố trí thời gian đăng ký</a></li>
                    <li><a href="#">Quy định chung về môn học</a></li>                
                    <li><a href="#">Quy định chung về hệ thống điểm</a></li>
                    <li><a href="#">Quy đinh chung về chương trình đào tạo</a></li>
                    <li><a href="#">Giao diện</a></li>
                    </ul>
                </div><!--end #ttlop -->
            </div><!--end #left -->
            
            <div id="right">
                <h3>Cập nhật</h3>
                <div class="data_box">
                    <h4>Tình trạng lớp học</h4>
                    <ul>
                    <li><a href="#">Tổng số lớp đã mở:110</a></li>
                    <li><a href="#">Tổng số lớp đã mở:110</a></li>
                    <li><a href="#">Tổng số lớp đã mở:110</a></li>
                    <li><a href="#">Tổng số lớp đã mở:110</a></li>                             
                    </ul>
                </div><!--end #ttlop -->
                
                <div  class="data_box">
                    <h4>Tình trạng đăng ký</h4>
                    <ul>
                    <li>Tổng số lớp đã mở:110</li>
                    <li>Tổng số lớp đã hủy:5</li>
                    <li>Tổng số lớp đã có sinh viên đăng ký:54</li>
                     <li>Tổng số lớp đã mở:110</li>
                    <li>Tổng số lớp đã hủy:5</li>
                    <li>Tổng số lớp đã có sinh viên đăng ký:54</li>
                     <li>Tổng số lớp đã mở:110</li>
                    <li>Tổng số lớp đã hủy:5</li>
                    <li>Tổng số lớp đã có sinh viên đăng ký:54</li>
                    </ul>
                </div><!--end #ttlop -->
                
                <div class="data_box">
                    <h4>Tình trạng đăng ký</h4>
                    <ul>
                    <li>Tổng số lớp đã mở:110</li>
                    <li>Tổng số lớp đã hủy:5</li>
                    <li>Tổng số lớp đã có sinh viên đăng ký:54</li>
                     <li>Tổng số lớp đã mở:110</li>
                    <li>Tổng số lớp đã hủy:5</li>
                    <li>Tổng số lớp đã có sinh viên đăng ký:54</li>        
                    </ul>
                </div><!--end #ttlop -->
            </div><!--end #right -->            
        </div><!--end #data -->
    </div><!--#page -->
    
    
     <!-- #footer -->
    <?php $this->load->view("template/vfooter"); ?>
    <!-- End #footer-->
</div><!--end #wrapper -->   

</body>
</html>