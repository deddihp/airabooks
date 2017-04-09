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
		<meta property="og:type" content="website"/>
		<meta property="fb:admins" content="1192425363"/>
		<meta property="fb:app_id" content="159457617553432"/>
		<meta property="og:title" content="www.store.airabooks.com"/>
		<meta property="og:site_name" content="store.airabooks.com"/>
		<meta property="og:image" content="http://store.airabooks.com/images/airabooks-store.png"/>
		<meta property="og:description" content="Toko Buku Online airabooks. Throw and Drag your Books to the Trolley. Bulan Promosi, Semua Buku Diskon 15%. Kami menawarkan cara baru dalam berbelanja, just Try it."/>
		<?php
		echo $mlayout->writeHeadParameter();
		?>
		</head>
	<body>
	
	<?
		$header = $mlayout->writeHeader();
	?>
	<?
		$menu = $mlayout->writeMenu('Home', "Home", "", "./");
	?>
		<?
		/*
			$content = $rpop->getPopularRandom();
			$mcontent = $mlayout->writeBOXContent($content);
			
			$mcontent = $mcontent .  "<div class=\"hline\"></div>";
			
			$content = $rpop->getNewRelease(5);
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
			*/
			$mcontent = "<p style='font:bold 18px/18px Arial, sans-serif;'>Toko Buku Online airabooks. Pengalaman Baru Membeli Buku</p>";
			$usedcategory = Array();
			$category = $rpop->getCategoryRandom($usedcategory);
			$usedcategory[] = $category;
			$result = $rpop->getBooksRandomByCategory($category, 3);
			$x = $rpop->writeBooksGroupForRandom($result);
			$mcontent .= '
			<table style="border-top:1px solid #e2e2e2;" cellpadding="0" cellspacing="0" border="0px" width="100%">
				<tr>
					<td valign="top">';
				
				$mcontent .= "<p class='subtitle'>Kategori ".$category."</p>";
				$mcontent .= "<table border='0px' width='100%'><tr>	";
				for ( $i = 0; $i < 3; $i++ ) {
					$mcontent .= "<td valign='top' width='33%'>".$x[$i]."</td>";
				}
			$mcontent .= "</tr></table>";
			

			$mcontent = $mcontent .  "<div class=\"hline\"></div>";
			
				$category = $rpop->getCategoryRandom($usedcategory);
				$usedcategory[] = $category;
				$result = $rpop->getBooksRandomByCategory($category, 3);
				$x = $rpop->writeBooksGroupForRandom($result);
			

			$mcontent .= "<p class='subtitle'>Kategori ".$category."</p>";
			$mcontent .= "<table border='0px' width='100%'><tr>	";
				for ( $i = 0; $i < 3; $i++ ) {
					$mcontent .= "<td valign='top' width='33%'>".$x[$i]."</td>";
				}
			$mcontent .= "</tr></table>";
			
			$mcontent = $mcontent .  "<div class=\"hline\"></div>";
			
				$category = $rpop->getCategoryRandom($usedcategory);
				$usedcategory[] = $category;
				$result = $rpop->getBooksRandomByCategory($category, 3);
				$x = $rpop->writeBooksGroupForRandom($result);
			

			$mcontent .= "<p class='subtitle'>Kategori ".$category."</p>";
			$mcontent .= "<table border='0px' width='100%'><tr>	";
				for ( $i = 0; $i < 3; $i++ ) {
					$mcontent .= "<td valign='top' width='33%'>".$x[$i]."</td>";
				}
			$mcontent .= "</tr></table>";
			


			$mcontent .='</td>
					<td width="180px" valign="top">';
				$category = $rpop->getCategoryRandom($usedcategory);
				$usedcategory[] = $category;
				$result = $rpop->getBooksRandomByCategory($category);
				$x = $rpop->writeBooksGroupForRandom($result);
			
			$mcontent .= "<div style='display:table;border-left:1px solid #e2e2e2;'>";
			$mcontent .= "<p class='subtitle' >Kategori ".$category."</p>";
				
				for ( $i = 0; $i < 4; $i++ ) {
					$mcontent .= "<div style='width:150px;margin:10px; float:left;'>".$x[$i]."</div>";
				}
			$mcontent .= "</div>";
			$mcontent .= '</td>
				</tr>
			</table>
			';
		?>
		<?
			echo printBasicLayout($header, $menu, $mcontent);
			//print_r($usedcategory);
		?>
	</body>
</html>
