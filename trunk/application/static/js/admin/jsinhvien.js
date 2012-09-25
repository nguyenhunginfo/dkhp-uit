$(document).ready(function()
{
    
    $("#data #left li li").live("click",function()
    {             
            var khoa=$(this).attr("id");
            var tenkhoa=$(this).attr("title");
            var k=$("select#khoa").val();
            var display=parseInt($("select#view_num").val());//hien thi bao nhiu?			
            var start_num=0;
			
             $("#data ul li ul").find("li.active").removeClass("active");
             $(this).addClass("active");
            
            $("#content #change_data").html("<img id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
			$.ajax(
            {
                url:"/sinhvien/ajax_full_data",
                type:"POST",  
                data:{khoa:khoa,k:k,start:start_num,limit:display},          
                success:function(result)
                {                   
                    $("#content #change_data").html(result);                    
                    if(khoa!="tatca") $("#right #tool p#data_title").html("&#187;&#187; Danh sách sinh viên khoa "+tenkhoa);
                    else    $("#right #tool p#data_title").html("&#187;&#187; Danh sách sinh viên");
                }
            });
            $("#tool #action").css("visibility","hidden");
                    
    });
    //chang k and load data again
    $("#tool select#k").change(function()
    {
        var k=$(this).val();
        
        var khoa=$("#data #left li li.active").attr("id");
        var display=parseInt($("select#view_num").val());//hien thi bao nhiu?
        $("#content #change_data").html("<img id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
        $.ajax(
        {
            url:"/sinhvien/ajax_full_data",
            type:"POST",  
            data:{khoa:khoa,k:k,start:0,limit:display},          
            success:function(result)
            {
                
                $("#content #change_data").html(result);
            }
        });
        $("#tool #action").css("visibility","hidden");
        
    });
    
    $("#tool select#view_num").live("change",function()
    {             
            var khoa=$("#data #left li li.active").attr("id");            
            var k=$("select#khoa").val();
            var display=parseInt($(this).val());//hien thi bao nhiu?			
            var start_num=0;
			
           //  alert(k+" "+khoa+" "+display+" "+start_num);            
            $("#content #change_data").html("<img id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
			$.ajax(
            {
                url:"/sinhvien/ajax_full_data",
                type:"POST",  
                data:{khoa:khoa,k:k,start:start_num,limit:display},          
                success:function(result)
                {                   
                    $("#content #change_data").html(result);                    
                    
                }
            });
            $("#tool #action").css("visibility","hidden");        
    });
    //event when you click bin image
    $("#tool img#del").click(function()
    { 
        checkbox=$("#table_data").find(":checked");
        checkbox.each(function()
        {
            //alert($(this).attr("id"));
        });
    });
    //event when you click edit image
    $("#tool img#edit").click(function()
    {
        alert("me");
    });
    //event when you click in pagination li
    $("#pagination li").live("click",function()
    {
        
            var k=$("select#khoa").val();
        
            var khoa=$("#data #left li li.active").attr("id");
            var display=parseInt($("select#view_num").val());//hien thi bao nhiu?
			var id=$(this).attr("id");
            var start_num=0;
			var current_num=$(this).parent("ul").find("li.active").attr("id");   
            
            if(id=="prev")
            {
                
               start_num= parseInt(current_num)-display ;
               // alert("id="+id+"start_num:"+start_num);
            }
            else if(id=="next")//next
            {
                start_num= parseInt(current_num)+display ;
              //  alert("id="+id+"start_num:"+start_num);
                
            }
            else start_num=parseInt(id);
                 
          
			
            $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
			$.ajax(
            {
                url:"/sinhvien/ajax_full_data",
                type:"POST",  
                data:{khoa:khoa,k:k,start:start_num,limit:display},          
                success:function(result)
                {                    
                    $("#content #change_data").html(result);
                }
            });
                    
    });
    //event when you click top checkbox (all/nothing selection)
    $("input#all").click(function()
    {
        
        if($(this).attr("checked")=="checked")
        {
            $("#table_data").find("input[type='checkbox']").attr("checked","checked");
            $("#tool #action").css("visibility","visible");
        }
        else
        {
            $("#table_data").find("input[type='checkbox']").removeAttr("checked");
            $("#tool #action").css("visibility","hidden");
        }
    }
    );
    //event when you click checkbox in data table
    $(".checkbox_row").live("click",function()
    {
        
        checkbox=$("#table_data").find(":checked");
       // alert(checkbox.length);
        
        if(checkbox.length>0)$("#tool #action").css("visibility","visible");
      
        else $("#tool #action").css("visibility","hidden");
      
    });
    
    
     $("button").click(function()
    {   
        
        open_popup("#demo1");
    });
    //event when you click in mssv to see detail
    
    current_row=null;
    $("#table_data td.masv").live("click",function()
    {
        current_row=$(this).parent("tr");
        next_row=current_row.next();
        prev_row=current_row.prev();
        if(next_row.find("td.masv").html()==null) $(".popup_detail img#pnext").hide();
        else $(".popup_detail img#pnext").show();
        
        if(prev_row.find("td.masv").html()==null) $(".popup_detail img#pprev").hide();
        else $(".popup_detail img#pprev").show();
       
       
        masv=current_row.children("td.masv").html();
         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");
                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
         enable_action(1,0,1);
         open_popup(".popup_detail#view"); 	           
         $.ajax(
         {
            url:"/sinhvien/ajax_data",
            type:"POST",
            data:{masv:masv},
            success:function(result)
            {                
                $(".popup_detail #pdata").html(result);
                
            }
        });
        
        
    });
    
    
    $(".popup_detail#view img#pnext").live("click",function()
    {
        current_row=current_row.next();
        next_row=current_row.next();
        prev_row=current_row.prev();
        if(next_row.find("td.masv").html()==null) $(".popup_detail img#pnext").hide();
        else $(".popup_detail img#pnext").show();
        
        if(prev_row.find("td.masv").html()==null) $(".popup_detail img#pprev").hide();
        else $(".popup_detail img#pprev").show();
       
       
         masv=current_row.children("td.masv").html();
         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");
                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
         enable_action(1,0,1);          	           
         $.ajax(
         {
            url:"/sinhvien/ajax_data",
            type:"POST",
            data:{masv:masv},
            success:function(result)
            {                
                $(".popup_detail #pdata").html(result);
                
            }
        });
        
        
    });
    
     $(".popup_detail#view img#pprev").live("click",function()
    {
        current_row=current_row.prev();
        next_row=current_row.next();
        prev_row=current_row.prev();
        if(next_row.find("td.masv").html()==null) $(".popup_detail img#pnext").hide();
        else $(".popup_detail img#pnext").show();
        
        if(prev_row.find("td.masv").html()==null) $(".popup_detail img#pprev").hide();
        else $(".popup_detail img#pprev").show();
       
       
         masv=current_row.children("td.masv").html();
         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");
                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
         enable_action(1,0,1);          	           
         $.ajax(
         {
            url:"/sinhvien/ajax_data",
            type:"POST",
            data:{masv:masv},
            success:function(result)
            {                
                $(".popup_detail #pdata").html(result);
                
            }
        });
        
        
    });
    
    
    $(".popup_detail#view img#edit").click(function()
    {
        $(".popup_detail#view table#text").hide();
        $(".popup_detail#view table#edit").show();
        $(this).hide();
        $(".popup_detail#view img#save").show();
    });
    
    
    $(".popup_detail#view img#save").click(function()
    {
        key=$(".popup_detail#view table#edit input#masv").attr("title");
        masv=$(".popup_detail#view table#edit input#masv").val();
        tensv=$(".popup_detail#view table#edit input#tensv").val();
        khoa=$(".popup_detail#view table#edit select#khoa").val();
        lop=$(".popup_detail#view table#edit select#lop").val();
        k=$(".popup_detail#view table#edit select#k").val();
        ngaysinh=$(".popup_detail#view table#edit input#ngaysinh").val();
        noisinh=$(".popup_detail#view table#edit input#noisinh").val();
        cmnd=$(".popup_detail#view table#edit input#cmnd").val();
        //alert(masv+" "+tensv+" "+khoa);
        
        
        
        $.ajax(
         {
            url:"/sinhvien/ajax_update_data",
            type:"POST",
            data:{key:key,masv:masv,tensv:tensv,khoa:khoa,lop:lop,k:k,ngaysinh:ngaysinh,noisinh:noisinh,cmnd:cmnd},
            success:function(result)
            {   
                alert(result);
                if(result.indexOf("error")>=0) alert("Lỗi! Có thể sinh viên này đã tồn tại hoặc vi phạm ràng buộc, kiểm tra và thử lại"+ result);
                else //update successful
                {
                    $(".popup_detail#view table#text td#masv").html(masv);
                    $(".popup_detail#view table#text td#tensv").html(tensv);
                    $(".popup_detail#view table#text td#khoa").html(khoa);
                    $(".popup_detail#view table#text td#lop").html(lop);
                    $(".popup_detail#view table#text td#k").html(k);
                    $(".popup_detail#view table#text td#ngaysinh").html(ngaysinh);
                    $(".popup_detail#view table#text td#noisinh").html(noisinh);
                    $(".popup_detail#view table#text td#cmnd").html(cmnd);
                    
                    $(".popup_detail#view table#edit").hide();
                    $(".popup_detail#view table#text").show();
                    
                    $(".popup_detail#view img#save").hide();
                    $(".popup_detail#view img#edit").show();
                }
                
                
            }
        });
      
    });
});
function enable_action(edit,save,del)
{
    if(edit==1) $(".popup_detail img#edit").show();
    else $(".popup_detail img#edit").hide();
    
    if(save==1) $(".popup_detail img#save").show();
    else $(".popup_detail img#save").hide();
    
    if(del==1) $(".popup_detail img#del").show();
    else $(".popup_detail img#del").hide();
}
    
    
    
    
    
