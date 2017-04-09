<?php
	session_start();
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
	if ( isset($_SESSION['role']) != 'ADMIN' ) {
		echo "Evaluation Mode, Anda Harus Masuk Sebagai Admin";
		return;
	}
?>
<?php
	/* Define Header */
	$mlayout = new MainLayout;	
	$bookscommon = new BooksCommon;
	$memberlayout = new MemberLayout;
?>
<html>
	<head>
		<?php
			echo $mlayout->writeHeadParameter();
		?>
		<script>
			function jxReload(month, year) {
				var xmlhttp;
				if (window.XMLHttpRequest)
  				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
				xmlhttp.onreadystatechange=function()
  					{
  						if (xmlhttp.readyState==4 && xmlhttp.status==200)
    					{
    						//console.log('ok');
							document.getElementById('memberofthemonth').innerHTML = xmlhttp.responseText;
							console.log('change the docs here');
							
							var html_str = xmlhttp.responseText;
							var JSON_POS = html_str.search('JSON-DATA');
							console.log(JSON_POS);
							var END_JSON_POS = html_str.search('JSON-DATA_END');
							console.log('END JSON = '+END_JSON_POS);
							var json =html_str.substring(JSON_POS+9, END_JSON_POS-1);
							console.log(json);
							var subs_id_list = json.split(',');
							jxFBUserProfile(0, subs_id_list);
							

						}
  					}
				xmlhttp.open("GET",'jxmemberofthemonth.php?month='+month+'&year='+year,true);
				res = xmlhttp.send();
				console.log(xmlhttp.responseHtml);
			}
		</script>
	</head>
	<body>
		<?
			echo $mlayout->writeHeader();
		?>
	<div id="maincontent" class="maincontent">	
		<?
			echo $mlayout->writeMenu("Member Of The Month", "", "./");
		?>
		<?
			$month = $_GET['month'];
			$year = $_GET['year'];
			if ( $month == "" )
				$month = date('m');
			if ( $year == "" )
				$year = date('Y');
			
			echo $memberlayout->writeMemberOfTheMonth($month, $year, $mlayout, 
				"Member Of The Month (Bulan ".MonthToIndo((int)$month-1)." ".$year.")", "memberofthemonth.php", $subscriber_id_list);
			//for ( $i = 0; $i < count($subscriber_id_list); $i++ ) {
			//	echo " IDIDID = ".$subscriber_id_list[$i]."<br>";
			//}
			//echo writeSubscriberGroup($subscriber_id_list);
		
			//echo "
			//<div style=\"display:none\">
			//JSON-DATA";
			for ( $i = 0; $i < count($subscriber_id_list); $i++ ) {
				$json = $json.$subscriber_id_list[$i];
				if ( $i < count($subscriber_id_list)-1 )
					$json = $json.",";
			}
			//echo writeJXSubscriberGroup($subscriber_id_list);
			//echo "JSON-DATA_END
			//</div>";
		?>
		<script>
			$(document).ready(function() {
				var json = '<?echo $json;?>';
				window.subs_id_list = json.split(',');
				//console.log('Try to call fbuserprofile');
				//var myVar = setInterval(jxFBUserProfile(0, subs_id_list),3000);
			});
		</script>

		<?
			echo $mlayout->writeFooter();
		?>
	</div>
	</body>
</html>
