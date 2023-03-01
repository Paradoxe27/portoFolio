<?php

include('smtp/PHPMailerAutoload.php');

$html='Msg';

function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->SMTPDebug = 3;
	$mail->isSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "mathieuclovis2020@gmail.com"; #adresse compte gmail 
	$mail->Password = "bnglrirhxnnceqxs"; #mot de passe compte gmail pour les applications
	$mail->SetFrom("mathieuclovis2020@gmail.com"); #adresse compte gmail 
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		#echo $mail->ErrorInfo;
	}else{

		header('Location: ../../index.html');
		exit();

		return 'Sent'; 
		
	}
}

if(isset($_POST["send_mail"])){

    if(isset($_POST["email"]) && isset($_POST["message"]) && isset($_POST["name"]) ){

		if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			smtp_mailer($_POST["email"], "Hello ".$_POST["name"],$_POST["message"] );
		}else{
			echo "email invalide";
		}

    }
}else{

	echo "null send mail bouton";
}


?>






