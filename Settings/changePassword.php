<!DOCTYPE HTML>
<?php
session_start();
if(empty($_SESSION['$ses_user_username'])){
	header("Location: ../login.php?login=redirect");
	exit();
}
if($_SESSION['$ses_user_permission'] != "Admin"){
	header("Location: ../settings.php?changePassword.php=accessdenied");
	exit();
}
?>
<html>
	<head>
		<title>Inventory Management - Change Password</title>
        <link rel="stylesheet" href="../style/master_style.css">
        <link rel="stylesheet" href="../style/forms.css">
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
						echo('<ul><a href="../settings.php">Settings</a></ul>');
					}
					?>
				</nav>
			</li>
		</div>
		<div id="createUserForm">
			<form action="../scripts/changePasswordScript.php" method="post" validate>
                <label>
					<span>Username:</span>
					<input type="text" name="delete_username" required>
				</label>
				<br>
				<label>
					<span>New Password:</span>
					<input type="password" name="user_newpass" minlength="5" required>
				</label>
				<br>
				<label>
					<span>Please Confirm Your Password:</span>
					<input type="password" name="admin_password" required>
				</label>
                <br>
				<button type="submit" name="submit">Submit</button>
				<?php
				if($_SERVER["REQUEST_URI"] == "/Settings/changePassword.php?changePassword=success"){
					echo('<p>Succesfully changed password.</p>');
				}
				else if($_SERVER["REQUEST_URI"] == "/Settings/changePassword.php?changePassword=invalidpass"){
					echo("<p>Invalid admin password.</p>");
				}
				?>
            </form>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>