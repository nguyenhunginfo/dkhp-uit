$(document).ready(function()
{
    $("#tool select#view_num").live("change",function()
    {             
            var loai=$("#data #left li li.active").attr("id");            
            
            var display=parseInt($(this).val());//hien thi bao nhiu?			
            var search=$("#search form").children().val();		
                     
			$.ajax(
            {
                url:"/monhoc/ajax_full_data",
                type:"POST",  
                data:{search:search,loai:loai,limit:display},
                beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");	
                },             
                success:function(result)
                {                   
                    $("#content #change_data").html(result); 
                }
            });
           $("#tool #action img#del").css("visibility","hidden");        
    });
    
    
    //event when you click in pagination li
    $("#pagination li a").live("click",function()
    {
        
            var loai=$("#data #left li li.active").attr("id");
            
            var display=parseInt($("select#view_num").val());//hien thi bao nhiu?
            var search=$("#search form").children().val();
    		url=$(this).attr("href");
            index=url.lastIndexOf("/");
            num=url.substr(index+1);
            if(num=="") num=0;
            
			$.ajax(
            {
                url:"/monhoc/ajax_full_data/"+num,
                type:"POST",                  
                data:{search:search,loai:loai,limit:display},
                beforeSend: function()
                {
                    $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");	
                },       
                success:function(result)
                {                    
                   $("#content #change_data").html(result);                   
                }
            });
            $("#tool #action img#del").css("visibility","hidden");
            return false;
                    
    });
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
 
    //event when you click in mssv to see detail
    current_row=null;
    
    $("#table_data td.mamh").live("click",function()
    {	
        current_row=$(this).parent("tr");
        current_row.addClass("active").find(".checkbox_row").attr("checked","checked");
        $("#tool #action").css("visibility","visible");
        
        id=current_row.children("td.mamh").attr("id");
                
        $(".popup_detail#view #ptitle").html("Thông tin chi tiết môn học");
        open_popup(".popup_detail#view");         	           
         $.ajax(
         {
            url:"/monhoc/ajax_data",
            type:"POST",
            data:{id:id},
            beforeSend:function()
            {
                $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");
            },
            success:function(result)
            {                
                $(".popup_detail #pdata").html(result);
                 
            }
        });
        
    });
    
    
    //tim kiem
    $("#search form").submit(function(e)
    {            
        var search=$(this).children().val();//input value
        var loai="tatca";        
        var display=parseInt($("select#view_num").val());//hien thi bao nhiu?       
     
        if(search!="")
        {
            $.ajax(
                {
                    url:"/monhoc/ajax_full_data",
                    type:"POST",                  
                    data:{search:search,loai:loai,limit:display},
                    beforeSend: function()
                    {
                        $("#content #change_data").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' alt='Đang tải...' />");	
                    },        
                    success:function(result)
                    {                    
                       $("#content #change_data").html(result);                      
                       
                    }
                    
                });
                active_search_interface();
            
        }
       e.preventDefault();//prevent to reload when submit
    });
     
    //luu sua doi
    $(".popup_detail#view img#save").click(function()
    {       
        
        key=$(".popup_detail#view table.info").attr("id");
        mamh=$(".popup_detail#view #mamh").val();
        tenmh=$(".popup_detail#view  input#tenmh").val();
        sotc=$(".popup_detail#view  input#sotc").val();
        tclt=$(".popup_detail#view  input#tclt").val();
        tcth=$(".popup_detail#view  input#tcth").val();
        loai=$(".popup_detail#view  select#loai").val();
        kieumh=$(".popup_detail#view  select#kieumh").val();
       
       
        enable_footer(0,0);       
        $.ajax(
         {
            url:"/monhoc/ajax_update",
            type:"POST",
            data:{key:key,mamh:mamh,tenmh:tenmh,sotc:sotc,tclt:tclt,tcth:tcth,loai:loai,kieumh:kieumh},
            success:function(result)
            {   
                
                if(result=="success")
                {
                   window.location.reload(true);
                }
                else
                {                  
                  $(".popup_detail#view table.error").html(result);
                  enable_footer(1,1);  
                } 
              
            }
            
        });       
      
    });//end save action
//=======DELETE MONHOC=================================================================================================================================
    //event when you click bin image
    $("#tool img#del").click(function()
    { 
        
        checkbox=$("#table_data").find(":checked");
        count=checkbox.length;
        id_array=new Array();
        checkbox.each(function()
        {
           id=$(this).attr("id");
           id_array.push(id);
           
        });        
        conf=confirm("Nhắc nhở: Bạn có thật sự muốn xóa "+count+" môn học này không?" ); 
          
        if(conf) 
        {            
            $.ajax({
                        url:"/monhoc/ajax_delete",
                        type:"POST",
                        data:{id_array:id_array},
                        success: function(result)
                        {
                            window.location.reload(true);
                        }
                    });//end ajax_del
        }//end confirm
    });//end del event
    
    
//=======EXPORT MONHOC TO EXCEL=================================================================================================================================    
         //event when you click bin image
        $("#tool img#export").click(function()
        {   
            loai=$("#data #left li li.active").attr("id");  
            
            if(loai=='tatca') ten_loai="Tất cả";
            else if(loai=='DC') ten_loai="Đại Cương";
                 else ten_loai="Chuyên Nghành";
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
                html+='<tr><td>Loại môn học</td><td><input name="loai"  type="hidden" value="'+loai+'" readonly="true"/>'+ten_loai+'</td></tr>'+
                      '<tr><td>Từ môn học thứ</td><td><input name="start"  type="hidden" value="'+start_index+'" readonly="true"/>'+start_index+'</td></tr>'+
                      '<tr><td>Đến môn học thứ</td><td><input name="end"   type="hidden" value="'+end_index+'"   readonly="true"/>'+end_index+'</td></tr>'+
                      '<tr><td>Tổng số môn học</td><td><input         type="hidden" value="'+total_rows+'"  readonly="true"/>'+total_rows+'</tr>'+
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
                
                search=$("#search form").children().val();//input value
                html+='<table>';
                html+='<tr><td>Loại</td><td><input name="loai" type="hidden" value=""  /><input name="search" type="hidden" value="'+search+'" readonly="true"  />Tìm kiếm</td></tr>';
                 
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
        
        $(".popup_detail #pdata select#kieumh").live("change",function()
        {
            kieumh=$(this).val();
            mamh=current_row.children("td.mamh").html();
            //alert(loai+" "+mamh);
            
            $.ajax({
                 url:"/monhoc/ajax_mamh",
                        type:"POST",
                        data:{kieumh:kieumh,mamh:mamh},
                        success: function(result)
                        {
                            $("td#mamh_change").html(result);
                        }
            });//end ajax
            
            
        });
        
        $(".popup_detail #pdata table.info select").live("change",function()
        {
            enable_footer(1,0);
        });
        $(".popup_detail #pdata table.info input,.popup_detail #pdata table.info textarea").live("keydown",function()
        {
            enable_footer(1,0);
        });
        
        
        
        //tu dong tinh so tinh chi thuc hanh
        $(".popup_detail #pdata input#sotc").live("keyup",function()
        {
            sotc=$(this).val();
            tclt=$(".popup_detail #pdata input#tclt").val();
            if(isNaN(sotc)==false&& isNaN(tclt)==false)
            {
                
                if(sotc-tclt>=0)tcth=sotc-tclt;
                else tcth="SoTC=TCLT+TCTH";
                
                $(".popup_detail #pdata input#tcth").val(tcth);
            }
            
        });
        
        $(".popup_detail #pdata input#tclt").live("keyup",function()
        {
            sotc=$(".popup_detail #pdata input#sotc").val();
            tclt=$(this).val();
            
            if(isNaN(sotc)==false&& isNaN(tclt)==false)
            {
                
                if(sotc-tclt>=0)tcth=sotc-tclt;
                else tcth="SoTC=TCLT+TCTH";
                $(".popup_detail #pdata input#tcth").val(tcth);
            }
            
        });
    
});//end ready funtion


function active_search_interface()
{
    $("#right #tool p#data_title").html("Kết quả tìm kiếm");
    $("#tool #action img#del").css("visibility","hidden");    
    $("#data #left li li").removeClass("active");
    $("#right #tool select#view_num").hide();
}

function enable_footer(save,h4)
{
        
    if(save==0)
    {     
      $(".popup_detail #pfooter img#save").hide();     
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
    
    
    
    
    
