<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? 
	include 'fb_connect.php';
	$fb = new fbConnect();
?>
<? include 'book.php'; ?>
<html>
<head>
	<meta charset="UTF-8">
	<title>airabooks - Jadwal Buka</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	
	<meta property="og:title" content="Jadwal Buka airabooks"/>
	<meta property="og:site_name" content="airabooks.com"/>
	<meta property="og:image" content="http://airabooks.com/images/asli-wood.png"/>
	<meta property="og:description" content="Jadwal Buka airabooks. (Senin - Jumat Pukul 10:00 - 22:00. Dan Minggu Pukul 15:00 - 22:00."/>
	<meta property="og:url" content="http://airabooks.com/open.php"/>
	

</head>
<body>
	<? echo $fb->writeFBJSHeader(); ?>	
	
	<div class="header">
	<?
			include 'layout.php';
			$layout = new ComicLayout();
			$layout->showHeader('Home', $fb);
			$layout->showHomeMenu('Jadwal Buka');
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
	<div class="comment">
		<table width="100%" >
			<tr>
				<td></td>
				<td width="80%">
				<?
					echo $fb->writeLikeButtonCommon("http://airabooks.com/open.php", "like");
					echo $fb->writeCommentCommon("http://airabooks.com/open.php");
				?>
				</td>
				<td></td>
			</tr>
		</table>
	</div>


	<?
		$bookfooter = new BookLayout();
		$bookfooter->showBookFooter();
	?>
</body>
</html>
