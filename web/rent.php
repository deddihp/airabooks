<?php
//include "mysql_comic.php";
function getYoutubeURL2($code) {
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$query = "SELECT YoutubeURL FROM book_add_info WHERE code='".$code."'";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['YoutubeURL'];
	}
	
function selectRecommend2($code, $width_star) {
		//get max
		$query = "select max(rating) as max from book_title";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$max = $row['max'];
		
		$query = "select distinct(rating) as jumlah from book_title where code='".$code."'";
		//echo "QUERY = ".$query;
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$jumlah = $row['jumlah'];
		//echo "JUmlah = ".$jumlah."<br> Max = ".$max;
		
		$per = ($jumlah/$max)*$width_star;
		//echo "Per = ".$per."<br>";
		$pop = Array( $jumlah, ceil($per) );
		return $pop;
	}

function selectPopularity2($code, $width_star) {
		//get max
		$query = "select max(jumlah) as max from temp_table";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$max = $row['max'];
		
		$query = "select distinct(jumlah) as jumlah from temp_table where code='".$code."'";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$jumlah = $row['jumlah'];
		$per = ($jumlah/$max)*$width_star;
		$pop = Array( $jumlah, ceil($per) );
		return $pop;
	}
//class CommonLayout {
	function createBookBox2($code, $title, $content, $rating, $fb, $add, $like_rating, $synopsis, $isyoutube) {
		echo "<div class=\"bookbox\" id=\"imgcon\">\n";
			if ( $add != "" )
				echo "<p>".$add."</p>";
		echo	"<p><a href=\"bookdetail.php?code=".
				$code."\">";
			echo $title;
			echo "</a></p>";
			
			$imgcover = "cover_small/".$code.".jpg";
			if ( file_exists($imgcover) == false )
				$imgcover = "cover_small/nophoto.png";
			echo "<img src=\"".$imgcover."\" width=80px height=105px>";
		
			echo "<ul>";
				for ( $i = 0; $i < count($content); $i++ ) {
					echo "<li><span>".$content[$i]."</span></li>\n";
				}
			echo "</ul>";
			echo "\n<div id=\"star\">
 				\n<ul id=\"star0\" class=\"star\">
  				\n<li id=\"starCur0\" class=\"curr\" title=\"9\" style=\"width: ".$rating[1]."px;\"></li>
 				\n</ul></div>";
			echo "<div id=\"likerating\">
 				\n<ul id=\"star0\" class=\"star\">
  				\n<li id=\"starCur0\" class=\"curr\" title=\"9\" style=\"width: ".$like_rating[1]."px;\"></li>
 				\n</ul></div>";
			
			//echo $link_late;
			echo "<div class=\"rate\">";
				if ( $fb->userstatus == 'ADMIN' ) 
					echo "<span><a onclick=\"fbLikeClick()\" href=uploadpic.php?bookcode=".$code."&title=".str_replace(' ', '%20', $title)."><br>Upload Gambar</a></span>";
				//if ( $fb->fb_user == true )
					echo $fb->writeLikeButton($code);
					if ( $synopsis != "" )
						echo "<img src=\"images/paper.png\">";
					if ( $isyoutube != "" )
						echo "<img src=\"images/smallyoutube.png\" width=20px>";
			
			echo "</div>";	
		echo	"</div>";
	
	}
//}



class RentInfo {
	function __construct(){
	}
	function __destruct() {
	}
	function countRentInfo($search, $code) {
		$query = "select COUNT(*) as count from book a, rent b, book_title c  where a.book_id=b.book_id and a.code=c.code ";
		
		if ( $search != "" ) 
			$query = $query." and c.title LIKE '%".$search."%' ";

		if ( $code != "" )
			$query = $query." and c.code='".$code."' ";

		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}

	function selectSubscriberName($idsubs) {
		$query = "select full_name from subscriber where subscriber_id='".$idsubs."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['full_name'];
	}
	function selectRentInfo($search, $code, $sorting, $offset, $num_rows) {
		$query = "select c.code, c.title, a.volume, b.subscriber_id, DATE_FORMAT(b.rent_date, '%d %M %Y') as rent_date, DATE_FORMAT(DATE_ADD(b.rent_date, interval b.rent_duration day), '%d %M %Y') as return_date, b.rent_duration, DATEDIFF(NOW(), DATE_ADD(b.rent_date, interval b.rent_duration day)) as late, c.synopsis  from book a, rent b, book_title c  where a.book_id=b.book_id and a.code=c.code ";
		if ( $search != "" )
			$query = $query." and c.title LIKE '%".$search."%' ";

		if ( $code != "" )
			$query = $query." and c.code='".$code."' ";
		$query = $query." order by b.rent_date ".$sorting.", c.title, 00000+ltrim(a.volume) limit ".$num_rows." offset ".$offset;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		return $result;
	}

	function countRentToday() {
		$query = "select COUNT(*) as count  from book a, rent b, book_title c  where b.rent_date = (select DATE(NOW())) and a.book_id=b.book_id and a.code=c.code ";
		if ( $search != "" )
			$query = $query." and c.title LIKE '%".$search."%' ";

		if ( $code != "" )
			$query = $query." and c.code='".$code."' ";
		//$query = $query." order by b.rent_date ".$sorting.", c.title, 00000+ltrim(a.volume) limit ".$num_rows." offset ".$offset;
		
//		echo "QUERY = ". $query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function selectRentToday($offset, $num_rows) {
		$query = "select c.code, c.title, a.volume, b.subscriber_id, DATE_FORMAT(b.rent_date, '%d %M %Y') as rent_date, DATE_FORMAT(DATE_ADD(b.rent_date, interval b.rent_duration day), '%d %M %Y') as return_date, b.rent_duration, DATEDIFF(NOW(), DATE_ADD(b.rent_date, interval b.rent_duration day)) as late,  c.synopsis from book a, rent b, book_title c  where b.rent_date = (select DATE(NOW())) and a.book_id=b.book_id and a.code=c.code ";
		if ( $search != "" )
			$query = $query." and c.title LIKE '%".$search."%' ";

		if ( $code != "" )
			$query = $query." and c.code='".$code."' ";
		$query = $query." order by b.rent_date ".$sorting.", c.title, 00000+ltrim(a.volume) limit ".$num_rows." offset ".$offset;
		
//		echo "QUERY = ". $query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		return $result;
	}

