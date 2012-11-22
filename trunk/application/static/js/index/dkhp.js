$(document).ready(function()
{			
	$("#closechangepass").click(function(e)
	{
		$("#popup").hide(); 
		$("#divchangepass").hide();
	});
	
	$("#showchangepass").click(function(e)
	{
		$("#popup").show();
		$("#divchangepass").show();
		$("#divchangepass input").val("");
		$("#errorNewPassword").html("");
		$("#errorOldPassword").html("");
	});
	
	$("#password2").blur(function(e)
	{
		pass1 = $("#password1").val();
		pass2 = $("#password2").val();
		if(pass1 != pass2)
		{
			$("#errorNewPassword").html("Password không trùng!");
		}
		else 
		{
			$("#errorNewPassword").html("");
		}
	});
	
	$("#password1").blur(function(e)
	{
		pass1 = $("#password1").val();
		pass2 = $("#password2").val();
		if(pass1 != pass2)
		{
			$("#errorNewPassword").html("Password không trùng!");
		}
		else 
		{
			$("#errorNewPassword").html("");
		}
	});
			
});