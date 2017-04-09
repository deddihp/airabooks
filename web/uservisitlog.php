
<?
	include 'lib/mysql_comic.php';
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query = "SELECT * FROM url_visit where (url LIKE '%php%' OR url LIKE 'http://airabooks.com/') AND DATE(date)=DATE(NOW()) ORDER BY date DESC, count DESC LIMIT 50";
	$result = $mysql->query($query);
	
	$query2 = "SELECT SUM(count) as count FROM url_visit where url LIKE '%php%' OR url LIKE 'http://airabooks.com/' ";
	$result2 = $mysql->query($query2);
	$row2 = mysqli_fetch_array($result2);

	$query3 = "SELECT COUNT(*) as count FROM url_visit where url LIKE '%php%' OR url LIKE 'http://airabooks.com/' ";
	$result3 = $mysql->query($query3);
	$row3 = mysqli_fetch_array($result3);

	$query4 = "SELECT SUM(count) as count FROM  url_visit where (url LIKE '%php%' OR url LIKE 'http://airabooks.com/') AND DATE(date)=DATE(NOW())";
	$result4 = $mysql->query($query4);
	$row4 = mysqli_fetch_array($result4);

	$query5 = "SELECT COUNT(*) as count FROM url_visit where  (url LIKE '%php%' OR url LIKE 'http://airabooks.com/') AND DATE(date)=DATE(NOW())";
	$result5 = $mysql->query($query5);
	$row5 = mysqli_fetch_array($result5);
?>
<div style="border:0px solid red;display:table; width:48%;margin:2px;float:left;">
<?
	echo "<br><span style=\"font:normal 13px/13px arial, sans-serif;\">Visited Page Number Total : ".$row3['count'].", 
	<br>Visit Count Total : ".$row2['count']."</span>";
	echo "<br><span style=\"font:normal 13px/13px arial, sans-serif;\">Visited Page Number Today : ".$row5['count'].", 
	<br>Visit Count Total Today : ".$row4['count']."</span>";
	
	echo "<table style=\"
		font:normal 12px/12px arial, sans-serif;
		text-align:left;\" width=\"100%\" margin:20px; border=\"1px\" cellpadding=\"2px\" cellspacing=\"0\">";
	echo "<tr><td>URL</td><td>Count</td><td>Date</td>
	<td>id</td><td>name</td></tr>";
	while ( $row = mysqli_fetch_array($result) ) {
		echo "<tr>";
		echo "<td><a href=".$row['url'].">".substr(str_replace('\\\\?','?', $row['url']), 0, 150)."</a></td><td>".$row['count']."</td>
		<td>".$row['date']."</td>
		<td>".$row['last_id']."</td>
		<td>".$row['last_name']."</td>";
		echo "</tr>";
	}
	echo "</table>";
?>
</div>
<div style="border:0px solid red;display:table; width:48%;margin:2px; float:left;">
<?
	$query = "SELECT * FROM user_log ORDER BY count DESC ";
	$result = $mysql->query($query);
	
	$query2 = "SELECT SUM(count) as count FROM user_log ";
	$result2 = $mysql->query($query2);
	$row2 = mysqli_fetch_array($result2);

	$query3 = "SELECT COUNT(*) as count FROM user_log ";
	$result3 = $mysql->query($query3);
	$row3 = mysqli_fetch_array($result3);

	echo "<span style=\"font:normal 13px/13px arial, sans-serif;\">Row Number : ".$row3['count'].", Visit Total : ".$row2['count']."</span>";
	echo "<table style=\"
		font:normal 12px/12px arial, sans-serif;
		text-align:left;\" width=\"100%\" margin:20px; border=\"1px\" cellpadding=\"2px\" cellspacing=\"0\">";
	echo "<tr><td>fb_id</td><td>subscriber_id</td>
		<td>full_name</td><td>status</td><td>Count</td></tr>";
	while ( $row = mysqli_fetch_array($result) ) {
		echo "<tr>";
		echo "<td><a href=http://facebook.com/".$row['fb_id'].">".$row['fb_id']."</a></td>
		<td>".$row['subscriber_id']."</td>
		<td>".$row['full_name']."</td>
		<td>".$row['status']."</td>
		<td>".$row['count']."</td>";
		echo "</tr>";
	}
	echo "</table>";

?>
</div>
