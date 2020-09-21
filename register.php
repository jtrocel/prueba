<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: menu.php");
}

require 'database.php';

$message = '';
try 
{
if(!empty($_POST['email']) && !empty($_POST['password'])):

	// Enter the new user in the database
	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':email', $_POST['email']);

	$pswd = $_POST['password'];
	$pswd = password_hash($pswd, PASSWORD_BCRYPT);
	$stmt->bindParam(':password',$pswd);

	if( $stmt->execute() ):
		$message = 'Successfully created new user';
		header("Location: menu.php");
	else:
		$message = 'Sorry there must have been an issue creating your account';
	endif;
endif;
}
catch (PDOException $e){
	$message = $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Below</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
		<a href="/loging">Multiflix</a>
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Register</h1>
	<span>or <a href="login.php">login here</a></span>

	<form action="register.php" method="POST">
		
		<input type="text" placeholder="Enter your email" name="email">
		<input type="password" placeholder=" password" name="password">
		<input type="password" placeholder="confirm password" name="confirm_password">
		<input type="submit">

	</form>

</body>
</html>