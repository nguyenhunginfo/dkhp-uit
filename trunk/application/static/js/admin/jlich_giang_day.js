$(document).ready(function()
{   
    //JSON ojbect luu su thay doi
    array_change={};
   //1 doi tuong lop 
    $("table td p.item").live("hover",function()
    {
        td_array=  $("table td.info");                 
                
        magv=$(this).children("span#magv").html();
        phong=$(this).children("span#phong").html();
        error_magv=$("table td p."+magv);
        error_phong=$("table td p."+phong);
        //DRAPABLE
        $(this).draggable({cursor:"move",
                containment: "#wrapper",
                revert:"invalid",//auto return original position
                Zindex:1000,
                helper:"clone",
                start:function(event,ui)
                {
                    error_magv.parents("td").css("background-color","#fb7383");
                    error_phong.parents("td").css("background-color","#fb7383");
                    $(this).parents("td").css("background-color","white");
                    
                }                                  
                });
                                     
                     
         //DROPPABLE            
        $("table td.info").droppable({accept: "p.item",
                   
                    drop: function( event, ui ) 
                    {                                                            
                        td_old=ui.draggable.parents("td");
                        td_new=$(this);
                                               
                        td_id_new=td_new.attr("id");
                        td_id_old=td_old.attr("id");
                                                              // alert(td_id_new+" "+td_id_old);
                                                               
                        if(td_id_new!=td_id_old)
                        {
                            text=ui.draggable.html();
                            title=ui.draggable.attr("title");
                            malop=ui.draggable.attr("id");
                            tengv=ui.draggable.children("span#tengv").html();
                            magv=ui.draggable.children("span#magv").html();
                            phong=ui.draggable.children("span#phong").html();
                            //KIEM TRA DIEU KIEN
                            if(td_new.children("p#magv").hasClass(magv))
                            {
                                alert("Trùng giáo viên("+tengv+")");
                            }
                            else if(td_new.children("p#phong").hasClass(phong))
                            {
                                alert("Trùng phòng("+phong+")");
                            }                                                                                                
                            else//ADD AND REMOVE ELEMENT
                            {   
                                                                                
                                td_old.children("p#magv").removeClass(magv);
                                td_old.children("p#phong").removeClass(phong); 
                                td_new.children("p#magv").addClass(magv);
                                td_new.children("p#phong").addClass(phong);
                                ui.draggable.hide();  
                                td_new.append("<p class='item' id='"+malop+"' title='"+title+"'>"+text+"</p>"); 
                                                                     
                                ca=Math.floor(td_id_new/10);
                                thu=td_id_new%10;
                                //alert(malop);
                                array_change[malop]={"Ca":ca,"Thu":thu};
                                enable_footer(1);                                             
                            }
                                                    
                        }//end if
                        $("table td").css("background-color","white");
                                           
                    }
            });  //end droppable                
    }); //end hover
//===============LUU SU THAY DOI================================================================================================================
    $("#action img#save").click(function()
    {   $.ajax({
            url:"/lop/luu_lich_giang_day",
            type:"POST",                       
            data:array_change,
            timeout: 10000,//10s
            beforeSend: function()
                {
                    enable_footer(0);	
                },
            error: function (xhr, ajaxOptions, thrownError) {
                enable_footer(1);
                alert("Lưu thất bại");
               
            },                      
            success:function(result)
            {                   
                
                if(result=="success")
                {                
                    enable_footer(1); 
                    $("#message").fadeIn(500).fadeOut(1000);
                }
                else enable_footer(1); 
                
            }
            
            
        });
    });
});//end jlich_giang_day.js 
function enable_footer(save)
{
        
    if(save==0)
    {     
      $("#action img#save").hide();           
      $("#action img#process").show();  
    }
    else  
    {
        $("#action img#process").hide();
        $("#action img#save").show();
              
       
    }
   
    
}    
    
    
    
