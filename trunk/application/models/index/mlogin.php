<?php

class Mlogin extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
	
	function getCaptcha($h, $w, $t)
	{
		$this->load->helper(array("captcha","url"));
		$vals = array(
					'img_path' => './application/static/images/captcha/',
					'img_url' => static_url().'/images/captcha/',
					'font_path' => './application/static/font/arial.ttf',
					'img_width' => $w,
					'img_height' => $h,
					'expiration' => $t
					);
		$cap = create_captcha($vals);
		return $cap;				
	}   

	function login($user, $pass)
	{		
		//return 2: ko trung user & pass
		//1: ok
		//0: tài khoan bi ban
	
		$this->db->where('Username', $user);
		$this->db->where('Password', $pass);
		$query = $this->db->get('taikhoan');
		if ($query->num_rows() == 0)
			return '2';
		foreach ($query->result() as $row)
		{
			if($row->Status == 0)
				return '0';
			else
				return '1|'.$row->Khoa;
		}
	}
	
	function getNameMMT($MSSV)
	{
		$this->load->database();
		$this->db->where('MaSV', $MSSV);
		$query = $this->db->get('SV_MMT');
		foreach ($query->result() as $row)
		{
			return $row->TenSV;
		}		
	}
	
	function getNameKHMT($MSSV)
	{
		$this->db->where('MaSV', $MSSV);
		$query = $this->db->get('SV_KHMT');
		foreach ($query->result() as $row)
		{
			return $row->TenSV;
		}		
	}
	
	function getNameKTMT($MSSV)
	{
		$this->db->where('MaSV', $MSSV);
		$query = $this->db->get('SV_KTMT');
		foreach ($query->result() as $row)
		{
			return $row->TenSV;
		}		
	}
	
	function getNameHTTT($MSSV)
	{
		$this->db->where('MaSV', $MSSV);
		$query = $this->db->get('SV_HTTT');
		foreach ($query->result() as $row)
		{
			return $row->TenSV;
		}		
	}
	
	function getNameCNPM($MSSV)
	{
		$this->db->where('MaSV', $MSSV);
		$query = $this->db->get('SV_CNPM');
		foreach ($query->result() as $row)
		{
			return $row->TenSV;
		}		
	}
	
	function getCtdtMMT($MSSV)
	{
		$query = $this->db->query("SELECT ctdt_mmt.HK, ctdt_mmt.MaMH, TenMH, SoTC, TCLT, TCTH, Diem 
									FROM monhoc, ctdt_mmt LEFT JOIN diem_mmt ON ctdt_mmt.MaMH = diem_mmt.MaMH  AND diem_mmt.MaSV = '".$MSSV."'
									WHERE ctdt_mmt.MaMH = monhoc.MaMH
									ORDER BY ctdt_mmt.HK");
		return $query;
	}
	
	function getCtdtKHMT($MSSV)
	{
		$query = $this->db->query("SELECT ctdt_khmt.HK, ctdt_khmt.MaMH, TenMH, SoTC, TCLT, TCTH, Diem 
									FROM monhoc, ctdt_khmt LEFT JOIN diem_khmt ON ctdt_khmt.MaMH = diem_khmt.MaMH  AND diem_khmt.MaSV = '".$MSSV."'
									WHERE ctdt_khmt.MaMH = monhoc.MaMH
									ORDER BY ctdt_khmt.HK");
		return $query;
	}
	
	function getCtdtKTMT($MSSV)
	{
		$query = $this->db->query("SELECT ctdt_khmt.HK, ctdt_khmt.MaMH, TenMH, SoTC, TCLT, TCTH, Diem 
									FROM monhoc, ctdt_khmt LEFT JOIN diem_khmt ON ctdt_khmt.MaMH = diem_khmt.MaMH  AND diem_khmt.MaSV = '".$MSSV."'
									WHERE ctdt_khmt.MaMH = monhoc.MaMH
									ORDER BY ctdt_khmt.HK");
		return $query;
	}
	
	function getCtdtCNPM($MSSV)
	{
		$query = $this->db->query("SELECT ctdt_cnpm.HK, ctdt_cnpm.MaMH, TenMH, SoTC, TCLT, TCTH, Diem 
									FROM monhoc, ctdt_cnpm LEFT JOIN diem_cnpm ON ctdt_cnpm.MaMH = diem_cnpm.MaMH  AND diem_cnpm.MaSV = '".$MSSV."'
									WHERE ctdt_cnpm.MaMH = monhoc.MaMH
									ORDER BY ctdt_cnpm.HK");
		return $query;
	}
	
	function getCtdtHTTT($MSSV)
	{
		$query = $this->db->query("SELECT ctdt_httt.HK, ctdt_httt.MaMH, TenMH, SoTC, TCLT, TCTH, Diem 
									FROM monhoc, ctdt_httt LEFT JOIN diem_httt ON ctdt_httt.MaMH = diem_httt.MaMH  AND diem_httt.MaSV = '".$MSSV."'
									WHERE ctdt_httt.MaMH = monhoc.MaMH
									ORDER BY ctdt_httt.HK");
		return $query;
	}
	
	function getlopltMMT($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_mmt ON loplt.Malop = dangky_mmt.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_mmt
									)");
		return $query;
	}
	
	function getlopltKHMT($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_khmt ON loplt.Malop = dangky_khmt.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_khmt
									)");
		return $query;
	}
	
	function getlopltKTMT($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_ktmt ON loplt.Malop = dangky_ktmt.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_ktmt
									)");
		return $query;
	}
	
	function getlopltHTTT($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_httt ON loplt.Malop = dangky_httt.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_httt
									)");
		return $query;
	}
	
	function getlopltCNPM($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_cnpm ON loplt.Malop = dangky_cnpm.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_cnpm
									)");
		return $query;
	}
	
	function getlopthMMT($MSSV)//Malop, MaMH
	{
		$query = $this->db->query("SELECT dangky_mmt.Malop, lopth.MaMH
									FROM lopth, dangky_mmt
									WHERE lopth.Malop = dangky_mmt.Malop AND MaSV='".$MSSV."'
								");
		return $query;
	}
	
	function getlopthKHMT($MSSV)
	{
		$query = $this->db->query("SELECT dangky_khmt.Malop, MaMH
									FROM lopth, dangky_khmt
									WHERE lopth.Malop = dangky_khmt.Malop and MaSV='".$MSSV."'
								");
		return $query;
	}
	
	function getlopthKTMT($MSSV)
	{
		$query = $this->db->query("SELECT dangky_ktmt.Malop, MaMH
									FROM lopth, dangky_ktmt
									WHERE lopth.Malop = dangky_ktmt.Malop and MaSV='".$MSSV."'
								");
		return $query;
	}
	
	function getlopthHTTT($MSSV)
	{
		$query = $this->db->query("SELECT dangky_httt.Malop, MaMH
									FROM lopth, dangky_httt
									WHERE lopth.Malop = dangky_httt.Malop and MaSV='".$MSSV."'
								");
		return $query;
	}
	
	function getlopthCNPM($MSSV)
	{
		$query = $this->db->query("SELECT dangky_cnpm.Malop, MaMH
									FROM lopth, dangky_cnpm
									WHERE lopth.Malop = dangky_cnpm.Malop and MaSV='".$MSSV."'
								");
	}
	
	function getLop($MaMH, $MSSV, $khoa)
	{
		switch($khoa)
		{
			case "mmt":
				$loplt = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, loplt LEFT JOIN dangky_mmt ON loplt.Malop = dangky_mmt.Malop AND MaSV = '".$MSSV."'
										WHERE loplt.MaMH = '".$MaMH."' AND monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
										FROM ctdt_mmt
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_mmt ON lopth.Malop = dangky_mmt.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_mmt
										)");
				break;
			case "khmt":
				$loplt = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, loplt LEFT JOIN dangky_khmt ON loplt.Malop = dangky_khmt.Malop AND MaSV = '".$MSSV."'
										WHERE loplt.MaMH = '".$MaMH."' AND monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
										FROM ctdt_khmt
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_khmt ON lopth.Malop = dangky_khmt.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_khmt
										)");
				break;
			case "ktmt":
				$loplt = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, loplt LEFT JOIN dangky_ktmt ON loplt.Malop = dangky_ktmt.Malop AND MaSV = '".$MSSV."'
										WHERE loplt.MaMH = '".$MaMH."' AND monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
										FROM ctdt_ktmt
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_ktmt ON lopth.Malop = dangky_ktmt.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_ktmt
										)");
				break;
			case "httt":
				$loplt = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, loplt LEFT JOIN dangky_httt ON loplt.Malop = dangky_httt.Malop AND MaSV = '".$MSSV."'
										WHERE loplt.MaMH = '".$MaMH."' AND monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
										FROM ctdt_httt
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_httt ON lopth.Malop = dangky_httt.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_httt
										)");
				break;
			case "cnpm":
				$loplt = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, loplt LEFT JOIN dangky_cnpm ON loplt.Malop = dangky_cnpm.Malop AND MaSV = '".$MSSV."'
										WHERE loplt.MaMH = '".$MaMH."' AND monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
										FROM ctdt_cnpm
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_cnpm ON lopth.Malop = dangky_cnpm.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_cnpm
										)");
				break;
		}
		$sllt = 0;
		$slth = 0;
		$Maloplt = "";
		$Malopth = "";
		echo "<div class = 'class' >Chọn lớp đăng kí môn:showTenMH (".$MaMH.")</div>";
		echo "<div class='table'><p>Lớp lý thuyết</p>";
		echo "<table id='".$MaMH."' class='lt' cellspacing='0'>
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
			</tr>";
		foreach($loplt->result() as $row)
		{
			$full = 0;
			if($row->Max <= $row->SLHT)
			{
				$full = 1;
			}
			echo "<tr"; 
			if($full ==1)
				echo " class = 'full'><td style='border-left: 2px solid #DCDDDF;'>";
			else
				echo "><td class='Malop'>";
			echo $row->Malop."</td>";
			echo "<td class='TenMH'>".$row->TenMH."</td>";
			echo "<td class='TenGV'>".$row->TenGV."</td>";
			echo "<td class='thu'>".$row->Thu."</td>";
			echo "<td class='ca'>".$row->Ca."</td>";
			echo "<td class='Phong'>".$row->Phong."</td>";
			echo "<td>".$row->Min."</td>";
			echo "<td>".$row->Max."</td>";
			echo "<td"; if($full == 1) echo " style='border-right: 2px solid #DCDDDF;'"; echo ">".$row->SLHT."</td>";
			echo "<td><input type='checkbox' class='cbdangkylt' id='".$row->Malop."' "; 
			if($row->MaSV != null)
			{
				echo "checked = 'true' ";
				$Maloplt = $Maloplt.$row->Malop;
				$sllt++;
			}
			else
			{
				if($full == 1)
					echo "disabled = 'true'";
			}
			echo "/></td></tr>";
		}
		echo "</table>";
		if($lopth->num_rows() <= 0)
		{
			echo "<div class='select'><p id='".$Maloplt."' class='lt' style='display:none;' >".$sllt."</p><p class='th' style='display:none;' >-1</p></div>";
			echo "<div class = 'note' ><p>*Chú ý: chọn 1 trong các lớp do phòng đào tạo mở</p><p>*Đối với môn có tín chỉ thực hành thì phải đăng ký kèm theo tín  chỉ thực hành</p></div>";
			echo "</div>";	
			return;
		}
		echo "<p>Lớp thực hành</p>";
		echo "<table class='th' cellspacing='0'>
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
			</tr>";
		foreach($lopth->result() as $row)
		{
			echo "<tr>";
			echo "<td class='Malop'>".$row->Malop."</td>";
			echo "<td class='TenMH'>".$row->TenMH."</td>";
			echo "<td class='TenGV'>".$row->TenGV."</td>";
			echo "<td class='thu'>".$row->Thu."</td>";
			echo "<td class='ca'>".$row->Ca."</td>";
			echo "<td class='Phong'>".$row->Phong."</td>";
			echo "<td>".$row->Min."</td>";
			echo "<td>".$row->Max."</td>";
			echo "<td>".$row->SLHT."</td>";
			echo "<td><input type='checkbox' class='cbdangkyth' id='".$row->Malop."' "; 
			if($row->MaSV != null)
			{
				echo "checked = 'true' ";
				$Malopth = $Malopth.$row->Malop;
				$slth++;
			}
			else
			{
				if($full == 1)
					echo "disabled = 'true'";
			}
			echo "/></td></tr>";
		}
		echo "</table>";
		echo "<div id='selectdiv".$MaMH."' class='select'><p id='".$Maloplt."' class='lt' style='display:none;' >".$sllt."</p><p id='".$Malopth."' class='th' style='display:none;' >".$slth."</p></div>";//$slth."</p></div>";
		echo "<div class = 'note' ><p>*Chú ý: chọn 1 trong các lớp do phòng đào tạo mở</p><p>*Đối với môn có tín chỉ thực hành thì phải đăng ký kèm theo tín  chỉ thực hành</p></div>";
		echo "</div>";
	}
	
	function registerMMT($MSSV, $strNew)
	{
		$strNew = " ".$strNew;
		$query = $this->db->query("SELECT Malop
									FROM dangky_mmt
									WHERE MaSV='".$MSSV."'
								");
		$aOld = array();
		foreach($query->result() as $row)
		{
			$aOld[] = $row->Malop;
		}
		//$aOld là mảng những môn lần trước đã đăng ký, $strNew là chuỗi những môn lần này đăng ký
		//Xóa những môn trùng của 2 bên=> hủy những môn còn lại trong $aOld, đăng ký thêm những môn trong $strNew
		for($i = 0; $i<count($aOld); $i++)
		{
			$old = $aOld[$i]." ";
			if(strpos($strNew, $old)!= null)	
			{			
				//Những môn đã đăng ký lần trước, lần này giữ nguyên
				$strNew = str_replace($old, "", $strNew);	//xóa trong $strNew
				$aOld[$i] = "";						//xóa trong $aOld
			}
		}
		$tring = trim($strNew,' ');
		$kq = explode(" ",$strNew);
		//Đăng ký thêm các lớp mới đăng ký trong lần này, mã môn học được lưu trong mảng $kq
		for($i = 0; $i < count($kq); $i++)
		{
			if($kq[$i] == "") 
				continue;
			//kiểm tra số lượng hiện tại của lớp
			echo $kq[$i];
			$Max = 0;
			$SLHT = 0;
			$table = "";
			$templt = $this->db->query("SELECT Max, SLHT 
									FROM Loplt
									WHERE MaLop='$kq[$i]'");
			if($templt->num_rows() > 0)
			{
				$table = "loplt";
				foreach($templt->result() as $rowlt)
				{
					$Max = $rowlt->Max;
					$SLHT = $rowlt->SLHT;
				}
			}
			else
			{
				$table = "lopth";
				$tempth = $this->db->query("SELECT Max, SLHT 
										FROM Lopth
										WHERE MaLop='$kq[$i]'");
				foreach($tempth->result() as $rowth)
				{
					$Max = $rowth->Max;
					$SLHT = $rowth->SLHT;
				}
			}
			//cập nhật đăng ký nếu lớp chưa đầy
			if($Max > $SLHT)
			{
				$this->db->query("INSERT INTO dangky_mmt VALUES ('$MSSV', '$kq[$i]', NOW())");
				//cập nhật số lượng hiện tại của lớp
				$this->db->query("UPDATE $table SET SLHT=SLHT+1 WHERE MaLop='$kq[$i]'");
			}
			else
			{
				//
				//lớp đã đầy, thông báo cho người dùng
				//
			}
		}
		//Hủy các lớp đã đăng ký lần trước nhưng lần này hủy
		for($i = 0; $i < count($aOld); $i++)
		{
			if($aOld[$i] == "") 
				continue;
			//tìm bảng
			$templt = $this->db->query("SELECT *
									FROM Loplt
									WHERE MaLop='$aOld[$i]'");
			if($templt->num_rows() > 0)
				$table = "loplt";
			else
				$table = "lopth";
			//Xóa khỏi bảng đăng ký
			$this->db->query("DELETE FROM dangky_mmt WHERE MaSV='$MSSV' AND MaLop='$aOld[$i]'");
			//cập nhật số lượng hiện tại của lớp
			$this->db->query("UPDATE $table SET SLHT=SLHT-1 WHERE MaLop='$aOld[$i]'");
		}
	}
	
	function registerKHMT($MSSV, $strNew)
	{
		$strNew = " ".$strNew;
		$query = $this->db->query("SELECT Malop
									FROM dangky_khmt
									WHERE MaSV='".$MSSV."'
								");
		$aOld = array();
		foreach($query->result() as $row)
		{
			$aOld[] = $row->Malop;
		}
		//$aOld là mảng những môn lần trước đã đăng ký, $strNew là chuỗi những môn lần này đăng ký
		//Xóa những môn trùng của 2 bên=> hủy những môn còn lại trong $aOld, đăng ký thêm những môn trong $strNew
		for($i = 0; $i<count($aOld); $i++)
		{
			$old = $aOld[$i]." ";
			if(strpos($strNew, $old)!= null)	
			{			
				//Những môn đã đăng ký lần trước, lần này giữ nguyên
				$strNew = str_replace($old, "", $strNew);	//xóa trong $strNew
				$aOld[$i] = "";						//xóa trong $aOld
			}
		}
		$tring = trim($strNew,' ');
		$kq = explode(" ",$strNew);
		//Đăng ký thêm các lớp mới đăng ký trong lần này, mã môn học được lưu trong mảng $kq
		for($i = 0; $i < count($kq); $i++)
		{
			if($kq[$i] == "") 
				continue;
			//kiểm tra số lượng hiện tại của lớp
			echo $kq[$i];
			$Max = 0;
			$SLHT = 0;
			$table = "";
			$templt = $this->db->query("SELECT Max, SLHT 
									FROM Loplt
									WHERE MaLop='$kq[$i]'");
			if($templt->num_rows() > 0)
			{
				$table = "loplt";
				foreach($templt->result() as $rowlt)
				{
					$Max = $rowlt->Max;
					$SLHT = $rowlt->SLHT;
				}
			}
			else
			{
				$table = "lopth";
				$tempth = $this->db->query("SELECT Max, SLHT 
										FROM Lopth
										WHERE MaLop='$kq[$i]'");
				foreach($tempth->result() as $rowth)
				{
					$Max = $rowth->Max;
					$SLHT = $rowth->SLHT;
				}
			}
			//cập nhật đăng ký nếu lớp chưa đầy
			if($Max > $SLHT)
			{
				$this->db->query("INSERT INTO dangky_khmt VALUES ('$MSSV', '$kq[$i]', NOW())");
				//cập nhật số lượng hiện tại của lớp
				$this->db->query("UPDATE $table SET SLHT=SLHT+1 WHERE MaLop='$kq[$i]'");
			}
			else
			{
				//
				//lớp đã đầy, thông báo cho người dùng
				//
			}
		}
		//Hủy các lớp đã đăng ký lần trước nhưng lần này hủy
		for($i = 0; $i < count($aOld); $i++)
		{
			if($aOld[$i] == "") 
				continue;
			//tìm bảng
			$templt = $this->db->query("SELECT *
									FROM Loplt
									WHERE MaLop='$aOld[$i]'");
			if($templt->num_rows() > 0)
				$table = "loplt";
			else
				$table = "lopth";
			//Xóa khỏi bảng đăng ký
			$this->db->query("DELETE FROM dangky_khmt WHERE MaSV='$MSSV' AND MaLop='$aOld[$i]'");
			//cập nhật số lượng hiện tại của lớp
			$this->db->query("UPDATE $table SET SLHT=SLHT-1 WHERE MaLop='$aOld[$i]'");
		}
	}
	
	function registerKTMT($MSSV, $strNew)
	{
		$strNew = " ".$strNew;
		$query = $this->db->query("SELECT Malop
									FROM dangky_ktmt
									WHERE MaSV='".$MSSV."'
								");
		$aOld = array();
		foreach($query->result() as $row)
		{
			$aOld[] = $row->Malop;
		}
		//$aOld là mảng những môn lần trước đã đăng ký, $strNew là chuỗi những môn lần này đăng ký
		//Xóa những môn trùng của 2 bên=> hủy những môn còn lại trong $aOld, đăng ký thêm những môn trong $strNew
		for($i = 0; $i<count($aOld); $i++)
		{
			$old = $aOld[$i]." ";
			if(strpos($strNew, $old)!= null)	
			{			
				//Những môn đã đăng ký lần trước, lần này giữ nguyên
				$strNew = str_replace($old, "", $strNew);	//xóa trong $strNew
				$aOld[$i] = "";						//xóa trong $aOld
			}
		}
		$tring = trim($strNew,' ');
		$kq = explode(" ",$strNew);
		//Đăng ký thêm các lớp mới đăng ký trong lần này, mã môn học được lưu trong mảng $kq
		for($i = 0; $i < count($kq); $i++)
		{
			if($kq[$i] == "") 
				continue;
			//kiểm tra số lượng hiện tại của lớp
			echo $kq[$i];
			$Max = 0;
			$SLHT = 0;
			$table = "";
			$templt = $this->db->query("SELECT Max, SLHT 
									FROM Loplt
									WHERE MaLop='$kq[$i]'");
			if($templt->num_rows() > 0)
			{
				$table = "loplt";
				foreach($templt->result() as $rowlt)
				{
					$Max = $rowlt->Max;
					$SLHT = $rowlt->SLHT;
				}
			}
			else
			{
				$table = "lopth";
				$tempth = $this->db->query("SELECT Max, SLHT 
										FROM Lopth
										WHERE MaLop='$kq[$i]'");
				foreach($tempth->result() as $rowth)
				{
					$Max = $rowth->Max;
					$SLHT = $rowth->SLHT;
				}
			}
			//cập nhật đăng ký nếu lớp chưa đầy
			if($Max > $SLHT)
			{
				$this->db->query("INSERT INTO dangky_ktmt VALUES ('$MSSV', '$kq[$i]', NOW())");
				//cập nhật số lượng hiện tại của lớp
				$this->db->query("UPDATE $table SET SLHT=SLHT+1 WHERE MaLop='$kq[$i]'");
			}
			else
			{
				//
				//lớp đã đầy, thông báo cho người dùng
				//
			}
		}
		//Hủy các lớp đã đăng ký lần trước nhưng lần này hủy
		for($i = 0; $i < count($aOld); $i++)
		{
			if($aOld[$i] == "") 
				continue;
			//tìm bảng
			$templt = $this->db->query("SELECT *
									FROM Loplt
									WHERE MaLop='$aOld[$i]'");
			if($templt->num_rows() > 0)
				$table = "loplt";
			else
				$table = "lopth";
			//Xóa khỏi bảng đăng ký
			$this->db->query("DELETE FROM dangky_ktmt WHERE MaSV='$MSSV' AND MaLop='$aOld[$i]'");
			//cập nhật số lượng hiện tại của lớp
			$this->db->query("UPDATE $table SET SLHT=SLHT-1 WHERE MaLop='$aOld[$i]'");
		}
	}
	
	function registerCNPM($MSSV, $strNew)
	{
		$strNew = " ".$strNew;
		$query = $this->db->query("SELECT Malop
									FROM dangky_cnpm
									WHERE MaSV='".$MSSV."'
								");
		$aOld = array();
		foreach($query->result() as $row)
		{
			$aOld[] = $row->Malop;
		}
		//$aOld là mảng những môn lần trước đã đăng ký, $strNew là chuỗi những môn lần này đăng ký
		//Xóa những môn trùng của 2 bên=> hủy những môn còn lại trong $aOld, đăng ký thêm những môn trong $strNew
		for($i = 0; $i<count($aOld); $i++)
		{
			$old = $aOld[$i]." ";
			if(strpos($strNew, $old)!= null)	
			{			
				//Những môn đã đăng ký lần trước, lần này giữ nguyên
				$strNew = str_replace($old, "", $strNew);	//xóa trong $strNew
				$aOld[$i] = "";						//xóa trong $aOld
			}
		}
		$tring = trim($strNew,' ');
		$kq = explode(" ",$strNew);
		//Đăng ký thêm các lớp mới đăng ký trong lần này, mã môn học được lưu trong mảng $kq
		for($i = 0; $i < count($kq); $i++)
		{
			if($kq[$i] == "") 
				continue;
			//kiểm tra số lượng hiện tại của lớp
			echo $kq[$i];
			$Max = 0;
			$SLHT = 0;
			$table = "";
			$templt = $this->db->query("SELECT Max, SLHT 
									FROM Loplt
									WHERE MaLop='$kq[$i]'");
			if($templt->num_rows() > 0)
			{
				$table = "loplt";
				foreach($templt->result() as $rowlt)
				{
					$Max = $rowlt->Max;
					$SLHT = $rowlt->SLHT;
				}
			}
			else
			{
				$table = "lopth";
				$tempth = $this->db->query("SELECT Max, SLHT 
										FROM Lopth
										WHERE MaLop='$kq[$i]'");
				foreach($tempth->result() as $rowth)
				{
					$Max = $rowth->Max;
					$SLHT = $rowth->SLHT;
				}
			}
			//cập nhật đăng ký nếu lớp chưa đầy
			if($Max > $SLHT)
			{
				$this->db->query("INSERT INTO dangky_cnpm VALUES ('$MSSV', '$kq[$i]', NOW())");
				//cập nhật số lượng hiện tại của lớp
				$this->db->query("UPDATE $table SET SLHT=SLHT+1 WHERE MaLop='$kq[$i]'");
			}
			else
			{
				//
				//lớp đã đầy, thông báo cho người dùng
				//
			}
		}
		//Hủy các lớp đã đăng ký lần trước nhưng lần này hủy
		for($i = 0; $i < count($aOld); $i++)
		{
			if($aOld[$i] == "") 
				continue;
			//tìm bảng
			$templt = $this->db->query("SELECT *
									FROM Loplt
									WHERE MaLop='$aOld[$i]'");
			if($templt->num_rows() > 0)
				$table = "loplt";
			else
				$table = "lopth";
			//Xóa khỏi bảng đăng ký
			$this->db->query("DELETE FROM dangky_cnpm WHERE MaSV='$MSSV' AND MaLop='$aOld[$i]'");
			//cập nhật số lượng hiện tại của lớp
			$this->db->query("UPDATE $table SET SLHT=SLHT-1 WHERE MaLop='$aOld[$i]'");
		}
	}
	
	function registerHTTT($MSSV, $strNew)
	{
		$strNew = " ".$strNew;
		$query = $this->db->query("SELECT Malop
									FROM dangky_httt
									WHERE MaSV='".$MSSV."'
								");
		$aOld = array();
		foreach($query->result() as $row)
		{
			$aOld[] = $row->Malop;
		}
		//$aOld là mảng những môn lần trước đã đăng ký, $strNew là chuỗi những môn lần này đăng ký
		//Xóa những môn trùng của 2 bên=> hủy những môn còn lại trong $aOld, đăng ký thêm những môn trong $strNew
		for($i = 0; $i<count($aOld); $i++)
		{
			$old = $aOld[$i]." ";
			if(strpos($strNew, $old)!= null)	
			{			
				//Những môn đã đăng ký lần trước, lần này giữ nguyên
				$strNew = str_replace($old, "", $strNew);	//xóa trong $strNew
				$aOld[$i] = "";						//xóa trong $aOld
			}
		}
		$tring = trim($strNew,' ');
		$kq = explode(" ",$strNew);
		//Đăng ký thêm các lớp mới đăng ký trong lần này, mã môn học được lưu trong mảng $kq
		for($i = 0; $i < count($kq); $i++)
		{
			if($kq[$i] == "") 
				continue;
			//kiểm tra số lượng hiện tại của lớp
			echo $kq[$i];
			$Max = 0;
			$SLHT = 0;
			$table = "";
			$templt = $this->db->query("SELECT Max, SLHT 
									FROM Loplt
									WHERE MaLop='$kq[$i]'");
			if($templt->num_rows() > 0)
			{
				$table = "loplt";
				foreach($templt->result() as $rowlt)
				{
					$Max = $rowlt->Max;
					$SLHT = $rowlt->SLHT;
				}
			}
			else
			{
				$table = "lopth";
				$tempth = $this->db->query("SELECT Max, SLHT 
										FROM Lopth
										WHERE MaLop='$kq[$i]'");
				foreach($tempth->result() as $rowth)
				{
					$Max = $rowth->Max;
					$SLHT = $rowth->SLHT;
				}
			}
			//cập nhật đăng ký nếu lớp chưa đầy
			if($Max > $SLHT)
			{
				$this->db->query("INSERT INTO dangky_httt VALUES ('$MSSV', '$kq[$i]', NOW())");
				//cập nhật số lượng hiện tại của lớp
				$this->db->query("UPDATE $table SET SLHT=SLHT+1 WHERE MaLop='$kq[$i]'");
			}
			else
			{
				//
				//lớp đã đầy, thông báo cho người dùng
				//
			}
		}
		//Hủy các lớp đã đăng ký lần trước nhưng lần này hủy
		for($i = 0; $i < count($aOld); $i++)
		{
			if($aOld[$i] == "") 
				continue;
			//tìm bảng
			$templt = $this->db->query("SELECT *
									FROM Loplt
									WHERE MaLop='$aOld[$i]'");
			if($templt->num_rows() > 0)
				$table = "loplt";
			else
				$table = "lopth";
			//Xóa khỏi bảng đăng ký
			$this->db->query("DELETE FROM dangky_httt WHERE MaSV='$MSSV' AND MaLop='$aOld[$i]'");
			//cập nhật số lượng hiện tại của lớp
			$this->db->query("UPDATE $table SET SLHT=SLHT-1 WHERE MaLop='$aOld[$i]'");
		}
	}
	
	function deNghi($MSSV, $strDN)
	{		
		$strDN = trim($strDN,' ');
		$kq = explode(" ", $strDN);
		for($i=0; $i<count($kq); $i++)
		{
			if($kq[$i] == "")
				continue;
			$this->db->query("INSERT INTO denghi VALUES ('$MSSV', '$kq[$i]', NOW())");
		}
	}
	
	function getDeNghi($MSSV)
	{
		$lopdn = $this->db->query("SELECT MaMH
									FROM denghi
									WHERE MaSV='".$MSSV."'");
		$kq = " ";
		foreach($lopdn->result() as $row)
		{
			$kq = $kq.$row->MaMH." ";
		}
		return $kq;
	}
	
	function getTKB($MSSV, $khoa)
	{
		$dangky = "";
		$result = array();
		switch($khoa)
		{
			case "mmt":
				$dangky = "dangky_mmt";
				break;
			case "khmt":
				$dangky = "dangky_khmt";
				break;
			case "ktmt":
				$dangky = "dangky_ktmt";
				break;
			case "httt":
				$dangky = "dangky_httt";
				break;
			case "cnpm":
				$dangky = "dangky_cnpm";
				break;
		}
		for($ca = 1; $ca <=4; $ca++)
			for($thu = 2; $thu <=7; $thu++)
			{
				$loplt = $this->db->query("SELECT ".$dangky.".Malop, TenMH, TenGV, Phong
											FROM ".$dangky.", loplt, giaovien, monhoc
											WHERE MaSV='".$MSSV."' AND ca = ".$ca." AND thu = ".$thu." 
												AND ".$dangky.".Malop = loplt.Malop AND loplt.MaMH = monhoc.MaMH AND giaovien.MaGV = loplt.MaGV");
				$lopth = $this->db->query("SELECT ".$dangky.".Malop, TenMH, TenGV, Phong
											FROM ".$dangky.", lopth, giaovien, monhoc
											WHERE MaSV='".$MSSV."' AND ca = ".$ca." AND thu = ".$thu." 
												AND ".$dangky.".Malop = lopth.Malop AND lopth.MaMH = monhoc.MaMH AND giaovien.MaGV = lopth.MaGV");
				$tong = $loplt->num_rows() + $lopth->num_rows();
				if($tong == 0)
				{
					$temp = "|";
				}
				else
				{
					if($tong == 1)
					{
						$temp = "X|";
					}
					else
					{
						$temp = "X<sup>".$tong."</sup>|";
					}
				}
				foreach($loplt->result() as $row)
				{
					$temp = $temp.$row->Malop." ".$row->TenMH." ".$row->TenGV." P".$row->Phong."./ ";
				}
				foreach($lopth->result() as $row)
				{
					$temp = $temp.$row->Malop." TH ".$row->TenMH." ".$row->TenGV." P".$row->Phong."./ ";
				}
				$result[] = $temp;
			}
		return $result;
	}
	
	function showTKB($MSSV, $khoa)
	{
		$dangky = "";
		$result = array();
		switch($khoa)
		{
			case "mmt":
				$dangky = "dangky_mmt";
				break;
			case "khmt":
				$dangky = "dangky_khmt";
				break;
			case "ktmt":
				$dangky = "dangky_ktmt";
				break;
			case "httt":
				$dangky = "dangky_httt";
				break;
			case "cnpm":
				$dangky = "dangky_cnpm";
				break;
		}
		for($ca = 1; $ca <=4; $ca++)
			for($thu = 2; $thu <=7; $thu++)
			{
				$loplt = $this->db->query("SELECT ".$dangky.".Malop, TenMH, TenGV, Phong
											FROM ".$dangky.", loplt, giaovien, monhoc
											WHERE MaSV='".$MSSV."' AND ca = ".$ca." AND thu = ".$thu." 
												AND ".$dangky.".Malop = loplt.Malop AND loplt.MaMH = monhoc.MaMH AND giaovien.MaGV = loplt.MaGV");
				$lopth = $this->db->query("SELECT ".$dangky.".Malop, TenMH, TenGV, Phong
											FROM ".$dangky.", lopth, giaovien, monhoc
											WHERE MaSV='".$MSSV."' AND ca = ".$ca." AND thu = ".$thu." 
												AND ".$dangky.".Malop = lopth.Malop AND lopth.MaMH = monhoc.MaMH AND giaovien.MaGV = lopth.MaGV");
				if($loplt->num_rows() + $lopth->num_rows() <= 0)
				{
					$result[] = "";
					continue;
				}
				if($loplt->num_rows() + $lopth->num_rows() > 1)
				{
					$temp = "";
					foreach($loplt->result() as $row)
					{
						$temp = $temp."<p>".$row->Malop."<br>".$row->TenMH."<br>".$row->TenGV."<br>P".$row->Phong."</p>";
					}
					foreach($lopth->result() as $row)
					{
						$temp = $temp."<p class='thuchanh'>".$row->Malop."<br>TH ".$row->TenMH."<br>".$row->TenGV."<br>P".$row->Phong."</p>";
					}
				}
				else
				{
					$temp = "";
					foreach($loplt->result() as $row)
					{
						$temp = $temp."<p>".$row->Malop."<br>".$row->TenMH."<br>".$row->TenGV."<br>P".$row->Phong."</p>";
					}
					foreach($lopth->result() as $row)
					{
						$temp = $temp."<p class='thuchanh'>".$row->Malop."<br>TH ".$row->TenMH."<br>".$row->TenGV."<br>P".$row->Phong."</p>";
					}
				}
				$result[] = $temp;
			}
		return $result;
	}
	
	function getMonDK($MSSV, $khoa)
	{	
		switch($khoa)
		{
			case "mmt":
				$dangky = "dangky_mmt";
				break;
			case "khmt":
				$dangky = "dangky_khmt";
				break;
			case "ktmt":
				$dangky = "dangky_ktmt";
				break;
			case "httt":
				$dangky = "dangky_httt";
				break;
			case "cnpm":
				$dangky = "dangky_cnpm";
				break;
		}
		
		$query = $this->db->query("SELECT TenMH, loplt.MaMH, SoTC, loplt.Malop
									FROM ".$dangky.", loplt, monhoc
									WHERE MaSV='".$MSSV."' AND ".$dangky.".Malop = loplt.Malop AND loplt.MaMH = monhoc.MaMH");
		return $query;
	}
	
	function changePass($MSSV, $Pass)
	{
		$this->db->query("UPDATE taikhoan SET Password='".md5($Pass)."' WHERE Username='$MSSV'");
	}
	
	function getTenKhoa($MaKhoa)
	{
		$this->db->where('MaKhoa', $MaKhoa);
		$query = $this->db->get('khoa');
		foreach ($query->result() as $row)
		{
			return $row->TenKhoa;
		}	
	}
}

?>