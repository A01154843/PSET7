<?php
    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("deposit_form.php", ["title" => "Deposit"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (preg_match("/^\d+$/", $_POST["deposit"] == NULL))
        {
            apologize("Your data is invalid.");
        }
        
        else if ($_POST["deposit"] == NULL)
        {
            apologize("You must enter an amount of money");
        }
        
        else
        {
            CS50::query("UPDATE  users SET cash = (cash + ?) WHERE id = ?", $_POST["deposit"], $_SESSION["id"]);
        }
        redirect("/");
    }

?>