	function countRentHistoryToday() {
		$query = "select COUNT(*) as count  from book a, rent_history b, book_title c  where DATE_ADD(b.return_date, interval b.late_duration day) = (select DATE(NOW())) and a.book_id=b.book_id and a.code=c.code ";
		if ( $search != "" )
			$query = $query." and c.title LIKE '%".$search."%' ";

		if ( $code != "" )
			$query = $query." and c.code='".$code."' ";
		//$query = $query." order by b.rent_date ".$sorting.", c.title, 00000+ltrim(a.volume) limit ".$num_rows." offset ".$offset;
		
		//echo "QUERY = ". $query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	

	function selectRentHistoryToday($offset, $num_rows) {
		$query = "select c.code, c.title, a.volume, b.subscriber_id, DATE_FORMAT(b.rent_date, '%d %M %Y') as rent_date, DATE_FORMAT(DATE_ADD(b.return_date, interval b.late_duration day), '%d %M %Y') as return_date, b.rent_duration, DATEDIFF(NOW(), DATE_ADD(b.rent_date, interval b.rent_duration day)) as late  from book a, rent_history b, book_title c  where DATE_ADD(b.return_date, interval b.late_duration day) = (select DATE(NOW())) and a.book_id=b.book_id and a.code=c.code ";
		if ( $search != "" )
			$query = $query." and c.title LIKE '%".$search."%' ";

		if ( $code != "" )
			$query = $query." and c.code='".$code."' ";
		$query = $query." order by b.rent_date ".$sorting.", c.title, 00000+ltrim(a.volume) limit ".$num_rows." offset ".$offset;
		
		echo "QUERY = ". $query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		return $result;
	}
	
	function selectRentInfoBySubs($subsid) {
		$query = "select c.code, c.title, a.volume, b.subscriber_id, DATE_FORMAT(b.rent_date, '%d %M %Y') as rent_date, DATE_FORMAT(DATE_ADD(b.rent_date, interval b.rent_duration day), '%d %M %Y') as return_date, b.rent_duration, DATEDIFF(NOW(), DATE_ADD(b.rent_date, interval b.rent_duration day)) as late, d.full_name, c.synopsis  from book a, rent b, book_title c, subscriber d  where a.book_id=b.book_id and a.code=c.code and d.subscriber_id=b.subscriber_id ";
		$query = $query." and d.subscriber_id='".$subsid."' ";
		
		$query = $query." order by b.rent_date, c.title, 00000+ltrim(a.volume)";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		return $result;
	}




	function showFilter() {
		$genre_filter = $_GET['genre'];
		$status_filter = $_GET['status'];
		$view = $_GET['view'];
		$search = $_GET['search'];
		$sorting = $_GET['sorting'];
		$genre_list = array(
			'Semua',
			'Adventure Fantasy',
			'Drama',
			'Romance',
			'Action',
			'Comedy',
			'History',
			'Detective',
			'Mystery',
			'Sport',
		);
		$status_list = array(
			'Semua',
			'Bersambung',
			'Tamat'
		);
	
		if ( $sorting == "" )
			$sorting = "Berdasarkan Tanggal Terbaru";
		echo "	
		<form name=\"filter\" method=\"get\" action=\"rentinfo.php\">
				<p class=\"pfilter\">
					<input type=\"hidden\" name=\"view\" value=\"".$view."\">
					Urutkan
					<select class=\"filtersubmit\" name=\"sorting\">";
						if ( $sorting == "Berdasarkan Tanggal Terbaru" ) {
							echo "<option selected=\"selected\">Berdasarkan Tanggal Terbaru</option>";
							echo "<option>Berdasarkan Tanggal Terlama</option>";
						} else {
							echo "<option>Berdasarkan Tanggal Terbaru</option>";
							echo "<option selected=\"selected\">Berdasarkan Tanggal Terlama</option>";
						}
		echo "		</select>
					&nbsp;&nbsp;&nbsp;&nbsp;Search
					<input class=\"filtertext\" type=\"text\" name=\"search\" value=\"".$search."\">
					<input class=\"filtersubmit\" type=\"submit\" name=\"submit\" value=\"search\">
				</p>
				</form>";
	}

	function showHTML($fb) {
		$code = $_GET['code'];
		$act = $_GET['act'];
		$view = $_GET['view'];
		$sorting = $_GET['sorting'];	
		if ( $view == "" )
			$view = "iconview";

		if ( $act == "<" )
			$curOffset = $_GET['prevOffset'];
		else
			$curOffset = $_GET['nextOffset'];
		if ( $curOffset == "" )
			$curOffset = 1;

		$offset = $curOffset-1;
		if ( $view == "listview" )
			$num_rows = 50;
		else
			$num_rows = 12;

		if ( $status_filter == "Semua" )
			$status_filter = "";
		else if ( $status_filter == "Tamat" )
			$status_filter = "END";
		else if ( $status_filter == "Bersambung" )
			$status_filter = "ON GOING";
		if ( $genre_filter == "Semua" )
			$genre_filter = "";
	
		if ( $sorting == "Berdasarkan Tanggal Terbaru" || $sorting == "" )
			$sorting = "desc";
		else
			$sorting = "asc";
		$numbook = $this->countRentInfo($_GET['search'], $_GET['code']);
		$result = $this->selectRentInfo($_GET['search'], $_GET['code'], $sorting, $offset, $num_rows);
		echo "
		<form name=\"prevnext\" action=\"rentinfo.php\" method=\"get\">";
		echo "\n <input type=\"hidden\" name=\"code\" value=\"".$code."\">";
		echo "\n<input type=\"hidden\" name=\"sorting\" value=\"".$sorting."\">";
		echo "\n<input type=\"hidden\" name=\"view\" value=\"".$view."\">";
		echo "\n<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">";
		echo "\n<input type=\"hidden\" name=\"status\" value=\"".$_GET['status']."\">";
		echo "\n<input type=\"hidden\" name=\"search\" value=\"".$_GET['search']."\">";
		echo "
							<input type=\"hidden\" name=\"prevOffset\" value=";
								$prev = ($curOffset - $num_rows);
								if ( $prev < 1 )
									$prev = 1;
								echo "\"".$prev."\"";
		echo ">";
		echo "				
							<input type=\"hidden\" name=\"nextOffset\" value=";
							
								$next = ($curOffset + $num_rows);
								if ( $next > $numbook )
									$next = $curOffset;
								echo "\"".$next."\"";
		echo ">";
		echo "<p class=\"formstyle\">";
		echo "
							<input class=\"button\" type=\"submit\" name=\"act\" value=\"<\">";
							
							$maxnum = ($curOffset + ($num_rows-1));
							if ( $maxnum > $numbook )
								$maxnum = $numbook;
							echo $curOffset." - ".$maxnum." of ".$numbook;
		echo "					
							<input class=\"button\" type=\"submit\" name=\"act\" value=\">\">";
		echo "</p>";
		echo "			</form>";
		

		echo "
		<div class=\"view-noborder\"></div>
		<p class=\"h2view\">Info Peminjaman</p>
		<div class=\"view\">";
			if ( $view == "iconview" ) {
				echo "<a href=rentinfo.php?view=iconview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/icon_view_push.png\" width=30px height=30px></a>";
				echo "<a href=rentinfo.php?view=listview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/list_view.png\" width=30px height=30px></a>";
			} else {
				echo "<a href=rentinfo.php?view=iconview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/icon_view.png\" width=30px height=30px></a>";
				echo "<a href=rentinfo.php?view=listview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/list_view_push.png\" width=30px height=30px></a>";
			}
		echo "</div>";
	
		if ( $view == "iconview" ) {
			$count = 0;
			while ( $row = mysqli_fetch_array($result) ) {
				$vol = "";
				if ( $row['volume'] != "ONESHOT" && $row['volume'] != "NOVEL" )
					$vol = $row['volume'];
				else
					$vol = "(".$row['volume'].")";
				
				$pop = selectPopularity2($row['code'], 85);
				$pop2 = selectRecommend2($row['code'], 85);			
				$content[0] = "Tanggal Pinjam : ".$row['rent_date'];
				$content[1] = "Tanggal Pengembalian : ".$row['return_date'];
				$rr = $row['late'];
				if ( $rr < 0 )
					$rr = 0;
				$link_late = "";				
				if ( $row['late'] > 0 )
					if ( $fb->synchstatus == 'ACTIVE' )
						$link_late = "<a href=whorentthis.php?idsubs=".$row['subscriber_id'].">siapa ?</a>";
					else
						$link_late = "<a href=membersonly.php?msg=Hanya%20anggota%20airabooks%20yang%20diperbolehkan%20melihat%20peminjam>siapa ?</a>";
				$content[2] = "Telat : ".$rr." hari ".$link_late."";					
				
				echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
				echo $row['code'];
				echo "</p>\n";
				
				$youtubeURL = getYoutubeURL2($row['code']);

				createBookBox2($row['code'], $row['title']." ".$vol, $content, $pop, $fb, "", $pop2, $row['synopsis'], $youtubeURL);
				continue;
				$vol = "";
				if ( $row['volume'] != "ONESHOT" && $row['volume'] != "NOVEL" )
					$vol = $row['volume'];
				else
					$vol = "(".$row['volume'].")";
				echo "<div class=\"bookbox\" id=\"imgcon\">
								<p><a href=\"bookdetail.php?code=".
								$row['code']."\">".$row['title']." ".$vol."</a></p>";
								$imgcover = "cover_small/".$row['code'].".jpg";
								if ( file_exists($imgcover) == false )
									$imgcover = "cover_small/nophoto.png";
								echo "<img src=\"".$imgcover."\" width=80px height=105px>";
								//echo "<span>Episode : ".$row['volume']."</span><br>
								echo "<ul><li><span>Tanggal Pinjam : ".$row['rent_date']."</span></li>
								<li><span>Tanggal Pengembalian : ".$row['return_date']."</span></li>";
								
								$rr = $row['late'];
								if ( $rr < 0 )
									$rr = 0;
								echo "<li><span>Telat : ".$rr." hari</span></li>";
								
								if ( $row['late'] > 0 )
									if ( $fb->synchstatus == 'ACTIVE' )
										echo "<span><a href=whorentthis.php?idsubs=".$row['subscriber_id'].">siapa ?</a></span>";
									else
										echo "<span><a href=membersonly.php?msg=Hanya%20anggota%20airabooks%20yang%20diperbolehkan%20melihat%20peminjam>siapa ?</a></span>";
									
								if ( $fb->userstatus == 'ADMIN' ) 
									echo "<span><a onclick=\"fbLikeClick()\" href=uploadpic.php?bookcode=".$row['code']."&title=".str_replace(' ', '%20', $row['title']).">Upload Gambar</a></span>";
								echo $fb->writeLikeButton($row['code']);
							echo "</ul></div>";
			}
			echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				
		} else {
		echo "	<br><br><br>				<table>
								<tr class=\"title\"  align=center>
									<td class=\"small\">
									<span class=\"tname\">No.</span>
									</td>
									<td class=\"big\">
									<span class=\"tname\">Judul</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Episode</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pinjam</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pengembalian</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Telat</span>
									</td>
								</tr>";
								//$author = new Author();
								//$result = $this->selectBookTitle($status_filter, $genre_filter, $search, $offset, $num_rows);
								$i = $offset+1;
								$count = 0;
								while ( $row = mysqli_fetch_array($result) ) {
									echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
									
									
									if ( $i % 2 == 0 )
										echo "<tr class=\"one\" align=left>";
									else
										echo "<tr class=\"two\" align=left>";
									echo "<td><span class=\"cname\">".$i++.".</span></td>";
									echo "<td><span class=\"cname\">";
									echo "<a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a>";
									echo "</span></td>";
									echo "<td><span class=\"cname\">".$row['volume']."</span></td>";
									echo "<td><span class=\"cname\">".$row['rent_date']."</span></td>";
									echo "<td><span class=\"cname\">".$row['return_date']."</span></td>";
									$status = $row['late'];
									if ( $status <= 0 ) {
										$status = "0 hari";
										$spantype = "cname";
									}
									else {
										$spantype = "rname";
										$status = $status." hari<br>";
										if ( $row['late'] > 0 )
											if ( $fb->synchstatus == 'ACTIVE' )
												$status = $status."<a href=whorentthis.php?idsubs=".$row['subscriber_id'].">siapa ?</a>";
											else
												$status = $status."<a href=membersonly.php?msg=Hanya%20anggota%20airabooks%20yang%20diperbolehkan%20melihat%20peminjam>siapa ?</a>";
									
										//<a href=\"whorentthis.php?idsubs=".$row['subscriber_id']."\">(siapa?)</a>";
									}
									echo "<td><span class=\"".$spantype."\">".$status."</span></td>";
									echo "</tr>";
								}
								echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				

							echo "</table>";
		
				}
	}

	function showRentToday($fb) {
		$act = $_GET['act'];
		$view = $_GET['view'];
		$sorting = $_GET['sorting'];	
		if ( $view == "" )
			$view = "iconview";

		if ( $act == "<" )
			$curOffset = $_GET['prevOffset'];
		else
			$curOffset = $_GET['nextOffset'];
		if ( $curOffset == "" )
			$curOffset = 1;

		$offset = $curOffset-1;
		if ( $view == "listview" )
			$num_rows = 50;
		else
			$num_rows = 12;

		if ( $status_filter == "Semua" )
			$status_filter = "";
		else if ( $status_filter == "Tamat" )
			$status_filter = "END";
		else if ( $status_filter == "Bersambung" )
			$status_filter = "ON GOING";
		if ( $genre_filter == "Semua" )
			$genre_filter = "";
	
		if ( $sorting == "Berdasarkan Tanggal Terbaru" || $sorting == "" )
			$sorting = "desc";
		else
			$sorting = "asc";
		$numbook = $this->countRentToday();
		if ( $numbook == "" )
			$numbook = 0;
		$result = $this->selectRentToday($offset, $num_rows);
		echo "
		<form name=\"prevnext\" action=\"renttoday.php\" method=\"get\">";
		echo "\n<input type=\"hidden\" name=\"sorting\" value\"".$sorting."\">";
		echo "\n<input type=\"hidden\" name=\"view\" value=\"".$view."\">";
		echo "\n<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">";
		echo "\n<input type=\"hidden\" name=\"status\" value=\"".$_GET['status']."\">";
		echo "\n<input type=\"hidden\" name=\"search\" value=\"".$_GET['search']."\">";
		echo "
							<input type=\"hidden\" name=\"prevOffset\" value=";
								$prev = ($curOffset - $num_rows);
								if ( $prev < 1 )
									$prev = 1;
								echo "\"".$prev."\"";
		echo ">";
		echo "				
							<input type=\"hidden\" name=\"nextOffset\" value=";
							
								$next = ($curOffset + $num_rows);
								if ( $next > $numbook )
									$next = $curOffset;
								echo "\"".$next."\"";
		echo ">";
		echo "<p class=\"formstyle\">";
		echo "
							<input class=\"button\" type=\"submit\" name=\"act\" value=\"<\">";
							
							$maxnum = ($curOffset + ($num_rows-1));
							if ( $maxnum > $numbook )
								$maxnum = $numbook;
							echo $curOffset." - ".$maxnum." of ".$numbook;
		echo "					
							<input class=\"button\" type=\"submit\" name=\"act\" value=\">\">";
		echo "</p>";
		echo "			</form>";
		
		echo "
		<div class=\"view-noborder\"></div>
		<p class=\"h2view\">Buku Yang Dipinjam Hari Ini</p>
		<div class=\"view\">";
			if ( $view == "iconview" ) {
				echo "<a href=renttoday.php?view=iconview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/icon_view_push.png\" width=30px height=30px></a>";
				echo "<a href=renttoday.php?view=listview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/list_view.png\" width=30px height=30px></a>";
			} else {
				echo "<a href=renttoday.php?view=iconview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/icon_view.png\" width=30px height=30px></a>";
				echo "<a href=renttoday.php?view=listview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/list_view_push.png\" width=30px height=30px></a>";
			}
		echo "</div>";
	
		if ( $view == "iconview" ) {
			$count = 0;
			while ( $row = mysqli_fetch_array($result) ) {
				$vol = "";
				if ( $row['volume'] != "ONESHOT" && $row['volume'] != "NOVEL" )
					$vol = $row['volume'];
				else
					$vol = "(".$row['volume'].")";
				$pop = selectPopularity2($row['code'], 85);
				$pop2 = selectRecommend2($row['code'], 85);	
				$content[0] = "Tanggal Pinjam : ".$row['rent_date'];
				$content[1] = "Tanggal Pengembalian : ".$row['return_date'];
				
				echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
				echo $row['code'];
				echo "</p>\n";
				$youtubeURL = getYoutubeURL2($row['code']);
				createBookBox2($row['code'], $row['title']." ".$vol, $content, $pop, $fb, "", $pop2, $row['synopsis'], $youtubeURL);
				
				continue;
				$vol = "";
				if ( $row['volume'] != "ONESHOT" && $row['volume'] != "NOVEL" )
					$vol = $row['volume'];
				else
					$vol = "(".$row['volume'].")";
				echo "<div class=\"bookbox\" id=\"imgcon\">
								<p><a href=\"bookdetail.php?code=".
								$row['code']."\">".$row['title']." ".$vol."</a></p>";
								$imgcover = "cover_small/".$row['code'].".jpg";
								if ( file_exists($imgcover) == false )
									$imgcover = "cover_small/nophoto.png";
								echo "<img src=\"".$imgcover."\" width=80px height=105px>";
								//echo "<span>Episode : ".$row['volume']."</span><br>
								echo "<ul><li><span>Tanggal Pinjam : ".$row['rent_date']."</span></li>
								<li><span>Tanggal Pengembalian : ".$row['return_date']."</span></li>";
							/*	
								$rr = $row['late'];
								if ( $rr < 0 )
									$rr = 0;
								echo "<li><span>Telat : ".$rr." hari</span></li>";
								
								if ( $row['late'] > 0 )
									if ( $fb->synchstatus == 'ACTIVE' )
										echo "<span><a href=whorentthis.php?idsubs=".$row['subscriber_id'].">siapa ?</a></span>";
									else
										echo "<span><a href=membersonly.php?msg=Hanya%20anggota%20airabooks%20yang%20diperbolehkan%20melihat%20peminjam>siapa ?</a></span>";
								*/
								if ( $fb->userstatus == 'ADMIN' ) 
									echo "<span><a onclick=\"fbLikeClick()\" href=uploadpic.php?bookcode=".$row['code']."&title=".str_replace(' ', '%20', $row['title']).">Upload Gambar</a></span>";
								echo $fb->writeLikeButton($row['code']);
								
							echo "</ul></div>";
			}
			echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				

		} else {
		echo "	<br><br><br>				<table>
								<tr class=\"title\"  align=center>
									<td class=\"small\">
									<span class=\"tname\">No.</span>
									</td>
									<td class=\"big\">
									<span class=\"tname\">Judul</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Episode</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pinjam</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pengembalian</span>
									</td>
								<!--	<td class=\"middle\">
										<span class=\"tname\">Telat</span>
									</td>-->
								</tr>";
								//$author = new Author();
								//$result = $this->selectBookTitle($status_filter, $genre_filter, $search, $offset, $num_rows);
								$i = $offset+1;
								$count = 0;
								while ( $row = mysqli_fetch_array($result) ) {
									echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
									
									
									if ( $i % 2 == 0 )
										echo "<tr class=\"one\" align=left>";
									else
										echo "<tr class=\"two\" align=left>";
									echo "<td><span class=\"cname\">".$i++.".</span></td>";
									echo "<td><span class=\"cname\">";
									echo "<a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a>";
									echo "</span></td>";
									echo "<td><span class=\"cname\">".$row['volume']."</span></td>";
									echo "<td><span class=\"cname\">".$row['rent_date']."</span></td>";
									echo "<td><span class=\"cname\">".$row['return_date']."</span></td>";
									/*$status = $row['late'];
									if ( $status <= 0 ) {
										$status = "0 hari";
										$spantype = "cname";
									}
									else {
										$spantype = "rname";
										$status = $status." hari<br>";
										if ( $row['late'] > 0 )
											if ( $fb->synchstatus == 'ACTIVE' )
												$status = $status."<a href=whorentthis.php?idsubs=".$row['subscriber_id'].">siapa ?</a>";
											else
												$status = $status."<a href=membersonly.php?msg=Hanya%20anggota%20airabooks%20yang%20diperbolehkan%20melihat%20peminjam>siapa ?</a>";
									
										//<a href=\"whorentthis.php?idsubs=".$row['subscriber_id']."\">(siapa?)</a>";
									}*/
									//echo "<td><span class=\"".$spantype."\">".$status."</span></td>";
									echo "</tr>";
								}
							echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				

							echo "</table>";
		
				}
	}

	function showReturnToday($fb) {
		$act = $_GET['act'];
		$view = $_GET['view'];
		$sorting = $_GET['sorting'];	
		if ( $view == "" )
			$view = "iconview";

		if ( $act == "<" )
			$curOffset = $_GET['prevOffset'];
		else
			$curOffset = $_GET['nextOffset'];
		if ( $curOffset == "" )
			$curOffset = 1;

		$offset = $curOffset-1;
		if ( $view == "listview" )
			$num_rows = 50;
		else
			$num_rows = 12;

		if ( $status_filter == "Semua" )
			$status_filter = "";
		else if ( $status_filter == "Tamat" )
			$status_filter = "END";
		else if ( $status_filter == "Bersambung" )
			$status_filter = "ON GOING";
		if ( $genre_filter == "Semua" )
			$genre_filter = "";
	
		if ( $sorting == "Berdasarkan Tanggal Terbaru" || $sorting == "" )
			$sorting = "desc";
		else
			$sorting = "asc";
		$numbook = $this->countRentHistoryToday();
		$result = $this->selectRentHistoryToday($offset, $num_rows);
		echo "
		<form name=\"prevnext\" action=\"returntoday.php\" method=\"get\">";
		echo "\n<input type=\"hidden\" name=\"sorting\" value\"".$sorting."\">";
		echo "\n<input type=\"hidden\" name=\"view\" value=\"".$view."\">";
		echo "\n<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">";
		echo "\n<input type=\"hidden\" name=\"status\" value=\"".$_GET['status']."\">";
		echo "\n<input type=\"hidden\" name=\"search\" value=\"".$_GET['search']."\">";
		echo "
							<input type=\"hidden\" name=\"prevOffset\" value=";
								$prev = ($curOffset - $num_rows);
								if ( $prev < 1 )
									$prev = 1;
								echo "\"".$prev."\"";
		echo ">";
		echo "				
							<input type=\"hidden\" name=\"nextOffset\" value=";
							
								$next = ($curOffset + $num_rows);
								if ( $next > $numbook )
									$next = $curOffset;
								echo "\"".$next."\"";
		echo ">";
		echo "<p class=\"formstyle\">";
		echo "
							<input class=\"button\" type=\"submit\" name=\"act\" value=\"<\">";
							
							$maxnum = ($curOffset + ($num_rows-1));
							if ( $maxnum > $numbook )
								$maxnum = $numbook;
							echo $curOffset." - ".$maxnum." of ".$numbook;
		echo "					
							<input class=\"button\" type=\"submit\" name=\"act\" value=\">\">";
		echo "</p>";
		echo "			</form>";
		

		echo "
		<div class=\"view-noborder\"></div>
		<p class=\"h2view\">Buku Yang Sudah Dikembalikan Hari Ini</p>
		<div class=\"view\">";
			if ( $view == "iconview" ) {
				echo "<a href=returntoday.php?view=iconview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/icon_view_push.png\" width=30px height=30px></a>";
				echo "<a href=returntoday.php?view=listview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/list_view.png\" width=30px height=30px></a>";
			} else {
				echo "<a href=returntoday.php?view=iconview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/icon_view.png\" width=30px height=30px></a>";
				echo "<a href=returntoday.php?view=listview&search=".$_GET['search']."&sorting=".str_replace(' ','+', $_GET['sorting'])."><img src=\"images/list_view_push.png\" width=30px height=30px></a>";
			}
		echo "</div>";
	
		if ( $view == "iconview" ) {
			while ( $row = mysqli_fetch_array($result) ) {
				$vol = "";
				if ( $row['volume'] != "ONESHOT" && $row['volume'] != "NOVEL" )
					$vol = $row['volume'];
				else
					$vol = "(".$row['volume'].")";
				echo "<div class=\"bookbox\" id=\"imgcon\">
								<p><a href=\"bookdetail.php?code=".
								$row['code']."\">".$row['title']." ".$vol."</a></p>";
								$imgcover = "cover_small/".$row['code'].".jpg";
								if ( file_exists($imgcover) == false )
									$imgcover = "cover_small/nophoto.png";
								echo "<img src=\"".$imgcover."\" width=80px height=105px>";
								//echo "<span>Episode : ".$row['volume']."</span><br>
								echo "<ul><li><span>Tanggal Pinjam : ".$row['rent_date']."</span></li>
								<li><span>Tanggal Pengembalian : ".$row['return_date']."</span></li>";
								
								$rr = $row['late'];
								if ( $rr < 0 )
									$rr = 0;
								echo "<li><span>Telat : ".$rr." hari</span></li>";
								
								if ( $row['late'] > 0 )
									if ( $fb->synchstatus == 'ACTIVE' )
										echo "<span><a href=whorentthis.php?idsubs=".$row['subscriber_id'].">siapa ?</a></span>";
									else
										echo "<span><a href=membersonly.php?msg=Hanya%20anggota%20airabooks%20yang%20diperbolehkan%20melihat%20peminjam>siapa ?</a></span>";
									
							echo "</ul></div>";
			}	
		} else {
		echo "	<br><br><br>				<table>
								<tr class=\"title\"  align=center>
									<td class=\"small\">
									<span class=\"tname\">No.</span>
									</td>
									<td class=\"big\">
									<span class=\"tname\">Judul</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Episode</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pinjam</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pengembalian</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Telat</span>
									</td>
								</tr>";
								//$author = new Author();
								//$result = $this->selectBookTitle($status_filter, $genre_filter, $search, $offset, $num_rows);
								$i = $offset+1;
								while ( $row = mysqli_fetch_array($result) ) {
									if ( $i % 2 == 0 )
										echo "<tr class=\"one\" align=left>";
									else
										echo "<tr class=\"two\" align=left>";
									echo "<td><span class=\"cname\">".$i++.".</span></td>";
									echo "<td><span class=\"cname\">";
									echo "<a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a>";
									echo "</span></td>";
									echo "<td><span class=\"cname\">".$row['volume']."</span></td>";
									echo "<td><span class=\"cname\">".$row['rent_date']."</span></td>";
									echo "<td><span class=\"cname\">".$row['return_date']."</span></td>";
									$status = $row['late'];
									if ( $status <= 0 ) {
										$status = "0 hari";
										$spantype = "cname";
									}
									else {
										$spantype = "rname";
										$status = $status." hari<br>";
										if ( $row['late'] > 0 )
											if ( $fb->synchstatus == 'ACTIVE' )
												$status = $status."<a href=whorentthis.php?idsubs=".$row['subscriber_id'].">siapa ?</a>";
											else
												$status = $status."<a href=membersonly.php?msg=Hanya%20anggota%20airabooks%20yang%20diperbolehkan%20melihat%20peminjam>siapa ?</a>";
									
										//<a href=\"whorentthis.php?idsubs=".$row['subscriber_id']."\">(siapa?)</a>";
									}
									echo "<td><span class=\"".$spantype."\">".$status."</span></td>";
									echo "</tr>";
								}
							echo "</table>";
		
				}
	}



	function showSubsRent() {
		$act = $_GET['act'];
	
		if ( $act == "<" )
			$curOffset = $_GET['prevOffset'];
		else
			$curOffset = $_GET['nextOffset'];
		if ( $curOffset == "" )
			$curOffset = 1;

		$offset = $curOffset-1;
		
		if ( $status_filter == "Semua" )
			$status_filter = "";
		else if ( $status_filter == "Tamat" )
			$status_filter = "END";
		else if ( $status_filter == "Bersambung" )
			$status_filter = "ON GOING";
		if ( $genre_filter == "Semua" )
			$genre_filter = "";

		//$numbook = $this->countRentInfo($_GET['search']);
		$result = $this->selectRentInfoBySubs($_GET['idsubs']);
		$fullname = $this->selectSubscriberName($_GET['idsubs']);
		echo "
		<p class=\"h2\">Detail Informasi Peminjaman</p>";
		echo "
		<p class=\"content\">
		ID : ".$_GET['idsubs']."<br>
		Nama : ".$fullname."<br> 
		Buku yang dipinjam :<br><br>
		</p>
		";
		
		echo "
							<table>
								<tr class=\"title\" align=center>
									<td class=\"small\">
									<span class=\"tname\">No.</span>
									</td>
									<td class=\"big\">
									<span class=\"tname\">Judul</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Episode</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pinjam</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pengembalian</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Telat</span>
									</td>
								</tr>";
								//$author = new Author();
								//$result = $this->selectBookTitle($status_filter, $genre_filter, $search, $offset, $num_rows);
								$i = $offset+1;
								while ( $row = mysqli_fetch_array($result) ) {
									if ( $i % 2 == 0 ) 
										echo "<tr class=\"one\" align=left>";
									else
										echo "<tr class=\"two\" align=left>";
									echo "<td><span class=\"cname\">".$i++.".</span></td>";
									echo "<td><span class=\"cname\">";
									echo "<a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a>";
									echo "</span></td>";
									echo "<td><span class=\"cname\">".$row['volume']."</span></td>";
									echo "<td><span class=\"cname\">".$row['rent_date']."</span></td>";
									echo "<td><span class=\"cname\">".$row['return_date']."</span></td>";
									$status = $row['late'];
									if ( $status <= 0 )
										$status = "0 hari";
									else {
										$status = $status." hari";
									}
									echo "<td><span class=\"cname\">".$status."</span></td>";
									echo "</tr>";
								}
							echo "</table>";
		


	}
}

class RentHistoryInfo {
	function __construct(){
	}
	function __destruct() {
	}
	function countRentInfo($search, $code) {
		$query = "select COUNT(*) as count from book a, rent_history b, book_title c  where a.book_id=b.book_id and a.code=c.code ";
		
		if ( $search != "" ) 
			$query = $query." and c.title LIKE '%".$search."%' ";

		if ( $code != "" )
			$query = $query." and c.code='".$code."' ";

		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}

