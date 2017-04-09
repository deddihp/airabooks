<?
session_start();
	if ( !isset($_SESSION['fb_id']) ) {
		echo "<p style=\"font:normal 15px/18px Arial, sans-serif; font-weight:bold;\">!!! Maaf anda harus login terlebih dahulu, untuk berkontribusi dalam penulisan sinopsis.</p>";
	//	return;
	}
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
	include 'lib/layout.php';

if ( $_GET['type'] === 'main_synopsis' || $_POST['type'] === 'main_synopsis' ) {
	if ( isset($_POST['index_synopsis_extract']) ) {
		//echo 'GO TO POST SYNOPSIS EXTRACT = '.$_POST['index_synopsis_extract'];
		if ( $_POST['synopsis'] === '' )
			return;
		$_POST['synopsis'] = str_replace('', '', $_POST['synopsis']);
		$_POST['synopsis'] = str_replace("\'","'", $_POST['synopsis']);
		echo 'Synopsis = '.$_POST['synopsis'];
		
		echo "<br>type = ".$_POST['type'];
		echo "<br>bookcode = ".$_POST['bookcode']."<br>";
		
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);

	$query = "SELECT a.code, a.author_name, a.title, a.synopsis as synopsis_a, b.synopsis as synopsis_b, b.recommended, a.rack, a.genre, a.status  FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE a.code='".$_POST['bookcode']."'";
		//echo "<br>QUERY = ".$query;
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		
		$synopsis = $row['synopsis_b'];
		if ( $synopsis === '' ) {
			$synopsis = $row['synopsis_a'];
		}
		$c = ExtractSynopsisContrib($_POST['bookcode'], $synopsis);

		echo "EXTRACT ------> ".$_POST['index_synopsis_extract'];
		if ( $c === false ) {
			echo "GET IN HERE <br>";
			if ( isset($fbman[$_SESSION['fb_id']]) === false )
				$fbman[$_SESSION['fb_id']] = 0;
				$n[] = Array (
					'fb_id' => $_SESSION['fb_id'],
					'synopsis' => $_POST['synopsis'],
					'length' => strlen($_POST['synopsis']),
					'index' => $fbman[$_SESSION['fb_id']],
					'book_code' => $_POST['bookcode']
				);
				$fbman[$_SESSION['fb_id']]++;
		} else {
		for ( $i = 0; $i < count($c); $i++ ) {
			if ( $i == $_POST['index_synopsis_extract'] ) {
				echo "GET IN HERE <br>";
				if ( isset($fbman[$_SESSION['fb_id']]) === false )
					$fbman[$_SESSION['fb_id']] = 0;
				$n[] = Array (
					'fb_id' => $_SESSION['fb_id'],
					'synopsis' => $_POST['synopsis'],
					'length' => strlen($_POST['synopsis']),
					'index' => $fbman[$_SESSION['fb_id']],
					'book_code' => $_POST['bookcode']
				);
				$fbman[$_SESSION['fb_id']]++;
			}
			if ( isset($fbman[$c[$i]['fb_id']]) === false )
				$fbman[$c[$i]['fb_id']] = 0;
			$n[] = Array (
				'fb_id' => $c[$i]['fb_id'],
				'synopsis' => $c[$i]['synopsis'],
				'length' => $c[$i]['length'],
				'index' => $fbman[$c[$i]['fb_id']],
				'book_code' => $c[$i]['book_code']
			);
			$fbman[$c[$i]['fb_id']]++;
		}
		if ( $_POST['index_synopsis_extract'] == -1 ) {
			if ( isset($fbman[$_SESSION['fb_id']]) === false )
				$fbman[$_SESSION['fb_id']] = 0;
			$n[] = Array (
				'fb_id' => $_SESSION['fb_id'],
				'synopsis' => $_POST['synopsis'],
				'length' => strlen($_POST['synopsis']),
				'index' => $fbman[$_SESSION['fb_id']],
				'book_code' => $_POST['bookcode']
			);
			$fbman[$_SESSION['fb_id']]++;
		}
		}
		//print_r($n);
		
		$str = ConstructSynopsisContrib($n);
		//echo $str;
		//echo "<br>----------------<br>";
		$str = str_replace("\'", "'", $str);
		$str = str_replace("'", "\'", $str);
		$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".comic_rating VALUES('".$_POST['bookcode']."',0,	'".$str."')";
		$result = $mysql->query($query);
		print_r('<br>RESULT '.$result.'<br>');
		if ( $result == true )  {
			$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".synopsis_log VALUES(NOW(), '".$_SESSION['fb_id']."','".$_POST['type']."', '".$_POST['bookcode']."', ".$fbman[$_SESSION['fb_id']].", '', 'add', '".str_replace("'", "\'", $_POST['synopsis'])."')";
			$mysql->query($query);	
		} else {
			$query = "UPDATE ".$GLOBALS['COMIC_DBWEB'].".comic_rating SET synopsis='".$str."' WHERE code='".$_POST['bookcode']."'";
			echo "<br>QUERY = ".$query."<br>";
			$mysql->query($query);
		
			$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".synopsis_log VALUES(NOW(), '".$_SESSION['fb_id']."','".$_POST['type']."', '".$_POST['bookcode']."', ".$fbman[$_SESSION['fb_id']].", '', 'update', '".str_replace("'", "\'", $_POST['synopsis'])."')";
			$mysql->query($query);	
		}
		return;
	}

	if ($_GET['type']==='main_synopsis') {
		$ctype = 'Sinopsis Utama';
	} else if ( $_GET['type'] === 'char_synopsis') {
		$ctype = 'Sinopsis Tokoh';
	}
	$type = $_GET['type'];
	//echo "
	//<p>Tipe Sinopsis = ".$ctype."</p>";
	//echo "
	//<p>bookcode = ".$_GET['bookcode']."</p>";
	echo "
		<p style=\"font:normal 15px/18px Arial, sans-serif; font-weight:bold;\">Tambah Sinopsis</p>
		<table style=\"font:normal 13px/18px Arial, sans-serif;\">
			<tr>
				<td width=\"150px\">
					Nama Kontributor 
				</td>
				<td>
					".getFBNameFromFBID($_SESSION['fb_id'])."
				</td>
			</tr>
			<tr>
				<td>
					Judul
				</td>
				<td>
					".getBookTitleFromCode($_GET['bookcode'])."
				</td>
			</tr>
		</table>";
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);

	$query = "SELECT a.code, a.author_name, a.title, a.synopsis as synopsis_a, b.synopsis as synopsis_b, b.recommended, a.rack, a.genre, a.status  FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE a.code='".$_GET['bookcode']."'";
		//echo "<br>QUERY = ".$query;
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		
		$synopsis = $row['synopsis_b'];
		//echo $synopsis;
	if ( $synopsis === '' ) {
			$synopsis = $row['synopsis_a'];
		}
	$c = ExtractSynopsisContrib($_GET['bookcode'], $synopsis);
	if ( $c != false )
	for ($i = 0; $i < count($c); $i++ ) {
		if ( $_SESSION['fb_id'] === $c[$i]['fb_id'] )
			$canedit = $c[$i]['length']." karakter | <a href='javascript:void(0);' onclick=\"javascript:showScreenCover('../editsynopsis.php?bookcode=".$c[$i]['book_code']."&fb_id=".$c[$i]['fb_id']."&index=".$c[$i]['index']."&type=".$type."');\">edit</a> ";
		else
			$canedit = $c[$i]['length']." karakter";
		if ( isset($_SESSION['fb_id']) == true )
			$content = $content . "<button id='addsynopsis_form_button_".$i."' onclick=\"javascript:ShowID('addsynopsis_form_table_".$i."', 'addsynopsis_form_button_".$i."');\">tambah sinopsis disini</button>";
		$content = $content . "<table id='addsynopsis_form_table_".$i."' style=\"display:none;border:1px solid #e2e2e2;margin:5px; font:normal 13px/18px Arial, sans-serif;\" width=\"100%\">
				<tr>
					<td>
					</td>
					<td>
						<button onclick=\"javascript:HideID('addsynopsis_form_table_".$i."', 'addsynopsis_form_button_".$i."');\">Sembunyikan</button>
					</td>
				</tr>
				<tr>
					<td>
						Sinopsis
					</td>
					<td>
						<form id='addsynopsis_form_".$i."'>
							<textarea name='synopsis' cols='100px' rows='5px'></textarea>
							<input type='hidden' name='index_synopsis_extract' value='".$i."'></input>
							<input type='hidden' name='bookcode' value='".$_GET['bookcode']."'></input>
							<input type='hidden' name='type' value='".$_GET['type']."'></input>
						</form>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<button onclick=\"javascript:SubmitAddSynopsis('addsynopsis_form_".$i."');\">Update</button>
					</td>
				</tr>
			</table>
		";
		$content = $content . "
		<div style=\"border:0px solid black; margin:0px; padding:0px;\">
			<div id=\"box_".$c[$i]['fb_id']."\" class=\"SynopsisContrib_BOX\" style=\"margin:5px 0 0 0;border:2px solid blue; font:normal 13px/18px Arial, sans-serif; background-color:#fafafa;text-align:justify;\">".AdjustParagraph($c[$i]['synopsis'])."
			</div>
			<div id=\"box_user_".$c[$i]['fb_id']."\" class=\"SynopsisContrib_BOX_USER\" style=\"display:table;margin:0px; border:2px solid blue; border-top:0px; height:30px;width:300px;text-align:left;\">
				<img src=http://graph.facebook.com/".$c[$i]['fb_id']."/picture width=\"30px\" height=\"30px\" style=\"float:left;\">
				
				<span style=\"font:bold 12px/13px Arial, sans-serif;margin:0 0 0 5px; text-align:left!important;\"><a style=\"margin:0px;padding:0px; \" href='http://facebook.com/".$c[$i]['fb_id']."'>
				".getFBNameFromFBID($c[$i]['fb_id'])."</a></span>
				
				<br><span style=\"font:normal 12px/13px Arial, sans-serif;margin:0 0px 0 5px;\"> ".$canedit."</span>
			</div>
		</div>
		";
	}
	$i = 'end';
	if ( isset($_SESSION['fb_id']) == true )
		$content = $content . "<button id='addsynopsis_form_button_".$i."' onclick=\"javascript:ShowID('addsynopsis_form_table_".$i."', 'addsynopsis_form_button_".$i."');\">tambah sinopsis disini</button>";
	$content = $content . "<table id='addsynopsis_form_table_".$i."' style=\"display:none;border:1px solid #e2e2e2; margin:5px;font:normal 13px/18px Arial, sans-serif;\" width=\"100%\">
				<tr>
					<td>
					</td>
					<td style=\"text-align:center;\">
						<button onclick=\"javascript:HideID('addsynopsis_form_table_".$i."', 'addsynopsis_form_button_".$i."');\">Sembunyikan</button>
					</td>
				</tr>
				<tr>
					<td>
						Sinopsis
					</td>
					<td>
						<form id='addsynopsis_form_".$i."'>
							<textarea name='synopsis' cols='100px' rows='5px'></textarea>
							<input type='hidden' name='index_synopsis_extract' value='-1'></input>
							<input type='hidden' name='bookcode' value='".$_GET['bookcode']."'></input>
							<input type='hidden' name='type' value='".$_GET['type']."'></input>
						</form>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<button onclick=\"javascript:SubmitAddSynopsis('addsynopsis_form_".$i."');\">Update</button>
					</td>
				</tr>
			</table>
		";
	echo $content;
} else if ( $_GET['type'] === 'char_synopsis' || $_POST['type'] === 'char_synopsis' ) {
	//echo "char synopsis";
	
	if ( isset($_POST['type']) === true ) {
		echo 'GO TO POST SYNOPSIS EXTRACT = '.$_POST['index_synopsis_extract'];
		if ( $_POST['synopsis'] === '' )
			return;
	/*	echo 'Synopsis = '.$_POST['synopsis'];
		
		echo "<br>type = ".$_POST['type'];
		echo "<br>bookcode = ".$_POST['bookcode']."<br>";
	*/	
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);

		$query = "SELECT * FROM synopsis_character WHERE book_code='".$_POST['bookcode']."' AND character_name='".$_POST['ext_info']."'";
	//	echo "<br>QUERY = ".$query;
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		
		$synopsis = $row['character_synopsis'];
		$c = ExtractSynopsisContrib($_POST['bookcode'], $synopsis);

	//	echo "EXTRACT ------> ".$_POST['index_synopsis_extract'];
		if ( $c === false ) {
	//		echo "GET IN HERE <br>";
			if ( isset($fbman[$_SESSION['fb_id']]) === false )
				$fbman[$_SESSION['fb_id']] = 0;
				$n[] = Array (
					'fb_id' => $_SESSION['fb_id'],
					'synopsis' => $_POST['synopsis'],
					'length' => strlen($_POST['synopsis']),
					'index' => $fbman[$_SESSION['fb_id']],
					'book_code' => $_POST['bookcode']
				);
				$fbman[$_SESSION['fb_id']]++;
		} else {
		for ( $i = 0; $i < count($c); $i++ ) {
			if ( $i == $_POST['index_synopsis_extract'] ) {
	//			echo "GET IN HERE <br>";
				if ( isset($fbman[$_SESSION['fb_id']]) === false )
					$fbman[$_SESSION['fb_id']] = 0;
				$n[] = Array (
					'fb_id' => $_SESSION['fb_id'],
					'synopsis' => $_POST['synopsis'],
					'length' => strlen($_POST['synopsis']),
					'index' => $fbman[$_SESSION['fb_id']],
					'book_code' => $_POST['bookcode']
				);
				$fbman[$_SESSION['fb_id']]++;
			}
			if ( isset($fbman[$c[$i]['fb_id']]) === false )
				$fbman[$c[$i]['fb_id']] = 0;
			$n[] = Array (
				'fb_id' => $c[$i]['fb_id'],
				'synopsis' => $c[$i]['synopsis'],
				'length' => $c[$i]['length'],
				'index' => $fbman[$c[$i]['fb_id']],
				'book_code' => $c[$i]['book_code']
			);
			$fbman[$c[$i]['fb_id']]++;
		}
		if ( $_POST['index_synopsis_extract'] == -1 ) {
			if ( isset($fbman[$_SESSION['fb_id']]) === false )
				$fbman[$_SESSION['fb_id']] = 0;
			$n[] = Array (
				'fb_id' => $_SESSION['fb_id'],
				'synopsis' => $_POST['synopsis'],
				'length' => strlen($_POST['synopsis']),
				'index' => $fbman[$_SESSION['fb_id']],
				'book_code' => $_POST['bookcode']
			);
			$fbman[$_SESSION['fb_id']]++;
		}
		}
	//	print_r($n);
		
		$str = ConstructSynopsisContrib($n);
		//echo $str;
		//echo "<br>----------------<br>";
		
		//$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".comic_rating VALUES('".$_POST['bookcode']."',0,	'".$str."')";
		//$mysql->query($query);

		//$query = "UPDATE ".$GLOBALS['COMIC_DBWEB'].".comic_rating SET synopsis='".$str."' WHERE code='".$_POST['bookcode']."'";
		$str = str_replace("\'", "'", $str);
		$str = str_replace("'", "\'", $str);
		$query = "UPDATE ".$GLOBALS['COMIC_DBWEB'].".synopsis_character SET character_synopsis='".$str."' WHERE book_code='".$_POST['bookcode']."' AND character_name='".$_POST['ext_info']."'";
		
	//	echo $query;
		$mysql->query($query);
	
		$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".synopsis_log VALUES(NOW(), '".$_SESSION['fb_id']."','".$_POST['type']."', '".$_POST['bookcode']."', ".$_POST['index_synopsis_extract'].", '".$_POST['ext_info']."', 'update', '".$str."')";
			$mysql->query($query);	
		return;
	}

	echo "
		<p style=\"font:normal 15px/18px Arial, sans-serif; font-weight:bold;\">Tambah Sinopsis</p>
		<table style=\"font:normal 13px/18px Arial, sans-serif;\">
			<tr>
				<td width=\"150px\">
					Nama Kontributor 
				</td>
				<td>
					".getFBNameFromFBID($_SESSION['fb_id'])."
				</td>
			</tr>
			<tr>
				<td>
					Judul
				</td>
				<td>
					".getBookTitleFromCode($_GET['bookcode'])."
				</td>
			</tr>
			<tr>
				<td>
					Nama Tokoh
				</td>
				<td>
					".$_GET['ext_info']."
				</td>
			</tr>
		</table>";
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);

	//$query = "SELECT a.code, a.author_name, a.title, a.synopsis as synopsis_a, b.synopsis as synopsis_b, b.recommended, a.rack, a.genre, a.status  FROM book_title a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".comic_rating b ON a.code=b.code WHERE a.code='".$_GET['bookcode']."'";
		$query = "SELECT * FROM synopsis_character WHERE book_code='".$_GET['bookcode']."' AND character_name='".$_GET['ext_info']."'";
		//echo "<br>QUERY = ".$query;
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		
		$synopsis = $row['character_synopsis'];
	//echo $synopsis;
	$c = ExtractSynopsisContrib($_GET['bookcode'], $synopsis);
	//print_r($c);
	if ( $c != false )
	for ($i = 0; $i < count($c); $i++ ) {
		if ( $_SESSION['fb_id'] === $c[$i]['fb_id'] )
			$canedit = $c[$i]['length']." karakter | <a href='javascript:void(0);' onclick=\"javascript:showScreenCover('../editsynopsis.php?bookcode=".$c[$i]['book_code']."&fb_id=".$c[$i]['fb_id']."&index=".$c[$i]['index']."&type=".$_GET['type']."&ext_info=".$_GET['ext_info']."');\">edit</a> ";
		else
			$canedit = $c[$i]['length']." karakter";
		if ( isset($_SESSION['fb_id']) == true )
			$content = $content . "<button id='addsynopsis_form_button_".$i."' onclick=\"javascript:ShowID('addsynopsis_form_table_".$i."', 'addsynopsis_form_button_".$i."');\">tambah sinopsis disini</button>";
		$content = $content . "<table id='addsynopsis_form_table_".$i."' style=\"display:none;border:1px solid #e2e2e2;margin:5px; font:normal 13px/18px Arial, sans-serif;\" width=\"100%\">
				<tr>
					<td>
					</td>
					<td>
						<button onclick=\"javascript:HideID('addsynopsis_form_table_".$i."', 'addsynopsis_form_button_".$i."');\">Sembunyikan</button>
					</td>
				</tr>
				<tr>
					<td>
						Sinopsis
					</td>
					<td>
						<form id='addsynopsis_form_".$i."'>
							<textarea name='synopsis' cols='100px' rows='5px'></textarea>
							<input type='hidden' name='index_synopsis_extract' value='".$i."'></input>
							<input type='hidden' name='bookcode' value='".$_GET['bookcode']."'></input>
							<input type='hidden' name='ext_info' value='".$_GET['ext_info']."'></input>
							<input type='hidden' name='type' value='".$_GET['type']."'></input>
						</form>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<button onclick=\"javascript:SubmitAddSynopsis('addsynopsis_form_".$i."');\">Update</button>
					</td>
				</tr>
			</table>
		";
		$content = $content . "
		<div style=\"border:0px solid black; margin:0px; padding:0px;\">
			<div id=\"box_".$c[$i]['fb_id']."\" class=\"SynopsisContrib_BOX\" style=\"margin:5px 0 0 0;border:2px solid blue; font:normal 13px/18px Arial, sans-serif; background-color:#fafafa;text-align:justify;\">".AdjustParagraph($c[$i]['synopsis'])."
			</div>
			<div id=\"box_user_".$c[$i]['fb_id']."\" class=\"SynopsisContrib_BOX_USER\" style=\"display:table;margin:0px; border:2px solid blue; border-top:0px; height:30px;width:300px;text-align:left;\">
				<img src=http://graph.facebook.com/".$c[$i]['fb_id']."/picture width=\"30px\" height=\"30px\" style=\"float:left;\">
				
				<span style=\"font:bold 12px/13px Arial, sans-serif;margin:0 0 0 5px; text-align:left!important;\"><a style=\"margin:0px;padding:0px; \" href='http://facebook.com/".$c[$i]['fb_id']."'>
				".getFBNameFromFBID($c[$i]['fb_id'])."</a></span>
				
				<br><span style=\"font:normal 12px/13px Arial, sans-serif;margin:0 0px 0 5px;\"> ".$canedit."</span>
			</div>
		</div>
		";
	}
	$i = 'end';
	if ( isset($_SESSION['fb_id']) == true )
		$content = $content . "<button id='addsynopsis_form_button_".$i."' onclick=\"javascript:ShowID('addsynopsis_form_table_".$i."', 'addsynopsis_form_button_".$i."');\">tambah sinopsis disini</button>";
	$content = $content . "<table id='addsynopsis_form_table_".$i."' style=\"display:none;border:1px solid #e2e2e2; margin:5px;font:normal 13px/18px Arial, sans-serif;\" width=\"100%\">
				<tr>
					<td>
					</td>
					<td style=\"text-align:center;\">
						<button onclick=\"javascript:HideID('addsynopsis_form_table_".$i."', 'addsynopsis_form_button_".$i."');\">Sembunyikan</button>
					</td>
				</tr>
				<tr>
					<td>
						Sinopsis
					</td>
					<td>
						<form id='addsynopsis_form_".$i."'>
							<textarea name='synopsis' cols='100px' rows='5px'></textarea>
							<input type='hidden' name='index_synopsis_extract' value='-1'></input>
							<input type='hidden' name='bookcode' value='".$_GET['bookcode']."'></input>
						<input type='hidden' name='ext_info' value='".$_GET['ext_info']."'></input>
							<input type='hidden' name='type' value='".$_GET['type']."'></input>
						</form>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<button onclick=\"javascript:SubmitAddSynopsis('addsynopsis_form_".$i."');\">Update</button>
					</td>
				</tr>
			</table>
		";
		echo $content;
}
?>
