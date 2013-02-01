$(document).ready(function()
{       
    
    $("#action img#create").click(function()
    {   
        mamh=$("table.info #mamh").val();
        tenmh=$("table.info  input#tenmh").val();
        
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/monhoc/ajax_insert_monhoc_nhom",
            type:"POST",
            data:{mamh:mamh,tenmh:tenmh},
            success:function(result)
            {   
                
                if(result=="success")
                {
                    window.location.assign("/quanly/monhoc/mon-hoc-nhom");
                }
                else
                {
                  
                  $("table.error").html(result);
                  enable_footer(1,1);  
                } 
              
            }
        });
        
      
    });//end save action
    
    
        
        
    $("table.info select").live("change",function()
    {
        enable_footer(1,0);
    });
    $("table.info input,table.info textarea").live("keydown",function()
    {
        
        enable_footer(1,0);
    });
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
//tu dong tinh so tinh chi thuc hanh
$("table.info  input#sotc").live("keyup",function()
{
    sotc=$(this).val();
    tclt=$("table.info  input#tclt").val();
    if(isNaN(sotc)==false&& isNaN(tclt)==false)
    {
        
        if(sotc-tclt>=0)tcth=sotc-tclt;
        else tcth="SoTC=TCLT+TCTH";
        
        $("table.info  input#tcth").val(tcth);
    }
    
});

$("table.info  input#tclt").live("keyup",function()
{
    sotc=$("table.info  input#sotc").val();
    tclt=$(this).val();
    
    if(isNaN(sotc)==false&& isNaN(tclt)==false)
    {
        
        if(sotc-tclt>=0)tcth=sotc-tclt;
        else tcth="SoTC=TCLT+TCTH";
       $("table.info  input#tcth").val(tcth);
    }
    
});    
    
    
    
    
