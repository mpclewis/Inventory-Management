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
		<title>Inventory Management - Products</title>
		<link rel="stylesheet" href="style/master_style.css">
		<link rel="stylesheet" href="style/db_manipulation.css">
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
			<div id="db_manipulation">
				<a href="Products/getReport.php"><ul>
					<h2>Get Report</h2>
					<p>Go here to view the amount of a product and recent sales statistics.</p>
				</ul></a>
				<a href="Products/addStock.php"><ul>
					<h2>Add Stock</h2>
					<p>Go here to add an increase to current stock.</p>
				</ul></a>
				<a href="Products/removeStock.php"><ul>
					<h2>Remove Stock</h2>
					<p>Go here to make a decrease to current stock.</p>
				</ul></a>
				<?php
					if($_SESSION['$ses_user_permission'] != "User")
					echo('<a href="Products/createProduct.php"><ul>
					<h2>Create Product</h2>
					<p>Go here to add a new item to the database.</p>
					</ul></a>');
					?>
			</div>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>