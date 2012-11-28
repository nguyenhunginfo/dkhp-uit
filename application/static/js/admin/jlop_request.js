$(document).ready(function()
{
    
 
    
    mamh="";
    tenmh="";
    slht=0;
    $("#table_data td.thaotac button").live("click",function()
    {	
        mamh=$(this).attr("id");
        tenmh=$(this).attr("title");
        slht=$("#table_data td.slht").html();
        open_popup(".popup_detail#view");
        $.ajax(
         {
            url:"/lop/ajax_lop_request",
            type:"POST",
            data:{mamh:mamh,tenmh:tenmh,slht:slht},
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
        
        malop=$(".popup_detail#view input#malop").val().toUpperCase();//IN HOA thong nhat        
        magv=$(".popup_detail#view  select#magv").val();
        thu=$(".popup_detail#view  select#thu").val();
        ca=$(".popup_detail#view  select#ca").val();
        phong=$(".popup_detail#view  select#phong").val();        
        min=$(".popup_detail#view  input#min").val();
        max=$(".popup_detail#view  input#max").val();
        
       
       alert(malop+" "+mamh+" "+magv+" "+thu+" "+ca+" "+phong+" "+max+" "+min+" "+slht);
        
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/lop/ajax_open_lop",
            type:"POST",
            data:{malop:malop,magv:magv,mamh:mamh,thu:thu,ca:ca,phong:phong,min:min,max:max,slht:slht},
            success:function(result)
            {   
               // alert(result);
                if(result=="success")
                {            
                    
                   
                   location.reload();
                }
                else
                {                  
                  $(".popup_detail#view table.error").html(result);
                  enable_footer(1,1);  
                } 
              
            }//end success
            
        }); //end ajax      
      
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
    
    
    
    
    
