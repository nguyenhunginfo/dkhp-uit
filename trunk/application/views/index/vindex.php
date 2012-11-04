<!DOCTYPE HTML>
<head>
	<meta name="author" content="danhkhh" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Đăng ký học phần</title>
	<link href="<?php echo static_url();?>/css/index/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo static_url();?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo static_url();?>/js/index/vindex.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{	
			$("#contenttable tr td p").click(function(e)
			{
				var id1 = $(this).attr("id"); 
				var id = id1.substr(4, id1.length - 4);
				if($("#" + id).html() == "")
				{
					var MSSV = $("#MSSV").html();
					var khoa = $("#khoa").attr("class");
					var MaMH = id.substr(3, id1.length - 3);
					var TenMH = $("#" + id).attr("title");
					$.ajax(
					{
						url: "<?php echo base_url()."index/index/getLop"; ?>",
						data: "MaMH="+MaMH+"&MSSV="+MSSV+"&khoa="+khoa,
						type: "POST",
						success:function(res) 
						{
							$("#" + id).html(res.replace("showTenMH", TenMH));
							$("#popup").show();
							$("#" + id).show();
						}
					});
				}
				else
				{
					$("#popup").show();
					$("#" + id).show();
				}
			});		
	
			$("#btn_changepass").click(function(e)
			{
				if($("#oldPassword").val() == "")
				{
					alert("Bạn chưa nhập mật khẩu cũ!");
					return;					
				}
				pass1 = $("#password1").val();
				pass2 = $("#password2").val();
				if(pass1 != pass2)
				{
					$("#errorNewPassword").html("* Password mới không trùng!");
					alert("Password mới không trùng!");
				}
				else
				{
					if(pass1 == "")
					{
						alert("Bạn chưa nhập mật khẩu mới!");
						return;
					}
					var MSSV = $("#MSSV").html();
					var oldPass = $("#oldPassword").val();
					var newPass = $("#password1").val();
					$.ajax(
					{
						url: "<?php echo base_url()."index/index/changePass"; ?>",
						data: "MSSV="+MSSV+"&oldPass="+oldPass+"&newPass="+newPass,
						type: "POST",
						success:function(res) 
						{
							if(res=="OK")
							{
								window.location.assign("<?php echo base_url()."index/index/logout"; ?>");
							}
							else
								if(res == "error")
								{
									$("#errorOldPassword").fadeTo(0, 1);
									$("#errorOldPassword").html("* Password cũ sai!");
									$("#errorOldPassword").fadeTo(2000, 0);
								}
						}
					});
				}
			});
		});
	</script>	
</head>

