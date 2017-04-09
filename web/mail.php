<?php
	error_reporting(E_STRICT);
	require_once('phpmail/class.phpmailer.php');
class MyMail {
	
	function SendMail($email_address, $full_name, $subject, $message) {
		$mail = new PHPMailer();
		// setting
		$mail->IsSMTP();
		$mail->Host='airabooks.com';
		$mail->SMTPAuth = true;
		$mail->Username = "webmaster@airabooks.com";//"dhyar@rumahweb.info";  // username email anda
		$mail->Password = "kimikakeru"; 
		$mail->From= "webmaster@airabooks.com"; // Masukan dari form.php variabel email
		$mail->FromName = "webmaster at airabooks"; // Masukan dari form.php variabel nama
		$mail->AddAddress($email_address, $full_name);
		$mail->AddBCC("deddihp@gmail.com"); // alamat email BCC
		$mail->AddReplyTo("webmaster@airabooks.com","webmaster at airabooks");
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject=$subject;
		$mail->Body=$message;
	//	$mail->AltBody='ALTBODY';
		if(!$mail->Send()){
			echo "Message was not sent </p><p>";
			echo "Mailer Error: " . $mail->ErrorInfo;
			return false;
		}
		return true;	
	}
}
?>
