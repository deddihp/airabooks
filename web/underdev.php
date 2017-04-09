<!DOCTYPE html>
<? include 'mysql_comic.php'; 
	include 'book.php';
	include 'fb_connect.php';
	$fb = new fbConnect();
//	if ( $fb->fb_user == false ) {
//		echo "Anda harus Login Terlebih Dahulu";
//		exit;
//	}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div class="header">
	<?
			include 'layout.php';
			$layout = new ComicLayout();
			$layout->showHeader('', $fb);
	//		$layout->showUserMenu('', $fb);
		?>
	</div>
	<?php
		//include 'book.php';
		//$booktitle = new BooksTitle();
	?>			
	<div class="body">
		<div class="forcontent">
				<div>
					<div>
						<div class="section">
							<img src="images/underdev.png">
						</div>
					</div>
			</div>
		</div>
	</div>
	<?
		$bookfooter = new BookLayout();
		$bookfooter->showBookFooter();
	?>
</body>
</html>
