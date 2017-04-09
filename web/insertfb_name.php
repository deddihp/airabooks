<?
	include 'lib/mysql_comic.php';
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query = "UPDATE user_activation SET fb_name='".$_GET['fb_name']."' WHERE fb_id='".$_GET['fb_id']."'";
	$mysql->query($query);
?>
