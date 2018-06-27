<?php
	include('conn.php');
	
	$id=$_GET['id'];
	$person=$_GET['person'];

        $date= date('Y-m-d');
	$amount=$_POST['amount'];
        $desc=$_POST['description'];
      
	
	mysqli_query($conn,"insert into payments (transaction_id, amount, date, description, inserted_by) values ('$id', '$amount', '$date', '$desc', '$person')");

	header('location:subscriptions.php');
?>
