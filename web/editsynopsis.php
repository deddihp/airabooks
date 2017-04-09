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
		/*echo "<br>fb_id=".$_SESSION['fb_id']."<br>";
		echo "<br>index = ".$_POST['index'];
		echo "<br>type = ".$_POST['type'];
		echo "<br>bookcode = ".$_POST['bookcode'];
		echo "<br>new synopsis = ".$_POST['new_synopsis'];
		echo "<br>submit_type = ".$_POST['submit_type'];	
		*/$mysql = new MySQLComic($GLOBALS['COMIC_DB']);

		$query = "SELECT a.code, a.author_name, a.title, a.synopsis as synopsis_a, b.synopsis as synopsis_b, b.recommended, a.rack, a.genre, a.status  FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE a.code='".$_POST['bookcode']."'";
		
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		
		$synopsis = $row['synopsis_b'];
		if ( $synopsis === '' ) {
			$synopsis = $row['synopsis_a'];
		}
		if ( $_POST['submit_type'] === 'update' ) {
			$c = ExtractSynopsisContrib($_POST['bookcode'], $synopsis);
			for ( $i = 0; $i < count($c); $i++ ) {
				if ( ($c[$i]['fb_id'] == $_POST['fb_id'] || $_SESSION['role'] == 'ADMIN' ) && $c[$i]['index'] == $_POST['index'] ) {
					$c[$i]['synopsis'] = $_POST['new_synopsis'];
				}
			}
		} else if ( $_POST['submit_type'] === 'delete' ) {
			$c = ExtractSynopsisContrib($_POST['bookcode'], $synopsis);
			$counter = 0;
			for ( $i = 0; $i < count($c); $i++ ) {
				echo "POST = ".$_POST['fb_id'];
				if ( $c[$i]['fb_id'] == $_POST['fb_id'] ) {
					echo $c[$i]['index']."<->".$_POST['index'];
					if ( $c[$i]['index'] != $_POST['index'] ) {
						$n[] = Array (
							'fb_id' => $c[$i]['fb_id'],
							'synopsis' => $c[$i]['synopsis'],
							'length' => $c[$i]['length'],
							'index' => $counter++,
							'book_code' => $c[$i]['book_code']
						);
					} else {
						
					}
				} else {
					$n[] = Array (
							'fb_id' => $c[$i]['fb_id'],
							'synopsis' => $c[$i]['synopsis'],
							'length' => $c[$i]['length'],
							'index' => $c[$i]['index'],
							'book_code' => $c[$i]['book_code']
						);
				}
			}
			$c = $n;
		}
		//echo "<br>------------------------------------------<br>";
		$str = ConstructSynopsisContrib($c);
		//echo $str;
		//echo "<br>----------------<br>";
		$str = str_replace("\'", "'", $str);
		$str = str_replace("'", "\'", $str);
		$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".comic_rating VALUES('".$_POST['bookcode']."',0,	'".$str."')";
		$result = $mysql->query($query);
		//echo "<br>RESULT ".$result."<br>";
		if (  $result == true )  {
			$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".synopsis_log VALUES(NOW(), '".$_SESSION['fb_id']."','".$_POST['type']."', '".$_POST['bookcode']."', ".$_POST['index'].", '', 'update', '".$str."')";
			$mysql->query($query);	
		} else { 
			//echo "<BR>UPDATE HERE";
			$query = "UPDATE ".$GLOBALS['COMIC_DBWEB'].".comic_rating SET synopsis='".$str."' WHERE code='".$_POST['bookcode']."'";
			//echo "QUERY = ".$query;
			
			$mysql->query($query);
			
			$query = "UPDATE ".$GLOBALS['COMIC_DB'].".book_title SET synopsis='' WHERE code='".$_POST['bookcode']."'";
			
			$mysql->query($query);
			$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".synopsis_log VALUES(NOW(), '".$_SESSION['fb_id']."','".$_POST['type']."', '".$_POST['bookcode']."', ".$_POST['index'].", '', 'update', '".$str."')";
			$mysql->query($query);
		}
		return;
	}

