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
      $("table.source select#khoa").live("change",function()
        {
            
            khoa=$("table.source select#khoa").val();      
            //alert(khoa); 
            // enable_footer(0,0);    
            $.ajax({
                url: "/ctdt/ajax_k_exist_from_khoa",
                type:"POST",
                data:{khoa:khoa},
                success:function(result)
                {
                   //alert(result);
                    $("table.source select#k").html(result);
                    k=$("table.source select#k").val();
                    $.ajax({
                        url: "/ctdt/ajax_somon",
                        type:"POST",
                        data:{khoa:khoa,k:k},
                        success:function(result)
                        {
                           // alert(result);
                            $("table.source td#somon").html(result);
                        }
                    });
                    
                    $.ajax({
                        url: "/ctdt/ajax_sotc",
                        type:"POST",
                        data:{khoa:khoa,k:k},
                        success:function(result)
                        {
                           // alert(result);
                            $("table.source td#sotc").html(result);
                            // enable_footer(1,0);  
                        }
                    });
                    
                }
            });
            
            
            
        }); 
        
        
        $("table.source select#k").live("change",function()
        {
            
            khoa=$("table.source select#khoa").val();      
            k=$("table.source select#k").val();
            if(khoa!=""&&k!="")
            {
                //enable_footer(0,0);   
                $.ajax({
                    url: "/ctdt/ajax_somon",
                    type:"POST",
                    data:{khoa:khoa,k:k},
                    success:function(result)
                    {
                        // alert(result);
                        $("table.source td#somon").html(result);
                    }
                });
                    
            $.ajax({
                    url: "/ctdt/ajax_sotc",
                    type:"POST",
                    data:{khoa:khoa,k:k},
                    success:function(result)
                    {
                           // alert(result);
                            $("table.source td#sotc").html(result);
                        //    enable_footer(1,0);   
                    }
                    });
            }
        }); 
        
        
     $("table select").live("change",function()
        {
            enable_footer(1,0);
        });
    $("table input").live("keydown",function()
        {        
            enable_footer(1,0);
        });   
    
    $("#action img#create").click(function()
    {
        
        khoa_new=$("table.info  select#khoa").val();        
        k_new=$("table.info  select#k").val();
        
        khoa_old=$("table.source  select#khoa").val();        
        k_old=$("table.source  select#k").val();
        somon=$("table.source td#somon").html();
        sotc=$("table.source td#sotc").html();
        
        if(k_new==null||k_old==null) alert("Kiểm tra lại thông tin");
        else if(somon==0||sotc==0) alert("Không thể sao chép chương trình đào tạo trống");
        else
        {
           // alert(khoa_old+" "+k_old+" "+khoa_new+" "+k_new);
            enable_footer(0,0);       
            $.ajax(
             {
                url:"/ctdt/ajax_copy",
                type:"POST",
                timeout:5000,
                data:{khoa_new:khoa_new,k_new:k_new,khoa_old:khoa_old,k_old:k_old},
                error: function (xhr, ajaxOptions, thrownError) {
                    enable_footer(1,0); 
                    alert("Thao tác sao chép chương trình đào tạo thất bại");
                   
                },
                success:function(result)
                {   
                   // alert(result);
                    if(result=="success")
                    {
                        window.location.assign("/quanly/chuong-trinh-dao-tao/"+khoa_new+"/"+k_new); 
                    }
                    else
                    {
                      
                      $("table.error").html(result);
                      enable_footer(1,1);  
                    } 
                  
                }
            });
        }
        
      
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
    else//2
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
    
    
    
    
    
