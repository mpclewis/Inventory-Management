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
		<title>Inventory Management - Remove Stock</title>
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
			<h1>Remove Stock</h1>
            <form action="../scripts/removeStockScript.php" method="post">
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
				<label>
					<span>Type: </span>
					<select type="text" name="remove_type">
						<option value="Sale">Sale</option>
						<option value="Waste">Write Off</option>
					</select>
				</label>
				<br>
				<br>
				<button name="submit" type="submit">Submit</button>
			</form>
			<?php
			if($_SERVER["REQUEST_URI"] == "/Products/removeStock.php?removeStock=Success"){
				echo('<p>Succesfully removed stock.</p>');
			}
			else if($_SERVER["REQUEST_URI"] == "/Products/removeStock.php?removeStock=Invalid"){
				echo("<p>Product could not be found.</p>");
			}
			else if($_SERVER["REQUEST_URI"] == "/Products/removeStock.php?removeStock=StockUnavailable"){
				echo("<p>Not enough stock to remove.</p>");
			}
			?>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>