<!DOCTYPE HTML>
<?php
session_start();
if(empty($_SESSION['$ses_user_username'])){
	header("Location: login.php?login=redirect");
	exit();
}
?>
<html>
	<head>
		<title>Inventory Management - Home</title>
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
			<?php
			echo("Welcome ".$_SESSION['$ses_user_username'].". You have ".$_SESSION['$ses_user_permission']." privileges.");
			?>
			<h2>Welcome to Inventory Management</h2>
			<p>This Web App is designed and tailored specifically to suit your inventory management and monitoring needs. You are able to add products to your stock and record events such as the purchase, selling and writing off of materials.</p>
			<h2>How to Use</h2>
			<p>This inventory management system is designed to help you keep control of your organisation's inventory. With the ability to alter the amount of a product recorded, be it adding more product when you bring stock in, or reducing it after a sale or write off, you can stay on top.</p>
			<p>To change the amount of stock, head to the products page and then go to either add/ remove stock. From here, as a manager or administrator, you can also add new products.</p>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>