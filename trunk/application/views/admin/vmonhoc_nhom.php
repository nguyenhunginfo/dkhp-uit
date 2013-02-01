<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/monhoc_nhom.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jmonhoc_nhom.js"></script>        
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
                
                
                <div id="action">   
                    <img id="del" title="Xóa" src="<?php echo static_url(); ?>/images/bin.png" alt="bin" />                
                    <a href="/quanly/monhoc/mon-hoc-nhom/them"><img title="Thêm nhóm môn học mới" src="<?php echo static_url(); ?>/images/mh_add.png" alt="export" /></a>
                    <a href="/quanly/monhoc/mon-hoc-nhom/nhap-du-lieu"><img title="Nhập dữ liệu từ tập tin" src="<?php echo static_url(); ?>/images/import.png" alt="export" /></a>
                    <img id="export" title="Xuất dữ liệu" src="<?php echo static_url(); ?>/images/export.png" alt="export" />
                    
                </div>
            </div><!--end #tool -->
            
            <div id="content">
                <div id="message">
                <img alt="ok" src="<?php echo static_url() ?>/images/ok.png"/>                
                </div>
                
                <div id="change_data">
                        <table id="table_data">
                        <tr>
                            <th id="checkbox"><input id="all" type="checkbox" title="Chọn tất cả/ hủy tất cả"/></th>                                  
                            <th id="nhom">Nhóm</th>
                            <th id="mamh">Mã Môn Học</th>
                            <th id="tenmh" style="text-align: left;">Tên Môn Học</th>                    
                            <th id="sotc">Số TC</th>
                            <th id="tclt">TCLT</th>
                            <th id="tcth">TCTH</th>
                            <th id="loai">Loại</th>                             
                        </tr>
                        <?php
                        $flag="";
                        //echo "<pre>";
//                        print_r($monhoc_result);
//                        echo "</pre>";
                        $i=1;
                         foreach($danhsach_monhoc_result as $row)
                         {
                            $manhom=$row->MaNhom;
                            $tennhom=$row->TenNhom;
                            
                            if($i%2==0) $cla="chan";
                            else $cla="le";
                            $monhoc_result=$this->mmonhoc->get_monhoc_nhom($manhom);
                            $somon=count($monhoc_result);
                            if($monhoc_result!=NULL)
                            {
                                foreach($monhoc_result as $monhoc_row)
                                {
                                    echo "<tr class='$cla'>";
                                     
                                    if($flag!=$manhom)
                                    {
                                        
                                        $flag=$manhom;
                                        echo "<td class='checkbox' rowspan='$somon'><input id='$manhom' class='checkbox_row' type='checkbox' /></td>";
                                              
                                        echo "<td class='nhom' rowspan='$somon'>
                                              $manhom <br /><span>($tennhom)</span> <br />
                                              <span class='somon'>Số Môn: $somon</span> <br />
                                                                                    
                                              <a href='/quanly/monhoc/mon-hoc-nhom/dieu-chinh/$manhom' title='Sửa đổi nhóm này'>sửa đổi</a>
                                              </td>";
                                    }
                                    
                                    echo "<td class='mamh'>".$monhoc_row->MaMH."</td>";
                                    echo "<td class='tenmh' style='text-align:left'>".$monhoc_row->TenMH."</td>";
                                    echo "<td class='sotc'  >".$monhoc_row->SoTC."</td>";                            
                                    echo "<td class='tclt'>".$monhoc_row->TCLT."</td>";
                                    echo "<td class='tcth'>".$monhoc_row->TCTH."</td>";
                                    echo "<td class='loai'>".$monhoc_row->TenLoai."</td>";                            
                                    echo "</tr>";
                                }
                            }
                            else
                            {
                                echo "<tr class='empty $cla'>
                                    <td class='checkbox' rowspan='$somon'><input id='$manhom' class='checkbox_row' type='checkbox' /></td>
                                    <td >
                                    $manhom <br /><span>($tennhom)</span> <br />
                                    <span class='somon'>Số Môn: $somon</span> <br />
                                                                                    
                                    <a href='/quanly/monhoc/mon-hoc-nhom/dieu-chinh/$manhom' title='Sửa đổi nhóm này'>sửa đổi</a>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>                                         
                                    </tr>";
                            }
                            $i++;
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

<?php include_once("vpopup.php"); ?>

</body>
</html>