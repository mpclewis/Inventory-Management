<!DOCTYPE HTML>
<?php
session_start();
if(empty($_SESSION['$ses_user_username'])){
	header("Location: login.php?login=redirect");
	exit();
}
if($_SESSION['$ses_user_permission'] != "Admin"){
	header("Location: ../index.php?settings.php=accessdenied");
	exit();
}
?>
<html>
	<head>
		<title>Inventory Management - Settings</title>
		<link rel="stylesheet" href="style/master_style.css">
	</head>
	<body>
		<div id=header>
			<h1>Inventory Management</h1>
			<h2></h2>
		</div>
		<div id = "navigation">
			<li>
				<nav>
					<ul><a href="scripts/logOutScript.php">Log Out</a></ul>
					<ul><a href="index.php">Home</a></ul>
					<ul><a href="products.php">Products</a></ul>
					<?php
					if($_SESSION['$ses_user_permission'] == "Admin"){
						//Shows Settings button if user is admin
						echo('<ul><a href="settings.php">Settings</a></ul>');
					}
					?>
				</nav>
			</li>
		</div>
		<div class="content">
			<a class="settingsButtons"href="Settings/createUser.php"><ul>
				<h2>Create User</h2>
			</ul></a>
			<a class="settingsButtons"href="Settings/changePassword.php"><ul>
				<h2>Change Password</h2>
			</ul></a>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>