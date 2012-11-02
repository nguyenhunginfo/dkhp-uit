<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
       
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/sinhvien_import_template.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/popup/popup_css.css" />
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jpopup.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jsinhvien.js"></script>        
	<title><?php echo $title ?></title>
</head>

<body>
<div id="wrapper">
<div id="right">        
          <div id="change_data">
                  <table id="table_data">
                  <tr id="first">
                    <th id="img_error"></th>
                    <th id="mssv">MSSV</th>
                    <th id="tensv">Tên SV</th>                    
                    <th id="lop">Lớp</th>
                    <th id="k">Khóa</th>
                    <th id="ngaysinh">Ngày Sinh</th>
                    <th id="noisinh">Nơi Sinh</th>
                    <th id="sdt">Số ĐT</th>
                    <th id="email">E-mail</th>
                  </tr>
                  <?php
                      $arr_unique=array();
                      foreach($sinhvien_result as $row)
                      {
                          if(Sinhvien::valid_mssv($row["MaSV"],$arr_unique)==false)
                          {
                            echo "<tr class='error'>";
                            echo "<td class='im_error'><img title='Trùng MaSV' src='".static_url()."/images/delete.png' /></td>";
                          }
                          else
                          {
                            echo "<tr>";
                            echo "<td class='im_error'></td>";
                          }
                          echo "<td class='masv' title='Xem chi tiết'>".$row["MaSV"]."</td>";
                          echo "<td class='tensv' style='text-align:left' >".$row["TenSV"]."</td>";                            
                          echo "<td class='lop'>".$row["Lop"]."</td>";
                          echo "<td class='k'>".$row["K"]."</td>";
                          echo "<td class='ngaysinh'>".$row["NgaySinh"]."</td>";
                          echo "<td class='noisinh'>".$row["NoiSinh"]."</td>";
                          echo "<td class='sdt'>".$row["SoDT"]."</td>";
                          echo "<td class='email'>".$row["Email"]."</td>";
                          echo "</tr>";
                          $arr_unique[]=$row["MaSV"];
                      }
                  ?>                                                  
                  </table>
          </div><!--end #change_data -->
    </div><!--end #right -->
</div><!--end #wrapper -->   

<?php include_once("vpopup.php"); ?>

</body>
</html>