<?
ob_start();
	session_start();
	include 'lib/mysql_comic.php';

	$code = $_POST['bookcode'];
	$title = $_POST['title'];
	$synopsis = $_POST['synopsis'];
	$query = "update comic_rating set synopsis='".$synopsis."' where code='".$code."'";
	echo "QUERY = ".$query;
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	echo "RESULT Update = ".$result;
	echo "<br>";
	print_r($result);
	$query = "INSERT INTO synopsis_contributor VALUES('".$_POST['bookcode']."','".$_POST['user_id']."')";
	echo "<br>QUERY = ".$query;
	$result = $mysql->query($query);
	echo "<br>";
	echo "<a href=wiki/wikibook.php?bookcode=".$code.">CHECK HASIL SYNOPSIS</a><br>";
	header("Location: wiki/wikibook.php?bookcode=".$code);
?>
