<?php
    echo "<table>";
    foreach($result->result_object() as $row)
    {
        echo "<tr>";
        echo "<td>".$row->MaMH."</td>";
        echo "<td>".$row->TenMH."</td>";
        echo "</tr>";
    }
    echo "</table>";
 ?>
<form action="" method="POST">
<input type="submit" name="submit" value="Export" />
</form>