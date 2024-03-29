<?php

include_once 'Header.php';

require_once './Assets/patreon-php-master/src/OAuth.php';
require_once './Assets/patreon-php-master/src/API.php';
require_once './Assets/patreon-php-master/src/PatreonLibraries.php';
include_once './includes/functions.inc.php';
include_once "./includes/dbh.inc.php";

if (!isset($_SESSION["useruid"])) {
  echo ("Please login to view this page.");
  exit;
}
$useruid = $_SESSION["useruid"];
if ($useruid != "OotTheMonk" && $useruid != "Launch" && $useruid != "PvtVoid" && $useruid != "Star_Seraph" && $useruid != "Tower") {
  echo ("You must log in to use this page.");
  exit;
}

$userName = $_GET["userName"];


$sql = "SELECT * FROM users where usersUid='$userName'";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  echo ("ERROR");
  exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$access_token = $row["patreonAccessToken"];

try {
  PatreonLogin($access_token, false, true);
} catch (\Exception $e) { }
