<?
	$to="deddihp@gmail.com";
	$subject="Aktivasi Pengguna";
	$message="Nomor Registrasi anda";
	# Attempt to send email
	if(mail($to, $subject, $message, "$headers \r\n From: $from"))
  		echo "Mail sent";
	else
  	echo "Mail send failure - message not sent";
?>
