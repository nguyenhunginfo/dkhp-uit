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
                    $num_sinhvien=$this->msinhvien->get_num_rows("",$row->MaKhoa);
                    echo "<li id='".$row->MaKhoa."' title='".$row->TenKhoa."'><a href='/quanly/sinhvien/".$row->MaKhoa."'> Khoa ".$row->MaKhoa."(".$num_sinhvien.")</a></li>";
                }
                echo "</ul>";
                ?>            
                </li>
                <li><a href="/quanly/sinhvien/them-sinh-vien">Thêm sinh viên</a></li>
                <li><a href="/quanly/sinhvien/nhap-du-lieu" class="active">Nhập dữ liệu</a></li> 
                
                <li><a href="/quanly/sinhvien/thongke">Thống kê</a></li>
            </ul>
            </div><!--end #left -->
            <div id="right"> 
                <form method="post" action="/quanly/sinhvien/nhap-du-lieu/<?php echo $khoa_active; ?>" enctype="multipart/form-data">
                   <h3><?php echo $right_title; ?></h3>
                    <div class='box'>                    
                        <table class="info"> 
                            <?php
                                
                                
                                $khoa_result=$this->msinhvien->get_khoa();
                                if($khoa_active!="")
                                {
                                    
                                    echo "<tr><td>Khoa</td>
                                          <td>
                                          <select name='khoa' id='khoa' title='Chọn Khoa để áp dụng nhập dữ liệu cho Khoa này'>
                                          <option value='".$khoa_active."'>".$khoa_active."</option>
                                          </select>
                                          ";                                      
                                          
                                    echo "</select> </td></tr>";        
                                
                                }
                                else
                                {
                                    
                                    echo "<tr><td>Khoa</td>
                                          <td>
                                          <select name='khoa' id='khoa' title='Chọn Khoa để áp dụng nhập dữ liệu cho Khoa này'>";
                                          echo "<option value=''>Chọn khoa</option>";
                                          foreach($khoa_result as $khoa_row)
                                          { 
                                            echo "<option title='".$khoa_row->TenKhoa."'  value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                                                       
                                          }
                                   echo "</select> </td></tr>";       
                                }
                            ?>
                            <tr><td>Kiểu nhập dữ liệu</td>
                                <td id='import_type'><input name='import_type' type='radio'  value='new'
                                                         title='Kiểu này sẽ xóa toàn bộ dữ liệu cũ và thêm dữ liệu mới từ tập tin'
                                                         />Tạo mới
                                                    <input name='import_type' type='radio' value='insert' checked='checked'
                                                        title='Kiểu bổ sung sẽ thêm dữ liệu từ tập tin vào hệ thống(Chú ý có thể lỗi dữ liệu)'/>Bổ sung
                                </td>
                            </tr>
                            <tr><td>Chọn tập tin</td>
                                <td><input type="file" id="file_upload" name="file_upload" title="Chọn tập tin cần nhập dữ liệu(.CSV,.XLS,.XLSX)"/></td>                                 
                            </tr>
                        </table><!--end .info -->
                            
                        <table class='error'>
                            <tr><td><?php echo form_error("khoa","<span title='Thông báo lỗi'>","</span>") ?></td></tr>
                            
                            <tr><td><?php echo form_error("import_type","<span title='Thông báo lỗi'>","</span>") ?></td></tr>
                            <tr><td><?php echo form_error("file_upload","<span title='Thông báo lỗi'>","</span>") ?></td></tr>
                        </table> 
                    
                    </div><!--end  a .box -->
                    
                    <div id="data_checking">
                    
                    </div><!--end #data_checking-->
                    
                    <div id="action">                                                 
                        <img id="create" title="Lưu" src="<?php echo static_url(); ?>/images/accept.png" />                        
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