<?php

// $db_name = "recipebooks";
// $db_server = "";
// $db_user = "root";
// $db_pass = "";

$db_name = "u414223652_alvinnamnam";
$db_server = "127.0.0.1:3306";
$db_user = "u414223652_alvinnamnam";
$db_pass = "Derp@12345";

$db = new PDO("mysql:host={$db_server};dbname={$db_name};charset=utf8", $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>  