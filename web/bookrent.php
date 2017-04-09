<?php
	session_start();
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
?>
<?php
	/* Define Header */
	$mlayout = new MainLayout;	
	$rpop = new RandomPopular;
?>
<html>
	<head>
		<?php
//			echo $mlayout->writeHeadParameter();
		?>
</head>
	<body style="background-color:white">
		<?
			//$rpop->getPopularRandom();
//			echo $mlayout->writeHeader();
//			echo $mlayout->writeMenu('Home', "");
			//$fb_info = getFBInfo($_GET['fb_id']);	
			$fb_info = getFBInfoOffline();
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
				>Informasi Peminjaman Anda</span>
			<table border="0px" cellpadding="5px" cellspacing="0" bordercolor="#e2e2e2" class="user_profile">
				<tr style="border-bottom:1px solid #e2e2e2;">
					<td style="border-bottom:1px solid #e2e2e2;">
						Nama
					</td>
					<td width="68%" style="border-bottom:1px solid #e2e2e2;">
					<?
						echo $fb_info['full_name'];
					?>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
						ID Anggota
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<?
						echo $fb_info['subscriber_id'];
					?>
					</td>
				</tr>
			</table>
			<div class="wiki" style="display:block;">
			<?
				$code = "DC";
				$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
				//$query = "SELECT a.code, a.title, b.volume, b.copy, c.active_date as active_date, DATE_FORMAT(c.active_date, '%Y') as check_date, c.status FROM book_title a, book b, book_detail c WHERE a.code=b.code AND b.book_id=c.book_id AND a.code='".$code."' ORDER BY '0000000'+rtrim(b.volume), b.copy";
				$query = "SELECT c.code, c.title, b.volume, a.rent_date, a.rent_duration, DATE_ADD(a.rent_date, interval a.rent_duration DAY) as return_date, DATEDIFF(NOW() ,DATE_ADD(a.rent_date, interval a.rent_duration DAY)) as late FROM rent a, book b, book_title c WHERE a.book_id=b.book_id AND b.code=c.code AND  a.subscriber_id='".$fb_info['subscriber_id']."' ORDER by a.rent_date, c.title, b.volume";
				$result = $mysql->query($query);
				$table_comic = "<table class=\"collection\" border=\"1px\" cellpadding=\"3px\" bordercolor=\"#e2e2e2\">
				<tr class=\"title\">
					<td>No.</td>
					<td>Judul</td>
					<td>Tanggal Pinjam</td>
					<td>Tanggal Pengembalian</td>
					<td>Telat</td>
					<!--<td>Denda</td>-->
				<tr>
				";
				$i = 1;
				while ( $row = mysqli_fetch_array($result) ) {
					$rent_date = DateToIndo($row['rent_date']);
					$return_date = DateToIndo($row['return_date']);
					$late = $row['late'];
					$late1 = 0;
					if ( $late < 0 )
						$late = 0;
					else
						$late1 = ceil($late - (($late/7))-1);
           			if ( $late1 < 0 )
						$late1 = 0;

					$table_comic = $table_comic . "
					<tr>
						<td>".$i++.".</td>
						<td><a href=http://airabooks.com/wiki/wikibook.php?bookcode=".urlencode($row['code']).">".$row['title']." ".$row['volume']."</a></td>
						<td>".$rent_date."</td>
						<td>".$return_date."</td>
						<td>".$late1." hari</td>
						<!--<td>denda</td>	-->
					</tr>
					";
				}
				$table_comic = $table_comic."
					<tr style=\"background-color:#bfbfbf;\">
						<td border=\"0px\"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<!--<span style=\"font-weight:bold;\">Total Denda</span></td>-->
					<!--<td>Denda</td>-->
					





					</tr>
				";
				$table_comic = $table_comic."</table>";
					

			echo $table_comic;
			?>

			</div>
		<?
			
			//echo $mlayout->writeBodyHeader();
			//$content = $rpop->getBookSnapshotInfo($_GET['bookcode']);
			//echo $mlayout->writeBOXSnapshotContent($content);
		?>
	</body>
</html>
