$(document).ready(function()
{
    
    $("#data #left li li").live("click",function()
    {             
            var khoa=$(this).attr("id");
            var tenkhoa=$(this).attr("title");
            var k=$("select#k").val();
            var display=parseInt($("select#view_num").val());//hien thi bao nhiu?			
            
			
             $("#data ul li ul").find("li.active").removeClass("active");
             $(this).addClass("active");
            
           // alert(khoa+" "+tenkhoa+" "+k+" "+display);
			$.ajax(
            {
                url:"/sinhvien/ajax_full_data",
                type:"POST",  
                data:{khoa:khoa,k:k,limit:display},
                beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                },             
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
        $.ajax(
        {
            url:"/sinhvien/ajax_full_data",
            type:"POST",  
            data:{khoa:khoa,k:k,limit:display},
            beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                },             
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
            var k=$("select#k").val();
            var display=parseInt($(this).val());//hien thi bao nhiu?			
            
			
           //  alert(k+" "+khoa+" "+display+" "+start_num);            
            
			$.ajax(
            {
                url:"/sinhvien/ajax_full_data",
                type:"POST",  
                data:{khoa:khoa,k:k,limit:display},
                beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                },             
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
        count=checkbox.length;
        mssv_array=new Array();
        checkbox.each(function()
        {
           mssv=$(this).attr("id");
           mssv_array.push(mssv);
           
        });
        conf=confirm("Nhắc nhở: Bạn có thật sự muốn xóa "+count+" sinh viên này không?\nDanh sách MSSV: "+mssv_array );        
        if(conf) 
        {            
            $.ajax({
                        url:"/sinhvien/ajax_delete",
                        type:"POST",
                        data:{mssv_array:mssv_array},
                        success: function(result)
                        {
                            //alert(result);
                            $("#content #message span").html(result);
                            $("#content #message").fadeIn(1000).fadeOut(1000);
                            
                            var khoa=$("#data #left li li.active").attr("id");            
                            var k=$("select#khoa").val();
                            var display=parseInt($("#tool select#view_num").val());//hien thi bao nhiu?			
                            var start_num=0;
                    			$.ajax(
                                {
                                    url:"/sinhvien/ajax_full_data",
                                    type:"POST",  
                                    data:{khoa:khoa,k:k,start:start_num,limit:display},
                                    beforeSend: function()
                                    {
                                        $("#content #change_data").html("<img id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
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
    
    //event when you click in pagination li
    $("#pagination li a").live("click",function()
    {
        
            var khoa=$("#data #left li li.active").attr("id");
            var k=$("select#khoa").val();
            var display=parseInt($("select#view_num").val());//hien thi bao nhiu?
            
    		url=$(this).attr("href");
            index=url.lastIndexOf("/");
            num=url.substr(index+1);
            if(num=="") num=0;
            
			$.ajax(
            {
                url:"/sinhvien/ajax_full_data/"+num,
                type:"POST",                  
                data:{khoa:khoa,k:k,limit:display},
                beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
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
    $("#table_data td.masv").live("click",function()
    {
		
        current_row=$(this).parent("tr");
        current_row.addClass("active").find(".checkbox_row").attr("checked","checked");
        $("#tool #action").css("visibility","visible");
        next_row=current_row.next();
        prev_row=current_row.prev();
        if(next_row.find("td.masv").html()==null) $(".popup_detail img#pnext").hide();
        else $(".popup_detail img#pnext").show();
        
        if(prev_row.find("td.masv").html()==null) $(".popup_detail img#pprev").hide();
        else $(".popup_detail img#pprev").show();
       
       
        masv=current_row.children("td.masv").html();
         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");
                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
         
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
       $(".popup_detail #pfooter img#save,.popup_detail #pfooter img#process,.popup_detail #pfooter h4").hide();
       
         masv=current_row.children("td.masv").html();
         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");
                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
               	           
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
        
        $(".popup_detail #pfooter img#save,.popup_detail #pfooter img#process,.popup_detail #pfooter h4").hide();
         
         masv=current_row.children("td.masv").html();         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");                   	           
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
    
     $("table.info select#khoa").live("change",function()
     {
        khoa=$(this).val();
        //alert(khoa);
        $.ajax({
            url: "/sinhvien/ajax_lop_from_khoa",
            type:"POST",
            data:{khoa:khoa},
            success:function(result)
            {
               // alert(result);
                $(".popup_detail table.info select#lop").html(result);
            }
        });
    });  
    $("#search form").submit(function(e)
    {     
       
        var value=$(this).children().val();//input value
        var khoa="tatca";
        var k=0;
        var display=parseInt($("select#view_num").val());//hien thi bao nhiu?       
        //alert(value);
        if(value!="")
        {
            $.ajax(
                {
                    url:"/sinhvien/ajax_full_data",
                    type:"POST",                  
                    data:{masv:value,khoa:khoa,k:k,limit:display},
                    beforeSend: function()
                    {
                        $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
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
     
    
    $(".popup_detail#view img#save").click(function()
    {
        
        
        key=$(".popup_detail#view table.info").attr("id");
        masv=$(".popup_detail#view input#masv").val();
        tensv=$(".popup_detail#view  input#tensv").val();
        khoa=$(".popup_detail#view  select#khoa").val();
        lop=$(".popup_detail#view  select#lop").val();
        k=$(".popup_detail#view  select#k").val();
        ngaysinh=$(".popup_detail#view  input#ngaysinh").val();
        noisinh=$(".popup_detail#view  textarea#noisinh").val();
        sdt=$(".popup_detail#view  input#sdt").val();
        email=$(".popup_detail#view  input#email").val();
       // alert(key+" "+masv+" "+tensv+" "+khoa+" "+sdt+" "+email);
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/sinhvien/ajax_update",
            type:"POST",
            data:{key:key,masv:masv,tensv:tensv,khoa:khoa,lop:lop,k:k,ngaysinh:ngaysinh,noisinh:noisinh,sdt:sdt,email:email},
            success:function(result)
            {   
                //alert(result);
                if(result=="success")
                {
                   
                   current_row.children("td.masv").html(masv);
                   current_row.children("td.tensv").html(tensv);
                   current_row.find("td.khoa").html(khoa);
                   current_row.children("td.lop").html(lop);
                   current_row.children("td.k").html(k);
                   current_row.children("td.ngaysinh").html(ngaysinh);
                   current_row.children("td.noisinh").html(noisinh);
                   current_row.children("td.sdt").html(sdt);
                   current_row.children("td.email").html(email);
                   $("#content #message span").html("")
                   $("#content #message").fadeIn(1000).fadeOut(2000);                   
                   close_popup();
                }
                else
                {
                  
                  $(".popup_detail#view table.error").html(result);
                  enable_footer(1,1);  
                } 
              //  $(".popup_detail#view .error").html(result);
            }
        });       
      
    });//end save action
    
    
});//end ready funtion
$(".popup_detail #pdata table.info select").live("change",function()
{
    enable_footer(1,0);
});
$(".popup_detail #pdata table.info input,.popup_detail #pdata table.info textarea").live("keydown",function()
{
    enable_footer(1,0);
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
    
    
    
    
    
