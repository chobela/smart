<?php
$con=mysqli_connect("localhost","root","theresa1","smart");
if (mysqli_connect_errno($con))
{
   echo '{"query_result":"ERROR"}';
}
 
        $uid=$_GET['uid'];
	$trans = 'ESY'.rand(10,1000000);
        $person= 'App User';
        $service=$_GET['service'];

$servid =  getserv($service);   				
        

function getserv($service) {

switch ($service) {

    case "Airtel":

	$servid = '1';
        return $servid;

        break;

    case "MTN":

	$servid = '2';
        return $servid;

        break;

   case "ZAMTEL":

	$servid = '3';
        return $servid;

        break;

 case "Vodafone":

	$servid = '4';
        return $servid;

        break;

 case "ZESCO":

	$servid = '5';
        return $servid;

        break;

    case "Water Bills":

	$servid = '6';
        return $servid;

        break;

   case "DSTV":

	$servid = '7';
        return $servid;

        break;

 case "Kwese":

	$servid = '8';
        return $servid;

        break;

case "Topstar":

	$servid = '9';
        return $servid;

        break;

 case "Zuku":

	$servid = '10';
        return $servid;

        break;

  }
}


	$account=$_GET['account'];	
        $amount=$_GET['amount'];
        $effective=$_GET['effective'];
        $interest = ($amount * 0.1);
        $debt = (($amount * 0.1) + $amount);
	$desc=$_GET['description'];	
        $req = date('Y-m-d');
	$exp= date('Y-m-d', strtotime($req. ' + 30 days'));
        $status= '1';

 
$result = mysqli_query($con,"insert into transactions (uid, transaction_id, service, account, amount, effective, description, request_date, expiry_date, status, interest, debt, inserted_by) values ('$uid', '$trans', '$servid', '$account', '$amount', '$effective', '$desc', '$req', '$exp', '$status', '$interest', '$debt', '$person')");


  
if($result == true) {
    echo '{"query_result":"SUCCESS"}';
}
else{
    echo '{"query_result":"FAILURE"}';
}
mysqli_close($con);
?>