	function selectSubscriberName($idsubs) {
		$query = "select full_name from subscriber where subscriber_id='".$idsubs."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['full_name'];
	}
	
	function useFilter($status_filter, $genre_filter, $category_filter, $search)
	{
		$query = "";
			if ( $status_filter != "" || $genre_filter != "" || $category_filter != "" || $search != "" )
			$query = $query." and ";

		if ( $search != "" )
			$query = $query."( title LIKE '%".$search."%' or author_name LIKE '%".$search."%' )";

		if ( ( $status_filter != "" || $genre_filter != "" || $category_filter != "" ) && $search != "" )
			$query = $query." and ";
		
		if ( $status_filter != "" && $genre_filter != "" && $category_filter != "" ) {
			$query = $query." status='".$status_filter."' and genre='".$genre_filter."' and ";
			if ( $category_filter == "Komik" )
				$query = $query."( c.category='A' or c.category='B')";
			else
				$query = $query."( c.category!='A' and c.category!='B' )";
		} else
		if ( $status_filter != "" && $genre_filter )
			$query = $query." status='".$status_filter."' and genre='".$genre_filter."' ";
		else if ( $status_filter != "" && $category_filter != "" ) {
			$query = $query." status='".$status_filter."' and ";
			if ( $category_filter == "Komik" )
				$query = $query."( c.category='A' or c.category='B')";
			else
				$query = $query."( c.category!='A' and c.category!='B' )";
		} else if ( $genre_filter != ""  && $category_filter != "" ) {
			$query = $query." c.genre='".$genre_filter."' and ";
			if ( $category_filter == "Komik" )
				$query = $query."( c.category='A' or c.category='B')";
			else
				$query = $query."( c.category!='A' and c.category!='B' )";
		}
		else if ( $status_filter != "" ) 
			$query = $query." status='".$status_filter."' ";
		else if ( $genre_filter != "" )
			$query = $query." genre='".$genre_filter."' ";
		else if ( $category_filter != "" ) {
			if ( $category_filter == "Komik" )
				$query = $query."( c.category='A' or c.category = 'B' )";
			else
				$query = $query."( c.category!='A' and c.category != 'B' )";
		}
		return $query;
	}


	
	function selectRentInfo($search, $code, $offset, $num_rows) {
		$query = "select c.code, c.title, a.volume, b.subscriber_id, DATE_FORMAT(b.rent_date, '%d %M %Y') as rent_date, DATE_FORMAT(DATE_ADD(b.rent_date, interval b.rent_duration day), '%d %M %Y') as return_date, b.rent_duration, DATEDIFF(NOW(), DATE_ADD(b.rent_date, interval b.rent_duration day)) as late  from book a, rent_history b, book_title c  where a.book_id=b.book_id and a.code=c.code ";
		if ( $search != "" )
			$query = $query." and c.title LIKE '%".$search."%' ";

		if ( $code != "" )
			$query = $query." and c.code='".$code."' ";
		$query = $query." order by b.rent_date, c.title, 00000+ltrim(a.volume) limit ".$num_rows." offset ".$offset;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		return $result;
	}

