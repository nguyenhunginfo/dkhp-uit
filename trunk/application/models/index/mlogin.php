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
	
	function TCTD()
	{
		$query = $this->db->query("SELECT GiaTri
									FROM cauhinh
									WHERE DK = 'TCTD'");
		$res = "";
		foreach($query->result() as $row)
		{
			$res = $row->GiaTri;
		}
		return $res;
	}
	
	function soTC($MSSV, $khoa)
	{
		$query = $this->db->query("SELECT SUM( SoTC ) AS tongtc
									FROM dangky_$khoa, monhoc, loplt
									WHERE dangky_$khoa.MaLop = loplt.MaLop AND loplt.MaMH = monhoc.MaMH AND MaSV =  '$MSSV'");
		$query1 = $this->db->query("SELECT SUM( SoTC ) AS tongtc
									FROM dangky_$khoa, monhoc, lopth
									WHERE dangky_$khoa.MaLop = lopth.MaLop AND lopth.MaMH = monhoc.MaMH AND MaSV =  '$MSSV'");
		$res = 0;
		foreach($query->result() as $row)
		{
			$res += $row->tongtc;
		}
		foreach($query1->result() as $row)
		{
			$res += $row->tongtc;
		}
		return $res;
	}
	
	function groupOpen($khoa, $K)
	{
		$query = $this->db->query("SELECT ctdt_$khoa.ID
									FROM ctdt_$khoa, monhoc
									WHERE ctdt_$khoa.ID = monhoc.ID AND K =$K AND KieuMH =  'nhom'
										AND MaMH IN (SELECT MaNhom
													FROM monhoc_nhom
													WHERE ID IN (SELECT ID
																FROM monhoc, loplt
																WHERE monhoc.MaMH = loplt.MaMH
																)
													)");
		$res = "";
		foreach($query->result() as $row)
		{
			$res = $res." ".$row->ID;
		}
		return $res;
	}
	
	function setCN($MSSV, $khoa, $MaCN)
	{
		$this->db->query("UPDATE sv_$khoa SET MaCN='$MaCN' WHERE MaSV='$MSSV'");
	}
	
	function dangky($MSSV, $khoa, $ins)// dk mon don, ins la chuoi chua ma lop (lt & th)
	{
		$ins = trim($ins,' ');
		if($ins == "")
			return true;
		$kq = explode(" ",$ins);		
		$lop;
		for($i = 0; $i < count($kq); $i++)
		{
			if($kq[$i] == "")
				continue;
			//coi lop day chua, neu day roi thi echo lop day va return
			if($i == 0)
				$lop = "loplt";
			else
				$lop = "lopth";
			$SLHT = $this->db->query("SELECT Max, SLHT
									FROM $lop
									WHERE MaLop='".$kq[$i]."'
								");
			
			foreach($SLHT->result() as $row)
			{
				if($row->Max == $row->SLHT)
				{
					echo "lop day";
					return false;
				}
			}
			//neu chua day thi insert bang dangky_mmt
			$this->db->query("INSERT INTO dangky_$khoa VALUES ('$MSSV', '$kq[$i]', NOW())");			
			$this->db->query("UPDATE $lop SET SLHT = SLHT + 1 WHERE MaLop='$kq[$i]'");
			return true;
		}
	}
	
	function bodangky($MSSV, $khoa, $del)// bỏ dk mon don, del la chuoi chua ma lop (lt & th)
	{
		$del = trim($del,' ');
		if($del == "")
			return;
		$kq = explode(" ",$del);		
		$lop;
		for($i = 0; $i < count($kq); $i++)
		{
			if($kq[$i] == "")
				continue;
			//coi lop day chua, neu day roi thi echo lop day va return
			if($i == 0)
				$lop = "loplt";
			else
				$lop = "lopth";
			$this->db->query("DELETE FROM dangky_$khoa WHERE MaSV='$MSSV' AND MaLop='$kq[$i]'");
			$this->db->query("UPDATE $lop SET SLHT = SLHT - 1 WHERE MaLop='$kq[$i]'");			
		}		
	}
	
	function ins($MSSV, $khoa, $IDnhom, $ins)// dk mon nhom, ins la chuoi chua ma lop (lt & th)
	{
		$ins = trim($ins,' ');
		if($ins == "")
			return true;
		$kq = explode(" ",$ins);
		$lop;
		for($i = 0; $i < count($kq); $i++)
		{
			if($kq[$i] == "")
				continue;
			//coi lop day chua, neu day roi thi echo lop day va return
			if($i == 0)
				$lop = "loplt";
			else
				$lop = "lopth";
			$SLHT = $this->db->query("SELECT Max, SLHT
									FROM $lop
									WHERE MaLop='".$kq[$i]."'
								");
			
			foreach($SLHT->result() as $row)
			{
				if($row->Max == $row->SLHT)
				{
					echo "lop day";
					return false;
				}
			}
			//neu chua day thi insert bang dangky_mmt
			$this->db->query("INSERT INTO dangky_$khoa VALUES ('$MSSV', '$kq[$i]', NOW())");			
			$this->db->query("UPDATE $lop SET SLHT = SLHT + 1 WHERE MaLop='$kq[$i]'");
			//insert bang dkcn MaSV, IDnhom, IDmon, MaLop
			$this->db->query("INSERT INTO dkcn(MaSV, IDnhom, MaLop) VALUES ('$MSSV', $IDnhom, '$kq[$i]')");
			return true;
		}
	}
	
	function del($MSSV, $khoa, $IDnhom, $del)// dk mon nhom, ins la chuoi chua ma lop (lt & th)
	{		
		$del = trim($del,' ');
		if($del == "")
			return true;
		$kq = explode(" ",$del);
		$lop;
		for($i = 0; $i < count($kq); $i++)
		{
			if($i == 0)
				$lop = "loplt";
			else
				$lop = "lopth";
			//delete bang dangky_mmt DELETE FROM `loplt` WHERE 1
			$this->db->query("DELETE FROM dangky_$khoa WHERE MaSV='$MSSV' AND MaLop='$kq[$i]'");
			$this->db->query("UPDATE $lop SET SLHT = SLHT - 1 WHERE MaLop='$kq[$i]'");
			//insert bang dkcn MaSV, IDnhom, IDmon, MaLop
			$this->db->query("DELETE FROM dkcn WHERE MaSV='$MSSV' AND MaLop='$kq[$i]'");
		}
		$SLM = $this->db->query("SELECT *
									FROM dkcn
									WHERE MaSV='$MSSV'
								");
		if($SLM->num_rows() > 0)
		{
			return true;
		}
		$this->db->query("UPDATE sv_$khoa SET MaCN='' WHERE MaSV='$MSSV'");
		return false;
	}
	
	function tenCN($khoa, $K, $MaCN)
	{
		$query = $this->db->query("SELECT MaCN, TenCN
									FROM chuyennganh
									WHERE MaKhoa='$khoa' AND MaK=$K");
		echo "<div id='mntop' >";
		if($MaCN != "")
		{			
			foreach ($query->result() as $row)
			{
				if($row->MaCN == $MaCN)
				{
					echo "<div id='top".$row->MaCN."' class='mnshow'>".$row->TenCN."</div>";
					continue;
				}
				echo "<div class='mnhide'>".$row->TenCN."</div>";
			}
			echo "</div>";
			return;
		}
		$i = 0;
		foreach ($query->result() as $row)
		{
			if($i == 0)
			{
				echo "<div id='top".$row->MaCN."' class='mnshow'>".$row->TenCN."</div>";
				$i++;
				continue;
			}
			echo "<div id='top".$row->MaCN."' class='mnnormal'>".$row->TenCN."</div>";
		}
		echo "</div>";
	}

	function lopCNAll($khoa, $K, $ID)
	{
		$query = $this->db->query("SELECT MaCN
									FROM chuyennganh
									WHERE MaKhoa='$khoa' AND MaK=$K");
		echo "<div style='display:none;'><div id='idnhom'>$ID</div><div id='ltold'></div><div id='ltnew'></div><div id='thold'></div><div id='thnew'></div></div>";
		echo "<div id='mncontent'>";
		$i = 0;
		$s = "divmnnormal";
		foreach ($query->result() as $row)//đối với mỗi chuyên ngành.
		{
			$loplt = $this->db->query("SELECT * 
										FROM loplt, monhoc, giaovien
										WHERE loplt.MaMH = monhoc.MaMH AND loplt.MaGV = giaovien.MaGV
										AND ID IN (SELECT ID
													FROM moncn
													WHERE MaCN = '".$row->MaCN."'
													)");
			$lopth = $this->db->query("SELECT * 
										FROM lopth, monhoc, giaovien
										WHERE lopth.MaMH = monhoc.MaMH AND lopth.MaGV = giaovien.MaGV
										AND ID IN (SELECT ID
													FROM moncn
													WHERE MaCN = '".$row->MaCN."'
													)");
			if($i == 0)
			{
				$s = "divmnshow";
			}
			else
			{
				$s = "divmnnormal";
			}
			echo "<div id='content".$row->MaCN."' class='".$s."'>";
			// bảng lớp lý thuyết
			if($loplt->num_rows() <= 0)
			{
				echo "<p>Không có lớp</p></div>";
				continue;
			}
			
			echo "<p>Lớp lý thuyết</p>";
			echo "<table class='lt' cellspacing='0'>
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
				echo $row->MaLop."</td>";
				echo "<td class='TenMH'>".$row->TenMH."</td>";
				echo "<td class='TenGV'>".$row->TenGV."</td>";
				echo "<td class='thu'>".$row->Thu."</td>";
				echo "<td class='ca'>".$row->Ca."</td>";
				echo "<td class='Phong'>".$row->Phong."</td>";
				echo "<td>".$row->Min."</td>";
				echo "<td>".$row->Max."</td>";
				echo "<td"; if($full == 1) echo " style='border-right: 2px solid #DCDDDF;'"; echo ">".$row->SLHT."</td>";
				echo "<td><input type='checkbox' class='cbdknlt' id='".$row->MaLop."' "; 
				if($full == 1)
					echo "disabled = 'true'";
				echo "/></td></tr>";
			}
			echo "</table>";
			//echo lớp thực hành
			if($lopth->num_rows() > 0)
			{
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
					echo "<td><input type='checkbox' class='cbdknth' id='".$row->Malop."' "; 
					if($full == 1)
						echo "disabled = 'true'";
					echo "/></td></tr>";
				}
				echo "</table>";
			}
			/////////
			echo "</div>";
			$i++;
		}
		echo "</div>";
	}
	
	function lopTCAll($khoa, $K, $ID, $MaMH)
	{
		$query = $this->db->query("SELECT MaCN
									FROM chuyennganh
									WHERE MaKhoa='$khoa' AND MaK=$K");
		echo "<div style='display:none;'><div id='idnhom'>$ID</div><div id='ltold'></div><div id='ltnew'></div><div id='thold'></div><div id='thnew'></div></div>";
		echo "<div id='mncontent'>";
		$i = 0;
		$s = "divmnnormal";
		foreach ($query->result() as $row)//đối với mỗi chuyên ngành.
		{
			$loplt = $this->db->query("SELECT * 
										FROM loplt, monhoc, giaovien
										WHERE loplt.MaMH = monhoc.MaMH AND loplt.MaGV = giaovien.MaGV
										AND ID IN (SELECT ID FROM monhoc_nhom WHERE MaNhom = '$MaMH')
										AND ID not IN (SELECT ID FROM moncn WHERE MaCN = '".$row->MaCN."')");
										
			$lopth = $this->db->query("SELECT * 
										FROM lopth, monhoc, giaovien
										WHERE lopth.MaMH = monhoc.MaMH AND lopth.MaGV = giaovien.MaGV
										AND ID IN (SELECT ID FROM monhoc_nhom WHERE MaNhom = '$MaMH')
										AND ID not IN (SELECT ID FROM moncn WHERE MaCN = '".$row->MaCN."')");
			if($i == 0)
			{
				$s = "divmnshow";
			}
			else
			{
				$s = "divmnnormal";
			}
			echo "<div id='content".$row->MaCN."' class='".$s."'>";
			if($loplt->num_rows <= 0)
			{
				echo "<p>Không có lớp</p></div>";
				continue;
			}
			// bảng lớp lý thuyết
			echo "<p>Lớp lý thuyết</p>";
			echo "<table class='lt' cellspacing='0'>
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
				echo $row->MaLop."</td>";
				echo "<td class='TenMH'>".$row->TenMH."</td>";
				echo "<td class='TenGV'>".$row->TenGV."</td>";
				echo "<td class='thu'>".$row->Thu."</td>";
				echo "<td class='ca'>".$row->Ca."</td>";
				echo "<td class='Phong'>".$row->Phong."</td>";
				echo "<td>".$row->Min."</td>";
				echo "<td>".$row->Max."</td>";
				echo "<td"; if($full == 1) echo " style='border-right: 2px solid #DCDDDF;'"; echo ">".$row->SLHT."</td>";
				echo "<td><input type='checkbox' class='cbdknlt' id='".$row->MaLop."' "; 
				if($full == 1)
					echo "disabled = 'true'";
				echo "/></td></tr>";
			}
			echo "</table>";
			//echo lớp thực hành
			if($lopth->num_rows() > 0)
			{
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
					echo "<td><input type='checkbox' class='cbdknth' id='".$row->Malop."' "; 
					if($full == 1)
						echo "disabled = 'true'";
					echo "/></td></tr>";
				}
				echo "</table>";
			}
			/////////
			echo "</div>";
			$i++;
		}
		echo "</div>";
	}
	
	function lopCN($MSSV, $MaCN, $IDnhom)
	{
	   //echo $MaCN;
       
		$loplt = $this->db->query("SELECT loplt.MaMH, TenMH, SoTC, TCLT, TCTH, TenGV, loplt.MaLop, Phong, Thu, Ca, Min, Max, SLHT, MaSV
								FROM monhoc, giaovien, loplt LEFT JOIN dkcn ON loplt.MaLop = dkcn.MaLop AND dkcn.MaSV = '$MSSV'
								WHERE loplt.MaGV = giaovien.MaGV AND loplt.MaMH = monhoc.MaMH 
									AND ID IN (SELECT ID FROM moncn WHERE MaCN = '$MaCN')
									AND loplt.MaMH not IN (SELECT MaMH FROM loplt, dkcn WHERE loplt.MaLop = dkcn.MaLop 
									AND MaSV='$MSSV' AND IDnhom != $IDnhom)");
		$lopth = $this->db->query("SELECT lopth.MaMH, TenMH, SoTC, TCLT, TCTH, TenGV, lopth.MaLop, Phong, Thu, Ca, Min, Max, SLHT, MaSV 
								FROM monhoc, giaovien, lopth LEFT JOIN dkcn ON lopth.MaLop = dkcn.MaLop AND dkcn.MaSV = '$MSSV'
								WHERE lopth.MaGV = giaovien.MaGV AND lopth.MaMH = monhoc.MaMH 
									AND ID IN (SELECT ID FROM moncn WHERE MaCN = '$MaCN')
									AND lopth.MaMH not IN (SELECT MaMH FROM lopth, dkcn WHERE lopth.MaLop = dkcn.MaLop 
        																	AND MaSV='$MSSV' AND IDnhom != $IDnhom)");
                                                                            
       // print_r($loplt->result_object());  
                                                                                 
                                                                          
		$ltold = "";
		$thold = "";
		echo "<div id='mncontent'>";
		echo "<div id='content".$MaCN."' class='divmnshow'>";
		if($loplt->num_rows <= 0)
		{
			echo "<p>Không có lớp</p></div>";
			return;
		}
			// bảng lớp lý thuyết
		echo "<p>Lớp lý thuyết</p>";
		echo "<table class='lt' cellspacing='0'>
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
			echo $row->MaLop."</td>";
			echo "<td class='TenMH'>".$row->TenMH."</td>";
			echo "<td class='TenGV'>".$row->TenGV."</td>";
			echo "<td class='thu'>".$row->Thu."</td>";
			echo "<td class='ca'>".$row->Ca."</td>";
			echo "<td class='Phong'>".$row->Phong."</td>";
			echo "<td>".$row->Min."</td>";
			echo "<td>".$row->Max."</td>";
			echo "<td"; if($full == 1) echo " style='border-right: 2px solid #DCDDDF;'"; echo ">".$row->SLHT."</td>";
			echo "<td><input type='checkbox' class='cbdknlt' id='".$row->MaLop."' "; 
			if($row->MaSV != null)
			{
				echo "checked = 'true' ";
				$ltold = $row->MaLop;
			}
			else
			{
				if($full == 1)
					echo "disabled = 'true'";
			}
			echo "/></td></tr>";
		}
		echo "</table>";
		if($lopth->num_rows() > 0)
		{
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
				echo "<td class='Malop'>".$row->MaLop."</td>";
				echo "<td class='TenMH'>".$row->TenMH."</td>";
				echo "<td class='TenGV'>".$row->TenGV."</td>";
				echo "<td class='thu'>".$row->Thu."</td>";
				echo "<td class='ca'>".$row->Ca."</td>";
				echo "<td class='Phong'>".$row->Phong."</td>";
				echo "<td>".$row->Min."</td>";
				echo "<td>".$row->Max."</td>";
				echo "<td>".$row->SLHT."</td>";
				echo "<td><input type='checkbox' class='cbdknth' id='".$row->Malop."' "; 
				if($row->MaSV != null)
				{
					echo "checked = 'true' ";
					$thold = $row->MaLop;
				}
				else
				{
					if($full == 1)
						echo "disabled = 'true'";
				}
					echo "/></td></tr>";
			}
			echo "</table>";
		}
		echo "<div style='display:none;'><div id='idnhom'>$IDnhom</div><div id='ltold'>$ltold</div><div id='ltnew'>$ltold</div><div id='thold'>$thold</div><div id='thnew'>$thold</div></div>";
		echo "</div>";
        
	}
	
	function lopTC($MSSV, $MaCN, $IDnhom, $MaMH)
	{
		$loplt = $this->db->query("SELECT loplt.MaMH, TenMH, SoTC, TCLT, TCTH, TenGV, loplt.MaLop, Phong, Thu, Ca, Min, Max, SLHT, MaSV
								FROM monhoc, giaovien, loplt LEFT JOIN dkcn ON loplt.MaLop = dkcn.MaLop AND dkcn.MaSV = '$MSSV'
								WHERE loplt.MaMH = monhoc.MaMH AND loplt.MaGV = giaovien.MaGV
										AND ID IN (SELECT ID FROM monhoc_nhom WHERE MaNhom = '$MaMH')
										AND ID not IN (SELECT ID FROM moncn WHERE MaCN = '".$MaCN."')
										AND loplt.MaMH not IN (SELECT MaMH FROM dkcn, loplt WHERE loplt.MaLop=dkcn.MaLop AND MaSV='$MSSV' AND IDnhom != $IDnhom)");
		$lopth = $this->db->query("SELECT lopth.MaMH, TenMH, SoTC, TCLT, TCTH, TenGV, lopth.MaLop, Phong, Thu, Ca, Min, Max, SLHT, MaSV 
								FROM monhoc, giaovien, lopth LEFT JOIN dkcn ON lopth.MaLop = dkcn.MaLop AND dkcn.MaSV = '$MSSV'
								WHERE lopth.MaMH = monhoc.MaMH AND lopth.MaGV = giaovien.MaGV
										AND ID IN (SELECT ID FROM monhoc_nhom WHERE MaNhom = '$MaMH')
										AND ID not IN (SELECT ID FROM moncn WHERE MaCN = '".$MaCN."')
										AND lopth.MaMH not IN (SELECT MaMH FROM dkcn, lopth WHERE lopth.MaLop=dkcn.MaLop AND MaSV='$MSSV' AND IDnhom != $IDnhom)");
		$ltold = "";
		$thold = "";
		echo "<div id='mncontent'>";
		echo "<div id='content".$MaCN."' class='divmnshow'>";
		if($loplt->num_rows <= 0)
		{
			echo "<p>Không có lớp</p></div>";
			return;
		}
			// bảng lớp lý thuyết
		echo "<p>Lớp lý thuyết</p>";
		echo "<table class='lt' cellspacing='0'>
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
			echo $row->MaLop."</td>";
			echo "<td class='TenMH'>".$row->TenMH."</td>";
			echo "<td class='TenGV'>".$row->TenGV."</td>";
			echo "<td class='thu'>".$row->Thu."</td>";
			echo "<td class='ca'>".$row->Ca."</td>";
			echo "<td class='Phong'>".$row->Phong."</td>";
			echo "<td>".$row->Min."</td>";
			echo "<td>".$row->Max."</td>";
			echo "<td"; if($full == 1) echo " style='border-right: 2px solid #DCDDDF;'"; echo ">".$row->SLHT."</td>";
			echo "<td><input type='checkbox' class='cbdknlt' id='".$row->MaLop."' "; 
			if($row->MaSV != null)
			{
				echo "checked = 'true' ";
				$ltold = $row->MaLop;
			}
			else
			{
				if($full == 1)
					echo "disabled = 'true'";
			}
			echo "/></td></tr>";
		}
		echo "</table>";
		if($lopth->num_rows() > 0)
		{
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
				echo "<td class='Malop'>".$row->MaLop."</td>";
				echo "<td class='TenMH'>".$row->TenMH."</td>";
				echo "<td class='TenGV'>".$row->TenGV."</td>";
				echo "<td class='thu'>".$row->Thu."</td>";
				echo "<td class='ca'>".$row->Ca."</td>";
				echo "<td class='Phong'>".$row->Phong."</td>";
				echo "<td>".$row->Min."</td>";
				echo "<td>".$row->Max."</td>";
				echo "<td>".$row->SLHT."</td>";
				echo "<td><input type='checkbox' class='cbdknth' id='".$row->MaLop."' "; 
				if($row->MaSV != null)
				{
					echo "checked = 'true' ";
					$thold = $row->MaLop;
				}
				else
				{
					if($full == 1)
						echo "disabled = 'true'";
				}
					echo "/></td></tr>";
			}
			echo "</table>";
		}
		echo "<div style='display:none;'><div id='idnhom'>$IDnhom</div><div id='ltold'>$ltold</div><div id='ltnew'>$ltold</div><div id='thold'>$thold</div><div id='thnew'>$thold</div></div>";
		echo "</div>";
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
	
	function getK($MSSV, $khoa)//lấy Khóa và Mã chuyên ngành
	{
		$query = $this->db->query("SELECT K, MaCN
									FROM sv_".$khoa."
									WHERE MaSV=$MSSV");
		foreach ($query->result() as $row)
		{
			return $row->K."|".$row->MaCN;
		}
	}
	
	function getCN($MaCN)
	{
		$query = $this->db->query("SELECT TenCN
									FROM chuyennganh
									WHERE MaCN='$MaCN'");
		foreach ($query->result() as $row)
		{
			return $row->TenCN;
		}
	}
	
	function getCtdtMMT($MSSV, $K)
	{
		$query = $this->db->query("SELECT ctdt_mmt.HK, monhoc.MaMH, TenMH, SoTC, TCLT, TCTH, Diem, KieuMH, monhoc.ID, Loai
									FROM monhoc, ctdt_mmt LEFT JOIN diem_mmt ON ctdt_mmt.ID = diem_mmt.ID  AND diem_mmt.MaSV = '".$MSSV."'
									WHERE ctdt_mmt.ID = monhoc.ID AND K=$K
									ORDER BY ctdt_mmt.HK");
		return $query;
	}
	
	function getCtdtKHMT($MSSV, $K)
	{
		$query = $this->db->query("SELECT ctdt_khmt.HK, ctdt_khmt.MaMH, TenMH, SoTC, TCLT, TCTH, Diem 
									FROM monhoc, ctdt_khmt LEFT JOIN diem_khmt ON ctdt_khmt.ID = diem_khmt.ID  AND diem_khmt.MaSV = '".$MSSV."'
									WHERE ctdt_khmt.ID = monhoc.ID AND K=$K
									ORDER BY ctdt_khmt.HK");
		return $query;
	}
	
	function getCtdtKTMT($MSSV, $K)
	{
		$query = $this->db->query("SELECT ctdt_khmt.HK, ctdt_khmt.MaMH, TenMH, SoTC, TCLT, TCTH, Diem 
									FROM monhoc, ctdt_khmt LEFT JOIN diem_khmt ON ctdt_khmt.ID = diem_khmt.ID  AND diem_khmt.MaSV = '".$MSSV."'
									WHERE ctdt_khmt.ID = monhoc.ID AND K=$K
									ORDER BY ctdt_khmt.HK");
		return $query;
	}
	
	function getCtdtCNPM($MSSV, $K)
	{
		$query = $this->db->query("SELECT ctdt_cnpm.HK, ctdt_cnpm.MaMH, TenMH, SoTC, TCLT, TCTH, Diem 
									FROM monhoc, ctdt_cnpm LEFT JOIN diem_cnpm ON ctdt_cnpm.ID = diem_cnpm.ID  AND diem_cnpm.MaSV = '".$MSSV."'
									WHERE ctdt_cnpm.ID = monhoc.ID AND K=$K
									ORDER BY ctdt_cnpm.HK");
		return $query;
	}
	
	function getCtdtHTTT($MSSV, $K)
	{
		$query = $this->db->query("SELECT ctdt_httt.HK, ctdt_httt.MaMH, TenMH, SoTC, TCLT, TCTH, Diem 
									FROM monhoc, ctdt_httt LEFT JOIN diem_httt ON ctdt_httt.ID = diem_httt.ID  AND diem_httt.MaSV = '".$MSSV."'
									WHERE ctdt_httt.ID = monhoc.ID AND K=$K
									ORDER BY ctdt_httt.HK");
		return $query;
	}
	
	function getlopCN($MSSV, $K, $khoa)
	{
		$query = $this->db->query("SELECT ctdt_$khoa.ID, dkcn.MaLop
									FROM ctdt_mmt, dkcn
									WHERE K =$K AND MaSV = '$MSSV' AND ctdt_$khoa.ID = dkcn.IDnhom");
		return $query;
	}
	
	function getlopltMMT($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_mmt ON loplt.Malop = dangky_mmt.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_mmt, monhoc
									WHERE ctdt_mmt.ID = monhoc.ID
									)");
		return $query;
	}
	
	function getlopltKHMT($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_khmt ON loplt.Malop = dangky_khmt.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_khmt, monhoc
									WHERE ctdt_khmt.ID = monhoc.ID
									)");
		return $query;
	}
	
	function getlopltKTMT($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_ktmt ON loplt.Malop = dangky_ktmt.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_ktmt, monhoc
									WHERE ctdt_ktmt.ID = monhoc.ID
									)");
		return $query;
	}
	
	function getlopltHTTT($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_httt ON loplt.Malop = dangky_httt.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_httt, monhoc
									WHERE ctdt_httt.ID = monhoc.ID
									)");
		return $query;
	}
	
	function getlopltCNPM($MSSV)
	{
		$query = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Max, SLHT, MaSV
									FROM giaovien, monhoc, loplt LEFT JOIN dangky_cnpm ON loplt.Malop = dangky_cnpm.Malop AND MaSV = '".$MSSV."'
									WHERE monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
									FROM ctdt_cnpm, monhoc
									WHERE ctdt_cnpm.ID = monhoc.ID
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
										FROM ctdt_mmt, monhoc
										WHERE ctdt_mmt.ID = monhoc.ID
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_mmt ON lopth.Malop = dangky_mmt.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_mmt, monhoc
										WHERE ctdt_mmt.ID = monhoc.ID
										)");
				break;
			case "khmt":
				$loplt = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, loplt LEFT JOIN dangky_khmt ON loplt.Malop = dangky_khmt.Malop AND MaSV = '".$MSSV."'
										WHERE loplt.MaMH = '".$MaMH."' AND monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
										FROM ctdt_khmt, monhoc
										WHERE ctdt_khmt.ID = monhoc.ID
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_khmt ON lopth.Malop = dangky_khmt.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_khmt, monhoc
										WHERE ctdt_khmt.ID = monhoc.ID
										)");
				break;
			case "ktmt":
				$loplt = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, loplt LEFT JOIN dangky_ktmt ON loplt.Malop = dangky_ktmt.Malop AND MaSV = '".$MSSV."'
										WHERE loplt.MaMH = '".$MaMH."' AND monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
										FROM ctdt_ktmt, monhoc
										WHERE ctdt_ktmt.ID = monhoc.ID
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_ktmt ON lopth.Malop = dangky_ktmt.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_ktmt, monhoc
										WHERE ctdt_ktmt.ID = monhoc.ID
										)");
				break;
			case "httt":
				$loplt = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, loplt LEFT JOIN dangky_httt ON loplt.Malop = dangky_httt.Malop AND MaSV = '".$MSSV."'
										WHERE loplt.MaMH = '".$MaMH."' AND monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
										FROM ctdt_httt, monhoc
										WHERE ctdt_httt.ID = monhoc.ID
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_httt ON lopth.Malop = dangky_httt.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_httt, monhoc
										WHERE ctdt_httt.ID = monhoc.ID
										)");
				break;
			case "cnpm":
				$loplt = $this->db->query("SELECT loplt.Malop, loplt.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, loplt LEFT JOIN dangky_cnpm ON loplt.Malop = dangky_cnpm.Malop AND MaSV = '".$MSSV."'
										WHERE loplt.MaMH = '".$MaMH."' AND monhoc.MaMH = loplt.MaMH AND giaovien.MaGV = loplt.MaGV AND loplt.MaMH IN ( SELECT MaMH
										FROM ctdt_cnpm, monhoc
										WHERE ctdt_cnpm.ID = monhoc.ID
										)");
				$lopth = $this->db->query("SELECT lopth.Malop, lopth.MaMH, TenMH, TenGV, Thu, Ca, Phong, Min, Max, SLHT, MaSV
										FROM giaovien, monhoc, lopth LEFT JOIN dangky_cnpm ON lopth.Malop = dangky_cnpm.Malop AND MaSV = '".$MSSV."'
										WHERE lopth.MaMH = '".$MaMH."' AND monhoc.MaMH = lopth.MaMH AND giaovien.MaGV = lopth.MaGV AND lopth.MaMH IN ( SELECT MaMH
										FROM ctdt_cnpm, monhoc
										WHERE ctdt_cnpm.ID = monhoc.ID
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
			echo "<div class='select'><p title='$Maloplt' id='".$Maloplt."' class='lt' style='display:none;' >".$sllt."</p><p class='th' style='display:none;' >-1</p></div>";
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
		echo "<div id='selectdiv".$MaMH."' class='select'><p title='$Maloplt' id='".$Maloplt."' class='lt' style='display:none;' >".$sllt."</p><p title='$Malopth' id='".$Malopth."' class='th' style='display:none;' >".$slth."</p></div>";//$slth."</p></div>";
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
	
	function updateTKB($TKB)
	{
		echo '<tr><th colspan="2"></th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th></tr><tr><td rowspan="2">Sáng</td><td>ca 1</td>';
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
		echo '</tr><tr><td style="border-left: 1px solid #DCDDDE;">ca 2</td>';
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
		echo '</tr><tr><td rowspan="2">Chiều</td><td>ca 3</td>';
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
		echo ' </tr><tr><td style="border-left: 1px solid #DCDDDE">ca 4</td>';
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
		echo '</tr>';
	}
	
	function IsRegisterred($MSSV, $khoa)//Đã đk hay chưa?
	{
		$res = '0';
		$query = $this->db->query("SELECT dangky_".$khoa.".Malop
									FROM dangky_".$khoa."
									WHERE MaSV='$MSSV'");
		if($query->num_rows()>0)
			$res='1';
		return $res;
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
		
		$query = $this->db->query("SELECT TenMH, loplt.MaMH, SoTC, loplt.Malop, Phong, Thu, Ca, TenGV
									FROM ".$dangky.", loplt, monhoc, giaovien
									WHERE MaSV='".$MSSV."' AND ".$dangky.".Malop = loplt.Malop AND loplt.MaMH = monhoc.MaMH AND giaovien.MaGV = loplt.MaGV");
		return $query;
	}
	
	function getMonDKth($MSSV, $khoa)
	{
		$query = $this->db->query("SELECT TenMH, lopth.MaMH, SoTC, lopth.Malop, Phong, Thu, Ca, TenGV
									FROM dangky_".$khoa.", lopth, monhoc, giaovien
									WHERE MaSV='".$MSSV."' AND dangky_".$khoa.".Malop = lopth.Malop AND lopth.MaMH = monhoc.MaMH AND giaovien.MaGV = lopth.MaGV");
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