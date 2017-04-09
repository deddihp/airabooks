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
<!DOCTYPE html>
<html>
	<head>
		<title>By Request</title>
		<?php
		echo $mlayout->writeHeadParameter();
		?>

		<?
			$desc = "Kami menyadari bahwa koleksi buku di airabooks belumlah lengkap, oleh sebab itu kami meminta bantuan kepada anggota airabooks untuk menuliskan judul buku yang ingin dilengkapi di airabooks dan mengklik tanda panah untuk merekomendasikannya.
			Judul Buku dengan jumlah rekomendasi terbanyak akan lebih diprioritaskan untuk dilengkapi.";
			echo writeMetaInfo("Fitur By Request, ".$desc);
		
		?>
		<meta property="og:type" content="website"/>
		<meta property="fb:admins" content="1192425363"/>
		<meta property="fb:app_id" content="159457617553432"/>
		<meta property="og:title" content="Fitur By Request di airabooks.com"/>
		<meta property="og:site_name" content="airabooks.com"/>
		<meta property="og:image" content="http://airabooks.com/images/airabooks.png"/>
		<meta property="og:description" content="<? echo $desc; ?>"/> 
		

		</head>
	<body>
	<?
			$header = $mlayout->writeHeader();
	?>
	<?
		$menu = $mlayout->writeMenu('By Request', "By Request", "", "./");
	
		$mcontent = '
		<div class="mcontent" id="mcontent">
			'.printAds(0).'
			<span style="display:table; width:100%; font:bold 14px/18px arial, sans-serif;margin:10px 0 0 0;">Request Buku</span>
			<span style="border:0px solid #e2e2e2; text-align:left;width:99%; display:table; font:normal 13px/16px arial, sans-serif;padding:5px;margin:5px;">
			Kami menyadari bahwa koleksi buku di airabooks belumlah lengkap, oleh sebab itu kami meminta bantuan kepada anggota airabooks untuk menuliskan judul buku yang ingin dilengkapi di airabooks dan mengklik <img alt="" src="images/arrow-up.png" width="13"> untuk merekomendasikannya.<br>
			Judul Buku dengan jumlah rekomendasi terbanyak akan lebih diprioritaskan untuk dilengkapi.
			</span>
			<table border="1" 
				style="border:1px solid #e2e2e2;margin:10px;width:98%; font:normal 13px/18px arial,sans-serif;" >
				<tr style="background-color:#fbfbfb; font-weight:bold;">
					<td>
						No.	
					</td>
					<td>
						Judul
					</td>
					<td>
						Keterangan
					</td>
					<td>
						Rekomendasi
					</td>
				</tr>
				<!--<tr>
					<td>
						1.	
					</td>
					<td>
						Detective Conan 69
					</td>
					<td>
						Permintaan untuk dilengkapi
					</td>
					<td>
						<div style="display:block;border:0px solid black;
							margin:0px 0 0 0;">
							<div style="display:inline-block; margin:3px 0 0 0;">
								<img alt="" src="images/arrow-up.png" width="13"> 
							</div>
							<div style="display:inline-block;position:relative;top:-3px;border:0px solid red;">
								1 Rekomendasi
							</div>
						</div>
					</td>
				</tr>-->';
					$i = 1;
					$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
					$query = "SELECT * FROM book_request ORDER BY count DESC";
					$result = $mysql->query($query);
					while ( $row = mysqli_fetch_array($result)) {
						$mcontent = $mcontent . "<tr>
							<td>
						".$i++."	
					</td>
					<td>
						".$row['title']."
					</td>
					<td>
						".$row['keterangan']."
					</td>
					<td>
						<div style=\"display:block;border:0px solid black;
							margin:0px 0 0 0;\">
							<div style=\"display:inline-block; margin:3px 0 0 0;\">
								<a href=\"\" onclick=\"javascript:loadHTML('send_bookrequest.php?type=UPDATE&amp;subscriber_id=".$_SESSION['subscriber_id']."&amp;content=".$row['title']."&amp;count=".$row['count']."', 'book_request_loader".$i."', true); return false;\">
								<img alt='' src=\"images/arrow-up.png\" width=\"13\"> 
							</a>
							</div>
							<div id=\"book_request_loader".$i."\" style=\"display:inline-block;position:relative;top:-3px;border:0px solid red;\">
								".$row['count']." Rekomendasi
							</div>
						</div>
					</td>
						</tr>";
					}
				
			$mcontent = $mcontent . "</table>";
			$mcontent = $mcontent . "<button name=\"Request Buku\" onclick=\"javascript:showScreenCover('requestbook.php');\">Request Buku</button>
		</div>
		<div style=\"border:0px solid black;float:left;
			//width:142px;\"
		></div>";
		
		echo printBasicLayout($mlayout, $header, $menu, $mcontent);
		?>
	</body>
</html>
