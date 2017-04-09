<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? 
	include 'fb_connect.php';
	$fb = new fbConnect();
	if ( $fb->userstatus != 'ADMIN') {
		echo "Anda bukan Admin";
		exit;
	}

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div class="header">
<!--		<div>
			<ul>
				<li>
					<a href="index.php"><span>H</span>ome</a>
				</li>
				<li class="selected">
					<a href="book.html"><span>B</span>uku</a>
				</li>
				<li>
					<a href="staff.html"><span>S</span>taf</a>
				</li>
				<li>
					<a href="contact.html"><span>K</span>ontak</a>
				</li>
			</ul>
			<div>
			</div>
		</div>
	-->
		<?
			include 'layout.php';
			$layout = new ComicLayout();
			//$layout->showHeader('Buku');
			//$layout->showBookSubMenu('Judul Buku');
		?>
	</div>
	<?php
		include 'book.php';
		$badMember = new BadMember();
	?>			
	<div class="body">
		<div>
			<div class="filter">
				<?
				//	$booktitle->showFilter();
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
							$badMember->showHTML();
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
