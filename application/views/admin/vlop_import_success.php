<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    
       
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
#wrapper #data #data_checking table th#im_success{width:70px;}
#wrapper #data #data_checking table th#malop{width:120px;}
#wrapper #data #data_checking table th#mamh{width:240px;text-align:left;}
#wrapper #data #data_checking table th#magv{width:160px;text-align:left;}
#wrapper #data #data_checking table th#phong{width:60px;}
#wrapper #data #data_checking table th#thu{width:60px;}
#wrapper #data #data_checking table th#ca{width:60px;}
#wrapper #data #data_checking table th#min{width:60px;}
#wrapper #data #data_checking table th#max{width:60px;}
#wrapper #data #data_checking table th#slht{width:60px;}

                 
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
                
                <li><a href="/quanly/lop/lop-de-nghi">Lớp đề nghị<?php echo "(".$num_denghi.")"; ?></a></li>
                <li><a href="/quanly/lop/them-lop">Thêm lớp</a></li>
                <li><a href="/quanly/lop/nhap-du-lieu">Nhập dữ liệu</a></li>
                <li><a href="/quanly/lop/lich-giang-day">Lịch giảng dạy</a></li>
                <li><a href="/quanly/lop/thong-ke">Thống kê</a></li>
            </ul>
            </div><!--end #left -->
            
            <div id="right"> 
                <h3><?php echo $right_title; ?></h3>
                <div id="info">
                <p>Quá trình nhập dữ liệu thành công</p>
                <p>Loại lớp: <?php if($loai=="lt") echo "Lý thuyết";
                                   else echo "Thực hành"; 
                             ?>  
                <a href="/quanly/lop/<?php if($loai=="lt") echo "ly-thuyet";
                                           else echo "thuc-hanh";
                                     ?>">
                (Xem danh sách đầy đủ)</a> </p>
                <p>Chi tiết danh sách lớp:</p>
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
                            <th id='malop'>Mã Lớp</th>
                            <th id='mamh'>Tên Môn Học</th>                    
                            <th id='magv'>Tên Giáo Viên</th>
                            <th id='thu'>Thứ</th>
                            <th id='ca'>Ca</th>
                            <th id='phong'>Phòng</th>
                            <th id='min'>Min</th>
                            <th id='max'>Max</th>
                            <th id='slht'>SLHT</th>
                            </tr>";
                              
                            
                            foreach($success_data as $row)
                            {
                                
                                echo "<tr>";
                                echo "<td class='im_success'><img title='Trùng phòng giảng dạy' src='".static_url()."/images/tick.png' /></td>";                                
                                echo "<td>".$row["MaLop"]."</td>";
                                echo "<td style='text-align:left' >".$row["TenMH"]."</td>";                            
                                echo "<td style='text-align:left'>".$row["TenGV"]."</td>";
                                echo "<td>".$row["Thu"]."</td>";
                                echo "<td>".$row["Ca"]."</td>";
                                echo "<td>".$row["Phong"]."</td>";
                                echo "<td>".$row["Min"]."</td>";
                                echo "<td>".$row["Max"]."</td>";
                                echo "<td>".$row["SLHT"]."</td>";
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
   
</div><!--end #wrapper -->   
</body>
</html>