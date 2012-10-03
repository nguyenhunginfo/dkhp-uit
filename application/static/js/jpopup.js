$(document).ready(function()
{
    $("body").keydown(function(e)
    {        
        if(e.keyCode==27)close_popup();
      
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
    reset_all();
}
function close_popup()
{
    $(".popup_detail").hide();
    $(".overflow").hide();
}
function reset_all()
{
    $(".popup_detail #pfooter img#save,.popup_detail #pfooter img#process,.popup_detail #pfooter h4").hide();
}

