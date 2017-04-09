<?
	//echo $_POST['test'];
	$dir = $_POST['dir'];
	//echo "DIR = ".$dir;
	$last_date = $_POST['last_date'];
	include 'lib/mysql_comic.php';
	//include $dir.'lib/layout.php';
	include 'lib/book.php';

function getWord($row, $dir='\.') {
	$word = 'none';
	if ( $row['type'] === 'main_synopsis' ) {
			if ( $row['action'] === 'update' ) {
				$word = 'memperbarui sinopsis  <a href='.$dir.'/wiki/wikibook.php?bookcode='.$row['bookcode'].'>'.getBookTitle($row['bookcode']).'</a>';
			} else if ( $row['action'] === 'add' ) {
				$word = 'membuat sinopsis <a href='.$dir.'/wiki/wikibook.php?bookcode='.$row['bookcode'].'>'.getBookTitle($row['bookcode']).'</a>';
			
			}
		} else if ( $row['type'] === 'char_synopsis' ) {
			if ( $row['action'] === 'update' ) {
				$word = 'memperbarui sinopsis tokoh '.$row['ext_info'].' di <a href='.$dir.'/wiki/wikibook.php?bookcode='.$row['bookcode'].'>'.getBookTitle($row['bookcode']).'</a>';
			} else if ( $row['action'] === 'add' ) {
				$word = 'membuat sinopsis tokoh '.$row['ext_info'].' di <a href='.$dir.'/wiki/wikibook.php?bookcode='.$row['bookcode'].'>'.getBookTitle($row['bookcode']).'</a>';
			
			}
		} else if ( $row['type'] === 'add_character_profile' ) {
			$word = ' tokoh '.$row['ext_info'].' di <a href='.$dir.'/wiki/wikibook.php?bookcode='.$row['bookcode'].'>'.getBookTitle($row['bookcode']).'</a>
			<div style="border:0px solid black; width:100%; clear:both; text-align:center;"><img src="'.$dir.'character_pic/'.$row['bookcode'].'_'.$row['ext_info'].'.jpg" style="width:75px; height:75px; border-radius:75px;">
			<p style="margin:0px;">'.$row['ext_info'].'</p></div>';
			
			if ( $row['action'] === 'update' ) {
				$word = 'memperbarui '.$word;
			} else if ( $row['action'] === 'add' ) {
				$word = 'menambah '.$word;
			}
		} else if ( $row['type'] === 'edit_character_profile' ) {
			$word = ' di <a href='.$dir.'/wiki/wikibook.php?bookcode='.$row['bookcode'].'>'.getBookTitle($row['bookcode']).'</a>
			<div style="border:0px solid black; width:100%; clear:both; text-align:center;"></div>';
			
			if ( $row['action'] === 'change_order' ) {
				$word = 'memperbarui urutan tokoh'.$word;
			} else if ( $row['action'] === 'update' ) {
				$word = 'memperbarui tokoh '.$row['ext_info'].' '.$word;
			}
		}
	return $word;
}
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	
	if ( $_POST['position'] === 'bottom' ) {
		
		/*$last_date = '10';
		$content = 'test bottom_date = '.$_POST['bottom_date'];
		$n = Array (
			'last_date' => $last_date,
			'html' => $content
		);
		echo json_encode($n);
		*/
		//$query = "SELECT * FROM synopsis_log a, user_activation b WHERE a.editor_fb_id=b.fb_id ORDER BY date DESC LIMIT 15";
		$query = "SELECT * FROM synopsis_log a, user_activation b WHERE a.editor_fb_id=b.fb_id AND date < '".$_POST['bottom_date']."' ORDER BY date DESC LIMIT 5";
		$result = $mysql->query($query);
		$content = '';
		$n = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			if ( $row['editor_fb_id'] === '1192425363' ) {
			$row['editor_fb_id'] = 'airabooks';
			$row['fb_name'] = 'airabooks';
		}
			$content = $content . "<div id=\"first-".$n."\" style=\"display:table; width:100%;font:normal 12px/13px Arial, Sans-Serif;background-color:#e6e8ef; margin:1px; padding:5px;\">
				<img src='http://graph.facebook.com/".$row['editor_fb_id']."/picture' width='30px'
				style='margin: 0 5px 0 0;float:left;display:table;'
			>
			<span style='font-weight:bold; float:left;'><a href='http://facebook.com/".$row['editor_fb_id']."'>".$row['fb_name']."</a></span>"."<span>&nbsp".
				getWord($row, $dir)."</span>
			</div>";
			$n++;
			if ( $n == mysqli_num_rows($result) ) {
				$bottom_date = $row['date'];
				//$content = $content . "check bottom date";
				//$content = $content . $last_date. " numrows = ".mysqli_num_rows($result);
			}
			/*if ( $n == mysqli_num_rows($result) ) {
				$bottom_date = $row['date'];
			}*/
		}
		$n = Array(
			'bottom_date' => $bottom_date,
			'html' => $content
		);
		echo json_encode($n);
		
		return;
	} else
	if ( $_POST['isfirst'] === 'true' ) {
		$query = "SELECT * FROM synopsis_log a, user_activation b WHERE a.editor_fb_id=b.fb_id ORDER BY date DESC LIMIT 20";
		$result = $mysql->query($query);
		$content = '';
		$n = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			if ( $row['editor_fb_id'] === '1192425363' ) {
			$row['editor_fb_id'] = 'airabooks';
			$row['fb_name'] = 'airabooks';
		}
			$content = $content . "<div id=\"first-".$n."\" style=\"display:table; width:100%;font:normal 12px/13px Arial, Sans-Serif;background-color:#e6e8ef; margin:1px; padding:5px;\">
				<img src='http://graph.facebook.com/".$row['editor_fb_id']."/picture' width='30px'
				style='margin: 0 5px 0 0;float:left;display:table;'
			>
			<span style='font-weight:bold; float:left;'><a href='http://facebook.com/".$row['editor_fb_id']."'>".$row['fb_name']."</a></span>"."<span>&nbsp".
				getWord($row, $dir)."</span>
			</div>";
			$n++;
			if ( $n == 1 ) {//mysqli_num_rows($result) ) {
				$last_date = $row['date'];
				//$content = $content . $last_date. " numrows = ".mysqli_num_rows($result);
			}
			if ( $n == mysqli_num_rows($result) ) {
				$bottom_date = $row['date'];
			}
		}
		$n = Array(
			'last_date' => $last_date,
			'bottom_date' => $bottom_date,
			'html' => $content
		);
		echo json_encode($n);
		return;
		
	} else
	if ( $last_date != '' ) {
		$query = "SELECT * FROM synopsis_log a, user_activation b WHERE a.editor_fb_id=b.fb_id AND date > '".$last_date."'";
		//echo $query;
	} else
		$query = "SELECT * FROM synopsis_log a, user_activation b WHERE a.editor_fb_id=b.fb_id ORDER BY date DESC LIMIT 1";

	$result = $mysql->query($query);
	if ( $last_date != '' ) {
//		echo $query."<br>";
//		print_r($row);
	}
	if ( mysqli_num_rows($result) != 0 ) {
		$row = mysqli_fetch_array($result);
		$word = getWord($row, $dir);	
		if ( $row['editor_fb_id'] === '1192425363' ) {
			$row['editor_fb_id'] = 'airabooks';
			$row['fb_name'] = 'airabooks';
		}
		$n = Array (
			'last_date' => $row['date'],
			'html' => "<img src='http://graph.facebook.com/".$row['editor_fb_id']."/picture' width='30px'
				style='margin: 0 5px 0 0;float:left;display:table;'
			>
			<span style='font-weight:bold; float:left;'><a href='http://facebook.com/".$row['editor_fb_id']."'>".$row['fb_name']."</a></span>"."<span>&nbsp".$word."</span>"
		);
		echo json_encode($n);
		return;
	}
	echo '';

?>
