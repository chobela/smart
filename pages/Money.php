<?php

 class Money{
 
	function getdebt($uid) {

		 $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $new_debt = "SELECT SUM(debt) AS debt, SUM(amount) AS spent FROM transactions WHERE uid = '$uid'";
 			$results = mysqli_query($db,$new_debt);
 			

		 while ($row = mysqli_fetch_array($results)) {

$debt = $row ['debt'];

                return  $debt;
     }
   }


function getbalance($uid) {

		
		 $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

		 $sql = "SELECT wallet, SUM(amount) AS spent FROM clients JOIN transactions ON clients.unique_id = transactions.uid WHERE transactions.uid = '$uid'";

 	         $result = mysqli_query($db,$sql);
 			
		 while ($row = mysqli_fetch_array($result)) {

$balance = ($row ['wallet'] - $row ['spent']);

                 return  $balance;
   }
}


function getspent($uid) {

		
		 $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

		 $sql = "SELECT SUM(amount) AS spent FROM transactions WHERE transactions.uid = '$uid'";

 	         $result = mysqli_query($db,$sql);
 			
		 while ($row = mysqli_fetch_array($result)) {

                 return  $row ['spent'];
   }
}


}

?>
