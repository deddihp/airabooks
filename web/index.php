<?php
	session_start();
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
?>
<?php
	/* Define Header */
	$mlayout = new MainLayout;	
	$rpop = new RandomPopular;
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			echo $mlayout->writeHeadParameter();
		?>

		<title>airabooks - Pusat Sinopsis Komik & Novel</title>
	
		<?
			$description = "Pusat Sinopsis Komik & Novel";
			echo writeMetaInfo($description);
		?>
	<!--	<meta property="og:type" content="website"/>
		<meta property="fb:admins" content="1192425363"/>
		<meta property="fb:app_id" content="159457617553432"/>
		<meta property="og:title" content="www.airabooks.com"/>
		<meta property="og:site_name" content="airabooks.com"/>
		<meta property="og:image" content="http://airabooks.com/images/airabooks.png"/>
		<meta property="og:description" content=<? echo $description;?>/>
	-->
		</head>
	<body>
	
	<?
			$header = $mlayout->writeHeader();
	?>
	<?
		$menu = $mlayout->writeMenu('Home', "Home", "", "./");
	?>
	<?
		$mcontent = "
		<div class=\"mcontent\" id=\"mcontent\">";
		
		
			$content = $rpop->getPopularRandom();
			$mcontent = $mcontent .  $mlayout->writeBOXContent($content);
			
			$mcontent = $mcontent .  "<div class=\"hline\"></div>";
			
			$mcontent = $mcontent . "
				<table class=\"boxlong\" style='width:100%;text-align:center;'><tr>";
			/*for ( $i = 0; $i < 3; $i++ ) {
				$mcontent = $mcontent . "<td>
					".printAds($i+4)."
				</td>";
			}*/
			$mcontent .= '<td>'.printAds(0).'</td>';
			$mcontent = $mcontent . "</tr></table>";
			$mcontent = $mcontent .  "<div class=\"hline\"></div>";
			
			$content = $rpop->getNewRelease(5);
			$mcontent = $mcontent .  $mlayout->writeBOXLONGContent($content);
	
			$mcontent = $mcontent .  "<div class=\"hline\"></div>";
			
			$content = $rpop->getNewTitles(5);
			$mcontent = $mcontent .  $mlayout->writeBOXLONGContent($content);
			

			$mcontent = $mcontent .  "<div class=\"hline\"></div>";
			
			$content = $rpop->getMostPopular(5);
			$mcontent = $mcontent .  $mlayout->writeBOXLONGContent($content);
			
			$mcontent = $mcontent .  "<div class=\"hline\"></div>";
			
			$content = $rpop->getMostRecommended(5);
			$mcontent = $mcontent .  $mlayout->writeBOXLONGContent($content);
			
			$content = $rpop->getBooksOfTheMonth(5);
			if ( count($content) > 2 ) {
				$mcontent = $mcontent .  "<div class=\"hline\"></div>";
				$mcontent = $mcontent .  $mlayout->writeBOXLONGContent($content);//boxlongctnt);
			}
		$mcontent = $mcontent . "</div>";
	?>
	<?
			echo printBasicLayout($mlayout, $header, $menu, $mcontent);
	?>
	</body>
</html>
