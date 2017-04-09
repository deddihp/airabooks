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
<html>
	<head>
		<?php
//			echo $mlayout->writeHeadParameter();
		?>
</head>
	<body style="background-color:white">
		<?
			//$rpop->getPopularRandom();
//			echo $mlayout->writeHeader();
//			echo $mlayout->writeMenu('Home', "");
		?>
			
		<?
			echo $mlayout->writeBodyHeader();
			$content = $rpop->getBookSnapshotInfo($_GET['bookcode']);
			echo $mlayout->writeBOXSnapshotContent($content);
		?>
	</body>
</html>
