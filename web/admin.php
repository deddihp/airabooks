<!DOCTYPE html>
<? include 'mysql_comic.php'; 
	include 'book.php';
?>
<? 
	include 'fb_connect.php';
	$fb = new fbConnect();
	if ( $fb->fb_user == false ) {
		echo "Anda harus Login Terlebih Dahulu";
		exit;
	}
	if ( $fb->userstatus != 'ADMIN' ) {
		echo "Anda harus admin";
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
			$layout->showHeader('Admin', $fb);
			$layout->showAdminMenu('Add New Release/Coming Soon', $fb);
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
						Admin News Submit
						</p>
<!--						<form name="newsadd", method="get" action="addnews.php">-->
			<form action="file.php" method="post"
				enctype="multipart/form-data">
					<table class="profile">	
						<tr>
							<td>Tanggal</td>
							<td><input type="date" name="thisdate"></td>
						</tr>
						<tr>
							<td>Judul</td>
							<td><input type="text" name="title" maxlength=25></td>
						</tr>
						<tr>
							<td>Article</td>
							<td><textarea rows="5" cols="60" name="article" id="article"></textarea></td>
						</tr>
						<tr>
							<td><label for="file">File Gambar</label></td>
							<td><input type="file" name="file" id="file"></td>
						</tr>
						<tr>
							<td><label for="type">Tipe:</label></td>
							<td><select name="type">
									<option value="New Release">New Release</option>
									<option value="Coming Soon">Coming Soon</option>
									<option value="any News">Other</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" name="submit" value="Submit">
							</td>
						</tr>
					</table>
					</p>
					</form>


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
