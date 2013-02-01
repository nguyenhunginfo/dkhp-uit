$(document).ready(function()
{
    
//====THAO TAC SCROLL=================================================================================================================    
  $("#danhsachmonhoc #fixed").scrollToFixed();
    
  change=false;//bien kiem tra co su thay doi hay khong?
  
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
    $("#action button#luu").click(function()
    { 
        khoa=$("#thongtin td#tenkhoa").attr("class");
        k=$("#thongtin td#k").attr("class");
        hk=$("#thongtin td#hk").attr("class");
        //KHOI TAO BAN DAU
        if(change)
        {
            id_array=new Array();
            td_array=$("#chuongtrinh table td.action"); 
            td_array.each(function()
            {
                   id=$(this).attr("id");
                   id_array.push(id);
                   
            });
            
           // alert(id_array+" "+khoa+ k+hk);
                    
                $.ajax({
                            url:"/ctdt/ajax_update",
                            type:"POST",
                            data:{id_array:id_array,khoa:khoa,k:k,hk:hk},
                            success: function(result)
                            {
                                //alert(result);
                               window.location.assign("/quanly/chuong-trinh-dao-tao/"+khoa+"/"+k);
                             }
                        });//end ajax_del
        }
        else
        {
            //alert("không có sự thây đổi nào");
            window.location.assign("/quanly/chuong-trinh-dao-tao/"+khoa+"/"+k);
        }
        
        
    });//END 
    
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
    
   
    
//====change k and load data again=========================================================================================================
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
//========================================EXPORT DATA TO EXCEL, CSV==========================================================================================================
    //event when you click bin image
    $("#tool img#export").click(function()
    { 
        
        khoa=$("#data #left li li.active").attr("id");
        tenkhoa=$("#data #left li li.active").attr("title");             
        k=$("select#k").val();
        tenk=$("select#k option:selected").html();
        display=parseInt($("select#view_num").val())//hien thi bao nhiu?			
        search=$("#search form").children().val();
        total_rows=$("#pagination").attr("class");
        
        start_index=$("#pagination li.active").html();
        
        if(start_index==null) start_index=0;       
        else start_index=(start_index-1)*display; 
        
        if(display==0)end_index=total_rows;
        else          end_index=start_index+display;
        
        
        html="";
        if(search=="")
        {
            html+='<table>';
            html+='<tr><td>Khoa</td><td><input name="khoa"      type="hidden" value="'+khoa+'"      readonly="true" />'+tenkhoa+'</td></tr>'+
                  '<tr><td>Khóa</td><td><input name="k"         type="hidden" value="'+k+'"         readonly="true" />'+tenk+'</td></tr>'+                    
                  '<tr><td>Từ sinh viên thứ</td><td><input name="start"  type="hidden" value="'+start_index+'" readonly="true"/>'+start_index+'</td></tr>'+
                  '<tr><td>Đến sinh viên thứ</td><td><input name="end"   type="hidden" value="'+end_index+'"   readonly="true"/>'+end_index+'</td></tr>'+
                  '<tr><td>Tổng số sinh viên</td><td><input         type="hidden" value="'+total_rows+'"  readonly="true"/>'+total_rows+'</tr>'+
                  '<tr><td>Kiểu dữ liệu</td>'+
                        '<td><select name="file">'+
                            '<option value="CSV">CSV(tập tin đơn giản)</option>'+
                            '<option value="EXCEL2003">EXCEL 2003(*.XLS)</option>'+
                            '<option value="EXCEL2007">EXCEL 2007(*.XLSX)</option>'+                            
                            '</select>'+
                        '</td>'+
                    '</tr>';             
            html+='</table>';
            $(".popup_detail#export #pdata").html(html);
            
        }
        else
        {
            
            search=$("#search form").children().val();
            html+='<table>';
            html+='<tr><td>Tìm kiếm</td><td><input name="khoa" type="hidden" value="" readonly="true"  />Tìm kiếm <input name="search" type="hidden" value="'+search+'" readonly="true"  /></td></tr>';
            html+='<tr><td>Kiểu dữ liệu</td>'+
                        '<td><select name="file">'+
                            '<option value="CSV">CSV(tập tin đơn giản)</option>'+
                            '<option value="EXCEL2003">EXCEL 2003(*.XLS)</option>'+
                            '<option value="EXCEL2007">EXCEL 2007(*.XLSX)</option>'+
                            '<option value="PDF">PDF(*.PDF)</option>'+
                            '</select>'+
                        '</td>'+
                    '</tr>';              
            html+='</table>';
            $(".popup_detail#export #pdata").html(html);
        }
        open_popup(".popup_detail#export");
    });//END EXPORT
    $(".popup_detail#export form").submit(function()
    {          
        close_popup();
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
    
    
//=========================AJAX LOPHOC IN POPUP=========================================================================================================================    
    $(".popup_detail#view #pdata table.info select#k,.popup_detail#view #pdata table.info select#khoa").live("change",function()
        {
            k=$(".popup_detail#view #pdata table.info select#k").val();
            khoa=$(".popup_detail#view #pdata table.info select#khoa").val();      
             
            
            $.ajax({
                url: "/sinhvien/ajax_lop_from_khoa",
                type:"POST",
                data:{k:k,khoa:khoa},
                success:function(result)
                {
                   // alert(result);
                    $(".popup_detail#view #pdata table.info select#lop").html(result);
                }
            });
            
        }); 
    $(".popup_detail#view #pdata table.info select").live("change",function()
    {
        enable_footer(1,0);
    });
    $(".popup_detail#view #pdata table.info input,.popup_detail#view #pdata table.info textarea").live("keydown",function()
    {
        enable_footer(1,0);
    });
    
});//end ready funtion

function enable_footer(save,h4)
{
        
    if(save==0)
    {     
      $(".popup_detail#view #pfooter img#save").hide();     
      $(".popup_detail#view #pfooter img#process").show();  
    }
    else  
    {
        $(".popup_detail#view #pfooter img#process").hide();
        $(".popup_detail#view #pfooter img#save").show();     
       
    }
    
    if(h4==0) 
    {
     $(".popup_detail#view #pdata table.error").hide();   
     $(".popup_detail#view #pfooter h4").hide();   
    }    
    else
    {
        $(".popup_detail#view #pdata table.error").show();
       $(".popup_detail#view #pfooter h4").show();  
    }     
    
}//end enable_footer
function active_search_interface()
{
    num_row=$("#pagination").attr("class");    
    $("#right #tool p#data_title").html("Kết quả tìm kiếm: "+num_row);
    $("#tool #action img#del").css("visibility","hidden");
    
    $("#data #left li li").removeClass("active");
    $("#right #tool select#view_num").hide();
}
    
/*
 $(".popup_detail#view#view img#pnext").live("click",function()
    {
        current_row=current_row.next();
        next_row=current_row.next();
        prev_row=current_row.prev();
        if(next_row.find("td.masv").html()==null) $(".popup_detail img#pnext").hide();
        else $(".popup_detail img#pnext").show();
        
        if(prev_row.find("td.masv").html()==null) $(".popup_detail img#pprev").hide();
        else $(".popup_detail img#pprev").show();
       $(".popup_detail #pfooter img#save,.popup_detail #pfooter img#process,.popup_detail #pfooter h4").hide();
       
         masv=current_row.children("td.masv").html();
         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");
                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
               	           
         $.ajax(
         {
            url:"/sinhvien/ajax_data",
            type:"POST",
            data:{masv:masv},
            success:function(result)
            {                
                $(".popup_detail #pdata").html(result);
                
            }
        });
    });
    
     $(".popup_detail#view img#pprev").live("click",function()
    {
        current_row=current_row.prev();
        next_row=current_row.next();
        prev_row=current_row.prev();
        if(next_row.find("td.masv").html()==null) $(".popup_detail img#pnext").hide();
        else $(".popup_detail img#pnext").show();
        
        if(prev_row.find("td.masv").html()==null) $(".popup_detail img#pprev").hide();
        else $(".popup_detail img#pprev").show();
        
        $(".popup_detail #pfooter img#save,.popup_detail #pfooter img#process,.popup_detail #pfooter h4").hide();
         
         masv=current_row.children("td.masv").html();         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");                   	           
         $.ajax(
         {
            url:"/sinhvien/ajax_data",
            type:"POST",
            data:{masv:masv},
            success:function(result)
            {                
                $(".popup_detail #pdata").html(result);
                
            }
        }); 
    });
*/    
    
/*
    $("#data #left li li").live("click",function()
    {             
            var khoa=$(this).attr("id");
            var tenkhoa=$(this).attr("title");
            var k=$("select#k").val();
            var display=parseInt($("select#view_num").val());//hien thi bao nhiu?			
            
			
             $("#data ul li ul").find("li.active").removeClass("active");
             $(this).addClass("active");
            
           // alert(khoa+" "+tenkhoa+" "+k+" "+display);
			$.ajax(
            {
                url:"/sinhvien/ajax_full_data",
                type:"POST",  
                data:{khoa:khoa,k:k,limit:display},
                beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                },             
                success:function(result)
                {                   
                    $("#content #change_data").html(result);                    
                    if(khoa!="tatca") $("#right #tool p#data_title").html("&#187;&#187; Danh sách sinh viên khoa "+tenkhoa);
                    else    $("#right #tool p#data_title").html("&#187;&#187; Danh sách sinh viên");
                }
            });
            $("#tool #action").css("visibility","hidden");
            
           
                    
    });
    */    
    
