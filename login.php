<!DOCTYPE HTML>
<?php
session_start();
?>
<html>
	<head>
		<title>Inventory Management - Login</title>
        <link rel="stylesheet" href="style/master_style.css">
        <link rel="stylesheet" href="style/forms.css">
	</head>
	<body>
		<div id=header>
			<h1>Inventory Management</h1>
			<h2></h2>
		</div>
		<div id="loginForm">
			<form action="scripts/loginScript.php" method="post">
				<label>
					<span>Username:</span>
					<input type="text" name="user_username" required>
				</label>
				<br>
				<label>
					<span>Password:</span>
					<input type="password" name="user_pass" required>
				</label>
				<br>
				<br>
                <button type="submit" name="submit">Log In</button>
				<br>
				<?php
				if($_SERVER["REQUEST_URI"] == "/login.php?login=invalidlogin"){
					echo("<p>Invalid username and/or password.</p>");
				}
				else if($_SERVER["REQUEST_URI"] == "/login.php?login=redirect"){
					echo("<p>You have been redirected to the login page.</p>");
				}
				?>
            </form>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>