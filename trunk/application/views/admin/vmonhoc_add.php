<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/monhoc_add.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jmonhoc_add.js"></script>        
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
        <h3>Quản lý môn học</h3>
        <ul>
        <li><a  href="/quanly/monhoc">Danh sách môn học</a>
            <?php
            $num_tatca=$this->mmonhoc->get_num_rows("","tatca");
            $num_DC=$this->mmonhoc->get_num_rows("","DC");
            $num_CN=$this->mmonhoc->get_num_rows("","CN");
            echo "<ul>";            
                echo "<li id='tatca'  > <a href='/quanly/monhoc'>Tất cả(".$num_tatca.")</a> </li>";
                echo "<li id='DC'  >    <a href='/quanly/monhoc/DC'>Đại Cương(".$num_DC.")</a></li>";
                echo "<li id='CN'  >    <a href='/quanly/monhoc/CN'>Chuyên Nghành(".$num_CN.")</a></li>";
            echo "</ul>";
            ?> 
        </li>
        
        
        <li><a class="active" href="/quanly/monhoc/them-mon-hoc">Thêm môn học</a></li>   
        <li><a href="/quanly/monhoc/nhap-du-lieu">Nhập dữ liệu</a></li>       
        <li><a href="/quanly/monhoc/thong-ke">Thống kê</a></li>
        
            
        </ul>
        </div><!--end #left -->
        
        <div id="right"> 
                    <h3><?php echo $data_title; ?></h3>
                    <div class='box'>
                    <form>        
                        <table class="info"> 
                            <tr><td>Mã môn học</td><td>       <input    name='mamh'   id='mamh'   type='text' title='Mã môn học gồm 5 kí tự'/></td></tr>          
                            <tr><td>Tên môn học</td><td>      <input  name='tenmh'  id='tenmh'  type='text'/></td></tr>
                            <tr><td>Số tín chỉ</td><td>       <input  name='sotc'  id='sotc'  type='text' title="Số tín chỉ=lý thuyết + thực hành"/></td></tr>
                            <tr><td>Tín chỉ lý thuyết</td><td><input  name='tclt'  id='tclt'  type='text' title="Số tín chỉ=lý thuyết + thực hành"/></td></tr>
                            <tr><td>Tín chỉ thực hành</td><td><input  name='tcth'  id='tcth'  type='text' disabled="disabled" title="tự động tính" /></td></tr>             
                            <tr><td>Loại môn</td>
                                <td>                                
                                <select id="loai">
                                    <?php
                                        if($loai=="DC") echo'<option value="DC">Đại Cương</option>';
                                        else if($loai=="CN") echo'<option value="CN">Chuyên Nghành</option>';
                                        else
                                        {
                                            echo '<option value="DC">Đại Cương</option>
                                                  <option value="CN">Chuyên Nghành</option>';
                                        }
                                    ?>
                                    
                                </select>
                                </td>
                            </tr>
                            <tr><td>Kiến thức môn học</td><td><textarea  name="ktmh" id="ktmh" cols="10" rows="10" title="Kiến thức tổng quát về môn học"></textarea></td></tr>
                        </table><!--end .info -->
                             
                        <table class='error'>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        </table>  
                    </form>
                    </div><!--end  a .box -->
                    
                    <div id="message">
                    <img alt="ok" src="<?php echo static_url() ?>/images/ok.png"/><span> Tạo sinh viên thành công</span>
                    
                    </div><!--end message -->
                    
                    <div id="action">
                        <h4 title="Phát hiện lỗi"><img src="<?php echo static_url(); ?>/images/error.png" />Phát hiện lỗi trong quá trình kiểm tra dữ liệu.Thao tác chỉ thành công khi không còn lỗi</h4>
                        <img id="create" title="Lưu" src="<?php echo static_url(); ?>/images/accept.png" />
                        <img id="process" title="Đang kiểm tra" src="<?php echo static_url(); ?>/images/process.gif" />
                    </div><!--end #action -->                   
                
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