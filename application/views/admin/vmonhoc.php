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
            $num_tatca=$this->mmonhoc->get_num_rows("","tatca");            
            echo "<ul>";
            if($loai_monhoc=="tatca") echo "<li id='tatca'  class='active'><a href='/quanly/monhoc'>Tất cả(".$num_tatca.")</a></li>";
            else               echo "<li id='tatca'  ><a href='/quanly/monhoc'>Tất cả(".$num_tatca.")</a> </li>";
            foreach($loai_monhoc_result as $row)
            {
                $maloai=$row->MaLoai;
                $tenloai=$row->TenLoai;
                $num=$this->mmonhoc->get_num_rows("",$maloai);
                if($maloai==$loai_monhoc) echo "<li id='$maloai'  class='active'><a href='/quanly/monhoc/$maloai'>$tenloai($num)</a></li>";
                else echo "<li id='$maloai'><a href='/quanly/monhoc/$maloai'>$tenloai($num)</a></li>";
            }
            echo "</ul>";
        ?>        
        </li>
        <li><a href="/quanly/monhoc/mon-hoc-nhom" title="Danh sách nhóm môn học">Nhóm môn học</a>
        <li><a href="/quanly/monhoc/tuong-duong" title="Môn học tương đương(thay thế)">MH tương đương</a>
        <li><a href="/quanly/monhoc/them-mon-hoc">Thêm môn học</a></li>
        <li><a href="/quanly/monhoc/nhap-du-lieu">Nhập dữ liệu</a></li>        
        <li><a href="/quanly/monhoc/thong-ke">Thống kê</a></li>
        
            
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
                    <a href="/quanly/monhoc/them-mon-hoc/<?php echo $loai_monhoc ?>"><img title="Thêm môn học" src="<?php echo static_url(); ?>/images/mh_add.png" alt="export" /></a>
                    <a href="/quanly/monhoc/nhap-du-lieu"><img title="Nhập dữ liệu từ tập tin" src="<?php echo static_url(); ?>/images/import.png" alt="export" /></a>
                    <img id="export" title="Xuất dữ liệu" src="<?php echo static_url(); ?>/images/export.png" alt="export" />
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
                    <th id="checkbox"><input id="all" type="checkbox" title="Chọn tất cả/ hủy tất cả"/></th>
                    <th id="mamh">Mã Môn Học</th>
                    <th id="tenmh">Tên Môn Học</th>
                    <th id="sotc">Số TC</th>
                    <th id="tclt">Lý Thuyết</th>
                    <th id="tcth">Thực Hành</th>
                    <th id="loai">Loại Môn</th>
                    <th id="kieumh">Kiểu Môn Học</th>
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
                            <td class="mamh">Mã Môn Học</td>
                            <td class="tenmh">Tên Môn Học</td>
                            <td class="sotc">Số TC</td>
                            <td class="tclt">Lý Thuyết</td>
                            <td class="tcth">Thực Hành</td>
                            <td class="loai">Loại Môn</td>
                            <td class="kieumh">Kiểu môn học</td>
                            
                        </tr>
                        <?php
                         foreach($monhoc_result as $row)
                         {
                            $ID=$row->ID;
                            
                            $mamh=$row->MaMH;
                            $tenmh=$row->TenMH;
                            
                            $maloai=$row->MaLoai; 
                            $tenloai=$row->TenLoai;
                                     
                            $kieumh=$row->KieuMH;
                                   
                               
                            echo "<tr>";
                            echo "<td class='checkbox'><input id='$ID' class='checkbox_row' type='checkbox' /></td>";
                            echo "<td class='mamh' id='$ID' title='Xem chi tiết'>$mamh</td>";
                            echo "<td class='tenmh' style='text-align:left' >$tenmh</td>";
                            echo "<td class='sotc'>".$row->SoTC."</td>";
                            echo "<td class='tclt'>".$row->TCLT."</td>";
                            echo "<td class='tcth'>".$row->TCTH."</td>";  
                                            
                            echo "<td class='loai' id='$maloai'>$tenloai</td>";
                            
                            if($kieumh=="DON")
                            {
                              $ten_kieumh="Đơn";
                              echo "<td class='kieumh' id='$kieumh'>$ten_kieumh</td>";  
                            } 
                            else
                            {
                              $ten_kieumh="Nhóm";
                              echo "<td class='kieumh' id='$kieumh'><a href='/quanly/monhoc/mon-hoc-nhom/$mamh'>$ten_kieumh</a></td>";  
                            }  
                                                       
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
    <!--popup div -->
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
        <form method="post" action="/monhoc/xuatdl">
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