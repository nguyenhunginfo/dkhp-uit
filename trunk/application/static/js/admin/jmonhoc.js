$(document).ready(function()
{
    
    $("#data #left li li").live("click",function()
    {             
            var loai=$(this).attr("id");
            var display=parseInt($("select#view_num").val());//hien thi bao nhiu?			
            
			
             $("#data ul li ul").find("li.active").removeClass("active");
             $(this).addClass("active");
           
			$.ajax(
            {
                url:"/monhoc/ajax_full_data",
                type:"POST",  
                data:{loai:loai,limit:display},
                beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");	
                },             
                success:function(result)
                {                   
                    $("#content #change_data").html(result);
                    
                    //cap nhat tieu de                    
                    if(loai=="tatca") $("#right #tool p#data_title").html("&#187;&#187; Danh sách môn học");
                    else if(loai=="DC") $("#right #tool p#data_title").html("&#187;&#187; Danh sách môn học đại cương");
                    else if(loai=="CN") $("#right #tool p#data_title").html("&#187;&#187; Danh sách môn học chuyên nghành");
                }
            });
            $("#tool #action").css("visibility","hidden");
            search=$("#search form").children().val("");
            
           
                    
    });
    
    
    $("#tool select#view_num").live("change",function()
    {             
            var loai=$("#data #left li li.active").attr("id");            
            
            var display=parseInt($(this).val());//hien thi bao nhiu?			
            var search=$("#search form").children().val();		
                     
			$.ajax(
            {
                url:"/monhoc/ajax_full_data",
                type:"POST",  
                data:{search:search,loai:loai,limit:display},
                beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");	
                },             
                success:function(result)
                {                   
                    $("#content #change_data").html(result); 
                }
            });
            $("#tool #action").css("visibility","hidden");        
    });
    
    
    //event when you click in pagination li
    $("#pagination li a").live("click",function()
    {
        
            var loai=$("#data #left li li.active").attr("id");
            
            var display=parseInt($("select#view_num").val());//hien thi bao nhiu?
            var search=$("#search form").children().val();
    		url=$(this).attr("href");
            index=url.lastIndexOf("/");
            num=url.substr(index+1);
            if(num=="") num=0;
            
			$.ajax(
            {
                url:"/monhoc/ajax_full_data/"+num,
                type:"POST",                  
                data:{search:search,loai:loai,limit:display},
                beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");	
                },       
                success:function(result)
                {                    
                   $("#content #change_data").html(result);                   
                }
            });
            $("#tool #action").css("visibility","hidden");
            return false;
                    
    });
    //event when you click top checkbox (all/nothing selection)
    $("input#all").click(function()
    {        
        if($(this).attr("checked")=="checked")
        {
            checkbox=$("#table_data").find("input[type='checkbox']");
            checkbox.each(function()
            {
                $(this).attr("checked","checked");
                $(this).parents("tr").addClass("active");
            });
            $("#tool #action").css("visibility","visible");
        }
        else
        {
            checkbox=$("#table_data").find("input[type='checkbox']");
            checkbox.each(function()
            {
                $(this).removeAttr("checked");
                $(this).parents("tr").removeClass("active");
            });
            
            $("#tool #action").css("visibility","hidden");
        }
    });
    
    //event when you click checkbox in data table
    $(".checkbox_row").live("click",function()
    {        
        checkbox=$("#table_data").find(":checked");
       // alert(checkbox.length);
        
        if(checkbox.length>0) $("#tool #action").css("visibility","visible");      
        else $("#tool #action").css("visibility","hidden");      
    });
    
    $(".checkbox_row").live("change",function()
    {
        if($(this).attr("checked")=="checked") $(this).parents("tr").addClass("active");
        else $(this).parents("tr").removeClass("active");        
        
    });
 
    //event when you click in mssv to see detail
    current_row=null;
    
    $("#table_data td.mamh").live("click",function()
    {	
        current_row=$(this).parent("tr");
        current_row.addClass("active").find(".checkbox_row").attr("checked","checked");
        $("#tool #action").css("visibility","visible");
        mamh=current_row.children("td.mamh").html();      
            
        $(".popup_detail#view #ptitle").html("Thông tin chi tiết môn học");
        open_popup(".popup_detail#view");         	           
         $.ajax(
         {
            url:"/monhoc/ajax_data",
            type:"POST",
            data:{mamh:mamh},
            beforeSend:function()
            {
                $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");
            },
            success:function(result)
            {                
                $(".popup_detail #pdata").html(result);
                 
            }
        });
        
    });
    
    
    //tim kiem
    $("#search form").submit(function(e)
    {            
        var search=$(this).children().val();//input value
        var loai="tatca";        
        var display=parseInt($("select#view_num").val());//hien thi bao nhiu?       
     
        if(search!="")
        {
            $.ajax(
                {
                    url:"/monhoc/ajax_full_data",
                    type:"POST",                  
                    data:{search:search,loai:loai,limit:display},
                    beforeSend: function()
                    {
                        $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");	
                    },        
                    success:function(result)
                    {                    
                       $("#content #change_data").html(result);                      
                       
                    }
                    
                });
            $("#tool #action").css("visibility","hidden");
        }
       e.preventDefault();//prevent to reload when submit
    });
     
    //luu sua doi
    $(".popup_detail#view img#save").click(function()
    {
        
        
        key=$(".popup_detail#view table.info").attr("id");
        mamh=$(".popup_detail#view input#mamh").val();
        tenmh=$(".popup_detail#view  input#tenmh").val();
        sotc=$(".popup_detail#view  input#sotc").val();
        tclt=$(".popup_detail#view  input#tclt").val();
        tcth=$(".popup_detail#view  input#tcth").val();
        loai=$(".popup_detail#view  select#loai").val();
       
       
       
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/monhoc/ajax_update",
            type:"POST",
            data:{key:key,mamh:mamh,tenmh:tenmh,sotc:sotc,tclt:tclt,tcth:tcth,loai:loai},
            success:function(result)
            {   
                //alert(result);
                if(result=="success")
                {
                   //cap nhat lai bang danh sach
                   current_row.children("td.mamh").html(mamh);
                   current_row.children("td.tenmh").html(tenmh);
                   current_row.children("td.sotc").html(sotc);
                   current_row.children("td.tclt").html(tclt);
                   current_row.children("td.tcth").html(tcth);
                   if(loai=="DC") current_row.children("td.loai").html("Đại Cương");
                   else current_row.children("td.loai").html("Chuyên Nghành");
                   
                   $("#content #message").fadeIn(1000).fadeOut(2000);                   
                   close_popup();
                }
                else
                {                  
                  $(".popup_detail#view table.error").html(result);
                  enable_footer(1,1);  
                } 
              
            }
            
        });       
      
    });//end save action
    
    //event when you click bin image
    $("#tool img#del").click(function()
    { 
        
        checkbox=$("#table_data").find(":checked");
        count=checkbox.length;
        mamh_array=new Array();
        checkbox.each(function()
        {
           mamh=$(this).attr("id");
           mamh_array.push(mamh);
           
        });
        conf=confirm("Nhắc nhở: Bạn có thật sự muốn xóa "+count+" môn học này không?\nDanh sách mã môn học: "+mamh_array ); 
          
        if(conf) 
        {            
            $.ajax({
                        url:"/monhoc/ajax_delete",
                        type:"POST",
                        data:{mamh_array:mamh_array},
                        success: function(result)
                        {
                                                        
                            $("#content #message").fadeIn(1000).fadeOut(1000);
                            
                            var loai=$("#data #left li li.active").attr("id");
                            var display=parseInt($("#tool select#view_num").val());//hien thi bao nhiu?			
                            var start_num=0;
                    			$.ajax(
                                {
                                    url:"/monhoc/ajax_full_data",
                                    type:"POST",  
                                    data:{loai:loai,start:start_num,limit:display},
                                    beforeSend: function()
                                    {
                                        $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");	
                                    },         
                                    success:function(result)
                                    {                   
                                        $("#content #change_data").html(result);                   
                                        
                                    }
                                });//end ajax full data
                                $("#tool #action").css("visibility","hidden");  
                         }
                    });//end ajax_del
        }//end confirm
        
    });
    
});//end ready funtion
$(".popup_detail #pdata table.info select").live("change",function()
{
    enable_footer(1,0);
});
$(".popup_detail #pdata table.info input,.popup_detail #pdata table.info textarea").live("keydown",function()
{
    enable_footer(1,0);
});



