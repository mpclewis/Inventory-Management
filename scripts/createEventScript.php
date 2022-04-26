<?php
function createEvent($connectionVar, $currentUser, $affectedProduct, $stockChange = 0, $eventType="Restock"){

    //Creates table if it doesn't already exist
    $createTableQuery = "CREATE TABLE `inventorymanagement`.`events` ( 
        `Event_ID` INT NOT NULL AUTO_INCREMENT , 
        `Product_ID` INT NOT NULL , 
        `User_ID` INT NOT NULL , 
        `Event_Type` TEXT NOT NULL , 
        `Event_StockChange` INT NOT NULL , 
        `Event_DateTime` DATETIME NOT NULL , 
        PRIMARY KEY (`Event_ID`)
        ) ENGINE = InnoDB; ";
    mysqli_query($connectionVar, $createTableQuery);

    //Creates relations with Foreign Keys
    $foreignKeyQueryProduct = "ALTER TABLE `events` ADD FOREIGN KEY (`Product_ID`) REFERENCES `products`(`Product_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;";
    mysqli_query($connectionVar, $foreignKeyQueryProduct);
    $foreignKeyQueryUser = "ALTER TABLE `events` ADD FOREIGN KEY (`User_ID`) REFERENCES `userlogindetails`(`User_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;";
    mysqli_query($connectionVar, $foreignKeyQueryUser);

    //Finds User_ID of current user
    $UserIDLookupQuery = "SELECT `User_ID` FROM userlogindetails WHERE User_Username = '$currentUser'";
    $userRow = mysqli_fetch_array(mysqli_query($connectionVar, $UserIDLookupQuery));
    $userID = $userRow[0];

    //Finds Product_ID of current user
    $ProductIDLookupQuery = "SELECT `Product_ID` FROM products WHERE Product_Name = '$affectedProduct'";
    $productRow = mysqli_fetch_array(mysqli_query($connectionVar, $ProductIDLookupQuery));
    $productID = $productRow[0];

    //Assigns the date and time of the event into a variable
    $dateAndTime = date("y/m/d h:i:s");

    //Inserts event record into table
    $createEventRecordQuery = "INSERT INTO events (`User_ID` , `Product_ID` , `Event_DateTime` , `Event_StockChange` , `Event_Type`) VALUES('$userID' , '$productID' , '$dateAndTime' , '$stockChange' , '$eventType');";
    mysqli_query($connectionVar, $createEventRecordQuery);
}
?>