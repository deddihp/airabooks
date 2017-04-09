
<?php
	error_reporting(E_STRICT);	
	require_once('phpmail/class.phpmailer.php');
	// Sesuaikan dengan lokasi file class.phpmailer.php anda
	$mail = new PHPMailer();
	// setting
	$mail->IsSMTP();  
	// Fungsi Pengiriman dengan SMTP;
;	;$mail->Host='airabooks.com';
//"rumahweb.info"; // server mail anda
;	$mail->SMTPAuth = true;
	$mail->Username = "webmaster@airabooks.com";//"dhyar@rumahweb.info";  // username email anda
	$mail->Password = "kimikakeru"; 
	;$mail->From= "webmaster@airabooks.com"; // Masukan dari form.php variabel email
	$mail->FromName = "Deddi Hariprawira"; // Masukan dari form.php variabel 	nama
	$mail->AddAddress($_POST['to'],$_POST['full_name']);
	//$mail->AddCC("$_POST[email]",",$_POST[nama]"); // Jika email akan dikirimkan juga ke pengirim --> masukan dari form : CC
	$mail->AddBCC("deddihp@gmail.com"); // alamat email BCC
	$mail->AddReplyTo("webmaster@airabooks.com","airabooks' webmaster");
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	//send as HTML
	//Subject dan isi Pesan
	$mail->Subject=$_POST['subject'];
//"$_POST[subject]";
	$mail->Body=$_POST['message'];
//"$_POST[pesan]";
//$mail->AltBody='ALTBODY';
//"$_POST[pesan]";
	if(!$mail->Send()){
		echo "Message was not sent </p><p>";
		echo "Mailer Error: " . $mail->ErrorInfo;
		exit;
	}
	echo "Berhasil";	
/* 
echo "Terima Kasih telah Menghubungi Kami";
} else {
      echo "Salah";
   }
}*/
?>
