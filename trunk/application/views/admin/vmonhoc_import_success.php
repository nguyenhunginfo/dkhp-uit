<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jsinhvien_import.js"></script>        
	<title><?php echo $title ?></title>
</head>
<style type="text/css">
#wrapper #data h3{background-color: #e8e9e8;padding:10px 10px;
                        -webkit-border-top-right-radius: 5px;
                        -moz-border-top-right-radius: 5px;
                        -o-border-top-right-radius: 5px;
                        border-top-right-radius: 5px;
                        
                        -webkit-border-top-left-radius: 5px;
                        -moz-border-top-left-radius: 5px;
                        -o-border-top-left-radius: 5px;
                        border-top-left-radius: 5px; 
                        
                         }
#wrapper #data h4{background-color: #e8e9e8;padding:12px 10px;
                        -webkit-border-top-right-radius: 5px;
                        -moz-border-top-right-radius: 5px;
                        -o-border-top-right-radius: 5px;
                        border-top-right-radius: 5px;
                        
                        -webkit-border-top-left-radius: 5px;
                        -moz-border-top-left-radius: 5px;
                        -o-border-top-left-radius: 5px;
                        border-top-left-radius: 5px; 
                        
                         }
#wrapper #data #left{float:left;width:168px;
                     min-height:600px;
                     border:1px solid #a1a2a1;
                     -webkit-border-radius: 5px;
                     -moz-border-radius: 5px;
                     -o-border-radius: 5px;
                     border-radius: 5px; 
                     -webkit-box-shadow: 0 0  8px #646564;
                     -moz-box-shadow: 0 0  8px #646564;
                                          
                     }


#wrapper #data #left ul li{margin:2px 0px 10px 0px;}
#wrapper #data #left ul li a{background: #e8e9e8;padding:8px 10px;display:block;
                        
                        }
#wrapper #data #left ul li a:hover{color: #023bfe;font-weight:bold;}
#wrapper #data #left ul li a.active{font-weight:bold;color: #023bfe;}
#wrapper #data #left ul li ul li{margin:5px 0px 0px 20px;}
#wrapper #data #left ul li ul li a{background:none;padding:0px;border:none;}

#wrapper #data #left ul li ul li a:hover{color: red;font-weight:bold;cursor:pointer;}


#wrapper #data #right{float:right;width:978px;                                         
                      padding:0px;
                      min-height:600px;
                      -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        -o-border-radius: 5px;
                        border-radius: 5px; 
                        position:relative;
                        margin-top:0px;
                        border:1px solid #a1a2a1;
                        -webkit-box-shadow: 0 0  8px #646564;
                        -moz-box-shadow: 0 0  8px #646564;
                      }

#wrapper #data #info p{font-size:20px;margin: 10px 10px;}
#wrapper #data #info p a{color: #048ce1;}
#wrapper #data #info p a:hover{text-decoration:underline;}
#wrapper #data #data_checking{min-height: 360px;margin:0px 10px;}

#wrapper #data #data_checking table{border-collapse: collapse;}
#wrapper #data #data_checking table tr{height:2px;}
#wrapper #data #data_checking table tr#first{background: #e8e9e8;}
#wrapper #data #data_checking table td,
#wrapper #data #data_checking table th{border:1px solid #e8e9e8;text-align:center;font-size:14px;}


