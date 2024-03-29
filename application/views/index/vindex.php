<!DOCTYPE HTML>
<head>
	<meta name="author" content="danhkhh" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Đăng ký học phần</title>
	<link href="<?php echo static_url();?>/css/index/dkhp.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo static_url();?>/css/index/index.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo static_url();?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo static_url();?>/js/index/vindex.js"></script>
	<script type="text/javascript" src="<?php echo static_url();?>/js/index/dkhp.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{	
			$("#contenttable tr td p.show").click(function(e)
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
						url: "<?php echo base_url()."index/getLop"; ?>",
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
						url: "<?php echo base_url()."index/changePass"; ?>",
						data: "MSSV="+MSSV+"&oldPass="+oldPass+"&newPass="+newPass,
						type: "POST",
						success:function(res) 
						{
							if(res=="OK")
							{
								window.location.assign("<?php echo base_url()."index/logout"; ?>");
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
	<div id="monnhom">
		<div id="monnhomajax">
			<div id='mntop' >
				<div id="topQTPT" class="mnshow">Quản trị&phát triển ứng dụng mạng</div>
				<div id="topTTAN" class="mnnormal">Truyền thông& an ninh mạng</div>
				<div class="mnhide">Truyền thông& an ninh mạng</div>
			</div>
			<div id='mncontent' >
				<div id="contentQTPT" class="divmnshow">
					<table class='th' cellspacing='0'>
						<tr>
							<th>Mã lớp</th>
							<th>Tên môn học</th>
							<th>Tên giáo viên</th>
							<th>Thứ</th>
							<th>Ca</th>
							<th>Phòng</th>
							<th>Min</th>
							<th>Max</th>
							<th>SLHT</th>
							<td></td>
						</tr>
						<tr>
							<td>dđ</td>
						</tr>
					</table>
				</div>
				<div id="contentTTAN" class="divmnnormal">Truyền thông& an ninh mạng</div>
				<div class="divmnhide">Truyền thông& an ninh mạng</div>
			</div>
		</div>
		<div class="selectMN">
		</div>
		<div id='mnbottom' >
			<p>*Chú ý: chọn 1 trong các lớp do phòng đào tạo mở</p>
			<p>*Đối với môn có tín chỉ thực hành thì phải đăng ký kèm theo tín  chỉ thực hành</p>
		</div>
	</div>
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
                <li><a href="#" class="active">Trang chủ</a></li>
                <li><a href="#">Chương trình đào tạo</a></li>
                <li><a href="#">Liên kết &raquo;</a></li>
                <li><a href="#"><?php echo $MSSV; ?></a> | <a href="<?php echo base_url(); ?>index/logout">Thoát</a></li>
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
                    <li id="dkhp">   <a href="#" class="active">Đăng Ký Học Phần</a></li>
                    <li id="hd">     <a href="#">Hướng Dẫn</a></li>
                    <li id="vekq"><a href="<?php echo base_url()."ket-qua"; ?>">In Phiếu</a></li>
                </ul>
            </div><!-- end #menu -->
        
        </div><!-- end #header -->
        
        <div id="primary">
            <div id="left">
            <div id="content" class = "box">
                <div id="contentheader" class="box_header">
                    <h3>Chương trình đào tạo</h3>
                </div><!-- end #contentheader -->
                
                <div id="contenttable" class="box_data">
                    <table>
                        <tr id="first">
                            <th id="hk">Học Kỳ</th>
                            <th id="mamh">Mã Môn Học</th>
                            <th id="tenmh">Tên Môn Học</th>
                            <th id="sotc">Số TC</th>
                            <th id="tclt">TCLT</th>
                            <th id="tcth">TCTH</th>
                            <th id="diem">Điểm</th>
                            <th id="tinhtrang">Tình Trạng</th>
                            <th id="thaotac">Thao Tác</th>
                        </tr>
						<?php
							$lopdk = "";
							foreach ($ctdt->result() as $row)
							{
								$full = 200;
								$dk = 0;
								$lop = "";
								$temp = $row->MaMH;
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
								if($row->KieuMH == "NHOM")
								{
									if(substr_count($group ,$row->ID) > 0)
										echo "<tr class='lopmo'><td>";
									else 
										echo "<tr><td>";
								}
								else
								{
									if($full <= 0)
									{
										echo "<tr class='lopmo'><td>";
									}
									else
									{
										if($full < 200)
										{
											echo "<tr class='lopday'><td>";
										}
										else
										{
											echo "<tr><td>";
										}
									}
								}
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
								if($row->KieuMH == "NHOM")
								{
									if(substr_count($group ,$row->ID) > 0)
										echo "lớp mở</td>";
									else 
										echo "</td>";
								}
								else
								{
									if($full <= 0)
									{
										echo "lớp mở</td>";
									}
									else
									{
										if($full < 200)
										{
											echo "lớp đầy</td>";
										}
										else
										{
											echo "</td>";
										}
									}
								}
								if($row->KieuMH == "NHOM")
								{
									$tclass = "showmtc";
									$lop = "";
									if($row->Loai != "TC")
										$tclass = 'showmcn';
									foreach ($lopcn->result() as $row2)
									{
										if($row->ID == $row2->ID)
										{
											$lop = $lop.$row2->MaLop;
											break;
										}
									}
									if($lop != "")
									{
										echo "<td><p id='nhom".$row->ID."' title ='".$row->MaMH."' class = '$tclass'>$lop</p></td></tr>";
									}
									else
									{
										echo "<td><p id='nhom".$row->ID."' title='".$row->MaMH."' class = '$tclass'>Chọn lớp</p></td></tr>";
									}
								}
								else
								{
									if($dk >= 200)
									{
										echo "<td><p id='showdiv".$row->MaMH."' class = 'show'>".$lop."</p></td></tr>";
									}
									else
									{
										if($dk != 0)
										{
											if($full <= 0)
												echo "<td><p id='showdiv".$row->MaMH."' class = 'show'>Chọn lớp</p></td></tr>";
											else
												if(strpos($lopdn, $row->MaMH) != null)
												{
													echo "<td>đã đề nghị mở</td></tr>";
												}
												else
													echo "<td class='".$row->MaMH."'><p class = 'denghi'>đề nghị mở<p></td></tr>";
										}
										else
										{
											if(strpos($lopdn, $row->MaMH) != null)
											{
												echo "<td>đã đề nghị mở</td></tr>";
											}
											else
												echo "<td class='".$row->MaMH."'><p class = 'denghi'>đề nghị mở<p></td></tr>";
										}
									}
								}
							}
						?>
                    </table>
                </div><!-- end #contenttable -->
				
				<div id="contenttable1">
				</div><!-- end #contenttable1 -->
				
				<div id="form">				
					<form method="POST" action="<?php echo base_url()."index/register"; ?>" >
						<input type="hidden" name="khoa" value="<?php echo $khoa; ?>" />
						<input type="hidden" name="MSSV" value="<?php echo $MSSV; ?>" />
						<input type="hidden" id="denghi" name="denghi" value="" />
						<input type="hidden" id="DKHP" name="DKHP" value="<?php echo $lopdk; ?>" />
						<a id="dangky" href="<?php echo base_url()."ket-qua"; ?>">Kết quả</a>
					</form>
				</div><!-- end #form -->
				
            </div><!-- end #content -->
            </div><!-- end #left -->
			
			<div id="right">
            <div id="taikhoan" class="box">
                <div class="box_header">
                    <h3>Thông tin cá nhân</h3>
                </div>
                <div id="taikhoancontent" class="box_data">
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
					<span id="MaCN" style="display: none;"><? echo $MaCN; ?></span>
                    <p><a id="showchangepass" >Đổi mật khẩu</a></p>
                </div>
            </div>
            
             <div id="TKB" class="box">
                <div class="box_header">
                    <h3>Thời khóa biểu</h3>
                </div><!-- end #content -->
                
                <div id="TKBcontent" class="box_data">
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
                    <p><a id="showTKB" href="<?php echo base_url()."thoi-khoa-bieu"; ?>"  target="_blank">Chi tiết ...</a></p>
                </div><!-- end #TKBcontent -->
            </div><!-- end #TKB -->
                
            <div id="mondadk" class="box">
                    <div class="box_header">
                        <h3>Môn đã đăng ký</h3>
                    </div><!-- end #mondakdheader -->
                    <div id="lietkedk" class="box_data">
						<ol>
							<?php
								foreach($MonDK->result() as $row)
								{
									echo "<li id='mondk".$row->MaMH."'>".$row->TenMH."</li>";
								}
							?>
						</ol>
						
                    </div><!-- end #lietkedk -->
					<p>Số tín chỉ: <span id = "stc" ><? echo $sotc; ?></span>/<span id = "tctd" ><? echo $TCTD; ?></span></p>
            </div><!-- end #mondadk -->
                
			</div><!-- end #right -->
				            
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