<?
	session_start();
	
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
	include 'lib/layout.php';

	if ( isset($_SESSION['fb_id']) == false ) {
		echo 'Maaf Anda harus Login terlebih dahulu';
		return;
	}
	
if ( $_POST['type'] === 'main_synopsis' || $_GET['type'] === 'main_synopsis' )	
{	
	$fb_id = $_POST['fb_id'];//$_SESSION['fb_id'];
	if ( $fb_id != '' ) {
		echo "<br>fb_id=".$_POST['fb_id']."<br>";
		echo "<br>index = ".$_POST['index'];
		echo "<br>type = ".$_POST['type'];
		echo "<br>bookcode = ".$_POST['bookcode'];
		echo "<br>new synopsis = ".$_POST['new_synopsis'];
		echo "<br>submit_type = ".$_POST['submit_type'];	
		echo "<br>reporter = ".$_POST['reporter'];
		echo "<br>reason = ".$_POST['reason'];
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);

		$query = "SELECT a.code, a.author_name, a.title, a.synopsis as synopsis_a, b.synopsis as synopsis_b, b.recommended, a.rack, a.genre, a.status  FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE a.code='".$_POST['bookcode']."'";
		
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		
		$synopsis = $row['synopsis_b'];
		if ( $synopsis === '' ) {
			$synopsis = $row['synopsis_a'];
		}
		$c = ExtractSynopsisContrib($_POST['bookcode'], $synopsis);
		for ( $i = 0; $i < count($c); $i++ ) {
			if ( $c[$i]['fb_id'] == $_POST['fb_id'] && $c[$i]['index'] == $_POST['index'] ) {
				//$c[$i]['synopsis'] = $_POST['new_synopsis'];
				$wrong_synopsis = $c[$i]['synopsis']; 
			}
		}
		//date/time reporter reason type(main/char _synopsis), writer, index, synopsis
		$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".report_synopsis VALUES(NOW(), '".$_POST['reporter']."', '".$_POST['reason']."','".$_POST['type']."','".$_POST['fb_id']."','".$_POST['bookcode']."','',".$_POST['index'].",'".str_replace("'", "\'", $wrong_synopsis)."')";
		echo "QUERY = ".$query;
		$mysql->query($query);

		//$query = "UPDATE ".$GLOBALS['COMIC_DBWEB'].".comic_rating SET synopsis='".str_replace("'", "\'", $str)."' WHERE code='".$_POST['bookcode']."'";
		//$mysql->query($query);
		return;
	}

	
	/*echo "<br>fb_id=".$_SESSION['fb_id']."<br>";
	echo "<br>index = ".$_GET['index'];
	echo "<br>type = ".$_GET['type'];
	echo "<br>bookcode = ".$_GET['bookcode'];
	*/	
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);

	$query = "SELECT a.code, a.author_name, a.title, a.synopsis as synopsis_a, b.synopsis as synopsis_b, b.recommended, a.rack, a.genre, a.status  FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE a.code='".$_GET['bookcode']."'";
		//echo "<br>QUERY = ".$query;
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		
		$synopsis = $row['synopsis_b'];
		if ( $synopsis === '' ) {
			$synopsis = $row['synopsis_a'];
		}
	//echo $synopsis;
	$c = ExtractSynopsisContrib($_GET['bookcode'], $synopsis);
	//print_r($c);

	//echo "<br>------------------------------------------<br>";
	//echo ConstructSynopsisContrib($c);
	//echo "<br>----------------<br>";

	for ( $i = 0; $i < count($c); $i++ ) {
		if ( $c[$i]['fb_id'] === $_GET['fb_id'] && $c[$i]['index'] == $_GET['index']) {
			//echo $c[$i]['synopsis'];
			?>
			<p style="font:normal 15px/18px Arial, sans-serif; font-weight:bold;">Lapor Kesalahan</p>
			<table style="font:normal 13px/18px Arial, sans-serif; background-color:#f1f1f1;">
				<form id='reportsynopsis'>
				<input type="hidden" name="fb_id" value="<? echo $c[$i]['fb_id'];?>">	
				<input type="hidden" name="bookcode" value="<?echo $_GET['bookcode'];?>">
				<input type="hidden" name="type" value="<? echo $_GET['type'];?>">
				<input type="hidden" name="index" value="<? echo $_GET['index'];?>">
				<tr>
					<td style="background-color:white;">
						Judul
					</td>
					<td style="background-color:white;">
						<?echo getBookTitleFromCode($_GET['bookcode']);?>
					</td>
				</tr><tr>
					<td style="background-color:white;" width="150px" >
						Nama Kontributor
					</td>
					<td style="background-color:white;">
						<? echo getFBNameFromFBID($c[$i]['fb_id']); ?>
					</td>
				</tr>
				<tr>
					<td style="background-color:white;">
					Sinopsis
					</td>
					<td style="background-color:white;" style="text-align:justify">
						<? echo $c[$i]['synopsis'];?>
					</td>
				</tr>
				<tr>
					<td style="border-top:1px solid blue;">
						Nama Pelapor
					</td>
					<td style="border-top:1px solid blue;">
						<? echo getFBNameFromFBID($_SESSION['fb_id']);?>
						<input type="hidden" name="reporter" value="<? echo $_SESSION['fb_id'];?>"></input>
					</td>
				</tr>
				<tr>
					<td width="150px" style="border-top:1px solid blue;">
						Alasan Kesalahan Sinopsis 
					</td>
					<td style="border-top:1px solid blue;">
						<textarea cols="100" rows="5" name="reason"></textarea>
					</td>
				</tr>
				</form>
				<tr>
					<td>
					</td>
					<td>
						<button onclick="javascript:SubmitReportSynopsis();">Laporkan</button>
					</td>
				</tr>
			</table>
			<?
			return;
		}
	}
} else if ( $_POST['type'] === 'char_synopsis' || $_GET['type'] === 'char_synopsis' ) {
	echo "char synopsis";
	//echo "Ext info = ".$_GET['ext_info'];
	
	if ( isset($_POST['type']) == true ) {
		
		$ext_info = $_POST['ext_info'];
		$bookcode = $_POST['bookcode'];
		$query = "SELECT * FROM synopsis_character WHERE book_code='".$bookcode."' AND character_name='".$ext_info."'";
	//echo "QUERY = ".$query;
	
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$synopsis = $row['character_synopsis'];
		$c = ExtractSynopsisContrib($_POST['bookcode'], $row['character_synopsis']);
		for ( $i = 0; $i < count($c); $i++ ) {
			if ( $c[$i]['fb_id'] == $_POST['fb_id'] && $c[$i]['index'] == $_POST['index'] ) {
				$wrong_synopsis = $c[$i]['synopsis'];
			}
		}
		
		$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".report_synopsis VALUES(NOW(), '".$_POST['reporter']."', '".$_POST['reason']."','".$_POST['type']."','".$_POST['fb_id']."','".$_POST['bookcode']."','".$_POST['ext_info']."',".$_POST['index'].",'".str_replace("'", "\'", $wrong_synopsis)."')";
		echo "QUERY = ".$query;
		$mysql->query($query);
		return;
	}
	
	
	
	$query = "SELECT * FROM synopsis_character WHERE book_code='".$_GET['bookcode']."' AND character_name='".$_GET['ext_info']."'";
	//echo "QUERY = ".$query;
	
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	$c = ExtractSynopsisContrib($_GET['bookcode'], $row['character_synopsis']);
	//print_r($c);

	//echo "<br>------------------------------------------<br>";
	//echo ConstructSynopsisContrib($c);
	//echo "<br>----------------<br>";

	for ( $i = 0; $i < count($c); $i++ ) {
		if ( $c[$i]['fb_id'] === $_GET['fb_id'] && $c[$i]['index'] == $_GET['index']) {
			//echo $c[$i]['synopsis'];
			?>
			<p style="font:normal 15px/18px Arial, sans-serif; font-weight:bold;">Lapor Kesalahan</p>
			<table cellpadding="5px" style="font:normal 13px/18px Arial, sans-serif;
				background-color:#f1f1f1;">
				<form id='reportsynopsis'>
				<input type="hidden" name="fb_id" value=<? echo $_GET['fb_id'];?>>	
				<input type="hidden" name="bookcode" value=<?echo $_GET['bookcode'];?>>
				<input type="hidden" name="type" value=<? echo $_GET['type'];?>>
				<input type="hidden" name="index" value=<? echo $_GET['index'];?>>
				<input type="hidden" name="ext_info" value='<? echo $_GET['ext_info']; ?>'>
				<tr>
					<td width="150px" style="background-color:white;">
						Nama Kontributor
					</td>
					<td style="background-color:white;">
						<? echo getFBNameFromFBID($_GET['fb_id']); ?>
					</td>
				</tr>
				<tr>
					<td style="background-color:white;">
						Judul
					</td>
					<td style="background-color:white;">
						<?echo getBookTitleFromCode($_GET['bookcode']);?>
					</td>
				</tr>
				<tr>
					<td style="background-color:white;">
						Nama Karakter 
					</td>
					<td style="background-color:white;">
						<? echo $_GET['ext_info']; ?><br>
						<img src='../character_pic/<?echo $_GET['bookcode'];?>_<?echo $_GET['ext_info'];?>' width="75px" height="75px" style="border-radius:75px;">
					</td>
				</tr>
				<tr>
					<td style="background-color:white;">
					Profil Karakter
					</td>
					<td style="text-align:justify; background-color:white;">
						<? echo $c[$i]['synopsis'];?>
					</td>
				</tr>
				<tr>
					<td style="border-top:1px solid blue;">
						Nama Pelapor
					</td>
					<td style="border-top:1px solid blue;">
						<? echo getFBNameFromFBID($_SESSION['fb_id']);?>
						<input type="hidden" name="reporter" value="<? echo $_SESSION['fb_id'];?>"></input>
					</td>
				</tr>
				<tr>
					<td width="150px" style="border-top:1px solid blue;">
						Alasan Kesalahan Sinopsis 
					</td>
					<td style="border-top:1px solid blue;">
						<textarea cols="100" rows="5" name="reason"></textarea>
					</td>
				</tr></form>
				<tr>
					<td>
					</td>
					<td>
						<button onclick="javascript:SubmitReportSynopsis();">Laporkan</button>
					
					</td>
				</tr>
			</table>
	<?
		}
	}
}

?>
