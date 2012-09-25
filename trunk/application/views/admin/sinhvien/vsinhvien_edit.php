<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />   
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/sinhvien_edit.css" />
     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
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
    <?php $this->load->view("template/vmain_menu"); ?>
    <!--END div #main_menu --> 
       
    <div id="data">
        
        <div class="data_box">
        <h3>Thông tin chi tiết sinh viên</h3>
        <?php        
        
        $khoa_result=$this->msinhvien->get_khoa();
        
        if(count($data_result)>0)
        {
            foreach($data_result as $row)
            {
                
                echo "<div class='box'>";
                echo "<form action='' method='post'>";
                echo "<table id='". $row->MaSV."'>";
                echo "<tr><td>MSSV</td>
                          <td><input  name='masv'  id='masv'  type='text' value='". $row->MaSV."'/> ".form_error("masv","<span class='error'>","</span>")." </td>
                          </tr>";
                echo "<tr><td>Họ Tên</td><td><input  name='tensv' id='tensv' type='text' value='". $row->TenSV."'/> </td></tr>";
                echo "<tr><td>Khoa</td>
                          <td>
                              <select id='khoa'>";
                              foreach($khoa_result as $khoa_row)
                              {
                                if($khoa_row->MaKhoa==$row->Khoa) 
                                     echo "<option title='".$khoa_row->TenKhoa."' selected='selected' value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                                else echo "<option title='".$khoa_row->TenKhoa."'  value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                          
                $lop_result=$this->msinhvien->get_lop($row->Khoa);
                echo "<tr><td>Lớp</td>
                          <td>
                              <select id='lop'>";
                              foreach($lop_result as $lop_row)
                              {
                                if($lop_row->TenLop==$row->Lop) echo "<option selected='selected' value='".$lop_row->TenLop."'>".$lop_row->TenLop."</option>";
                                else echo "<option  value='".$lop_row->TenLop."'>".$lop_row->TenLop."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                          
                $K_result=$this->msinhvien->get_K();
                echo "<tr><td>Khóa</td>
                          <td>
                              <select id='k'>";
                              foreach($K_result as $K_row)
                              {
                                if($K_row->MaK==$row->K) echo "<option selected='selected' title='".$K_row->TenK."' value='".$K_row->MaK."'>".$K_row->MaK."</option>";
                                else echo "<option title='".$K_row->TenK."'  value='".$K_row->MaK."'>".$K_row->MaK."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                          
                echo "<tr><td>Ngày Sinh</td><td><input id='ngaysinh' type='text' value='". $row->NgaySinh."'/> </td></tr>";
                echo "<tr><td>Nơi Sinh</td><td><textarea id='noisinh' cols='25' rows='4'>".$row->NoiSinh."</textarea></td></tr>";
                echo "<tr><td>CMND</td><td><input type='text' id='cmnd' value='". $row->CMND."'/> </td></tr>";
                echo "<tr><td><input type='submit' value='Lưu...' /></td></tr>";
                echo "</table>";
                echo "</form>";
                echo "</div><!--end .box -->";
                
                
                
                echo "<div class='box'>";
                echo "<table id='edit'";
                echo "<tr><td>MSSV</td><td><input title='". $row->MaSV."'    id='masv' type='text' value='". $row->MaSV."'/> </td></tr>";
                echo "<tr><td>Họ Tên</td><td><input id='tensv' type='text' value='". $row->TenSV."'/> </td></tr>";
                echo "<tr><td>Khoa</td>
                          <td>
                              <select id='khoa'>";
                              foreach($khoa_result as $khoa_row)
                              {
                                if($khoa_row->MaKhoa==$row->Khoa) 
                                     echo "<option title='".$khoa_row->TenKhoa."' selected='selected' value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                                else echo "<option title='".$khoa_row->TenKhoa."'  value='".$khoa_row->MaKhoa."'>".$khoa_row->MaKhoa."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                          
                $lop_result=$this->msinhvien->get_lop($row->Khoa);
                echo "<tr><td>Lớp</td>
                          <td>
                              <select id='lop'>";
                              foreach($lop_result as $lop_row)
                              {
                                if($lop_row->TenLop==$row->Lop) echo "<option selected='selected' value='".$lop_row->TenLop."'>".$lop_row->TenLop."</option>";
                                else echo "<option  value='".$lop_row->TenLop."'>".$lop_row->TenLop."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                          
                $K_result=$this->msinhvien->get_K();
                echo "<tr><td>Khóa</td>
                          <td>
                              <select id='k'>";
                              foreach($K_result as $K_row)
                              {
                                if($K_row->MaK==$row->K) echo "<option selected='selected' title='".$K_row->TenK."' value='".$K_row->MaK."'>".$K_row->MaK."</option>";
                                else echo "<option title='".$K_row->TenK."'  value='".$K_row->MaK."'>".$K_row->MaK."</option>";
                               
                              }
                echo          "</select>
                          </td></tr>";
                          
                echo "<tr><td>Ngày Sinh</td><td><input id='ngaysinh' type='text' value='". $row->NgaySinh."'/> </td></tr>";
                echo "<tr><td>Nơi Sinh</td><td><textarea id='noisinh' cols='25' rows='4'>".$row->NoiSinh."</textarea></td></tr>";
                echo "<tr><td>CMND</td><td><input type='text' id='cmnd' value='". $row->CMND."'/> </td></tr>";
                echo "</table>";
                echo "<div class='action'>";
                echo '
                      <img id="save" title="Lưu" src="'. static_url().'/images/accept.png" />
                      <img id="del" title="Xóa" src="'. static_url().'/images/delete.png" />';
                echo "</div><!--end .action -->";
                echo "</div><!--end .box -->";
            }
           
            
        }
        else echo "Lỗi dữ liệu";
         ?>
        
        </div>
    </div><!--end #data -->
    </div><!--#page -->
    
    <!-- #footer -->
    <?php $this->load->view("template/vfooter"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   



</body>
</html>