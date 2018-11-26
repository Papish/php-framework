<?php
/*
* Core PHP file, Do not delete
* Basic setting and load ups
* Start user session, cookies
* load all classes and basic drivers i.e. Database and config
* Open database connection/handle database error
*/

/*
* Start user session
*/
session_start();

// Set global error reporting to 0
// error_reporting(0);

// load all classes
spl_autoload_register(function ($class)
{
	if(is_file("../../database/" . $class . ".php"))
	{
		require_once "../../database/" . $class . ".php";
	}
	else if(is_file("../../helper/" . $class . ".php"))
	{
		require_once "../../helper/" . $class . ".php";
	}
});

// load config file
require_once("../../database/config.php");

// load function file
require_once("../../function/function.php");
// load an instance of database and pass config param
// This is called dependency injection
// catch any error if occured
try{
	$db = new Db($db);
}
catch(Exception $e)
{
	echo $e->getMessage();
}
	?>