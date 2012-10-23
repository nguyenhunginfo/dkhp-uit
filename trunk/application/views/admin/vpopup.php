<!--popup div -->
<div class="overflow"></div>
<!--=======VIEW POPUP============================================================================================== -->
<div class="popup_detail" id="view">
    <div id="pheader">
        <p id="ptitle">This is popup title here</p>
        <img id="pclose" title="Đóng" src="<?php echo static_url(); ?>/images/close.png" />        
    </div>
    <div id="pdata">
    
    </div>
    <div id="pfooter">
    <h4 title="Phát hiện lỗi"><img src="<?php echo static_url(); ?>/images/error.png" />Phát hiện lỗi trong quá trình kiểm tra dữ liệu.Thao tác chỉ thành công khi không còn lỗi</h4>
    <img id="save" title="Lưu" src="<?php echo static_url(); ?>/images/accept.png" />
    <img id="process" title="Đang kiểm tra" src="<?php echo static_url(); ?>/images/process.gif" />
    
    
    </div>
</div>
<!--=======EXPORT POPUP============================================================================================== -->
<div class="popup_detail" id="export">
    <form method="post" action="/sinhvien/xuatdl">
        <div id="pheader">
            <p id="ptitle">Thao tác xuất dữ liệu</p>
            <img id="pclose" title="Đóng" src="<?php echo static_url(); ?>/images/close.png" />        
        </div>
        
        <div id="pdata">            
                
           
        </div>
        <div id="pfooter">
        <h4 title="Phát hiện lỗi"><img src="<?php echo static_url(); ?>/images/error.png" />Phát hiện lỗi trong quá trình kiểm tra dữ liệu.Thao tác chỉ thành công khi không còn lỗi</h4>
        <input name="submit" type="image" src="<?php echo static_url(); ?>/images/accept.png" title="Đồng ý"/>
        
     </form>
    
    </div>
</div>
<!-- end popup div -->