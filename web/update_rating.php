<?php
	include 'lib/mysql_comic.php';

	//$code = str_replace('http://airabooks.com/wiki/wikibook.php?bookcode=', '', $url);
	$code = $_GET['code'];
	$synopsis = $_GET['synopsis'];
	if ( $_GET['type'] == 'SYNOPSIS' ) {
		$query = "UPDATE comic_rating SET synopsis='".$synopsis."' WHERE code='".$code."'";
		
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);

		if ( mysqli_affected_rows($mysql->con) == 0 ) {
			$query = "INSERT INTO comic_rating VALUES('".$code."', 0, '".$synopsis."')";
			$mysql->query($query);
		}	
		return;
	}
echo "UPDATE RATING"; 
$your_url = $_GET['url'];//'http://airabooks.com/bookdetail.php?code=MLD';//'http://www.google.com';
$url = $your_url;
$query = urlencode(sprintf("select total_count,like_count,comment_count,share_count,click_count from link_stat where url='%s'", $your_url));
$request = sprintf("https://api.facebook.com/method/fql.query?query=%s&format=json", $query);
 
$json = file_get_contents($request);
$json = json_decode($json);
 
print_r($json[0]);

$obj = (object) $json[0];
echo "<br>";
echo $obj->like_count;
$like_count = $obj->like_count;
$total_count = $obj->total_count;


	//include 'mysql_comic.php';

	$code = str_replace('http://airabooks.com/wiki/wikibook.php?bookcode=', '', $url);
	echo "URL = ".$url."<br>";
	echo "CODE = ".$code;
	//$query = "delete from comic_rating where code='".$code."'";
	//$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query = "update comic_rating set recommended=".$total_count." where code='".$code."'";
	echo "QUERY = ".$query."<br>";
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);

	if ( mysqli_affected_rows($mysql->con) == 0 ) {
		$query = "INSERT INTO comic_rating VALUES('".$code."', ".$total_count.", '')";
		$mysql->query($query);
	}

	//$query = "insert into comic_rating values('".$code."', ".$like_count.")";
	//$mysql->query($query);

?>
