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
			$layout->showHeader('Buku', $fb);
			$layout->showBookSubMenu('Info Peminjaman');
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
	//				$rentinfo->showFilter();
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
							$rentinfo->showSubsRent();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?
		$nefooter = new BookLayout();
		$nefooter->showBookFooter();
		//$layout->showFooter($nefooter->showNewsEventsFooter());
	?>
</body>
</html>
