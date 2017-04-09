<?php
	include 'mysql_comic.php';
	
	$imgurl = $_POST['urlimage'];

	if($_POST['thisdate'] != "" )  
	{
    	echo "<br>Tanggal = ".$_POST['thisdate'];
		echo "<br>";
	}
	else
	{
		echo "<br>ERROR: Cannot find Date<br>";
		echo "ERROR: Tanggal nya kosong";
		exit;
	}

	if ( $_POST['article'] == "" ) {
		echo "ERROR: Artikelnya kosong";
		exit;
	}
	$type = $_POST['type'];
	$date = $_POST['thisdate'];
	$title = $type." ".$date; 
	$article = $_POST['article'];
	if ( $type == "New Release" )
		$link = "newrelease.php?refdate=".$date;
	else if ( $type == "Coming Soon" )
		$link = "comingsoon.php?title=".$title;
	
	$picfilename = "cover/".$title.".jpg";
	/*******************************************/
	if ( $imgurl != '' ) {
		$res = file_put_contents($picfilename, file_get_contents($imgurl));
		echo "<br>Check Apakah UPLOAD SUKSES? <br>";
		//header("Location: booktitle.php?search=".$_POST['title']);
		echo "<a href=/>Check Result</a>";
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

    		if (file_exists("cover/".$title.".jpg"))//"upload/" . $_FILES["file"]["name"]))
      		{
      			//echo $_FILES["file"]["name"] . " already exists. ";
      			echo "cover/".$title.".jpg already exists";
				exit;
			}
    		//else
      		{
      			move_uploaded_file($_FILES["file"]["tmp_name"],
      			"cover/".$title.".jpg");
				//"upload/" . $_FILES["file"]["name"]);
      			echo "<br>Stored in: " . "cover/" . $title.".jpg";//$_FILES["file"]["name"];
      		}
    	}
  	}
}	
	//else
  	//{
  	//	echo "Invalid file";
  	//}

	
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query = "INSERT INTO newsevent values('".$date."','".$title."','".
							$article."','".$link."')";
	
	echo "<br>query = ".$query;
	$result = $mysql->query($query);
	echo "<br><br>RESULT = ";
	var_dump($result);
	echo "<br><br><br>UPLOAD SUKSES";
//	sleep(2);
//	header('Location: nr_cs.php');
?>
