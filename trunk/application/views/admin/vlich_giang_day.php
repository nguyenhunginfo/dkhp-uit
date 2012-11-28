<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="rinodung" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/menu/menu_css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/drapdrop.css" />     
    <link rel="stylesheet" type="text/css" href="<?php echo static_url(); ?>/css/admin/lich_giang_day.css" />
     
    
    
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jdrapdrop.js"></script>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/admin/jlich_giang_day.js"></script>        
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
        <?php $this->load->view("admin/vmain_menu"); ?>
        <!--END div #main_menu --> 
           
        <div id="data">
            <div id="right"> 
                <h3><?php echo $data_title; ?><span><a href="/quanly/lop">Quay về danh sách lớp</a></span> </h3>
                
                <div class='box'>                    
                <?php
                echo "<table>";                    
                    echo "<tr id='first'>";
                    echo "<th id='ca'></th>";
                    foreach($thu_result as $thu_row)
                    {
                        echo "<th>Thứ ".$thu_row->TenThu."</th>";
                    } 
                    echo "</tr>";
                    //Trong tung hang ca
                    foreach($ca_result as $ca_row)
                    {                      
                        echo "<tr>";
                        echo "<td class='ca' title='Ca $ca_row->TenCa'>$ca_row->TenCa</td>";
                        //trong tung cot thu
                        foreach($thu_result as $thu_row)
                        {
                            $id=$ca_row->TenCa.$thu_row->TenThu;
                            $lop_result=$this->mlop->get_lich($thu_row->TenThu,$ca_row->TenCa);
                            
                            echo "<td id='$id' class='info'>";
                            $magv_array="";
                            $phong_array="";
                            foreach($lop_result as $lop_row)
                            {
                                $malop=$lop_row->MaLop;
                                $tenmh=$lop_row->TenMH;
                                $tengv=$lop_row->TenGV;
                                $magv=$lop_row->MaGV;
                                $phong=$lop_row->Phong;
                                
                                
                                $magv_array.=" ".$magv;
                                $phong_array.=" ".$phong;
                                $title="$malop $tengv \n$tenmh P.$phong";
                                $text="$malop <span id='tengv'>$tengv</span> 
                                      <span id='magv'>$magv</span> 
                                      <br />
                                      $tenmh 
                                      P.<span id='phong'>$phong</span>";
                                echo "<p class='item' id='$malop' title='$title'>$text</p>";
                                
                            } 
                            //keep track  
                            echo "<p class='$magv_array' id='magv'></p>";
                            echo "<p class='$phong_array' id='phong'></p>";                          
                            echo "</td>";                      
                        } 
                        echo "</tr>";
                          
                    }
                    echo "</table>";//end table
                ?>
                
                </div><!--end #box -->
                <div id="message">
                <img alt="ok" src="<?php echo static_url() ?>/images/ok.png"/>                
                </div>
                <div id="action">
                <a href="/quanly/lop">Quay về danh sách lớp</a>
                <img id="save" title="Lưu lịch giảng dạy" src="<?php echo static_url(); ?>/images/accept.png" />       
                <img id="process" title="Đang lưu" src="<?php echo static_url(); ?>/images/process.gif" />
                </div><!--end #action -->
            </div><!--end #right -->
        </div><!--end #data -->
        </div><!--#page =#main_menu + #data -->
    <!-- #footer -->
    <?php $this->load->view("admin/vfooter"); ?>
    <!-- End #footer-->
   
</div><!--end #wrapper -->   



</body>
</html>