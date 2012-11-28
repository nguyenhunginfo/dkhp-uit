<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/lop_add.css" />
     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jlop_add.js"></script>        
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
            <h3>Quản lý lớp</h3>
            <ul>
                <?php
                $num_lt=$this->mlop->get_num_rows("","lt");
                $num_th=$this->mlop->get_num_rows("","th");
                $num_denghi=$this->mlop->get_num_rows("","denghi");
                $num_all=$num_lt+$num_th;
                echo "<li><a href='/quanly/lop'>Lớp đã mở(".$num_all.")</a>";
                echo "<ul>";                       
                
                echo "<li id='lt'  ><a href='/quanly/lop/ly-thuyet'>Lý thuyết(".$num_lt.")</a></li>";
                echo "<li id='th'  ><a href='/quanly/lop/thuc-hanh'>Thực hành(".$num_th.")</a></li>";
                echo "</ul>";
                ?>
                 
                </li>
                
                <li><a href="/quanly/lop/lop-de-nghi">Lớp đề nghị<?php echo "(".$num_denghi.")"; ?></a></li>
                <li><a class='active' href="/quanly/lop/them-lop">Thêm lớp</a></li>
                <li><a href="/quanly/lop/nhap-du-lieu">Nhập dữ liệu</a></li>
                <li><a href="/quanly/lop/lich-giang-day">Lịch giảng dạy</a></li>
                <li><a href="/quanly/lop/thong-ke">Thống kê</a></li>
                
                
            </ul>
            </div><!--end #left -->
            <div id="right"> 
                    <h3><?php echo $data_title; ?> </h3>
                    <div class='box'>
                    <form>        
                        <table class='info'>
                        <tr><td>Loại Lớp</td>
                            <td>
                            <select name="loai" id="loai">
                            <?php
                            if($loai=="lt")
                            {
                              echo "<option value='lt' selected='selected'>Lý thuyết</option>";
                              echo "<option value='th'>Thực hành</option>";  
                            }
                            else
                            {
                               echo "<option value='lt' >Lý thuyết</option>";
                              echo "<option value='th' selected='selected'>Thực hành</option>";  
                            } 
                             ?>                        
                            </select></td>
                         </tr>
                       
                        <tr><td>Mã Lớp</td>
                        <td><input  name='malop'  id='malop'  type='text' title='Mã Lớp' /></td>
                        </tr>
                        <?php 
                        $monhoc_result=$this->mlop->get_monhoc($loai);
                        echo "<tr><td>Tên Môn Học</td>
                                  <td>
                                  <select name='mamh' id='mamh' >";
                                      foreach($monhoc_result as $monhoc_row)
                                      {                                        
                                        echo "<option value='".$monhoc_row->MaMH."'>".$monhoc_row->TenMH."</option>";                                       
                                      }
                        echo     "</select>
                                  </td>
                              </tr>";
                        //==============================================================================================
                        $giaovien_result=$this->mlop->get_giaovien();
                        echo "<tr><td>Tên Giáo Viên</td>
                                  <td>
                                  <select name='magv' id='magv' >";
                                      echo "<option value=''>Chọn giáo viên</option>";
                                      foreach($giaovien_result as $giaovien_row)
                                      {                                        
                                        echo "<option value='".$giaovien_row->MaGV."'>".$giaovien_row->TenGV."</option>";                                       
                                      }
                        echo     "</select>
                                  </td>
                              </tr>";
                        //==============================================================================================                        
                       $thu_result=$this->mlop->get_thu();
                        echo "<tr><td>Thứ</td>
                                  <td>
                                  <select name='thu' id='thu'>";
                                      foreach($thu_result as $thu_row)
                                      {                                        
                                        echo "<option value='".$thu_row->TenThu."'>".$thu_row->TenThu."</option>";                                       
                                      }
                        echo     "</select>
                                  </td>
                              </tr>";
                              
                        //==============================================================================================
                        
                        echo "<tr><td>Ca</td>
                                  <td>
                                  <select name='ca' id='ca'>";
                                      echo "<option value=''>Chọn ca</option>";                                      
                        echo     "</select>
                                  </td>
                              </tr>";
                        //==============================================================================================
                        
                        echo "<tr><td>Phòng</td>
                                  <td>
                                  <select name='phong' id='phong'>";
                                      echo "<option value=''>Chọn phòng</option>";                                      
                        echo     "</select>
                                  </td>
                              </tr>";
                        ?>
                        <tr><td>Min</td>
                            <td><input  name='min'  id='min'  type='text' value="30" title='Số lượng tối thiểu'/></td>
                        </tr>
                        <tr><td>Max</td>
                            <td><input  name='max'  id='max'  type='text' value="100" title='Số lượng tối đa' /></td>
                        </tr>               
                                       
                        </table>
                             
                        <table class='error'>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
                        <tr><td><span title="Bắt buộc">*</span></td></tr>
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