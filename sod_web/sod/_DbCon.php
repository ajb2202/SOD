<?php
$servername = "uklpaueci33c";
$username = "postgres";
$password = "postgres";
$db = "start_of_day";

// Create connection
$conn = pg_connect("host=$servername port=6524 dbname=$db user=$username password=$password");
//  or die('Could not connect: ' . pg_last_error());

#echo "Connected successfully";
?>
