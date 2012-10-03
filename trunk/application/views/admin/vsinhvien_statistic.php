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
    <?php include_once("vmain_menu.php"); ?>
    <!--END div #main_menu --> 
       
    <div id="data">
        <div id="box">
            <h3>Thống kê tổng quát sinh viên</h3>
            <h4>
                Tổng số sinh viên: <a href="/quanly/sinhvien" title="xem danh sách chi tiết"><?php echo $SL["total"]; ?></a></h4>
                <div class="data_box" id="khoa">
                    <h4 class="expand"><span title="Mở rộng">Số lượng sinh viên theo khoa(đv:sinh viên)</span></h4>
                        
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
                
                <div class="data_box" id="k">
                    <h4 class="expand"><span title="Mở rộng">Số lượng sinh viên theo khoa</span></h4>
                        
                    <ul>                        
                           <?php
                            
                            foreach($khoa_result as $row)
                            {
                                echo "<li><span>Khoa ".$row->TenKhoa."</span>: <a href='/quanly/sinhvien/".$row->MaKhoa."'> ".$SL[$row->MaKhoa][0]."</a>";
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
                </div><!--end data_box #k -->
                
                
            </div><!--end #box -->
    </div><!--end #data -->
    </div><!--#page -->
    
    <!-- #footer -->
    <?php include_once("vfooter.php"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   



</body>
</html>