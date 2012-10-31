$(document).ready(function()
{   
    
    
    
    
     $("table.info select#k,table.info select#khoa").live("change",function()
        {
            k=$("table.info select#k").val();
            khoa=$("table.info select#khoa").val();      
             
            
            $.ajax({
                url: "/sinhvien/ajax_lop_from_khoa",
                type:"POST",
                data:{k:k,khoa:khoa},
                success:function(result)
                {
                   // alert(result);
                    $("table.info select#lop").html(result);
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
        
        
        key="";
        masv=$("table.info input#masv").val();
        tensv=$("table.info  input#tensv").val();
        khoa=$("table.info  select#khoa").val();
        lop=$("table.info  select#lop").val();
        k=$("table.info  select#k").val();
        ngaysinh=$("table.info  input#ngaysinh").val();
        noisinh=$("table.info  textarea#noisinh").val();
        sdt=$("table.info  input#sdt").val();
        email=$("table.info  input#email").val();
        //alert(key+" "+masv+" "+tensv+" "+khoa+" "+lop+" "+k);
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/sinhvien/ajax_insert",
            type:"POST",
            timeout:5000,
            data:{key:key,masv:masv,tensv:tensv,khoa:khoa,lop:lop,k:k,ngaysinh:ngaysinh,noisinh:noisinh,sdt:sdt,email:email},
            error: function (xhr, ajaxOptions, thrownError) {
                enable_footer(1,0); 
                alert("Thao tác thêm sinh viên thất bại");
               
            },
            success:function(result)
            {   
                //alert(result);
                if(result=="success")
                {
                    $("#right #message span").html("Tạo sinh viên "+masv+" thành công");
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
    
    
    
    
    
