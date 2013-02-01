<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/ctdt.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jctdt.js"></script>        
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
        <h3>Quản lý chương trình đào tạo</h3>
        <ul>
            <li><a class="active" href="/quanly/chuong-trinh-dao-tao" title="Danh sách chương trình đào tạo theo khoa">Danh sách</a>
            
            <?php
            echo "<ul>";                       
            foreach($khoa_result as $row)
            {   
                $makhoa=$row->MaKhoa;
                $tenkhoa=$row->TenKhoa;
                if(strcasecmp($makhoa,$khoa)==0) 
                echo "<li class='active' id='$makhoa' title='$tenkhoa'><a href='/quanly/chuong-trinh-dao-tao/$makhoa'> Khoa $makhoa</a></li>";  
                else echo "<li id='$makhoa' title='$tenkhoa'><a href='/quanly/chuong-trinh-dao-tao/$makhoa'> Khoa $makhoa</a></li>";  
            }
                echo "</ul>";
            ?>             
            </li>
            
             
            </li>
            <li><a href="/quanly/chuong-trinh-dao-tao/them" title="Thêm Chương Trình Đào Tạo Mới">Thêm CTĐT</a></li>
            <li><a href="/quanly/chuong-trinh-dao-tao/nhap-du-lieu">Nhập dữ liệu</a></li>
            <li><a href="/quanly/chuong-trinh-dao-tao/thongke">Thống kê</a></li>
            
            
        </ul>
        </div><!--end #left -->
        
        <div id="right">
            <div id="tool">
                <p id="data_title">&#187;&#187;<?php echo $data_title; ?></p>                
                               
                
                <div id="action">
                    <img id="del" title="Xóa" src="<?php echo static_url(); ?>/images/bin.png" alt="bin" />
                    <a href="/quanly/chuong-trinh-dao-tao/them/<?php echo $khoa ?>"><img title="Thêm chương trình đào tạo mới" src="<?php echo static_url(); ?>/images/mh_add.png" alt="export" /></a>
                    <a href="/quanly/chuong-trinh-dao-tao/nhap-du-lieu/<?php echo $khoa ?>"><img title="Nhập dữ liệu từ tập tin" src="<?php echo static_url(); ?>/images/import.png" alt="export" /></a>
                    <img id="export" title="Xuất dữ liệu" src="<?php echo static_url(); ?>/images/export.png" alt="export" />
                </div>
                <div id="search" title="Tìm kiếm">
                    <form action="post" action="">
                    <input  type="text" title="Nhập MSSV hoặc họ tên" />
                    <input id="submit" type="image" title="tìm kiếm" src="<?php echo static_url(); ?>/images/search_icon.png"/>
                    </form>
                </div>
                
                
            </div><!--end #tool -->
            
            <div id="content">
                <div id="message">
                <img alt="ok" src="<?php echo static_url() ?>/images/ok.png"/>                
                </div>
                
                <div id="change_data">
                        <table id="table_data">
                        <tr id="first">
                            <th id="checkbox"><input id="all" type="checkbox" title="Chọn tất cả/ hủy tất cả"/></th>                            
                            <th id="k">Khóa</th>
                            <th id="sohk">Số Học Kỳ</th>
                            <th id="somon">Số Môn Học</th>                                                
                            <th id="sotc">Số Tín Chỉ</th>
                            <th id="socn">Số Chuyên Nghành</th>
                            <th id="chitiet"></th>                                                          
                        </tr>
                        <?php
                        
                         foreach($ctdt_result as $row)
                         {
                            $k=$row->MaK;
                            $tenk=$row->TenK;
                            $sohk=$row->SoHK;
                            $somon=$this->mctdt->get_somon($khoa,$k);
                            $sotc=$this->mctdt->get_sotc($khoa,$k);
                            //$socn=0;
                            $socn=$this->mctdt->get_socn($khoa,$k);
                            echo "<td class='checkbox'><input id='$k' class='checkbox_row' type='checkbox' /></td>";
                            echo "<td class='k' title='$tenk'>$k</td>";
                            echo "<td class='sohk'>$sohk</td>";
                            echo "<td class='somon'  >$somon</td>";                            
                            echo "<td class='sotc'>$sotc</td>";
                            echo "<td class='socn'>$socn</td>";
                            echo "<td class='chitiet'><a href='/quanly/chuong-trinh-dao-tao/$khoa/$k'>Xem chi tiết</a></td>";                                                       
                            echo "</tr>";
                         }
                         ?>                  
                        </table>                    
                        
                </div><!--end #change_data -->
            </div><!--end #content -->
        </div><!--end #right -->        
    </div><!--end #data -->
    </div><!--#page -->
    
    <!-- #footer -->
    <?php include_once("vfooter.php"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   

</body>
</html>