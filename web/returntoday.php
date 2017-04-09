<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? 
	include 'fb_connect.php';
	$fb = new fbConnect();
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
			$layout->showHeader('Peminjaman', $fb);
			$layout->showRentMenu('Dikembalikan Hari Ini');
		?>
	</div>
	<?php
		include 'rent.php';
		$rentinfo = new RentInfo();
	?>			
	<div class="body">
		<div>
			<div class="filter">
				<?
					//$rentinfo->showFilter($fb);
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
							$rentinfo->showReturnToday($fb);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?
		include 'book.php';	
			$bookfooter = new BookLayout();
		$bookfooter->showBookFooter();
	?>
</body>
</html>
