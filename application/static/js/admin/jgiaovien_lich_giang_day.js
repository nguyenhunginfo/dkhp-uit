$(document).ready(function()
{
    
    
//================================CHANGE VIEW NUM=====================================================================================================
    $("#tool select#view_num").live("change",function()
    {             
            var khoa=$("#data #left li li.active").attr("id");            
            var k=$("select#k").val();
            var display=parseInt($(this).val());//hien thi bao nhiu?			
            var search=$("#search form").children().val();
			
           //  alert(k+" "+khoa+" "+display+" "+start_num);            
            
			$.ajax(
            {
                url:"/sinhvien/ajax_full_data",
                type:"POST",  
                data:{search:search,khoa:khoa,k:k,limit:display},
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
                    
                }
            });
            $("#tool #action img#del").css("visibility","hidden");        
    });

//==================AJAX PAGINATION================================================================================================================================    
    //event when you click in pagination li
    $("#pagination li a").live("click",function()
    {
        
            var khoa=$("#data #left li li.active").attr("id");
            var k=$("select#k").val();
            var display=parseInt($("select#view_num").val());//hien thi bao nhiu?
            var search=$("#search form").children().val();
    		url=$(this).attr("href");
            index=url.lastIndexOf("/");
            num=url.substr(index+1);
            if(num=="") num=0;
            
			$.ajax(
            {
                url:"/sinhvien/ajax_full_data/"+num,
                type:"POST",                  
                data:{search:search,khoa:khoa,k:k,limit:display},
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
                }
            });
            $("#tool #action img#del").css("visibility","hidden");
            return false;
                    
    });//END PAGINATION
    
   
//========================EDIT SINH VIEN========================================================================================================================== 
    //event when you click in mssv to see detail
    
    current_row=null;
    $("#table_data td.magv").live("click",function()
    {
		
        current_row=$(this).parent("tr");
        current_row.addClass("active").find(".checkbox_row").attr("checked","checked");
        $("#tool #action img#del").css("visibility","visible");               
       
        magv=current_row.children("td.magv").html();
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết giáo viên");         
         open_popup(".popup_detail#view");
         	           
         $.ajax(
         {
            url:"/giaovien/ajax_data",
            type:"POST",
            data:{magv:magv},
            timeout: 10000,//10s
            beforeSend: function()
                {
                    $(".popup_detail#view #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");	
                },
            error: function (xhr, ajaxOptions, thrownError) {
                $(".popup_detail#view #pdata").html("Dữ liệu bị lỗi");
               
            },    
            success:function(result)
            {                
                $(".popup_detail#view #pdata").html(result);
                 
            }
        });
    }); //END EDIT SINHVIEN   
   
     
//=================UPDATE SINHVIEN=================================================================================================================================   
    $(".popup_detail#view img#save").click(function()
    {
        
        key=$(".popup_detail#view table.info").attr("id");
        magv=$(".popup_detail#view input#magv").val();
        tengv=$(".popup_detail#view  input#tengv").val();        
        ngaysinh=$(".popup_detail#view  input#ngaysinh").val();
        noisinh=$(".popup_detail#view  textarea#noisinh").val();
        sodt=$(".popup_detail#view  input#sodt").val();
        email=$(".popup_detail#view  input#email").val();
        alert(key+" "+magv+" "+tengv+" "+sodt+" "+email);
       
           
        $.ajax(
         {
            url:"/giaovien/ajax_update",
            type:"POST",
            data:{key:key,magv:magv,tengv:tengv,ngaysinh:ngaysinh,noisinh:noisinh,sodt:sodt,email:email},
            timeout: 10000,//10s
            beforeSend: function()
                {
                    enable_footer(0,0);                	
                },
            error: function (xhr, ajaxOptions, thrownError) {
                enable_footer(1,1);  
                alert("Thao tác sửa đổi thất bại. Thử lại sau.");
                
                },   
            success:function(result)
            {   
                //alert(result);
                if(result=="success")
                {
                   
                   current_row.children("td.magv").html(magv);
                   current_row.children("td.tengv").html(tengv);
                   current_row.children("td.ngaysinh").html(ngaysinh);
                   current_row.children("td.noisinh").html(noisinh);
                   current_row.children("td.sodt").html(sodt);
                   current_row.children("td.email").html(email);
                   
                   $("#content #message").fadeIn(1000).fadeOut(2000);                   
                   close_popup();
                }
                else
                {
                  
                  $(".popup_detail#view table.error").html(result);
                  enable_footer(1,1);  
                } 
             
            }//end success
            
        }); //end ajax 
         
            
      
    });//end UPDATE SINHVIEN
    
