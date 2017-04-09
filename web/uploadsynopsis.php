<?
	session_start();
?>
<!DOCTYPE html>
<? 
	include 'lib/mysql_comic.php'; 
	//include 'book.php';
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>airabooks' Collection</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
					
						<p class="h2">
						Upload Synopsis	
						</p>
<!--						<form name="newsadd", method="get" action="addnews.php">-->
			<form action="uploadsynopsis_handler.php" method="post"
				enctype="multipart/form-data">
					<input type="hidden" name="size" value="small">
					<table class="profile" style="padding:10px; ">	
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
							<td><label for="synopsis">Synopsis</label></td>
							<td>
							<?
								$query = "SELECT a.synopsis as synopsis_a, b.synopsis as synopsis_b FROM book_title a, ".$GLOBALS['COMIC_DBWEB'].".comic_rating b WHERE a.code=b.code AND a.code='".$_GET['bookcode']."'";
								//echo "QUQERY = ".$query;
								$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
								$result = $mysql->query($query);
								$row = mysqli_fetch_array($result);
								$synopsis = $row['synopsis_a'];
								if ( $row['synopsis_b'] != '' )
									$synopsis = $row['synopsis_b'];
							?>
							<textarea rows="20" cols="100" name="synopsis" id="synopsis" ><?echo $synopsis;?></textarea></td>
						</tr>
						<tr>
							<td>
								Kontributor
							</td>
							<td>
								<?
									$query = "SELECT * FROM synopsis_contributor WHERE book_code='".$_GET['bookcode']."'";
									$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
									$result = $mysql->query($query);
									while ( $row = mysqli_fetch_array($result) ) {
										echo "<img src=http://graph.facebook.com/".$row['user_id']."/picture width=\"30px\">";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>
								Klaim Kontributor
							</td>
							<td>
								<?
									echo $_SESSION['full_name'];
								?>
								<input type="hidden" name="user_id" value="<? echo $_SESSION['fb_id'];?>"></input>
								<br>
								<!--<a href="" onclick="javascript:ClaimSynopsis('<?echo $_GET['bookcode'];?>', '<? echo $_SESSION['fb_id'];?>');">Claim</a>
								-->
								
								<script>
									function ClaimSynopsis(code, user_id) {
										alert(code+' '+user_id);
									}
								</script>
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

				
			
			</body>
</html>
