<?php
session_start();
$_SESSION = array();
echo("Logging you out of your current session.");
session_destroy();
header("Location: ../index.php");
?>