<?
session_start();
	include 'lib/mysql_comic.php';
	include 'lib/layout.php';
	include 'lib/book.php';
	if ( isset($_SESSION['fb_id']) === false ) {
		echo "Maaf anda harus login";
	}
	$bookcode = $_GET['bookcode'];
	$wrong = false;
	if ( isset($_SESSION['fb_id']) === true && isset($_POST['type']) === true ) {
		$bookcode = $_POST['bookcode'];
		$direction = $_POST['direction'];
		$name = $_POST['character_name'];
		//echo "TESTING DI SINI " . $_POST['type'];
		//echo "bookcode = ".$bookcode;
		//echo "direction = ".$direction;
	
		//obtain current position
		$query = "SELECT * FROM synopsis_character WHERE book_code='".$bookcode."' AND character_name='".$name."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$cur = $row['order'];
		//echo "CUR = ".$cur;
		if ( $direction != '' ) {
			$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".synopsis_log VALUES(NOW(), '".$_SESSION['fb_id']."','edit_character_profile', '".$_POST['bookcode']."', 0, '".$cur."', 'change_order', '".$direction."')";
			$mysql->query($query);	


			if ( $direction === 'up' )	{
				if ( $cur != 1 ) {
					$query = "UPDATE synopsis_character SET synopsis_character.order=".($cur)." WHERE book_code='".$bookcode."' AND synopsis_character.order=".($cur-1);
					$mysql->query($query);
					$query = "UPDATE synopsis_character SET synopsis_character.order=".($cur-1)." WHERE book_code='".$bookcode."' AND character_name='".$name."'";
					$mysql->query($query);
				}
			} else if ( $direction === 'down' ) {
				$query = "SELECT COUNT(*) as count FROM synopsis_character WHERE book_code='".$bookcode."'";
				$result = $mysql->query($query);
				$row = mysqli_fetch_array($result);
				$number = $row['count'];
				if ( $cur < $number ) {
					$query = "UPDATE synopsis_character SET synopsis_character.order=".($cur)." WHERE  book_code='".$bookcode."' AND synopsis_character.order=".($cur+1);
					$mysql->query($query);
					$query = "UPDATE synopsis_character SET synopsis_character.order=".($cur+1)." WHERE  book_code='".$bookcode."' AND character_name='".$name."'";
					$mysql->query($query);
				}
			}
		}
	}
	if ( isset($_SESSION['fb_id']) === true && isset($_POST['bookcode']) === true && isset($_POST['type']) === false ) {
		$bookcode = $_POST['bookcode'];
		$character_name = $_POST['character_name'];
		if ( $character_name === '' ) {
			$wrong = true;
			echo "
			<p>
				<span style=\"padding:10px;border-radius:10px;font:normal 15px/18px Arial, sans-serif; background-color:Red; color:white;
					font-weight:bold;\">Perhatian!!!. Anda belum memasukkan nama karakter.</span>
			</p>";
		} else {
			$query = "SELECT UPPER(character_name) as character_name FROM synopsis_character WHERE book_code='".$bookcode."' AND character_name LIKE '".strtoupper(str_replace(' ', '%', $character_name))."'";
			//echo "QUERY = ".$query;
			$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
			$result = $mysql->query($query);
			//echo "numrows = ".mysqli_num_rows($result);
			
			if ( mysqli_num_rows($result) > 0 ) {
				echo "
			<p>
				<span style=\"padding:10px;border-radius:10px;font:normal 15px/18px Arial, sans-serif; background-color:Red; color:white;
					font-weight:bold;\">Perhatian!!!. Nama tokoh yang anda masukkan sudah tersedia.</span>
			</p>";
				$wrong = true;
			}
			$query = "SELECT * FROM synopsis_character WHERE book_code='".$bookcode."'";
			//echo "QUERY = ".$query;
			$result = $mysql->query($query);
			$character_number = mysqli_num_rows($result);
		}

		$image_url = $_POST['imgurl'];
		//echo "->".$bookcode.",".$character_name.",".$image_url;
		$picfilename = "character_pic/".$bookcode."_".$character_name.".jpg";
		if ( $image_url != '' ) {
			$res = file_put_contents($picfilename, file_get_contents($image_url));
		} else {
		//	echo "get from url";
			if ( $_FILES["file"]["error"] > 0 ) {
				$wrong = true;
				echo "
			<p>
				<span style=\"padding:10px;border-radius:10px;font:normal 15px/18px Arial, sans-serif; background-color:Red; color:white;
					font-weight:bold;\">Perhatian!!!. Anda belum memasukkan URL Gambar atau Lokasi Gambar anda.</span>
			</p>";
			} else {
				/*echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    			echo "Type: " . $_FILES["file"]["type"] . "<br>";
    			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
				*/
				if ( $_FILES["file"]["size"] == 0 ) {
					//echo "SIZE 0 NO STORE";
					$wrong = true;
					continue;
				}
				if (file_exists($picfilename) )//"upload/" . $_FILES["file"]["name"]))
      			{
      				//echo $_FILES["file"]["name"] . " already exists. ";
      				echo $picfilename." already exists";
					//header("Location: booktitle.php?search=".$title);
				}
    			//else
      			{
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
		if ( $wrong ) {
			echo "
			<p>
				<span style=\"padding:10px;border-radius:10px;font:normal 15px/18px Arial, sans-serif; background-color:Red; color:white;
					font-weight:bold;\">Perhatian!!!. Gagal Memasukkan Tokoh.</span>
			</p>";
			}
			
			if ( $wrong == false ) {
				$query = "INSERT INTO synopsis_character VALUES('".$bookcode."', '".$character_name."', ".($character_number+1).", '')";
				$result = $mysql->query($query);
				//echo "QUERY = ".$query;
				
				$query = "INSERT INTO ".$GLOBALS['COMIC_DBWEB'].".synopsis_log VALUES(NOW(), '".$_SESSION['fb_id']."','add_character_profile', '".$_POST['bookcode']."', 0, '".$character_name."', 'add', '')";
			$mysql->query($query);	


				echo "
			<p>
				<span style=\"padding:10px;border-radius:10px;font:normal 15px/18px Arial, sans-serif; background-color:Green; color:white;
					font-weight:bold;\">Sukses</span>
			</p>";
			}
		
	}

	?>
	<div id="add_character_content">
	<?
	echo "<p style=\"font:normal 15px/18px Arial, sans-serif; font-weight:bold;\">Edit / Tambah Tokoh di ".getBookTitle($bookcode)."</p>";
	$query = "SELECT * FROM synopsis_character WHERE book_code='".$bookcode."' ORDER BY synopsis_character.order";
	
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	/*$content = $content . "
	<div style=\"float:left; border:1px solid black;\">
	<table style=\"border:1px solid #e2e2e2;\">
	<tr style=\"background-color:#d1d1ff;\">
		<td>
			Nama Karakter
		</td>
		<td>
			<input type='text'></input>
		</td>
	</tr>
	<tr>
		<td>
			<button>Tambah Tokoh</button>
		</td>
	</tr>
	</table>
	";*/
	?>

	<div style="border:1px solid #e2e2e2; width:35%; float:left;margin:0 5px 5px 5px;
				text-align:center; font:normal 13px/18px Arial, sans-serif;">
				<?
					$img_src = "../cover_small/".$row['book_code'];
					if ( !file_exists($img_src) ) {
						$img_src = "../cover_small/nophoto.png";
					}
				?>
				<p style="font:normal 13px/15px Arial, sans-serif; font-weight:bold;margin:5px;">Tambah Profil Tokoh</p>
				<!--<img id="img_cover_image" src="<? echo $img_src; ?>" width="75px" height="120px">-->
				<table style="font:normal 13px/13px Arial, sans-serif;">
					<form action="addcharacter.php" id="insert_character_image">
					<input type="hidden" name="bookcode" value="<? echo $bookcode;?>">
						
						<tr>
							<td>
								Nama Tokoh
							</td>
							<td>
								<input style="width:200px;" type="text" name="character_name"></input>
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
								<button onclick="javascript:InsertCharacterImageSubmit();">Submit</button>
							</td>
						</tr>
					</table>
				<script>
					function onprogressHandler(evt) {
							var percent = evt.loaded/evt.total*100;
							console.log('Upload progress: ' + percent + '%');						}
					function onsuccess(evt) {
						console.log('success '+this.responseText);
						document.getElementById('img_cover_image').src='cover_small/<? echo $row['book_code'];?>';
							
					}
					$('#insert_cover_image').submit(function(event) {
						console.log('submit here');
						event.preventDefault();
						var $form = $(this),
						file = $form.find('input[name="file"]').val(),
						imgurl = $form.find('input[name="imgurl"]').val(),
						book_code = $form.find('input[name="book_code"]').val(),
						url = $form.attr('action');
						
						var mform = document.getElementById('insert_cover_image');
						var dataku = new FormData(mform);
						var xhr = new XMLHttpRequest();
						
						xhr.upload.addEventListener('progress', onprogressHandler, false);
						//xhr.upload.addEventListener('load', onsuccess, false);
						xhr.onload = onsuccess;
						xhr.open('POST', 'dbop.php', true);
						xhr.send(dataku); // Simple!
						//console.log('data = '+JSON.stringify(dataku));
						//data.append('type','insert_cover_image');
						//data.append('file',file);
						//data.append('imgurl',imgurl);
						//data.append('book_code',book_code);
						/*data: {
								type:'insert_cover_image',
								file: file,
								imgurl:imgurl,
								book_code:book_code
							},*/
						/*$.ajax({
							url:url,
							type:"POST",
							data:dataku,	
							processData:false,
							contentType:false,
							//cache:false,
							success:function(content){
								alert(content);
								document.getElementById('img_cover_image').src='cover_small/<? echo $row['book_code'];?>';
							}
						});*/


					});
				</script>
			</div>
	

	<?
	$content = "<div style=\"float:left; border:1px solid black;width:60%;\"> <table border=\"1px\" cellspacing=\"0px\" cellpadding=\"2px\"
		style=\"width:100%; display:block; clear:left;font:normal 13px/18px Arial, sans-serif; border:0px solid #b1b1b1;background-color:#b1b1b1;\"	
	>
	<tr style=\"font-weight:bold;background-color:#d1d1d1;text-align:center;\"><td>No.</td><td>Nama</td><td>Gambar</td><td>Posisi</td></tr>";
	$count = 1;
	while ( $row = mysqli_fetch_array($result) ) {
		$content = $content . "
			<tr style=\"background-color:#f1f1f1;\">
			<td>".$count++.".
			</td>
			<td>".
				$row['character_name']." 
				<a href=# style=\"display:none;\"><span style=\"font:normal 10px/10px Arial, sans-serif;\">[ Laporkan kesalahan ] </span></a>
				<a href=# onclick=\"javascript:EditCharacter('".$row['book_code']."','".$row['character_name']."')\"><span style=\"font:normal 10px/10px Arial, sans-serif;\">[ edit ] </span></a>
".
			"</td><td style=\"text-align:center;\">
			<img src=\"../character_pic/".$row['book_code']."_".$row['character_name'].".jpg\" width=\"75px\" height=\"75px\"
				style=\"border:1px solid #e2e2e2;border-radius:75px;\"></td>
			<td style=\"width:65px;\">
			<a href='javascript:void(0)'
				onclick=\"javascript:UpdateCharacterPosition('".$row['book_code']."', '".$row['character_name']."','up');\"
			><img src='../images/arrow_up.png' width=\"30px;\"></a>
			<a href='javascript:void(0)'
			onclick=\"javascript:UpdateCharacterPosition('".$row['book_code']."','".$row['character_name']."','down');\"
			
			><img src='../images/arrow_down.png' width=\"30px;\"></a>
			</td></tr>";
	}
	$content = $content . "</table>
	</div>";
	$content = $content . "<button onclick=\"javascript:RefreshBrowser();\">Refresh</button>";
	
	echo $content;
	?>
	</div>	


