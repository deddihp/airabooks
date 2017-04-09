<?php
	include 'lib/mysql_comic.php';
	
	if($_POST['bookcode'] != "" )  
	{
    	echo "<br>Code = ".$_POST['bookcode'];
		echo "<br>";
	}
	else
	{
		echo "<br>ERROR: Cannot find Code<br>";
		echo "ERROR: Code nya kosong";
		exit;
	}
	$code = $_POST['bookcode'];
	$size = $_POST['size'];
	$picfilename = "cover_".$size."/".$code.".jpg";	
	$imgurl = $_POST['imgurl'];
	$title = $_POST['title'];
	$urlyoutube = str_replace('watch?v=','embed/', $_POST['urlyoutube']);

	if ( $urlyoutube != '' ) {
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$query = "DELETE FROM book_add_info WHERE code='".$code."'";
		$result = $mysql->query($query);
		print_r($result);
		$query = "INSERT INTO book_add_info VALUES('".$code."', '".$urlyoutube."')";
		$result = $mysql->query($query);
		print_r($result);
		echo "<br>INSERT : QUERY = ".$query."<br>";
		echo "<br>Check Apakah UPLOAD SUKSES? <br>";
		//header("Location: booktitle.php?search=".$_POST['title']);
		if ( $size == "big" )
			echo "<a href=http://airabooks.com/wiki/wikibook.php?bookcode=".$code."\">Check Result</a>";
		else
			echo "<a href=\"http://airabooks.com/wiki/wikibook.php?bookcode=".$code."\">Check Result</a>";
		echo "<br>";
	}

	echo "imgurl = ".$imgurl;	
/*******************************************/
	if ( $imgurl != '' ) {
		$res = file_put_contents($picfilename, file_get_contents($imgurl));
		echo "<br>Check Apakah UPLOAD SUKSES? <br>";
		//header("Location: booktitle.php?search=".$_POST['title']);
		echo "<a href=\"http://airabooks.com/wiki/wikibook.php?bookcode=".$code."\">Check Result</a>";
		
	} else {

/*******************************************/
	
	
	
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	/*if (	(($_FILES["file"]["type"] == "image/gif")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/jpg")
					|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 20000)
			&& in_array($extension, $allowedExts))
  	*/
	{
  		if ($_FILES["file"]["error"] > 0)
    	{
    		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    		echo "Tidak ada file gambar yang di upload";
			exit;
		}
  		else
    	{
    		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    		echo "Type: " . $_FILES["file"]["type"] . "<br>";
    		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
			if ( $_FILES["file"]["size"] == 0 ) {
				echo "SIZE 0 NO STORE";
				continue;
			}
    		if (file_exists($picfilename) )//"upload/" . $_FILES["file"]["name"]))
      		{
      			//echo $_FILES["file"]["name"] . " already exists. ";
      			echo $picfilename." already exists";
				//header("Location: booktitle.php?search=".$title);
				exit;
			}
    		//else
      		{
      			move_uploaded_file($_FILES["file"]["tmp_name"],
      			$picfilename);
				//"upload/" . $_FILES["file"]["name"]);
      			echo "<br>Stored in: ".$picfilename;//$_FILES["file"]["name"];
      		}
    	}
  	}
	
	echo "<br><br><br>UPLOAD SUKSES";
	}
	//header('Location: booktitle.php?search='.$title);
	
?>
