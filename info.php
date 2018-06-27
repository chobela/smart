<?php
$host = "localhost"; // host of MySQL server
$user = "root"; // MySQL user
$pwd = "theresa1"; // MySQL user's password
$db = "smart"; // database name

// Create connection
$con = mysqli_connect($host, $user, $pwd, $db);
$uid = $_GET['uid'];
$wallet = $_GET['wallet'];

$sql = "SELECT SUM(transactions.debt) AS spent, '$wallet' - SUM(transactions.debt) AS available FROM clients LEFT JOIN transactions ON clients.unique_id = transactions.uid WHERE clients.unique_id = '$uid'";


$r = mysqli_query($con,$sql);
		
$res = mysqli_fetch_array($r);
		
$result = array();
		
array_push($result,array(
"spent"=>$res['spent'],
"available"=>$res['available']
)
);
		
echo json_encode(array("result"=>$result));
		
mysqli_close($con);	

?>



