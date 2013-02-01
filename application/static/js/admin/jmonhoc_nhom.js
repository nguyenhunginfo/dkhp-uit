$(document).ready(function()
{
    
    //chang k and load data again
    $("#tool select#k").change(function()
    {
        var k=$(this).val();        
        var khoa=$("#data #left li li.active").attr("id");
        var display=parseInt($("select#view_num").val());//hien thi bao nhiu?
        var search=$("#search form").children().val();
        
        $.ajax(
        {
            url:"/ctdt/ajax_full_data",
            type:"POST",  
            data:{khoa:khoa,k:k},
            timeout: 10000,//10s
            beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#content #change_data").html("Dữ liệu bị lỗi");
               
            },             
            success:function(result)
            {                
                $("#content #change_data").html(result);
                $("a#link_dieuchinh").attr("href","/quanly/chuong-trinh-dao-tao/dieu-chinh/"+khoa+"/"+k);
            }
        });
        
        $.ajax(
        {
            url:"/ctdt/ajax_sotc",
            type:"POST",  
            data:{khoa:khoa,k:k},
            success:function(result)
            {    
                 text="Tổng số tín chỉ: "+result;
                
                $("#tool #detail span#sotc").html(text);
            }
        });
        
         $.ajax(
        {
            url:"/ctdt/ajax_somon",
            type:"POST",  
            data:{khoa:khoa,k:k},
            success:function(result)
            {                
                text="Tổng số môn: "+result;
                $("#tool #detail span#somon").html(text);
            }
        });
        
        $("#tool #action img#del").css("visibility","hidden");
        
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
//=======DELETE MONHOC=================================================================================================================================
    //event when you click bin image
    $("#tool img#del").click(function()
    { 
        
        checkbox=$("#table_data").find(":checked");
        count=checkbox.length;
        manhom_array=new Array();
        checkbox.each(function()
        {
           manhom=$(this).attr("id");
           manhom_array.push(manhom);
           
        });        
        alert(manhom_array);
        conf=confirm("Nhắc nhở: Bạn có thật sự muốn xóa "+count+" môn học này không?" ); 
          
        if(conf) 
        {            
            $.ajax({
                        url:"/monhoc/ajax_delete_monhoc_nhom",
                        type:"POST",
                        data:{manhom_array:manhom_array},
                        success: function(result)
                        {
                            window.location.reload(true);
                        }
                    });//end ajax_del
        }//end confirm
    });//end del event
    
    
    
});//end ready funtion

    
