<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/sinhvien.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jsinhvien.js"></script>        
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
        <h3>Quản lý sinh viên</h3>
        <ul>
            <li><a class="active" href="/quanly/sinhvien">Danh sách sinh viên</a>
            
            <?php
            echo "<ul>";
            if($khoa=="tatca") echo "<li id='tatca'  class='active'>Tất cả</li>";
            else               echo "<li id='tatca'  >Tất cả</li>";
            
            foreach($khoa_result as $row)
            {                
                if(strcasecmp($row->MaKhoa,$khoa)==0) echo "<li id='".$row->MaKhoa."' class='active' title='".$row->TenKhoa."'> Khoa ".$row->MaKhoa."</li>"; 
                else echo "<li id='".$row->MaKhoa."' title='".$row->TenKhoa."'> Khoa ".$row->MaKhoa."</li>"; 
            }
                echo "</ul>";
            ?>
             
            </li>
            <li><a href="#">Thêm sinh viên</a></li>
            <li><a href="#">Tìm sinh viên</a></li>
            <li><a href="#">Thống kê</a></li>
            <li><a href="#">Ghi chú</a></li>
            <li><button>show popup</button></li>
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
                </select>
                <div id="action">
                    <img id="del" title="Xóa"src="<?php echo static_url(); ?>/images/bin.png" alt="bin" />
                    <img id="edit" title="Sửa đổi" src="<?php echo static_url(); ?>/images/edit.png" alt="reload" />
                </div>
                <div id="search" title="Tìm kiếm">
                    
                    <input  type="text" title="Nhập MSSV hoặc họ tên" />
                </div>
                <select id="k" title="Chọn khóa học">          
                <option value="0">Tất cả</option>  
                <option value="1">K1 (2006)</option>
                <option value="2">K2 (2007)</option>
                <option value="3">K3 (2008)</option>
                <option value="4">K4 (2009)</option>
                <option value="5">K5 (2010)</option>
                <option value="6">K6 (2011)</option>
                <option value="7">K7 (2012)</option>
                <option value="8">K8 (2013)</option>
                </select>
            </div><!--end #tool -->
            
            <div id="content">
                
                <table id="tempt">
                <tr>
                    <th id="textbox"><input id="all" type="checkbox" title="Chọn tất cả/ hủy tất cả"/></th>
                    <th id="mssv">MSSV</th>
                    <th id="tensv">Tên SV</th>
                    <th id="khoa">Khoa</th>
                    <th id="lop">Lớp</th>
                    <th id="k">Khóa</th>
                    <th id="ngaysinh">Ngày Sinh</th>
                    <th id="noisinh">Nơi Sinh</th>
                    <th id="cmnd">CMND</th>
                </tr>            
                </table><!--end tempt -->
                
                <div id="change_data">
                <?php //pagination                    
                    $start=0;
                    $limit=15;                    
                    $page=ceil($num_rows/$limit);//tổng số trang
        			$current=($start/$limit)+1;                    
        			if($page>1)
                    {                        
            			echo "<div id='pagination'>";
                            echo "<ul>";
                                if($current!=1)echo "<li style='visibility:visible' id='prev'>Prev</li>";
                                else echo "<li style='visibility:hidden' id='prev'>Prev</li>";
            					for($i=1;$i<=$page;$i++)
            					{
            						$id=($i-1)*$limit;//chỉ số start
            						if($i==$current) echo "<li class='active' id='$id'>$i</li>";
            						else echo "<li id='$id'>$i</li>";            						
            					}				
            					 if($current!=$page) echo "<li style='visibility:visible' id='next'>Next</li>"	;
                                 else echo "<li style='visibility:hidden' id='next'>Next</li>"	;			
            				echo "</ul>";
            			echo "</div>";	
                    }	
                    
                    ?>
                    <div id="scroll">
                        <table id="table_data">
                        <tr id="first">
                            <th id="textbox"></th>
                            <th id="mssv"></th>
                            <th id="tensv"></th>
                            <th id="khoa"></th>
                            <th id="lop"></th>
                            <th id="k"></th>
                            <th id="ngaysinh"></th>
                            <th id="noisinh"></th>
                            <th id="cmnd"></th>
                        </tr>
                        <?php
                         foreach($sinhvien_result as $row)
                         {
                            echo "<tr>";
                            echo "<td><input id='".$row->MaSV."' class='checkbox_row' type='checkbox' /></td>";
                            echo "<td class='masv' title='Xem chi tiết'>".$row->MaSV."</td>";
                            echo "<td class='tensv' style='text-align:left' >".$row->TenSV."</td>";
                            echo "<td class='khoa'>".$row->Khoa."</td>";
                            echo "<td class='lop'>".$row->Lop."</td>";
                            echo "<td class='k'>".$row->K."</td>";
                            echo "<td class='ngaysinh'>".$row->NgaySinh."</td>";
                            echo "<td class='noisinh'>".$row->NoiSinh."</td>";
                            echo "<td class='cmnd'>".$row->CMND."</td>";
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