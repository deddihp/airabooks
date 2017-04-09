<?
	session_start();
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
	if ( isset($_SESSION['fb_id'] )==true) {
		$fb_info = getFBInfo($_SESSION['fb_id']);
		if ( $fb_info['role'] != 'ADMIN' ) {
			
			echo "Harus Admin";
			return;
		}
	} else {
		echo "Harus Admin";
		return;
	}
		
?>
<html>
<head>
</head>
<body>
Admin : <? echo $fb_info['full_name']; ?>
<p class="h2">
						Upload Picture	
						</p>
<!--						<form name="newsadd", method="get" action="addnews.php">-->
			<form action="uploadpic_handler.php" method="post"
				enctype="multipart/form-data">
					<input type="hidden" name="size" value="small">
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
							<td>Pengarang</td>
							<td><input type="text" name="author"
								value="<?echo $_GET['author'];?>">
							</td>
						</tr>
						<tr>
							<td><label for="file">File Gambar (60x85)</label></td>
							<td><input type="file" name="file" id="file"></td>
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
					<input type="hidden" name="size" value="small">
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
							<td>
								<input type="submit" name="submit" value="Submit">
							</td>
						</tr>
					</table>
					</p>
					</form>

</body>
</html>