	function countRentInfoBySubs($status_filter, $genre_filter, $category_filter, $search, $subsid, $offset, $num_rows)
	{
		$query = "select COUNT(*) as count  from book a, rent_history b, book_title c, subscriber d  where a.book_id=b.book_id and a.code=c.code and d.subscriber_id=b.subscriber_id ";
		$query = $query." and d.subscriber_id='".$subsid."' ";
	
		$query = $query.$this->useFilter($status_filter, $genre_filter, $category_filter, $search);

		//echo "QUERY = ".$query;
		//$query = $query." order by b.rent_date, c.title, 00000+ltrim(a.volume) limit ".$num_rows." offset ".$offset;

		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	
	}

	function selectRentInfoBySubs($status_filter, $genre_filter, $category_filter, $search, $subsid, $offset, $num_rows) {
		$query = "select c.code, c.title, a.volume, b.subscriber_id, DATE_FORMAT(b.rent_date, '%d %M %Y') as rent_date, DATE_FORMAT(DATE_ADD(b.return_date, interval b.late_duration day), '%d %M %Y') as return_date, b.rent_duration, b.late_duration as late, d.full_name, c.synopsis  from book a, rent_history b, book_title c, subscriber d  where a.book_id=b.book_id and a.code=c.code and d.subscriber_id=b.subscriber_id ";
		$query = $query." and d.subscriber_id='".$subsid."' ";
	
		$query = $query.$this->useFilter($status_filter, $genre_filter, $category_filter, $search);

		$query = $query." order by b.rent_date, c.title, 00000+ltrim(a.volume) limit ".$num_rows." offset ".$offset;

		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		return $result;
	}

	function showFilter() {
		$genre_filter = $_GET['genre'];
		$status_filter = $_GET['status'];
		$search = $_GET['search'];
		$category_filter = $_GET['category'];
		$view = $_GET['view'];	
		$category_list = array (
			'Semua',
			'Komik',
			'Novel, Biografi, dll'
		);
		$genre_list = array(
			'Semua',
			'Adventure Fantasy',
			'Drama',
			'Romance',
			'Action',
			'Comedy',
			'History',
			'Detective',
			'Mystery',
			'Sport',
		);

		$status_list = array(
			'Semua',
			'Bersambung',
			'Tamat'
		);
		echo "	
		<form name=\"filter\" method=\"get\" action=\"userhistory.php\">
				<input type=\"hidden\" name=\"view\" value=\"".$view."\">
				<p class=\"pfilter\">
					Genre
					<select class=\"filtersubmit\" name=\"genre\">";
						foreach ($genre_list as &$value) {
							if ( $value == $genre_filter )
								echo "<option selected=\"selected\">".$value."</option>";
							else
								echo "<option>".$value."</option>";
						}
					echo "</select>
					&nbsp;&nbsp;&nbsp;&nbsp;Status
					<select class=\"filtersubmit\" name=\"status\">
					";
					foreach ($status_list as &$value ) {
						if ( $value == $status_filter )
							echo "<option selected=\"selected\">".$value."</option>";
						else
							echo "<option>".$value."</option>";
					}
					echo "</select>
					&nbsp;&nbsp;&nbsp;&nbsp;Kategori
					<select class=\"filtersubmit\" name=\"category\">
					";
					foreach ($category_list as &$value ) {
						if ( $value == $category_filter )
							echo "<option selected=\"selected\">".$value."</option>";
						else
							echo "<option>".$value."</option>";
					}
					echo "</select>

					&nbsp;&nbsp;&nbsp;&nbsp;Search
					<input class=\"filtertext\" type=\"text\" name=\"search\" value=\"".$search."\">
					<input class=\"filtersubmit\" type=\"submit\" name=\"submit\" value=\"search\">
				</p>
				</form>";
	}