//==============DELETE SINHVIEN==========================================================================================================
    //event when you click bin image
    $("#tool img#del").click(function()
    { 
        checkbox=$("#table_data").find(":checked");
        count=checkbox.length;
        msgv_array=new Array();
        checkbox.each(function()
        {
           msgv=$(this).attr("id");
           msgv_array.push(msgv);
           
        });
        
        khoa=$("#data #left li li.active").attr("id");
        if(khoa==undefined) khoa=""; 
        //alert(msgv_array+" "+khoa);
        conf=confirm("Nhắc nhở: Bạn có thật sự muốn xóa "+count+" sinh viên này không?\nDanh sách MSSV: "+msgv_array );        
        if(conf) 
        {            
            $.ajax({
                        url:"/giaovien/ajax_delete",
                        type:"POST",
                        data:{msgv_array:msgv_array,khoa:khoa},
                        success: function(result)
                        {
                            //alert(result);
                            $("#content #message span").html(result);
                            $("#content #message").fadeIn(1000).fadeOut(1000);
                            
                            var search=$("#search form").children().val();
                            var k=$("select#k").val();
                            var display=parseInt($("#tool select#view_num").val());//hien thi bao nhiu?			
                            var start_num=0;
                            var khoa=$("#data #left li li.active").attr("id");
                            if(khoa==undefined) khoa="cnpm";
                            
                            
                    			$.ajax(
                                {
                                    url:"/giaovien/ajax_full_data",
                                    type:"POST",  
                                    data:{search:search,khoa:khoa,k:k,start:start_num,limit:display},
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
                                        
                                    }
                                });//end ajax full data
                                $("#tool #action img#del").css("visibility","hidden");
                                
                             
                         }
                    });//end ajax_del
        }//end confirm
        
    });//END DELETE SINHVIEN
//=======================SEARCH SINH VIEN===========================================================================================================================     
    $("#search form").submit(function(e)
    {     
       
        var search=$(this).children().val();//input value        
        var k=$("select#k").val();    
        var display=parseInt($("select#view_num").val());//hien thi bao nhiu?       
        
        if(search!="")
        {
            $.ajax(
                {
                    url:"/giaovien/ajax_full_data",
                    type:"POST",                  
                    data:{search:search,k:k,limit:display},
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
                    }
                    
                });
            
            active_search_interface();
        }
       e.preventDefault();//prevent to reload when submit
    });//END SEARCH SINH VIEN
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
                url: "/giaovien/ajax_lop_from_khoa",
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
    $("#right #tool p#data_title").html("Kết quả tìm kiếm");
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
        if(next_row.find("td.magv").html()==null) $(".popup_detail img#pnext").hide();
        else $(".popup_detail img#pnext").show();
        
        if(prev_row.find("td.magv").html()==null) $(".popup_detail img#pprev").hide();
        else $(".popup_detail img#pprev").show();
       $(".popup_detail #pfooter img#save,.popup_detail #pfooter img#process,.popup_detail #pfooter h4").hide();
       
         magv=current_row.children("td.magv").html();
         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");
                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");
               	           
         $.ajax(
         {
            url:"/giaovien/ajax_data",
            type:"POST",
            data:{magv:magv},
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
        if(next_row.find("td.magv").html()==null) $(".popup_detail img#pnext").hide();
        else $(".popup_detail img#pnext").show();
        
        if(prev_row.find("td.magv").html()==null) $(".popup_detail img#pprev").hide();
        else $(".popup_detail img#pprev").show();
        
        $(".popup_detail #pfooter img#save,.popup_detail #pfooter img#process,.popup_detail #pfooter h4").hide();
         
         magv=current_row.children("td.magv").html();         
         $(".popup_detail#view #ptitle").html("Thông tin chi tiết sinh viên");                    
         $(".popup_detail #pdata").html("<img  id='waiting' src='http://localhost/dkhp/application/static/images/loading.gif' />");                   	           
         $.ajax(
         {
            url:"/giaovien/ajax_data",
            type:"POST",
            data:{magv:magv},
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
                url:"/giaovien/ajax_full_data",
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
    
