<?php
	ob_start();
	session_start();		
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
?>
<?
	if ( isset($_GET['fb_id']) ) {
		$fb_id = $_GET['fb_id'];
		$fb_name = $_GET['name'];
		$fb_info = getFBInfo($fb_id, $fb_name);
		$subscriber_id = $fb_info['subscriber_id'];//$_GET['subscriber_id'];
		if ( $fb_id != "" ) {
			//	session_start();
			$_SESSION['fb_id'] = $fb_id;
			$_SESSION['subscriber_id'] = $subscriber_id;
			$_SESSION['status'] = $fb_info['status'];
			$_SESSION['full_name'] = $fb_info['full_name'];
			$_SESSION['role'] = $fb_info['role'];
			$_SESSION['email_address'] = $fb_info['email_address'];
	 
		header("Location: index.php");
	} else {
		echo "Login Failed";
	}
}
?>
