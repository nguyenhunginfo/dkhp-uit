<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/sinhvien_statistic.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jsinhvien_statistic.js"></script>        
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
                <li><a href="/quanly/sinhvien/them-sinh-vien" class="active"  >Thêm sinh viên</a></li>
                <li><a href="/quanly/sinhvien/nhap-du-lieu">Nhập dữ liệu</a></li> 
                
                <li><a href="/quanly/sinhvien/thongke">Thống kê</a></li>
                
                
            </ul>
            </div><!--end #left -->
            
            <div id="right"> 
                    <h3><?php echo $data_title; ?> </h3>
                    <div id="box">                    
                    
                        
                        <div class="data_box" id="khoa">
                        <p>Tổng số sinh viên: <a href="/quanly/sinhvien" title="xem danh sách chi tiết"><?php echo $SL["total"]; ?></a></p>
                            <ul>                        
                                   <?php
                                    
                                    foreach($khoa_result as $row)
                                    {
                                        echo "<li><span title='Mở rộng/thu nhỏ'>Khoa ".$row->TenKhoa."</span>: 
                                                  <a href='/quanly/sinhvien/".$row->MaKhoa."' title='xem danh sách chi tiết'> ".$SL[$row->MaKhoa][0]."</a>";
                                            echo "<ul>";
                                            foreach($K_result as $k_row)
                                            {                                        
                                                echo "<li>".$k_row->TenK.": ".$SL[$row->MaKhoa][$k_row->MaK]."</li>";
                                            }
                                            echo "</ul>";
                                        echo "</li>";
                                       
                                    }
                                    
                                    ?>
                                
                                       
                            </ul>
                        </div><!--end data_box #khoa -->
                        
                    </div><!--end #box -->
            </div><!--end #right -->
        </div><!--end #data -->
        </div><!--#page =#main_menu + #data -->
    
    
    <!--div #main_menu -->    
    <?php include_once("vmain_menu.php"); ?>
    <!--END div #main_menu --> 
       
    
    
    <!-- #footer -->
    <?php include_once("vfooter.php"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   



</body>
</html>