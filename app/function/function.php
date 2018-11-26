<?php
function hashpassword_user($password)
{
	if(!empty($password))
	{
		return md5(hash("sha256", $password));
	}
}

function sanitize_input($var)
{
	if(!empty($var))
	{
		return filter_var($var, FILTER_SANITIZE_STRING);
	}
}
?>