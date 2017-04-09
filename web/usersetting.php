<!DOCTYPE html>
<? include 'mysql_comic.php'; 
	include 'book.php';
	
	include 'fb_connect.php';
	$fb = new fbConnect();
	if ( $fb->fb_user == false ) {
		echo "Anda harus Login Terlebih Dahulu";
		exit;
	}
?>
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
			$layout->showHeader('', $fb);
			//$layout->showBookSubMenu('Judul Buku');
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
						
						<p class="h2">
						Form Aktifasi
						</p>
<!--						<form name="newsadd", method="get" action="addnews.php">-->
						<p class="about">Nama : <? echo $fb->user_profile['name']; ?>
							</p>
						<form action="synchro.php" method="post"
								enctype="multipart/form-data">
							<p class="about">
							Email anda yang terdaftar airabooks : <input type="text" name="email_address"><br>
							</p>
							<input type="submit" name="submit" value="Submit">
							<input type="hidden" name="fbid" value="<? echo $fb->user_profile['id']; ?>">
							
						</form>
					<br>
							<p class="about">
							*System akan mengirimkan kode aktivasi ke email anda yang terdaftar di airabooks, apabila anda tidak menerima email aktivasi tersebut, maka ada kemungkinan terjadi kesalahan dalam penginputan data, segera hubungi admin airabooks untuk mensetting ulang email anda.
						</p>

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
