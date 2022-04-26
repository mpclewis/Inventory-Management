<?php
session_start();

if(isset($_POST["submit"])){
    include_once("connectDataBase.php");

    //Assigns user input to variables
    $productName = mysqli_real_escape_string($connection, $_POST["product_name"]);
    $productAmount = (int) mysqli_real_escape_string($connection, $_POST["product_amount"]);

    //Holds query to find existing product and then checks database
    $existingProductQuery = "SELECT * FROM products WHERE Product_Name = '$productName'";
    $existingProductResult = mysqli_query($connection, $existingProductQuery);
    $existingReturnedRows = mysqli_num_rows($existingProductResult);
    if($existingReturnedRows != 1){

        //If check fails, redirects with fail header
        header("Location: ../Products/addStock.php?addStock=Invalid");
    }
    else{

        //Gets the current amount of stock and adds it to the user's input
        $getCurrentAmountQuery = "SELECT * FROM products WHERE Product_Name = '$productName'";
        $currentAmount = mysqli_fetch_row(mysqli_query($connection, $getCurrentAmountQuery));
        $newAmount = array_map('intval', $currentAmount)[2] + $productAmount;

        //Assigns new amount to database
        $updateQuery = "UPDATE products SET Product_StockIn = '$newAmount' WHERE Product_Name = '$productName'";
        mysqli_query($connection, $updateQuery);
        include_once("createEventScript.php");
        createEvent($connection, $_SESSION['$ses_user_username'], $productName, (int)$productAmount);
        header("Location: ../Products/addStock.php?addStock=Success");
    }
}
else{
    session_destroy();
    header("Location: ../login.php?login=redirect");
}
?>