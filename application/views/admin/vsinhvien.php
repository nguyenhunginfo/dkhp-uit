<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/sinhvien.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jsinhvien.js"></script>        
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
        <h3>Quản lý sinh viên</h3>
        <ul>
            <li><a class="active" href="/quanly/sinhvien">Danh sách sinh viên</a>
            
            <?php
            echo "<ul>";                       
            foreach($khoa_result as $row)
            {                
                if(strcasecmp($row->MaKhoa,$khoa)==0) echo "<li id='".$row->MaKhoa."' class='active' title='".$row->TenKhoa."'><a href='/quanly/sinhvien/".$row->MaKhoa."'> Khoa ".$row->MaKhoa."</a></li>"; 
                else echo "<li id='".$row->MaKhoa."' title='".$row->TenKhoa."'><a href='/quanly/sinhvien/".$row->MaKhoa."'> Khoa ".$row->MaKhoa."</a></li>"; 
            }
                echo "</ul>";
            ?>
             
            </li>
            <li><a href="/quanly/sinhvien/them-sinh-vien">Thêm sinh viên</a></li>
            <li><a href="/quanly/sinhvien/nhap-du-lieu">Nhập dữ liệu</a></li> 
            <li><a href="/quanly/sinhvien/xuat-du-lieu">Xuất dữ liệu</a></li>             
            <li><a href="/quanly/sinhvien/thongke">Thống kê</a></li>
            
            
        </ul>
        </div><!--end #left -->
        
        <div id="right">
            <div id="tool">
                <p id="data_title">&#187;&#187;<?php echo $data_title; ?></p>                
                <select id='view_num' title="Số lượng hàng">
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="0">Tất cả</option>                    
                </select>
                <div id="action">
                    <img id="del" title="Xóa" src="<?php echo static_url(); ?>/images/bin.png" alt="bin" />
                    <img id="export" title="Xuất dữ liệu" src="<?php echo static_url(); ?>/images/outbox.png" alt="export" />
                    
                </div>
                <div id="search" title="Tìm kiếm">
                    <form action="post" action="">
                    <input  type="text" title="Nhập MSSV hoặc họ tên" />
                    <input id="submit" type="image" title="tìm kiếm" src="<?php echo static_url(); ?>/images/search_icon.png"/>
                    </form>
                </div>
                <select id="k" title="Chọn khóa học">          
                <option value="0">Tất cả</option>  
                <option value="1">K1 (2006)</option>
                <option value="2">K2 (2007)</option>
                <option value="3">K3 (2008)</option>
                <option value="4">K4 (2009)</option>
                <option value="5">K5 (2010)</option>
                <option value="6">K6 (2011)</option>
                <option value="7">K7 (2012)</option>
                <option value="8">K8 (2013)</option>
                </select>
            </div><!--end #tool -->
            
            <div id="content">
                
                <table id="tempt">
                <tr>
                    <th id="textbox"><input id="all" type="checkbox" title="Chọn tất cả/ hủy tất cả"/></th>
                    <th id="mssv">MSSV</th>
                    <th id="tensv">Tên SV</th>                    
                    <th id="lop">Lớp</th>
                    <th id="k">Khóa</th>
                    <th id="ngaysinh">Ngày Sinh</th>
                    <th id="noisinh">Nơi Sinh</th>
                    <th id="sdt">Số ĐT</th>
                    <th id="email">E-mail</th>
                </tr>            
                </table><!--end tempt -->
                
                <div id="message">
                <img alt="ok" src="<?php echo static_url() ?>/images/ok.png"/>                
                </div>
                
                <div id="change_data">
                <?php //pagination                    
                                         
            			echo "<div id='pagination' class='".$total_rows."'>";
                        echo $pagination;
            			echo "</div>";	
                    	
                    
                    ?>
                    <div id="scroll">
                        <table id="table_data">
                        <tr id="first">
                            <td class="checkbox"></td>
                            <td class="mssv">MSSV</td>
                            <td class="tensv">Tên SV</td>                            
                            <td class="lop">Lớp</td>
                            <td class="k">Khóa</td>
                            <td class="ngaysinh">Ngày Sinh</td>
                            <td class="noisinh">Nơi Sinh</td>
                            <td class="sdt">Số ĐT</td>
                            <td class="email">E-mail</td>
                        </tr>
                        <?php
                         foreach($sinhvien_result as $row)
                         {
                            echo "<tr id='$khoa'>";
                            echo "<td class='checkbox'><input id='".$row->MaSV."' class='checkbox_row' type='checkbox' /></td>";
                            echo "<td class='masv' title='Xem chi tiết'>".$row->MaSV."</td>";
                            echo "<td class='tensv' style='text-align:left' >".$row->TenSV."</td>";                            
                            echo "<td class='lop'>".$row->Lop."</td>";
                            echo "<td class='k'>".$row->K."</td>";
                            echo "<td class='ngaysinh'>".$row->NgaySinh."</td>";
                            echo "<td class='noisinh'>".$row->NoiSinh."</td>";
                            echo "<td class='sdt'>".$row->SDT."</td>";
                            echo "<td class='email'>".$row->email."</td>";
                            echo "</tr>";
                         }
                         ?>                  
                        </table>                    
                    </div><!-- end #scroll -->     
                </div><!--end #change_data -->
            </div><!--end #content -->
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