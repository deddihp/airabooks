<?php
	session_start();
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
?>
<?php
	/* Define Header */
	$mlayout = new MainLayout;	
	$rpop = new RandomPopular;
?>
<?
		$fb_id = $_GET['fb_id'];
		
	//	$fb_info = getFBInfo($_GET['fb_id']);	
		$fb_info = getFBInfoOffline();
		CountUserLog($fb_info);
		echo $mlayout->writeProfileHeaderContent($fb_info, $_GET['dir']);	
	?>
