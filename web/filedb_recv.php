<?php
include 'mysql_comic.php';
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$extension = end(explode(".", $_FILES["upload"]["name"]));
	/*if (	(($_FILES["upload"]["type"] == "image/gif")
					|| ($_FILES["upload"]["type"] == "image/jpeg")
					|| ($_FILES["upload"]["type"] == "image/jpg")
					|| ($_FILES["upload"]["type"] == "image/png"))
			&& ($_FILES["upload"]["size"] < 20000)
			&& in_array($extension, $allowedExts))
  	*/
	{
  		if ($_FILES["upload"]["error"] > 0)
    	{
    		echo "Return Code: " . $_FILES["upload"]["error"] . "<br>";
    	}
  		else
    	{
    		echo "Upload: " . $_FILES["upload"]["name"] . "<br>";
    		echo "Type: " . $_FILES["upload"]["type"] . "<br>";
    		echo "Size: " . ($_FILES["upload"]["size"] / 1024) . " kB<br>";
    		echo "Temp file: " . $_FILES["upload"]["tmp_name"] . "<br>";

    		if (file_exists("cover/".$_POST['title'].".jpg"))//"upload/" . $_FILES["upload"]["name"]))
      		{
      			echo $_FILES["upload"]["name"] . " already exists. ";
      		}
    		//else
      		{
      			move_uploaded_file($_FILES["upload"]["tmp_name"],
      			"cover/".$_POST['title'].".jpg");
				//"upload/" . $_FILES["upload"]["name"]);
      			echo "<br>Stored in: " . "cover/" . $_POST['title'].".jpg";//$_FILES["upload"]["name"];
      		}
    	}
  	}
	//else
  	//{
  	//	echo "Invalid file";
  	//}

	
	if(isset($_POST['title']))  
	{
    	echo "<br>Judul = ".$_POST['title'];
		echo "<br>";
	}
	else
	{
		echo "<br>ERROR: Cannot find title<br>";
	}
	$date = $_POST['thisdate'];
	$title = $_POST['title'];
	$article = $_POST['article'];
	$link = "newrelease.php?refdate=".$date;
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query = "INSERT INTO newsevent values('".$date."','".$title."','".
							$article."','".$link."')";
	
	echo "<br>query = ".$query;
	$result = $mysql->query($query);
	echo "<br><br>RESULT = ";
	var_dump($result);	
?>
