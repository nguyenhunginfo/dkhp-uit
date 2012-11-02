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
#wrapper #data #data_checking  table th#im_error{width:50px;}
#wrapper #data #data_checking  table th#mssv{width:80px;}
#wrapper #data #data_checking  table th#tensv{width:180px;}
#wrapper #data #data_checking  table th#lop{width:100px;}
#wrapper #data #data_checking  table th#k{width:50px;}
#wrapper #data #data_checking  table th#ngaysinh{width:100px;}
#wrapper #data #data_checking  table th#noisinh{width:120px;}
#wrapper #data #data_checking  table th#sdt{width:100px;}
#wrapper #data #data_checking  table th#email{width:180px;}

                 
#wrapper #data  #action {height: 50px;
                        width: 100%;
                        background-color:#e8e9e8;
                        -webkit-border-bottom-right-radius: 5px;
                        -moz-border-bottom-right-radius: 5px;
                        -o-border-bottom-right-radius: 5px;
                        border-bottom-right-radius: 5px;
                        -webkit-border-bottom-left-radius: 5px;
                        -moz-border-bottom-left-radius: 5px;
                        -o-border-bottom-left-radius: 5px;
                        border-bottom-left-radius: 5px;                                    
                                
                        }
#wrapper #data  #action p{float:left;margin:0px 10px;line-height:50px;font-weight:normal;color:red;}
#wrapper #data  #action img{margin:1px 10px 1px 10px;opacity:0.65;width:48px;height:48px;float:right;}
#wrapper #data  #action img:hover{cursor:pointer;opacity:1;}


#wrapper #data #message {display:none;}
#wrapper #data #message span{color:green;}

                     
                        

                        
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
            <h3>Quản lý sinh viên</h3>
            <ul>
                <li><a href="/quanly/sinhvien">Danh sách sinh viên</a>
                
                <?php
                echo "<ul>";
                foreach($khoa_result as $row)
                {    
                    echo "<li id='".$row->MaKhoa."' title='".$row->TenKhoa."'><a href='/quanly/sinhvien/".$row->MaKhoa."'> Khoa ".$row->MaKhoa."</a></li>"; 
                }
                echo "</ul>";
                ?>                 
                </li>
                <li><a href="/quanly/sinhvien/them-sinh-vien">Thêm sinh viên</a></li>
                <li><a href="/quanly/sinhvien/nhap-du-lieu" class="active">Nhập dữ liệu</a></li> 
                <li><a href="/quanly/sinhvien/xuat-du-lieu">Xuất dữ liệu</a></li>   
                <li><a href="/quanly/sinhvien/thongke">Thống kê</a></li>
            </ul>
            </div><!--end #left -->
            <div id="right"> 
                <h3><?php echo $right_title; ?></h3>
                <div id="info">
                <p>Quá trình nhập dữ liệu thành công</p>
                <p>Khoa: <?php echo $TenKhoa; ?>  <a href="/quanly/sinhvien/<?php echo $khoa ?>">(Xem danh sách đầy đủ)</a> </p>
                <p>Danh sách sinh viên:</p>
                <p></p>
                </div><!--end info -->
                <div id="data_checking">
                <?php
                if($num_success>0)
                {
                    echo "
                        <table>
                                <tr id='first'>
                                <th id='im_error'></th>
                                <th id='mssv'>MSSV</th>
                                <th id='tensv'>Tên SV</th>                    
                                <th id='lop'>Lớp</th>
                                <th id='k'>Khóa</th>
                                <th id='ngaysinh'>Ngày Sinh</th>
                                <th id='noisinh'>Nơi Sinh</th>
                                <th id='sdt'>Số ĐT</th>
                                <th id='email'>E-mail</th>
                                </tr>";
                                  
                                
                                foreach($success_data as $row)
                                {
                                    
                                    echo "<tr class='success'>";
                                    echo "<td class='im_success'><img title='Đã thêm thành công' src='".static_url()."/images/tick.png' alt='OK' /></td>";                           
                                    echo "<td class='masv'>".$row["MaSV"]."</td>";
                                    echo "<td class='tensv' style='text-align:left' >".$row["TenSV"]."</td>";                            
                                    echo "<td class='lop'>".$row["Lop"]."</td>";
                                    echo "<td class='k'>".$row["K"]."</td>";
                                    echo "<td class='ngaysinh'>".$row["NgaySinh"]."</td>";
                                    echo "<td class='noisinh'>".$row["NoiSinh"]."</td>";
                                    echo "<td class='sdt'>".$row["SDT"]."</td>";
                                    echo "<td class='email'>".$row["Email"]."</td>";
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