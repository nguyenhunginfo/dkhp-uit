$(document).ready(function()
{	
	$("#popup").hide(); 
	$(".popupdetail").hide();
	$("#divchangepass").hide();
	
	$("input.cbdangkylt").live("change", function(e)
	{
		var myString = $("#DKHP").val();
		var checked = $(this).attr("checked");
		var Malop = $(this).attr("id");
		var table = $(this).parents("table").attr("class");
		var sllt = $(this).parents("table").nextAll("div.select").children("p.lt").html();
		var id = $(this).parents("table").nextAll("div.select").children("p.lt").attr("id");
		var ca = $(this).parents("td").siblings(".ca").html();
		var thu = $(this).parents("td").siblings(".thu").html();
		var idTKB = ca + thu;
		if(checked == true)
		{
			myString += " " + Malop + " ";
			sllt++;
			id += Malop;
			//TKB
			var TenMH = $(this).parents("td").siblings(".TenMH").html();
			if(ca != "" && thu !="*")
			{
				var TenGV = $(this).parents("td").siblings(".TenGV").html();
				var Phong = $(this).parents("td").siblings(".Phong").html();
				var title = $("#" + idTKB).attr("title") + Malop + " " + TenMH + " " + TenGV + " P" + Phong + "./ ";
				var html = $("#" + idTKB).html();
				html = TKB_them(html);
				$("#" + idTKB).attr("title", title);
				$("#" + idTKB).html(html);
			}
			//liệt kê môn đk
			$("#lietkedk").children("ol").append("<li id='mondk" + Malop + "'>" + TenMH + "</li>");
		}
		else
		{
			myString = myString.replace(Malop,"");
			sllt--;
			id = id.replace(Malop, "");
			//TKB
			if(ca != "" && thu !="*")
			{
				var html = $("#" + idTKB).html();
				html = TKB_bot(html);
				var title = $("#" + idTKB).attr("title");
				var tArray = title.split("./");
				title = "";
				for(i = 0; i < tArray.length; i++)
				{
					if(tArray[i] == "" || tArray[i] == " ")
						continue;
					if(tArray[i].search(Malop + " ") >= 0)
					{
						tArray[i] = "";
					}
					else
					{
						title += tArray[i] + "./ ";
					}
				}
				$("#" + idTKB).attr("title", title);
				$("#" + idTKB).html(html);
			}
			//Xóa môn đk
			$("#mondk" + Malop).remove();
		}
		$("#DKHP").val(myString);	
		$(this).parents("table").nextAll("div.select").children("p.lt").html(sllt);
		$(this).parents("table").nextAll("div.select").children("p.lt").attr("id", id);
	});
	
	$("input.cbdangkyth").live("change", function(e)
	{
		var myString = $("#DKHP").val();
		var checked = $(this).attr("checked");
		var Malop = $(this).attr("id");
		var table = $(this).parents("table").attr("class");
		var slth = $(this).parents("table").nextAll("div.select").children("p.th").html();
		var id = $(this).parents("table").nextAll("div.select").children("p.th").attr("id");
		var ca = $(this).parents("td").siblings(".ca").html();
		var thu = $(this).parents("td").siblings(".thu").html();
		var idTKB = ca + thu;
		if(checked == true)
		{
			myString += " " + Malop + " ";
			slth++;
			id += Malop;
			//TKB
			if(ca != "" && thu !="*")
			{
				var TenMH = $(this).parents("td").siblings(".TenMH").html();
				var TenGV = $(this).parents("td").siblings(".TenGV").html();
				var Phong = $(this).parents("td").siblings(".Phong").html();
				var title = $("#" + idTKB).attr("title") + Malop + " " + TenMH + " " + TenGV + " P" + Phong + "./ ";
				var html = $("#" + idTKB).html();
				html = TKB_them(html);
				$("#" + idTKB).attr("title", title);
				$("#" + idTKB).html(html);
			}
		}
		else
		{
			myString = myString.replace(Malop, "");
			slth--;
			id = id.replace(Malop, "");
			//TKB
			if(ca != "" && thu !="*")
			{
				var html = $("#" + idTKB).html();
				html = TKB_bot(html);
				var title = $("#" + idTKB).attr("title");
				var tArray = title.split("./");
				title = "";
				for(i = 0; i < tArray.length; i++)
				{
					if(tArray[i] == "" || tArray[i] == " ")
						continue;
					if(tArray[i].search(Malop + " ") >= 0)
					{
						tArray[i] = "";
					}
					else
					{
						title += tArray[i] + "./ ";
					}
				}
				$("#" + idTKB).attr("title", title);
				$("#" + idTKB).html(html);
			}
		}
		$("#DKHP").val(myString);	
		$(this).parents("table").nextAll("div.select").children("p.th").html(slth);
		$(this).parents("table").nextAll("div.select").children("p.th").attr("id", id);
	});
	
	$(".select").live("click", function(e)
	{
		var sllt = $(this).children(".lt").html();
		var slth = $(this).children(".th").html();
		var id = "show" + $(this).parents("div.popupdetail").attr("id");	
		if(slth == -1)
		{
			if(sllt == 0)
			{
				$("#" + id).html("đăng ký");
			}
			else
			{
				if(sllt == 1)
				{
					var Malop = $(this).children(".lt").attr("id");
					$("#" + id).html(Malop);
				}
				else
				{
					alert("Bạn chọn quá nhiều lớp cho một môn học!");
				}
			}
			closePopup();
			return;
		}
		if(sllt == slth)
		{	
			if(sllt == 0)
			{
				//chưa đăng ký
				$("#" + id).html("đăng ký");
				closePopup();
			}
			else
			{
				if(sllt == 1)
				{					
					//đăng ký 1 lớp lt, 1 lớp th
					var Malop = $(this).children(".lt").attr("id") + ", " + $(this).children(".th").attr("id");
					$("#" + id).html(Malop);
					closePopup();
				}
				else
				{
					alert("Bạn chọn quá nhiều lớp cho một môn học!");
				}
			}
		}
		else
		{
			if(sllt == 0)
			{
				alert("Bạn đã chọn lớp thực hành mà chưa chọn lớp lý thuyết!");
			}
			else
			{
				if(slth == 0)
				{
					alert("Bạn đã chọn lớp lý thuyết mà chưa chọn lớp thực hành!");
				}
				else
				{
					alert("Bạn chọn quá nhiều lớp cho một môn học!");
				}
			}
		}
	});
	
	$("#showchangepass").click(function(e)
	{
		$("#popup").show();
		$("#divchangepass").show();
	});
	
	$("#password2").blur(function(e)
	{
		pass1 = $("#password1").val();
		pass2 = $("#password2").val();
		if(pass1 != pass2)
		{
			$("#errorPassword").html("Password không trùng!");
		}
		else 
		{
			$("#errorPassword").html("");
		}
	});
	
	function closePopup()
	{
		$("#popup").hide();
		$(".popupdetail").hide();
	}
		
	function TKB_them(s)
	{
		if(s == "")
			return "X";
		if(s == "X")
			return "X<sup>2</sup>";
		var temp = s[6] + 1;
		return "X<sup>" + temp + "</sup>";
	}
	
	function TKB_bot(s)
	{
		if(s == "X")
			return "";
		var temp = s[6] - 1;
		if(temp == 1)
			return "X";
		return "X<sup>" + temp + "</sup>";
	}

	
	
});