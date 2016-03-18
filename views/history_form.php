<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="font-size:20px; font-family:Calibri; color:red"><b>Type</b></th>
            <th class="text-center" style="font-size:20px; font-family:Calibri; color:blue"><b>Date/Time</b></th>
            <th class="text-center" style="font-size:20px; font-family:Calibri; color:green"><b>Symbol</b></th>
            <th class="text-center" style="font-size:20px; font-family:Calibri; color:yellow"><b>Shares</b></th>
            <th class="text-center" style="font-size:20px; font-family:Calibri; color:pink"><b>Price</b></th>
        </tr>
    </thead>

    <tbody bgcolor="#E6E6FA">
    <?php
	    foreach ($table as $row)	
        {   
            echo("<tr>");
            echo("<td><i> " . $row["type"] . "</i></td>");
            echo("<td>" . date('d/m/y, g:i A',strtotime($row["time"])) . "</td>");
            echo("<td>" . $row["symbol"] . "</td>");
            echo("<td>" . $row["shares"] . "</td>");
            echo("<td><b>$" . number_format($row["price"], 2) . "</b></td>");
            echo("</tr>");
        }
    ?>
</tbody>
</table>