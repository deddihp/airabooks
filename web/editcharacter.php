<?
session_start();
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
	include 'lib/layout.php';
	if ( isset($_SESSION['fb_id']) == false ) {
		echo "Maaf anda harus login terlebih dahulu";
		return;
	}
?>

<?
	//print_r($_POST);
	//echo "character_name = ".$_POST['character_name'];
	if ( isset($_POST['bookcode']) === true ) {
		$bookcode = $_POST['bookcode'];
		$new_name = $_POST['new_name'];
		$old_name = $_POST['old_name'];
		$image_url = $_POST['imgurl'];
		if ( str_replace(' ','',$new_name) === '' ) {
			echo 'empty';
			return;
		}
		$query = "UPDATE synopsis_character SET character_name='".$new_name."' WHERE character_name='".$old_name."' AND book_code='".$bookcode."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$mysql->query($query);
	
		$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".synopsis_log VALUES(NOW(), '".$_SESSION['fb_id']."','edit_character_profile', '".$_POST['bookcode']."', 0, '".$new_name."', 'update', '".$old_name." -> ".$new_name."')";
			$mysql->query($query);	


	//	echo "QUERY = ".$query;	
		$wrong = false;
		$picfilename = "character_pic/".$bookcode."_".$new_name.".jpg";
		$picfilename_old = "character_pic/".$bookcode."_".$old_name.".jpg";
		rename($picfilename_old, $picfilename);
		if ( $image_url != '' ) {
			$res = file_put_contents($picfilename, file_get_contents($image_url));
		} else {
			if ( $_FILES["file"]["error"] > 0 ) {
				$wrong = true;
				
			/*	echo "
			<p>
				<span style=\"padding:10px;border-radius:10px;font:normal 15px/18px Arial, sans-serif; background-color:Red; color:white;
					font-weight:bold;\">Perhatian!!!. Anda belum memasukkan URL Gambar atau Lokasi Gambar anda.</span>
			</p>";*/
			} else {
				/*echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    			echo "Type: " . $_FILES["file"]["type"] . "<br>";
    			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
				*/
				if ( $_FILES["file"]["size"] == 0 ) {
					//echo "SIZE 0 NO STORE";
					$wrong = true;
				}
				if (file_exists($picfilename) )//"upload/" . $_FILES["file"]["name"]))
      			{
      				//echo $_FILES["file"]["name"] . " already exists. ";
      				//echo $picfilename." already exists";
					//header("Location: booktitle.php?search=".$title);
				}
    			//else
      			{
      				//echo "upload here";
					$res = move_uploaded_file($_FILES["file"]["tmp_name"],
      					$picfilename);
				//	print_r('res -> '.$res);
					//"upload/" . $_FILES["file"]["name"]);
      				//echo "<br>Stored in: ".$picfilename;//$_FILES["file"]["name"];
      				if ( !file_exists($picfilename) ) {
						$wrong = true;
					}
				}
			}
		}
		
		echo urlencode($_POST['bookcode']);
		return;
	}
?>
	<?
		$bookcode = $_GET['bookcode'];
	?>
<div style="border:0px solid black; display:table;margin:0 auto;" >
	<div style="border:1px solid #e2e2e2; width:400px; float:left;margin:0 5px 5px 5px;
				text-align:center; font:normal 13px/18px Arial, sans-serif;">
				<?
					$img_src = "../cover_small/".$row['book_code'];
					if ( !file_exists($img_src) ) {
						$img_src = "../cover_small/nophoto.png";
					}
				?>
				<p style="font:normal 13px/15px Arial, sans-serif; font-weight:bold;margin:5px;">Edit Profil Tokoh</p>
				<!--<img id="img_cover_image" src="<? echo $img_src; ?>" width="75px" height="120px">-->
				<table style="font:normal 13px/13px Arial, sans-serif;">
					<form action="editcharacter.php" id="edit_character">
						<input type="hidden" name="bookcode" value="<? echo $bookcode;?>">
						
						<input type="hidden" name="old_name" value="<?echo $_GET['character_name'];?>">
						<tr>
							<td>
								Nama Tokoh
							</td>
							<td>
								<input style="width:200px;" type="text" name="new_name" value="<? echo $_GET['character_name'];?>"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="file">Upload Gambar Dari File</label>
							</td>
							<td>
								<input type="file" name="file" id="file">
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<p style="margin:5px;font-weight:bold;">atau</p>
							</td>
						</tr>
						<tr>
							<td>
								<label for="urlpic">Upload Gambar Dari URL</label>
							</td>
							<td>
								<input style="width:200px;" type="text" name="imgurl">
							</td>
						</tr>
				</form>		
						<tr>
							<td>
								<button onclick="javascript:EditCharacterImageSubmit();">Update</button>
							</td>
						</tr>
					</table>
				</div>
				
				<div style="display:table;border:1px solid aaaaff; background-color:white; margin:5px;padding-top:5px;">
				<img src='../character_pic/<? echo $_GET['bookcode'];?>_<? echo $_GET['character_name'];?>.jpg' style="width:75px; height:75px; border-radius:75px;">
				<p style="font:normal 13px/18px Arial, sans-serif;
					background-color:#aaaaff; margin-top:5px; padding:5px;
					">Gambar Saat Ini</p>
				</div>
	</div>	
