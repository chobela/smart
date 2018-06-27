<?php
 
$con=mysqli_connect("localhost", "root", "theresa1", "smart");
if (mysqli_connect_errno($con))
{
   echo '{"query_result":"ERROR"}';
}

$uid = $_GET['uid']; 
$name = $_GET['name'];
$subject = 'Enquiry';
$message = $_GET['message'];
$date = date('Y-m-d');
	
$result = mysqli_query($con,"INSERT INTO messages (uid, subject, name, message, date)
VALUES ('$uid', '$subject','$name','$message', '$date')");
 
if($result == true) {

   // mysqli_query($con,"UPDATE bolanews SET comments = comments + 1 WHERE id = $newsid");

    echo '{"query_result":"SUCCESS"}';
}
else{
    echo '{"query_result":"FAILURE"}';
}
mysqli_close($con);

?>
