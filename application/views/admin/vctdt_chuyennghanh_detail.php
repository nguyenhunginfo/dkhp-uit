<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/ctdt_detail.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jctdt_detail.js"></script>        
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
                
                if(strcasecmp($row->MaKhoa,$khoa)==0) echo "<li id='".$row->MaKhoa."' class='active' title='".$row->TenKhoa."'><a href='/quanly/chuong-trinh-dao-tao/".$row->MaKhoa."'> Khoa ".$row->MaKhoa."</a></li>"; 
                else echo "<li id='".$row->MaKhoa."' title='".$row->TenKhoa."'><a href='/quanly/chuong-trinh-dao-tao/".$row->MaKhoa."'> Khoa ".$row->MaKhoa."</a></li>"; 
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
                <table id="thongtin">
                <tr>
                    <td id="k">
                    Khóa: <select id="k" title="Chọn khóa học">
                    <?php
                    
                    foreach($K_result as $K_row)
                    {
                        $tenK=$K_row->TenK;
                        $maK=$K_row->MaK;
                        if($K_row->MaK==$k) echo "<option value='$k' selected='selected'>$tenK</option>";
                        else echo "<option value='$maK'>$tenK</option>";
                    } 
                    ?>
                    </select>
                    </td>
                    <td id="sohk">Số học kỳ:<span> <?php echo $sohk;?></span></td>
                    <td id="somon">Tổng số môn:<span> <?php echo $somon; ?></span></td>
                    <td id="sotc">Tổng số tín chỉ:<span> <?php echo $sotc;?></span></td>
                    <td></td>
                </tr>
                </table>                
                
                
                <div id="action">                   
                    
                    <a href="/quanly/chuong-trinh-dao-tao/nhap-du-lieu/<?php echo $khoa."/".$k; ?>"><img title="Nhập dữ liệu từ tập tin" src="<?php echo static_url(); ?>/images/import.png" alt="export" /></a>
                    <img id="export" title="Xuất dữ liệu" src="<?php echo static_url(); ?>/images/export.png" alt="export" />
                    
                </div>
            </div><!--end #tool -->
            
            <div id="content">
                <div id="message">
                <img alt="ok" src="<?php echo static_url() ?>/images/ok.png"/>                
                </div>
                
                <div id="change_data">
                        
                        <?php
                        if($sohk!=0)
                        {
                            echo '
                            <table id="table_data">
                            <tr id="first">                            
                                <th id="hk">Học Kỳ</th>
                                <th id="mamh">Mã Môn Học</th>
                                <th id="tenmh" style="text-align: left;">Tên Môn Học</th>                    
                                <th id="sotc">Số TC</th>
                                <th id="tclt">TCLT</th>
                                <th id="tcth">TCTH</th>
                                <th id="loai">Loại</th>
                                <th id="kieumh">Kiểu Môn Học</th>                              
                            </tr> ';
                            
                            $flag=0;
                            $hk=1;
                            while($hk<=$sohk)
                            {
                                    
                                 $ctdt_result=$this->mctdt->get_ctdt("",$khoa,$k,$hk);
                                 if(count($ctdt_result)>0)//co mon hoc
                                 {                            
                                     foreach($ctdt_result as $row)
                                     {                                
                                        
                                        if($hk%2==0) echo "<tr class='chan'>";
                                        else echo "<tr class='le'>";   
                                        
                                        $somon_HK=$this->mctdt->get_somon($khoa,$k,$hk);//tinh so mon trong hoc ky 
                                        $sotc_HK=$this->mctdt->get_sotc($khoa,$k,$hk);//tinh sao tinh chi trong hoc ky
                                        if($flag!=$hk)
                                        {
                                            $flag=$hk;
                                            echo "<td class='hk' rowspan='$somon_HK'>
                                                  $hk <br />
                                                  <span class='somon'>Số môn: $somon_HK</span> <br />
                                                  <span class='sotc'>Số TC: $sotc_HK</span> <br />                                      
                                                  <a href='/quanly/chuong-trinh-dao-tao/dieu-chinh/$khoa/$k/$hk' title='Sửa đổi môn học học kỳ này'>Sửa đổi</a>
                                                  
                                                  </td>";
                                        }
                                        $mamh=$row->MaMH;
                                        echo "<td class='mamh'>$mamh</td>";
                                        echo "<td class='tenmh' style='text-align:left'>".$row->TenMH."</td>";
                                        echo "<td class='sotc'  >".$row->SoTC."</td>";                            
                                        echo "<td class='tclt'>".$row->TCLT."</td>";
                                        echo "<td class='tcth'>".$row->TCTH."</td>";
                                        echo "<td class='loai'>".$row->TenLoai."</td>";
                                        $kieumh=$row->KieuMH;
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
                                     }//end foreach
                                 }//end if
                                 else//chua co mon hoc nao
                                 {
                                    if(($hk)%2==0) echo "<tr class='chan empty'  >";
                                        else echo "<tr class='le empty' >";   
                                        
                                        $somon_HK=$this->mctdt->get_somon($khoa,$k,$hk);
                                        $sotc_HK=$this->mctdt->get_sotc($khoa,$k,$hk);
                                        echo "<td class='hk'>
                                                  $hk <br />
                                                  <span class='somon'>Số môn: $somon_HK</span> <br />
                                                  <span class='sotc'>Số TC: $sotc_HK</span> <br />                                      
                                                  <a href='/quanly/chuong-trinh-dao-tao/dieu-chinh/$khoa/$k/$hk' title='Sửa đổi học kỳ này'>sửa đổi</a>                                                  
                                                  </td>";
                                        
                                        echo "<td class='mamh'></td>";
                                        echo "<td class='tenmh' style='text-align:left'></td>";
                                        echo "<td class='sotc'></td>";                            
                                        echo "<td class='tclt'></td>";
                                        echo "<td class='tcth'></td>";
                                        echo "<td class='loai'></td>";
                                        echo "<td class='kieumh'></td>";
                                 }
                                 $hk++;
                             }//end while
                        }//end if $sohk !=0
                        else
                        {
                            echo "<p>Hiện tại chương trình đào tạo này chưa tồn tại!</p>";
                            echo "<p><a href='/quanly/chuong-trinh-dao-tao/them/$khoa/$k'>Tạo ngay</a> Hoặc nhấp biểu tượng nhập dữ liệu từ tập tin trên thanh công cụ</p>";
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
        <form method="post" action="/ctdt/xuatdl">
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