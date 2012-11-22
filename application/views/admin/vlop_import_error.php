<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/lop_import.css" />     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" /> 
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jlop_import.js"></script> 
               
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
                $num_all=$num_lt+$num_th;
                echo "<li><a href='/quanly/lop'>Lớp đã mở(".$num_all.")</a>";
                echo "<ul>";                                       
                echo "<li id='lt'  ><a href='/quanly/lop/ly-thuyet'>Lý thuyết(".$num_lt.")</a></li>";
                echo "<li id='th'  ><a href='/quanly/lop/thuc-hanh'>Thực hành(".$num_th.")</a></li>";
                echo "</ul>";
                ?>
                 
                </li>
                
                <li><a href="/quanly/lop/lop-de-nghi">Lớp đề nghị</a></li>
                <li><a href="/quanly/lop/them-lop">Thêm lớp</a></li>
                <li><a href="/quanly/lop/nhap-du-lieu" class='active'>Nhập dữ liệu</a></li>
                <li><a href="/quanly/lop/lich-giang-day">Lịch giảng dạy</a></li>
                <li><a href="/quanly/lop/thongke">Thống kê</a></li>
            </ul>
            </div><!--end #left -->
            <div id="right"> 
                <form method="post" action="/quanly/lop/nhap-du-lieu/<?php echo $loai_active; ?>" enctype="multipart/form-data">
                   <h3><?php echo $right_title; ?></h3>
                    <div class='box'>                    
                        <table class="info">
                        <tr><td>Loại lớp</td> 
                        <?php
                                echo "<td>";
                                echo "<select name='loai' id='loai'>";
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
                                echo "</select>";
                                echo "</td></tr>";
                            
                             
                            
                            
                            
                            if($import_type=="insert")
                            {
                                
                                echo "<tr><td>Kiểu nhập dữ liệu</td>
                                <td id='import_type'><input name='import_type' type='radio'  value='new'
                                                     title='Kiểu này sẽ xóa toàn bộ dữ liệu cũ và thêm dữ liệu mới từ tập tin'
                                                     />Tạo mới
                                                    <input name='import_type' type='radio' value='insert' checked='checked'
                                                    title='Kiểu bổ sung sẽ thêm dữ liệu từ tập tin vào hệ thống(Chú ý có thể lỗi dữ liệu)'/>Bổ sung
                                </td>
                                </tr> ";
                            }
                            else//new
                            {   
                                
                                echo "<tr><td>Kiểu nhập dữ liệu</td>
                                <td id='import_type'><input name='import_type' type='radio' value='new' checked='checked' 
                                                     title='Kiểu này sẽ xóa toàn bộ dữ liệu cũ và thêm dữ liệu mới từ tập tin'
                                                     />Tạo mới
                                                    <input name='import_type' type='radio' value='insert' 
                                                    title='Kiểu bổ sung sẽ thêm dữ liệu từ tập tin vào hệ thống(Chú ý có thể lỗi dữ liệu)'/>Bổ sung
                                </td>
                                </tr> ";
                            } 
                        
                        ?>       
                        <tr><td>Chọn tập tin</td>
                            <td><input type="file" id="file_upload" name="file_upload" title="Chọn tập tin cần nhập dữ liệu(.CSV,.XLS,.XLSX)"/></td>                                 
                        </tr>
                        </table><!--end .info -->
                            
                        <table class='error'>
                            <tr><td><?php echo form_error("loai","<span title='Thông báo lỗi'>","</span>") ?></td></tr>                            
                            <tr><td><?php echo form_error("import_type","<span title='Thông báo lỗi'>","</span>") ?></td></tr>
                            <tr><td><?php echo form_error("file_upload","<span title='Thông báo lỗi'>","</span>") ?></td></tr>
                        </table> 
                    
                    </div><!--end  a .box -->
                    
                    <div id="data_checking">
                    <?php
                    
                    if($num_errors>0)
                    {                        
                    echo "
                        <table>
                            <tr id='first'>
                            <th id='im_error'></th>
                            <th id='malop'>Mã Lớp</th>
                            <th id='mamh'>Tên Môn Học</th>                    
                            <th id='magv'>Tên Giáo Viên</th>
                            <th id='thu'>Thứ</th>
                            <th id='ca'>Ca</th>
                            <th id='phong'>Phòng</th>
                            <th id='min'>Min</th>
                            <th id='max'>Max</th>
                            <th id='slht'>SLHT</th>
                            </tr>";
                              
                            
                            foreach($error_data as $row)
                            {
                                $error_type=$row["error"];
                                if($row["error"]!=0)
                                {
                                    echo "<tr class='error'>";
                                    switch($error_type)
                                    {
                                        case 11:
                                        {
                                            echo "<td class='im_error'><img title='Dữ liệu không hợp lệ(Tên GV)' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 12:
                                        {
                                            echo "<td class='im_error'><img title='Dữ liệu không hợp lệ(TênMH)' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 13:
                                        {
                                            echo "<td class='im_error'><img title='Dữ liệu không hợp lệ(Thứ)' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 14:
                                        {
                                            echo "<td class='im_error'><img title='Dữ liệu không hợp lệ(Ca)' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 15:
                                        {
                                            echo "<td class='im_error'><img title='Dữ liệu không hợp lệ(Phòng)' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 16:
                                        {
                                            echo "<td class='im_error'><img title='Kiểu dữ liệu không hợp lệ(Min)' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 17:
                                        {
                                            echo "<td class='im_error'><img title='Kiểu dữ liệu không hợp lệ(Max)' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 18:
                                        {
                                            echo "<td class='im_error'><img title='Kiểu dữ liệu không hợp lệ(SLHT)' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 2:
                                        {
                                            echo "<td class='im_error'><img title='Mã lớp đã tồn tại hoặc trùng' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 3:
                                        {
                                           echo "<td class='im_error'><img title='Trùng giờ giáo viên' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        case 4:
                                        {
                                           echo "<td class='im_error'><img title='Trùng phòng giảng dạy' src='".static_url()."/images/delete.png' /></td>";
                                            break;
                                        }
                                        
                                    }//end switch
                                    
                                }
                                else
                                {
                                    echo "<tr>";
                                    echo "<td class='im_error'></td>";
                                }
                                echo "<td>".$row["MaLop"]."</td>";
                                echo "<td style='text-align:left' >".$row["TenMH"]."</td>";                            
                                echo "<td style='text-align:left'>".$row["TenGV"]."</td>";
                                echo "<td>".$row["Thu"]."</td>";
                                echo "<td>".$row["Ca"]."</td>";
                                echo "<td>".$row["Phong"]."</td>";
                                echo "<td>".$row["Min"]."</td>";
                                echo "<td>".$row["Max"]."</td>";
                                echo "<td>".$row["SLHT"]."</td>";
                                echo "</tr>";
                                
                            }//end foreach
                                                                                
                        echo "</table>";
                        }//other error
                        else echo $error_array;
                        ?>
                    </div><!--end #data_checking-->
                    
                    <div id="action">
                        <?php
                            if($num_errors>0) echo "<p>Phát hiện ".$num_errors." lỗi trong quá trình kiểm tra dữ liệu.Quá trình nhập dữ liệu thất bại</p>";
                            
                         ?>                                                
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