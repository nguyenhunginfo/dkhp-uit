<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/ctdt_edit.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery-scrolltofixed.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jdrapdrop.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jctdt_edit.js"></script>        
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
            <li><a href="/quanly/chuong-trinh-dao-tao" title="Danh sách chương trình đào tạo theo khoa">Danh sách</a>
            
            <?php
            echo "<ul>";                       
            foreach($khoa_result as $row)
            {                   
                 
                echo "<li id='".$row->MaKhoa."' title='".$row->TenKhoa."'><a href='/quanly/chuong-trinh-dao-tao/".$row->MaKhoa."'> Khoa ".$row->MaKhoa."</a></li>"; 
            }
                echo "</ul>";
            ?>             
            </li>            
            <li><a href="/quanly/chuong-trinh-dao-tao/them" title="Thêm Chương Trình Đào Tạo Mới">Thêm CTĐT</a></li>
            <li><a href="/quanly/chuong-trinh-dao-tao/nhap-du-lieu">Nhập dữ liệu</a></li>
            <li><a href="/quanly/chuong-trinh-dao-tao/thongke">Thống kê</a></li>
            
            
        </ul>
        </div><!--end #left -->
        
        <div id="right">
            <div id="tool">
                <p id="data_title">&#187;&#187;<?php echo $data_title; ?></p>
            </div><!--end #tool -->
                
            <div id="content">
                
                <table id="thongtin">
                <tr>
                <td id='tenkhoa' class='<?php echo $khoa; ?>' >Khoa: <?php echo $tenkhoa."(".$khoa.")"; ?></td>
                <td id='k' class='<?php echo $k; ?>' >Khóa: <?php echo $k; ?></td>
                <td id='hk' class='<?php echo $hk; ?>' >Học kỳ: <?php echo $hk; ?></td>
                <td id='somon'>Số môn: <?php echo "<span>".$somon."</span>"; ?></td>
                <td id='sotc' >Số tín chỉ: <?php echo "<span>".$sotc."</span>"; ?></td>
                <td id='action'><button id="luu" title="Lưu kết quả hiện tại">Lưu</button><button id="xoa" title="Xóa học kỳ này">Xóa</button></td>
                </tr>
                </table><!--end #thongtin -->
                
                <div id="chuongtrinh">
                <table>                
                <tr id="first">                            
                    <th id="action"></th>
                    <th id="mamh">Mã Môn Học</th>
                    <th id="tenmh" style="text-align: left;">Tên Môn Học</th>                    
                    <th id="sotc">Số TC</th>
                    <th id="tclt">TCLT</th>
                    <th id="tcth">TCTH</th>
                    <th id="loai">Loại</th>                             
                </tr>
                        <?php
                        $flag=0;
                         foreach($ctdt_result as $row)
                         {
                            $id=$row->ID;
                            $mamh=$row->MaMH;
                            $maloai=$row->MaLoai;
                            echo "<tr id='$id' class='$maloai'>";
                            echo "<td id='$id' class='action'><button title='Xóa môn học này'>Xóa</button></td>";
                            echo "<td>$mamh</td>";
                            echo "<td style='text-align:left'>".$row->TenMH."</td>";
                            echo "<td class='sotc'>".$row->SoTC."</td>";                            
                            echo "<td>".$row->TCLT."</td>";
                            echo "<td>".$row->TCTH."</td>";   
                            echo "<td>".$row->TenLoai."</td>";                         
                            echo "</tr>";
                         }
                         ?> 
                   
                </table>
                </div><!--end #chuong trinh-->
               
                <div id="danhsachmonhoc">
                <table id="fixed">
                <tr>
                    <th id="caption" colspan="2" >&#187;&#187;Danh sách môn học</th>
                    <th id="button" colspan="5">
                    <?php
                    echo "<button id='all' disabled='disabled' title='Tất cả môn học'>Tất cả</button>";
                    foreach($loai_monhoc_result as $loai_row)
                    {
                        $tenloai=$loai_row->TenLoai;
                        $maloai=$loai_row->MaLoai;
                                              
                        echo "<button id='$maloai' title='Môn học $tenloai'>$tenloai</option>";
                        
                    } 
                    ?> 
                    </th>  
                </tr>
                <tr>                            
                    <th id="action"></th>
                    <th id="mamh">Mã Môn Học</th>
                    <th id="tenmh" style="text-align: left;">Tên Môn Học</th>                    
                    <th id="sotc">Số TC</th>
                    <th id="tclt">TCLT</th>
                    <th id="tcth">TCTH</th>
                    <th id="loai">Loại</th>                             
                </tr>
                </table><!--end fixed element -->
                
                <table id="main">                
                <tr id="first">                            
                    <th id="action"></th>
                    <th id="mamh"></th>
                    <th id="tenmh" ></th>                    
                    <th id="sotc"></th>
                    <th id="tclt"></th>
                    <th id="tcth"></th>
                    <th id="loai"></th>                            
                </tr>
                
                    <?php
                        $flag=0;
                         foreach($monhoc_result as $row)
                         {
                            $id=$row->ID;
                            $mamh=$row->MaMH;
                            $maloai=$row->MaLoai;
                            $kieumh=$row->KieuMH;
                            //NHUNG MON HOC DON CHUYEN NGANH VA TU CHON KHONG DUOC LIET KE
                            if(!(($maloai=="CN"&&$kieumh=="DON")||($maloai=="TC"&&$kieumh=="DON")))
                            {
                            echo "<tr id='$id' class='item $maloai'>";
                            echo "<td id='$id' class='action'><button title='Thêm môn học này'>Thêm</button></td>";
                            echo "<td>$mamh</td>";
                            echo "<td style='text-align:left'>".$row->TenMH."</td>";
                            echo "<td class='sotc'>".$row->SoTC."</td>";                            
                            echo "<td>".$row->TCLT."</td>";
                            echo "<td>".$row->TCTH."</td>";
                            echo "<td>".$row->TenLoai."</td>";                             
                            echo "</tr>";
                            }
                         }
                    ?>        
                
                </table>
                </div><!--end #danhsachmonhoc -->
                <div id="message">
                <img alt="ok" src="<?php echo static_url() ?>/images/ok.png"/>                
                </div>
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