//tu dong tinh so tinh chi thuc hanh
$(".popup_detail #pdata input#sotc").live("keyup",function()
{
    sotc=$(this).val();
    tclt=$(".popup_detail #pdata input#tclt").val();
    if(isNaN(sotc)==false&& isNaN(tclt)==false)
    {
        
        if(sotc-tclt>=0)tcth=sotc-tclt;
        else tcth="SoTC=TCLT+TCTH";
        
        $(".popup_detail #pdata input#tcth").val(tcth);
    }
    
});

$(".popup_detail #pdata input#tclt").live("keyup",function()
{
    sotc=$(".popup_detail #pdata input#sotc").val();
    tclt=$(this).val();
    
    if(isNaN(sotc)==false&& isNaN(tclt)==false)
    {
        
        if(sotc-tclt>=0)tcth=sotc-tclt;
        else tcth="SoTC=TCLT+TCTH";
        $(".popup_detail #pdata input#tcth").val(tcth);
    }
    
});

function enable_footer(save,h4)
{
        
    if(save==0)
    {     
      $(".popup_detail #pfooter img#save").hide();     
      $(".popup_detail #pfooter img#process").show();  
    }
    else  
    {
        $(".popup_detail #pfooter img#process").hide();
        $(".popup_detail #pfooter img#save").show();     
       
    }
    
    if(h4==0) 
    {
     $(".popup_detail #pdata table.error").hide();   
     $(".popup_detail #pfooter h4").hide();   
    }    
    else
    {
        $(".popup_detail #pdata table.error").show();
       $(".popup_detail #pfooter h4").show();  
    }     
    
}
    
    
    
    
    
