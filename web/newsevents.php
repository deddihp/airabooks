<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? include 'book.php'; ?>
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
			$layout->showHeader('News & Events');
			//$layout->showHomeMenu('Jadwal Buka');
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
						<? echo "News & Events"; ?>
						</p>
							<table border="1">
								<tr>
									<td>
										27 September 2013
									</td>
									<td>asdf</td>
								</tr>
							</table>
						<p>
						
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
