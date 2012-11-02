<!DOCTYPE HTML>
<head>
	<meta name="author" content="danhkhh" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Thời khóa biểu</title>
	<link href="<?php echo static_url();?>/css/index/vtkb.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo static_url();?>/js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{	
		});
	</script>	
</head>

<body>
	<div id="thu">
		<ul>
			<li>Thứ 2</li>
			<li>Thứ 3</li>
			<li>Thứ 4</li>
			<li>Thứ 5</li>
			<li>Thứ 6</li>
			<li>Thứ 7</li>
		</ul>
	</div>
	<table id="TKBtable" cellspacing="0">
        <!--<tr>
			<th colspan="2"></th>
            <th>Thứ 2</th>
            <th>Thứ 3</th>
            <th>Thứ 4</th>
            <th>Thứ 5</th>
            <th>Thứ 6</th>
			<th>Thứ 7</th>
		</tr> -->
        <tr>
			<td rowspan="2" style="width: 60px;">Sáng</td>
			<td class="ca">ca 1</td>
			<?php
				for($thu = 2; $thu <= 7; $thu++)
				{
					echo "<td class='lop'>".$TKB[$thu - 2]."</td>";
				}
			?>
        </tr>
        <tr>
			<td class="ca" style="border-left: 1px solid #DCDDDE;">ca 2</td>
			<?php
				for($thu = 2; $thu <= 7; $thu++)
				{
					echo "<td class='lop'>".$TKB[$thu + 4]."</td>";
				}
			?>
        </tr>
        <tr>
            <td rowspan="2">Chiều</td>
			<td class="ca">ca 3</td>
			<?php
				for($thu = 2; $thu <= 7; $thu++)
				{
					echo "<td class='lop'>".$TKB[$thu + 10]."</td>";
				}
			?>
            </tr>
        <tr>
			<td class="ca" style="border-left: 1px solid #DCDDDE">ca 4</td>
			<?php
				for($thu = 2; $thu <= 7; $thu++)
				{
					echo "<td class='lop'>".$TKB[$thu + 16]."</td>";
				}
			?>
        </tr>
    </table>
	
	<button id="btnTaiFile">Tải file</button>
	<button id="btnInTKB">In TKB</button>
	
</body>
</html>