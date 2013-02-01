$(document).ready(function()
{   
    
    
     $("table.info select#khoa").live("change",function()
        {
            
            khoa=$("table.info select#khoa").val();      
             
            
            $.ajax({
                url: "/ctdt/ajax_k_from_khoa",
                type:"POST",
                data:{khoa:khoa},
                success:function(result)
                {
                   // alert(result);
                    $("table.info select#k").html(result);
                }
            });
            
        }); 
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
        
        khoa=$("table.info  select#khoa").val();        
        k=$("table.info  select#k").val();
        sohk=$("table.info  input#sohk").val();
        //alert(khoa+" "+k+" "+sohk);
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/ctdt/ajax_insert",
            type:"POST",
            timeout:5000,
            data:{khoa:khoa,k:k,sohk:sohk},
            error: function (xhr, ajaxOptions, thrownError) {
                enable_footer(1,0); 
                alert("Thao tác thêm chương trình đào tạo thất bại");
               
            },
            success:function(result)
            {   
                //alert(result);
                if(result=="success")
                {
                    window.location.assign("/quanly/chuong-trinh-dao-tao/"+khoa+"/"+k); 
                }
                else
                {
                  
                  $("table.error").html(result);
                  enable_footer(1,1);  
                } 
              
            }
        });
        
      
    });//end save action
});//end ready function

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
    
    
    
    
    
