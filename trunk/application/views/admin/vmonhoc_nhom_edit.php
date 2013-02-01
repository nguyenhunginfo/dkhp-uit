<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/monhoc_nhom_edit.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery-scrolltofixed.js"></script>    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jdrapdrop.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jmonhoc_nhom_edit.js"></script>        
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
        <li><a href="/quanly/monhoc">Danh sách môn học</a>
        <?php
            $num_tatca=$this->mmonhoc->get_num_rows("","tatca");            
            echo "<ul>";
            
            echo "<li id='tatca'  ><a href='/quanly/monhoc'>Tất cả(".$num_tatca.")</a> </li>";
            foreach($loai_monhoc_result as $row)
            {
                $maloai=$row->MaLoai;
                $tenloai=$row->TenLoai;
                $num=$this->mmonhoc->get_num_rows("",$maloai);
                
                echo "<li id='$maloai'><a href='/quanly/monhoc/$maloai'>$tenloai($num)</a></li>";
            }
            echo "</ul>";
        ?>        
        </li>
        <li><a class="active" href="/quanly/monhoc/mon-hoc-nhom" title="Danh sách nhóm môn học">Nhóm môn học</a>
        <li><a href="/quanly/monhoc/tuong-duong" title="Môn học tương đương(thay thế)">MH tương đương</a>
        <li><a href="/quanly/monhoc/them-mon-hoc">Thêm môn học</a></li>
        <li><a href="/quanly/monhoc/nhap-du-lieu">Nhập dữ liệu</a></li>        
        <li><a href="/quanly/monhoc/thong-ke">Thống kê</a></li>
        
            
        </ul>
        </div><!--end #left -->
        
        <div id="right">
            <div id="tool">
                <p id="data_title">&#187;&#187;<?php echo $data_title; ?></p>
            </div><!--end #tool -->
                
            <div id="content">
            
                <table id="thongtin">
                <tr>
                <td id='manhom' class='<?php echo $manhom; ?>' >Mã Nhóm:<b> <?php echo $manhom; ?></b></td>
                <td id='tennhom' class='<?php echo $tennhom; ?>' >Tên Nhóm:<b> <?php echo $tennhom; ?></b></td>                
                <td id='somon'>Số môn: <b><?php echo "<span>".$somon."</span>"; ?></b></td>                
                <td id='action'><button id="luu" title="Lưu kết quả hiện tại">Lưu</button><button id="xoa" title="Xóa nhóm môn học này">Xóa</button></td>
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
                        
                         foreach($danhsach_result as $row)//danh sach mon hoc
                         {
                            $id=$row->ID;
                            $mamh=$row->MaMH;
                            $maloai=$row->MaLoai;
                            
                            echo "<tr id='$id' class='$maloai' >";
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
                            if(!(($maloai=="CN"&&$kieumh=="NHOM")||($maloai=="TC"&&$kieumh=="NHOM")))
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