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
    <div id="main_menu">
	<ul>
		<li class="top first"><a href="/trangchu">Trang chủ</a></li>
		<li class="top active" ><a href="/quanly" title="Quản lý hệ thống">Quản lý&nbsp; &nbsp; <img src="<?php echo static_url(); ?>/images/arrow-down.png" /></a>
      	<ul>
				<li><a href="/quanly/sinhvien">Sinh viên &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &#187;</a>
                <ul>    
                    <li><a href="/quanly/sinhvien/mmt" title="Khoa mạng máy tính">Khoa MMT</a></li>							
					<li><a href="/quanly/sinhvien/cnpm" title="Khoa công nghệ phần mềm">Khoa CNPM</a></li>		
                    <li><a href="/quanly/sinhvien/httt" title="Khoa hệ thống thông tin">Khoa HTTT</a></li>
                    <li><a href="/quanly/sinhvien/ktmt" title="Khoa kỹ thuật máy tính">Khoa KTMT</a></li>		
                    <li><a href="/quanly/sinhvien/khmt" title="Khoa khoa học máy tính">Khoa KHMT</a></li>				
				</ul>
                </li>
				<li><a href="/quanly/giaovien">Giáo viên</a>					
				</li>
                <li><a href="/quanly/monhoc">Môn học &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &#187;</a>
                 <ul>
						<li><a href="/quanly/monhoc/daicuong" title="Môn học đại cương">Đại Cương</a></li>							
					    <li><a href="/quanly/monhoc/chuyennghanh" title="Môn học chuyên nghành">Chuyên Nghành</a></li>
				</ul>
                </li>
                <li><a href="/quanly/lophoc">Lớp học &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &#187;</a>
                 <ul>
						<li><a href="/quanly/lophoc/lop-da-mo">Lớp đã mở</a></li>	
                        <li><a href="/quanly/lophoc/lop-da-huy">Lớp đã hủy</a></li>						
					    <li><a href="/quanly/lophoc/lop-de-nghi">Lớp đề nghị</a></li>	
				</ul>
                </li>
                
                <li><a href="/quanly/he-thong-diem">Hệ thống điểm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&#187;</a>
                <ul>
						<li><a href="/quanly/he-thong-diem/mmt" title="Khoa mạng máy tính">Khoa MMT</a></li>							
					    <li><a href="/quanly/he-thong-diem/cnpm" title="Khoa công nghệ phần mềm">Khoa CNPM</a></li>		
                        <li><a href="/quanly/he-thong-diem/httt" title="Khoa hệ thống thông tin">Khoa HTTT</a></li>
                        <li><a href="/quanly/he-thong-diem/ktmt" title="Khoa kỹ thuật máy tính">Khoa KTMT</a></li>		
                        <li><a href="/quanly/he-thong-diem/khmt" title="Khoa khoa học máy tính">Khoa KHMT</a></li>				
				</ul>
                </li>
                <li><a href="/quanly/chuong-trinh-dao-tao">Chương trình đào tạo &nbsp; &#187;</a>
                <ul>
						<li><a href="/quanly/chuong-trinh-dao-tao/mmt" title="Khoa mạng máy tính">Khoa MMT</a></li>							
					    <li><a href="/quanly/chuong-trinh-dao-tao/cnpm" title="Khoa công nghệ phần mềm">Khoa CNPM</a></li>		
                        <li><a href="/quanly/chuong-trinh-dao-tao/httt" title="Khoa hệ thống thông tin">Khoa HTTT</a></li>
                        <li><a href="/quanly/chuong-trinh-dao-tao/ktmt" title="Khoa kỹ thuật máy tính">Khoa KTMT</a></li>		
                        <li><a href="/quanly/chuong-trinh-dao-tao/khmt" title="Khoa khoa học máy tính">Khoa KHMT</a></li>				
				</ul>
                </li>
		</ul>		
		</li><!--end li quan ly -->
        
		<li class="top"><a  href="/thongke" title="Thống kê sơ lược">Thống Kê<img src="<?php echo static_url(); ?>/images/arrow-down.png" /></a>
        	<ul>
				<li><a href="#">Trạng thái lớp học</a></li>
                <li><a href="#">Trạng thái đăng ký</a></li>
				<li><a href="#">Trạng thái sinh viên</a></li>
                <li><a href="#">Trạng thái đào tạo</a></li>
                <li><a href="#">Kết quả học tập</a></li>
			</ul>
        </li><!--end li thong ke -->
		<li class="top"><a  href="/lienket">Liên kết &nbsp; <img src="<?php echo static_url(); ?>/images/arrow-down.png" /></a>
			<ul>
				<li><a href="http://www.daa.uit.edu.vn">Phòng Đào tạo</a></li>
                <li><a href="http://www.ctsv.uit.edu.vn">Phòng CTSV</a></li>
				<li><a href="http://gxn.uit.edu.vn">Hệ thống giấy xác nhận</a></li>
                <li><a href="http://courses.uit.edu.vn">Hệ thống Modules</a></li>
			</ul>
		</li>
		<li class="top"><a href="/cau-hinh-he-thong" title="Cấu hình hệ thống">Cấu hình</a></li>
		<li class="top"><a  href="/dieu-chinh-thong-tin" title="Thao tác thay đổi tài khoản Admin">Admin</a></li>
		
	</ul>
    </div><!--end main_menu -->
    
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
    
    
    <div id="footer">
        <img id="separator" src="<?php echo static_url(); ?>/images/separator.png" alt="sepa" />
        <div id="info">
            <div>
            <p>Trường Đại Học Công Nghệ Thông Tin</p>
            <p>Trường Đại Học Quốc Gia Thành Phố Hồ Chí Minh</p>
            <p>Khu phố 6, Phường Linh Trung, Thủ Đức</p>
            <p>Website:<a href="http://www.uit.edu.vn"> http://www.uit.edu.vn</a></p>
            <p>Fax: 08 7773777 &nbsp;&nbsp;Phone: 08 8884888</p>
           
            </div>
            
        </div>    
        <div id="contact">
        <h4>Liên hệ</h4>
        <p>Email: admin.uit@gmail.com</p>
        <p>Phone: 01699938919</p>
        </div>
        <div id="copyright">
        <p>University of Infomation Technology &copy;Copyright 2012 Hệ thống được xây dựng trên nền tảng CodeIgniter PHP Framework</p>
        </div>
    </div><!--#footer -->
</div><!--end #wrapper -->   

</body>
</html>