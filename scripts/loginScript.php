<?php
session_start();
if (isset($_POST["submit"])){
    include_once"connectDataBase.php";

    //Acquires input from login page
    $user_username = mysqli_real_escape_string($connection, $_POST["user_username"]);
    $user_pass = mysqli_real_escape_string($connection, $_POST["user_pass"]);
    $hashed_pass = hash('sha256', $user_pass);

    //Checks that neither box is empty
    if(empty($user_username) || empty($user_pass)) {
        header("Location: ../login.php?login=emptyfields");
        exit();
    }
    else{

        //Puts query and results from query into variables
        $loginQuery = "SELECT * FROM userlogindetails WHERE User_Username = '$user_username'";
        $queryResult = mysqli_query($connection, $loginQuery);

        //Checks the number of rows returned is equal to 1
        $queryReturnedRows = mysqli_num_rows($queryResult);
        if($queryReturnedRows != 1){

            //If more or less than 1 row returned
            header("Location: ../login.php?login=invalidlogin");
            exit();
        } else{

            //Compares fetched results to user's input
            if($row = mysqli_fetch_assoc($queryResult)){
                if($hashed_pass == $row['User_Pass']){

                    //Sets session's username
                    $_SESSION['$ses_user_username'] = $user_username;

                    //Sets session's permission
                    $_SESSION['$ses_user_permission'] = $row['User_Permission'];

                    //Redirects user to index
                    header("Location: ../index.php?login=succesful");
                    exit();
                } else{
                    header("Location: ../login.php?login=invalidlogin");
                    exit();
                }
            }
        }
        exit();
    }
}
else{
    session_destroy();
    header("Location: ../login.php?login=redirect");
}
?>