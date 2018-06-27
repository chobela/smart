<?php
    require_once('class.phpmailer.php');
    function sendmail($to,$subject,$message,$name)
    {
                  $mail             = new PHPMailer();
                  $body             = $message;
                  $mail->IsSMTP();
                  $mail->SMTPAuth   = true;
                  $mail->Host       = "smtp.gmail.com";
                  $mail->Port       = 587;
                  $mail->Username   = "chobelak@gmail.com";
                  $mail->Password   = "djmuraga2";
                  $mail->SMTPSecure = 'tls';
                  $mail->SetFrom('chobelak@gmail.com', 'chobela');
                  $mail->AddReplyTo("chobelak@gmail.com","chobela");
                  $mail->Subject    = $subject;
                  $mail->AltBody    = "Any message.";
                  $mail->MsgHTML($body);
                  $address = $to;
                  $mail->AddAddress($address, $name);
                  if(!$mail->Send()) {
                      return 0;
                  } else {
                        return 1;
                 }
    }
?>
