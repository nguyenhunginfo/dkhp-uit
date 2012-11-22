$(document).ready(function()
{   
    
   //event when you click create button
    $("#action img#create").click(function()
    {
        khoa=$("table.info select#khoa").val();
        file_name=$("table.info input#file_upload").val();
        if(khoa=="") alert("Hãy chọn khoa trước");
        else if(file_name=="") alert("Hãy chọn tập tin dữ liệu trước"); 
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
    $("table.info select,table.info input").change(function()
    {
        
        $("#right h3").html("Thao tác nhập dữ liệu từ tập tin");
        $("#data_checking").html("");
        $("#right form #action p").html("");
        
    });
    
    $("#data_checking td.im_error").click(function()
    {
        
        error_msg=$(this).children("img").attr("title");
        alert(error_msg);
        
    });
});

    
    
    
    
