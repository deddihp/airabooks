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
	$bookscommon = new BooksCommon;
	$bookslayout = new BooksLayout;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Peminjaman Hari Ini</title>
		<?php
			echo $mlayout->writeHeadParameter();
		?>
		<?
			$description = "Informasi Peminjaman Hari Ini";
			echo writeMetaInfo($description);
		?>
		<meta property="og:type" content="website"/>
		<meta property="fb:admins" content="1192425363"/>
		<meta property="fb:app_id" content="159457617553432"/>
		<meta property="og:title" content="<? echo $description;?>"/>
		<meta property="og:site_name" content="www.airabooks.com"/>
		<meta property="og:description" content="<? echo $description; ?>"/> 
		

		
	</head>
	<body>
		<?
			$header = $mlayout->writeHeader();
		?>
		<?
			$menu = $mlayout->writeMenu("Peminjaman Hari Ini", "");
		?>
	
		<?
			$mcontent = $bookslayout->writeBooksRentInfo($mlayout, $bookscommon,
				"Peminjaman Hari Ini", "Informasi Peminjaman Hari Ini", "renttoday.php", " Hari Ini");
		?>
		<?
			echo printBasicLayout($mlayout, $header, $menu, $mcontent);
		?>
	</body>
</html>
