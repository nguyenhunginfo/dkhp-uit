<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/lop_statistic.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
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
            <li><a href="/quanly/lop/them-lop">Thêm lớp</a></li>
            <li><a href="/quanly/lop/nhap-du-lieu">Nhập dữ liệu</a></li>
            <li><a href="/quanly/lop/lich-giang-day">Lịch giảng dạy</a></li>
            <li><a class='active'  href="/quanly/lop/thong-ke">Thống kê</a></li>
            
            
        </ul>
        </div><!--end #left -->
        
        <div id="right"> 

                    <h3><?php echo $data_title; ?></h3>
                    <div class='box'>
                        
                        <table>
                            <tr id="first"><th class="total">Tổng số môn đã mở</th><th class="num"><?php echo $num_all; ?></th></tr>
                            <tr><td>Số lớp lý thuyết</td><td><a href="/quanly/lop/ly-thuyet" title="Xem danh sách"><?php echo $num_lt; ?></a></td></tr>
                            <tr><td>Số lớp thực hành</td><td><a href="/quanly/lop/thuc-hanh" title="Xem danh sách"><?php echo $num_th; ?></a></td></tr>
                            <tr><td>Số lớp đề nghị</td><td><a href="/quanly/lop/de-nghi" title="Xem danh sách"><?php echo $num_th; ?></a></td></tr>
                        </table><!--end table1 -->
                        <table>
                            <tr id="first"><th colspan="3">Tổng số môn đã mở</th><th><?php echo $total_mh; ?></th></tr>
                            <tr><th class="stt">STT</th><th class="mamh">Mã môn học</th><th class="tenmh">Tên môn học</th><th class="">Số lớp đã mở</th></tr>
                            <?php
                            $i=0;
                            foreach($danhsach_mh as $row)
                            {
                                $i++;
                                $mamh=$row->MaMH;
                                $tenmh=$row->TenMH;
                                $num_lop=$this->mlop->num_lop_mh($mamh);
                                echo "<tr>";
                                echo "<td>$i</td><td>$mamh</td><td>$tenmh</td><td>$num_lop</td>";
                                echo "</tr>";
                            }
                             ?>
                        </table><!--end thong ke mon hoc -->
                        
                        <table>
                            <tr id="first"><th colspan="3">Tổng số giáo viên</th><th><?php echo $total_gv; ?></th></tr>
                            <tr><th class="stt">STT</th><th class="magv">Mã giáo viên</th><th class="tengv">Tên giáo viên</th><th>Số lớp giảng dạy</th></tr>
                            <?php
                            $i=0;
                            foreach($danhsach_gv as $row)
                            {
                                $i++;
                                $magv=$row->MaGV;
                                $tengv=$row->TenGV;
                                $num_lop=$this->mlop->num_lop_gv($magv);
                                echo "<tr>";
                                echo "<td>$i</td><td>$magv</td><td>$tengv</td><td>$num_lop</td>";
                                echo "</tr>";
                            }
                             ?>
                        </table><!--end thong ke mon hoc -->
                   
                    </div><!--end  a .box -->
                
        </div><!--end #right --> 
    </div><!--end #data -->
    </div><!--#page -->
    
    <!-- #footer -->
    <?php include_once("vfooter.php"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   



</body>
</html>