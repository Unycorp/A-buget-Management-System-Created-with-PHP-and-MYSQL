<?php
$dbhostcompany = "localhost";
$dbusername = "root";
$dbpassword ="";
$dbname = "budget";
// host, user, password, database
$conn = mysqli_connect($dbhostcompany,$dbusername,$dbpassword,$dbname);

if(!$conn) {
 die('Could not connect to the server');
 }

?>