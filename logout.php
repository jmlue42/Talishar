<?php

session_start();
session_unset();
session_destroy();
if (isset($_COOKIE["rememberMeToken"])) setcookie("rememberMeToken", "", time() + 1, "/");
if (isset($_COOKIE["lastAuthKey"])) setcookie("lastAuthKey", "", time() + 1, "/");

header("location: MainMenu.php");
exit();