	function showHTML() {
		$act = $_GET['act'];
		$view = $_GET['view'];
		
		if ( $view == "" )
			$view = "iconview";

		if ( $act == "<" )
			$curOffset = $_GET['prevOffset'];
		else
			$curOffset = $_GET['nextOffset'];
		if ( $curOffset == "" )
			$curOffset = 1;

		$offset = $curOffset-1;
		if ( $view == "listview" )
			$num_rows = 50;
		else
			$num_rows = 9;

		if ( $status_filter == "Semua" )
			$status_filter = "";
		else if ( $status_filter == "Tamat" )
			$status_filter = "END";
		else if ( $status_filter == "Bersambung" )
			$status_filter = "ON GOING";
		if ( $genre_filter == "Semua" )
			$genre_filter = "";

		$numbook = $this->countRentInfo($_GET['search'], $_GET['code']);
		$result = $this->selectRentInfo($_GET['search'], $_GET['code'], $offset, $num_rows);
		echo "
		<form name=\"prevnext\" action=\"rentinfo.php\" method=\"get\">";
		echo "\n<input type=\"hidden\" name=\"view\" value=\"".$view."\">";
		echo "\n<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">";
		echo "\n<input type=\"hidden\" name=\"status\" value=\"".$_GET['status']."\">";
		echo "\n<input type=\"hidden\" name=\"search\" value=\"".$_GET['search']."\">";
		echo "
							<input type=\"hidden\" name=\"prevOffset\" value=";
								$prev = ($curOffset - $num_rows);
								if ( $prev < 1 )
									$prev = 1;
								echo "\"".$prev."\"";
		echo ">";
		echo "				
							<input type=\"hidden\" name=\"nextOffset\" value=";
							
								$next = ($curOffset + $num_rows);
								if ( $next > $numbook )
									$next = $curOffset;
								echo "\"".$next."\"";
		echo ">";
		echo "<p class=\"formstyle\">";
		echo "
							<input class=\"button\" type=\"submit\" name=\"act\" value=\"<\">";
							
							$maxnum = ($curOffset + ($num_rows-1));
							if ( $maxnum > $numbook )
								$maxnum = $numbook;
							echo $curOffset." - ".$maxnum." of ".$numbook;
		echo "					
							<input class=\"button\" type=\"submit\" name=\"act\" value=\">\">";
		echo "</p>";
		echo "			</form>";
		

		echo "
		<div class=\"view-noborder\"></div>
		<p class=\"h2view\">Info Peminjaman</p>
		<div class=\"view\">";
			if ( $view == "iconview" ) {
				echo "<a href=rentinfo.php?view=iconview&search=".$_GET['search']."><img src=\"images/icon_view_push.png\" width=30px height=30px></a>";
				echo "<a href=rentinfo.php?view=listview&search=".$_GET['search']."><img src=\"images/list_view.png\" width=30px height=30px></a>";
			} else {
				echo "<a href=rentinfo.php?view=iconview&search=".$_GET['search']."><img src=\"images/icon_view.png\" width=30px height=30px></a>";
				echo "<a href=rentinfo.php?view=listview&search=".$_GET['search']."><img src=\"images/list_view_push.png\" width=30px height=30px></a>";
			}
		echo "</div>";
	
		if ( $view == "iconview" ) {
			$count = 0;
			while ( $row = mysqli_fetch_array($result) ) {
				$vol = "";
				if ( $row['volume'] != "ONESHOT" && $row['volume'] != "NOVEL" )
					$vol = $row['volume'];
				else
					$vol = "(".$row['volume'].")";
			
		

				$pop = selectPopularity2($row['code'], 85);
				$pop2 = selectRecommend2($row['code'], 85);			
				$content[0] = "Tanggal Pinjam : ".$row['rent_date'];
				
				$rr = $row['late'];
				if ( $rr < 0 )
					$rr = 0;

				$content[1] = "Telat : ".$rr." hari";
				

				echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
				echo $row['code'];
				echo "</p>\n";
				
				$youtubeURL = getYoutubeURL2($row['code']);

				createBookBox2($row['code'], $row['title']." ".$vol, $content, $pop, $fb, "", $pop2, $row['synopsis'], $youtubeURL);
				continue;
				echo "<div class=\"bookbox\" id=\"imgcon\">
								<p><a href=\"bookdetail.php?code=".
								$row['code']."\">".$row['title']." ".$vol."</a></p>";
								$imgcover = "cover_small/".$row['code'].".jpg";
								if ( file_exists($imgcover) == false )
									$imgcover = "cover_small/nophoto.png";
								echo "<img src=\"".$imgcover."\" width=80px height=105px>";
								//echo "<span>Episode : ".$row['volume']."</span><br>
								echo "<ul><li><span>Tanggal Pinjam : ".$row['rent_date']."</span></li>
								<li><span>Tanggal Pengembalian : ".$row['return_date']."</span></li>";
								
								$rr = $row['late'];
								if ( $rr < 0 )
									$rr = 0;
								echo "<li><span>Telat : ".$rr." hari</span></li>";
								
								if ( $row['late'] > 0 )
									echo "<span><a href=whorentthis.php?idsubs=".
									$row['subscriber_id'].">siapa ?</a></span>";
							echo "</ul></div>";
			}
				echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				
		} else {
		echo "	<br><br><br>				<table>
								<tr class=\"title\"  align=center>
									<td class=\"small\">
									<span class=\"tname\">No.</span>
									</td>
									<td class=\"big\">
									<span class=\"tname\">Judul</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Episode</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pinjam</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pengembalian</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Telat</span>
									</td>
								</tr>";
								//$author = new Author();
								//$result = $this->selectBookTitle($status_filter, $genre_filter, $search, $offset, $num_rows);
								$i = $offset+1;
								while ( $row = mysqli_fetch_array($result) ) {
									if ( $i % 2 == 0 )
										echo "<tr class=\"one\" align=left>";
									else
										echo "<tr class=\"two\" align=left>";
									echo "<td><span class=\"cname\">".$i++.".</span></td>";
									echo "<td><span class=\"cname\">";
									echo "<a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a>";
									echo "</span></td>";
									echo "<td><span class=\"cname\">".$row['volume']."</span></td>";
									echo "<td><span class=\"cname\">".$row['rent_date']."</span></td>";
									echo "<td><span class=\"cname\">".$row['return_date']."</span></td>";
									$status = $row['late'];
									if ( $status <= 0 ) {
										$status = "0 hari";
										$spantype = "cname";
									}
									else {
										$spantype = "rname";
										$status = $status." hari<br>
										<a href=\"whorentthis.php?idsubs=".$row['subscriber_id']."\">(siapa?)</a>";
									}
									echo "<td><span class=\"".$spantype."\">".$status."</span></td>";
									echo "</tr>";
								}
							echo "</table>";
		
				}
	}
	function showSubsRent($fb) {
		$idsubs = $fb->subscriber_id;
		$genre_filter = $_GET['genre'];
		$status_filter = $_GET['status'];
		$search = $_GET['search'];
		$category_filter = $_GET['category'];
		$view = $_GET['view'];
		$act = $_GET['act'];
		
		if ( $view == "" )
			$view = "iconview";


		if ( $act == "<" )
			$curOffset = $_GET['prevOffset'];
		else
			$curOffset = $_GET['nextOffset'];
		if ( $curOffset == "" )
			$curOffset = 1;

		$offset = $curOffset-1;
	
		if ( $view == "listview" )
			$num_rows = 50;
		else
			$num_rows = 12;



		if ( $status_filter == "Semua" )
			$status_filter = "";
		else if ( $status_filter == "Tamat" )
			$status_filter = "END";
		else if ( $status_filter == "Bersambung" )
			$status_filter = "ON GOING";
		if ( $genre_filter == "Semua" )
			$genre_filter = "";
		if ( $category_filter == "Semua" )
			$category_filter = "";
		
		$numbook = $this->countRentInfoBySubs($status_filter, $genre_filter, $category_filter, $search, $idsubs, $offset, $num_rows);
		$result = $this->selectRentInfoBySubs($status_filter, $genre_filter, $category_filter, $search, $idsubs, $offset, $num_rows);
		$fullname = $this->selectSubscriberName($idsubs);
		
		echo "
		<p class=\"h2\">Riwayat Peminjaman Anda</p>";
		echo "
		<p class=\"content\">
		ID : ".$idsubs."<br>
		Nama : ".$fullname."<br> 
		</p>
		";
		echo "
		<form name=\"prevnext\" action=\"userhistory.php\" method=\"get\">";
		echo "\n<input type=\"hidden\" name=\"view\" value=\"".$_GET['view']."\">";
		echo "\n<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">";
		echo "\n<input type=\"hidden\" name=\"status\" value=\"".$_GET['status']."\">";
		echo "\n<input type=\"hidden\" name=\"category\" value=\"".$_GET['category']."\">";
		echo "\n<input type=\"hidden\" name=\"search\" value=\"".$_GET['search']."\">";
		echo "
							<input type=\"hidden\" name=\"prevOffset\" value=";
								$prev = ($curOffset - $num_rows);
								if ( $prev < 1 )
									$prev = 1;
								echo "\"".$prev."\"";
		echo ">";
		echo "				
							<input type=\"hidden\" name=\"nextOffset\" value=";
							
								$next = ($curOffset + $num_rows);
								if ( $next > $numbook )
									$next = $curOffset;
								echo "\"".$next."\"";
		echo ">";
		echo "<p class=\"formstyle\">";
		echo "
							<input class=\"button\" type=\"submit\" name=\"act\" value=\"<\">";
							
							$maxnum = ($curOffset + ($num_rows-1));
							if ( $maxnum > $numbook )
								$maxnum = $numbook;
							echo $curOffset." - ".$maxnum." of ".$numbook;
		echo "					
							<input class=\"button\" type=\"submit\" name=\"act\" value=\">\">";
		echo "</p>";
		echo "			</form>";
		

		echo "
		<div class=\"view-noborder\"></div>
		<p class=\"h2view\"></p>
		<div class=\"view\">";
			if ( $view == "iconview" ) {
				echo "<a href=\"userhistory.php?view=iconview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/icon_view_push.png\" width=30px height=30px></a>";
				echo "<a href=\"userhistory.php?view=listview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/list_view.png\" width=30px height=30px></a>";
			} else {
				echo "<a href=\"userhistory.php?view=iconview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/icon_view.png\" width=30px height=30px></a>";
				echo "<a href=\"userhistory.php?view=listview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/list_view_push.png\" width=30px height=30px></a>";
			}
		echo "</div>";
		

		if ( $view == "iconview" ) {
			$count = 0;
			while ( $row = mysqli_fetch_array($result) ) {
				$vol = "";
				if ( $row['volume'] != "ONESHOT" && $row['volume'] != "NOVEL" )
					$vol = $row['volume'];
				else
					$vol = "(".$row['volume'].")";
				
				$pop = selectPopularity2($row['code'], 85);
				$pop2 = selectRecommend2($row['code'], 85);			
				$content[0] = "Tanggal Pinjam : ".$row['rent_date'];
				//$content[1] = "Tanggal Pengembalian : ".$row['return_date'];
				

				echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
				echo $row['code'];
				echo "</p>\n";
				$youtubeURL = getYoutubeURL2($row['code']);


				createBookBox2($row['code'], $row['title']." ".$vol, $content, $pop, $fb, "", $pop2, $row['synopsis'], $youtubeURL);
				
				continue;
				echo "<div class=\"bookbox\" id=\"imgcon\">
								<p><a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title']." ".$vol;
									echo "</a></p>";
								$imgcover = "cover_small/".$row['code'].".jpg";
								if ( file_exists($imgcover) == false )
									$imgcover = "cover_small/nophoto.png";
								echo "<img src=\"".$imgcover."\" width=80px height=105px>";
								$author_name = $row['author_name'];
								$author_name = str_replace("+", "&", $author_name);
		
								echo "<ul><li>";
								echo "<span>Tanggal Pinjam : ".$row['rent_date']."</span><br>
								</li><li><span>Dikembalikan Tanggal : ".$row['return_date']."</span></li>";
								$status = $row['late'];
									if ( $status <= 0 )
										$status = "0 hari";
									else {
										$status = $status." hari";
									}
								echo "<li><span>Telat : ".$status."</span></li>
								<!--<li>
								<span>Popularitas : Dalam Pengembangan</span><br>";
								echo "</li>-->";
								if ( $row['status'] == "ON GOING" )
									$status = "Bersambung";
								else
									$status = "Tamat";
								//echo "<li><span>Status : ".$status."</span></li>
								echo "<!--<span><a href=bookdetail.php?code=".
									$row['code'].">Detail</a></span>-->
								</ul>
							</div>";
			}			
			echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				
		} else {

		echo "
							<table>
								<tr class=\"title\" align=center>
									<td class=\"small\">
									<span class=\"tname\">No.</span>
									</td>
									<td class=\"big\">
									<span class=\"tname\">Judul</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Episode</span>
									</td>
									<td>
										<span class=\"tname\">Tanggal Pinjam</span>
									</td>
									<td>
										<span class=\"tname\">Dikembalikan Tanggal</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Telat</span>
									</td>
								</tr>";
								//$author = new Author();
								//$result = $this->selectBookTitle($status_filter, $genre_filter, $search, $offset, $num_rows);
								$i = $offset+1;
								$count = 0;
								while ( $row = mysqli_fetch_array($result) ) {
									
										echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
				echo $row['code'];
				echo "</p>\n";
				
									if ( $i % 2 == 0 ) 
										echo "<tr class=\"one\" align=left>";
									else
										echo "<tr class=\"two\" align=left>";
									echo "<td><span class=\"cname\">".$i++.".</span></td>";
									echo "<td><span class=\"cname\">";
									echo "<a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a>";
									echo "</span></td>";
									echo "<td><span class=\"cname\">".$row['volume']."</span></td>";
									echo "<td><span class=\"cname\">".$row['rent_date']."</span></td>";
									echo "<td><span class=\"cname\">".$row['return_date']."</span></td>";
									$status = $row['late'];
									if ( $status <= 0 )
										$status = "0 hari";
									else {
										$status = $status." hari";
									}
									echo "<td><span class=\"cname\">".$status."</span></td>";
									echo "</tr>";
								}
							echo "</table>";
			echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				
		}	
	}
}

?>


<?
class UserRecommend {
	/* Member variables */
	var $author_name;
	var $book_title;
	var $genre;
	var $rack;

