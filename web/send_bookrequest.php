<?
	include 'lib/mysql_comic.php';
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);

	if ( $_GET['type'] == "UPDATE" ) {
		$query = "SELECT * FROM book_request_user WHERE title='".$_GET['content']."' AND subscriber_id='".$_GET['subscriber_id']."'";
		$result = $mysql->query($query);
		if ( mysqli_affected_rows($mysql->con) > 0 ) {
			$query = "SELECT count FROM book_request WHERE title='".$_GET['content']."'";
			$result = $mysql->query($query);
			$row = mysqli_fetch_array($result);
			echo $row['count']." Rekomendasi";
		
			return;
		}
		$query = "UPDATE book_request set count = count + 1 WHERE title='".$_GET['content']."'";
		$result = $mysql->query($query);
		
		$query = "INSERT INTO book_request_user VALUES('".$_GET['content']."','".$_GET['subscriber_id']."')";
		$result = $mysql->query($query);
	
	
		$query = "SELECT count FROM book_request WHERE title='".$_GET['content']."'";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		echo $row['count']." Rekomendasi";
		return;
	}
	
	if ( $_GET['content'] == "" ) {
		echo "
	<span style=\"display:table; width:100%; text-align:center;
	font:normal 14px/22px arial,sans-serif;\">
		Maaf anda belum menginputkan Judul. Terima Kasih
	</span>";
	return;
	}
	$query = "INSERT INTO book_request VALUES('".$_GET['content']."','".$_GET['keterangan']."',1)";
	$result = $mysql->query($query);
	$query = "INSERT INTO book_request_user VALUES('".$_GET['content']."','".$_GET['subscriber_id']."')";
	$result = $mysql->query($query);
	/*echo "BOOK REQUEST";
	echo "<br>".$_GET['subscriber_id'];
	echo "<br>".$_GET['full_name'];
	echo "<br>".$_GET['user_email'];
	echo "<br>".$_GET['content'];
	echo "<br>".$_GET['keterangan'];
	*/
?>
<span style="display:table; width:100%; text-align:center;
	font:normal 14px/22px arial,sans-serif;">
	Terima kasih telah merekomendasikan <?echo $_GET['content'];?>.<br>
	Klik <a href="byrequest.php">disini</a> untuk melihat halaman By Request.
</span>
