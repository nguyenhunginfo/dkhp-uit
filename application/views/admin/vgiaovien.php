<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/giaovien.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jgiaovien.js"></script>        
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
            <li><a class="active" href="/quanly/giaovien">Danh sách giáo viên<?php echo "(".$total_rows.")"; ?></a></li>
            <li><a href="/quanly/giaovien/them-giao-vien">Thêm giáo viên</a></li>
            <li><a href="/quanly/giaovien/lich-giang-day">Lịch giảng dạy</a></li>
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
                <div id="action">
                    <img id="del" title="Xóa" src="<?php echo static_url(); ?>/images/bin.png" alt="bin" />
                    <a href="/quanly/giaovien/them-giao-vien"><img title="Thêm giáo viên" src="<?php echo static_url(); ?>/images/sv_add.png" alt="export" /></a>
                    <a href="/quanly/giaovien/nhap-du-lieu"><img title="Nhập dữ liệu từ tập tin" src="<?php echo static_url(); ?>/images/import.png" alt="export" /></a>
                    <img id="export" title="Xuất dữ liệu" src="<?php echo static_url(); ?>/images/export.png" alt="export" />
                    
                </div>
                <div id="search" title="Tìm kiếm">
                    <form action="post" action="">
                    <input  type="text" id="field" title="Nhập Mã số giáo viên hoặc họ tên" />
                    <input id="submit" type="image" title="tìm kiếm" src="<?php echo static_url(); ?>/images/search_icon.png"/>
                    </form>
                </div>
                
            </div><!--end #tool -->
            
            <div id="content">
                
                <table id="tempt">
                <tr>
                    <th id="checkbox"><input id="all" type="checkbox" title="Chọn tất cả/ hủy tất cả"/></th>
                    <th id="magv">Mã Giáo Viên</th>
                    <th id="tengv" style='text-align:left;'>Tên Giáo Viên</th>
                    <th id="ngaysinh">Ngày Sinh</th>
                    <th id="noisinh">Nơi Sinh</th>
                    <th id="sodt">Số Điện Thoại</th>
                    <th id="email">E-Mail</th>
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
                            <td class="magv"></td>
                            <td class="tengv"></td>
                             <td class="ngaysinh"></td>
                            <td class="noisinh"></td> 
                             <td class="sodt"></td>
                            <td class="email"></td>                           
                            
                        </tr>
                        <?php
                         foreach($giaovien_result as $row)
                         {
                            echo "<tr>";
                            echo "<td class='checkbox'><input id='".$row->MaGV."' class='checkbox_row' type='checkbox' /></td>";
                            echo "<td class='magv' title='Xem chi tiết'>".$row->MaGV."</td>";
                            echo "<td class='tengv' style='text-align:left' >".$row->TenGV."</td>";
                            echo "<td class='ngaysinh'>".$row->NgaySinh."</td>";
                            echo "<td class='noisinh' style='text-align:left' >".$row->NoiSinh."</td>";
                            echo "<td class='sodt' >".$row->SoDT."</td>";
                            echo "<td class='email' style='text-align:left' >".$row->email."</td>";
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

<!--=======POPUP========================================================================================================== -->
    
    <div class="overflow"></div>
    <!--=======VIEW POPUP============================================================================================== -->
    <div class="popup_detail" id="view">
        <div id="pheader">
            <p id="ptitle">This is popup title here</p>
            <img id="pclose" title="Đóng" src="<?php echo static_url(); ?>/images/close.png" />        
        </div>
        <div id="pdata">
        
        </div>
        <div id="pfooter">
        <h4 title="Phát hiện lỗi"><img src="<?php echo static_url(); ?>/images/error.png" />Phát hiện lỗi trong quá trình kiểm tra dữ liệu.Thao tác chỉ thành công khi không còn lỗi</h4>
        <img id="save" title="Lưu" src="<?php echo static_url(); ?>/images/accept.png" />
        <img id="process" title="Đang kiểm tra" src="<?php echo static_url(); ?>/images/process.gif" />
        </div>
    </div>
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