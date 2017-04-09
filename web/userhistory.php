<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? 
	include 'fb_connect.php';
	$fb = new fbConnect();
	if ( $fb->fb_user == false ) {
		echo "Anda harus Login Terlebih Dahulu";
		exit;
	}

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">

	<script type="text/javascript" src="jquery.min.js"></script> 
	<? echo $fb->writeJSCaptureLike(); ?>
	
</head>
<body>
	<? echo $fb->writeFBJSHeader(); ?>	
	
	<div class="header">
		<?
			include 'layout.php';
			$layout = new ComicLayout();
			$layout->showHeader('Anggota', $fb);
			$layout->showUserMenu('Riwayat Peminjaman', $fb);
		?>
	</div>
	<?php
		include 'book.php';
	?>			
	<div class="body">
		<div>
			<div class="filter">
				<?
					include 'rent.php';
					$rhist = new RentHistoryInfo();
					$rhist->showFilter();	
				?>
				<!-- For Filter -->
			</div>
		</div>
	</div>
	<div class="body">
		<div class="forcontent">
			<div>
				<div>
					<div class="section">
						<?
							//$booktitle->showHTML();
							$rhist->showSubsRent($fb);//->subscriber_id);
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
