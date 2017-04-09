<?php

function AdjustParagraph($str) {
	$style = "style=\"text-indent:15px;padding:0px;margin:5px;\"";
	$content = "<p ".$style.">".str_replace("\n","</p>
	<p ".$style.">", $str);
	$content = $content . "</p>";
	return $content;
}

function ConstructSynopsisContrib($c) {
	$master_content = '';
	for ( $i = 0; $i < count($c); $i++ ) {
		$content = '[contrib:'.$c[$i]['fb_id'].','.$c[$i]['index'].']';
		$content = $content . $c[$i]['synopsis'];
		$content = $content . '[/contrib:'.$c[$i]['fb_id'].','.$c[$i]['index'].']';
		$master_content = $master_content . $content;
	}
	return $master_content;
}
function getSynopsisContributor($book_code) {
	$query = "SELECT * FROM synopsis_contributor WHERE book_code='".$book_code."'";
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	//echo "USER ID = ".$row['user_id'];
	return $row['user_id'];
}
function ExtractSynopsisContrib($book_code, $synopsis, $type='') {
	$n_end = 0;
	$counter = 0;
	//echo "LEN SYNOPSIS -> ".strlen($synopsis)."(".$synopsis.")<br>";
	$isfirst = 1;
	while ( True ) {
		$strl = "n_end = ".$n_end."<br>";
		if ( $n_end == strlen($synopsis)-1 ) {
		//	echo "BREAK HERE";
			break;
		}
		$start = strpos($synopsis, "[contrib:", $n_end);
		if ( $start === false && $isfirst === 1 ) {
			$cfb_id = getSynopsisContributor($book_code);
			if ( $cfb_id == '' ) {
				$cfb_id = 'airabooks';
			}
			if ( $synopsis == '' ) {
				return false;
			}
			$syn = Array (
				'fb_id' => $cfb_id,
				'synopsis' => $synopsis,
				'length' => strlen($synopsis),
				'index' => 0,
				'book_code' => $book_code
			);
			$c[] = $syn;
			//print_r($c);
			if ( $type === 'main_synopsis' ) {
				$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
				//$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".comic_rating VALUES('".$_POST['bookcode']."',0,	'".str_replace("'", "\'", ConstructSynopsisContrib($c))."')";
				$query = "SELECT * FROM comic_rating WHERE code='".$book_code."'";
				$result = $mysql->query($query);
				if ( mysqli_num_rows($result) == 0 ) {
					$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".comic_rating VALUES('".$book_code."',0,	'".str_replace("'", "\'", ConstructSynopsisContrib($c))."')";
					$mysql->query($query);	
				} else {	
					$query = "UPDATE ".$GLOBALS['COMIC_DBWEB'].".comic_rating SET synopsis='".str_replace("'", "\'", ConstructSynopsisContrib($c))."' WHERE code='".$book_code."'";
					//echo "QUERY = ".$query;
					$mysql->query($query);
				}
			}
			//echo "<br>".$query;
			break;
		}
		$comma = strpos($synopsis, ",", $start);
		$fb_id = substr($synopsis, $start+9, $comma-$start-9);
		
		$end = strpos($synopsis, "]", $comma);
		$index = substr($synopsis, $comma+1, $end-$comma-1);
		/*$strl = $strl ."[contrib: -> ". $start;
		$strl = $strl . "] -> ".$end;
		$strl = $strl .  "<br>fb_id -> ".$fb_id;
		$strl = $strl . "<br>index = ".$index;
		*///echo $str;	
		//echo "[/contrib:".$fb_id.",".$index."]";
		$n_start = strpos($synopsis, "[/contrib:".$fb_id.",".$index."]",$end+1);
		$n_end = strpos($synopsis, "]", $n_start);
		/*$strl = $strl ."<br>[/contrib: -> ". $n_start;
		$strl = $strl ."] -> ".$n_end;
		$strl = $strl . "<br>";
		*/
		$str = substr($synopsis, $end+1, $n_start-$end-1);
		//echo $str;
		$syn = Array (
			'fb_id' => $fb_id,
			'synopsis' => $str,
			'length' => strlen($str),
			'index' => $index,
			'book_code' => $book_code
		);
		$c[] = $syn;
		//$strl = $strl. "synlen = ".strlen($synopsis)." counter = ".$counter." n_end = ".$n_end."str = ".$str."<br>";
		$isfirst = 0;
		//echo $strl. "<br>";
		//if ( $counter > 1 )
		//	break;
		//$counter++;
		
	}
	return $c;
}

function getSynopsisOnly($book_code = '', $synopsis) {
	if ( $synopsis == '' )
		return '';
	$c = ExtractSynopsisContrib($book_code, $synopsis);
	for ($i = 0; $i < count($c); $i++ ) {
		$content = $content .$c[$i]['synopsis'];
	}
	return $content;
}

function SynopsisContrib($book_code, $synopsis,&$sc, $type='main_synopsis', $ext_info='') {
	//$content = "<span class=\"synopsis\">
	//			".$synopsis."
	//			</span>";
	if ( $synopsis == '' )
		return '';
	$c = ExtractSynopsisContrib($book_code, $synopsis, $type);
	$sc = $c;	
	for ($i = 0; $i < count($c); $i++ ) {
		if ( $_SESSION['fb_id'] === $c[$i]['fb_id'] || $_SESSION['role'] === 'ADMIN')
			$canedit = $c[$i]['length']." karakter | <a href='#' onclick=\"javascript:showScreenCover('../editsynopsis.php?bookcode=".$c[$i]['book_code']."&fb_id=".$c[$i]['fb_id']."&index=".$c[$i]['index']."&type=".$type."&ext_info=".$ext_info."');\">edit</a> ";
		else
			$canedit = $c[$i]['length']." karakter";
		$content = $content . "
		<div style=\"border:0px solid black; margin:0px; padding:0px;\">
			<div id=\"box_".$c[$i]['fb_id']."\" class=\"SynopsisContrib_BOX\">".AdjustParagraph($c[$i]['synopsis'])."
			</div>
			<div id=\"box_user_".$c[$i]['fb_id']."\" class=\"SynopsisContrib_BOX_USER\">
				<img alt='profile picture' src='http://graph.facebook.com/".$c[$i]['fb_id']."/picture' width=\"30\" height=\"30\" style=\"float:left;\">
				
				<span style=\"font:bold 12px/13px Arial, sans-serif;margin:0 0 0 5px;\"><a style=\"margin:0px;padding:0px;\" href='http://facebook.com/".$c[$i]['fb_id']."'>
				".getFBNameFromFBID($c[$i]['fb_id'])."</a></span>
				
				<br><span style=\"font:normal 12px/13px Arial, sans-serif;margin:0 0px 0 5px;\"> ".$canedit." | <a href='#' onclick=\"javascript:showScreenCover('../reportsynopsis.php?bookcode=".$c[$i]['book_code']."&amp;fb_id=".$c[$i]['fb_id']."&amp;index=".$c[$i]['index']."&amp;type=".$type."&amp;ext_info=".$ext_info."');\">Laporkan kesalahan</a></span>
			</div>
		</div>
		";
	}
	return $content;
}
function AdjustString($str) {
	$content = "";
	for ( $i = 0; $i < strlen($str); $i++ ) {
		if ( $i == 0 )
			$content = strtoupper($str[$i]);
		else if ( $str[$i-1] === ' ' || $str[$i-1] === '.' )
			$content = $content. strtoupper($str[$i]);
		else
			$content = $content.strtolower($str[$i]);
	}
	return $content;
}
function getNewsChannel($refdate) {
	if ( $refdate == '' )
		$query = "SELECT * FROM newschannel ORDER BY date DESC";
	else
		$query = "SELECT * FROM newschannel WHERE date='".$refdate."'";
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	return $result;
}
function getRatingFromComicRating($code) {
	$query = "SELECT recommended as rating FROM comic_rating WHERE code='".$code."'";
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	return ($row['rating']=='')?0:$row['rating'];
}

function getSynopsisFromComicRating($code) {
	$query = "SELECT synopsis FROM comic_rating WHERE code='".$code."'";
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	return $row['synopsis'];
}
function AdminAdditional($row, $synopsis='', $dir='./')
{
	$corontent = "
						<a style=\"font-family:'Arial'; font-size:12px;\" href='".$dir."uploadpic.php?author=".urlencode($row['author_name'])."&bookcode=".$row['code']."&title=".urlencode($row['title'])."'>uploadpic</a>
					";
					$corontent = $corontent."
						<a style=\"font-family:'Arial'; font-size:12px;\" href='".$dir."uploadsynopsis.php?author=".urlencode($row['author_name'])."&bookcode=".urlencode($row['code'])."&title=".urlencode($row['title'])."'>uploadsynopsis</a>
					";
	return $corontent;
}

function CreateFloatingBox($top, $left, $arrow_dir, $top_arrow, $left_arrow, $width, $div_content="default content", $id) {
	$content = "
		<div id=\"".$id."\" style=\"
			position:relative;
			display:block;
			width:0;
			height:0;
			top:0px;
			left:0px;
		\">
			<!-- Main Div -->
			<div style=\"
				padding:0px;
				margin:0px;
				position:absolute;
				top:".$top."px;
				left:".$left."px;
				width:".$width."px;
				z-index:21;
				\">";
	if ( $arrow_dir == "top" ) {
		$content = $content ."
				<!-- Div Arrow -->
				<div style=\"
					position:relative;
					display:table;
					width:100%;
				\">
					<div style=\"
						position:absolute;
						left:".$left_arrow."px;
						top:".$top_arrow."px;
						width:0;
						height:0;
						border-bottom:15px solid #e2e2e2;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
						z-index:5;
					\">
					</div>
					<div style=\"
						position:absolute;
						left:".$left_arrow."px;
						top:".($top_arrow+1)."px;
						width:0;
						height:0;
						border-bottom:15px solid white;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
						z-index:6;
					\">
					</div>
				</div>";
		}
		else if ( $arrow_dir == "left" ) {
			$content = $content . "
				<!-- Div Arrow Left --> 
				<div style=\"
					position:relative;
					float:left;
					display:table;
					width:0px;
					height:0px;
					z-index:6;
				\">
					<div style=\"
						position:absolute;
						left:".$left_arrow."px;
						top:".$top_arrow."px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid #e2e2e2;
						border-top:15px solid transparent;
						z-index:10;
						z-index:6;
					\">
					</div>
					<div style=\"
						position:absolute;
						left:".($left_arrow+1)."px;
						top:".$top_arrow."px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid white;
						border-top:15px solid transparent;
						z-index:7;
					\">
					</div>
				</div>";
		} else if ( $arrow_dir == "right" ) { 
			$content = $content ."	<!-- Div Arrow Right--> 
				<div style=\"
					position:relative;
					float:right;
					display:table;
					width:2px;
					border:1px solid grey;
					height:100px;
				\">
					<div style=\"
						position:absolute;
						left:-10px;
						top:20px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-left:15px solid #e2e2e2;
						border-top:15px solid transparent;
					\">
					</div>
					<div style=\"
						position:absolute;
						left:-10px;
						top:20px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-left:15px solid white;
						border-top:15px solid transparent;
					\">
					</div>
				</div>";
			}

	if ( $arrow_dir == "top" ) {
		$content = $content ."
		<!--
					Table Arrow Top -->
					<table  class='snapshot_table' 
					style=\"
						margin:5px 0 0 0;
					width:".$width."px; 
					border-spacing:0px;\">";
	} else if ( $arrow_dir == "left" ) {
		$content = $content . "<!--
					Table Arrow Left-->
					<table class='snapshot_table'  style=\"
						margin:0 0 0 5px;
						float:left;
						width:".($width)."px; 
						border-spacing:0;\">";
	} else if ( $arrow_dir == "right") {
		$content = $content . "<table class='snapshot_table' style=\"float:right;
				width:99%;
				border-spacing:0;\">";
					
	}

	$content = $content . "<tr>
						<td style=\"height:10px;width:10px;
							background:url(images/bg-blend-top.png) 8px 5px no-repeat;
						\">
						</td>
						<td style=\"
							background:url(images/bg-blend-top.png) 0px 5px repeat-x;
						\">
						</td>
						<td style=\"width:10px;
							background:url(images/bg-blend-top.png) -98px 5px no-repeat;
						\">
						</td>
					</tr>
					<tr>
						<td style=\"width:10px;background:url(images/bg-blend-left.png) 3px 0px repeat-y;\">
						</td>
						<td>
							<div style=\"
								display:table;
								width:100%;
								border:1px solid #e2e2e2;
								padding:0;
								margin:0;
								background:white\">
								".$div_content."	
							</div>
						</td>
						<td style=\"width:10px;background:url(images/bg-blend-right.png) -3px 0px repeat-y;\">
						</td>
					</tr>
					<tr >
						<td style=\"height:10px;width:10px;
							background:url(images/bg-blend-bottom.png) 8px -5px no-repeat;
						\">
						</td>
						<td style=\"
							background:url(images/bg-blend-bottom.png) 0px -5px repeat-x;
						\">
						</td>
						<td style=\"
							background:url(images/bg-blend-bottom.png) -98px -5px no-repeat;
						\">
						</td>
					</tr>
					
				</table>
				
			</div>
		</div>";

		return $content;

}
//$mrand = 0;
function SnapShotPrev($c) {
	static $mrand;
	$mrand++;// = rand() % 100;
	$content = "
	<a href='".$c['img_href']."'><img alt='".$c['Title']."' style=\"z-index:-1;\" 
		onmouseout=\"hideInfo('".$c['Code'].$mrand."')\" 
		onmouseover=\"showInfo('".$c['Code'].$mrand."', 'loader".$c['Code'].$mrand."','".$c['Code']."')\" 
		src=\"".$c['img_src']."\" width=\"".$c['img_width']."\" height=\"".$c['img_height']."\" class=\"".$c['img_class']."\"></a>
					<div id=\"".$c['Code'].$mrand."\" 
						style=\"
							display:none;
							background-color:blue;
							position:absolute;
							text-align:center;\">
						<div
							onmouseover=\"overOnInfo('".$c['Code'].$mrand."');\"  onmouseout=\"outFromInfo('".$c['Code'].$mrand."');\" 
							style=\"
							display:block;
							position:absolute;
							//border:1px solid blue; 
							width:400px;left:-135px;top:-30px;
							background-color:transparent;z-index:1;
							text-align:center;
							padding:0px;\">
							<div 
								id=\"arrow".$c['Code'].$mrand."\"
								onmouseover=\"overOnInfo('".$c['Code'].$mrand."');\"  
								onmouseout=\"outFromInfo('".$c['Code'].$mrand."');\" 
							
							style=\"
									display:block;
									width: 0px; 
									height: 0px; 
									border-left: 20px solid transparent;
									border-right: 20px solid transparent;
									border-bottom: 20px solid #e2e2e2;
									//background-color:white;
									margin:0px 0px 0 180px ;
									z-index=5;
									\">
								</div>
				<table class='snapshot_table' style=\"position:absolute;top:10px;border-spacing:0px;width:100%;\">	
					<tr>
								<td>
								</td>
								<td style=\"height:10px\">
									<div style=\"position:absolute\">
										<div style=\"top:0px;left:10px;position:absolute;border:0px solid blue; 
										background:url(images/bg-blend-top.png);
										//background-color:red;
										height:10px;width:380px; z-index:-2;\"></div>
									</div>
								</td>
								<td>
								</td>
							</tr>
					<tr>
						<td style=\"width:10px;
							background:url(images/bg-blend-left.png) 3px 0px repeat-y ;
							\">
									<!--left blend;-->
									
						</td>
						<td>
							<div id=\"loader".$c['Code'].$mrand."\" 
							onmouseover=\"overOnInfo('".$c['Code'].$mrand."');\"  onmouseout=\"outFromInfo('".$c['Code'].$mrand."');\" 
							style=\"background-color:white;display:table;width:100%;border:1px solid #e2e2e2;text-align:center;\">
								<img alt='loading' src=\"images/ajax-loading.gif\" height=\"150\">
								
							</div>
						</td>
						<td style=\"width:10px;background:url(images/bg-blend-right.png) -3px 0px repeat-y;\">
							<!--right blend;-->
									
						</td>
					</tr>
					<tr style=\"height:10px; \">
								<td>
								</td>
								<td>
									<div style=\"position:absolute\">
										<div style=\"top:-11px;z-index:-5;left:10px;position:absolute;border:0px solid blue; height:10px;width:380px;
										background:url(images/bg-blend-bottom.png) repeat-x;
										\"></div>
									</div>
								</td>
								<td>
								</td>
							</tr>
				</table>
						</div>
					</div>
	";
	return $content;
}
function getGenreURL($genre, $dir, $cat) {
	/*$list_genre = Array (
			'Adventure Fantasy' => 'comic_genre.php?genre=Adventure+Fantasy',
			'Drama' => 'genredrama.php',
			'Romance' => 'genreromance.php',
			'Action' => 'genreaction.php',
			'Comedy' => 'genrecomedy.php',
			'History' => 'genrehistory.php',
			'Detective' => 'genredetektif.php',
			'Mystery' => 'genremystery.php',
			'Sport' => 'genresport.php',
		);*/
	//return $list_genre[$genre];
	if ( $cat == 'A' || $cat == 'B' )
		return $dir."/comic_genre.php?genre=".urlencode($genre);
	else
		return $dir."/novel_genre.php?genre=".urlencode($genre);
}

function getBooksTotal() {
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$query = "SELECT COUNT(*) as count FROM book_title";
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	$max_date = $row['count'];
	return $max_date;
}

function getBooksMaxDate() {
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$query = "SELECT MAX(active_date) as max FROM book_detail";
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	$max_date = $row['max'];
	return $max_date;
}

function checkTitleExists($title, $ret) {
	if ( is_array($ret) == false )
		return false;
	for ( $i = 0; $i < count($ret); $i++ ) {
		if ( $title == $ret[$i]['title'] )
			return true;
	}
	return false;
}
function searchBooksByAuthor($author, &$ret) {
	$author2 = substr($author, strpos($author, ' '), strlen($author));
	$author2 = $author2." ".substr($author, 0, strpos($author, ' '));
	$query = "SELECT code, title, author_name FROM book_title WHERE author_name LIKE ('%".str_replace(' ','%', $author)."%') OR author_name LIKE ('%".str_replace(' ','%', $author2)."%') ORDER BY title";
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$result = $mysql->query($query);
	if ( is_array($ret) == true )
		$i = count($ret);
	else
		$i = 0;
//	echo "COUNT = ".$i;
	while ( $row = mysqli_fetch_array($result) ) {
//		echo "row = ".$row['title'];
		if ( checkTitleExists($row['title'], $ret) == true )
			continue;
		$c = Array (
			'title' => AdjustString($row['title']),
			'author_name' => AdjustString($row['author_name']),
			'href' => $row['code']
		);
		$ret[$i++] = $c;
	}
}
function SplitAuthor($author, &$ret) {
	$plusdel = strpos($author, '+');
//	echo "PLUSDEL = ".$plusdel."<br>";
	if ( $plusdel != '' ) {
		$au = substr($author, 0, $plusdel);
//		echo "Search Here au = ".$au."<br>";
		//$ret = $ret . " " . $au;
		$ret[count($ret)] = $au;
		//searchBooksByAuthor($au, $ret);
		SplitAuthor(substr($author, $plusdel+1, strlen($author)),$ret);
	} else {
//		echo "Search Here au = ".$author."<br>";
		$ret[count($ret)] = $author;
		//$ret = $ret . " " . $author;
		//searchBooksByAuthor($author, $ret);
	}
}
function LinkedBookByAuthor($author, &$ret) {
	//substract author by +
	//echo "author = ".$author;
	$plusdel = strpos($author, '+');
	$plusdel = strpos($author, '&');
	//echo "PLUSDEL = ".$plusdel;
	if ( $plusdel != '' ) {
		$au = substr($author, 0, $plusdel);
		//echo "Search Here au = ".$au."<br>";
		//$ret = $ret . " " . $au;
		searchBooksByAuthor($au, $ret);
		LinkedBookByAuthor(substr($author, $plusdel+1, strlen($author)),$ret);
	} else {
		//$ret = $ret . " " . $author;
		searchBooksByAuthor($author, $ret);
	}
}

function MonthToIndo($month) {
        $BulanIndo = array("Januari", "Februari", "Maret",  
                           "April", "Mei", "Juni",  
                           "Juli", "Agustus", "September",  
                           "Oktober", "November", "Desember");  
        return($BulanIndo[$month]);  
}
function DateToIndo($date){  
        $BulanIndo = array("Januari", "Februari", "Maret",  
                           "April", "Mei", "Juni",  
                           "Juli", "Agustus", "September",  
                           "Oktober", "November", "Desember");  
      
        $tahun = substr($date, 0, 4);  
        $bulan = substr($date, 5, 2);  
        $tgl   = substr($date, 8, 2);  
          
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;       
        return($result);  
}  
function getPopularMax() {
	$query = "SELECT MAX(jumlah) as max FROM temp_table";
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	return $row['max'];
}
function getRecommendedMax() {
	$query = "SELECT MAX(recommended) as max FROM ".$GLOBALS['COMIC_DBWEB'].".comic_rating";
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	return $row['max'];
}

function getPopularRating($bookcode) {
	$query = "SELECT jumlah FROM temp_table WHERE code='".$bookcode."'";
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	return ($row['jumlah']=="")?0:$row['jumlah'];
}

function getBookTitle($bookcode) {
	$query = "SELECT title FROM book_title WHERE code='".$bookcode."'";
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	return AdjustString($row['title']);
}

function getBookAuthor($bookcode) {
	$query = "SELECT author_name FROM book_title WHERE code='".$bookcode."'";
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	return str_replace('+', '&', $row['author_name']);
}
class RandomPopular {
	var $list_genre;
	function __construct() {
		$this->list_genre = Array (
			'Adventure Fantasy',
			'Drama',
			'Romance',
			'Action',
			'Comedy',
			'History',
			'Detective',
			'Mystery',
			'Sport',
		);
	}
	function getPopularRandomByGenre($genre) {
		$query = "SELECT a.category, a.code, a.title, a.author_name, a.status, c.recommended as rating, a.synopsis as synopsis_a, c.synopsis as synopsis_b, b.jumlah FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating c ON c.code=a.code , temp_table b WHERE a.code=b.code AND a.genre='".$genre."' AND b.jumlah > 5 ORDER BY RAND() limit 1";
		//echo "<br>".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		//echo "<br>-----> recommend = ".$row['title'].",".$row['rating'];
		return $row;
	}
	function getPopularRandom() {
		$max_pop = getPopularMax(); 
		$max_rec = getRecommendedMax();
		$recorded = Array( -1,-1,-1,-1 );
		for ( $i = 0; $i < 4; $i++ ) {
			//Check for unrecorded yet
			while ( true ) 
			{
				$getid = rand(0, (count($this->list_genre)-1));
				for ( $j = 0; $j < 4; $j++ ) {
					if ( $recorded[$j] == $getid )
						break;
				}
				if ( $j == 4 )
					break;
			}
			$recorded[$i] = $getid;
		//	print_r($recorded);
		//	echo "<br><br>";
			$row = $this->getPopularRandomByGenre($this->list_genre[$getid]);
			if ( $row['synopsis_a'] == "" && $row['synopsis_b'] == "" ) {
				$recorded[$i] = -1;
				$i = $i - 1;
				continue;
			}
		//	echo "Genre = ".$this->list_genre[$getid];
		//	echo $row['title']."<br>";
			$synopsis = $row['synopsis_b'];
			if ( $synopsis == "" )
				$synopsis = $row['synopsis_a'];

			$content[$i] = Array (
				'img_src' => 'cover_small/'.$row['code'].'.jpg',
				'Code' => $row['code'],
				'href_title' => getGenreURL($this->list_genre[$getid], "./", $row['category']),
				'Title' => 'Genre '.$this->list_genre[$getid],
				'Judul' => $row['title'],
				'Pengarang' => str_replace('+', '&', $row['author_name']),
				'Status' => ($row['status']=='ON GOING')?'Bersambung':'Tamat',
				'Popularitas_Max' => $max_pop,
				'Popularitas_Index' => $row['jumlah'],
				'Recommended_Max' => $max_rec,
				'Recommended_Index' => $row['rating'],
				'Synopsis' => substr(str_replace('\\\\?','?', getSynopsisOnly($row['code'],$synopsis)), 0, 300)."..."
			);
		}
		return $content;
	}
	function getBookSnapshotInfo($code) {
			//$row = $this->getPopularRandomByGenre($this->list_genre[$getid]);
			//if ( $row['synopsis'] == "" ) {
			//	$recorded[$i] = -1;
			//	$i = $i - 1;
			//	continue;
			//}
		//	echo "Genre = ".$this->list_genre[$getid];
		//	echo $row['title']."<br>";
			$max_pop = getPopularMax(); 
		$max_rec = getRecommendedMax();
		$query = "SELECT a.code, a.category, a.title, a.genre, a.author_name, a.synopsis, b.jumlah, a.rating, a.status FROM book_title a LEFT JOIN temp_table b ON a.code=b.code WHERE a.code='".$code."'";
			
			
			$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
			$result = $mysql->query($query);
			$row = mysqli_fetch_array($result);
			
			$synopsis = $row['synopsis'];
			if ( $row['synopsis'] == '' ) {
				$synopsis = getSynopsisFromComicRating($row['code']);
			}

			$img_src = 'cover_small/'.$row['code'].'.jpg';
			if ( file_exists($img_src) == false ) 
				$img_src = 'cover_small/nophoto.png';
			$content[0] = Array (
				'img_src' => $img_src,
				'Code' => urlencode($row['code']),
				'href_title' => getGenreURL($row['genre'], './', $row['category']),
				'Title' => 'Genre '.$row['genre'],
				'Judul' => $row['title'],
				'Pengarang' => str_replace('+', '&', $row['author_name']),
				'Status' => ($row['status']=='ON GOING')?'Bersambung':'Tamat',
				'Popularitas_Max' => $max_pop,
				'Popularitas_Index' => $row['jumlah'],
				'Recommended_Max' => $max_rec,
				'Recommended_Index' => getRatingFromComicRating($row['code']),
				'Synopsis' => substr(str_replace('\\\\?','?', getSynopsisOnly($row['code'], $synopsis)), 0, 100)."..."
			);
		//}
		return $content;
	}
	function getNewTitles($numrow) {
		//$query = "SELECT a.code, a.title, a.author_name, b.jumlah FROM book_title a, temp_table b WHERE a.code=b.code ORDER BY b.jumlah DESC limit ".$numrow;
		$query = "SELECT a.author_name, c.volume, b.recommended as rating, a.code, a.title, d.active_date FROM ".$GLOBALS['COMIC_DB'].".book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code, book c, book_detail d WHERE a.code=c.code AND c.book_id=d.book_id AND (c.volume=1 OR c.volume='NOVEL' OR c.volume='ONESHOT') AND YEAR(d.active_date)>=2012 ORDER BY d.active_date DESC LIMIT ".$numrow; 
		

		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		$content['Title'] = "New Titles";
		$content['href_bigtitle'] = 'newtitles.php';
		
		while ( $row = mysqli_fetch_array($result) ) {
		//	echo "CODE = ".$row['code']."<br>";
			$img_src = 'cover_small/'.$row['code'].'.jpg';
			if ( file_exists($img_src) == false ) {
				$img_src = 'cover_small/nophoto.png';
			}
			$content[$i++] = Array (
				'img_src' => $img_src,
				'Code' => $row['code'],
				'Judul' => $row['title'],
				'Author' => str_replace('+', '&', $row['author_name']),
				'Popularitas' => 'Tanggal Rilis : '.DateToIndo($row['active_date']) 
			);
		}
		return $content;
	}
	function getMostPopular($numrow) {
		$query = "SELECT a.code, a.title, a.author_name, b.jumlah FROM book_title a, temp_table b WHERE a.code=b.code ORDER BY b.jumlah DESC limit ".$numrow;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		$content['Title'] = "Most Popular";
		$content['href_bigtitle'] = 'mostpopular.php';
		
		while ( $row = mysqli_fetch_array($result) ) {
		//	echo "CODE = ".$row['code']."<br>";
			$img_src = 'cover_small/'.$row['code'].'.jpg';
			if ( file_exists($img_src) == false ) {
				$img_src = 'cover_small/nophoto.png';
			}
			$content[$i++] = Array (
				'img_src' => $img_src,
				'Code' => $row['code'],
				'Judul' => $row['title'],
				'Author' => str_replace('+', '&', $row['author_name']),
				'Popularitas' => $row['jumlah']." Pembaca"
			);
		}
		return $content;
	}

	function getMostRecommended($numrow) {
		$query = "SELECT a.code, a.title, a.author_name, b.recommended as rating FROM book_title a, ".$GLOBALS['COMIC_DBWEB'].".comic_rating b WHERE a.code=b.code ORDER BY rating DESC limit ".$numrow;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		$content['Title'] = "Most Recommended";
		$content['href_bigtitle'] = 'mostrecommended.php';
		while ( $row = mysqli_fetch_array($result) ) {
		//	echo "CODE = ".$row['code']."<br>";
			$img_src = 'cover_small/'.$row['code'].'.jpg';
				if ( file_exists($img_src) == false ) {
					$img_src = 'cover_small/nophoto.png';
				}
			$content[$i++] = Array (
				
				'img_src' => $img_src,
				'Code' => $row['code'],
				'Judul' => $row['title'],
				'Author' => str_replace('+', '&', $row['author_name']),
				'Popularitas' => $row['rating']." Rekomendasi"
			);
		}
		return $content;
	}
	function getNewRelease($numrow) {
		$max_date = getBooksMaxDate();
		$query = "SELECT a.code, a.title, a.author_name, d.recommended as rating, b.volume FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating d ON a.code=d.code, book b, book_detail c WHERE a.code=b.code AND b.book_id=c.book_id AND c.active_date='".$max_date."' ORDER BY a.title limit ".$numrow;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		$content['Title'] = "New Release ".DateToIndo($max_date);
		$content['href_bigtitle'] = 'newrelease.php';
		
		while ( $row = mysqli_fetch_array($result) ) {
		//	echo "CODE = ".$row['code']."<br>";
			$img_src = 'cover_small/'.$row['code'].'.jpg';
			if ( file_exists($img_src) == false ) {
				$img_src = 'cover_small/nophoto.png';
			}	
			$content[$i++] = Array (
				'img_src' => $img_src,
				'Code' => $row['code'],
				'Judul' => $row['title']." ".$row['volume'],
				'Author' => str_replace('+', '&', $row['author_name']),
				'Popularitas' => getPopularRating($row['code'])." Pembaca",
				'Popularitas2' => (($row['rating']==NULL)?0:$row['rating'])." Rekomendasi"
			);
		}
		return $content;
	}
	function getBooksOfTheMonth($numrow) {
		$queryview = "CREATE OR REPLACE VIEW PREP_BOFMONTH AS select distinct(b.code), subscriber_id from rent_history a, book b  where a.book_id=b.book_id AND MONTH(a.rent_date)=MONTH(NOW()) AND YEAR(a.rent_date)=YEAR(NOW())";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($queryview);

		$query = "SELECT distinct(a.code),  (SELECT COUNT(*) FROM PREP_BOFMONTH WHERE code=a.code) as jumlah, b.title, b.author_name FROM PREP_BOFMONTH a, book_title b WHERE a.code=b.code ORDER BY jumlah DESC limit ".$numrow;
		$result = $mysql->query($query);
		$i = 0;
		$content['Title'] = "Books Of The Month";
		$content['href_bigtitle'] = 'booksofthemonth.php';
		while ( $row = mysqli_fetch_array($result) ) {
			//echo "CODE = ".$row['code']."<br>";
			$content[$i++] = Array (
				'img_src' => 'cover_small/'.$row['code'].'.jpg',
				'Code' => $row['code'],
				'Judul' => $row['title'],
				'Author' => str_replace('+', '&', $row['author_name']),
				'Popularitas' => $row['jumlah']." Pembaca Bulan Ini"
			);
		}
		return $content;
	}
}

?>
<?php
class BooksWiki {
	function getAuthorByFirstChar($category, $start, $offset, $numrows, $genre="") {
		if ( $start == '0-9' ) {
			$filter = " author_name NOT REGEXP '^[A-z]'";
		} else {
			$filter = " author_name REGEXP '^".$start."'";
		}

		$query = "SELECT author_name as code, author_name as title FROM author WHERE ".$filter;
		$query = $query." ORDER BY author_name LIMIT ".$numrows." OFFSET ".$offset;
		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		//$row = mysqli_fetch_array($result);
		//echo "TEST = ROW = ".$row['title']."<br>";
		return ($result);
	}
	function getBooksByFirstChar($category, $start, $offset, $numrows, $genre="") {
		if ( $start == '0-9' ) {
			$filter = " title NOT REGEXP '^[A-z]'";
		} else {
			$filter = " title REGEXP '^".$start."'";
		}

		if ( $genre != "" ) {
			$filter = $filter." AND genre='".$genre."' ";
		}

		if ( $category == 'Komik' )
			$filter = $filter . " AND (category='A' OR category='B') ";
		else //Novel
			$filter = $filter . " AND NOT (category='A' OR category='B') ";

		$query = "SELECT code, title FROM book_title WHERE ".$filter;
		$query = $query." ORDER BY title LIMIT ".$numrows." OFFSET ".$offset;
		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		//$row = mysqli_fetch_array($result);
		//echo "TEST = ROW = ".$row['title']."<br>";
		return ($result);
	}
	function writeWikiHelp() {
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$query = "SELECT * FROM help_content ORDER BY title";
		$result = $mysql->query($query);
		$content = "<ul>";
		while ( $row = mysqli_fetch_array($result) ) {
			$content = $content . "
			<li>
				<a class=\"wiki_minititle\" >".$row['title']."</a>
			</li>
			<li style=\"list-style:none\">
				<span class=\"wiki_minititle\">".$row['content']."</span>
			</li>
			";
			//print_r($row['img_json']);
			//echo "<br>";
			//var_dump(json_decode($row['img_json']));
			//explode('delimiter', 'string');
			//var_dump(json_decode('{"a":1,"b":2}'));
			//echo "<br>";
			//var_dump(json_decode('{"foo": 12}'));
		}
		$content = $content . "</ul>";
		return $content;
	}
	function writeWiki($code, &$synopsis="", &$subscriber_id_list) {
		$javascript = "
			<script>
					function RefreshBrowser() {
						document.location.reload();
					}
					function UpdateCharacterPosition(bookcode, name, direction) {
						//alert(name+' '+direction);
						var data = new FormData();
						data.append('type','update_position');
						data.append('character_name', name);
						data.append('direction', direction);
						data.append('bookcode', bookcode);
						var xhr = new XMLHttpRequest();
						xhr.onload = onsuccess;
						xhr.open('POST', '../addcharacter.php', true);
						document.getElementById('add_character_content').innerHTML = \"<img alt='loading' src=\\\"../images/ajax-loading.gif\\\">\";
						xhr.send(data);
					}
					///////////////////////////////////
					
					function onprogressHandler(evt) {
							var percent = evt.loaded/evt.total*100;
							console.log('Upload progress: ' + percent + '%');						}
					function onsuccess(evt) {
						console.log('success '+this.responseText);
						//alert('success ' + this.responseText);
						document.getElementById('add_character_content').innerHTML = this.responseText;
						//document.getElementById('content_screen_loader').innerHTML = this.responseText;
					}
					//$('#insert_character_image').submit(function(event) {
					function onsuccess_editcharacter() {
						alert('Data anda telah di update');
						showScreenCover('../addcharacter.php?bookcode='+this.responseText);
						document.location.reload();
					}
					function EditCharacterImageSubmit() {
						//document.getElementById('editcharacter')
						$('#editcharacter').hide();
						var yform = document.getElementById('edit_character');
						console.log(yform);
						//return;
						showScreenCover('');
						console.log('submit here');
						var dataku = new FormData(yform);
						console.log(dataku);	
						var xhr = new XMLHttpRequest();
						xhr.upload.addEventListener('progress', onprogressHandler, false);
						xhr.onload = onsuccess_editcharacter;
						xhr.open('POST', '../editcharacter.php', true);
						xhr.send(dataku);
					};
					function InsertCharacterImageSubmit() {
						console.log('submit here');
						event.preventDefault();
						var mform = document.getElementById('insert_character_image');
						var dataku = new FormData(mform);
						var xhr = new XMLHttpRequest();
						xhr.upload.addEventListener('progress', onprogressHandler, false);
						xhr.onload = onsuccess;
						xhr.open('POST', '../addcharacter.php', true);
						document.getElementById('add_character_content').innerHTML = \"<img alt='loading' src=\\\"../images/ajax-loading.gif\\\">\";
						xhr.send(dataku);
					};
					function EditCharacter(bookcode, char_name) {
						showScreenCover('../editcharacter.php?bookcode='+bookcode+'&character_name='+char_name);
					}
				
				function ShowID(id, id_hide) {
					$('#'+id).show();
					$('#'+id_hide).hide();
				}
				function HideID(id, id_show) {
					$('#'+id).hide();
					$('#'+id_show).show();
				}
				function oneditsynopsis_success() {
					console.log('Success -> '+ this.responseText);
					alert('Sinopsis anda telah diupdate');
					//window.localtion = 'wiki/wikibook.php?bookcode=this.responseText';
					document.location.reload();
				}
				function SubmitAddSynopsis(id) {
					var mform = document.getElementById(id);
					var dataku = new FormData(mform);
					//console.log(dataku);
					var xhr = new XMLHttpRequest();
					xhr.onload = oneditsynopsis_success;
					xhr.open('POST', '../addsynopsis.php', true);
					xhr.send(dataku);
				}
				function SubmitEditSynopsis(submit_type) {
					//alert('here');
					//return;
					var mform = document.getElementById('editsynopsis');
					var dataku = new FormData(mform);
					dataku.append('submit_type',submit_type);
					//console.log(dataku);
					var xhr = new XMLHttpRequest();
					xhr.onload = oneditsynopsis_success;
					xhr.open('POST', '../editsynopsis.php', true);
					xhr.send(dataku);
				}
				function onreportsynopsis_success() {
					//alert(this.responseText);
					alert('Informasi anda telah kami terima.\\nTerima kasih telah membantu kami.');
					closeScreenCover();
				}
				function SubmitReportSynopsis() {
					//alert('here');
					//return;
					var mform = document.getElementById('reportsynopsis');
					var dataku = new FormData(mform);
					//console.log(dataku);
					var xhr = new XMLHttpRequest();
					xhr.onload = onreportsynopsis_success;
					xhr.open('POST', '../reportsynopsis.php', true);
					xhr.send(dataku);
				}
				function ReportWrong() {
					ShowSynopsisDemography();
					alert('Kami akan memperlihatkan kontributor.\\nSilakan klik \"Laporkan kesalahan\" sesuai dengan kontributor yang menulis informasi tersebut.');
				}
			</script>
		";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		
		/**** Get Detail Content *****/
		$query = "SELECT a.category, a.code, a.title, b.volume, b.copy, c.active_date as active_date, DATE_FORMAT(c.active_date, '%Y') as check_date, c.status FROM book_title a, book b, book_detail c WHERE a.code=b.code AND b.book_id=c.book_id AND a.code='".$code."' ORDER BY '0000000'+rtrim(b.volume), b.copy";
		$result = $mysql->query($query);
		//echo "QUERY = ".$query;
		$table_comic = "<table class=\"collection\" style='border:1px;border-color:#e2e2e2;'>
				<tr class=\"title\">
					<td>No.</td>
					<td>Judul</td>
					<td>Volume</td>
					<td>Kopi</td>
					<td>Tanggal Rilis</td>
					<td>Ketersediaan</td>
				</tr>
				";
				$i = 1;
		while ( $row = mysqli_fetch_array($result) ) {
			if ( $row['check_date'] < 2012 )
				$active_date = "-";
			else 
				$active_date = DateToIndo($row['active_date']);
			
			if ( $row['status'] == "AVAILABLE" )
				$status = "Tersedia";
			else
				$status = "<a href='#'>Dipinjam</a>";
			
			$table_comic = $table_comic . "
				<tr>
					<td>".$i++.".</td>
					<td>".AdjustString($row['title'])."</td>
					<td>".$row['volume']."</td>
					<td>".$row['copy']."</td>
					<td>".$active_date."</td>
					<td>".$status."</td>
				</tr>
			";
		}
		$table_comic = $table_comic."</table>";
		
		$table_comic = "
		<a id=\"ashow\" href=\"
			javascript:ShowCollection('ashow');
			\" class=\"style1\"
		>- Lihat Koleksi -</a>
		<div id=\"Collection\" style=\"border:0px solid red; display:block;\">".$table_comic."</div>";
		/*****************************/
		$query = "SELECT a.code, a.author_name, a.title, a.synopsis as synopsis_a, b.synopsis as synopsis_b, b.recommended, a.rack, a.genre, a.status  FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE a.code='".$code."'";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		
		$pop_max = getPopularMax();
		$pop = getPopularRating($row['code']);
		$rec_max = getRecommendedMax();
		$ret = "";
	    LinkedBookByAuthor($row['author_name'], $ret);	
		//echo "<br>RET = ".$ret;
		//print_r($ret);
		$gogenre = getGenreURL($row['genre'], '../', $row['category']);
		$refbooks = "
		<div style=\"margin:0 0 0 10px; border:0px solid black;\">
					- <a style=\"
						font-family:'Verdana';
						font-size:13px;
					\" href=\"".$gogenre."\">Genre ".$row['genre']."</a>
				</div>
		";
		for ( $i = 0; $i < count($ret); $i++ ) {
			$c = $ret[$i];
			if ( $c['title'] == "" || $c['title'] == $row['title'] ) continue;
			$refbooks = $refbooks."
				<div style=\"margin:0 0 0 10px; border:0px solid black;\">
					- <a style=\"
						font-family:'Verdana';
						font-size:13px;
					\" href='wikibook.php?bookcode=".$c['href']."'>".AdjustString($c['title'])." by ".AdjustString(str_replace('+', '&', $c['author_name']))."</a>
				</div>
			";
		}
		$synopsis = ($row['synopsis_b'] == "")?"Sinopsis Belum Tersedia":str_replace('\\\\?','',$row['synopsis_b']);	
		if ( $row['synopsis_b'] == "" ) {
			$synopsis = ($row['synopsis_a'] == "")?"Sinopsis Belum Tersedia":str_replace('\\\\?','',$row['synopsis_a']);	
		}
		$status = ($row['status'] == 'ON GOING')?'Bersambung':'Tamat';	
		$img_src = "../cover_small/".$row['code'].".jpg";
		
		if ( file_exists($img_src) == false ) 
			$img_src = "../cover_small/nophoto.png";
	
		$str_admin = '';
		if ( $_SESSION['role'] == 'ADMIN' ) {
			$str_admin = AdminAdditional($row, $synopsis, '../');
		}
		$like_rating = 0;
		if ( $rec_max > 0 )
			$like_rating = round(($row['recommended']/$rec_max)*85);
		
		//echo $synopsis;	
		if ( $synopsis === 'Sinopsis Belum Tersedia' )
			$synopsis_contrib = "<p style=\"font:normal 13px/18px Arial, sans-serif;\">".$synopsis."</p>";
		else
			$synopsis_contrib = SynopsisContrib($row['code'], $synopsis, $sc);
		
		$content = $javascript. "
			<p class=\"wiki-title\" style=\"font-weight:bold;\">".AdjustString($row['title'])."
			<button id=\"demografi_button_1\" style=\"float:right; 
			font:normal 10px/10px arial,sans-serif; margin:0px;\" onclick=\"javascript:ShowSynopsisDemography();\">Lihat Demografi Kontributor</button>
			</p>
			<div class=\"synopsis\">
			<div class=\"logo_n_info_parent\">	
				<div class=\"logo_n_info\">
					<p class=\"title\">".AdjustString($row['title'])."</p>
					<img alt='' src=\"".$img_src."\" width=\"100\">
					<p class=\"title\">Informasi</p>
					<table>
					<tr>
						<td class=\"parameter\">
							Pengarang
						</td>
						<td>
							".AdjustString(str_replace('+','&', $row['author_name']))."
						</td>
					</tr>
					<tr>
						<td class=\"parameter\">
							Genre
						</td>
						<td>
							".$row['genre']."
						</td>
					</tr><tr>
						<td class=\"parameter\">
							ID Rak
						</td>
						<td>
							".$row['rack']."
						</td>
					</tr><tr>
						<td class=\"parameter\">
							Status
						</td>
						<td>
							".$status."
						</td>
					</tr>
				<tr>
						<td class=\"parameter\">
						Popularitas
						</td>
						<td>
							<div id=\"star\">
								<ul id=\"star0\" class=\"star\">
  									<li class=\"curr\" title=\"none\" style=\"width: ".round(($pop/$pop_max)*85)."px;\"></li>
 								</ul>
							</div>
							<div style=\"display:table;width:100%;\">
								".$pop." Pembaca
							</div>
						</td>
					</tr>
					<tr>
						<td class=\"parameter\">
							Rekomendasi
						</td>
						<td>
							<div class=\"likerating\">
 								<ul class=\"star\">
  									<li  class=\"curr\" title=\"9\" style=\"width: ".$like_rating."px;\"></li>
 								</ul>
							</div>
							<div style=\"display:table;width:100%;\">
								".(($row['recommended']==0)?0:$row['recommended'])." rekomendasi
							</div>
						</td>
					</tr>
					</table>
					<div style=\"display:table; position:relative; border:0px solid black; width:280px;\">
					".writeLikeButtonComplete("http://airabooks.com/wiki/wikibook.php?bookcode=".urlencode($row['code']),"")."
					</div>
					<div style=\"margin:2px;\">
					".writeShareButton()."
					</div>
					"
					.$str_admin."
				</div>
				<div class=\"logo_n_info\" style=\"border-color:transparent;background-color:white;text-align:center;display:table;\">
					".printAds(4)."
				</div>
			</div>".$synopsis_contrib."
				<p><a href='#' onclick=\"javascript:showScreenCover('../addsynopsis.php?bookcode=".$row['code']."&amp;type=main_synopsis');\" style=\"font:normal 12px/12px arial,sans-serif\">[ sunting sinopsis ]</a></p>
				".
				"
				<p><a id=\"wrong_a_main_synopsis\" href='javascript:void(0)' onclick=\"javascript:ReportWrong();\" style=\"font:normal 12px/12px arial,sans-serif\">[ laporkan kesalahan sinopsis ]</a></p>
				
				";
					
		//if ( $_SESSION['role'] === 'ADMIN' ) 
		{ 
			//$content = $content . "<div style=\" position:relative ;border:1px solid red; display:table;\">";
			$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
			$query = "SELECT * FROM synopsis_character WHERE book_code='".$row['code']."' ORDER BY synopsis_character.order";
			$result_syn = $mysql->query($query);
			if ( mysqli_num_rows($result_syn) != 0 ) {
			
			$content = $content . "<p class=\"wiki-title\">Profil Tokoh";
			$content = $content . " <a href='#' onclick=\"javascript:showScreenCover('../addcharacter.php?bookcode=".$row['code']."');\" style=\"font:normal 12px/12px arial,sans-serif\">[ edit / tambah tokoh ]</a></p>";
			

			while ( $row_syn = mysqli_fetch_array($result_syn) ) {
				$synopsis_contrib = SynopsisContrib($row['code'], $row_syn['character_synopsis'], $sc_char, 'char_synopsis', $row_syn['character_name']);
				$char_sc[] = $sc_char;
				$content = $content . "
				<div style=\"display:block;
				//border-bottom:1px solid #bababa; 
				//border:0px solid black;
				//width:100%;
				padding:0 0 5px 0;\">
				<p 
				 	style=\"
						border:0px solid blue;
						margin:0px 0 5px 0; 
						font:bold 15px/15px arial, sans-serif;\">".$row_syn['character_name']."</p>
					<img alt='' src='../character_pic/".$row_syn['book_code']."_".$row_syn['character_name'].".jpg' width=\"75\" height=\"75\" 
						style=\"border-radius:75px;border:0px solid black; 
							display:block; margin:3px 5px 5px 0;float:left;
							\">
					<span style=\"border:0px solid yellow;
					font:normal 13px/18px arial,sans-serif;
					width:100%;
					\">
					".$synopsis_contrib."</span>
					<a href='#' style=\"font:normal 11px/15px Arial, sans-serif;\"
					onclick=\"javascript:showScreenCover('../addsynopsis.php?bookcode=".$row['code']."&amp;type=char_synopsis&ext_info=".urlencode($row_syn['character_name'])."');\"
					>[ tambah informasi profil ".$row_syn['character_name']." ]</a>
				</div>
				<div style=\"display:table; margin:0px;clear:left; border:0px solid blue; width:500px;\"></div>
				<div style=\"display:block; width:100%; border-bottom:1px solid #bababa; margin:10px 0 10px 0;\"></div>
			";
				if ( $i % 4 == 3 ) {
					//$content = $content . "</div>";
				//	$content = $content . "<div style=\"border:1px solid green; display:table; width:900px;\">test</div>";
				}
			}
			}
			$content = $content . "<p><a href='#' onclick=\"javascript:showScreenCover('../addcharacter.php?bookcode=".$row['code']."');\" style=\"font:normal 12px/12px arial,sans-serif\">[ edit / tambah tokoh ]</a></p>
			
			<p><a href='javascript:void(0)' id=\"wrong_a_char_synopsis\" onclick=\"javascript:ReportWrong();\" style=\"font:normal 12px/12px arial,sans-serif\">[ laporkan kesalahan profil ]</a></p>
				

			";
				
			$content1 = $content . "<p class=\"wiki-title\">Daftar Episode</p>";
			$content1 = $content . "
			<table style=\"background-color:grey; border:0px solid #e2e2e2;font:normal 13px/18px Arial, sans-serif;text-align:justify;border-spacing:1px;width:100%;'>
				<tr style=\"background-color:#e1e1e1;margin:5px;border:1px solid red;text-align:center; font-weight:bold;\">
					<td >
						Episode
					</td>
					<td>
						Informasi
					</td>
				</tr>
				<tr>
					<td style=\"text-align:center; background-color:#f5f5f5;\">
						DELUXE 2
					</td>
					<td style=\"background-color:#fdfdfd;\">
						Judul : Sakuragi-kun<br>
						Bagian : <br>
							<table style=\"width:100%;font:normal 13px/18px Arial, sans-serif; \">	
								<tr>
									<td>
										001. Sakuragi Kun
									</td>
									<td>
										002. Kaede Rukawa
									</td>
								</tr>
								<tr>
									<td>
										003. \"Blood\"
									</td>
									<td>
										004. \"The Gorilla\" (ゴリラジジイ \"Gorirajijii\"?)

									</td>
								</tr>
								<tr>
									<td>
										005. \"For Love I Will Prevail!!\" (愛は勝つ \"Ai wa Katsu\"?)
									</td>
								</tr>
							</table>
						<img alt='' height=\"100\" src=\"../cover_small/SLD.jpg\" style=\"float:left; margin: 5px 5px 0px 0;\">Teenager Hanamichi Sakuragi is unpopular with girls, and begins hating basketball in middle school, when his latest crush is in love with a basketball player. However, in high school he suddenly falls in love with Haruko Akagi who notes that he could be a remarkable basketball player after teaching him how to slam dunk. While listening to Haruko's explanations, Sakuragi's gang comes to suspect that she might be in love with a basketball player named Kaede Rukawa. Haruko confesses this to Sakuragi, which depresses him once again. A group of third year students challenge Sakuragi and his gang to a fight, but just when they are about to face them Sakuragi finds them defeated singlehandedly by Rukawa. Haruko sees a wounded Rukawa next to Sakuragi and blames the latter for Rukawa's injuries. Once again depressed, Sakuragi gets into a fight with the Shohoku basketball team captain, Takenori Akagi, who challenges him to a basketball game, in which Sakuragi has to make one basket before Akagi makes ten. With Sakuragi down nine to zero, he notices Haruko has come to watch along with the rest of the school, and is able to score with an improvised slam dunk. Afterwards, Sakuragi learns that Akagi is Haruko's older brother and decides to join the basketball team to get closer to Haruko and surpass Rukawa. Sakuragi's persistence earns him a spot on the team, but he is forced to learn the basics as he has no prior playing experience. After a week of this, Sakuragi confronts Akagi in frustration, but Akagi is adamant that he continue his instruction. Unable to accept this, Sakuragi decides to quit the team.
					</td>
				</tr>
				<tr>
					<td style=\"text-align:center; background-color:#f5f5f5;\">
						DELUXE 2
					</td>
					<td style=\"background-color:#fdfdfd;\">
						Judul : Sakuragi-kun<br>
						Bagian : <br>
							<table style=\"width:100%;font:normal 13px/18px Arial, sans-serif; \">	
								<tr>
									<td>
										001. Sakuragi Kun
									</td>
									<td>
										002. Kaede Rukawa
									</td>
								</tr>
								<tr>
									<td>
										003. \"Blood\"
									</td>
									<td>
										004. \"The Gorilla\" (ゴリラジジイ \"Gorirajijii\"?)

									</td>
								</tr>
								<tr>
									<td>
										005. \"For Love I Will Prevail!!\" (愛は勝つ \"Ai wa Katsu\"?)
									</td>
								</tr>
							</table>
						<img alt='' height=\"100\" src=\"../cover_small/SLD.jpg\" style=\"float:left; margin: 5px 5px 0px 0;\">Teenager Hanamichi Sakuragi is unpopular with girls, and begins hating basketball in middle school, when his latest crush is in love with a basketball player. However, in high school he suddenly falls in love with Haruko Akagi who notes that he could be a remarkable basketball player after teaching him how to slam dunk. While listening to Haruko's explanations, Sakuragi's gang comes to suspect that she might be in love with a basketball player named Kaede Rukawa. Haruko confesses this to Sakuragi, which depresses him once again. A group of third year students challenge Sakuragi and his gang to a fight, but just when they are about to face them Sakuragi finds them defeated singlehandedly by Rukawa. Haruko sees a wounded Rukawa next to Sakuragi and blames the latter for Rukawa's injuries. Once again depressed, Sakuragi gets into a fight with the Shohoku basketball team captain, Takenori Akagi, who challenges him to a basketball game, in which Sakuragi has to make one basket before Akagi makes ten. With Sakuragi down nine to zero, he notices Haruko has come to watch along with the rest of the school, and is able to score with an improvised slam dunk. Afterwards, Sakuragi learns that Akagi is Haruko's older brother and decides to join the basketball team to get closer to Haruko and surpass Rukawa. Sakuragi's persistence earns him a spot on the team, but he is forced to learn the basics as he has no prior playing experience. After a week of this, Sakuragi confronts Akagi in frustration, but Akagi is adamant that he continue his instruction. Unable to accept this, Sakuragi decides to quit the team.
					</td>
				</tr>
			</table>
			";
			$content1 = $content . "<p><a href='javascript:void(0)' style=\"font:normal 12px/12px arial,sans-serif\">[ tambah informasi episode ]</a></p>";
				
			$content1 = $content . "<p class=\"wiki-title\">Video</p>";
			
			//$content = $content . "<div style=\"border:0px solid green; display:table; width:800px;\"></div>";
		}			
				/*if ( file_exists('../cover_big/'.$row['code'].'.jpg') == true ) {
					$content = $content."<p class=\"wiki-title\">Picture</p>
						<img src=../cover_big/".$row['code'].".jpg width=\"300px\">";
				}*/
				$content1 = $content . "<!--<div style=\"margin:0 0 20px 0;display:table; width:100%\">-->
					<p class=\"wiki-title\">Rekomendasikan ".AdjustString($row['title'])."</p>
						<span class=\"synopsis\" style=\"display:block; margin:0 0 5px 0;\">Anda suka dengan buku ini ?. Klik recommend dong... <img alt='smile' src=\"../images/smile-icon.png\" width=\"20\"></span>
						".writeLikeButtonComplete("http://airabooks.com/wiki/wikibook.php?bookcode=".urlencode($row['code']),"")."
					<!--</div>-->
				";
				$content1 = $content . writeShareButton();
				/////////////////////
				$query2 = "SELECT * FROM ".$GLOBALS['COMIC_DB'].".rent_history a, ".$GLOBALS['COMIC_DBWEB'].".user_activation b WHERE book_id LIKE '".$row['code']."-1%' AND b.subscriber_id=a.subscriber_id GROUP BY a.subscriber_id";
				//echo "QUERY = ".$query2;
				$mysql2 = new MySQLComic($GLOBALS['COMIC_DB']);
				$result2 = $mysql->query($query2);
				$content1 = $content."
					<p class=\"wiki-title\">Pembaca</p>
				";
				while ( $row2 = mysqli_fetch_array($result2) ) {
					//$content = $content."<br>".$row2['fb_id'];
					$subscriber_id_list[] = $row2['fb_id'];
					$content1 = $content."<a href='http://facebook.com/".$row2['fb_id']."'><img alt='profile_picture' id=\"img_".$row2['fb_id']."\" src=http://graph.facebook.com/".$row2['fb_id']."/picture width=\"30\" height=\"30\"
						style=\"border:1px solid #e2e2e2; margin:1px;\"></a>";
				}
		//if ( $_SESSION['role'] == 'ADMIN' ) 
		{		
				$content = $content . "
					<p class=\"wiki-title\">Kontributor</p>
				";
				/*$query = "SELECT * FROM synopsis_contributor WHERE book_code = '".$row['code']."'";
				$mysql2 = new MySQLComic($GLOBALS['COMIC_DBWEB']);
				$result2 = $mysql2->query($query);
				while ( $row2 = mysqli_fetch_array($result2) ) {
					$content = $content."<a href=http://facebook.com/".$row2['user_id']."><img id=\"img_".$row2['user_id']."\" src=http://graph.facebook.com/".$row2['user_id']."/picture width=\"30px\" height=\"30px\"
						style=\"border:1px solid #e2e2e2; margin:1px;\"></a>";
				
				}*/
			//$content = $content . " count_synopsis = ".count($sc);
			//$content = $content . " count_character = ".count($char_sc);
			//Populate contributor
			$length_char = 0;
			for ( $i = 0; $i < count($sc); $i++ ) {
				$contributor[$sc[$i]['fb_id']] += $sc[$i]['length'];
				$length += $sc[$i]['length'];
			}
			for ( $i = 0; $i < count($char_sc); $i++ ) {
				for ( $j = 0; $j < count($char_sc[$i]); $j++ ) {
					$contributor[$char_sc[$i][$j]['fb_id']] += $char_sc[$i][$j]['length'];
					$length += $char_sc[$i][$j]['length'];
				}
			}

			if ( count($contributor) > 0 ) 
				$contrib_value = (array_keys($contributor));
			for ( $i = 0; $i < count($contrib_value)-1; $i++ ) {
				for ( $j = $i+1; $j < count($contrib_value); $j++ ) {
					if ( $contributor[$contrib_value[$i]] < $contributor[$contrib_value[$j]]) {
						$temp = $contrib_value[$i];
						$contrib_value[$i] = $contrib_value[$j];
						$contrib_value[$j] = $temp;
					}
				}
			}

			for ( $i = 0; $i < count($contrib_value); $i++ ) {
				$content = $content . "
				<div style=\"float:left; display:table; border:1px solid #e2e2e2;margin:2px;\">	
					<a href='http://facebook.com/".$contrib_value[$i]."'><img id=\"img_".$contrib_value[$i]."\" src='http://graph.facebook.com/".$contrib_value[$i]."/picture' width=\"30\" height=\"30\" alt=''
						style=\"border:1px solid #e2e2e2; margin:1px; float:left;\"></a>
					<span style=\"font:normal 12px/13px arial, sans-serif;\">".$contributor[$contrib_value[$i]]." karakter</span>
					<br><span style=\"font:normal 12px/13px arial, sans-serif; font-weight:bold;color:red;\">".(round((($contributor[$contrib_value[$i]]/$length)*100)))."%</span>
				</div>
				";
			}
			
			$content = $content . "
			<div style=\"clear:left; width:100%; display:table;text-align:center;\">
				<button id=\"demografi_button_2\" onclick=\"javascript:ShowSynopsisDemography();\">Lihat Demografi Kontributor</button>
				<script>
					function ShowSynopsisDemography() {
						//alert(el.innerHTML);
						el = document.getElementById('demografi_button_1');
						if ( el.innerHTML == 'Lihat Demografi Kontributor' ) {
							el.innerHTML = 'Sembunyikan Demografi Kontributor' ;
							$('#wrong_a_main_synopsis').hide();
							$('#wrong_a_char_synopsis').hide();
							document.getElementById('demografi_button_1').innerHTML = 'Sembunyikan Demografi Kontributor';
							document.getElementById('demografi_button_2').innerHTML = 'Sembunyikan Demografi Kontributor';
							//////SynopsisContrib_BOX CSS
							//alert(document.styleSheets);
							console.log(document.styleSheets);
							var cssRuleCode = document.all ? 'rules' : 'cssRules'; //account for IE and FF
							//console.log(cssRuleCode);
							var styleIndex = 0;
							var ruleIndex = 1;
							var rule = document.styleSheets[styleIndex][cssRuleCode][ruleIndex];
							//console.log('rule = '+rule);
							var selector = rule.selectorText;  //maybe '#tId'
							//console.log('selector = '+selector);
							var value = rule.style;//value;            //both selectorText and value are settable.
							//console.log('value = '+value);
							rule.style.cssText = 'margin:5px 0 0 0;border:2px solid blue; font:normal 13px/18px Arial, sans-serif; background-color:#fafafa;';
							//console.log(rule.cssText);
							
							styleIndex = 0;
							ruleIndex = 2;
							rule = document.styleSheets[styleIndex][cssRuleCode][ruleIndex];
							rule.style.cssText = 'display:table;margin:0px; border:2px solid blue; border-top:0px; height:30px;width:300px;';
							";
						/*for ( $i = 0; $i < count($contrib_value); $i++ ) {
							$content = $content . "
								document.getElementById('box_".$contrib_value[$i]."').setAttribute('style','margin:0px;border:2px solid red;font:normal 13px/18px arial, sans-serif;');
								document.getElementById('box_user_".$contrib_value[$i]."').setAttribute('style', 'display:table;margin:0px; border:2px solid red; border-top:0px;');
							";
						}*/
								
			$content = $content . "
						} else {
							//el.innerHTML = 'Lihat Demografi Kontributor';
							$('#wrong_a_main_synopsis').show();
							$('#wrong_a_char_synopsis').show();
							
							document.getElementById('demografi_button_1').innerHTML = 'Lihat Demografi Kontributor';
							document.getElementById('demografi_button_2').innerHTML = 'Lihat Demografi Kontributor';
							
							var cssRuleCode = document.all ? 'rules' : 'cssRules'; //account for IE and FF
							//console.log(cssRuleCode);
							var styleIndex = 0;
							var ruleIndex = 1;
							var rule = document.styleSheets[styleIndex][cssRuleCode][ruleIndex];
							//console.log('rule = '+rule);
							var selector = rule.selectorText;  //maybe '#tId'
							//console.log('selector = '+selector);
							var value = rule.style;//value;            //both selectorText and value are settable.
							//console.log('value = '+value);
							rule.style.cssText = 'margin:0px;border:0px solid blue; font:normal 13px/18px Arial, sans-serif;';
							//console.log(rule.cssText);
							
							styleIndex = 0;
							ruleIndex = 2;
							rule = document.styleSheets[styleIndex][cssRuleCode][ruleIndex];
							rule.style.cssText = 'display:none;margin:0px; border:0px solid blue; border-top:0px';
							
						}
					}
				</script>
			</div>";
		
		}

				$content = $content."<div style=\"border:0px solid black; width:100%; display:table; margin:5px 0 0 0;\">
					<p class=\"wiki-title\">Koleksi ".AdjustString($row['title'])." di airabooks</p>
					".$table_comic."
				</div>
				<p class=\"wiki-title\">Tautan Terkait</p>
				".$refbooks;
				$content1 = $content . "<div style=\"
					margin:20px 0px 5px 0; padding:0px;
					display:table;width:100%;text-align:center;\">
					<p class=\"wiki-title\" style=\"text-align:left;\">Komentar</p>
					".writeCommentFB("http://airabooks.com/wiki/wikibook.php?bookcode=".urlencode($row['code']))."
				</div>";
			$content = $content . "
			</div>
		";
		$synopsis = getSynopsisOnly('', $synopsis);
		return $content;
	}

	function writeWikiAuthor($author_name) {
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		
		/*****************************/
		//$query = "SELECT * FROM book_title WHERE code='".$code."'";
		//$result = $mysql->query($query);
		//$row = mysqli_fetch_array($result);
		
		//$pop_max = getPopularMax();
		//$pop = getPopularRating($row['code']);
		//$rec_max = getRecommendedMax();
		$ret = "";
	    LinkedBookByAuthor($author_name, $ret);	
		//echo "<br>RET = ".$ret;
		//print_r($ret);
		$refbooks = "";
		for ( $i = 0; $i < count($ret); $i++ ) {
			$c = $ret[$i];
			if ( $c['title'] == "" /*|| $c['title'] == $row['title']*/ ) continue;
			$refbooks = $refbooks."
				<div style=\"margin:0 0 0 10px; border:0px solid black;\">
					- <a style=\"
						font-family:'Verdana';
						font-size:13px;
					\"href='wikibook.php?bookcode=".urlencode($c['href'])."'>".$c['title']." by ".str_replace('+', '&', $c['author_name'])."</a>
				</div>
			";
		}
		//$synopsis = ($row['synopsis'] == "")?"Sinopsis Belum Tersedia":str_replace('\\\\?','',$row['synopsis']);	
		//$status = ($row['status'] == 'ON GOING')?'Bersambung':'Tamat';	
		$content = "
			<p class=\"wiki-title\">Buku - Buku Karya ".$author_name."</p>
			<span>
			</span>";
				$content = $content."
				<!--<p class=\"wiki-title\">Tautan Terkait</p>-->
				".$refbooks."
				<!--<div style=\"
					margin:10px 0 5px 0; padding:0px;
					display:table;width:100%;text-align:center;\">
					<p style=\"text-align:left;\" class=\"wiki-title\">Komentar</p>
					".writeCommentFB("http://airabooks.com/wiki/wikiauthor.php?author_name=".$author_name)."
				</div>-->";
			//</div>
		//";
		return $content;
	}
}
?>
<?php
class BooksCommon {
	////////////New Titles//////
	function getBooksNewTitlesNumRows($local_search, $genre="", $synopsis="") {
		//$query = "SELECT COUNT(*) as count FROM book_title WHERE (category='A' OR category='B') ";
		$query = "SELECT COUNT(*) as count FROM ".$GLOBALS['COMIC_DB'].".book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code, book c, book_detail d WHERE a.code=c.code AND c.book_id=d.book_id AND (c.volume=1 OR c.volume='NOVEL' OR c.volume='ONESHOT') AND YEAR(d.active_date)>=2012 "; 
		

		if ( $genre != "" ) {
			$query = $query." AND genre='".$genre."' ";
		}

		
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( title LIKE ('%".$local_search."%') OR author_name LIKE ('%".$local_search."%'))";
		}
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function writeBooksNewTitlesGroup($offset, $numrows, $local_search, $genre="", $synopsis="") {
		$query = "SELECT a.author_name, c.volume, b.recommended as rating, a.code, a.title, d.active_date FROM ".$GLOBALS['COMIC_DB'].".book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code, book c, book_detail d WHERE a.code=c.code AND c.book_id=d.book_id AND (c.volume=1 OR c.volume='NOVEL' OR c.volume='ONESHOT') AND YEAR(d.active_date)>=2012 "; 
		
		if ( $genre != "" ) {
			$query = $query." AND a.genre='".$genre."' ";
		}
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( a.title LIKE ('%".$local_search."%') OR a.author_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY d.active_date DESC LIMIT ".$numrows." OFFSET ".$offset;
		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			$cover = "cover_small/".$row['code'].".jpg";
			if ( file_exists($cover) == false )
				$cover = "cover_small/nophoto.png";
			
				$corontent = "<div class=\"box_content\">
				<!--<img class=\"mainpic\" src=\"".$cover."\" width=\"90\" height=\"120\" >-->";
				$c = Array (
				'Code' => $row['code'],
				'img_href' => "wiki/wikibook.php?bookcode=".urlencode($row['code']), 
				'img_src' => $cover,
				'img_width' => '90',
				'img_height' => '120',
				'img_class' => 'mainpic'
			);
			$corontent = $corontent.SnapShotPrev($c);
			
				$corontent = $corontent."<p class=\"title\"><a href='wiki/wikibook.php?bookcode=".urlencode($row['code'])."'>".AdjustString($row['title'])."</a></p>";
				$corontent = $corontent . "<p class=\"author\">by <a href='wiki/wikiauthor.php?author_name=".urlencode($row['author_name'])."'>".AdjustString(str_replace('+', '&', $row['author_name']))."</a></p>";
				$corontent = $corontent . "<p class=\"author\">Tanggal Rilis : ".DateToIndo($row['active_date'])."</p>";
			
				$corontent = $corontent . "<p class=\"author\">".getPopularRating($row['code'])." Pembaca</p>
				<p class=\"author\">".(($row['rating']==NULL)?0:$row['rating'])." Rekomendasi</p>";

				if ( $_SESSION['role'] == 'ADMIN' ) {
					$corontent = $corontent . AdminAdditional($row);	
				}
			$corontent = $corontent . "</div>";
			$content[$i++] = $corontent;	

		}
		return $content;
	}
	////////////////
	
	function getBooksUserHistoryNumRows($subscriber_id, $local_search) {
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$query = "SELECT COUNT(*) as count FROM rent_history a, book b, book_title c WHERE a.book_id=b.book_id AND b.code=c.code AND subscriber_id='".$subscriber_id."'";
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( c.title LIKE ('%".$local_search."%'))";
		}
		
		//$query = $query." ORDER BY a.rent_date DESC, b.volume LIMIT 24";
		$result = $mysql->query($query);
		//$row = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}

	function writeBooksUserHistory($offset, $numrows, $subscriber_id, $local_search) {
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$query = "SELECT b.code, a.book_id, a.rent_date, c.title, b.volume FROM rent_history a, book b, book_title c WHERE a.book_id=b.book_id AND b.code=c.code AND subscriber_id='".$subscriber_id."'";
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( c.title LIKE ('%".$local_search."%'))";
		}
		
		$query = $query." GROUP BY a.rent_date DESC, b.volume DESC LIMIT ".$numrows." OFFSET ".$offset;
	//	echo "QUERY = ".$query;
		$result = $mysql->query($query);
		return $result;
	}
	
	
	function getBooksNumRows($local_search, $genre="", $synopsis="") {
		if ( $synopsis == "UseSynopsis" ) {
			$query = "SELECT COUNT(*) as count FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE ";
			$query = $query." ( a.synopsis!='' OR b.synopsis!='' ) ";
		} else
			$query = "SELECT COUNT(*) as count FROM book_title WHERE (category='A' OR category='B') ";
		
		if ( $genre != "" ) {
			$query = $query." AND genre='".$genre."' ";
		}

		
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( title LIKE ('%".$local_search."%') OR author_name LIKE ('%".$local_search."%'))";
		}
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function writeBooksGroup($offset, $numrows, $local_search, $genre="", $synopsis="") {
		if ( $synopsis == "UseSynopsis" ) {
			$query = "SELECT a.author_name, b.recommended as rating, a.code, a.title FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE ";
			$query = $query." (a.synopsis!='' OR b.synopsis!='' ) ";
		} else
			$query = "SELECT a.author_name, b.recommended as rating, a.code, a.title FROM ".$GLOBALS['COMIC_DB'].".book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE (a.category='A' OR a.category='B')"; 
		
		if ( $genre != "" ) {
			$query = $query." AND a.genre='".$genre."' ";
		}
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( a.title LIKE ('%".$local_search."%') OR a.author_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY a.title LIMIT ".$numrows." OFFSET ".$offset;
		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			$cover = "cover_small/".$row['code'].".jpg";
			if ( file_exists($cover) == false )
				$cover = "cover_small/nophoto.png";
			
				$corontent = "<div class=\"box_content\">
				<!--<img class=\"mainpic\" src=\"".$cover."\" width=\"90px\" height=\"120px\" >-->";
				$c = Array (
				'Code' => $row['code'],
				'img_href' => "wiki/wikibook.php?bookcode=".urlencode($row['code']), 
				'img_src' => $cover,
				'img_width' => '90',
				'img_height' => '120',
				'img_class' => 'mainpic'
			);
			$corontent = $corontent.SnapShotPrev($c);
			
				$corontent = $corontent."<p class=\"title\"><a href='wiki/wikibook.php?bookcode=".urlencode($row['code'])."'>".AdjustString($row['title'])."</a></p>
				<p class=\"author\">by <a href='wiki/wikiauthor.php?author_name=".urlencode($row['author_name'])."'>".AdjustString(str_replace('+', '&', $row['author_name']))."</a></p>
			
				<p class=\"author\">".getPopularRating($row['code'])." Pembaca</p>
				<p class=\"author\">".(($row['rating']==NULL)?0:$row['rating'])." Rekomendasi</p>";

				if ( $_SESSION['role'] == 'ADMIN' ) {
					$corontent = $corontent . AdminAdditional($row);	
				}
			$corontent = $corontent . "</div>";
			$content[$i++] = $corontent;	

		}
		return $content;
	}
	
	function getBooksNovelNumRows($local_search, $genre="") {
		$query = "SELECT COUNT(*) as count FROM book_title WHERE (category!='A' AND category!='B') ";
		if ( $genre != "" ) 
			$query = $query." AND genre='".$genre."' ";
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( title LIKE ('%".$local_search."%') OR author_name LIKE ('%".$local_search."%'))";
		}
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function writeBooksNovelGroup($offset, $numrows, $local_search, $genre="") {
		$query = "SELECT * FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE (a.category!='A' AND a.category!='B')"; 
		if ( $genre != "" ) 
			$query = $query." AND a.genre='".$genre."' ";
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( a.title LIKE ('%".$local_search."%') OR a.author_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY a.title LIMIT ".$numrows." OFFSET ".$offset;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			$cover = "cover_small/".$row['code'].".jpg";
			if ( file_exists($cover) == false )
				$cover = "cover_small/nophoto.png";
			$corontent = "<div class=\"box_content\">
				<!--<img class=\"mainpic\" src=\"".$cover."\" width=\"90px\" height=\"120px\" >-->";
			$c = Array (
				'Code' => $row['code'],
				'img_href' => "wiki/wikibook.php?bookcode=".urlencode($row['code']), 
				'img_src' => $cover,
				'img_width' => '90',
				'img_height' => '120',
				'img_class' => 'mainpic'
			);
			$corontent = $corontent.SnapShotPrev($c);
			
			$corontent = $corontent ."<p class=\"title\"><a href='wiki/wikibook.php?bookcode=".urlencode($row['code'])."'>".AdjustString($row['title'])."</a></p>
				<p class=\"author\">by <a href='wiki/wikiauthor.php?author_name=".urlencode(str_replace('+', '&', $row['author_name']))."'>".AdjustString(str_replace('+', '&', $row['author_name']))."</a></p>
			
				<p class=\"author\">".getPopularRating($row['code'])." Pembaca</p>
				<p class=\"author\">".(($row['recommended']==NULL)?0:$row['recommended'])." Rekomendasi</p>";
				if ( $_SESSION['role'] == 'ADMIN' ) {
					$corontent = $corontent . AdminAdditional($row);	
				
				}

			$corontent = $corontent . "</div>";
			$content[$i++] = $corontent;	

		}
		return $content;
	}

	//Detail Of Books Of The Month
	function getBooksOfTheMonthNumRows($month, $year, $local_search, $genre) {
		/*$query = "SELECT COUNT(*) as count FROM book_title WHERE (category='A' OR category='B') ";
		
		if ( $genre != "" ) {
			$query = $query." AND genre='".$genre."' ";
		}
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( title LIKE ('%".$local_search."%') OR author_name LIKE ('%".$local_search."%'))";
		}*/
		$queryview = "CREATE OR REPLACE VIEW PREP_BOFMONTH AS select distinct(b.code), subscriber_id from rent_history a, book b  where a.book_id=b.book_id AND DATE_FORMAT(a.rent_date, '%m')=".$month." AND DATE_FORMAT(a.rent_date, '%Y')=".$year;
		//MONTH(a.rent_date)=MONTH(NOW()) AND YEAR(a.rent_date)=YEAR(NOW())";
		
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($queryview);

		$query = "SELECT COUNT(distinct(a.code)) as count FROM PREP_BOFMONTH a, book_title b WHERE a.code=b.code ";
		
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( b.title LIKE ('%".$local_search."%') OR b.author_name LIKE ('%".$local_search."%'))";
		}
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function writeBooksOfTheMonthGroup($month, $year, $offset, $numrows, $local_search, $genre) {
		
		/*$query = "SELECT * FROM book_title WHERE (category='A' OR category='B')"; 
		
		if ( $genre != "" ) {
			$query = $query." AND genre='".$genre."' ";
		}
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( title LIKE ('%".$local_search."%') OR author_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY title LIMIT ".$numrows." OFFSET ".$offset;
		//echo "QUERY = ". $query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		*/
		
		$queryview = "CREATE OR REPLACE VIEW PREP_BOFMONTH AS select distinct(b.code), subscriber_id from rent_history a, book b  where a.book_id=b.book_id AND DATE_FORMAT(a.rent_date, '%m')=".$month." AND DATE_FORMAT(a.rent_date, '%Y')=".$year;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($queryview);
		$query = "SELECT distinct(a.code),  (SELECT COUNT(*) FROM PREP_BOFMONTH WHERE code=a.code) as jumlah, b.title, b.author_name, DATE_FORMAT(NOW(), '%M') as thismonth, YEAR(NOW()) as thisyear FROM PREP_BOFMONTH a, book_title b WHERE a.code=b.code ";
		
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( b.title LIKE ('%".$local_search."%') OR b.author_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY jumlah DESC limit ".$numrows." OFFSET ".$offset;
		$result = $mysql->query($query);
		///$i = 0;
		//$content['Title'] = "Books Of The Month";
		//while ( $row = mysqli_fetch_array($result) ) {
		
		
		$i = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			$cover = "cover_small/".$row['code'].".jpg";
			if ( file_exists($cover) == false )
				$cover = "cover_small/nophoto.png";
			$corontent = "<div class=\"box_content\">
				<!--<img class=\"mainpic\" src=\"".$cover."\" width=\"90px\" height=\"120px\" >-->";
			$c = Array (
				'Code' => $row['code'],
				'img_href' => "wiki/wikibook.php?bookcode=".urlencode($row['code']), 
				'img_src' => $cover,
				'img_width' => '90',
				'img_height' => '120',
				'img_class' => 'mainpic'
			);
			$corontent = $corontent.SnapShotPrev($c);
			$corontent = $corontent."	<p class=\"title\"><a href='wiki/wikibook.php?bookcode=".urlencode($row['code'])."'>".AdjustString($row['title'])."</a></p>
				<p class=\"author\">by <a href='wiki/wikiauthor.php?author_name=".urlencode(str_replace('+', '&', $row['author_name']))."'>".AdjustString(str_replace('+', '&', $row['author_name']))."</a></p>
			
				<p class=\"author\">".$row['jumlah']." Pembaca di Bulan ".MonthToIndo($month-1)." ".$year."</p>";
				//$corontent = $corontent . 'role here = '.$_SESSION['role'];
				if ( $_SESSION['role'] == 'ADMIN' ) {
					$corontent = $corontent . AdminAdditional($row);	
				
				}

				$corontent = $corontent."</div>";
			$content[$i++] = $corontent;
		}
		return $content;
	}
	

	///* Most Popular Book***/
	function getBooksMostPopularNumRows($local_search, $genre="") {
		/*
		$query = "SELECT COUNT(*) as count FROM book_title WHERE (category!='A' AND category!='B') ";
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( title LIKE ('%".$local_search."%') OR author_name LIKE ('%".$local_search."%'))";
		}
		*/
		$query = "SELECT COUNT(*) as count FROM temp_table a, book_title b WHERE a.code=b.code ";
		if ( $genre != "" ) {
			$query = $query." AND b.genre='".$genre."' ";
		}
		
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( b.title LIKE ('%".$local_search."%') OR b.author_name LIKE ('%".$local_search."%'))";
		}
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function writeBooksMostPopularGroup($offset, $numrows, $local_search, $genre="") {
		//$query = "SELECT * FROM book_title WHERE (category!='A' AND category!='B')"; 
		$query = "SELECT * FROM temp_table a, book_title b WHERE a.code=b.code ";
		if ( $genre != "" ) {
			$query = $query." AND b.genre='".$genre."' ";
		}
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( b.title LIKE ('%".$local_search."%') OR b.author_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY a.jumlah DESC LIMIT ".$numrows." OFFSET ".$offset;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			$cover = "cover_small/".$row['code'].".jpg";
			if ( file_exists($cover) == false )
				$cover = "cover_small/nophoto.png";
			$corontent = "<div class=\"box_content\">
				<!--<img class=\"mainpic\" src=\"".$cover."\" width=\"90px\" height=\"120px\" >-->";
			$c = Array (
				'Code' => $row['code'],
				'img_href' => "wiki/wikibook.php?bookcode=".urlencode($row['code']), 
				'img_src' => $cover,
				'img_width' => '90',
				'img_height' => '120',
				'img_class' => 'mainpic'
			);
			$corontent = $corontent.SnapShotPrev($c);
				
			$corontent = $corontent.	"<p class=\"title\"><a href='wiki/wikibook.php?bookcode=".urlencode($row['code'])."'>".AdjustString($row['title'])."</a></p>
				<p class=\"author\">by <a href='wiki/wikiauthor.php?author_name=".urlencode(str_replace('+', '&', $row['author_name']))."'>".AdjustString(str_replace('+', '&', $row['author_name']))."</a></p>
			
				<p class=\"author\">".$row['jumlah']." Pembaca</p>
				<p class=\"author\">rank #".$row['ranking']."</p>";
			if ( $_SESSION['role'] == 'ADMIN' ) {
					$corontent = $corontent . AdminAdditional($row);	
				

				}

			$corontent = $corontent . "</div>";
			$content[$i++] = $corontent;	

		}
		return $content;
	}

///* Most Recommended Book***/
	function getBooksMostRecommendedNumRows($local_search) {
	//	$query = "SELECT COUNT(*) as count FROM book_title b WHERE b.rating>0 ";
			$query = "SELECT COUNT(*) as count FROM book_title b, ".$GLOBALS['COMIC_DBWEB'].".comic_rating a WHERE a.code=b.code AND a.recommended>0 ";
		if ( $genre != "" )
			$query = $query." AND b.genre='".$genre."' ";
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( b.title LIKE ('%".$local_search."%') OR b.author_name LIKE ('%".$local_search."%'))";
		}
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function writeBooksMostRecommendedGroup($offset, $numrows, $local_search, $genre="") {
		//$query = "SELECT * FROM book_title WHERE (category!='A' AND category!='B')"; 
		$query = "SELECT b.title, b.author_name, b.code, a.recommended as rating FROM book_title b LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating a ON a.code=b.code WHERE a.recommended>0 ";
		if ( $genre != "" )
			$query = $query." AND b.genre='".$genre."' ";
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( b.title LIKE ('%".$local_search."%') OR b.author_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY a.recommended DESC LIMIT ".$numrows." OFFSET ".$offset;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			$cover = "cover_small/".$row['code'].".jpg";
			if ( file_exists($cover) == false )
				$cover = "cover_small/nophoto.png";
			$corontent = "<div class=\"box_content\">
				<!--<img class=\"mainpic\" src=\"".$cover."\" width=\"90px\" height=\"120px\" >-->";
			$c = Array (
				'Code' => $row['code'],
				'img_href' => "wiki/wikibook.php?bookcode=".urlencode($row['code']), 
				'img_src' => $cover,
				'img_width' => '90',
				'img_height' => '120',
				'img_class' => 'mainpic'
			);
			$corontent = $corontent.SnapShotPrev($c);
			
			$corontent = $corontent . "<p class=\"title\"><a href='wiki/wikibook.php?bookcode=".urlencode($row['code'])."'>".AdjustString($row['title'])."</a></p>
				<p class=\"author\">by <a href='wiki/wikiauthor.php?author_name=".urlencode(str_replace('+', '&', $row['author_name']))."'>".AdjustString(str_replace('+', '&', $row['author_name']))."</a></p>
			
				<!--<p class=\"author\">".$row['jumlah']." Pembaca</p>
				<p class=\"author\">rank #".$row['ranking']."</p>
				-->
				<p class=\"author\">".$row['rating']." Rekomendasi</p>";
				if ( $_SESSION['role'] == 'ADMIN' ) {
					$corontent = $corontent . AdminAdditional($row);	
				

				}

			$corontent = $corontent. "</div>";
			$content[$i++] = $corontent;	

		}
		return $content;
	}

	/***********New Release Num Rows***********/
	function getBooksMaxDate() {
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$query = "SELECT MAX(active_date) as max FROM book_detail";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$max_date = $row['max'];
		return $max_date;
	}
	function getBooksNewReleaseNumRows($max_date, $local_search) {
		$query = "SELECT COUNT(*) as count FROM book_detail a, book c, book_title b WHERE a.book_id=c.book_id AND c.code=b.code AND a.active_date='".$max_date."' ";
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( b.title LIKE ('%".$local_search."%') OR b.author_name LIKE ('%".$local_search."%'))";
		}
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function writeBooksNewReleaseGroup($max_date,$offset, $numrows, $local_search) {
		//$query = "SELECT * FROM book_title WHERE (category!='A' AND category!='B')"; 
		/*$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$query = "SELECT MAX(active_date) as max FROM book_detail";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$max_date = $row['max'];
*/
		$query = "SELECT distinct(b.title), b.author_name, b.code, d.recommended as rating, c.volume FROM book_detail a, book c, book_title b LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating d ON b.code=d.code WHERE a.book_id=c.book_id AND c.code=b.code AND a.active_date='".$max_date."' ";
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( b.title LIKE ('%".$local_search."%') OR b.author_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY b.title";// DESC LIMIT ".$numrows." OFFSET ".$offset;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			$cover = "cover_small/".$row['code'].".jpg";
			if ( file_exists($cover) == false )
				$cover = "cover_small/nophoto.png";
			$corontent = "<div class=\"box_content\">
				<!--<a href=wikibook.php?bookcode=".urlencode($row['code'])."><img class=\"mainpic\" src=\"".$cover."\" width=\"90px\" height=\"120px\" ></a>-->
				";
			$c = Array (
				'Code' => $row['code'],
				'img_href' => "wiki/wikibook.php?bookcode=".urlencode($row['code']), 
				'img_src' => $cover,
				'img_width' => '90',
				'img_height' => '120',
				'img_class' => 'mainpic'
			);
			$corontent = $corontent.SnapShotPrev($c);
			$vol = $row['volume'];
			if ( $row['volume'] == 'NOVEL' )
				$vol = '';
			$corontent = $corontent."<p class=\"title\"><a href='wiki/wikibook.php?bookcode=".urlencode($row['code'])."'>".AdjustString($row['title']." ".$vol)."</a></p>";
			

			$corontent = $corontent.	"<p class=\"author\">by <a href='wiki/wikiauthor.php?author_name=".urlencode(str_replace('+', '&', $row['author_name']))."'>".AdjustString(str_replace('+', '&', $row['author_name']))."</a></p>
			
				<p class=\"author\">".getPopularRating($row['code'])." Pembaca</p>
				<!--<p class=\"author\">rank #".$row['ranking']."</p>
				-->
				<p class=\"author\">".(($row['rating']==NULL)?0:$row['rating'])." Rekomendasi</p>";
				
				if ( $_SESSION['role'] == 'ADMIN' ) {
					$corontent = $corontent . AdminAdditional($row);	
				

				}

		$corontent = $corontent."</div>";
			
			$content[$i++] = $corontent;
		}
		return $content;
	}

	/***********Rent Information****************/
	function getRentInfoNumRows($local_search, $genre="", $today) {
		//$query = "SELECT COUNT(*) as count FROM book_title WHERE (category='A' OR category='B') ";
		
		//if ( $genre != "" ) {
		//	$query = $query." AND genre='".$genre."' ";
		//}
		/*if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( title LIKE ('%".$local_search."%') OR author_name LIKE ('%".$local_search."%'))";
		}*/
		$query = "SELECT COUNT(*) as count FROM book_title a, book b, rent c WHERE a.code=b.code AND b.book_id=c.book_id "; 
		if ( $today != "" ) {
			$query = $query." AND c.rent_date=DATE(NOW()) ";
		}
		
		/*if ( $genre != "" ) {
			$query = $query." AND genre='".$genre."' ";
		}*/
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( a.title LIKE ('%".$local_search."%') OR a.author_name LIKE ('%".$local_search."%'))";
		}
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function writeRentInfoGroup($offset, $numrows, $local_search, $genre="", $today) {
		$query = "SELECT a.code, a.title, a.author_name, c.rent_date, b.volume, (DATEDIFF(NOW(), DATE_ADD(c.rent_date, interval c.rent_duration day))) as late, d.subscriber_id, d.full_name, d.mobile_phone_number, d.home_phone_number, d.identity_index FROM book_title a, book b, rent c, subscriber d WHERE c.subscriber_id=d.subscriber_id AND a.code=b.code AND b.book_id=c.book_id "; 
		if ( $today != "" ) {
			$query = $query." AND c.rent_date=DATE(NOW()) ";
		}
		/*if ( $genre != "" ) {
			$query = $query." AND genre='".$genre."' ";
		}*/
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( a.title LIKE ('%".$local_search."%') OR a.author_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY DATE(c.rent_date) DESC, a.title, b.volume LIMIT ".$numrows." OFFSET ".$offset;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		$content[0] = "";
		while ( $row = mysqli_fetch_array($result) ) {
			$volume = $row['volume'];	
			$cover = "cover_small/".$row['code'].".jpg";
			if ( file_exists($cover) == false )
				$cover = "cover_small/nophoto.png";
			$corontent = "<div class=\"box_content\">
				<!--<img class=\"mainpic\" src=\"".$cover."\" width=\"90px\" height=\"120px\" >-->";
			$c = Array (
				'Code' => $row['code'],
				'img_href' => "wiki/wikibook.php?bookcode=".urlencode($row['code']), 
				'img_src' => $cover,
				'img_width' => '90',
				'img_height' => '120',
				'img_class' => 'mainpic'
			);
			$corontent = $corontent.SnapShotPrev($c);
			$corontent = $corontent ."<p class=\"title\"><a href='wiki/wikibook.php?bookcode=".urlencode($row['code'])."'>".AdjustString($row['title']." ".$volume)."</a></p>
				<p class=\"author\">by <a href='wiki/wikiauthor.php?author_name=".urlencode(str_replace('+', '&', $row['author_name']))."'>".AdjustString(str_replace('+', '&', $row['author_name']))."</a></p>
			
				<p class=\"author\">Tanggal Pinjam: ".DateToIndo($row['rent_date'])."</p>
				<p class=\"author\">Telat: ".(($row['late'] < 0)?0:$row['late'])." Hari</p>";
				
				if ( $_SESSION['role'] == 'ADMIN' ) {
					$corontent = $corontent . "
					<p class=\"author\">".$row['subscriber_id']."<br>".$row['full_name']."<br>".$row['mobile_phone_number']."<br>".$row['home_phone_number']."<br>ID:".$row['identity_index']."</p>
					";
					$corontent = $corontent . AdminAdditional($row);	
				

				}

			$corontent = $corontent ."</div>";
			$content[$i++] = $corontent;	

		}
		return $content;
	}
	

	/*******************************************/
}
?>
