<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/giaovien_add.css" />     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jgiaovien_add.js"></script>        
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
        <?php $this->load->view("admin/vmain_menu"); ?>
        <!--END div #main_menu --> 
           
        <div id="data">  
        <div id="left">
        <h3>Quản lý giáo viên</h3>
        <ul>
            <li><a href="/quanly/giaovien">Danh sách giáo viên<?php echo "(".$total_rows.")"; ?></a></li>
            <li><a class="active" href="/quanly/giaovien/them-giao-vien">Thêm giáo viên</a></li>
            <li><a href="/quanly/giaovien/nhap-du-lieu">Nhập dữ liệu</a></li>
            <li><a href="/quanly/giaovien/lich-giang-day">Lịch giảng dạy</a></li>
            <li><a href="/quanly/giaovien/thongke">Thống kê</a></li>
            
            
        </ul>
        </div><!--end #left -->
            <div id="right"> 
                    <h3><?php echo $data_title; ?> </h3>
                    <div class='box'>
                    <form>        
                        <table class="info"> 
                            <tr><td>Mã số giáo viên</td><td><input    name='magv'   id='magv'   type='text' title='Mã số ít nhất 4 kí tự'/></td></tr>          
                            <tr><td>Tên giáo viên</td><td><input  name='tengv'  id='tengv'  type='text'/></td></tr>
                            <tr><td>Ngày Sinh</td><td><input   name='ngaysinh'  id='ngaysinh'  type='text' title='vd: 20/10/2000, 20-10-2000' /></td></tr>
                            <tr><td>Nơi Sinh</td><td><textarea  name='noisinh'  id='noisinh' cols='25' rows='4'></textarea></td></tr>                            
                            <tr><td>Số ĐT</td><td><input        name='sodt'      id='sodt'    type='text'  title='vd: 016 9993 8919,0123 023 789'/> </td></tr>
                            <tr><td>Email</td><td><input        name='email'    id='email'  type='text'  
                                                                title="vd: abc@yahoo.com.vn,xyz@gmail.com... Tối đa 40 kí tự" /> </td></tr>               
                        </table><!--end .info -->
                             
                        <table class='error'>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>                        
                        </table>  
                    </form>
                    </div><!--end  a .box -->
                    
                    <div id="message">
                    <img alt="ok" src="<?php echo static_url() ?>/images/ok.png"/><span>Tạo sinh viên thành công</span>
                    
                    </div><!--end message -->
                    
                    <div id="action">
                        <h4 title="Phát hiện lỗi"><img src="<?php echo static_url(); ?>/images/error.png" />Phát hiện lỗi trong quá trình kiểm tra dữ liệu.Thao tác chỉ thành công khi không còn lỗi</h4>
                        <img id="create" title="Lưu" src="<?php echo static_url(); ?>/images/accept.png" />
                        <img id="process" title="Đang kiểm tra" src="<?php echo static_url(); ?>/images/process.gif" />
                    </div><!--end #action -->                   
                
            </div><!--end #right -->
        </div><!--end #data -->
        </div><!--#page =#main_menu + #data -->
    <!-- #footer -->
    <?php $this->load->view("admin/vfooter"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   



</body>
</html>