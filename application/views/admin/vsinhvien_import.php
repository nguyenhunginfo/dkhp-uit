<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/sinhvien_import.css" />
     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jsinhvien_import.js"></script>        
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
            <h3>Quản lý sinh viên</h3>
            <ul>
                <li><a href="/quanly/sinhvien">Danh sách sinh viên</a>
                
                <?php
                echo "<ul>";
                foreach($khoa_result as $row)
                {    
                    echo "<li id='".$row->MaKhoa."' title='".$row->TenKhoa."'><a href='/quanly/sinhvien/".$row->MaKhoa."'> Khoa ".$row->MaKhoa."</a></li>"; 
                }
                echo "</ul>";
                ?>
                 
                </li>
                <li><a href="/quanly/sinhvien/them-sinh-vien">Thêm sinh viên</a></li>
                <li><a href="/quanly/sinhvien/nhap-du-lieu" class="active">Nhập dữ liệu</a></li> 
                <li><a href="/quanly/sinhvien/xuat-du-lieu">Xuất dữ liệu</a></li>   
                <li><a href="/quanly/sinhvien/thongke">Thống kê</a></li>
                
                
            </ul>
            </div><!--end #left -->
            <div id="right"> 
                    <h3>Thao tác nhập dữ liệu từ tập tin</h3>
                    <div class='box'>
                    <form>        
                        <table class="info"> 
                        <tr><td>Chọn tập tin</td><td><input type="file" name="file"/></td></tr>
                        
                        <?php
                            
                            $khoa_result=$this->msinhvien->get_khoa();    
                            echo "<tr><td>Khoa</td>
                                      <td>
                                      <select name='khoa' id='khoa'>";
                                      echo "<option value=''>Chọn khoa</option>";
                                      foreach($khoa_result as $khoa_row)
                                      {                   
                                         echo "<option title='".$khoa_row->TenKhoa."'  value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                                                   
                                      }
                            echo "</select> </td></tr>";
                            $K_result=$this->msinhvien->get_K();
                                    echo "<tr><td>Khóa</td>
                                              <td>
                                                  <select name='k' id='k'>"; 
                                                  echo "<option value=0>Tất cả</option>" ;                                                
                                                  foreach($K_result as $K_row)
                                                  {
                                                    
                                                    echo "<option title='".$K_row->TenK."'  value='".$K_row->MaK."'>".$K_row->TenK."</option>";
                                                   
                                                  }
                                    echo          "</select>
                                              </td></tr>";                
                                                                
                        ?>         
                                      
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