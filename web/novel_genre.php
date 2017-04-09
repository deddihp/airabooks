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
		<title><? echo "Novel - ". GenreTrans($_GET['genre']); ?></title>
		
		<?php
			echo $mlayout->writeHeadParameter();
		?>
	</head>
	<body>
		<?
			$header = $mlayout->writeHeader();
		?>
		<?
			$menu = $mlayout->writeMenu('Browse Novel', 'Genre '.GenreTrans($_GET['genre']), "");
		?>
		<?
		$mcontent = "
		<div class=\"mcontent\">
			<div class=\"boxlong_detail\" >
			<p class=\"left\">Koleksi Novel Bergenre ".$_GET['genre']."</p>";
			
				$local_search = $_GET['local_search'];
				$cur_offset = $_GET['offset'];
				$cur_offset = ($cur_offset=="")?0:$cur_offset;
				$content = $bookscommon->writeBooksNovelGroup($cur_offset, 20, $local_search, $_GET['genre']/*"Adventure Fantasy"*/);
				$numrows = $bookscommon->getBooksNovelNumRows($local_search, $_GET['genre']);//"Adventure Fantasy");	
			?>
			<?
				$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
				$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
				$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
				$action_handler = "novel_genre.php";//"genrefantasy.php";
			?>
			<?
			$nav_var = "
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form  class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">
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
					<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">
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
			$mcontent = $mcontent . "
			<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<form  class=\"form_style\" name=\"local_search\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">
					<input style=\"border:1px solid black;
						height:24px;
					\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0px 0 0 -1px;
					\" type=\"submit\" value=\"search\">
				</form>
			</div>";
				/*for ( $i = 0; $i < count($content); $i++ ) {
					$content[$i];
					if ( $i > 0 && (($i+1) % 5 == 0 ) && $i != 20-1)
						echo "<div class=\"hline\"></div>";
				}*/
				$mcontent = $mcontent . printBOXLONGCommon($content);
		$mcontent = $mcontent . "</div>";
		
		
			$mcontent = $mcontent . $nav_var;
			
		$mcontent = $mcontent . "</div>";
			echo printBasicLayout($mlayout, $header, $menu, $mcontent);
		?>
	</body>
</html>
