

<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? 
	include 'fb_connect.php';
	$fb = new fbConnect();
	if ( $fb->subscriber_id == "" ) {
		echo "Anda belum melakukan sinkronisasi.";
		exit;
	}
?>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<!--<meta charset="UTF-8">-->
	<title>airabooks - User Statistik</title>
<!--	<link rel="image_src" href="http://airabooks.com/images/asli-wood.png" / >--> 
	<meta name="description" content="Segala macam informasi dalam bentuk statistik di airabooks." />
	<meta property="og:title" content="User Statistik airabooks"/>
	<meta property="og:site_name" content="airabooks.com"/>
	<meta property="og:image" content="http://airabooks.com/images/graph.jpg"/>
	<meta property="og:description" content="Statistik anggota airabooks."/>
	<meta property="og:url" content="http://airabooks.com"/>
	

	<link rel="stylesheet" href="css/style.css" type="text/css">
	<?
		include 'userstat_handler.php';
		$usergraph = new UserComicStat();
		$usergraph->writeHeader($fb);
	
		$uservisitstat = new UserVisitStat();
		$uservisitstat->writeHeader($fb);
	?>

	<script type="text/javascript" src="jquery.min.js"></script>

	<script type="text/javascript">
		function myfunction(el) {
			//alert(el.innerHTML);
			if ( el.innerHTML == "Sembunyikan Komposisi Genre Anda" ) {
				$('#userstat').fadeOut();
				el.innerHTML = "Tampilkan Komposisi Genre Anda";
			} else if ( el.innerHTML == "Tampilkan Komposisi Genre Anda" ) {
				//$('#userstat').show();
				$('#userstat').fadeIn();
				el.innerHTML = "Sembunyikan Komposisi Genre Anda";
			}
			if ( el.innerHTML == "Sembunyikan Statistik Kunjungan Anda" ) {
				$('#visitstat').fadeOut();
				el.innerHTML = "Tampilkan Statistik Kunjungan Anda";
			} else if ( el.innerHTML == "Tampilkan Statistik Kunjungan Anda" ) {
				$('#visitstat').fadeIn();
				//$('#genrestat').show();
				el.innerHTML = "Sembunyikan Statistik Kunjungan Anda";
			}
			if ( el.innerHTML == "Sembunyikan Statistik Kehadiran Pelanggan" ) {
				$('#ttstat').fadeOut();
				el.innerHTML = "Tampilkan Statistik Kehadiran Pelanggan";
			} else if ( el.innerHTML == "Tampilkan Statistik Kehadiran Pelanggan" ) {
				$('#ttstat').fadeIn();
				//$('#genrestat').show();
				el.innerHTML = "Sembunyikan Statistik Kehadiran Pelanggan";
			}
		}
		$(document).ready(function() {
			$('#userstat').hide();
			$('#visitstat').hide();
			$('#ttstat').hide();
			//$('#show').width(200
		});
	</script>
</head>
<body>
	<? echo $fb->writeFBJSHeader(); ?>	
	<div class="header">
	<?
			include 'layout.php';
			$layout = new ComicLayout();
			$layout->showHeader('Anggota', $fb);
			$layout->showUserMenu('Statistik Anda', $fb);
		?>
	</div>
	<?php
		include 'book.php';
		$booktitle = new BooksTitle();
	?>			
	<div class="body">
		<div class="forcontent">
			<div>
				<div>
					<div class="section">
						<p class="h2">Statistik Anda</p>
					<script src="js/highcharts.js"></script>
					<script src="js/modules/exporting.js"></script>

					<!--<div id="userstat" style="min-width: 400px!important; height: 400px!important; margin: 0 auto"></div>
-->
						<button style="width:300px" id="show" onclick="myfunction(this)">Tampilkan Komposisi Genre Anda</button>
						<button style="width:300px" onclick="myfunction(this)">Tampilkan Statistik Kunjungan Anda</button>
						<!--<button style="width:300px" onclick="myfunction(this)">Tampilkan Statistik Kehadiran Pelanggan</button>-->
						<div id="userstat" class="graph"></div>
						<div id="visitstat" class="graph"></div>
						<div id="ttstat" class="graph"></div>


					
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="comment">
		<table width="100%" >
			<tr>
				<td></td>
				<td width="80%">
				<?
					//echo $fb->writeLikeButtonCommon("http://airabooks.com/", "like");
					//echo $fb->writeCommentCommon("http://airabooks.com/");
				?>
				</td>
				<td></td>
			</tr>
		</table>
	</div>;

	<?
	//	echo $fb->writeCommentFB('MLD');
		$bookfooter = new BookLayout();
		$bookfooter->showBookFooter();
	?>
</body>
</html>
