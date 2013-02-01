$(document).ready(function()
{
    
    
  $("#danhsachmonhoc #fixed").scrollToFixed();
  change=false;  
    
//====THAO TAC XOA MON HOC=================================================================================================================
    $("#chuongtrinh td.action").live("click",function()
    {
        id=$(this).attr("id");
        
        $(this).html("<button title='Thêm môn học này'>Thêm</button>");
        current_row=$(this).parent("tr"); 
        cla=current_row.attr("class");
             
        new_element="<tr id='"+id+"'class='item "+cla+"'>"+current_row.html()+"</tr>";
        sotc=parseInt(current_row.children("td.sotc").html());
        //alert(new_element);
        
        somon=parseInt($("#thongtin #somon span").html());
        new_sotc=parseInt($("#thongtin #sotc span").html())-sotc;
        $("#thongtin #somon span").html(somon-1);
        $("#thongtin #sotc span").html(new_sotc);
        
        $("#chuongtrinh table tr#"+id).remove();
        $("#danhsachmonhoc table#main").append(new_element);
        change=true;
        
    });
//====THAO TAC THEM MON HOC======================================================================================================
    $("#danhsachmonhoc td.action").live("click",function()
    {
        id=$(this).attr("id");
        
        $(this).html("<button title='Xóa môn học này'>Xóa</button>");
        current_row=$(this).parent("tr"); 
        current_row.removeClass("item");
        cla=current_row.attr("class");       
        new_element="<tr id='"+id+"'class='"+cla+"'>"+current_row.html()+"</tr>";
        sotc=parseInt(current_row.children("td.sotc").html());
        //alert(new_element);
        
        somon=parseInt($("#thongtin #somon span").html());
        new_sotc=parseInt($("#thongtin #sotc span").html())+sotc;
        $("#thongtin #somon span").html(somon+1);
        $("#thongtin #sotc span").html(new_sotc);
        
        $("#danhsachmonhoc table#main tr#"+id).remove();
        $("#chuongtrinh table").append(new_element);
        change=true;
    });
    
//==============CAP NHAT LAI DANH SACH MON HOC==========================================================================================================
    //event when you click SAVE image
    $("#thongtin button#luu").click(function()
    { 
        if(change)
        {
        //KHOI TAO BAN DAU
        id_array=new Array();
        td_array=$("#chuongtrinh table td.action"); 
        td_array.each(function()
        {
               id=$(this).attr("id");
               id_array.push(id);
               
        });
        
        
        manhom=$("#thongtin td#manhom").attr("class");
        //alert(id_array+" "+manhom);
                
                    
            
            
            $.ajax({
                        url:"/monhoc/ajax_update_nhom_monhoc",
                        type:"POST",
                        data:{id_array:id_array,manhom:manhom},
                        success: function(result)
                        {
                           // alert(result);
                           window.location.assign("/quanly/monhoc/mon-hoc-nhom/"+manhom);
                         }
                    });//end ajax_del
                    
        }
        else
        {
            window.location.assign("/quanly/monhoc/mon-hoc-nhom/"+manhom);
        }
    });//END LUU MON HOC CHO NHOM
    
    
//====XOA MOT HOC KY CUA CTDT=========================================================================================================    
    $("#action button#xoa").click(function()
    { 
            //alert("me");
            row_array=$("#chuongtrinh tr");      
            row_array.each(function()
            {
                id=$(this).attr("id");
                if(id!="first")
                {
                    $(this).children("td.action").html("<button title='Thêm môn học này'>Thêm</button>");
                    cla=$(this).attr("class");
                    new_element="<tr id='"+id+"'class='item "+cla+"'>"+$(this).html()+"</tr>";
                    $("#danhsachmonhoc table#main").append(new_element);
                    $(this).remove();
                    }
            });
            
            
            $("#thongtin #somon span").html(0);
            $("#thongtin #sotc span").html(0);
            
            
           
        
    });//END XOA
    
    
   //====TUY CHON MON HOC=========================================================================================================
    $("#danhsachmonhoc table#fixed button").click(function()
    {
        var loai_mh=$(this).attr("id");       
        if(loai_mh=="all") $("table#main tr.item").show();
        else
        {
            $("table#main tr.item").show();
            $("table#main tr.item").hide();
            $("table#main tr."+loai_mh).show();    
        } 
        $("#danhsachmonhoc button").removeAttr("disabled");
        $(this).attr("disabled","disabled");
        
    });
    
    
});