$(document).ready(function()
{
	var curMaMH = "";
	
	$("div.divmnhide").live("click", function(e)
	{
		var cn = $("div.divmnshow").html();
		alert("Bạn đã chọn chuyên ngành " + cn + ". Nếu muốn chuyển CN bạn hãy bỏ tất cả các lớp của chuyên ngành " + cn);
	});
	
	$("input.cbdknlt").live("change", function(e)
	{
		var checked = $(this).attr("checked");
		lopxoa = $(this).parents("table").find("input:checked");
		lopxoa.attr("checked", false);
		$(this).attr("checked", checked);
		if(checked == true || checked == "checked")
		{
			$("div#ltnew").html($(this).attr("id"));
		}
		else
		{
			$("div#ltnew").html("");
		}
	});	
	
	$("input.cbdknth").live("change", function(e)
	{
		var checked = $(this).attr("checked");
		lopxoa = $(this).parents("table").find("input:checked");
		lopxoa.attr("checked", false);
		$(this).attr("checked", checked);
		if(checked == true || checked == "checked")
		{
			$("div#thnew").html($(this).attr("id"));
		}
		else
		{
			$("div#thnew").html("");
		}
	});
	
	$("#contenttable tr td p.showmcn").click(function(e)
	{
	   //alert("me");
		var ID = $(this).attr("id").substr(4);
		var MaMH = $(this).attr("title");
        //alert(ID);
		$.ajax(
        {
            url:"/index/mcn",
            type:"POST",  
            data:{ID:ID},
            success:function(res)
            {
				$("#monnhomajax").html(res);
				$("#popup").show();
				$("#monnhom").show();
            },
			error:function(err)
			{
				$("#monnhomajax").html(err);
			}
        });
	});
	
	$("#contenttable tr td p.showmtc").click(function(e)
	{
		var ID = $(this).attr("id").substr(4);
		var MaMH = $(this).attr("title");
		$.ajax(
        {
            url:"/index/mtc",
            type:"POST",  
            data:{ID:ID, MaMH: MaMH},
            success:function(res)
            {
				$("#monnhomajax").html(res);
				$("#popup").show();
				$("#monnhom").show();
            },
			error:function(err)
			{
				$("#monnhomajax").html(err);
			}
        });
	});
	
	$("div#monnhom div.selectMN").live("click", function(e)
	{
		var del = "";
		var ins = "";
		var ltold = $("#ltold").html();
		var ltnew = $("#ltnew").html();
		if($("#ltold").html()==$("#ltnew").html())
		{
			if($("#thold").html()==$("#thnew").html())
			{
				closePopup();
				return;
			}
			else
			{
				del = del + " " + $("#thold").html();
				ins = ins + " " + $("#thnew").html();
			}
		}
		else
		{
			del = del + " " + $("#ltold").html();
			ins = ins + " " + $("#ltnew").html();
			if($("#thold").html() != $("#thnew").html())
			{
				del = del + " " + $("#thold").html();
				ins = ins + " " + $("#thnew").html();
			}
		}
		var MaCN = $("div.mnshow").attr("id").substr(3);
		var IDnhom = $("#idnhom").html();
		$.ajax(
        {
            url:"/index/dkmn",
            type:"POST",
            data:{MaCN:MaCN,IDnhom:IDnhom,del:del,ins:ins},
            success:function(res)
            {
				if(res != "")
				{
					alert (res);
					return;
				}
				var te = ltold.split(".");
				ltold = te[0];
				var ltnew1 = ltnew;
				var te = ltnew.split(".");
				ltnew = te[0];
				$("#mondk" + ltold).remove();
				var TenMH = "";
				if(ltnew != "")
				{	
					TenMH = $("#monnhom").find("input:checked").parents("td").siblings(".TenMH").html();
					//TenMH = $("#" + ltnew).parents("td").siblings(".TenMH").html();
					$("#lietkedk").children("ol").append("<li id='mondk" + ltnew + "'>" + TenMH + "</li>");
					$("#nhom" + IDnhom).html(ltnew1);
				}
				else
					$("#nhom" + IDnhom).html("Chọn lớp");
				$.ajax(
				{
					url:"/index/updateTKB",
					type:"POST",
					success:function(res1)
					{
						$("#TKBtable").html(res1);
					},
					error:function(err1)
					{}
				});
				$.ajax(
				{
					url:"/index/sotc",
					type:"POST",
					success:function(res1)
					{
						$("#stc").html(res1);
					},
					error:function(err1)
					{}
				});
				closePopup();
            },
			error:function(err)
			{
				$("#monnhomajax").html(err);
			}
        });
	});
	
	$("div.mnnormal").live("click", function(e)
	{
		var IDcn = $(this).attr("id").substr(3);
		$("div.mnshow").attr("class", "mnnormal");
		$("div.divmnshow").attr("class", "divmnnormal");
		$(this).attr("class", "mnshow");
		$("div#content" + IDcn).attr("class", "divmnshow");
	});

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
	
	$("div.popupdetail div.select").live("click", function(e)
	{
		var sllt = $(this).children(".lt").html();
		var slth = $(this).children(".th").html();
		var ltnew = $(this).children(".lt").attr("id");
		var ltold = $(this).children(".lt").attr("title");
		var thnew = $(this).children(".th").attr("id");
		var thold = $(this).children(".th").attr("title");
		var MaMH = $(this).parents("div.popupdetail").attr("id").substr(3);
		var id = "showdiv" + MaMH;	
		var TenMH = $("#div" + MaMH).attr("title");
		if(slth == -1)
		{
			if(sllt == 0)
			{
				$("#" + id).html("Chọn lớp");
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
					return;
				}
			}
		}
		else
		{
			if(sllt == slth)
			{	
				if(sllt == 0)
				{
					//chưa đăng ký
					$("#" + id).html("Chọn lớp");
				}
				else
				{
					if(sllt == 1)
					{				
						//đăng ký 1 lớp lt, 1 lớp th
						var Malop = $(this).children(".lt").attr("id") + ", " + $(this).children(".th").attr("id");
						$("#" + id).html(Malop);
					}
					else
					{
						alert("Bạn chọn quá nhiều lớp cho một môn học!");
						return;
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
				return;
			}
		}
		var del = "";
		var ins = "";
		if(ltold==ltnew)
		{
			if(thold==thnew)
			{
				closePopup();
				return;
			}
			else
			{
				del = del + " " + thold;
				ins = ins + " " + thnew;
			}
		}
		else
		{
			del = del + " " + ltold;
			ins = ins + " " + ltnew;
			if(thold != thnew)
			{
				del = del + " " + thold;
				ins = ins + " " + thnew;
			}
		}
		$.ajax(
        {
            url:"/index/dkmd",
            type:"POST",
            data:{MaMH:MaMH, del:del,ins:ins},
            success:function(res)
            {
				if(res != "")
				{
					alert (res);
					return;
				}
				if(ltold != "")
					$("#mondk" + MaMH).remove();
				if(ltnew != "")
					$("#lietkedk").children("ol").append("<li id='mondk" + MaMH + "'>" + TenMH + "</li>");
				$.ajax(
				{
					url:"/index/sotc",
					type:"POST",
					success:function(res1)
					{
						$("#stc").html(res1);
					},
					error:function(err1)
					{}
				});
				closePopup();
            },
			error:function(err)
			{
				$("#monnhomajax").html(err);
			}
        });
	});
	
	function closePopup()
	{
		$("#popup").hide();
		$(".popupdetail").hide();
		$("#divchangepass").hide();
		$("#monnhom").hide();
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
			
	$("#contenttable tr td p.denghi").live("click", function(e)
	{
		var c = confirm("Tên bạn sẽ được thêm vào lớp này nếu được mở.");
		if(c == false)
		{
			return;
		}
		var p = $(this);
		var td = p.parents("td");
		var MaMH = td.attr("class");		
		$.ajax(
        {
            url:"/index/denghi",
            type:"POST",  
            data:{MaMH:MaMH},
            success:function(result)
            {         
				p.removeClass("denghi");
				p.html("đã đề nghị mở");       
            },
			error:function(er)
			{
				alert(er);
			}
        });
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