	//constructor
	function __construct() {
	}
	function __destruct() {
	}

	function insertBookTitle($author_name, $nationality, $info, $rating) {
		
	}
	function countTotalBookNumber() {
		$query = "SELECT COUNT(*) from book_title a, book b where a.code=b.code";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['COUNT(*)'];
	}

	function countTotalComicNumber() {
		$query = "SELECT COUNT(*) from book_title a, book b where a.code=b.code and (a.category='A' or a.category='B')";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['COUNT(*)'];
	
	}
	function countTotalNovelNumber() {
		$query = "SELECT COUNT(*) from book_title a, book b where a.code=b.code and (a.category!='A' and a.category!='B')";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['COUNT(*)'];
	
	}
	function countBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows) {
		$query = "SELECT COUNT(*) from book_title a";
		
		$query = $query . " where (";
		for ( $i = 0; $i < count($resRec); $i++ ) {
			$query = $query . " a.code = '".$resRec[$i]."'";
			if ( $i < count($resRec)-1 )
				$query = $query . " OR ";
			else
				$query = $query . " ) ";
		}

		$query = $query.$this->useFilter($status_filter, $genre_filter, $category_filter, $search);
		
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['COUNT(*)'];
	}
	
	function useFilter($status_filter, $genre_filter, $category_filter, $search)
	{
		$query = "";
			if ( $status_filter != "" || $genre_filter != "" || $category_filter != "" || $search != "" )
			$query = $query." AND ";

		if ( $search != "" )
			$query = $query."( a.title LIKE '%".$search."%' or a.author_name LIKE '%".$search."%' )";

		if ( ( $status_filter != "" || $genre_filter != "" || $category_filter != "" ) && $search != "" )
			$query = $query." and ";
		
		if ( $status_filter != "" && $genre_filter != "" && $category_filter != "" ) {
			$query = $query." a.status='".$status_filter."' and a.genre='".$genre_filter."' and ";
			if ( $category_filter == "Komik" )
				$query = $query."( a.category='A' or a.category='B')";
			else
				$query = $query."( a.category!='A' and a.category!='B' )";
		} else
		if ( $status_filter != "" && $genre_filter )
			$query = $query." a.status='".$status_filter."' and a.genre='".$genre_filter."' ";
		else if ( $status_filter != "" && $category_filter != "" ) {
			$query = $query." a.status='".$status_filter."' and ";
			if ( $category_filter == "Komik" )
				$query = $query."( a.category='A' or a.category='B')";
			else
				$query = $query."( a.category!='A' and a.category!='B' )";
		} else if ( $genre_filter != ""  && $category_filter != "" ) {
			$query = $query." a.genre='".$genre_filter."' and ";
			if ( $category_filter == "Komik" )
				$query = $query."( a.category='A' or a.category='B')";
			else
				$query = $query."( a.category!='A' and a.category!='B' )";
		}
		else if ( $status_filter != "" ) 
			$query = $query." a.status='".$status_filter."' ";
		else if ( $genre_filter != "" )
			$query = $query." a.genre='".$genre_filter."' ";
		else if ( $category_filter != "" ) {
			if ( $category_filter == "Komik" )
				$query = $query."( a.category='A' or a.category = 'B' )";
			else
				$query = $query."( a.category!='A' and a.category != 'B' )";
		}
		return $query;
	}
	function selectPopularity($code, $width_star) {
		//get max
		$query = "select max(jumlah) as max from temp_table";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$max = $row['max'];
		
		$query = "select distinct(jumlah) as jumlah from temp_table where code='".$code."'";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$jumlah = $row['jumlah'];
		$per = ($jumlah/$max)*$width_star;
		$pop = Array( $jumlah, ceil($per) );
		return $pop;
	}
	function selectBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows) {
		$query = "SELECT distinct(a.code), a.title, a.author_name, a.genre, a.complete, a.rack, a.status, a.category, a.synopsis from book_title a, temp_table b ";
		//print_r($resRec);	
		$query = $query . " where a.code = b.code AND (";
		for ( $i = 0; $i < count($resRec); $i++ ) {
			$query = $query . " a.code = '".$resRec[$i]."'";
			if ( $i < count($resRec)-1 )
				$query = $query . " OR ";
			else
				$query = $query . " ) ";
		}
		/*************Filter Method ***************/
		$query = $query.$this->useFilter($status_filter, $genre_filter, $category_filter, $search);
	
		/*************End Filter Method ******************/

		$query = $query." order by a.rating desc, b.jumlah desc, a.title limit ".$num_rows." offset ".$offset;
		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		return $result;
	}

	function showFilter() {
		$genre_filter = $_GET['genre'];
		$status_filter = $_GET['status'];
		$search = $_GET['search'];
		$category_filter = $_GET['category'];
		$view = $_GET['view'];	
		$category_list = array (
			'Semua',
			'Komik',
			'Novel, Biografi, dll'
		);
		$genre_list = array(
			'Semua',
			'Adventure Fantasy',
			'Drama',
			'Romance',
			'Action',
			'Comedy',
			'History',
			'Detective',
			'Mystery',
			'Sport',
		);

		$status_list = array(
			'Semua',
			'Bersambung',
			'Tamat'
		);
		echo "	
		<form name=\"filter\" method=\"get\" action=\"userrecommend.php\">
				<input type=\"hidden\" name=\"view\" value=\"".$view."\">
				<p class=\"pfilter\">
					Genre
					<select class=\"filtersubmit\" name=\"genre\">";
						foreach ($genre_list as &$value) {
							if ( $value == $genre_filter )
								echo "<option selected=\"selected\">".$value."</option>";
							else
								echo "<option>".$value."</option>";
						}
					echo "</select>
					&nbsp;&nbsp;&nbsp;&nbsp;Status
					<select class=\"filtersubmit\" name=\"status\">
					";
					foreach ($status_list as &$value ) {
						if ( $value == $status_filter )
							echo "<option selected=\"selected\">".$value."</option>";
						else
							echo "<option>".$value."</option>";
					}
					echo "</select>
					&nbsp;&nbsp;&nbsp;&nbsp;Kategori
					<select class=\"filtersubmit\" name=\"category\">
					";
					foreach ($category_list as &$value ) {
						if ( $value == $category_filter )
							echo "<option selected=\"selected\">".$value."</option>";
						else
							echo "<option>".$value."</option>";
					}
					echo "</select>

					&nbsp;&nbsp;&nbsp;&nbsp;Search
					<input class=\"filtertext\" type=\"text\" name=\"search\" value=\"".$search."\">
					<input class=\"filtersubmit\" type=\"submit\" name=\"submit\" value=\"search\">
				</p>
				</form>";
	}
	function getRecommendCode($subid, $rownumber) {
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$mysql2 = new MySQLComic($GLOBALS['COMIC_DB']);

		$query = "SELECT code FROM temp_table limit 100";
		$result = $mysql->query($query);

		$i = 0;
		
		while ( $row = mysqli_fetch_array($result)) {
			$query2 = "SELECT EXISTS (SELECT * FROM rent_history where subscriber_id='".$subid."' and SUBSTR(book_id, 1, LOCATE('-', book_id)-1)='".$row['code']."') as THERE";	
			//echo "QUERY 2 = ".$query2."<br>";
			$result2 = $mysql2->query($query2);
			$row2 = mysqli_fetch_array($result2);
		
			//print_r($row2);echo "<br>";
			if ( $row2['THERE'] == 0 ) {
				//echo "<br>ROW -> ".$row['code']." ".$row2['THERE']."<br>";
				$arrcode[$i] = $row['code'];
				//echo "<br>SET arrcode = ".$arrcode[$i]."<br>";
				$i++;
			}
			if ( $i > $rownumber )
				break;
		}
		return $arrcode;
	}
	function showUserRecomm($fb) {
	/*	echo "ASDFASDFASDFASDFASDF";
		$resRec = $this->getRecommendCode($fb->subscriber_id, 20);
		//print_r($resRec);	
		$numbook = count($resRec);//$this->countBookTitle($status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows);
		$result = $this->selectBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows);
		
		exit;
	*/	
		//echo $fb->writeLikeButton('code');
								
		/***********Get all of the get method*********/
		$subscriber_id = $fb->subscriber_id;
		$genre_filter = $_GET['genre'];
		$status_filter = $_GET['status'];
		$search = $_GET['search'];
		$category_filter = $_GET['category'];
		$view = $_GET['view'];
		$act = $_GET['act'];
		
		if ( $view == "" )
			$view = "iconview";

		if ( $act == "<" )
			$curOffset = $_GET['prevOffset'];
		else
			$curOffset = $_GET['nextOffset'];
		if ( $curOffset == "" )
			$curOffset = 1;

		$offset = $curOffset-1;
		
		if ( $view == "listview" )
			$num_rows = 50;
		else
			$num_rows = 12;

		if ( $status_filter == "Semua" )
			$status_filter = "";
		else if ( $status_filter == "Tamat" )
			$status_filter = "END";
		else if ( $status_filter == "Bersambung" )
			$status_filter = "ON GOING";
		if ( $genre_filter == "Semua" )
			$genre_filter = "";
		if ( $category_filter == "Semua" )
			$category_filter = "";
		$resRec = $this->getRecommendCode($subscriber_id, 50-1);
	
		$numbook = $this->countBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows);
		$result = $this->selectBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows);
		echo "
		<form name=\"prevnext\" action=\"userrecommend.php\" method=\"get\">";
		echo "\n<input type=\"hidden\" name=\"view\" value=\"".$_GET['view']."\">";
		echo "\n<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">";
		echo "\n<input type=\"hidden\" name=\"status\" value=\"".$_GET['status']."\">";
		echo "\n<input type=\"hidden\" name=\"category\" value=\"".$_GET['category']."\">";
		echo "\n<input type=\"hidden\" name=\"search\" value=\"".$_GET['search']."\">";
		echo "
							<input type=\"hidden\" name=\"prevOffset\" value=";
								$prev = ($curOffset - $num_rows);
								if ( $prev < 1 )
									$prev = 1;
								echo "\"".$prev."\"";
		echo ">";
		echo "				
							<input type=\"hidden\" name=\"nextOffset\" value=";
							
								$next = ($curOffset + $num_rows);
								if ( $next > $numbook )
									$next = $curOffset;
								echo "\"".$next."\"";
		echo ">";
		echo "<p class=\"formstyle\">";
		echo "
							<input class=\"button\" type=\"submit\" name=\"act\" value=\"<\">";
							
							$maxnum = ($curOffset + ($num_rows-1));
							if ( $maxnum > $numbook )
								$maxnum = $numbook;
							echo $curOffset." - ".$maxnum." of ".$numbook;
		echo "					
							<input class=\"button\" type=\"submit\" name=\"act\" value=\">\">";
		echo "</p>";
		echo "			</form>";
		

		echo "
		<div class=\"view-noborder\"></div>
		<p class=\"h2view\">Rekomendasi Khusus Untuk Anda</p>
		<div class=\"view\">";
			if ( $view == "iconview" ) {
				echo "<a href=\"userrecommend.php?view=iconview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/icon_view_push.png\" width=30px height=30px></a>";
				echo "<a href=\"userrecommend.php?view=listview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/list_view.png\" width=30px height=30px></a>";
			} else {
				echo "<a href=\"userrecommend.php?view=iconview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/icon_view.png\" width=30px height=30px></a>";
				echo "<a href=\"userrecommend.php?view=listview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/list_view_push.png\" width=30px height=30px></a>";
			}
		echo "</div>";
		
		if ( $view == "iconview" ) {
			$count = 0;
			while ( $row = mysqli_fetch_array($result) ) {
				$author_name = $row['author_name'];
				$author_name = str_replace("+", "&", $author_name);

				$content[0] = "Pengarang : ".$author_name;
				$content[1] = "Genre : ".$row['genre'];
				if ( $row['status'] == "ON GOING" )
					$status = "Bersambung";
				else
					$status = "Tamat";
				$content[2] = "Status : ".$status;
								
				$pop = $this->selectPopularity($row['code'], 85);
				$pop2 = selectRecommend($row['code'], 85);	

				echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
				echo $row['code'];
				echo "</p>\n";
				$youtubeURL = getYoutubeURL2($row['code']);


				createBookBox($row['code'], $row['title'], $content, $pop, $fb, "", $row['synopsis'], $pop2, $youtubeURL);
		/*		echo "<div class=\"bookbox\" id=\"imgcon\">\n
								<p><a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a></p>";
								$imgcover = "cover_small/".$row['code'].".jpg";
								if ( file_exists($imgcover) == false )
									$imgcover = "cover_small/nophoto.png";
								echo "<img src=\"".$imgcover."\" width=80px height=105px>";
								$author_name = $row['author_name'];
								$author_name = str_replace("+", "&", $author_name);
		
								echo "<ul>\n<li>";
								echo "<span>Pengarang : ".$author_name."</span><br>
								</li>\n<li><span>Genre : ".$row['genre']."</span></li>\n";
								$pop = $this->selectPopularity($row['code'], 84);
							
								echo "<!--<li>
								<span>Popularitas : Dalam Pengembangan</span><br>";
								echo "</li>-->";
								if ( $row['status'] == "ON GOING" )
									$status = "Bersambung";
								else
									$status = "Tamat";
								echo "<li><span>Status : ".$status."</span></li>";
								echo "</ul>";
								echo "<div id=\"star\">
 								\n<ul id=\"star0\" class=\"star\">
  									\n<li id=\"starCur0\" class=\"curr\" title=\"9\" style=\"width: ".$pop[1]."px;\"></li>
 								\n</ul></div>";
	echo "<div id=\"star\">
 								\n<ul id=\"star0\" class=\"star\">
  									\n<li id=\"starCur0\" class=\"curr\" title=\"9\" style=\"width: ".$pop[1]."px;\"></li>
 								\n</ul></div>";
	


								echo "<div class=\"rate\">";
								if ( $fb->userstatus == 'ADMIN' ) 
									echo "<span><a onclick=\"fbLikeClick()\" href=uploadpic.php?bookcode=".$row['code']."&title=".str_replace(' ', '%20', $row['title'])."><br>Upload Gambar</a></span>";
								//if ( $fb->fb_user == true )
								echo $fb->writeLikeButton($row['code']);
								echo "</div>";	
						echo	"</div>";
			*/
			}
			echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				

		} else {
		echo "<br><br><br>
							<table>
								<tr align=center class=\"title\">
									<td class=\"small\">
									<span class=\"tname\">No.</span>
									</td>
									<td class=\"big\">
									<span class=\"tname\">Judul</span>
									</td>
									<td>
										<span class=\"tname\">Pengarang</span>
									</td>
									<td>
										<span class=\"tname\">Genre</span>
									</td>
									<td>
										<span class=\"tname\">ID Rak</span>
									</td>
									<td>
										<span class=\"tname\">Kategori</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Status</span>
									</td>
								</tr>";
								//$author = new Author();
								//$result = $this->selectBookTitle($status_filter, $genre_filter, $search, $offset, $num_rows);
								$i = $offset+1;
								$count = 0;
								while ( $row = mysqli_fetch_array($result) ) {
									echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
									echo $row['code'];
									echo "</p>\n";
				
									if ( $i % 2 == 0 )
										echo "<tr align=left class=\"one\">";
									else 
										echo "<tr align=left class=\"two\">";
									echo "<td><span class=\"cname\">".$i++.".</span></td>";
									echo "<td><span class=\"cname\">";
									echo "<a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a>";
									echo "</span></td>";
									$author_name = $row['author_name'];
									$author_name = str_replace("+", "&", $author_name);
		
									echo "<td><span class=\"cname\">".$author_name."</span></td>";
									echo "<td><span class=\"cname\">".$row['genre']."</span></td>";
									echo "<td><span class=\"cname\">".$row['rack']."</span></td>";
									if ( $row['category'] == 'A' or $row['category'] == 'B' )
										$category = 'Komik';
									else
										$category = 'Novel, Biografi, dll';

									echo "<td><span class=\"cname\">".$category."</span></td>";
									if ( $row['status'] == "END" )
										$status = "Tamat";
									else
										$status = "Bersambung";
									echo "<td><span class=\"cname\">".$status."</span></td>";
									echo "</tr>";
								}
								echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				

							echo "</table>";
					}
	}
}
?>

