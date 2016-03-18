<?php
    // This displays the current information about the specified stock
    print("Symbol : ". $stock["symbol"]);
    print("<br>");
    print("Name : ". $stock["name"]);
    print("<br>");
	print("Price : ". number_format($stock["price"], 3))
?>
<bk></bk>
<div class = "form-group">
    <a class = "btn btn-default" href = "buy.php?symbol=<?=$stock["symbol"]?>">
        Buy
    </a>
</div>