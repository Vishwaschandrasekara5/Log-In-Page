<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'userdb';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname,3307);

if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}
else{
    echo "Connection Successful";
}
?>