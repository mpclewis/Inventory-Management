<?php
session_start();

if(isset($_POST["submit"])){
    include_once("connectDataBase.php");

    //Assigns variables from form input
    $changePassUser = $_POST['delete_username'];
    $changePassNew = $_POST["user_newpass"];
    $adminPassword = $_POST['admin_password'];

    //Finds password of existing user to compare with input
    $currentUser = $_SESSION['$ses_user_username'];
    $userPassQuery = "SELECT * FROM `userlogindetails` WHERE `User_Username` = '$currentUser';";
    $userPassArray = mysqli_fetch_array(mysqli_query($connection, $userPassQuery));
    $userPass = $userPassArray[2];

    //Checks that admin password is correct
    if(sha1($adminPassword) == $userPass){
        $newEncryptPass = hash('sha256', $changePassNew);
        $changePassQuery = "UPDATE userlogindetails SET `User_Pass` = '$newEncryptPass' WHERE `User_Username` = '$changePassUser'";
        mysqli_query($connection, $changePassQuery);
        header("Location: ../Settings/changePassword.php?changePassword=success");
        exit();
    }
    else{
        header("Location: ../Settings/changePassword.php?changePassword=invalidpass");
        exit();
    }
}
else{
    session_destroy();
    header("Location: ../login.php?login=redirect");
}
?>