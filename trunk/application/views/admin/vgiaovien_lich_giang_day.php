<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/giaovien_lich_giang_day.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jgiaovien_lich_giang_day.js"></script>        
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
        <h3>Quản lý giáo viên</h3>
        <ul>
            <li><a href="/quanly/giaovien">Danh sách giáo viên<?php echo "(".$total_rows.")"; ?></a></li>
            <li><a href="/quanly/giaovien/them-giao-vien">Thêm giáo viên</a></li>
            <li><a class="active" href="/quanly/giaovien/lich-giang-day">Lịch giảng dạy</a></li>
            <li><a href="/quanly/giaovien/nhap-du-lieu">Nhập dữ liệu</a></li>
            <li><a href="/quanly/giaovien/thongke">Thống kê</a></li>
            
            
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
                <div id="search" title="Tìm kiếm">
                    <form action="post" action="">
                    <input  type="text" title="Nhập Mã số giáo viên hoặc họ tên" />
                    <input id="submit" type="image" title="tìm kiếm" src="<?php echo static_url(); ?>/images/search_icon.png"/>
                    </form>
                </div>
                
            </div><!--end #tool -->
            
            <div id="content">
                
                <table id="tempt">
                <tr>
                    <th id="stt">STT</th>
                    <th id="magv">Mã Giáo Viên</th>
                    <th id="tengv" style='text-align:left;'>Tên Giáo Viên</th>
                    <th id="solop">Số lớp giảng dạy</th>                    
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
                            <td class="stt"></td>
                            <td class="magv"></td>
                            <td class="tengv"></td>
                            <td class="solop"></td>
                                                       
                            
                        </tr>
                        <?php
                        $i=1;
                         foreach($giaovien_result as $row)
                         {
                            $magv=$row->MaGV;
                            $tengv=$row->TenGV;
                            $solop=$this->mgiaovien->get_solop($magv);
                            echo "<tr>";
                            echo "<td class='stt'>$i</td>";
                            echo "<td class='magv' >$magv</td>";
                            echo "<td class='tengv' style='text-align:left' >$tengv</td>";
                            echo "<td class='solop' title='Xem thời khóa biểu'><a href='/quanly/giaovien/thoi-khoa-bieu/$magv'>$solop</a></td>";
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

<?php include_once("vpopup.php"); ?>

</body>
</html>