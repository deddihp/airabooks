<!DOCTYPE html>
<? include 'mysql_comic.php'; 
	include 'book.php';
	include 'fb_connect.php';
	$fb = new fbConnect();
	if ( $fb->error_msg == "" && $fb->fb_user == false ) {
		echo "Anda harus Login Terlebih Dahulu";
		exit;
	}
?>
<html>
<head>
	<?
		$fb->errorHandler($fb);	
	?>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div class="header">
	<?
			include 'layout.php';
			$layout = new ComicLayout();
			$layout->showHeader('Anggota', $fb);
			$layout->showUserMenu('Profil', $fb);
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
							<?
								$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
								$query = "select distinct(fb_name) from user_visit_log";
								$result = $mysql->query($query);
								while ($row = mysqli_fetch_array($result) ) {
									echo $row['fb_name']."<br>";
								}
							?>
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
