﻿<?php
$host = "localhost"; // host of MySQL server
$user = "root"; // MySQL user
$pwd = "theresa1"; // MySQL user's password
$db = "smart"; // database name

// Create connection
$con = mysqli_connect($host, $user, $pwd, $db);
$uid = $_GET['uid'];

$sql = "SELECT services.service AS service, amount AS cost, debt, expiry_date AS expiry FROM transactions LEFT JOIN services ON transactions.service = services.id WHERE transactions.uid = '$uid'";
$res = mysqli_query($con,$sql);
$result = array();
while($row = mysqli_fetch_array($res)){
array_push($result,
array('service'=>$row[0],
'cost'=>$row[1],
'debt'=>$row[2],
'expiry'=>$row[3]
));
}
echo json_encode($result);
mysqli_close($con);
?>

