<?
	//include 'mysql_comic.php';
	include 'mail.php';

class SynchAccount {

	function generateRandomString($length = 10) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
        	$randomString .= $characters[rand(0, strlen($characters) - 1)];
    	}
    	return $randomString;
	}

function synch() {
	//$subscriber_id = $_POST['idsubs'];
	$email_address = $_POST['email_address'];
	$fb_id = $_POST['fbid'];
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	//obtain email address from comic db;
	$query = "select full_name, email_address, subscriber_id from subscriber where email_address='".$email_address."'";
	////echo "QUERY = ".$query;
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	$email_address = $row['email_address'];
	$full_name = $row['full_name'];
	$subscriber_id = $row['subscriber_id'];
//echo "QUERY = ".$query;
	
	if ( $subscriber_id == "" )
		return "Email Address anda tidak terdaftar. <br>
		Segera hubungi admin airabooks untuk memastikan email yang anda masukkan sama dengan email yang terdaftar di airabooks";
	if ( $email_address == "" )
		return "INVALID Subscriber ID";

	//echo "<br>XQUERY = ".$query;
	//select user activation check if exist or not;
	$mysql_web = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query = "select random_code from user_activation where subscriber_id='".$subscriber_id."'";
	//echo "<br>QUERY = " .$query;
	$result = $mysql_web->query($query);
	$row = mysqli_fetch_array($result);
	$random_code = $row['random_code'];
	//echo "<br>NQUERY = ".$query;
	
	$mymail = new MyMail();
	//echo "<br>mQUERY = randomcode->".$random_code;
		
	if ( $random_code != "" ) {
		$mymail->SendMail($email_address, $full_name, "Sinkronisasi Akun ".$full_name." (".$subscriber_id.")", "
		<html>
			<body>
				<p>
				<font-family='Verdana'>
				Halo ".$full_name.",
				<br>
				<br>
				Klik
				<a href=\"http://www.airabooks.com/synchronize.php?idsubs=".$subscriber_id."&activation_code=".$random_code."\">disini</a> untuk men-sinkron kan akun anda : 
				<br><br>
				Jabat Erat,<br><br>

				airabooks
				</font>
				</p>
			</body>
		</html>
		");
		return "Kode aktivasi telah dikirim ke Email anda yang terdaftar di airabooks.</p><p class=\"about\">
			Silakan Buka email anda dan klik link dari airabooks tersebut, Jangan Lupa cek spam juga";
	}

	//Generate random code
	//echo "<br>ZZZZZQUERY = ".$query;
	
	$random_code = $this->generateRandomString(40);
	//insert into user_activation 
	//echo "<br>ranomQUERY = ".$query;
	
	$query = "insert into user_activation values(NOW(), '".$subscriber_id."', '".$fb_id."','".$random_code."','NOT ACTIVE', 'USER')";
	//echo "QUERY = ".$query;
	$result = $mysql_web->query($query);

	$mymail->SendMail($email_address, $full_name, "Sinkronisasi Akun ".$full_name." (".$subscriber_id.")", "
		<html>
			<body>
			<p>
				<font-family='Verdana'>
				Halo ".$full_name.",
				<br>
				<br>
				Klik
				<a href=\"http://www.airabooks.com/synchronize.php?idsubs=".$subscriber_id."&activation_code=".$random_code."\">disini</a> untuk men-sinkron kan akun anda : 
				<br><br>
				Jabat Erat,<br><br>

				airabooks
				</font>
				</p>
			</body>
		</html>
		");
	//send email
	return "Kode aktivasi telah dikirim ke Email anda yang terdaftar di airabooks.</p><p class=\"about\"> 
	Silakan Buka email anda dan klik link dari airabooks tersebut, Jangan Lupa cek spam juga";
	}

	function synchronize($fb) {
		//echo "Subscriber ID Anda = ".$fb->subscriber_id;
		$idsubs = /*$fb->subscriber_id;//*/$_GET['idsubs'];
		if ( $idsubs == "" )
			$idsubs = "BLABLA";
		$activation_code = $_GET['activation_code'];
		if ( $activation_code == "" )
			$activation_code = "UNKNOWN";
		$query = "select random_code from user_activation where subscriber_id='".$idsubs."'";
		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		if ( $row['random_code'] != $activation_code ) {
			return "Kode aktivasi anda tidak cocok, Silakan menghubungi admin airabooks";
		}

		$query = "update user_activation set status='ACTIVE' where random_code='".$activation_code."' and subscriber_id='".$idsubs."'";
		//echo "QUERY = ".$query;
		$result = $mysql->query($query);
		//header('Location: index.php');
		//var_dump($result);
		return "bool(true)"; 
	}

	function getSynchStatus($fb_id) {
		$query = "select status from user_activation where fb_id='".$fb_id."'";
		//echo "QUERY = " . $query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['status'];
	}
	function getUserStatus($fb_id) {
		$query = "select role from user_activation where fb_id='".$fb_id."'";
		//echo "QUERY = " . $query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['role'];
	}	
	function getSubscriberID($fb_id) {
		$query = "select subscriber_id from user_activation where fb_id='".
		$fb_id."'";
		//echo "QUERY1 = " . $query."<br>";
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['subscriber_id'];
	}
	function getSubscriberName($subscriber_id) {
		$query = "select full_name from subscriber where subscriber_id='".$subscriber_id."'";
		//echo "QUERY2 = " . $query."<br>";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['full_name'];
	}
	
	function captureLogin($fb_id, $fb_name) {
		$subscriber_id = $this->getSubscriberID($fb_id);
		if ( $subscriber_id == "" )
			$name = "[FIRST ACTIVATION]";
		else	
			$name = $this->getSubscriberName($subscriber_id);
		$query = "insert into user_visit_log values(NOW(), 'LOGIN',
		'".$fb_id."' , '".$fb_name."',
		'".$subscriber_id."', '".$name."')";
		//echo "QUERY INSERT = ".$query."<br>";
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		//$row = mysqli_fetch_array($result);
	}
	function captureLogout($fb_id, $fb_name) {
		
		$subscriber_id = $this->getSubscriberID($fb_id);
		$query = "insert into user_visit_log values(NOW(), 'LOGOUT',
		'".$fb_id."' , '".$fb_name."',
		'".$subscriber_id."', '".$this->getSubscriberName($subscriber_id)."')";
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		//print_r($mysql);
		$result = $mysql->query($query);
		//$row = mysqli_fetch_array($result);
	}
}
?>
