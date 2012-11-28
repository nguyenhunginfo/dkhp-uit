<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/lop_request.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jlop_request.js"></script>        
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
            
            <li><a class='active' href="/quanly/lop/lop-de-nghi">Lớp đề nghị<?php echo "(".$num_denghi.")"; ?></a></li>
            <li><a href="/quanly/lop/them-lop">Thêm lớp</a></li>
            <li><a href="/quanly/lop/nhap-du-lieu">Nhập dữ liệu</a></li>
            <li><a href="/quanly/lop/lich-giang-day">Lịch giảng dạy</a></li>
            <li><a href="/quanly/lop/thong-ke">Thống kê</a></li>
            
            
        </ul>
        </div><!--end #left -->
        
        <div id="right">
            <div id="tool">
                <p id="data_title">&#187;&#187;<?php echo $data_title; ?></p>
            </div><!--end #tool -->
            
            <div id="content">                
                <table id="tempt">
                <tr>
                    <th id="stt">STT</th>
                    <th id="mamh">Mã môn học</th>                                               
                    <th id="tenmh">Tên Môn học</th>
                    <th id="slht">Số lượng đề nghị</th>
                    <th id="thaotac">Thao tác</th>                            
                </tr>     
                </table><!--end tempt -->
                <div id="change_data">
                <?php //pagination                    
                                         
            			echo "<div id='pagination' class='".$total_rows."'>";
                        echo $pagination;
            			echo "</div>";	
                    	
                    
                    ?>
                    <div id="scroll">
                        <table id="table_data">
                        <tr id="first">
                            <th id="stt"></th>
                            <th id="mamh"></th>                                               
                            <th id="tenmh"></th>
                            <th id="slht"></th>
                            <th id="thaotac"></th>
                        </tr>
                        <?php
                        $i=1;
                         foreach($lop_result as $row)
                         {
                            $mamh=$row->MaMH;
                            $tenmh=$row->TenMH;
                            echo "<tr>";
                            echo "<td class='stt'>".$i++."</td>";                            
                            echo "<td class='mamh' title='Xem chi tiết'>".$row->MaMH."</td>";
                            echo "<td class='tenmh' style='text-align:left' >".$row->TenMH."</td>";                            
                            echo "<td class='slht' style='text-align:center' >15</td>";
                            echo "<td class='thaotac' style='text-align:center' ><button id='$mamh' title='$tenmh'>Mở lớp này</button></td>";
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
            <p id="ptitle">Thao tác mở lớp</p>
            <img id="pclose" title="Đóng" src="<?php echo static_url(); ?>/images/close.png" />        
        </div>
        <div id="pdata">
        
        </div>
        <div id="pfooter">
        <h4 title="Phát hiện lỗi"><img src="<?php echo static_url(); ?>/images/error.png" />Phát hiện lỗi trong quá trình kiểm tra dữ liệu.Thao tác chỉ thành công khi không còn lỗi</h4>
        <img id="save" title="Mở lớp này" src="<?php echo static_url(); ?>/images/accept.png" />
        <img id="process" title="Đang kiểm tra" src="<?php echo static_url(); ?>/images/process.gif" />
        
        
        </div>
    </div>
    

</body>
</html>