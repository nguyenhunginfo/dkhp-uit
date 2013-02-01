$(document).ready(function()
{
  khoa=$("#data #left li li.active").attr("id");                     
  k=$("#thongtin select#k").val();  
//===========RELOAD KHI THAY DOI K====================================================================================================
    $("#tool select#k").change(function()
    {
        var k=$(this).val();        
        var khoa=$("#data #left li li.active").attr("id");
        var display=parseInt($("select#view_num").val());//hien thi bao nhiu?
        var search=$("#search form").children().val();
        window.location.assign("/quanly/chuong-trinh-dao-tao/"+khoa+"/"+k);
    });
    $("#chuyennganh td.macn a.xoa").click(function()
    {
        
        macn=$(this).attr("id");
        //alert(macn);
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/ctdt/ajax_delete_chuyennganh",
            type:"POST",
            data:{macn:macn},
            success:function(result)
            {   
                if(result=="success")
                {
                   window.location.reload(true);
                }
                else
                {                  
                  alert(result);
                  enable_footer(1,1);  
                } 
              
            }//end success
            
        });//end ajax     
        
        
        
        
        
        return false;
    });

//=========================CHECK ALL=========================================================================================================================
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
//=========================CHECKBOX CLICK=========================================================================================================================   
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
    
    
    $(".popup_detail #pdata table input").live("keydown",function()
    {
        
        enable_footer(1,0);
    });
    
    $("button.create_cn").click(function()
    {
       open_popup(".popup_detail#create_chuyennganh");
         	           
    });
    
     $("button.add_cn").click(function()
    {
       open_popup(".popup_detail#add_chuyennganh");
         	           
    });
    
    $(".popup_detail#create_chuyennganh td#socn input").keyup(function()
    {
        socn=$(this).val();
        khoa=$("#data #left li li.active").attr("id");                     
        k=$("#thongtin select#k").val();
       
        if(socn>0)
        {
            html="";
            for(i=1;i<=socn;i++)
            {
                 macn=khoa+"_"+k+"_"+i;
                 //alert(macn);
                html+="<tr id='"+macn+"'><td id='label'>Tên chuyên ngành "+i+"</td><td id='tencn'><input type='text'></input></td></tr>";
            }
            
            $(".popup_detail#create_chuyennganh table#main tr").remove();
            $(".popup_detail#create_chuyennganh table#main").append(html);
        }
    });
    
    
    
//=======THAO TAC TAO CHUYEN NGANH CHO CHUONG TRINH DAO TAO=======================================================================    
    $(".popup_detail#create_chuyennganh img#save").click(function()
    {       
        
        socn=$(".popup_detail#create_chuyennganh td#socn input").val();
        input_tencn=$(".popup_detail#create_chuyennganh table#main td#tencn input");
        tencn_array=new Array();
        input_tencn.each(function()
        {
            tencn_array.push($(this).val());
        });
        //alert(socn+" "+tencn_array+" "+khoa+" "+k);
        
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/ctdt/ajax_create_chuyennganh",
            type:"POST",
            data:{socn:socn,tencn_array:tencn_array,khoa:khoa,k:k},
            success:function(result)
            {   
                if(result=="success")
                {
                   window.location.reload(true);
                }
                else
                {                  
                  alert(result);
                  enable_footer(1,1);  
                } 
              
            }//end success
            
        });//end ajax       
      
    });//end CREATE CHUYENNGANH
    
    
    //=======THAO TAC TAO CHUYEN NGANH CHO CHUONG TRINH DAO TAO=======================================================================    
    $(".popup_detail#add_chuyennganh img#save").click(function()
    {   
        tencn=$(".popup_detail#add_chuyennganh table#main td#tencn input").val();
        alert(tencn);
        
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/ctdt/ajax_add_chuyennganh",
            type:"POST",
            data:{tencn:tencn,khoa:khoa,k:k},
            success:function(result)
            {   
                if(result=="success")
                {
                   window.location.reload(true);
                }
                else
                {                  
                  alert(result);
                  enable_footer(1,1);  
                } 
              
            }//end success
            
        });//end ajax       
      
    });//end ADD CHUYENNGANH
    
    
});//end ready funtion

function enable_footer(save,h4)
{
        
    if(save==0)
    {     
      $(".popup_detail  #pfooter img#save").hide();     
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
 
