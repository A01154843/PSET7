<?php

    // configuration
    require("../includes/config.php");
    
    // form it was submitted (via GET)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $symbols = CS50::query("SELECT symbol FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
        
        render("sell_form.php", ["title" => "Sell", "symbols" => $symbols]);
    }
     // else from via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["symbol"] == "symbol")
        {
            $symbols = CS50::query("SELECT symbol FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
            apologize("Please enter the stock symbol...");
        }
        
        // look up the symbol of stock
        $stock = lookup($_POST["symbol"]);
        
        // query the amount of user shares
        $shares = CS50::query("SELECT shares FROM portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        $newshares = $_POST["newshares"];
        if ($_POST["newshares"] == NULL)
        {
            apologize("Enter a number of shares");
        }
        else if ($_POST["newshares"] < 0)
        {
            apologize("Enter a positive amount");
        }
        else if ($_POST["newshares"] > $shares[0]["shares"])
        {
            apologize("Not enough shares to sell");
        }
        $gain = $stock["price"] * $shares[0]["shares"];
        
        if ($_POST["newshares"] < $shares[0]["shares"])
        {
            $rows = CS50::query("UPDATE portfolio SET shares = (shares - ".$newshares.") WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        }
        else if ($_POST["shares_n"] == $shares[0]["shares"])
        {
            $rows = CS50::query("DELETE FROM portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        }
        // updates the user's cash
        CS50::query("UPDATE users SET cash = (cash + ".$gain.") WHERE id = ?", $_SESSION["id"]);
        
        // eliminates the sold symbol
        $type = 'Sell';

        // update history
        CS50::query("INSERT INTO history (user_id, type, time, symbol, shares, price) VALUES(?,'SELL',NOW(), ?, ?, ?)", $_SESSION["id"], $_POST["symbols"], $_POST["shares"], $stock["price"]);
        redirect("/");
    }
?>
 º