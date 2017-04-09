<!DOCTYPE html>
<?php
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
?>
<?php
	/* Define Header */
	$mlayout = new MainLayout;	
	$rpop = new RandomPopular;
?>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<?php
		//session_start();
		echo $mlayout->writeHeadParameter();
		?>
		<script>
			$(document).ready(function() {
				//$('#mcontent').fadeOut();
				var con = 'mcontent';
				console.log($('#'+con));
				//$('#'+con).fadeOut();
				//console.log(con);
				console.log(document.getElementById('mcontent'));
			});
		</script>
	</head>
	<body>
	
	<?
			
/*		if ( isset($_SESSION['fb_id']) ) {
			echo "ISSET SESSION ID INDEX = ".session_id();		
			
		
			echo "<div style=\"border:1px solid blue;height:200px ;display:block; position:absolute;z-index:100; \">ISSET SESSION ID INDEX  = ".session_id()."
		<br>fb_id = ".$_SESSION['fb_id']."<br>
		subscriber_id = ".$_SESSION['subscriber_id']."<br>
		</div>";
	

		}
		if ( isset($_GET['fb_id']) ) {
			$fb_id = $_GET['fb_id'];
			$subscriber_id = $_GET['subscriber_id'];
			if ( $fb_id != "" ) {
				//	session_start();
				$_SESSION['fb_id'] = $fb_id;
				$_SESSION['subscriber_id'] = $subscriber_id;
				echo "FB ID TIDAK KOSONG";
			} else {
				echo "FB ID KOSONG";
			}
		}
		echo "<div style=\"border:1px solid red;height:200px ;display:block; position:absolute;z-index:100; \">SESSION ID INDEX  = ".session_id()."
		<br>fb_id = ".$_SESSION['fb_id']."<br>
		subscriber_id = ".$_SESSION['subscriber_id']."<br>";
		print_r($_SESSION);
		echo "</div>";
*/	
	?>
	<?
			//$rpop->getPopularRandom();
			//echo $mlayout->writeBodyHeader();
			//echo $mlayout->writeHeader();
	?>
	<div id="maincontent" class="maincontent">	
	
	<?
		echo $mlayout->writeMenu('Home', "");
	?>
		<div class="mcontent" id="mcontent">
		
		<!--<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>-->
		<?
			$content = $rpop->getPopularRandom();
			echo $mlayout->writeBOXContent($content);
			
			echo "<div class=\"hline\"></div>";
			
			$content = $rpop->getNewRelease(5);
			echo $mlayout->writeBOXLONGContent($content);
	
			echo "<div class=\"hline\"></div>";
			
			$content = $rpop->getMostPopular(5);
			echo $mlayout->writeBOXLONGContent($content);
			
			echo "<div class=\"hline\"></div>";
			
			$content = $rpop->getMostRecommended(5);
			echo $mlayout->writeBOXLONGContent($content);
			
			$content = $rpop->getBooksOfTheMonth(5);
			if ( count($content) > 2 ) {
				echo "<div class=\"hline\"></div>";
				echo $mlayout->writeBOXLONGContent($content);//boxlongctnt);
			}

		?>
		</div>
		<div style="border:0px solid black;float:left;
			//width:142px;"
		></div>
		
		<?
			echo $mlayout->writeFooter();
		?>
	</div>
	</body>
</html>
