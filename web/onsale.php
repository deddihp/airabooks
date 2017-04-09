<?php
	session_start();
	
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
	//$fb_info = getFBInfo($_SESSION['fb_id']);	
	$fb_info = getFBInfoOffline();	
	if ( $fb_info['subscriber_id'] == "" ) {
		echo "Maaf, Anda harus terdaftar sebagai anggota airabooks untuk melihat halaman ini.
<br>
Mari bergabung dengan airabooks, Registrasi Gratis Lho.;
		";
		return;
	}
?>
<?
	if ( $_GET['type'] == 'DELETE' ) {
		$query = "DELETE FROM book_sell WHERE subscriber_id='".$_GET['subs_id']."' AND book_title='".$_GET['book_title']."' AND date='".$_GET['date']."'";
		//echo "QUERY = ".$query;
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$mysql->query($query);
	}
?>
		<span
				style="
					font-family:'Verdana';
					font-size:15px;
					font-weight:bold;
					margin:10px;
					//border:1px solid black;
					display:block;
				"
				>Daftar Pesanan Anda</span>
		
<table border="0px" cellpadding="5px" cellspacing="0" bordercolor="#e2e2e2" class="user_profile">
				<tr style="border-bottom:1px solid #e2e2e2;">
					<td style="border-bottom:1px solid #e2e2e2;">
						ID Anggota
					</td>
					<td width="60%" style="border-bottom:1px solid #e2e2e2;">
					<?
						echo $_SESSION['subscriber_id'];
					?>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
						Nama
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<?
						echo $fb_info['full_name'];
					?>
					</td>
				</tr>
			</table>
	<table style="font:normal 13px/18px arial,sans-serif;border:1px solid #e2e2e2; display:table; width:100%;">
		<tr bgcolor="#f1f1f1">
			<td>
				
			</td>
			<td>
				No.
			</td>
			<td>
				Tanggal Pemesanan
			</td>
			<td>
				Judul
			</td>
			<td>
				Banyak
			</td>
		</tr>
		<!--
		<tr bgcolor="#fbfbfb">
			<td>
				x
			</td>
			<td>
				1.
			</td>
			<td>
				20 April 2013
			</td>
			<td>
				Bombabi
			</td>
			<td>
				1
			</td>
		</tr>
		-->
		<?
			if ( $fb_info['role'] == 'ADMIN' )
				$query = "SELECT * FROM book_sell";
			else
				$query = "SELECT * FROM book_sell WHERE subscriber_id='".$_SESSION['subscriber_id']."'";
			//echo "QUERY 2 = ".$query;
			$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
			$result = $mysql->query($query);
			$i = 1;
			while ( $row = mysqli_fetch_array($result)) {
				if ( $fb_info['role'] == 'ADMIN' )
					$str = "(".$row['subscriber_id'].")".$row['book_title'];
				else
					$str = $row['book_title'];
				echo "
				<tr bgcolor=\"#fbfbfb\">
					<td>
						<a href=# onclick=\"
						javascript:showScreenCover('onsale.php?type=DELETE&subs_id=".$row['subscriber_id']."&book_title=".$row['book_title']."&date=".$row['date']."')\">
						x</a>
					</td>
					<td>
						".$i++."
					</td>
					<td>
						".DateToIndo($row['date'])."
					</td>
					<td>
						".$str."
					</td>
					<td>
						".$row['quantity']."
					</td>
				</tr>";
			}
		?>
	</table>
	<?
		$url = $_GET['dir']."onsale_jx.php";
		//echo " GET TTTT = ".$url;
	?>
	<button onclick="javascript:showScreenCover('<? echo $url; ?>');">Pesan Buku</button>
