<?php 
	$name = $this->session->userdata('name');
	if($name != false)
	{
		//echo $name;
		header('Location: '.base_url());
	}
?>
<!DOCTYPE HTML>
<head>
	<meta name="author" content="danhkhh" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Đăng ký học phần</title>
	<link href="<?php echo static_url();?>/css/index/login.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo static_url();?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo static_url();?>/js/index/vlogin.js"></script>	
	<script type="text/javascript">
		$(document).ready(function()
		{
			<?php
				if(isset($formeload))
				{
					echo '$("#popup").show(); $("#formlogin").show();';
				}
				else
				{
					echo '$("#popup").hide(); $("#formlogin").hide();';
				}
			?>
		});
	</script>
</head>

<body>
	<div id="popup">      
    </div>      
    <div id="formlogin">
        <img id="close" title="Đóng" src="<?php echo static_url(); ?>/images/close.png" />
		<form method="post" action="<?php echo base_url(); ?>dang-ky-hoc-phan">
        <table>
        <tr><td>Mã số tài khoản</td></tr>
        <tr><td><input type="text" name="username" value="" id="username" /></td></tr>
        <tr><td>Mật khẩu</td></tr>
        <tr><td><input type="password" name="password"  id="password" /></td></tr>
        <tr><td>Mã xác nhận &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cap['image'];?> <input type="hidden" name="captchavalue" value="<?php echo $cap['word'] ?>" /></td>	</tr>
		<tr><td><input type="text" name="captcha" id="captcha" value="<?PHP echo $cap['word']; ?>" /></td></tr>
        <tr><td class="error"><?php 
					if(isset($accounterror)) 
						echo $accounterror;
					if(isset($captchaerror)) 
						echo "Mã xác nhận sai!";
				?>
			</td></tr>					
		<tr><td><input type="submit" name="submit" value="Đăng nhập" id="dangnhap" /></td></tr>	
        </table>
        </form>
    </div>

    <div id="wrapper">
        
        <div id="top">            
           <h4>Đại Học Quốc Gia Thành Phố Hồ Chí Minh - Trường Đại Học Công Nghệ Thông Tin<h4>
            
        </div><!-- end #top -->
        
        <div id="header">                    
            <img src="<?php echo static_url();?>/images/index/logo.png" />
            <div id="banner">
                <p>Đại Học Quốc Gia Thành Phố Hồ Chí Minh</p>
                <p>Trường Đại Học Công Nghệ Thông Tin</p>
                <p>Hệ Thống Đăng Ký Học Phần</p>
            </div><!-- end #banner -->
            
            <div id="menu">
                <ul>
                    <li id="kehoach"><a href="#" class="active">Quy chế & kế hoạch ĐKHP</a></li>
                    <li id="hd"><a href="#">Hướng Dẫn Chi Tiết</a></li>
                </ul>
            </div><!-- end #menu -->
        
        </div><!-- end #header -->
        
        
        
        
        <div id="primary">
                        
            
            
            <div id="quyche">
                <div id="linklogin">
                <p>Đăng nhập</p>
                </div>
                <div id="quyche1" class='box'>
                    <h4>Quy chế đăng ký học phần học kỳ 1 2012 - 2013</h4>
                    <div id="box_data">
                    <p>Để quá trình đăng ký học phần được diễn ra nhanh chóng và hiệu quả. Phòng đào tạo đề nghị sinh viên nghiêm chỉnh chấp hành những quy định sau:</p>
                    <ol>
                    <li>Hệ thống đăng ký gồm 2 phần: phần môn học chung (những môn đại cương) và phần những môn chuyên ngành</li>
                    <li>Sinh viên chọn lớp để đăng ký cho môn học của mình (1 môn có thể có nhiều lớp)</li>
                    <li>Sinh viên tự sắp xếp thời khóa biểu của mình để tránh trùng giờ.</li>
                    <li>Số tín chỉ tối đa sinh viên có thể đăng ký là 26 tín chỉ và tối thiểu là 10 tín chỉ. Nếu vi phạm phòng đào tạo sẽ làm việc riêng.</li>
                    <li>Sau khi đăng ký xong sinh viên in phiếu và đóng tiền học phí tại phòng tài chính.</li>
                    </ol>
                    </div>
                </div>
                <div id="quyche2" class='box'>
                    <h4>Kế hoạch đăng ký học phần học kỳ 1 2012 - 2013</h4>
                    <div id="box_data">
                    <p>Để quá trình đăng ký học phần được diễn ra nhanh chóng và hiệu quả. Phòng đào tạo đề nghị sinh viên nghiêm chỉnh chấp hành những quy định sau:</p>
                    <ol>
                    <li>Hệ thống đăng ký gồm 2 phần: phần môn học chung (những môn đại cương) và phần những môn chuyên ngành</li>
                    <li>Sinh viên chọn lớp để đăng ký cho môn học của mình (1 môn có thể có nhiều lớp)</li>
                    <li>Sinh viên tự sắp xếp thời khóa biểu của mình để tránh trùng giờ.</li>
                    <li>Số tín chỉ tối đa sinh viên có thể đăng ký là 26 tín chỉ và tối thiểu là 10 tín chỉ. Nếu vi phạm phòng đào tạo sẽ làm việc riêng.</li>
                    <li>Sau khi đăng ký xong sinh viên in phiếu và đóng tiền học phí tại phòng tài chính.</li>
                    <li>Hệ thống đăng ký gồm 2 phần: phần môn học chung (những môn đại cương) và phần những môn chuyên ngành</li>
                    <li>Sinh viên chọn lớp để đăng ký cho môn học của mình (1 môn có thể có nhiều lớp)</li>
                    <li>Sinh viên tự sắp xếp thời khóa biểu của mình để tránh trùng giờ.</li>
                    <li>Số tín chỉ tối đa sinh viên có thể đăng ký là 26 tín chỉ và tối thiểu là 10 tín chỉ. Nếu vi phạm phòng đào tạo sẽ làm việc riêng.</li>
                    <li>Sau khi đăng ký xong sinh viên in phiếu và đóng tiền học phí tại phòng tài chính.</li>
                    </ol>
                    </div>
                </div>
            </div>
            
        </div><!-- end #primary1 -->
        
        <div id="footer">
            <div id="diachi">
                <p>Trường Đại Học Công Nghệ Thông Tin</p>
                <p>Đại Học Quốc Gia Thành Phố Hồ Chí Minh</p>
                <p>Khu phố 6, Phường Linh Trung Thủ Đức</p>
                <p>Mail: Admin.uit@gmail.com</p>
                <p>Fax: 016888898</p>
                <p>Phone: 01699938919</p>
            </div><!-- end #diachi -->
            <div id="link">
                <img src="<?php echo static_url();?>/images/index/uit.png"  alt="uit" />
                <img src="<?php echo static_url();?>/images/index/facebook.png" alt="facebook" />
                <img src="<?php echo static_url();?>/images/index/zing.png" title="zing"  />
            </div><!-- end #link -->
        </div><!-- end #footer -->
        
    </div><!-- end #wrapper -->

</body>
</html>