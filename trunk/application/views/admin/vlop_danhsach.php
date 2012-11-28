<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/lop_danhsach.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jlop_danhsach.js"></script>        
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
            $num_all=$num_lt+$num_th;
            echo "<li><a class='active' href='/quanly/lop'>Lớp đã mở(".$num_all.")</a>";
            echo "<ul>";                       
            
            echo "<li id='lt'  >           <a href='/quanly/lop/ly-thuyet'>Lý thuyết(".$num_lt.")</a></li>";
            
            
            echo "<li id='th'  ><a href='/quanly/lop/thuc-hanh'>Thực hành(".$num_th.")</a></li>";
            echo "</ul>";
            ?>
             
            </li>
            
            <li><a href="/quanly/lop/lop-de-nghi">Lớp đề nghị</a></li>
            <li><a href="/quanly/lop/them-lop">Thêm lớp</a></li>
            <li><a href="/quanly/lop/nhap-du-lieu">Nhập dữ liệu</a></li>
            <li><a href="/quanly/lop/lich-giang-day">Lịch giảng dạy</a></li>
            <li><a href="/quanly/lop/thong-ke">Thống kê</a></li>
            
            
        </ul>
        </div><!--end #left -->
        
        <div id="right">
            <div id="tool">
                <p id="data_title">&#187;&#187;<?php echo $data_title; ?></p>
                <img id="export" title="Xuất danh sách lớp(Excel)" src="<?php echo static_url(); ?>/images/export.png" alt="export" />           
                <p id="total"><?php echo $total_rows; ?></p>                
            </div><!--end #tool -->
            
            <div id="content">
                
                <table id="tempt">
                <tr>
                    <th id="stt">STT</th>                    
                    <th id="masv">MSSV</th>
                    <th id="tensv" style='text-align:left'>Tên sinh viên</th>
                    <th id="giodk">Thời gian đăng ký</th>
                </tr>            
                </table><!--end tempt -->
                
                <div id="change_data">               
                    <div id="scroll">
                        <table id="table_data">
                        <tr id="first">
                            <th id="stt">STT</th>                    
                            <th id="masv">MSSV</th>
                            <th id="tensv" >Tên sinh viên</th>
                            <th id="giodk">Thời gian đăng ký</th>
                        </tr>
                        <?php
                         $i=1;
                         
                         foreach($danhsach_result as $row)
                         {
                            echo "<tr>";
                            echo "<td class='stt'>$i</td>";
                            echo "<td class='masv'>".$row->MaSV."</td>";
                            echo "<td class='tensv' style='text-align:left' >".$row->TenSV."</td>";
                            echo "<td class='giodk' style='text-align:center'>".$row->GioDK."</td>";                            
                            echo "</tr>";
                            $i++;
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

<!--=======POPUP========================================================================================================== -->
    
    <div class="overflow"></div>    
    <!--=======EXPORT POPUP============================================================================================== -->
    <div class="popup_detail" id="export">
        <form method="post" action="/lop/xuatdl">
            <div id="pheader">
                <p id="ptitle">Thao tác xuất dữ liệu</p>
                <img id="pclose" title="Đóng" src="<?php echo static_url(); ?>/images/close.png" />        
            </div>
            
            <div id="pdata">            
                    
               
            </div>
            <div id="pfooter">
            <h4 title="Phát hiện lỗi"><img src="<?php echo static_url(); ?>/images/error.png" />Phát hiện lỗi trong quá trình kiểm tra dữ liệu.Thao tác chỉ thành công khi không còn lỗi</h4>
            <input name="submit" type="image" src="<?php echo static_url(); ?>/images/accept.png" title="Đồng ý"/>
            
         </form>
        
        </div>
    </div><!-- end popup div -->

</body>
</html>