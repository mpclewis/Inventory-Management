<!DOCTYPE HTML>
<?php
session_start();
if(empty($_SESSION['$ses_user_username'])){
	header("Location: ../login.php?login=redirect");
	exit();
}
?>
<html>
	<head>
		<title>Inventory Management - Add Stock</title>
		<link rel="stylesheet" href="../style/master_style.css">
		<link rel="stylesheet" href="../style/db_manipulation.css">
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
					//Shows Settings button if user is admin
					if($_SESSION['$ses_user_permission'] == "Admin"){
						echo('<ul><a href="../settings.php">Settings</a></ul>');
					}
					?>
				</nav>
			</li>
		</div>
		<div class="content">
		
		<h1>Add Stock</h1>
		<form action="../scripts/addStockScript.php" method="post">
				<label>
					<span>Product Name: </span>
					<input type="text" name="product_name" required>
				</label>
				<br>
				<label>
					<span>Amount (units): </span>
					<input type="number" name="product_amount" min=1 required>
				</label>
				<br>
				<button name="submit" type="submit">Submit</button>
			</form>
			<?php
			if($_SERVER["REQUEST_URI"] == "/Products/addStock.php?addStock=Success"){
				echo('<p>Succesfully added to stock.</p>');
			}
			else if($_SERVER["REQUEST_URI"] == "/Products/addStock.php?addStock=Invalid"){
				echo("<p>Invalid product.</p>");
			}
			?>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>