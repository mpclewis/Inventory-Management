<?php
//Declares variables for connecting to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "InventoryManagement";

//Connects
$connection = new mysqli($servername, $username, $password, $dbname);

//Sets the database timezone
date_default_timezone_set("Europe/London");

//Checks for failure
if($connection->connect_error){
    die("Connection Failed." . $connection->connect_error);
}
?>