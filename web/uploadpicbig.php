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
			$layout->showAdminMenu('', $fb);
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
						Upload Picture	
						</p>
<!--						<form name="newsadd", method="get" action="addnews.php">-->
			<form action="uploadpic_handler.php" method="post"
				enctype="multipart/form-data">
					<input type="hidden" name="size" value="big">
					<table class="profile">	
						<tr>
							<td>Code</td>
							<td><input type="text" name="bookcode" 
							value="<? echo $_GET['bookcode'];?>"></td>
						</tr>
						<tr>
							<td>Judul</td>
							<td><input type="text" name="title"
							value="<? echo $_GET['title']; ?>"></td>
						</tr>
						<tr>
							<td><label for="file">File Gambar (750x375)</label></td>
							<td><input type="file" name="file" id="file"></td>
						</tr>
						<tr>
							<td><label for="urlyoutube">URL Youtube</label></td>
							<td><input type="text" name="urlyoutube" id="urlyoutube"></td>
						</tr>
						<tr>
							<td>
								<input type="submit" name="submit" value="Submit">
							</td>
						</tr>
					</table>
					</p>
					</form>

				
				<form action="uploadpic_handler.php" method="post"
				enctype="multipart/form-data">
					<input type="hidden" name="size" value="big">
					<table class="profile">	
						<tr>
							<td>Code</td>
							<td><input type="text" name="bookcode" 
							value="<? echo $_GET['bookcode'];?>"></td>
						</tr>
						<tr>
							<td>Judul</td>
							<td><input type="text" name="title"
							value="<? echo $_GET['title']; ?>"></td>
						</tr>
						<tr>
							<td><label for="URL">URL Gambar (60x85)</label></td>
							<td><input type="text" name="imgurl" ></td>
						</tr>
						<tr>
							<td><label for="urlyoutube">URL Youtube</label></td>
							<td><input type="text" name="urlyoutube" id="urlyoutube"></td>
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
