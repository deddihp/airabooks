<?php
	session_start();
	/* Define All Class */
	include '../lib/layout.php';
	include '../lib/mysql_comic.php';
	include '../lib/book.php';
?>
<?php
	/* Define Header */
	$mlayout = new MainLayout;
	$wlayout = new WikiLayout;
	$rpop = new RandomPopular;
?>
<html>
	<title>Team</title>
	<head>
		<?php
			echo $mlayout->writeHeadParameter('../');
		?>
		<?
				$ATeam = Array (
				'deddi.hariprawira',
				'doddi.adinugroho',
				'ranaze88',
				'mira.widiastuti.96',
				'13nov93',
				'iman.salamun'
			);
				$json = "";
				for ( $i = 0; $i < count($ATeam); $i++ ) {
					$json = $json.$ATeam[$i];
					if ( $i < count($ATeam)-1 )
						$json = $json . ",";
				}
			//	echo "JSJSJSJSON = ".$json;
		//		echo writeFBTeam($ATeam);
		?>
		<script>
			$(document).ready(function() {
				var json = '<? echo $json; ?>';
				//alert(json.split('.').join('_'));
				window.subs_id_list = json.split(',');
			//	console.log('length = '+window.subs_id_list.length);
			});
		</script>
	</head>
	<body>
		<?
			//$rpop->getPopularRandom();
			echo $mlayout->writeHeader('../');
		?>
	<div id="maincontent" class="maincontent">	
		<?
			echo $mlayout->writeMenu('Team', "Team", "", "../");
		?>
		<div class="mcontent">
		<div class="wiki">
		<p class="wiki-title">airabooks Team</p>
		<div style=" margin:-10px 0 10px 60px;border:1px solid #e2e2e2; display:block; width:728px;height:90px;">
			<!--Ads Here-->
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-8383814472901134";
				/* Iklan_Horizontal */
				google_ad_slot = "3585301821";
				google_ad_width = 728;
				google_ad_height = 90;
				//-->
			</script>
			<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
		<div style="margin:0 0 10px 0; border:0px solid black; display:table; width:100%;">
		<?
			for ( $i = 0; $i < count($ATeam); $i++ ) {
				echo $wlayout->writeFBBox($ATeam[$i]);
			}
		?>
		</div>
		</div>
		</div>
		<?
			echo $mlayout->writeFooter('../');
		?>
	</div>
	</body>
</html>
