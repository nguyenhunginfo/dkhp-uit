$(document).ready(function()
{			
	$("input.cbdangkylt").live("change", function(e)
	{
		var myString = $("#DKHP").val();
		var checked = $(this).attr("checked");
		var Malop = $(this).attr("id");
		var MaMH = $(this).parents("table").attr("id");
		var table = $(this).parents("table").attr("class");
		var sllt = $(this).parents("table").nextAll("div.select").children("p.lt").html();
		var id = $(this).parents("table").nextAll("div.select").children("p.lt").attr("id");
		var ca = $(this).parents("td").siblings(".ca").html();
		var thu = $(this).parents("td").siblings(".thu").html();
		var idTKB = ca + thu;
		if(checked == true || checked == "checked")
		{
			myString += " " + Malop + " ";
			sllt = 1;
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
			//Xóa lớp khác nếu có
			$(this).attr("checked", false);
			var other = $(this).parents("table").find("input:checked:not(#" + Malop + ")").attr("id");
			if( typeof(other) != "undefined")
			{
				lopxoa = $(this).parents("table").find("input:checked");
				lopxoa.attr("checked", false);
				$(this).attr("checked", true);
				
				myString = myString.replace(other,"");
				id = id.replace(other, "");
				
				//TKB
				ca = lopxoa.parents("td").siblings(".ca").html();
				thu = lopxoa.parents("td").siblings(".thu").html();
				idTKB = ca + thu;
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
			else
			{
				$(this).attr("checked", true);
				//liệt kê môn đk
				$("#lietkedk").children("ol").append("<li id='mondk" + MaMH + "'>" + TenMH + "</li>");
			}
		}
		else
		{
			myString = myString.replace(Malop,"");
			sllt = 0;
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
			$("#mondk" + MaMH).remove();
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
		if(checked == true || checked == "checked")
		{
			myString += " " + Malop + " ";
			slth = 1;
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
			//Xóa lớp khác nếu có
			$(this).attr("checked", false);
			var other = $(this).parents("table").find("input:checked").attr("id");
			if( typeof(other) != "undefined")
			{
				lopxoa = $(this).parents("table").find("input:checked");
				$(this).attr("checked", true);
				lopxoa.attr("checked", false);
				
				myString = myString.replace(other,"");
				id = id.replace(other, "");
				
				//TKB
				ca = lopxoa.parents("td").siblings(".ca").html();
				thu = lopxoa.parents("td").siblings(".thu").html();
				idTKB = ca + thu;
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
			else
			{
				$(this).attr("checked", true);
			}
		}
		else
		{
			myString = myString.replace(Malop, "");
			slth = 0;
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
	
	function closePopup()
	{
		$("#popup").hide();
		$(".popupdetail").hide();
		$("#divchangepass").hide();
	}
	
	
	$("#xuatfile").click(function(e)
	{
		var MSSV = $("#MSSV").html();
		var khoa = $("#khoa").attr("class");
		$.ajax(
        {
            url:"/index/xuatfile",
            type:"POST",  
            data:{MSSV:MSSV, khoa:khoa},
            success:function(result)
            {                
            },
			error:function(er)
			{
				alert("Quá trình xuất file bị lỗi!");
			}
        });
	});
	
    //Sự kiện in file
    $("#in").click(function()
    {
		var MSSV = $("#MSSV").html();
		var khoa = $("#khoa").attr("class");	
		var data = MSSV + " " + khoa;
	
        $("#holdIframe").html("");
        $("#holdIframe").html("<iframe name='myname' src='index/in/" + data + "' />");
        $("iframe").load(function() 
        {
			window.frames["myname"].focus();
            window.frames["myname"].print();				
        });
        $("div#holdIframe").hide();
	}); 
		
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