<!DOCTYPE html>
<? include 'mysql_comic.php'; 
	include 'book.php';
?>
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
	<? echo $fb->writeFBJSHeader(); ?>	
	
	<div class="header">
	<?
			include 'layout.php';
			$layout = new ComicLayout();
			$layout->showHeader('Kontak', $fb);
			//$layout->showBookSubMenu('Judul Buku');
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
						Kontak
						</p>
						<p class="contact">
						Alamat : Jalan Sukabirus No. 102 Bojongsoang 
						Bandung - Jawa Barat
						</p>
						<p class="contact">
						No Telepon : 08121452791
						</p>
						<p class="contact">
						Email : airabooks@gmail.com
						</p>
						<p class="contact">
						FB : www.facebook.com/airabooks</a>
						</p>
						<p class="contact">
						twitter : www.twitter.com/airabooks
						</p>
						<?
						//	$booktitle->showHTML();
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
					echo $fb->writeLikeButtonCommon("http://airabooks.com/contact.php", "like");
					
					echo $fb->writeCommentCommon("http://airabooks.com/contact.php");
				?>
				</td>
				<td></td>
			</tr>
		</table>
	</div>;


	<?
			$bookfooter = new BookLayout();
		$bookfooter->showBookFooter();
	?>
</body>
</html>
