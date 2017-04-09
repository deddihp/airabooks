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
	//$rpop = new RandomPopular;
	$bwiki = new BooksWiki;
?>
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
			//$rpop->getPopularRandom();
			echo $mlayout->writeHeader("../");
		?>
		<div id="maincontent" class="maincontent">	
		<?
			echo $mlayout->writeMenu('Wiki Page', "", "", "../");
		
			$genre = $_GET['genre'];
			if ( $_GET['submit'] == '<' )
				$offset = $_GET['offset<'];
			else
				$offset = $_GET['offset'];
			
			if ( $offset == "" )
				$offset = 0;
			
			if ( $_GET['submit'] == '<' )
				$start_c = $_GET['start<'];
			else
				$start_c = $_GET['start'];
			if ( $start_c == "" )
				$start_c = '0-9';
		?>
		<div class="mcontent" id="mcontent">
		<div class="wiki">
		<p class="wiki-title">Wiki Kategori:<?echo $_GET['category']; if ( $genre != "" ) echo " (Genre ".$genre.")";?></p>

		<div style=" margin:-10px 0 10px 60px;border:1px solid #e2e2e2; display:block; width:728px;height:90px;">
			<!--Ads Here-->
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-8383814472901134";
				/* Iklan_Horizontal */
				google_ad_slot = "3585301821";
				google_ad_width = 728;
				google_ad_height = 90;
				//-->
			</script>
			<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
	<form style="border:0px solid blue;float:left;" name="wiki_bookinfo" action="wiki_bookinfo.php">
			
			<?
			$st = $start_c;
			if ( $st == '0-9' )
				$st = 'Z';
			else
			if ( $st == 'A' )
				$st = '0-9';
			else 
				$st = chr((ord($st) - 1));
			//echo "CHECK HERE = ".$st;
		?>
		<input type="hidden" name="category" value="<? echo $_GET['category']; ?>">
		<input type="hidden" name="start<" value="<?echo $st;?>">
		<input type="submit" name="submit" value="<">
		<input type="hidden" name="offset<" value="0">	
		<input type="hidden" name="genre" value="<?echo $genre;?>">	
			<input type="hidden" name="category" value="<?echo $_GET['category'];?>">
			<input name="submit" type="submit" value=">">
		
		<div style="margin:0 0 10px 0; border:0px solid black; display:table; width:100%;">
			
			<div style="padding:5px;border:0px solid red;display:block;float:left;width:260px;">
			<?
				$i = 1;
				$quota = 90;
				$true_offset = $offset;
				//$start_c = $_GET['start'];
				$div_number = 0;
				//echo "<p class=\"style1\">- ".$start_c." -</p>";
			while ( true ) 
			{
				if ( $_GET['category'] == 'Pengarang' )
					$result = $bwiki->getAuthorByFirstChar($_GET['category'], $start_c, $true_offset, 200, $genre);
				else
					$result = $bwiki->getBooksByFirstChar($_GET['category'], $start_c, $true_offset, 200, $genre);
				
				echo "<p class=\"style1\">- ".$start_c." -</p>";
				//$row = mysqli_fetch_array($result);
				//echo "NUMROWS = ".mysqli_num_rows($result)."<br>";
				$numrows = mysqli_num_rows($result);
				if ( $quota > $numrows ) 
					$quota = $quota - $numrows;
				else {
					//echo "NextOffset 
					//	category".$start_c." offset = ".$quota."
					//";
					echo "<input type=\"hidden\" name=\"start\" value=\"".$start_c."\">";
					$true_offset = $true_offset + $quota;
					echo "<input type=\"hidden\" name=\"offset\" value=\"".$true_offset."\">";
					$numrows = $quota-1;
					$quota = 0;
					
				}
				//echo "search ".$start_c." QUOTA = ".$quota." numrows=".$numrows."<br>";
				$loc_i = 0;
				while ( $row = mysqli_fetch_array($result) ) {
					if ( $_GET['category'] == 'Pengarang' ) {
						$npos = strpos($row['title'], '+');
						///echo 'POS = '.$npos;
						if ( $npos > 0 ) {
							//split '+' character
							unset($ret);
							SplitAuthor($row['title'], $ret);
							//echo "Count Ret = ".count($ret).", Ret = ".$ret."<br>";
							for ( $j = 0; $j < count($ret); $j++ ) {
								echo "<a style=\"margin:2px; text-align:left;\"  class=\"style2\" href=wikiauthor.php?author_name=".str_replace(' ','+',$ret[$j]).">".AdjustString(str_replace('+','&',$ret[$j]))."</a>";
								if ( $j < count($ret)-1 )
									echo "<span style=\"
									font-family:'Verdana';
									font-size:12px;
									\">
									&</span>";
							}
						} else {
							echo "<a style=\"
								margin:2px; width:100%; display:table; text-align:left;
								\"  class=\"style2\" href=wikiauthor.php?author_name=".str_replace(' ','+',$row['code']).">".AdjustString(str_replace('+','&',$row['title']))."</a>";
						}
					} else
						echo "<a style=\"
							margin:2px; width:100%; display:table; text-align:left;
							\"  class=\"style2\" href=wikibook.php?bookcode=".$row['code'].">".AdjustString($row['title'])."</a>";
					
					//echo $quota."<br>";
					if ( $i%30 == 0  ) {
						$div_number++;
				//		echo "div number = ".$div_number;
						if ( $div_number == 3 ) 
							break;
						echo "</div>";
						echo "<div style=\"padding:10px;border:0px solid red;display:block;float:left;width:260px;\">";
						echo "<p class=\"style1\">- ".$start_c." Contd. -</p>";
					}
					$i++;
					if ( $loc_i >= $numrows )
						break;
					$loc_i++;
					
				}
				if ( $quota == 0 )
					break;
				if ( $start_c == '0-9' ) {
					$true_offset = 0;
					$start_c = 'A';
				} else if ( $start_c == 'Z' ) {
					$true_offset = 0;
					$start_c = '0-9';
					echo "<input type=\"hidden\" name=\"start\" value=\"".$start_c."\">";
					echo "<input type=\"hidden\" name=\"offset\" value=\"".$true_offset."\">";
					//echo "end2</div>";
					break;
				}
				else {
					$true_offset = 0;
					$start_c++;
				}
			}
			?>
			</div>
		</div>
	</form>
			
		</div>
	
		</div>
		<?
			echo $mlayout->writeFooter("../");
		?>

	</div>
	</body>
</html>
