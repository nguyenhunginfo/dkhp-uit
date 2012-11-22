$(document).ready(function()
{	
	$("#linklogin p").click(function(e)
	{
		openPopup();
	});
	
	$("#popup").click(function(e)
	{
		closePopup();
	});
    $("#formlogin img#close").click(function(e)
	{
		closePopup();
	});
	
	 $('*').keyup(function(e){

        if(e.keyCode=='27')
		{
			closePopup();
        }         

    });
	
	function openPopup()
	{
		$("#popup").show();
		$("#formlogin").show();
	}
	
	function closePopup()
	{
		$("#popup").hide();
		$("#formlogin").hide();
	}
});