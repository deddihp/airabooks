<?
session_start();
//	include 'lib/mail.php';
	include 'lib/layout.php';
		include 'lib/mysql_comic.php';
		include 'lib/book.php';
		include 'lib/mail.php';
	//	include 'lib/sync.php';
	
	echo "check";
	$mail = new MyMail();
	//$result = $mail->SendMailBCC('deddihp@yahoo.com,deddihp@gmail.com', 'Anggota airabooks', 'Hari Raya Idul Fitri', 'test');
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$query = "SELECT * FROM subscriber";
	
	$result = $mysql->query($query);
	$content = '';
	while ( $row = mysqli_fetch_array($result) ) {
		$content .= $row['email_address'];
		$content .= ',';
	}
	echo $content;
	
	$message = "
	
	<img src='http://airabooks.com/cover_small/MIK.jpg'>
	<p style='text-indent:15px'>
	Teman - teman anggota airabooks yang baik,
	</p>
	<p style='text-indent:15px'>
	Untuk memperingati Hari Raya Idul Fitri, Persewaan Buku airabooks berencana akan tutup mulai tanggal 4 Agustus 2013 dan buka lagi tanggal 19 Agustus 2013.
	</p>
	<p style='text-indent:15px'>
	Bagi teman - teman yang ingin mengembalikan buku, silakan dilakukan sebelum tanggal 4 Agustus 2013.
	</p>
	<p style='text-indent:15px'>
	Adapun bagi teman - teman yang ingin meminjam buku selama kami tutup ataupun untuk dibawa pulang, Teman - teman bisa meminjam buku seperti biasa sembari menginformasikan ke admin kami, kapan bukunya akan dikembalikan.
	</p>
	<p style='text-indent:15px'>
	Untuk lebih jelasnya silakan bertanya ke admin kami.
	</p>
	<p style='text-indent:15px'>
	Sekali lagi, Kami sebagai manusia biasa tidak luput dari kesalahan yang disengaja maupun yang tidak disengaja.
	</p>
	<p style='text-indent:15px'>
	Kami segenap pengurus airabooks mengucapkan Selamat Hari Raya Idul Fitri Mohon Maaf lahir dan batin.
	</p>

	<p style='text-indent:15px'>
	Terima Kasih,
	</p>
	
	<p style='text-indent:15px'>
	airabooks
	</p>

	<br><br>
	<p>	
	Kunjungi website kami di <a href='http://airabooks.com'>www.airabooks.com</a><br>
	Kunjungi Toko Buku kami di <a href='http://store.airabooks.com'>www.store.airabooks.com</a>
	</p>
	";
	//$result = $mail->SendMailBCC($content, 'Anggota airabooks', 'Hari Raya Idul Fitri', $message);
	$result = $mail->SendMail('deddihp@gmail.com', 'Anggota airabooks', 'Hari Raya Idul Fitri', $message);
	

	//print_r($mail);
	echo 'result = '.$result;

	echo "check";
?>
