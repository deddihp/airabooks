<!DOCTYPE html>
<?php
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
<html xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<?php
			echo $mlayout->writeHeadParameter();
		?>
	</head>
	<body>
	
	<?
			echo $mlayout->writeBodyHeader();
	?>
	<?
	$width = $_GET['width'];
	if ( $width == "" ) {
		$width = 600;
	}
	echo "<fb:login-button style=\"border:0px solid black; 
					margin-top:0px;\" show-faces=\"true\" width=\"".$width."px\" max-rows=\"1\"></fb:login-button>";
	?>			
	test ham ham
	</body>
</html>
