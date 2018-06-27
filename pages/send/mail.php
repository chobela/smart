<?php

 require_once 'mailer/PHPMailerAutoload.php';

	$m = new PHPMailer;

	$m -> isSMTP();
	$m->SMTPAuth   = true;
	$m->SMTPDebug  = 2; 

        $m->Host       = "smtp.gmail.com";
        $m->Port       = 25;
        $m->Username   = "chobelak@gmail.com";
        $m->Password   = "djmuraga2";
        $m->SMTPSecure = 'ssl';

        $m->From('chobelak@gmail.com');
        $m->FromName('chobela Kakumbi');
        $m->AddReplyTo('chobelak@gmail.com','chobela');
        $m->Subject    = 'here is an email';
        $m->Body    = 'Any message.';
        $m->AltBody    = 'Any message.';
        $m->MsgHTML($body);

	var_dump ($m->send());

?>
