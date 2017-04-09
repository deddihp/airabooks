<!DOCTYPE html>
<? include 'mysql_comic.php'; ?>
<? 
	include 'fb_connect.php';
	$fb = new fbConnect();
	if ( $fb->fb_user == false ) {
		echo "Anda harus Login Terlebih Dahulu";
		exit;
	}

?>
<? include 'book.php'; ?>
<html>
<head>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div class="header">
	<?
			include 'layout.php';
			$layout = new ComicLayout();
			$layout->showHeader('Anggota', $fb);
			$layout->showUserMenu('');
		?>
	</div>
	<?php
		//include 'book.php';
		//$booktitle = new BooksTitle();
	?>			
	<div class="body">
		<div>
			<div class="filter">
				<?
					//$booktitle->showFilter();
				?>
				<!-- For Filter -->
			</div>
		</div>
	</div>
	<div class="body">
		<div class="forcontent">
			<div>
				<div>
					<div class="section">
						<p class="h2">INFORMASI</p>
						<br>
						<p class="h2">
							Anda belum bisa menggunakan layanan ini sebelum melakukan sinkronisasi dengan data di airabooks.
						</p>
						<p class="h2">
						Cukup klik di sini untuk melakukan sinkronisasi.
						</p>
						<p class="h2">
						Apabila anda belum mendaftar ke airabooks, segera daftarkan diri anda di airabooks, GRATIS TIS TIS TIS.
						</p>
						<?
				//			$booktitle->showHTML();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?
			$bookfooter = new BookLayout();
		$bookfooter->showBookFooter();
	?>
</body>
</html>
