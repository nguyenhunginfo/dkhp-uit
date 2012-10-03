$(document).ready(function()
{   
        
$(".data_box h4 span").click(function()
{
    h4=$(this).parent("h4");
    cla=h4.attr("class");
    //alert(cla);
    id=$(this).parents(".data_box").attr("id");
    if(cla=="expand")
    {
       
    
        $(".data_box#"+id+" ul li li").show();
        h4.attr("class","mini");
        $(this).attr("title","Thu nhỏ");
    }
    else
    {
        $(".data_box#"+id+" ul li li").hide();
        h4.attr("class","expand");
        $(this).attr("title","Mở rộng");
    }
    
    
});  
$(".data_box ul li span").click(function()
{
    
    li=$(this).parents("li");
    me=li.find("ul li");
    me.toggle();
});
});
    
    
    
    
    
