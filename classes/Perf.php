<?php

 class Perf{

 
	function totalspent() {

		 $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $new_users = "SELECT SUM(amount) AS amount FROM transactions";
 			$results = mysqli_query($db,$new_users);
 			

		 while ($row = mysqli_fetch_array($results)) {

                return  $row ['amount'];

     }
	}	

function totaldebt() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $new_users = "SELECT SUM(debt) AS debt FROM transactions";
 			$results = mysqli_query($db,$new_users);
 			

		 while ($row = mysqli_fetch_array($results)) {

                return  $row ['debt'];
     }
	}	


function totalsubs() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $new_users = "SELECT COUNT(*) AS subs FROM clients";
 			$results = mysqli_query($db,$new_users);
 			

		 while ($row = mysqli_fetch_array($results)) {

                return  $row ['subs'];
     }
	}	


function totalinterest() {

		 $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $new_users = "SELECT SUM(interest) AS interest FROM transactions";
 			$results = mysqli_query($db,$new_users);
 			

		 while ($row = mysqli_fetch_array($results)) {

                return  $row ['interest'];

     }
	}	

}


?>