/*	
	echo "<br>fb_id=".$_SESSION['fb_id']."<br>";
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
			<p style="font:normal 15px/18px Arial, sans-serif; font-weight:bold;">Edit Sinopsis</p>
			<table style="font:normal 13px/18px Arial, sans-serif;">
				<form id='editsynopsis'>
				<input type="hidden" name="fb_id" value=<? echo $c[$i]['fb_id'];?>>	
				<input type="hidden" name="bookcode" value=<?echo $_GET['bookcode'];?>>
				<input type="hidden" name="type" value=<? echo $_GET['type'];?>>
				<input type="hidden" name="index" value=<? echo $_GET['index'];?>>
				<tr>
					<td width="150px" >
						Nama Kontributor
					</td>
					<td>
						<? echo getFBNameFromFBID($c[$i]['fb_id']); ?>
					</td>
				</tr>
				<tr>
					<td>
						Judul
					</td>
					<td>
						<?echo getBookTitleFromCode($_GET['bookcode']);?>
					</td>
				</tr>
				<tr>
					<td>
					Sinopsis
					</td>
					<td>
						<textarea name='new_synopsis' cols=100 rows=10><? echo $c[$i]['synopsis'];?></textarea>
					</td>
				</tr>
				</form>
				<tr>
					<td>
					</td>
					<td>
						<button onclick="javascript:SubmitEditSynopsis('update');">Update</button>
						<button onclick="javascript:SubmitEditSynopsis('delete');">Delete</button>
					</td>
				</tr>
			</table>
			
			<?
			return;
		}
	}
} else if ( $_POST['type'] === 'char_synopsis' || $_GET['type'] === 'char_synopsis' ) {
	//echo "char synopsis";
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
		if ( $_POST['submit_type'] === 'update' ) {
			$c = ExtractSynopsisContrib($_POST['bookcode'], $row['character_synopsis']);
	//		print_r($c);
			for ( $i = 0; $i < count($c); $i++ ) {
				if ( $c[$i]['fb_id'] == $_POST['fb_id'] && $c[$i]['index'] == $_POST['index'] ) {
					$c[$i]['synopsis'] = $_POST['new_synopsis'];
				}
			}
		} else if ( $_POST['submit_type'] === 'delete' ) {
			$c = ExtractSynopsisContrib($_POST['bookcode'], $synopsis);
			$counter = 0;
			for ( $i = 0; $i < count($c); $i++ ) {
				if ( $c[$i]['fb_id'] == $_POST['fb_id'] ) {
					if ( $c[$i]['index'] != $_POST['index'] ) {
						$n[] = Array (
							'fb_id' => $c[$i]['fb_id'],
							'synopsis' => $c[$i]['synopsis'],
							'length' => $c[$i]['length'],
							'index' => $counter++,
							'book_code' => $c[$i]['book_code']
						);
					} else {
						
					}
				} else {
					$n[] = Array (
							'fb_id' => $c[$i]['fb_id'],
							'synopsis' => $c[$i]['synopsis'],
							'length' => $c[$i]['length'],
							'index' => $c[$i]['index'],
							'book_code' => $c[$i]['book_code']
						);
				}
			}
			$c = $n;
		}
		//echo "<br>------------------------------------------<br>";
		$str = ConstructSynopsisContrib($c);
		//echo $str;
		//echo "<br>----------------<br>";
		$str = str_replace("\'", "'", $str);
		$str = str_replace("'", "\'", $str);
		$query = "UPDATE ".$GLOBALS['COMIC_DBWEB'].".synopsis_character SET character_synopsis='".$str."' WHERE book_code='".$_POST['bookcode']."' AND character_name='".$_POST['ext_info']."'";
		//echo "QUERY = ".$query;
		$mysql->query($query);
		
		$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".synopsis_log VALUES(NOW(), '".$_SESSION['fb_id']."','".$_POST['type']."', '".$_POST['bookcode']."', ".$_POST['index'].", '".$_POST['ext_info']."', 'update', '".$str."')";
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
		if ( ($c[$i]['fb_id'] === $_POST['fb_id'] || $_SESSION['role'] == 'ADMIN' ) && $c[$i]['index'] == $_GET['index']) {
			//echo $c[$i]['synopsis'];
			?>
			<p style="font:normal 15px/18px Arial, sans-serif; font-weight:bold;">Edit Sinopsis</p>
			<table style="font:normal 13px/18px Arial, sans-serif;">
				<form id='editsynopsis'>
				<input type="hidden" name="fb_id" value=<? echo $_SESSION['fb_id'];?>>	
				<input type="hidden" name="bookcode" value=<?echo $_GET['bookcode'];?>>
				<input type="hidden" name="type" value=<? echo $_GET['type'];?>>
				<input type="hidden" name="index" value=<? echo $_GET['index'];?>>
				<input type="hidden" name="ext_info" value='<? echo $_GET['ext_info']; ?>'>
				<tr>
					<td width="150px" >
						Nama Kontributor
					</td>
					<td>
						<? echo getFBNameFromFBID($c[$i]['fb_id']); ?>
					</td>
				</tr>
				<tr>
					<td>
						Judul
					</td>
					<td>
						<?echo getBookTitleFromCode($_GET['bookcode']);?>
					</td>
				</tr>
				<tr>
					<td>
						Nama Karakter
					</td>
					<td>
						<? echo $_GET['ext_info']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Sinopsis
					</td>
					<td>
						<textarea name='new_synopsis' cols=100 rows=10><? echo $c[$i]['synopsis'];?></textarea>
					</td>
				</tr>
				</form>
				<tr>
					<td>
					</td>
					<td>
						<button onclick="javascript:SubmitEditSynopsis('update');">Update</button>
						<button onclick="javascript:SubmitEditSynopsis('delete');">Delete</button>
					</td>
				</tr>
			</table>
	<?
		}
	}
}

?>
