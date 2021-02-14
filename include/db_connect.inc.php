<?php

$db_server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "eleganza";

$conn = mysqli_connect($db_server_name, $db_username, $db_password, $db_name);

if(mysqli_connect_errno()){
  echo "Error: ".mysqli_connect_err();
}

?>
