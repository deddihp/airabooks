<?
	include 'fb_connect.php';
	include 'mysql_comic.php';

	$fbconn = new fbConnect();
	
	$synch = new SynchAccount();
	$synch->captureLogout($fbconn->user_profile['id'], 
	$fbconn->user_profile['name']);
	

	header('Location: logout.php?url='.$_GET['url']);
?>
