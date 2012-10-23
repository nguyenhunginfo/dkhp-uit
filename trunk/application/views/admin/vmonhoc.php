<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/monhoc.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jmonhoc.js"></script>        
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
        <h3>Quản lý môn học</h3>
        <ul>
        <li><a class="active" href="/quanly/monhoc">Danh sách môn học</a>
        <?php
            echo "<ul>";
            if($loai=="tatca") echo "<li id='tatca'  class='active'>Tất cả</li>";
            else               echo "<li id='tatca'  >Tất cả</li>";
            
            if($loai=="DC") echo "<li id='DC'  class='active'>Đại Cương</li>";
            else               echo "<li id='DC'  >Đại Cương</li>";
            
            if($loai=="CN") echo "<li id='CN'  class='active'>Chuyên Nghành</li>";
            else               echo "<li id='CN'  >Chuyên Nghành</li>";
            echo "</ul>";
        ?>        
        </li>
        <li><a href="/quanly/monhoc/them-mon-hoc">Thêm môn học</a></li>        
        <li><a href="/quanly/monhoc/thongke">Thống kê</a></li>
        
            
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
                    
                </div>
                <div id="search" title="Tìm kiếm">
                    <form action="post" action="">
                    <input  type="text" title="Nhập mã môn học hoặc tên môn học" />
                    <input id="submit" type="image" title="tìm kiếm" src="<?php echo static_url(); ?>/images/search_icon.png"/>
                    </form>
                </div>
                
            </div><!--end #tool -->
            
            <div id="content">
                
                <table id="tempt">
                <tr>
                    <th id="textbox"><input id="all" type="checkbox" title="Chọn tất cả/ hủy tất cả"/></th>
                    <th id="mamh">Mã Môn Học</th>
                    <th id="tenmh">Tên Môn Học</th>
                    <th id="sotc">Số TC</th>
                    <th id="tclt">TC Lý Thuyết</th>
                    <th id="tcth">TC Thực Hành</th>
                    <th id="loai">Loại Môn</th>
                  
                </tr>            
                </table><!--end tempt -->
                
                <div id="message">
                <img alt="ok" src="<?php echo static_url() ?>/images/ok.png"/>                
                </div>
                
                <div id="change_data">
                <?php //pagination                    
                                         
            			echo "<div id='pagination'>";
                        echo $pagination;
            			echo "</div>";	
                    	
                    
                    ?>
                    <div id="scroll">
                        <table id="table_data">
                        <tr id="first">
                            <td class="checkbox"></td>
                            <td class="mamh">Mã Môn Học</td>
                            <td class="tenmh">Tên Môn Học</td>
                            <td class="sotc">Số TC</td>
                            <td class="tclt">TC Lý Thuyết</td>
                            <td class="tcth">TC Thực Hành</td>
                            <td class="loai">Loại Môn</td>
                            
                        </tr>
                        <?php
                         foreach($monhoc_result as $row)
                         {
                            echo "<tr>";
                            echo "<td class='checkbox'><input id='".$row->MaMH."' class='checkbox_row' type='checkbox' /></td>";
                            echo "<td class='mamh' title='Xem chi tiết'>".$row->MaMH."</td>";
                            echo "<td class='tenmh' style='text-align:left' >".$row->TenMH."</td>";
                            echo "<td class='sotc'>".$row->SoTC."</td>";
                            echo "<td class='tclt'>".$row->TCLT."</td>";
                            echo "<td class='tcth'>".$row->TCTH."</td>";
                            if($row->Loai=="DC" )echo "<td class='loai'>Đại Cương</td>";
                            else  echo "<td class='loai'>Chuyên Nghành</td>";
                           
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