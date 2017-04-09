<!DOCTYPE html>
<? 
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<?
	?>
	</div>
	<?php
	?>			
	<?
		include 'lib/layout.php';
		include 'lib/mysql_comic.php';
		include 'lib/book.php';
		include 'lib/mail.php';
		include 'lib/sync.php';
		$synch = new SynchAccount();
		echo $synch->synch();
	?>
</body>
</html>
