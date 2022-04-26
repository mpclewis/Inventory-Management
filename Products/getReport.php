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
		<title>Inventory Management - Report</title>
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
			<div id="reportSearch">
				<h1>Get Report</h1>
				<p>Please note: The following search is case sensitive.</p>
				<form method="post">
					<label>
						<span>Product: </span>
						<input type="text" name="report_productname" required>
					</label>
					<br>
					<br>
					<button name="submit" type="submit">Submit</button>
					<br><br><br>
				</form>
			</div>

			<?php
			if(isset($_POST["submit"])){
				include_once("../scripts/connectDataBase.php");

				//Declares variables
				$productName = $_POST["report_productname"];

				//Finds the Product_ID corresponding to the given name
				$lookUpProductIDQuery = "SELECT * FROM products WHERE `Product_Name` = '$productName'";
				$productArray = mysqli_fetch_array(mysqli_query($connection, $lookUpProductIDQuery));
				$productID = $productArray[0];

				//Finds the last event in the events table with the requested product
				$lastEventQuery = "SELECT * FROM events WHERE `product_ID` = '$productID' ORDER BY `Event_DateTime` DESC;";
				$lastEventArray = mysqli_fetch_array(mysqli_query($connection, $lastEventQuery));

					if(mysqli_num_rows(mysqli_query($connection, $lastEventQuery)) >= 1){

					//Finds the username of the last user who edited the requested product
					$lastUserID = $lastEventArray[5];
					$lastUserNameQuery = "SELECT `User_Username` FROM userlogindetails WHERE `User_ID` = '$lastUserID';";
					$lastUserName = mysqli_fetch_array(mysqli_query($connection, $lastUserNameQuery))[0];

					//Checks the total amount of stock currently in and the price/unit
					$productPrice = $productArray[3];

					//Creates and echos the report in a table format
					$reportString = <<<DOCHERE
					<table id="reportTable">
						<tr>
							<td><h2>Product Name:</h2></td>
							<td><h2>$productArray[1]</h2></td>
						<tr>
						<tr>
							<td><h2>Total Stock:</h2></td>
							<td><h2>$productArray[2] units</h2></td>
						</tr>
						<tr>
							<td>Price/kg (p):</td>
							<td>$productArray[3]</td>
						</tr>
						<tr>
							<td>Last Edited By:</td>
							<td>$lastUserName</td>
						</tr>
						<tr>
							<td>Time of Edit:</td>
							<td>$lastEventArray[0]</td>
						</tr>
						<tr>
							<td>Amount added/removed:</td>
							<td>$lastEventArray[2] units</td>
						</tr>
						<tr>
							<td>Type of Stock Change:</td>
							<td>$lastEventArray[3]</td>
						</tr>
					<table>
					<br>
DOCHERE;
					echo($reportString);
					exit();
				}
				else{

					//Alerts user if no products by that name could be found
					echo("No events could be found for the requested product.");
				}


			}

			else if(isset($_POST["export"])){
				//Gives access to variables and functions necessary
				include_once("../scripts/connectDataBase.php");

				//Declares variables
				$productName = $_POST["report_productname"];

				//Finds the Product_ID corresponding to the given name
				$lookUpProductIDQuery = "SELECT * FROM products WHERE `Product_Name` = '$productName';";
				$productArray = mysqli_fetch_array(mysqli_query($connection, $lookUpProductIDQuery));
				$productID = $productArray[0];
			}
			?>
		</div>
		<footer>
			<small>Matthew Lewis 2022 &copy;</small>
		</footer>
	</body>
</html>