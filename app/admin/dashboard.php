<?php
session_start();
if($_SESSION['logged_in'] === TRUE)
{
	echo "Welcome";
	echo $_SESSION['user_logged_in'];
}
else
{
	header("Location:login.php");
}
?>