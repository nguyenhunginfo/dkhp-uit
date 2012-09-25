$(document).ready(function()
{
    $("body").keydown(function(e)
    {
        
        if(e.keyCode==27)
        {
            
            close_popup();
        }
    }); 
   
    $(".overflow,#pclose").click(function()
    {
        close_popup();
    });
     
});

function open_popup(object)
{    
    $(object).show();
    $(".overflow").show();
}
function close_popup()
{
    $(".popup_detail").hide();
    $(".overflow").hide();
}


