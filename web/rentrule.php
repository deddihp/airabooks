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
			$layout->showHeader('Home', $fb);
			$layout->showHomeMenu('Peraturan Sewa');
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
						<p class=h2>
							Peraturan Sewa
						</p>
						<p class="about">
						Kategori Buku :
							<ul class="about">
								<li>
									A : Buku Komik Elex dan M&C
								</li>
								<li>
									B : Buku Komik Level
								</li>
							</ul>
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
