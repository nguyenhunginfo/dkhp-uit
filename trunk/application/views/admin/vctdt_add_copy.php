<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/ctdt_add_copy.css" />
     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jctdt_add_copy.js"></script>        
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
                <li id="new"><a href="/quanly/chuong-trinh-dao-tao/them">Tạo chương trình đào tạo mới</a></li>
                <li id="copy" class="deactive"><a href="#">Tạo chương trình đào tạo từ một chương trình đào tạo khác</a></li>
                </ul> 
                <div class='box'>                        
                        <table class="info">
                            <?php
                                echo "
                                      <tr>
                                      <td id='base' rowspan='2'></td>
                                      <td id='khoa'>Khoa</td>
                                      <td id='k'>
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
                                         foreach($k_empty_result as $K_row)
                                         {                                                    
                                            $maK=$K_row->MaK;
                                            $tenK=$K_row->TenK;
                                            if($maK==$k) echo "<option selected='selected'  value='$maK'>$tenK</option>";
                                            else echo "<option  value='$maK'>$tenK</option>";                                                   
                                         }
                                echo     "</select></td></tr>"; 
                            ?>                                        
                        </table><!--end .info -->
                        
                        <table class="source">
                            <?php
                                echo "
                                      
                                      <tr>
                                      <td id='base' rowspan='4'>Sao chép từ</td>
                                      <td id='khoa'>Khoa</td>
                                      <td id='k'>
                                      <select name='khoa' id='khoa'>";  
                                      $makhoa="";                                    
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
                                         $maK="";                                                  
                                         foreach($k_exist_result as $K_row)
                                         {                                                    
                                            $maK=$K_row->MaK;
                                            $tenK=$K_row->TenK;
                                            if($maK==$k) echo "<option selected='selected'  value='$maK'>$tenK</option>";
                                            else echo "<option  value='$maK'>$tenK</option>";
                                                   
                                         }
                                         
                                echo     "</select>        </td></tr>";
                                
                                $somon=$this->mctdt->get_somon($khoa,$k);
                                $sotc=$this->mctdt->get_sotc($khoa,$k);
                                echo "<tr><td>Số môn</td><td id='somon'>$somon</td></tr>";
                                echo "<tr><td>Số tín chỉ</td><td id='sotc'>$sotc</td></tr>";                 
                            
                            ?>                                        
                        </table><!--end .source -->
                    
                    </div><!--end  a .box -->
                    
                    
                    
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