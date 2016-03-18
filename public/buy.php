<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted (via GET)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $symbol = empty($_GET["symbol"]) ? "" : $_GET["symbol"];
        render("buy_form.php", ["title" => "BUY",  "symbol" => $symbol]);
    }

    // else from via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["symbol"]) || empty($_POST["shares"]))
        {
            apologize("Please enter a stock and quantity of shares...");
        }
        
        // if number of shares is invalid
        if (preg_match("/^\d+$/", $_POST["shares"]) == false)
        {
            apologize("Please enter a positive integer...");
        }
          
        // look up price
        $stock = lookup($_POST["symbol"]);

        // if symbol is not invalid
        if (! $stock)
        {
            apologize("The stock symbol was invalid...");
        }
            // calculate total cost with price and shares
            $cost = $stock["price"] * $_POST["shares"];
            
            // query to check user's total cash
            $cash_rows = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
            $cash = $cash_rows[0]["cash"];
            
        // if user's cash total is less than total cost 
        if ($cash < $cost)
        {
            apologize("Please enter a purchase you can afford...");
        }
            
        // update the number of shares
        CS50::query("INSERT INTO portfolio (user_id, symbol, shares) VALUES(?, ?, ?) 
        ON DUPLICATE KEY UPDATE shares = shares + ?", $_SESSION["id"], $_POST["symbol"], $_POST["shares"],  $_POST["shares"]);
            
        // buy - cash
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
                
        // update history
        CS50::query("INSERT INTO history (user_id, type, time, symbol, shares, price) 
        VALUES (?, 'BUY', NOW(), ?, ?, ?)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"], $stock["price"]);

        redirect("/");
    }
    
?>