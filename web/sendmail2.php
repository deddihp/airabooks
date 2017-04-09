<html>
<head>
<title>PHPMailer - SMTP basic test with authentication</title>
</head>
<body>


<?php
	error_reporting(E_STRICT);


	
	require_once('phpmail/class.phpmailer.php'); 
	// Sesuaikan dengan lokasi file class.phpmailer.php anda

	$mail = new PHPMailer();
 
	// setting
	$mail->IsSMTP();  // Fungsi Pengiriman dengan SMTP
	$mail->Host     = "airabooks.com";//"rumahweb.info"; // server mail anda
	$mail->SMTPAuth = true;     
	$mail->Username = "deddihp@airabooks.com";//"dhyar@rumahweb.info";  // username email anda
	$mail->Password = "kimikakeru"; //
 
	// pengirim
	$mail->From     = "deddihp@airabooks.com"; // Masukan dari form.php variabel email
	$mail->FromName = "Deddi Hariprawira"; // Masukan dari form.php variabel nama
 
// penerima
	$mail->AddAddress("deddihp@gmail.com","Deddi Hp");
	//$mail->AddCC("$_POST[email]",",$_POST[nama]"); // Jika email akan dikirimkan juga ke pengirim --> masukan dari form : CC
	$mail->AddBCC("laili.hp@gmail.com"); // alamat email BCC
 
	// kirim balik
	$mail->AddReplyTo("deddihp@airabooks.com","DDH"); // Kirim balik jika ingin reply
 
	$mail->WordWrap = 50;                              // set word wrap
	//$mail->AddAttachment(getcwd() . "/$_POST[file1]");      // attachment --> hapus double slash untuk mengaktifkan
	$mail->IsHTML(true);                               // send as HTML
 
	//Subject dan isi Pesan
	$mail->Subject  =  "SUBJECT";//"$_POST[subject]";
	$mail->Body     =  "BODY";//"$_POST[pesan]";
	$mail->AltBody  =  "ALTBODY";//"$_POST[pesan]";
 
	if(!$mail->Send())
	{
   		echo "Message was not sent </p><p>";
   		echo "Mailer Error: " . $mail->ErrorInfo;
   		exit;
	}	
/* 
echo "Terima Kasih telah Menghubungi Kami";
} else {
      echo "Salah";
   }
}*/
?>
