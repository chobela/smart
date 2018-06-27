<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$con=mysqli_connect("localhost","root","theresa1","smart");
if (mysqli_connect_errno($con))
{
   echo '{"query_result":"ERROR"}';
}
 
        $uid=$_GET['uid'];
	$question=$_GET['question'];	
        $answer=$_GET['answer'];
    
$result = mysqli_query ($db, "INSERT INTO secrets (uid, question, answer) VALUES ('$uid', '$question', '$answer')");

  
if($result == true) {
    echo '{"query_result":"SUCCESS"}';
}
else{
    echo '{"query_result":"FAILURE"}';
}
mysqli_close($con);
?>
