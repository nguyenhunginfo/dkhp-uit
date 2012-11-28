$(document).ready(function()
{   
//=======EXPORT MONHOC TO EXCEL=================================================================================================================================    
         //event when you click bin image
        $("#tool img#export").click(function()
        {   
            
            malop=$("#tool span#malop").html();
            tenmh=$("#tool span#tenmh").html();
            total_rows=$("#tool p#total").html();
            
            html="";            
            html+='<table>';
            html+='<tr><td>Mã lớp</td><td><input name="malop"  type="hidden" value="'+malop+'"/>'+malop+'</td></tr>'+                      
                      '<tr><td>Tên Môn Học</td><td>'+tenmh+'</td></tr>'+
                      '<tr><td>Tổng số lớp</td><td><input         type="hidden" value="'+total_rows+'"  readonly="true"/>'+total_rows+'</tr>'+
                      '<tr><td>Kiểu dữ liệu</td>'+
                            '<td><select name="file">'+                                
                                '<option value="EXCEL2003">EXCEL 2003(*.XLS)</option>'+
                                '<option value="EXCEL2007">EXCEL 2007(*.XLSX)</option>'+                            
                                '</select>'+
                            '</td>'+
                        '</tr>';             
            html+='</table>';
            $(".popup_detail#export #pdata").html(html);                
        
            open_popup(".popup_detail#export");
            
            
        });//END EXPORT
        $(".popup_detail#export form").submit(function()
        {          
            close_popup();
        });
    
});//end ready funtion

    
    
    
    
    
