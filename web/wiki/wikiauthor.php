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
<html>
	<head>
		<title><? echo $_GET['author_name']; ?></title>
		<?
			$description = 'Author, Pengarang, '.$_GET['author_name'];
			echo writeMetaInfo($description);
		?>
		<?php
			echo $mlayout->writeHeadParameter('../');
		?>

	</head>
	<body>
		<?
			$header = $mlayout->writeHeader('../');
		?>
		<?
			$menu = $mlayout->writeMenu('Wiki Page', '', '', '../');
		?>
	<?
	$mcontent = "
		<div class=\"mcontent\">
			<div class=\"wiki\">
				".$bookswiki->writeWikiAuthor($_GET['author_name'])."	
			</div>
		</div>";
	
		echo printBasicLayout($mlayout, $header, $menu, $mcontent, '../');
	?>
	</body>
</html>

