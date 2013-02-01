<!--This file is main_menu trang chu active template -->
<div id="main_menu">
	<ul>
		<li class="top first active"><a href="/trangchu">Trang chủ</a></li>
		<li class="top" ><a href="/quanly" title="Quản lý hệ thống">Quản lý&nbsp; &nbsp; <img src="<?php echo static_url(); ?>/images/arrow-down.png" /></a>
      	<ul>
				<li><a href="/quanly/sinhvien">Sinh viên &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &#187;</a>
                <?php
                echo "<ul>";
                foreach($khoa_result as $khoa_row)
                {
                    $makhoa=$khoa_row->MaKhoa;
                    $ten_khoa=$khoa_row->TenKhoa;
                    echo "<li><a href='/quanly/sinhvien/$makhoa' title='$ten_khoa'>Khoa $makhoa</a></li>";
                }
                echo "</ul>"; 
                
                ?>
                </li>
				<li><a href="/quanly/giaovien">Giáo viên</a>					
				</li>
                <li><a href="/quanly/monhoc">Môn học &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &#187;</a>
                <ul>
						<li><a href="/quanly/monhoc/DC" title="Môn học đại cương">Đại Cương</a></li>
                        <li><a href="/quanly/monhoc/CSN" title="Môn học cơ sở ngành">Cơ Sở Ngành</a></li>							
					    <li><a href="/quanly/monhoc/CN" title="Môn học chuyên ngành">Chuyên Ngành</a></li>
                        <li><a href="/quanly/monhoc/TC" title="Môn học tự chọn">Tự Chọn</a></li>
                        <li><a href="/quanly/monhoc/tuong-duong" title="Môn học tương đương">Tương đương</a></li>
                       <li><a href="/quanly/monhoc/mon-hoc-nhom" title="Môn học nhóm">Môn Học Nhóm</a></li>
				</ul>
                </li>
                <li><a href="/quanly/lophoc">Lớp học &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &#187;</a>
                 <ul>
						<li><a href="/quanly/lophoc/lop-da-mo">Lớp đã mở</a></li>	
                        <li><a href="/quanly/lophoc/lop-da-huy">Lớp đã hủy</a></li>						
					    <li><a href="/quanly/lophoc/lop-de-nghi">Lớp đề nghị</a></li>	
				</ul>
                </li>                
                <li><a href="/quanly/he-thong-diem">Hệ thống điểm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&#187;</a>
                <?php
                echo "<ul>";
                foreach($khoa_result as $khoa_row)
                {
                    $makhoa=$khoa_row->MaKhoa;
                    $ten_khoa=$khoa_row->TenKhoa;
                    echo "<li><a href='/quanly/he-thong-diem/$makhoa' title='$ten_khoa'>Khoa $makhoa</a></li>";
                }
                echo "</ul>"; 
                
                ?>
                </li>
                <li><a href="/quanly/chuong-trinh-dao-tao">Chương trình đào tạo &nbsp; &nbsp;&nbsp;&#187;</a>
                <?php
                echo "<ul>";
                foreach($khoa_result as $khoa_row)
                {
                    $makhoa=$khoa_row->MaKhoa;
                    $ten_khoa=$khoa_row->TenKhoa;
                    echo "<li><a href='/quanly/chuong-trinh-dao-tao/$makhoa' title='$ten_khoa'>Khoa $makhoa</a></li>";
                }
                echo "</ul>"; 
                
                ?>
                </li>
		</ul>		
		</li><!--end li quan ly -->
        
		<li class="top"><a  href="/thongke" title="Thống kê sơ lược">Thống Kê<img src="<?php echo static_url(); ?>/images/arrow-down.png" /></a>
        	<ul>
				<li><a href="#">Trạng thái lớp học</a></li>
                <li><a href="#">Trạng thái đăng ký</a></li>
				<li><a href="#">Trạng thái sinh viên</a></li>
                <li><a href="#">Trạng thái đào tạo</a></li>
                <li><a href="#">Kết quả học tập</a></li>
			</ul>
        </li><!--end li thong ke -->
		<li class="top"><a  href="/lienket">Liên kết &nbsp; <img src="<?php echo static_url(); ?>/images/arrow-down.png" /></a>
			<ul>
				<li><a href="http://www.daa.uit.edu.vn">Phòng Đào tạo</a></li>
                <li><a href="http://www.ctsv.uit.edu.vn">Phòng CTSV</a></li>
				<li><a href="http://gxn.uit.edu.vn">Hệ thống giấy xác nhận</a></li>
                <li><a href="http://courses.uit.edu.vn">Hệ thống Modules</a></li>
			</ul>
		</li>
		<li class="top"><a href="/cau-hinh-he-thong" title="Cấu hình hệ thống">Cấu hình</a></li>
		<li class="top"><a  href="/dieu-chinh-thong-tin" title="Thao tác thay đổi tài khoản Admin">Admin<img src="<?php echo static_url(); ?>/images/arrow-down.png" /></a>
            <ul>
				<li><a href="http://www.daa.uit.edu.vn">Thay đổi mật khẩu</a></li>
                <li><a href="<?php echo base_url(); ?>logout">Thoát</a></li>
			</ul>
        </li>
		
	</ul>
    </div><!--end main_menu -->
    
    <!--end file vmain_menu.php -->