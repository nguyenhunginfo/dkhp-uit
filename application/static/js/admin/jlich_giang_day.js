$(document).ready(function()
{       
    
    $("#action img#create").click(function()
    {
        //alert("create");
        
        key="";
        loai=$("table.info select#loai").val();
        malop=$("table.info input#malop").val();
        mamh=$("table.info  select#mamh").val();
        magv=$("table.info  select#magv").val();
        thu=$("table.info  select#thu").val();
        ca=$("table.info  select#ca").val();
        phong=$("table.info  select#phong").val();        
        min=$("table.info  input#min").val();
        max=$("table.info  input#max").val();
        
        //alert(key+" "+malop+" "+mamh+" "+magv+" "+thu+" "+ca+" "+phong+" "+max+" "+min);
        
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/lop/ajax_insert",
            type:"POST",
            data:{key:key,loai:loai,malop:malop,mamh:mamh,magv:magv,thu:thu,ca:ca,phong:phong,min:min,max:max},
            success:function(result)
            {   
                //alert(result);
                if(result=="success")
                {
                    $("#right #message span").html("Tạo lớp "+malop+" thành công");
                    $("#right #message").fadeIn(500).fadeOut(2500);
                    clear_form();
                    enable_footer(2,0); 
                }
                else
                {
                  
                  $("table.error").html(result);
                  enable_footer(1,1);  
                } 
              
            }
        });//end ajax
        
      
    });//end crate action
});
$("table.info select").live("change",function()
{
    enable_footer(1,0);
});
$("table.info input,table.info textarea").live("keydown",function()
{
    
    enable_footer(1,0);
});
function enable_footer(save,h4)
{
        
    if(save==0)
    {     
      $("#action img#create").hide();     
      $("#action img#process").show();  
    }
    else if(save==1)  
    {
        $("#action img#process").hide();
        $("#action img#create").show();     
       
    }
    else
    {
        $("#action img#process").hide();
        $("#action img#create").hide(); 
    }
    
    if(h4==0) 
    {
     $(".box table.error").hide();   
     $("#action h4").hide();   
    }    
    else
    {
        $(".box table.error").show();
        $("#action h4").show();  
    }     
    
}
function clear_form()
{
    $("table.info input").val("");
    
    $("table.info select#magv option:first").attr("selected","selected");
    $("table.info select#ca").html("<option value=''>Chọn ca</option>");
    $("table.info select#phong").html("<option value=''>Chọn phòng</option>");
    $("table.info input#min").val(30);
    $("table.info input#max").val(100);
}
//tu dong tinh so tinh chi thuc hanh
$("table.info  select#loai").live("change",function()
{
    loai=$(this).val();
    
    $.ajax({
               url:"/lop/ajax_monhoc",
               type:"POST",
               data:{loai:loai},
               success: function(result)
               {    
                    $("table.info select#mamh").html(result);                    
               }
           });//end ajax_
    
});


$("table.info select#magv").live("change",function()
{
    
    magv=$(this).val();    
    thu=$("table.info select#thu").val();
    
     
    
    load_ca(magv,thu);
    
});
$("table.info select#thu").live("change",function()
{
    
    
    magv=$("table.info select#magv").val();
    
    thu=$(this).val();
    
    
     
    //alert("load ca: "+magv_new+" "+magv_old+" "+thu_old+" "+thu_new);
    load_ca(magv,thu);
    
});
$("table.info select#ca").live("change",function()
{  
    
    thu=$("table.info select#thu").val();    
    ca=$(this).val();    
    load_phong(thu,ca);
});
function load_ca(magv,thu)
{
    ca_old="";
    $.ajax({
               url:"/lop/ajax_ca",
               type:"POST",
               data:{magv:magv,thu:thu,ca_old:ca_old},
               success: function(result)
               {                
                    $("table.info select#ca").html(result);
                    ca=$("table.info select#ca").val();
                    if(ca!="") load_phong(thu,ca);
               }
           });//end ajax_del
}
function load_phong(thu,ca)
{
    phong_old="";    
    
    $.ajax({
               url:"/lop/ajax_phong",
               type:"POST",
               data:{thu:thu,ca:ca,phong_old:phong_old},
               success: function(result)
               {                
                    $("table.info select#phong").html(result);
               }
           });//end ajax_del
}
    
    
    
    
