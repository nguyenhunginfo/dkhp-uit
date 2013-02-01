<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/monhoc_import.css" />
     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jmonhoc_import.js"></script>        
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
            <h3>Quản lý môn học</h3>
            <ul>
            <li><a  href="/quanly/monhoc">Danh sách môn học</a>
            <?php
                $num_tatca=$this->mmonhoc->get_num_rows("","tatca");            
                echo "<ul>";
               
               echo "<li id='tatca'  ><a href='/quanly/monhoc'>Tất cả(".$num_tatca.")</a> </li>";
                foreach($loai_monhoc_result as $row)
                {
                    $maloai=$row->MaLoai;
                    $tenloai=$row->TenLoai;
                    $num=$this->mmonhoc->get_num_rows("",$maloai);
                    
                    echo "<li id='$maloai'><a href='/quanly/monhoc/$maloai'>$tenloai($num)</a></li>";
                }
                echo "</ul>";
            ?>        
            </li>
            <li><a href="/quanly/monhoc/mon-hoc-nhom" title="Danh sách nhóm môn học">Nhóm môn học</a>
            <li><a href="/quanly/monhoc/tuong-duong" title="Môn học tương đương(thay thế)">MH tương đương</a>
            <li><a href="/quanly/monhoc/them-mon-hoc">Thêm môn học</a></li>
            <li><a class="active" href="/quanly/monhoc/nhap-du-lieu">Nhập dữ liệu</a></li>        
            <li><a href="/quanly/monhoc/thong-ke">Thống kê</a></li>          
                
            </ul>
            </div><!--end #left -->
            
            
            <div id="right"> 
                <form method="post" action="/quanly/monhoc/nhap-du-lieu" enctype="multipart/form-data">
                   <h3>Thao tác nhập dữ liệu môn học <img src="<?php echo static_url(); ?>/images/delete.png" /></h3>
                    <div class='box'>                    
                        <table class="info">                            
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
                                <th id='mamh'>Mã Môn Học</th>
                                <th id='tenmh'>Tên Môn Học</th>                    
                                <th id='sotc'>Số Tín Chỉ</th>
                                <th id='tclt'>Tín Chỉ LT</th>
                                <th id='tcth'>Tín Chỉ TH</th>
                                <th id='loai'>Loại Môn Học</th>
                                <th id='kieumh'>Kiểu Môn Học</th>
                                </tr>";
                                  
                                $arr_unique=array();
                                foreach($error_data as $row)
                                {
                                    if($row["KieuMH"]!="NHOM")
                                    {
                                        if(Monhoc::valid_mamh($row["MaMH"],$arr_unique,$import_type)==false)
                                        {
                                            echo "<tr class='error'>";
                                            echo "<td class='im_error'><img title='Mã môn học đã tồn tại hoặc trùng' src='".static_url()."/images/delete.png' /></td>";
                                        }
                                        else
                                        {
                                            echo "<tr>";
                                            echo "<td class='im_error'></td>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<tr>";
                                        echo "<td class='im_error'></td>";
                                    }
                                                                        
                                    echo "<td>".$row["MaMH"]."</td>";
                                    echo "<td style='text-align:left' >".$row["TenMH"]."</td>";                            
                                    echo "<td>".$row["SoTC"]."</td>";
                                    echo "<td>".$row["TCLT"]."</td>";
                                    echo "<td>".$row["TCTH"]."</td>";
                                    
                                    $maloai=$row["Loai"];
                                    $tenloai="";
                                    switch($maloai)
                                    {
                                        case "DC":$tenloai="Đại Cương";break;
                                        case "CN":$tenloai="Chuyên Nghành";break;
                                        case "CSN":$tenloai="Cơ Sở Nghành";break;
                                        case "TC":$tenloai="Tự Chọn";break;
                                        
                                    }
                                    echo "<td>$tenloai</td>";
                                    
                                    $kieumh=$row["KieuMH"];
                                    $ten_kieumh="";
                                    switch($kieumh)
                                    {
                                        case "DON":$ten_kieumh="Đơn";break;
                                        case "NHOM":$ten_kieumh="Nhóm";break;
                                                                               
                                    }
                                    
                                    echo "<td>$ten_kieumh</td>";                                     
                                    echo "</tr>";
                                    $arr_unique[]=$row["MaMH"];
                                }
                                                                                    
                            echo "</table>";
                            }
                            else echo "<span style='color:red'>".$error_array."</span>";
                        ?>
                    </div><!--end #data_checking-->
                    
                    <div id="action">     
                       <?php if($num_errors>0) echo "<p>Phát hiện ".$num_errors." lỗi trong quá trình kiểm tra dữ liệu.Quá trình nhập dữ liệu thất bại</p>";?>
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