<!DOCTYPE HTML>
<?php
session_start();
if(empty($_SESSION['$ses_user_username'])){
	header("Location: ../login.php?login=redirect");
	exit();
}
if($_SESSION['$ses_user_permission'] != 'Admin' && $_SESSION['$ses_user_permission'] != "Manager"){
	header("Location: ../products.php?access=denied");
	exit();
}
?>
<html>
	<head>
		<title>Inventory Management - Create Product</title>
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
			<h1>Create Product</h1>
			<form action="../scripts/createProductScript.php" method="post">
				<label>
					<span>Product Name: </span>
					<input type="text" name="product_name" required>
				</label>
				<br>
				<label>
					<span>Price (pence/unit): </span>
					<input type="number" name="product_price" required>
				</label>
				<br>
				<button name="submit" type="submit">Submit</button>
				<?php
				if($_SERVER["REQUEST_URI"] == "/Products/createProduct.php?createProduct=success"){
					echo('<p>Succesfully created product.</p>');
				}
				else if($_SERVER["REQUEST_URI"] == "/Products/createProduct.php?createProduct=failed"){
					echo("<p>Error creating product. Does it already exist?.</p>");
				}
				?>
			</form>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>