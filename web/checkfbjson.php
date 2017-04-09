<?
	//$request = sprintf("https://api.facebook.com/method/fql.query?query=%s&format=json", $query);
 	$request = "http://graph.facebook.com/1192425363";
	$json = file_get_contents($request);
	$json = json_decode($json);
	$ham = $json; 
	//print_r($json[0]);
	print_r($json);
	echo($ham->{'name'});
?>