<?
class AdminRecommend {
	/* Member variables */
	var $author_name;
	var $book_title;
	var $genre;
	var $rack;

	//constructor
	function __construct() {
	}
	function __destruct() {
	}

	function insertBookTitle($author_name, $nationality, $info, $rating) {
		
	}
	function countTotalBookNumber() {
		$query = "SELECT COUNT(*) from book_title a, book b where a.code=b.code";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['COUNT(*)'];
	}

	function countTotalComicNumber() {
		$query = "SELECT COUNT(*) from book_title a, book b where a.code=b.code and (a.category='A' or a.category='B')";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['COUNT(*)'];
	
	}
	function countTotalNovelNumber() {
		$query = "SELECT COUNT(*) from book_title a, book b where a.code=b.code and (a.category!='A' and a.category!='B')";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['COUNT(*)'];
	
	}
	function countBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows) {
		$query = "SELECT COUNT(*) from book_title a";
		
		$query = $query . " where (";
		for ( $i = 0; $i < count($resRec); $i++ ) {
			$query = $query . " a.code = '".$resRec[$i]."'";
			if ( $i < count($resRec)-1 )
				$query = $query . " OR ";
			else
				$query = $query . " ) ";
		}

		$query = $query.$this->useFilter($status_filter, $genre_filter, $category_filter, $search);
		
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['COUNT(*)'];
	}
	
	function useFilter($status_filter, $genre_filter, $category_filter, $search)
	{
		$query = "";
			if ( $status_filter != "" || $genre_filter != "" || $category_filter != "" || $search != "" )
			$query = $query." AND ";

		if ( $search != "" )
			$query = $query."( a.title LIKE '%".$search."%' or a.author_name LIKE '%".$search."%' )";

		if ( ( $status_filter != "" || $genre_filter != "" || $category_filter != "" ) && $search != "" )
			$query = $query." and ";
		
		if ( $status_filter != "" && $genre_filter != "" && $category_filter != "" ) {
			$query = $query." a.status='".$status_filter."' and a.genre='".$genre_filter."' and ";
			if ( $category_filter == "Komik" )
				$query = $query."( a.category='A' or a.category='B')";
			else
				$query = $query."( a.category!='A' and a.category!='B' )";
		} else
		if ( $status_filter != "" && $genre_filter )
			$query = $query." a.status='".$status_filter."' and a.genre='".$genre_filter."' ";
		else if ( $status_filter != "" && $category_filter != "" ) {
			$query = $query." a.status='".$status_filter."' and ";
			if ( $category_filter == "Komik" )
				$query = $query."( a.category='A' or a.category='B')";
			else
				$query = $query."( a.category!='A' and a.category!='B' )";
		} else if ( $genre_filter != ""  && $category_filter != "" ) {
			$query = $query." a.genre='".$genre_filter."' and ";
			if ( $category_filter == "Komik" )
				$query = $query."( a.category='A' or a.category='B')";
			else
				$query = $query."( a.category!='A' and a.category!='B' )";
		}
		else if ( $status_filter != "" ) 
			$query = $query." a.status='".$status_filter."' ";
		else if ( $genre_filter != "" )
			$query = $query." a.genre='".$genre_filter."' ";
		else if ( $category_filter != "" ) {
			if ( $category_filter == "Komik" )
				$query = $query."( a.category='A' or a.category = 'B' )";
			else
				$query = $query."( a.category!='A' and a.category != 'B' )";
		}
		return $query;
	}
	function selectPopularity($code, $width_star) {
		//get max
		$query = "select max(jumlah) as max from temp_table";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$max = $row['max'];
		
		$query = "select distinct(jumlah) as jumlah from temp_table where code='".$code."'";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$jumlah = $row['jumlah'];
		$per = ($jumlah/$max)*$width_star;
		$pop = Array( $jumlah, ceil($per) );
		return $pop;
	}
	function selectBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows) {
		$query = "SELECT distinct(a.code), a.title, a.author_name, a.genre, a.complete, a.rack, a.status, a.category, a.synopsis from book_title a, temp_table b ";
		//print_r($resRec);	
		$query = $query . " where a.code = b.code AND (";
		for ( $i = 0; $i < count($resRec); $i++ ) {
			$query = $query . " a.code = '".$resRec[$i]."'";
			if ( $i < count($resRec)-1 )
				$query = $query . " OR ";
			else
				$query = $query . " ) ";
		}
		/*************Filter Method ***************/
		$query = $query.$this->useFilter($status_filter, $genre_filter, $category_filter, $search);
	
		/*************End Filter Method ******************/

		$query = $query." order by a.rating desc, b.jumlah desc, a.title limit ".$num_rows." offset ".$offset;
		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		return $result;
	}

	function showFilter($subscriber_id) {
		$genre_filter = $_GET['genre'];
		$status_filter = $_GET['status'];
		$search = $_GET['search'];
		$category_filter = $_GET['category'];
		$view = $_GET['view'];	
		$category_list = array (
			'Semua',
			'Komik',
			'Novel, Biografi, dll'
		);
		$genre_list = array(
			'Semua',
			'Adventure Fantasy',
			'Drama',
			'Romance',
			'Action',
			'Comedy',
			'History',
			'Detective',
			'Mystery',
			'Sport',
		);

		$status_list = array(
			'Semua',
			'Bersambung',
			'Tamat'
		);
		echo "	
		<form name=\"filter\" method=\"get\" action=\"adminrecommend.php\">
				<input type=\"hidden\" name=\"view\" value=\"".$view."\">
				<input type=\"hidden\" name=\"subsid\" value=\"".$subscriber_id."\">
				<p class=\"pfilter\">
					Genre
					<select class=\"filtersubmit\" name=\"genre\">";
						foreach ($genre_list as &$value) {
							if ( $value == $genre_filter )
								echo "<option selected=\"selected\">".$value."</option>";
							else
								echo "<option>".$value."</option>";
						}
					echo "</select>
					&nbsp;&nbsp;&nbsp;&nbsp;Status
					<select class=\"filtersubmit\" name=\"status\">
					";
					foreach ($status_list as &$value ) {
						if ( $value == $status_filter )
							echo "<option selected=\"selected\">".$value."</option>";
						else
							echo "<option>".$value."</option>";
					}
					echo "</select>
					&nbsp;&nbsp;&nbsp;&nbsp;Kategori
					<select class=\"filtersubmit\" name=\"category\">
					";
					foreach ($category_list as &$value ) {
						if ( $value == $category_filter )
							echo "<option selected=\"selected\">".$value."</option>";
						else
							echo "<option>".$value."</option>";
					}
					echo "</select>

					&nbsp;&nbsp;&nbsp;&nbsp;Search
					<input class=\"filtertext\" type=\"text\" name=\"search\" value=\"".$search."\">
					<input class=\"filtersubmit\" type=\"submit\" name=\"submit\" value=\"search\">
				</p>
				</form>";
	}
	function getRecommendCode($subid, $rownumber) {
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$mysql2 = new MySQLComic($GLOBALS['COMIC_DB']);

		$query = "SELECT code FROM temp_table limit 100";
		$result = $mysql->query($query);

		$i = 0;
		
		while ( $row = mysqli_fetch_array($result)) {
			$query2 = "SELECT EXISTS (SELECT * FROM rent_history where subscriber_id='".$subid."' and SUBSTR(book_id, 1, LOCATE('-', book_id)-1)='".$row['code']."') as THERE";	
			//echo "QUERY 2 = ".$query2."<br>";
			$result2 = $mysql2->query($query2);
			$row2 = mysqli_fetch_array($result2);
		
			//print_r($row2);echo "<br>";
			if ( $row2['THERE'] == 0 ) {
				//echo "<br>ROW -> ".$row['code']." ".$row2['THERE']."<br>";
				$arrcode[$i] = $row['code'];
				//echo "<br>SET arrcode = ".$arrcode[$i]."<br>";
				$i++;
			}
			if ( $i > $rownumber )
				break;
		}
		return $arrcode;
	}
	function showAdminRecomm($fb, $subscriber_id) {
	/*	echo "ASDFASDFASDFASDFASDF";
		$resRec = $this->getRecommendCode($fb->subscriber_id, 20);
		//print_r($resRec);	
		$numbook = count($resRec);//$this->countBookTitle($status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows);
		$result = $this->selectBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows);
		
		exit;
	*/	
		//echo $fb->writeLikeButton('code');
								
		/***********Get all of the get method*********/
		$genre_filter = $_GET['genre'];
		$status_filter = $_GET['status'];
		$search = $_GET['search'];
		$category_filter = $_GET['category'];
		$view = $_GET['view'];
		$act = $_GET['act'];
		
		if ( $view == "" )
			$view = "iconview";

		if ( $act == "<" )
			$curOffset = $_GET['prevOffset'];
		else
			$curOffset = $_GET['nextOffset'];
		if ( $curOffset == "" )
			$curOffset = 1;

		$offset = $curOffset-1;
		
		if ( $view == "listview" )
			$num_rows = 50;
		else
			$num_rows = 12;

		if ( $status_filter == "Semua" )
			$status_filter = "";
		else if ( $status_filter == "Tamat" )
			$status_filter = "END";
		else if ( $status_filter == "Bersambung" )
			$status_filter = "ON GOING";
		if ( $genre_filter == "Semua" )
			$genre_filter = "";
		if ( $category_filter == "Semua" )
			$category_filter = "";
		$resRec = $this->getRecommendCode($subscriber_id, 50-1);
	
		$numbook = $this->countBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows);
		$result = $this->selectBookRecomm($resRec, $status_filter, $genre_filter, $category_filter, $search, $offset, $num_rows);
		echo "
		<form name=\"prevnext\" action=\"adminrecommend.php\" method=\"get\">";
		echo "<input type=\"hidden\" name=\"subsid\" value=\"".$subscriber_id."\">";
		echo "\n<input type=\"hidden\" name=\"view\" value=\"".$_GET['view']."\">";
		echo "\n<input type=\"hidden\" name=\"genre\" value=\"".$_GET['genre']."\">";
		echo "\n<input type=\"hidden\" name=\"status\" value=\"".$_GET['status']."\">";
		echo "\n<input type=\"hidden\" name=\"category\" value=\"".$_GET['category']."\">";
		echo "\n<input type=\"hidden\" name=\"search\" value=\"".$_GET['search']."\">";
		echo "
							<input type=\"hidden\" name=\"prevOffset\" value=";
								$prev = ($curOffset - $num_rows);
								if ( $prev < 1 )
									$prev = 1;
								echo "\"".$prev."\"";
		echo ">";
		echo "				
							<input type=\"hidden\" name=\"nextOffset\" value=";
							
								$next = ($curOffset + $num_rows);
								if ( $next > $numbook )
									$next = $curOffset;
								echo "\"".$next."\"";
		echo ">";
		echo "<p class=\"formstyle\">";
		echo "
							<input class=\"button\" type=\"submit\" name=\"act\" value=\"<\">";
							
							$maxnum = ($curOffset + ($num_rows-1));
							if ( $maxnum > $numbook )
								$maxnum = $numbook;
							echo $curOffset." - ".$maxnum." of ".$numbook;
		echo "					
							<input class=\"button\" type=\"submit\" name=\"act\" value=\">\">";
		echo "</p>";
		echo "			</form>";
		

		echo "
		<div class=\"view-noborder\"></div>
		<p class=\"h2view\">Rekomendasi Khusus Untuk Anda</p>
		<div class=\"view\">";
			if ( $view == "iconview" ) {
				echo "<a href=\"adminrecommend.php?subsid=".$subscriber_id."&view=iconview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/icon_view_push.png\" width=30px height=30px></a>";
				echo "<a href=\"adminrecommend.php?subsid=".$subscriber_id."&view=listview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/list_view.png\" width=30px height=30px></a>";
			} else {
				echo "<a href=\"adminrecommend.php?subsid=".$subscriber_id."&view=iconview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/icon_view.png\" width=30px height=30px></a>";
				echo "<a href=\"adminrecommend.php?subsid=".$subscriber_id."&view=listview&genre=".$_GET['genre']."&status=".$_GET['status']."&category=".$_GET['category']."&search=".$_GET['search']."&submit=search\"><img src=\"images/list_view_push.png\" width=30px height=30px></a>";
			}
		echo "</div>";
		
		if ( $view == "iconview" ) {
			$count = 0;
			while ( $row = mysqli_fetch_array($result) ) {
				$author_name = $row['author_name'];
				$author_name = str_replace("+", "&", $author_name);

				$content[0] = "Pengarang : ".$author_name;
				$content[1] = "Genre : ".$row['genre'];
				if ( $row['status'] == "ON GOING" )
					$status = "Bersambung";
				else
					$status = "Tamat";
				$content[2] = "Status : ".$status;
								
				$pop = $this->selectPopularity($row['code'], 85);
				$pop2 = selectRecommend($row['code'], 85);	

				echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
				echo $row['code'];
				echo "</p>\n";
				createBookBox($row['code'], $row['title'], $content, $pop, $fb, "", $row['synopsis'], $pop2);
		/*		echo "<div class=\"bookbox\" id=\"imgcon\">\n
								<p><a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a></p>";
								$imgcover = "cover_small/".$row['code'].".jpg";
								if ( file_exists($imgcover) == false )
									$imgcover = "cover_small/nophoto.png";
								echo "<img src=\"".$imgcover."\" width=80px height=105px>";
								$author_name = $row['author_name'];
								$author_name = str_replace("+", "&", $author_name);
		
								echo "<ul>\n<li>";
								echo "<span>Pengarang : ".$author_name."</span><br>
								</li>\n<li><span>Genre : ".$row['genre']."</span></li>\n";
								$pop = $this->selectPopularity($row['code'], 84);
							
								echo "<!--<li>
								<span>Popularitas : Dalam Pengembangan</span><br>";
								echo "</li>-->";
								if ( $row['status'] == "ON GOING" )
									$status = "Bersambung";
								else
									$status = "Tamat";
								echo "<li><span>Status : ".$status."</span></li>";
								echo "</ul>";
								echo "<div id=\"star\">
 								\n<ul id=\"star0\" class=\"star\">
  									\n<li id=\"starCur0\" class=\"curr\" title=\"9\" style=\"width: ".$pop[1]."px;\"></li>
 								\n</ul></div>";
	echo "<div id=\"star\">
 								\n<ul id=\"star0\" class=\"star\">
  									\n<li id=\"starCur0\" class=\"curr\" title=\"9\" style=\"width: ".$pop[1]."px;\"></li>
 								\n</ul></div>";
	


								echo "<div class=\"rate\">";
								if ( $fb->userstatus == 'ADMIN' ) 
									echo "<span><a onclick=\"fbLikeClick()\" href=uploadpic.php?bookcode=".$row['code']."&title=".str_replace(' ', '%20', $row['title'])."><br>Upload Gambar</a></span>";
								//if ( $fb->fb_user == true )
								echo $fb->writeLikeButton($row['code']);
								echo "</div>";	
						echo	"</div>";
			*/
			}
			echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				

		} else {
		echo "<br><br><br>
							<table>
								<tr align=center class=\"title\">
									<td class=\"small\">
									<span class=\"tname\">No.</span>
									</td>
									<td class=\"big\">
									<span class=\"tname\">Judul</span>
									</td>
									<td>
										<span class=\"tname\">Pengarang</span>
									</td>
									<td>
										<span class=\"tname\">Genre</span>
									</td>
									<td>
										<span class=\"tname\">ID Rak</span>
									</td>
									<td>
										<span class=\"tname\">Kategori</span>
									</td>
									<td class=\"middle\">
										<span class=\"tname\">Status</span>
									</td>
								</tr>";
								//$author = new Author();
								//$result = $this->selectBookTitle($status_filter, $genre_filter, $search, $offset, $num_rows);
								$i = $offset+1;
								$count = 0;
								while ( $row = mysqli_fetch_array($result) ) {
									echo "\n<p style=\"display:none;\" id=\"code".$count++."\">";
									echo $row['code'];
									echo "</p>\n";
				
									if ( $i % 2 == 0 )
										echo "<tr align=left class=\"one\">";
									else 
										echo "<tr align=left class=\"two\">";
									echo "<td><span class=\"cname\">".$i++.".</span></td>";
									echo "<td><span class=\"cname\">";
									echo "<a href=\"bookdetail.php?code=".
									$row['code']."\">";
									echo $row['title'];
									echo "</a>";
									echo "</span></td>";
									$author_name = $row['author_name'];
									$author_name = str_replace("+", "&", $author_name);
		
									echo "<td><span class=\"cname\">".$author_name."</span></td>";
									echo "<td><span class=\"cname\">".$row['genre']."</span></td>";
									echo "<td><span class=\"cname\">".$row['rack']."</span></td>";
									if ( $row['category'] == 'A' or $row['category'] == 'B' )
										$category = 'Komik';
									else
										$category = 'Novel, Biografi, dll';

									echo "<td><span class=\"cname\">".$category."</span></td>";
									if ( $row['status'] == "END" )
										$status = "Tamat";
									else
										$status = "Bersambung";
									echo "<td><span class=\"cname\">".$status."</span></td>";
									echo "</tr>";
								}
								echo "\n<p style=\"display:none;\" id=\"codetotal\">";
									echo $count;
									echo "</p>\n";
				

							echo "</table>";
					}
	}
}
?>


