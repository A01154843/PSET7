<?php
    // configuration
    require("../includes/config.php");
    
    // form it was submitted (via GET)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
    
    // else from via POST
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
	    // validate register form
	    if(empty($_POST["username"])||empty($_POST["password"])||$_POST["password"] != $_POST["confirmation"]||empty($_POST["name"])||empty($_POST["last_name"]))
	    {
	    	// if no username was submitted
		    if(empty($_POST["username"]))
			{
				apologize("Username is required...");
			}
			
			// if no password was submitted
			else if(empty($_POST["password"]))
			{
				apologize("Password is required...");
			}
			
			// if password confirmation is not equals to password
			else if($_POST["password"] != $_POST["confirmation"])
			{
				apologize("Password doesn't equal the confirmation...");
			}
			
			// if there is no name introduced
			else if(empty($_POST["name"]))
			{
				apologize("A name is required...");
			}
			
			// if there is no last name introduced
			else if(empty($_POST["last_name"]))
			{
				apologize("A last name is reqired...");
			}
	}
	else
	{
		// if username already exists
		if(CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"])) === false)
		{
			apologize('Username already exists');
		}
		
		else
		{
			// add new user into phpmyadmin data
			$rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
			$id = $rows[0]["id"];
			$_SESSION["id"] = $id; 
			redirect("index.php");
	    }
	    }
    }
        else
    {
      // else render form
      render("register_form.php", ["title" => "Register"]);
    }
?>
        