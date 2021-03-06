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
	$bookscommon = new BooksCommon;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Browse Novel</title>
		<?
			$description = "Browse Novel, Lihat Novel";
			echo writeMetaInfo($description);
		?>
		<meta property="og:type" content="website"/>
		<meta property="fb:admins" content="1192425363"/>
		<meta property="fb:app_id" content="159457617553432"/>
		<meta property="og:title" content="<? echo $description;?>"/>
		<meta property="og:site_name" content="www.airabooks.com"/>
		<meta property="og:description" content="<? echo $description; ?>"/> 
		

		<?php
			echo $mlayout->writeHeadParameter();
		?>
	</head>
	<body>
		<?
			$header = $mlayout->writeHeader();
		?>
		
		<?
			$menu = $mlayout->writeMenu('Browse Novel', "", "");
		
		$mcontent = "
		<div class=\"mcontent\" id=\"mcontent\">
			".printAds(0)."

			<div class=\"boxlong_detail\" >
			<p class=\"left\">Koleksi Novel</p>";
				$local_search = $_GET['local_search'];
				$cur_offset = $_GET['offset'];
				$cur_offset = ($cur_offset=="")?0:$cur_offset;
				$content = $bookscommon->writeBooksNovelGroup($cur_offset, 20, $local_search);
				$numrows = $bookscommon->getBooksNovelNumRows($local_search);	
			?>
			<?
				$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
				$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
				$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
				$action_handler = "browsenovel.php";
			?>
			<?
			$nav_var = "
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form  class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form  class=\"form_style\" style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>";
			?>
			<?
			$mcontent = $mcontent . $nav_var;
			
			$mcontent = $mcontent . '
			<div style="display:table; margin:0px auto; border:0px solid black;">
				<form  class="form_style" name="local_search" method="get" action="browsenovel.php">
					<input style="border:1px solid black;
						height:20px;
					" type="text" name="local_search" value="'.$local_search.'">
					<input style="
						border:1px solid black;
						height:24px; margin:0px 0 0 -1px;
					" type="submit" value="search">
				</form>
			</div>';
				/*for ( $i = 0; $i < count($content); $i++ ) {
					$mcontent = $mcontent . $content[$i];
					if ( $i > 0 && (($i+1) % 5 == 0 ) && $i != 20-1)
						$mcontent = $mcontent . "<div class=\"hline\"></div>";
				}*/
				$mcontent = $mcontent . printBOXLONGCommon($content);
		$mcontent = $mcontent . "</div>";
			$mcontent = $mcontent . $nav_var; 
		$mcontent = $mcontent . "</div>";
		
			echo printBasicLayout($mlayout, $header, $menu, $mcontent);
		?>
	</body>
</html>
