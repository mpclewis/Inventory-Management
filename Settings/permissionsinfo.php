<!DOCTYPE HTML>
<?php
session_start();
if(empty($_SESSION['$ses_user_username'])){
	header("Location: ../login.php?login=redirect");
	exit();
}
if($_SESSION['$ses_user_permission'] != "Admin"){
	header("Location: ../settings.php?permissionsInfo.php=accessdenied");
	exit();
}
?>
<html>
	<head>
		<title>Inventory Management - Permissions</title>
		<link rel="stylesheet" href="../style/master_style.css">
	</head>
	<body>
		<div id=header>
			<h1>Inventory Management</h1>
			<h2></h2>
		</div>
		<div id = "navigation">
			<li>
				<nav>					
					<ul><a href="../scripts/logOutScript.php">Log Out</a></ul>
					<ul><a href="../index.php">Home</a></ul>
					<ul><a href="../products.php">Products</a></ul>
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
        <h2>Admin</h2>
        <p>The highest level of permission. Admin accounts have access to all pages and are able to make full use of all tools.</p>
        <h2>Manager</h2>
        <p>Set manager permissions to an account you wish to have full access to the inventory management tools, without the ability to make changes to any user accounts.</p>
        <h2>User</h2>
        <p>The appropriate permissions for a user that requires basic functionality of the managment system. A user account is able to view stock and create reports, but is not able to make important changes to the stock database itself.</p>
        </div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
    </body>
</html>