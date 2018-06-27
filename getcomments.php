<?php
$host = "localhost"; // host of MySQL server
$user = "root"; // MySQL user
$pwd = "theresa1"; // MySQL user's password
$db = "smart"; // database name

// Create connection
$con = mysqli_connect($host, $user, $pwd, $db);
$uid = $_GET['uid'];
$sql = "SELECT name, subject, message, date FROM messages WHERE uid = '$uid' ORDER BY date asc";
$res = mysqli_query($con,$sql);
$result = array();
while($row = mysqli_fetch_array($res)){
array_push($result,
array('name'=>$row[0],
'subject'=>$row[1],
'message'=>$row[2],
'date'=>$row[3]
));
}
echo json_encode($result);
mysqli_close($con);
?>

