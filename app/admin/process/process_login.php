<?php
/*
* load init file
* check if file exist
*/
if(file_exists("../../init.php")) {
	require_once("../../init.php");
}
/*
* User authentication
* check if user has clicked login button
*/
if(isset($_POST['login'])) {
	// fetch post data
	$email = $_POST['email'];
	$password = $_POST['password'];

	// sanitize post data
	$email = trim(sanitize_input($email));
	$password = trim(sanitize_input($password));

	// hash password
	$hash_password = hashpassword_user($password);

	// create array
	$data = array(
		"email"    => $email,
		"password" => $hash_password
		);

	// call query to check user
	$db->select("*");
	$db->from("tbl_user");
	$db->where($data);
	$db->get();

	// check fetched result count
	if($db->count() != 0) {
		$fetch_data = $db->result();
		$_SESSION['logged_in'] = TRUE;
		$_SESSION['username'] = $fetch_data['username'];
		header("Location:../index.php");
	}
	else {
		$_SESSION['login_error'] = TRUE;
		header("Location:../login.php");
	}
}
?>


