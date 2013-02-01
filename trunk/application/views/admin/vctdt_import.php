<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/ctdt_import.css" />
     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jctdt_import.js"></script>        
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
                <li><a  href="/quanly/chuong-trinh-dao-tao/them" title="Thêm Chương Trình Đào Tạo Mới">Thêm CTĐT</a></li>
                <li><a class='active' href="/quanly/chuong-trinh-dao-tao/nhap-du-lieu">Nhập dữ liệu</a></li>
                <li><a href="/quanly/chuong-trinh-dao-tao/thongke">Thống kê</a></li>
                
                
            </ul>
            </div><!--end #left -->
            
            <div id="right"> 
                <form method="post" action="/quanly/chuong-trinh-dao-tao/nhap-du-lieu" enctype="multipart/form-data">
                   <h3><?php echo $data_title; ?></h3>
                    <div class='box'>                    
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
                                            if($K_row->MaK==$k)echo "<option selected='selected' title='".$K_row->TenK."'  value='".$K_row->MaK."'>".$K_row->TenK."</option>";
                                            else echo "<option title='".$K_row->TenK."'  value='".$K_row->MaK."'>".$K_row->TenK."</option>";
                                                   
                                         }
                                echo     "</select>
                                        </td></tr>";                 
                            
                                    
                            ?>
                            <tr><td>Chọn tập tin</td>
                                <td><input type="file" id="file_upload" name="file_upload" title="Chọn tập tin cần nhập dữ liệu(.CSV,.XLS,.XLSX)"/></td>                                 
                            </tr>
                        </table><!--end .info -->
                            
                        <table class='error'>
                            <tr><td><?php echo form_error("import_type","<span title='Thông báo lỗi'>","</span>") ?></td></tr>
                            <tr><td><?php echo form_error("file_upload","<span title='Thông báo lỗi'>","</span>") ?></td></tr>
                        </table> 
                    
                    </div><!--end  a .box -->
                    
                    <div id="data_checking">
                    
                    </div><!--end #data_checking-->
                    
                    <div id="action">                                                 
                        <img id="create" title="OK" src="<?php echo static_url(); ?>/images/accept.png" />                        
                    </div><!--end #action -->                   
                </form><!--end main form -->    
            </div><!--end #right -->
        </div><!--end #data -->
    </div><!--#page =#main_menu + #data -->
    
    <!-- #footer -->
    <?php $this->load->view("admin/vfooter"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   </body>
</html>