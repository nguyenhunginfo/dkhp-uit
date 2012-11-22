$(document).ready(function()
{
    $("#tool select#view_num").live("change",function()
    {             
            var loai=$("#data #left li li.active").attr("id");            
            
            var display=parseInt($(this).val());//hien thi bao nhiu?			
            var search=$("#search form").children().val();		
                     
			$.ajax(
            {
                url:"/lop/ajax_full_data",
                type:"POST",  
                data:{search:search,loai:loai,limit:display},
                timeout: 10000,//10s
                beforeSend: function()
                    {
                        $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                    },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#content #change_data").html("Dữ liệu bị lỗi");
                   
                },                     
                success:function(result)
                {                   
                    $("#content #change_data").html(result); 
                }
            });
           $("#tool #action img#del").css("visibility","hidden");        
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
                url:"/lop/ajax_full_data/"+num,
                type:"POST",                  
                data:{search:search,loai:loai,limit:display},
                timeout: 10000,//10s
                beforeSend: function()
                    {
                        $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                    },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#content #change_data").html("Dữ liệu bị lỗi");
                   
                },                
                success:function(result)
                {                    
                   $("#content #change_data").html(result);                   
                }
            });
            $("#tool #action img#del").css("visibility","hidden");
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
            $("#tool #action img#del").css("visibility","visible");
        }
        else
        {
            checkbox=$("#table_data").find("input[type='checkbox']");
            checkbox.each(function()
            {
                $(this).removeAttr("checked");
                $(this).parents("tr").removeClass("active");
            });
            
            $("#tool #action img#del").css("visibility","hidden");
        }
    });
    
    //event when you click checkbox in data table
    $(".checkbox_row").live("click",function()
    {        
        checkbox=$("#table_data").find(":checked");
       // alert(checkbox.length);
        
        if(checkbox.length>0) $("#tool #action img#del").css("visibility","visible");      
        else $("#tool #action img#del").css("visibility","hidden");     
    });
    
    $(".checkbox_row").live("change",function()
    {
        if($(this).attr("checked")=="checked") $(this).parents("tr").addClass("active");
        else $(this).parents("tr").removeClass("active");        
        
    });
 
    
    
    
    
    //tim kiem
    $("#search form").submit(function(e)
    {            
        var search=$(this).children().val();//input value
        var loai="";        
        var display=parseInt($("select#view_num").val());//hien thi bao nhiu?       
     
        if(search!="")
        {
            $.ajax(
                {
                    url:"/lop/ajax_full_data",
                    type:"POST",                  
                    data:{search:search,loai:loai,limit:display},
                    timeout: 10000,//10s
                    beforeSend: function()
                        {
                            $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                        },
                    error: function (xhr, ajaxOptions, thrownError) {
                        
                        $("#content #change_data").html("Dữ liệu bị lỗi");
                       
                    },              
                    success:function(result)
                    {                    
                       $("#content #change_data").html(result);                      
                       
                    }
                    
                });
                active_search_interface();
            
        }
       e.preventDefault();//prevent to reload when submit
    });
    //event when you click in malop to see detail
    current_row=null;
    
    $("#table_data td.malop").live("click",function()
    {	
        current_row=$(this).parent("tr");
        current_row.addClass("active").find(".checkbox_row").attr("checked","checked");
        $("#tool #action").css("visibility","visible");
        malop=current_row.children("td.malop").html();      
        loai=$("#data #left li li.active").attr("id");
        $(".popup_detail#view #ptitle").html("Thông tin chi tiết lớp");
        open_popup(".popup_detail#view");         	           
         $.ajax(
         {
            url:"/lop/ajax_data",
            type:"POST",
            data:{malop:malop,loai:loai},
            timeout: 10000,//10s
            beforeSend: function()
                {
                    $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                },
            error: function (xhr, ajaxOptions, thrownError) {
                $(".popup_detail #pdata").html("Dữ liệu bị lỗi");
               
            },          
            success:function(result)
            {                
                $(".popup_detail #pdata").html(result);
                 
            }
        });
        
    });
    //luu sua doi
    $(".popup_detail#view img#save").click(function()
    {
        
        loai=$("#data #left li li.active").attr("id");
        key=$(".popup_detail#view table.info").attr("id");
        malop=$(".popup_detail#view input#malop").val().toUpperCase();//IN HOA thong nhat
        mamh=$(".popup_detail#view  select#mamh").val();
        magv=$(".popup_detail#view  select#magv").val();
        thu=$(".popup_detail#view  select#thu").val();
        ca=$(".popup_detail#view  select#ca").val();
        phong=$(".popup_detail#view  select#phong").val();
        
        min=$(".popup_detail#view  input#min").val();
        max=$(".popup_detail#view  input#max").val();
        
       
       //alert(key+" "+malop+" "+mamh+" "+magv+" "+thu+" "+ca+" "+phong+" "+max+" "+min);
        
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/lop/ajax_update",
            type:"POST",
            data:{key:key,loai:loai,malop:malop,mamh:mamh,magv:magv,thu:thu,ca:ca,phong:phong,min:min,max:max},
            success:function(result)
            {   
               // alert(result);
                if(result=="success")
                {
                   //cap nhat lai bang danh sach                   
                   current_row.children("td.malop").html(malop);
                   
                   tenmh=$(".popup_detail#view select#mamh :selected").html();
                   current_row.children("td.tenmh").html(tenmh);
                   
                   tengv=$(".popup_detail#view select#magv :selected").html();
                   current_row.children("td.tengv").html(tengv);
                   
                   
                   current_row.children("td.thu").html(thu);
                   current_row.children("td.ca").html(ca);
                   current_row.children("td.phong").html(phong);
                   
                   current_row.children("td.min").html(min);
                   current_row.children("td.max").html(max);
                   
                   
                   $("#content #message").fadeIn(1000).fadeOut(2000);                   
                   close_popup();
                }
                else
                {                  
                  $(".popup_detail#view table.error").html(result);
                  enable_footer(1,1);  
                } 
              
            }//end success
            
        }); //end ajax      
      
    });//end save action
