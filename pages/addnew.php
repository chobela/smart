<?php
	include('conn.php');

if (isset($_POST['service']) && isset($_POST['account']) && isset($_POST['amount']) && isset($_POST['description'])) {
	
	$uid=$_POST['uid'];
	$trans=$_POST['transaction_id'];
        $person=$_POST['person'];
        $service=$_POST['service'];
	$account=$_POST['account'];	
        $amount=$_POST['amount'];
        $interest = ($amount * 0.1);
        $debt = (($amount * 0.1) + $amount);
	$desc=$_POST['description'];	
        $req = date('Y-m-d');
	$exp= date('Y-m-d', strtotime($req. ' + 30 days'));
        $status= '1';
	
	
	
	mysqli_query($conn,"insert into transactions (uid, transaction_id, service, account, amount, description, request_date, expiry_date, status, interest, debt, inserted_by) values ('$uid', '$trans', '$service', '$account', '$amount', '$desc', '$req', '$exp', '$status', '$interest', '$debt', '$person')");

	header('location:subscriptions.php');

} else {

echo 'Please enter all fields!';
}

?>
