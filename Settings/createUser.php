<!DOCTYPE HTML>
<?php
session_start();
if(empty($_SESSION['$ses_user_username'])){
	header("Location: ../login.php?login=redirect");
	exit();
}
if($_SESSION['$ses_user_permission'] != "Admin"){
	header("Location: ../settings.php?createUser.php=accessdenied");
	exit();
}
?>
<html>
	<head>
		<title>Inventory Management - Create User</title>
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
			<form action="../scripts/createUserScript.php" method="post" validate>
					<label>
						<span>Username:</span>
						<input type="text" name="user_username" required>
					</label>
					<br>
					<label>
						<span>Password:</span>
						<input type="password" name="user_pass" minlength="5" required>
					</label>
					<br>
					<label>
						<span>Confirm Password:</span>
						<input type="password" name="user_pass_confirm" minlength="5" required>
					</label>
					<br>
					<p>Permission Level:</p>
					<select name="user_permission" required>
						<option value="Admin">Admin</option>
						<option value="Manager">Manager</option>
						<option value="User">User</option>
					</select>
				<p>For more information about user permissions, click <a href="permissionsinfo.php">here</a>.</p>
				<button type="submit" name="submit">Submit</button>
				<?php
				if($_SERVER["REQUEST_URI"] == "/Settings/createUser.php?createUser=success"){
					echo('<p>Succesfully created user.</p>');
				}
				else if($_SERVER["REQUEST_URI"] == "/Settings/createUser.php?createUser=usernameTaken"){
					echo("<p>Username already taken.</p>");
				}
				else if($_SERVER["REQUEST_URI"] == "/Settings/createUser.php?createUser=invalid"){
					echo("<p>Error creating user. Please check passwords match.</p>");
				}
				?>
            </form>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>