<body>
	
	<div id="popup">
	</div><!-- end #popup -->
	<?php
		foreach ($loplt->result() as $row)
		{
			echo "<div id='div"; echo $row->MaMH; echo "' title='"; echo $row->TenMH; echo "' class='popupdetail'></div>";
		}
	?>
	<div id = "divchangepass">
		<div id="topchangepass" >Đổi mật khẩu</div>
		<button id="closechangepass" ></button>
		<div class="nottop">Mật khẩu cũ:<br> <input type="password" name="oldPassword" id="oldPassword" /><br></div>
		<div class="nottop">Mật khẩu mới:<br> <input type="password" name="password1" id="password1" /><br></div>
		<div class="nottop">Xác nhận mật khẩu mới:<br> <input type="password" name="password2" id="password2" /><br></div>
		<span id="errorOldPassword"></span>
		<span id="errorNewPassword"></span>
		<button id="btn_changepass" ></button>
		
	</div>

    <div id="wrapper">
        
        <div id="top">
            
            <ul>
                <li><a href="#"><strong>Trang chủ</strong></a></li>
                <li><a href="#">Chương trình đào tạo</a></li>
                <li><a href="#">Liên kết &raquo;</a></li>
                <li><a href="#"><?php echo $MSSV; ?></a> | <a href="<?php echo base_url(); ?>index/index/logout">Thoát</a></li>
            </ul>
            
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
                    <li><a><strong>Đăng Ký Học Phần (<span>new</span>)</strong></a></li>
                    <li><a>Hướng Dẫn</a></li>
                    <li><a>In Phiếu</a></li>
                </ul>
            </div><!-- end #menu -->
        
        </div><!-- end #header -->
        
        <div id="primary">
            <div id="content">
                <div id="contentheader">
                    <ul>
                        <li class="active">Chương Trình Đào Tạo</li>
                    </ul>
                </div><!-- end #contentheader -->
                
                <div id="contenttable">
                    <table cellspacing="0">
                        <tr>
                            <th>Học Kỳ</th>
                            <th>Mã Môn Học</th>
                            <th>Tên Môn Học</th>
                            <th>Số TC</th>
                            <th>TCLT</th>
                            <th>TCTH</th>
                            <th>Điểm</th>
                            <th>Tình Trạng</th>
                            <th>Thao Tác</th>
                        </tr>
						<?php
							$lopdk = "";
							foreach ($ctdt->result() as $row)
							{
								$full = 200;
								$dk = 0;
								$lop = "";
								$temp = $row->MaMH;
								echo "<tr><td>";
								echo $row->HK;
								echo "</td><td>";
								echo $row->MaMH;
								echo "</td><td align = 'left'>";
								echo $row->TenMH;
								echo "</td><td>";
								echo $row->SoTC;
								echo "</td><td>";
								echo $row->TCLT;
								echo "</td><td>";
								echo $row->TCTH;
								echo "</td><td>";
								echo $row->Diem;
								echo "</td><td>";
								foreach ($loplt->result() as $row1)
								{
									if($row1->MaMH == $row->MaMH)
									{
										$full --;
										$dk ++;
										if($row1->SLHT < $row1->Max)
										{
											$full = 0;
										}										
										if($row1->MaSV != null)
										{
											$dk = 200;
											$lop = $row1->Malop;
											$lopdk = $lopdk.$row1->Malop." ";
											foreach ($lopth->result() as $row2)
											{
												if($temp == $row2->MaMH)
												{													
													$lop = $lop.", ".$row2->Malop;
													$lopdk = $lopdk.$row2->Malop." ";
												}
											}
										}
									}
								}
								if($full <= 0)
								{
									echo "lớp mở</td><td>";
								}
								else
								{
									if($full < 200)
									{
										echo "lớp đầy</td><td>";
									}
									else
									{
										echo "</td><td>";
									}
								}
								if($dk >= 200)
								{
									echo "<p id='showdiv".$row->MaMH."'>".$lop."</p></td></tr>";
								}
								else
								{
									if($dk != 0)
									{
										if($full <= 0)
											echo "<p id='showdiv".$row->MaMH."'>đăng ký</p></td></tr>";
										else
											echo "</td></tr>";
									}
									else
									{
										echo "</td></tr>";
									}
								}
							}
						?>
                    </table>
                </div><!-- end #contenttable -->
				
				<div id="contenttable1">
				</div><!-- end #contenttable1 -->
				
				<div id="form">
					<form method="POST" action="<?php echo base_url()."index/index/register"; ?>" >
						<input type="hidden" name="khoa" value="<?php echo $khoa; ?>" />
						<input type="hidden" name="MSSV" value="<?php echo $MSSV; ?>" />
						<input type="hidden" id="DKHP" name="DKHP" value="<?php echo $lopdk; ?>" />
						<input type="submit" value="Đăng ký" />
					</form>
				</div><!-- end #form -->
				
            </div><!-- end #content -->
            
            <div id="taikhoan">
                <div class="sidebarheader">
                    <p><strong>Tài khoản</strong></p>
                </div>
                <div id="taikhoancontent">
                    <p>MSSV: <strong><span id = "MSSV" style="color: red;"><?php echo $MSSV; ?></span></strong></p>
                    <p>Họ tên: <strong><?php echo $TenSV; ?></strong></p>
                    <p>Khoa: <strong><span id = "khoa" class = <?php echo $khoa; ?>><?php	
											switch($khoa)
											{
												case "mmt": 
													echo "Mạng máy tính và truyền thông";
													break;
												case "khmt": 
													echo "Khoa học máy tính";
													break;
												case "ktmt": 
													echo "Kỹ thuật máy tính";
													break;
												case "httt": 
													echo "Hệ thống thông tin";
													break;
												case "cnpm": 
													echo "Công nghệ phần mềm";
													break;
											}
										?></span></strong></p>
                    <p><a id="showchangepass" >Đổi mật khẩu</a></p>
                </div>
            </div>
            
            <div id="TKB">
                <div class="sidebarheader">
                    <p><strong>Thời khóa biểu</strong></p>
                </div><!-- end #content -->
                
                <div id="TKBcontent">
                    <table id="TKBtable" cellspacing="0">
                        <tr>
                            <th colspan="2"></th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                        </tr>
                        <tr>
                            <td rowspan="2">Sáng</td>
                            <td>ca 1</td>
							<?php
								for($thu = 2; $thu <= 7; $thu++)
								{
									$tempTKB = explode("|",$TKB[$thu - 2]);
									if($tempTKB != "")
									{
										echo "<td class='lich' id='1".$thu."' title='".$tempTKB[1]."' >".$tempTKB[0]."</td>";
									}
									else
									{
										echo "<td class='lich' id='1".$thu."' ></td>";
									}
								}
							?>
                        </tr>
                        <tr>
                            <td style="border-left: 1px solid #DCDDDE;">ca 2</td>
							<?php
								for($thu = 2; $thu <= 7; $thu++)
								{
									$tempTKB = explode("|",$TKB[$thu + 4]);
									if($tempTKB != "")
									{
										echo "<td class='lich' id='2".$thu."' title='".$tempTKB[1]."' >".$tempTKB[0]."</td>";
									}
									else
									{
										echo "<td class='lich' id='2".$thu."' ></td>";
									}
								}
							?>
                        </tr>
                        <tr>
                            <td rowspan="2">Chiều</td>
                            <td>ca 3</td>
							<?php
								for($thu = 2; $thu <= 7; $thu++)
								{
									$tempTKB = explode("|",$TKB[$thu + 10]);
									if($tempTKB != "")
									{
										echo "<td class='lich' id='3".$thu."' title='".$tempTKB[1]."' >".$tempTKB[0]."</td>";
									}
									else
									{
										echo "<td class='lich' id='3".$thu."' ></td>";
									}
								}
							?>
                        </tr>
                        <tr>
                            <td style="border-left: 1px solid #DCDDDE">ca 4</td>
							<?php
								for($thu = 2; $thu <= 7; $thu++)
								{
									$tempTKB = explode("|",$TKB[$thu + 16]);
									if($tempTKB != "")
									{
										echo "<td class='lich' id='4".$thu."' title='".$tempTKB[1]."' >".$tempTKB[0]."</td>";
									}
									else
									{
										echo "<td class='lich' id='4".$thu."' ></td>";
									}
								}
							?>
                        </tr>
                    </table>
                    <p><a id="showTKB" href="<?php echo base_url()."index/index/showTKB?MSSV=".$MSSV."&khoa=".$khoa; ?>"  target="_blank">Chi tiết ...</a></p>
                </div><!-- end #TKBcontent -->
            </div><!-- end #TKB -->
                
                <div id="mondadk">
                    <div class="sidebarheader">
                        <p><strong>Môn đã đăng ký</strong></p>
                    </div><!-- end #mondakdheader -->
                    <div id="lietkedk">
						<ol>
							<?php
								foreach($MonDK->result() as $row)
								{
									echo "<li id='mondk".$row->Malop."'>".$row->TenMH."</li>";
								}
							?>
						</ol>
                    </div><!-- end #lietkedk -->
                </div><!-- end #mondadk -->
                
                <div id="nhacnho">
                    <div class="sidebarheader">
                        <p><strong>Một số nhắc nhở</strong></p>
                    </div><!-- end #nhacnhoheader -->
                    <div id="lietkenhacnho">
                    </div><!-- end #lietkenhacnho -->
                </div><!-- end #nhacnho -->
				            
        </div><!-- end #primary -->
        
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