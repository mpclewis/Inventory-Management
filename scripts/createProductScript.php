<?php
session_start();
if(isset($_POST["submit"])){
    include_once("connectDataBase.php");

    //Creates product table
    $createProductTable = "CREATE TABLE `stockrotation`.`products` ( 
        `Product_ID` INT NOT NULL AUTO_INCREMENT , 
        `Product_Name` TEXT NOT NULL , 
        `Product_StockIn` INT NOT NULL  , 
        `Product_Price` INT NOT NULL , 
        PRIMARY KEY (`Product_ID`)
        ) 
        ENGINE = InnoDB;";
    mysqli_query($connection, $createProductTable);

    //Assigns user input to variables
    $product_name = mysqli_real_escape_string($connection, $_POST["product_name"]);
    $product_price = mysqli_real_escape_string($connection, $_POST["product_price"]);
    $existingProductQuery = "SELECT * FROM products WHERE Product_Name = '$product_name'";
    $existingProductResult = mysqli_query($connection, $existingProductQuery);
    $existingReturnedRows = mysqli_num_rows($existingProductResult);
    if($existingReturnedRows == 0){

        //Adds product to table
        $addProductQuery = "INSERT INTO products (Product_Name, Product_Price) VALUES('$product_name', '$product_price')";
        mysqli_query($connection, $addProductQuery);

        //Returns user to create product page
        header("Location: ../Products/createProduct.php?createProduct=success");
        exit();
    }
    else{
        header("Location: ../Products/createProduct.php?createProduct=failed");
        exit();
    }
}
else{
    session_destroy();
    header("Location: ../login.php?login=redirect");
}
?>