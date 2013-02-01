<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/ctdt_add.css" />
     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jctdt_add.js"></script>        
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
            <h3>Quản lý chương trình đào tạo</h3>
            <ul>
                <li><a href="/quanly/chuong-trinh-dao-tao" title="Danh sách chương trình đào tạo theo khoa">Danh sách</a>
                
                <?php
                echo "<ul>";                       
                foreach($khoa_result as $row)
                {
                    echo "<li id='".$row->MaKhoa."' title='".$row->TenKhoa."'><a href='/quanly/chuong-trinh-dao-tao/".$row->MaKhoa."'> Khoa ".$row->MaKhoa."</a></li>"; 
                }
                echo "</ul>";
                ?>                 
                </li>
                
                <li><a href="/quanly/chuong-trinh-dao-tao" title="Danh sách chương trình đào tạo theo khoa">Phân chuyên nghành</a>
            
            <?php
            echo "<ul>";                       
            foreach($khoa_result as $row)
            { 
                $makhoa=$row->MaKhoa;
                $tenkhoa=$row->TenKhoa;
                 
                echo "<li id='$makhoa' title='$tenkhoa'><a href='/quanly/chuong-trinh-dao-tao/chuyen-nghanh/$makhoa'> Khoa $makhoa</a></li>"; 
            }
                echo "</ul>";
            ?>             
            </li>
            
                <li><a class='active' href="/quanly/chuong-trinh-dao-tao/them" title="Thêm Chương Trình Đào Tạo Mới">Thêm CTĐT</a></li>
                <li><a href="/quanly/chuong-trinh-dao-tao/nhap-du-lieu">Nhập dữ liệu</a></li>
                <li><a href="/quanly/chuong-trinh-dao-tao/thongke">Thống kê</a></li>
                
                
            </ul>
            </div><!--end #left -->
            <div id="right"> 
                    <h3><?php echo $data_title; ?> </h3>
                    <ul>
                    <li id="new" class="deactive"><a href="/quanly/chuong-trinh-dao-tao/them">Tạo chương trình đào tạo mới</a></li>
                    <li id="copy" ><a href="/quanly/chuong-trinh-dao-tao/saochep">Tạo chương trình đào tạo từ một chương trình đào tạo khác</a></li>
                    </ul> 
                    <div class='box'>
                    <form>        
                        <table class="info">
                            <?php
                                echo "<tr><td>Khoa</td>
                                      <td>
                                      <select name='khoa' id='khoa'>";                                      
                                      foreach($khoa_result as $khoa_row)
                                      {  
                                        $makhoa=$khoa_row->MaKhoa;
                                        $tenkhoa=$khoa_row->TenKhoa;
                                        if($khoa==$makhoa)echo "<option title='$tenkhoa'  value='$makhoa' selected='selected'>$tenkhoa</option>";
                                        else echo "<option title='$tenkhoa'  value='$makhoa'>$tenkhoa</option>";
                                                   
                                      }
                                 "</select> </td></tr>";
                           
                                echo "<tr><td>Khóa</td>
                                         <td>
                                         <select name='k' id='k'>";                                                  
                                         foreach($k_result as $K_row)
                                         {                                                    
                                            $maK=$K_row->MaK;
                                            $tenK=$K_row->TenK;
                                            if($maK==$k) echo "<option selected='selected'  value='$maK'>$tenK</option>";
                                            echo "<option  value='$maK'>$tenK</option>";
                                                   
                                         }
                                echo     "</select>
                                        </td></tr>";                 
                            
                            
                            
                           
                                              
                                    
                            ?>         
                            <tr><td>Số Học Kỳ</td><td><input   name='sohk'  id='sohk'  type='text' title='1,2,3,4..8,9' /></td></tr>
                            </td></tr>               
                        </table><!--end .info -->
                             
                        <table class='error'>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
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