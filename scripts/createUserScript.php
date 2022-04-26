<?php
session_start();

if (isset($_POST["submit"])){
    include_once"connectDataBase.php";

    //Creates the table if it does not already exist within the database
    $createUserTable = "CREATE TABLE `inventorymanagement`.`userlogindetails` (
         `User_ID` INT NOT NULL AUTO_INCREMENT , 
         `User_Username` TEXT NOT NULL ,  
         `User_Pass` TEXT NOT NULL ,  
         `User_Permission` TEXT NOT NULL , 
         PRIMARY KEY  (`User_ID`)
         ) 
         ENGINE = InnoDB;";
    mysqli_query($connection, $createUserTable);

    //Declares variables from the user's input
    $user_username = mysqli_real_escape_string($connection, $_POST["user_username"]);
    $user_pass = mysqli_real_escape_string($connection, $_POST["user_pass"]);
    $user_pass_confirm = mysqli_real_escape_string($connection, $_POST["user_pass_confirm"]);
    $user_permission = mysqli_real_escape_string($connection, $_POST["user_permission"]);

    //Encrypts password
    $hashedPassword = hash('sha256', $user_pass);

    //Creates table
    mysqli_query($connection, $createUserTable);

    //Checks if fields are empty
    if (empty($user_username) || empty($user_pass) || $user_pass != $user_pass_confirm) {

        //Runs if fields are empty
        header("Location: ../Settings/createUser.php?createUser=invalid");
        exit(); 
    }else {

        //Makes sure that username is not already in use
        $existingUserQuery = "SELECT * FROM userlogindetails WHERE `user_username` = '$user_username'";
        $existingUsers = mysqli_num_rows(mysqli_query($connection, $existingUserQuery));
        if($existingUsers == 0){

            //Runs if user creation is successful
            $newUserQuery = "INSERT INTO userlogindetails (user_username, user_pass, user_permission) VALUES('$user_username', '$hashedPassword', '$user_permission')";
            header("Location: ../Settings/createuser.php?createUser=success");
            mysqli_query($connection, $newUserQuery);
            echo("User succesfully created.");
            exit();
        }
        else{
            header("Location: ../Settings/createUser.php?createUser=usernameTaken");
        }
    } 
}
else{
    session_destroy();
    header("Location: ../login.php?login=redirect");
}
?>