//=======DELETE MONHOC=================================================================================================================================
    //event when you click bin image
    $("#tool img#del").click(function()
    { 
        
        checkbox=$("#table_data").find(":checked");
        loai=$("#data #left li li.active").attr("id");
        count=checkbox.length;
        malop_array=new Array();
        checkbox.each(function()
        {
           malop=$(this).attr("id");
           malop_array.push(malop);
           
        });
        conf=confirm("Nhắc nhở: Bạn có thật sự muốn xóa "+count+" lớp này không?\nDanh sách mã lớp: "+malop_array ); 
          
        if(conf) 
        {            
            $.ajax({
                        url:"/lop/ajax_delete",
                        type:"POST",
                        data:{malop_array:malop_array,loai:loai},
                        success: function(result)
                        {
                            window.location.reload(true);
                        }
                    });//end ajax_del
        }//end confirm
    });//end del event
    
    
//=======EXPORT MONHOC TO EXCEL=================================================================================================================================    
         //event when you click bin image
        $("#tool img#export").click(function()
        {   
            loai=$("#data #left li li.active").attr("id");  
            
            if(loai=='tatca') ten_loai="Tất cả";
            else if(loai=='lt') ten_loai="Lý thuyết";
                 else ten_loai="Thực hành";
            display=parseInt($("select#view_num").val())//hien thi bao nhiu?			
            search=$("#search form").children().val();
            total_rows=$("#pagination").attr("class");
            
            start_index=$("#pagination li.active").html();
            
            if(start_index==null) start_index=0;       
            else start_index=(start_index-1)*display; 
            
            if(display==0)end_index=total_rows;
            else          end_index=start_index+display;
            
            if(end_index>total_rows) end_index=total_rows;
            
            html="";
            if(search=="")
            {
                html+='<table>';
                html+='<tr><td>Loại</td><td><input name="loai"  type="hidden" value="'+loai+'" readonly="true"/>'+ten_loai+'</td></tr>'+
                      '<tr><td>Từ lớp thứ</td><td><input name="start"  type="hidden" value="'+start_index+'" readonly="true"/>'+start_index+'</td></tr>'+
                      '<tr><td>Đến lớp học thứ</td><td><input name="end"   type="hidden" value="'+end_index+'"   readonly="true"/>'+end_index+'</td></tr>'+
                      '<tr><td>Tổng số lớp</td><td><input         type="hidden" value="'+total_rows+'"  readonly="true"/>'+total_rows+'</tr>'+
                      '<tr><td>Kiểu dữ liệu</td>'+
                            '<td><select name="file">'+
                                '<option value="CSV">CSV(tập tin đơn giản)</option>'+
                                '<option value="EXCEL2003">EXCEL 2003(*.XLS)</option>'+
                                '<option value="EXCEL2007">EXCEL 2007(*.XLSX)</option>'+                            
                                '</select>'+
                            '</td>'+
                        '</tr>';             
                html+='</table>';
                $(".popup_detail#export #pdata").html(html);
                
            }
            else
            {
                
                search=$("#search form").children().val();//input value
                html+='<table>';
                html+='<tr><td>Loại</td><td><input name="loai" type="hidden" value=""  /><input name="search" type="hidden" value="'+search+'" />Tìm kiếm</td></tr>';
                 
                html+='<tr><td>Kiểu dữ liệu</td>'+
                            '<td><select name="file">'+
                                '<option value="CSV">CSV(tập tin đơn giản)</option>'+
                                '<option value="EXCEL2003">EXCEL 2003(*.XLS)</option>'+
                                '<option value="EXCEL2007">EXCEL 2007(*.XLSX)</option>'+
                                '<option value="PDF">PDF(*.PDF)</option>'+
                                '</select>'+
                            '</td>'+
                        '</tr>';              
                html+='</table>';
                $(".popup_detail#export #pdata").html(html);
            }
            open_popup(".popup_detail#export");
            
            
        });//END EXPORT
        $(".popup_detail#export form").submit(function()
        {          
            close_popup();
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
$(".popup_detail #pdata select#magv").live("change",function()
{
    magv_old=$(this).attr("class");
    magv_new=$(this).val();
    thu_old=$(".popup_detail #pdata select#thu").attr("class");
    thu_new=$(".popup_detail #pdata select#thu").val();
    
     
    //alert("load ca: "+magv_new+" "+magv_old+" "+thu_old+" "+thu_new);
    load_ca(magv_old,magv_new,thu_old,thu_new);
    
});
$(".popup_detail #pdata select#thu").live("change",function()
{
    
    magv_old=$(".popup_detail #pdata select#magv").attr("class");
    magv_new=$(".popup_detail #pdata select#magv").val();
    thu_old=$(this).attr("class");
    thu_new=$(this).val();
    
    
     
    //alert("load ca: "+magv_new+" "+magv_old+" "+thu_old+" "+thu_new);
    load_ca(magv_old,magv_new,thu_old,thu_new);
    
});
$(".popup_detail #pdata select#ca").live("change",function()
{  
    thu_old=$(".popup_detail #pdata select#thu").attr("class");
    thu_new=$(".popup_detail #pdata select#thu").val();
    ca_old=$(this).attr("class");
    ca_new=$(this).val();
    //alert("load phong: "+thu_new+" "+thu_old+" "+ca_old+" "+ca_new);
    load_phong(thu_old,thu_new,ca_old,ca_new);
});
function load_ca(magv_old,magv_new,thu_old,thu_new)
{
    //alert("load ca");
    ca_old="";
    if(magv_old==magv_new&&thu_old==thu_new)
    {
        ca_old=$(".popup_detail #pdata select#ca").attr("class");
    }   
    else ca_old="";
    
    $.ajax({
               url:"/lop/ajax_ca",
               type:"POST",
               data:{magv:magv_new,thu:thu_new,ca_old:ca_old},
               success: function(result)
               {                
                    $(".popup_detail #pdata select#ca").html(result);
                    thu_old=$(".popup_detail #pdata select#thu").attr("class");
                    thu_new=$(".popup_detail #pdata select#thu").val();
                    
                    ca_old=$(".popup_detail #pdata select#ca").attr("class");
                    ca_new=$(".popup_detail #pdata select#ca").val();
                    
                    load_phong(thu_old,thu_new,ca_old,ca_new);
               }
           });//end ajax_del
}
function load_phong(thu_old,thu_new,ca_old,ca_new)
{
    //alert("load phong");
    phong_old="";
    if(thu_old==thu_new&&ca_old==ca_new)//neu thu, ca cu thi phai con phong cu(xem nhu chua thay doi)
    {
        phong_old=$(".popup_detail #pdata select#phong").attr("class");
    }   
    else phong_old="";
    
    $.ajax({
               url:"/lop/ajax_phong",
               type:"POST",
               data:{thu:thu_new,ca:ca_new,phong_old:phong_old},
               success: function(result)
               {                
                    $(".popup_detail #pdata select#phong").html(result);
               }
           });//end ajax_del
}
function active_search_interface()
{
    $("#right #tool p#data_title").html("Kết quả tìm kiếm");
    $("#tool #action img#del").css("visibility","hidden");    
    $("#data #left li li").removeClass("active");
    $("#right #tool select#view_num").hide();
}

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
    
    
    
    
    
