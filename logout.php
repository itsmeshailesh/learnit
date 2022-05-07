<?php

$cookie_value = $_SESSION['id'];

session_destroy();
$cookie_name = "user";
$_SESSION["id"] = -1;
setcookie($cookie_name, $cookie_value, time()-36000,"/");
header("location:index.php");


?>