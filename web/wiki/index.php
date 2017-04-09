<?php
	session_start();
	/* Define All Class */
	include '../lib/layout.php';
	include '../lib/mysql_comic.php';
	include '../lib/book.php';
?>
<?php
	/* Define Header */
	$mlayout = new MainLayout;
	$wlayout = new WikiLayout;
	$rpop = new RandomPopular;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Wiki</title>
		<?
			$description = "Persewaan Komik, Novel dan CD/DVD Original.";
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
			$menu = $mlayout->writeMenu('Wiki Page', "", "", "../");
		?>
		<?
		$mcontent = "
		<div class=\"mcontent\" id=\"mcontent\">
			".printAds(0)."
			<div class=\"wiki\">
				<p class=\"wiki-title\">Pranala Umum</p>
				<div style=\"margin:0 0 10px 0; border:0px solid black; display:table; width:100%;\">";
					$list_genre2 = Array (
						'Fantasy' => 'genre=Adventure+Fantasy',
						'Drama' => 'genre=Drama',
						'Romance' => 'genre=Romance',
						'Action' => 'genre=Action',
						'Comedy' => 'genre=Comedy',
						'History' => 'genre=History',
						'Detective' => 'genre=Detective',
						'Mystery' => 'genre=Mystery',
						'Sport' => 'genre=Sport',
					);

					$mcontent = $mcontent .  $wlayout->writeCategoriesBox("Komik", "wiki_bookinfo.php", "Komik", $list_genre2);
			
					$list_genre2 = Array (
						'Fantasy' => 'genre=Adventure+Fantasy',
						'Drama' => 'genre=Drama',
						'Romance' => 'genre=Romance',
						'Action' => 'genre=Action',
						'Comedy' => 'genre=Comedy',
						'History' => 'genre=History',
						'Detective' => 'genre=Detective',
						'Mystery' => 'genre=Mystery',
						'Sport' => 'genre=Sport',
					);

					$mcontent = $mcontent .  $wlayout->writeCategoriesBox("Novel", "wiki_bookinfo.php", "Novel", $list_genre2);
			

					$list_genre2 = Array (
						//	'Most Popular' => 'authorpop.php',
						//	'Most Recommended' => 'authorrecom.php',
						//	'Most Read' => 'a.php',
						//	'Most Productive' => 'a.php'
					);
					$mcontent = $mcontent .  $wlayout->writeCategoriesBox("Pengarang", "wiki_bookinfo.php", "Pengarang", $list_genre2);
				$mcontent = $mcontent . 
				"</div>";
				$mcontent = $mcontent . 
				"<div style=\"margin:0 0 10px 0;border:0px solid black; display:table; width:100%\">";
			?>
	<!--
		
			$list_genre2 = Array (
			'Sutradara' => 'wikinovelauthor.php',
			'History' => 'genrehistory.php',
			'Biografi' => 'genredetektif.php',
			'Islami' => 'genremystery.php',
			'Sport' => 'genresport.php',
			);
			$mcontent = $mcontent .  $wlayout->writeCategoriesBox("Peminjaman Buku", "novel_wikiinfo.php", "comic", $list_genre2);
		

			$list_genre2 = Array (
			'Pengarang' => 'wikinovelauthor.php',
			'Action' => 'genrehistory.php',
			'Drama' => 'genredetektif.php',
			'Romance' => 'genremystery.php',
			'Horror' => 'genresport.php',
			);
			$mcontent = $mcontent .  $wlayout->writeCategoriesBox("Film", "novel_wikiinfo.php", "comic", $list_genre2);
		

		
		-->
		<?
		$mcontent = $mcontent . 
		"</div>";

		$mcontent = $mcontent . "
		<p class=\"wiki-title\"><a href=\"wikiabout.php\">About</a></p>
		<div style=\"display:table; width:100%;
			background-color:#f1f1f1;
			border:1px solid grey;
			border-style:dotted;
			padding:0px 5px 0 5px; margin:0 0 20px 0;
			\">
		<p class=\"about\" style=\"margin:5px;\">
		Persewaan buku airabooks yang mulai beroperasi pada tanggal 7 April 2012 didirikan dengan mengusung beberapa ide yang mungkin agak muluk untuk usaha yang 'cuma' menyewakan buku komik dan novel. Ide nya adalah dengan memaksimalkan Teknologi Informasi untuk digunakan ke dalam kegiatan trans<a href=\"wikiabout.php\">...see more</a>
		</p>
		</div>
		</div>
	</div>";
	?>
	<?
		echo printBasicLayout($mlayout, $header, $menu, $mcontent, '../');
	?>
	</body>
</html>
