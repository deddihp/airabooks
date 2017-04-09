
<?
	include 'lib/mail.php';
	$user_email = $_GET['user_email'];
	$user_name = $_GET['name'];
	$subscriber_id = $_GET['subscriber_id'];
	$user_message = $_GET['content'];
	$message = "ID Anggota : ".$subscriber_id."<br>
		Nama : ".$user_name."<br>
		Email Address : ".$user_email."<br>
		Saran/Kritik : ".$user_message;
	$mymail = new MyMail();
	$mymail->SendMail('deddihp@gmail.com', 'Deddi Hariprawira', 'Saran & Kritik', $message);
	echo "<p class=\"about\">Saran dan Kritik anda telah dikirim.<br><br>Terima Kasih</p>";
?>
