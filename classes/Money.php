<?php

 class Money{
 
	function getdebt() {

		 $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

		
		 $new_debt = "SELECT *, DATEDIFF(expiry_date, CURDATE()) AS days FROM transactions LEFT JOIN services ON services.id = transactions.service LEFT JOIN statuses ON statuses.id = transactions.status WHERE uid = '5afe9c7ac74e95.91010227' AND status = 2";
 			$results = mysqli_query($db,$new_debt);
 			

		 while ($row = mysqli_fetch_array($results)) {

$days = $row['days'];

if ($days <= 30) {

$debt1 = (($row['interest'] * $row['amount']) * $days) + $row['amount'];

} else if ($days >= 31 && $days <= 35) {

$debt2 = (0.20 * $row['amount']) + $row['amount'];

} else if ($days >= 36 && $days <= 40) {

$debt3 = (0.25 * $row['amount']) + $row['amount'];

} else if ($days >= 41 && $days <= 45) {

$debt4 = (0.30 * $row['amount']) + $row['amount'];

}

$debt = ($debt1 + $debt2 + $debt3 + $debt4);

                return  $debt;
     }
   }
}


?>