#wrapper #data #data_checking  table tr.active,
#wrapper #data #data_checking  table tr:hover{background:#bdf7f5;}  
#wrapper #data #data_checking  table th#im_success{width:50px;}
#wrapper #data #data_checking  table th#mamh{width:100px;}
#wrapper #data #data_checking  table th#tenmh{width:260px;}
#wrapper #data #data_checking  table th#sotc{width:100px;}
#wrapper #data #data_checking  table th#tclt{width:100px;}
#wrapper #data #data_checking  table th#tcth{width:100px;}
#wrapper #data #data_checking  table th#loai{width:150px;}
</style>
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
        <?php $this->load->view("admin/vmain_menu"); ?>
        <!--END div #main_menu --> 
           
        <div id="data">  
            <div id="left">
            <h3>Quản lý môn học</h3>
            <ul>
            <li><a  href="/quanly/monhoc">Danh sách môn học</a>
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
            <li><a href="/quanly/monhoc/mon-hoc-nhom" title="Danh sách nhóm môn học">Nhóm môn học</a>
            <li><a href="/quanly/monhoc/tuong-duong" title="Môn học tương đương(thay thế)">MH tương đương</a>
            <li><a href="/quanly/monhoc/them-mon-hoc">Thêm môn học</a></li>
            <li><a class="active" href="/quanly/monhoc/nhap-du-lieu">Nhập dữ liệu</a></li>        
            <li><a href="/quanly/monhoc/thong-ke">Thống kê</a></li>          
                
            </ul>
            </div><!--end #left -->
            
            <div id="right"> 
                <h3><?php echo $right_title; ?></h3>
                <div id="info">
                <p>Quá trình nhập dữ liệu thành công <a href="/quanly/monhoc">(Xem danh sách đầy đủ)</a></p>
                <p>Danh sách chi tiết:</p>
                <p></p>
                </div><!--end info -->
                <div id="data_checking">
                <?php
                if($num_success>0)
                {
                    echo "
                        <table>
                                <tr id='first'>
                                <th id='im_success'></th>
                                <th id='mamh'>Mã Môn Học</th>
                                <th id='tenmh'>Tên Môn Học</th>                    
                                <th id='sotc'>Số Tín Chỉ</th>
                                <th id='tclt'>Tín Chỉ LT</th>
                                <th id='tcth'>Tín Chỉ TH</th>
                                <th id='loai'>Loại Môn Học</th>
                                <th id='kieumh'>Kiểu Môn Học</th>
                                </tr>";
                                
                                foreach($success_data as $row)
                                {
                                    
                                    echo "<tr class='success'>";
                                    echo "<td class='im_success'><img title='Đã thêm thành công' src='".static_url()."/images/tick.png' alt='OK' /></td>";                           
                                    
                                    echo "<td>".$row["MaMH"]."</td>";
                                    echo "<td style='text-align:left' >".$row["TenMH"]."</td>";                            
                                    echo "<td>".$row["SoTC"]."</td>";
                                    echo "<td>".$row["TCLT"]."</td>";
                                    echo "<td>".$row["TCTH"]."</td>";
                                    
                                    $maloai=$row["Loai"];
                                    $tenloai="";
                                    switch($maloai)
                                    {
                                        case "DC":$tenloai="Đại Cương";break;
                                        case "CN":$tenloai="Chuyên Nghành";break;
                                        case "CSN":$tenloai="Cơ Sở Nghành";break;
                                        case "TC":$tenloai="Tự Chọn";break;
                                        
                                    }
                                    echo "<td>$tenloai</td>";
                                    
                                    $kieumh=$row["KieuMH"];
                                    $ten_kieumh="";
                                    switch($kieumh)
                                    {
                                        case "DON":$ten_kieumh="Đơn";break;
                                        case "NHOM":$ten_kieumh="Nhóm";break;
                                                                               
                                    }
                                    
                                    echo "<td>$ten_kieumh</td>";                                     
                                    echo "</tr>";
                                    
                                }
                                
                                                                                    
                        echo "
                            <tr>
                                <td colspan='2'><b>Tổng cộng</b></td>
                                <td>$num_success</td>
                                <td></td>                    
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
                                </tr>
                            </table>";
                 }                        
                 ?>
                 </div><!--end data checking -->
                   
            </div><!--end #right -->
        </div><!--end #data -->
    </div><!--#page =#main_menu + #data -->
    
    <!-- #footer -->
    <?php $this->load->view("admin/vfooter"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   </body>
</html>