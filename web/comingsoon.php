<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? 
	include 'fb_connect.php';
	$fb = new fbConnect();
?>

<?php
		include 'book.php';
		$booktitle = new NewsEvents();
	?>
<html>
<head>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">

	<meta property="og:title" content="<?echo $_GET['title'];?>"/>
	<meta property="og:site_name" content="airabooks.com"/>
	<meta property="og:image" content="http://airabooks.com/images/asli.jpg"/>
	<!-- "http://airabooks.com/cover/<? echo str_replace(' ','%20', $_GET['title']);?>.jpg"/> -->
	<meta property="og:description" content="<? echo str_replace('<br>', ' ', $booktitle->getComingSoonArticle()); ?>"/>
	<meta property="og:url" content="http://airabooks.com/comingsoon.php?title=<?echo str_replace(' ', '%20', $_GET['title']);?>"/>
	

</head>
<body>
	<? echo $fb->writeFBJSHeader(); ?>
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
			$layout->showHeader('Buku', $fb);
			//$layout->showBookSubMenu('Rilis Terbaru');
		?>
	</div>
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
						<?
							$booktitle->showComingSoonHTML();
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
					echo $fb->writeCommentComingSoon();
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
