<?
	include "mysql_comic.php";
	$query = $_POST['query'];
	$query = str_replace("\\","",$query);
	//echo "QUERY = ".$query."<br>";
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$result=$mysql->query($query);
	if ( mysqli_connect_errno() ) {
		echo "Failed to do MySQL Query: " . mysqli_connect_error();
			
	} else {
		echo var_dump($result);
		$querycmd = "insert into dbactivity(date_act, sqlcmd) values(NOW(), \"".$query." RESULT=".$result."\")";
		$result = $mysql->query($querycmd);
	}
?>
