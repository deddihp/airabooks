<?php
	session_start();
	/* Define All Class */
	include '../lib/layout.php';
	include '../lib/mysql_comic.php';
	include '../lib/book.php';
?>

<?php
	$mlayout = new MainLayout;
	$bookswiki = new BooksWiki;
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Bantuan</title>
		<?php
			echo $mlayout->writeHeadParameter('../');
		?>

	</head>
	<body>
		<?
			$header = $mlayout->writeHeader('../');
		?>
		<?
			$menu = $mlayout->writeMenu('Bantuan', 'Bantuan', '', '../');
		?>
		<?
		$mcontent = "
		<div class=\"mcontent\">
			".printAds(0)."
			<div class=\"wiki\">
				<p class=\"wiki-title\">Bantuan</p>";
					$mcontent = $mcontent . $bookswiki->writeWikiHelp();
		?>
				<!--
				<ul>
					<li>
						<a class="wiki_minititle" id="New Release" href="#New Release">Apa itu menu 'New Release' ?</a>
					</li>
					<li style="list-style:none">
					<span class="wiki_minititle">Menu 'New Release' memberikan informasi buku - buku terbitan terkini yang telah tersedia di airabooks. Informasi tanggal terbit tersedia di halaman <a href=newrelease.php>New Release</a>.
					</span>
					</li>
					<li>
						<a class="wiki_minititle" id="Books Of The Month" href="#Books Of The Month">Apa itu menu 'Books Of The Month' ?</a>
					</li>
					<li style="list-style:none">
					<span class="wiki_minititle">Menu 'New Release' memberikan informasi buku - buku terbitan terkini yang telah tersedia di airabooks. Informasi tanggal terbit tersedia di halaman <a href=newrelease.php>New Release</a>.
					</span>
					</li>
				</ul>-->
		<?
			$mcontent = $mcontent . "</div>";
		$mcontent = $mcontent . 
		"</div>";
		?>
		<?
			echo printBasicLayout($mlayout, $header, $menu, $mcontent, '../');
		?>
	</body>
</html>

