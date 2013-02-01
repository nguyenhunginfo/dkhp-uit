$(document).ready(function()
{ 
    $("table.info select").live("change",function()
        {
            enable_footer(1,0);
        });
    $("table.info input,table.info textarea").live("keydown",function()
        {        
            enable_footer(1,0);
        });   
    
    $("#action img#create").click(function()
    {
        
        
        key="";
        magv=$("table.info input#magv").val();
        tengv=$("table.info  input#tengv").val();             
        ngaysinh=$("table.info  input#ngaysinh").val();
        noisinh=$("table.info  textarea#noisinh").val();
        sodt=$("table.info  input#sodt").val();
        email=$("table.info  input#email").val();
        //alert(key+" "+magv+" "+tengv+" "+ngaysinh+" "+noisinh+" "+sodt+" "+email);
        
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/giaovien/ajax_insert",
            type:"POST",
            timeout:5000,
            data:{key:key,magv:magv,tengv:tengv,ngaysinh:ngaysinh,noisinh:noisinh,sodt:sodt,email:email},
            error: function (xhr, ajaxOptions, thrownError) {
                enable_footer(1,0); 
                alert("Thao tác thêm giáo viên thất bại");
               
            },
            success:function(result)
            {   
                //alert(result);
                if(result=="success")
                {
                    $("#right #message span").html("Tạo giáo viên "+tengv+"("+magv+") thành công");
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
        });
        
      
    });//end save action
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
    $("table.info input,table.info textarea").val("");
}
    
    
    
    
    
