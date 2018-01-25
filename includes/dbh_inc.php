<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "db-projekt";

$db = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if ($db === FALSE){
                die("<p>Es konnte keine Verbindung hergestellt werden!</p><p>" . mysql_error() . "</p>");
            }

?>
