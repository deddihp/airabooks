<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? include 'book.php'; ?>
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
			$layout->showHeader('Staf', $fb);
//			$layout->showHomeMenu('Jadwal Buka');
		?>
	</div>
	<?php
		//include 'book.php';
		//$booktitle = new BooksTitle();
	?>			
	<div class="body">
		<div>
			<div class="filter">
				<?
					//$booktitle->showFilter();
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
						
						<p class="h2">
						Jadwal Buka	
						</p>
						<p class="h2">
						</p>
						<p class="h2">
						</p>
						<p class="h2">
						Hari Senin - Jumat Buka Pukul 10.00 - 22.00
						<p>
						<p class="h2">
						Hari Minggu Buka Pukul 15.00 - 22.00
						</p>
						<p class="h2">
						</p>
						<?
				//			$booktitle->showHTML();
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
