$(document).ready(function()
{   
    
   
    $("#action img#create").click(function()
    {
        
        file_name=$("table.info input#file_upload").val();
        
        if(file_name=="") alert("Hãy chọn tập tin dữ liệu trước"); 
        else $("form").submit();
        
       
        
        
    });//end save action
    $("table.info input#file_upload").change(function()
    {
        filename=$(this).val();
        
        if(filename!="")
        {
            ext=filename.split('.').pop();
            if(ext!="csv"&&ext!="xls"&&ext!="xlsx")
            {
              alert("Kiểu dữ liệu không hợp lệ.\nVui lòng chọn những tập tin sau: csv,excel2003(.xls),excel2007(.xlsx)");
              $(this).val("");  
            } 
            
        }
        $("#right h3").html("Thao tác nhập dữ liệu từ tập tin");
        $("#data_checking").html("");
        $("#right form #action p").html("");
    });
    $("table.info input").change(function()
    {
        
        
        $("#data_checking").html("");
        $("#right form #action p").html("");
        
    });
});

    
    
    
    
