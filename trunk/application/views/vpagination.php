<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<title>Pagination test</title>
    <script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
    
<body>
<script type="text/javascript">
$(document).ready(function()
{
    $("#pagination a").live("click",function()
    {
        url=$(this).attr("href");
        index=url.lastIndexOf("/");
        num=url.substr(index+1);
        if(num=="") num=0;
       // alert(url+" "+num);
        
        $.ajax({
            url:"/pagination/ajax_test/"+num,
            type:"POST",
            data:{num:num},
            success:function(result)
            {
                $("#wrapper").html(result);
            }
        });
        return false;
    });
});
</script>
<div id="wrapper">

<table>
    <tr>
        <th style="width:100px">Mã Môn Học</th>
        <th style="width:250px">Tên Môn Học</th>
        
    </tr>
    <?php
		
        foreach($result as $row)
        {
            echo"<tr>";
            echo "<td>".$row->MaMH."</td>";
            echo "<td>".$row->TenMH."</td>";
           
            echo "</tr>";
        }
     ?>
    
</table>
<div id="pagination">
<?php echo $this->pagination->create_links();?>
</div>



</div>
</body>
</html>