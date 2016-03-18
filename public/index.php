<?php
    // configuration
    require("../includes/config.php"); 	
	
    $id = $_SESSION["id"];
    
    // shares owned by users
	$rows = CS50::query("SELECT id, symbol, shares FROM portfolio WHERE user_id = $id");
				
	// stores info from the shares
	$positions = [];
	foreach ($rows as $row)
	{
	  $stock = lookup($row["symbol"]);
	  
		// stock symbol is false
		if ($stock !== false)
		{
			$positions[] = [
			"name" => $stock["name"],
			"price" => $stock["price"],
			"shares" => $row["shares"],
    	    "symbol" => $row["symbol"],
		    "total" => $row["shares"] * $stock["price"]
			];
	    }
	}
	  
	// user's current cash
	$cash = CS50::query("SELECT username, cash FROM users WHERE id = $id");
	
    // render portfolio
    render("portfolio.php", ["title" => "Positions", "positions" => $positions, "cash" => $cash]);
?>