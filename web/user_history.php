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
	//$rpop = new RandomPopular;
	$bookscommon = new BooksCommon;

?>
<!--<html>
	<head>
		<?php
//			echo $mlayout->writeHeadParameter();
		?>
</head>-->

	
<!--	<body style="background-color:white">-->
	<!--	
		<script>
				function callHTMLForm(url, data_str, id_loader) {
					console.log("call HTML FORM Executed");
					document.getElementById(id_loader).innerHTML = "test here ";
					$.ajax({
						type: "GET",
						url:url,
						data:data_str,
						success: function(responseText) {
							document.getElementById(id_loader).innerHTML = responseText;
							document.getElementById(id_loader).find("script").each(function(i) {
                    			eval($(this).text());
                			});
						}

					});
					return false;
			}
			</script>
		-->
		<?
			$dir = $_GET['dir'];
			$fb_id = $_GET['fb_id'];
			$fb_info = getFBInfoOffline();//($_GET['fb_id']);	
		?>
			<span
				style="
					font-family:'Verdana';
					font-size:13px;
					font-weight:bold;
					margin:10px;
					//border:1px solid black;
					display:block;
				"
				>Riwayat Peminjaman <? echo $fb_info['full_name']." (".$fb_info['subscriber_id'].")";?></span>
			<div class="wiki" style="display:block;">
			<?
				$max_numrows = 18;
				$local_search = $_GET['local_search'];
				$cur_offset = $_GET['offset'];
				$cur_offset = ($cur_offset=="")?0:$cur_offset;
				//$content = $bookscommon->writeBooksGroup($cur_offset, $max_numrows, $local_search);
				$result = $bookscommon->writeBooksUserHistory($cur_offset, $max_numrows, $fb_info['subscriber_id'], $local_search); 
				$numrows = $bookscommon->getBooksUserHistoryNumRows($fb_info['subscriber_id'], $local_search);	
			?>
			
			<?
				$next_var = ($cur_offset+$max_numrows>$numrows)?$cur_offset:$cur_offset+$max_numrows;
				$prev_var = ($cur_offset-$max_numrows<0)?0:($cur_offset-$max_numrows);
				$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+$max_numrows>$numrows)?$numrows:$cur_offset+$max_numrows)." of ".$numrows;
				$action_handler = $dir."user_history.php";
			?>
			<?
				echo writeNavForm($local_search, $prev_var, $next_var, $view_var, "<input type=\"hidden\" name=\"fb_id\" value=\"".$fb_id."\">",
					$fb_id, $dir);
				echo writeLocalSearchForm($local_search,"<input type=\"hidden\" name=\"fb_id\" value=\"".$fb_id."\">", $fb_id, $dir);
			?>
			<?
			/*	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
				$query = "SELECT a.book_id, a.rent_date, c.title, b.volume FROM rent_history a, book b, book_title c WHERE a.book_id=b.book_id AND b.code=c.code AND subscriber_id='".$fb_info['subscriber_id']."' ORDER BY a.rent_date DESC, b.volume LIMIT 24";
				$result = $mysql->query($query);
			*/	$table_comic = "<table class=\"collection\" style=\"font-size:12px;margin:5px 0 0 0;\" border=\"1px\" cellpadding=\"3px\" bordercolor=\"#e2e2e2\">
				<tr class=\"title\">
					<td width=\"180px\">Tanggal Pinjam</td>
					<td>Judul</td>
					<td width=\"140px\">Rekomendasi</td>
				<tr>
				";
				$i = 1;
				while ( $row = mysqli_fetch_array($result) ) {
					$rent_date = DateToIndo($row['rent_date']);
					$return_date = DateToIndo($row['return_date']);
					$late = $row['late'];
					if ( $late < 0 )
						$late = 0;
					$table_comic = $table_comic . "
					<tr>
						<td>".$rent_date."</td>
						<td><a href=http://airabooks.com/wiki/wikibook.php?bookcode=".urlencode($row['code']).">".$row['title']." ".$row['volume']."</a></td>
						<td>".
						writeLikeButtonCommon('http://airabooks.com/wiki/wikibook.php?bookcode='.urlencode($row['code']),'')
						."<span class=\"minihelp\">[<a href=wikihelp.php#Recommend>?</a>]</span></td>
					</tr>
					";
				}
				$table_comic = $table_comic."
					</tr>
				";
				$table_comic = $table_comic."</table>";
					

			echo $table_comic;
			?>

			</div>
		<?
			
			//echo $mlayout->writeBodyHeader();
			//$content = $rpop->getBookSnapshotInfo($_GET['bookcode']);
			//echo $mlayout->writeBOXSnapshotContent($content);
		?>
	<!--
	</body>
</html>-->
