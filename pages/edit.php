<?php
include 'send/Config.php';
include('conn.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Etc/UTC');
require 'send/PHPMailerAutoload.php';
require_once 'send/class.sms.php';
	
	$id=$_GET['id'];
	$person=$_GET['person'];
        $email=$_GET['email'];
        $phone=$_GET['phone'];
        $name=$_GET['name']; 
	$service=$_GET['service'];
        $date= date('Y-m-d');
        $exp= date('Y-m-d', strtotime($date. ' + 30 days'));
	$appr=$_POST['status'];
        
      
	
	$result = mysqli_query($conn,"update transactions set aproved_date = '$date', status='$appr', expiry_date='$exp', edited_by='$person' where id='$id'");

	if ($result == true) {

/********** Begin Send SMS *********/		
			$sms = new SMSPost ;
			
			$sms->Destination = $phone;
			
			$sms->SenderAddress = "Easy-Bills" ;
			
			$sms->Message  = 'Hello '. $name . ', Your '. $service . ' has been paid for. kindly note that your due date of payment is '. $exp .'';
			
			$sms->sendSMS() ;
	
/********** End Send SMS *********/

/********** Begin Send EMAIL *********/	

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "easybills123@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "easybills123!";

//Set who the message is to be sent from
$mail->setFrom('easybills123@gmail.com', 'Easy-Bills');

//Set an alternative reply-to address
$mail->addReplyTo('easybills123@gmail.com', 'Easy-Bills');

//Set who the message is to be sent to
$mail->addAddress($email, $name);

//Set the subject line
$mail->Subject = 'Your Easy-Bills Login Password';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->Body = 'Hello '. $name . ', Your '. $service . ' has been paid for. kindly note that your due date of payment is '. $exp .'';

//Replace the plain text body with one created manually
$mail->AltBody = 'Hello '. $name . ', Your '. $service . ' has been paid for. kindly note that your due date of payment is '. $exp .'';

//Attach an image file
$mail->addAttachment('examples/images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {

 $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);

$message = $mail->Body;
                        
			$sql = "INSERT INTO sentemails (name, email, message, sent_on) VALUES ('$name', '$email', '$message', NOW())";

                        mysqli_query($db,$sql);
    echo "Message sent!";
/********** End Send EMAIL *********/


header('location:subscriptions.php');
}
         	
} else {
	
	echo 'An error occured!';

}
?>
