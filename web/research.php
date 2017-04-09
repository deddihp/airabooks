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
<html>
	<head>
		<?php
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
		<div style="
			position:relative;
			width:0;
			height:0;
			top:0px;
			left:0px;
			border:1px solid green;
		">
			<!-- Main Div -->
			<div style="position:absolute;
				top:0px;
				left:0px;
				background:white;
				width:400px;
				border:1px solid red;
				">
				<!-- Div Arrow -->
				<!--<div style="
					position:relative;
					display:table;
					width:100%;
					border:1px solid grey;
					height:3px;
				">
					<div style="
						position:absolute;
						left:20px;
						width:0;
						height:0;
						border-bottom:15px solid #e2e2e2;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
					">
					</div>
					<div style="
						position:absolute;
						left:20px;
						top:1px;
						width:0;
						height:0;
						border-bottom:15px solid white;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
					">
					</div>
				</div>-->
				<!-- Div Arrow Left 
				<div style="
					position:relative;
					float:left;
					display:table;
					width:2px;
					border:1px solid grey;
					height:100px;
				">
					<div style="
						position:absolute;
						left:0px;
						top:20px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid #e2e2e2;
						border-top:15px solid transparent;
					">
					</div>
					<div style="
						position:absolute;
						left:0px;
						top:20px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-right:15px solid white;
						border-top:15px solid transparent;
					">
					</div>
				</div>-->
				<!-- Div Arrow Right--> 
				<div style="
					position:relative;
					float:right;
					display:table;
					width:2px;
					border:1px solid grey;
					height:100px;
				">
					<div style="
						position:absolute;
						left:-10px;
						top:20px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-left:15px solid #e2e2e2;
						border-top:15px solid transparent;
					">
					</div>
					<div style="
						position:absolute;
						left:-10px;
						top:20px;
						width:0;
						height:0;
						border-bottom:15px solid transparent;
						border-left:15px solid white;
						border-top:15px solid transparent;
					">
					</div>
				</div>
				<!--
					Table Arrow Top
					<table width="100%" border="0px" cellpadding="0" cellspacing="0">-->
				<!--
					Table Arrow Left
					<table style="float:left" width="99%" border="0px" cellpadding="0" cellspacing="0">
					-->
				<table style="float:right" width="99%" border="0px" cellpadding="0" cellspacing="0">
					<tr>
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-top.png) 8px 5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-top.png) 0px 5px repeat-x;
						">
						</td>
						<td width="10px" style="
							background:url(images/bg-blend-top.png) -98px 5px no-repeat;
						">
						</td>
					</tr>
					<tr>
						<td width="10px" style="background:url(images/bg-blend-left.png) 3px 0px repeat-y;">
						</td>
						<td>
							<div style="height:200px; 
								width:100%;
								border:1px solid #e2e2e2;">
							content
							</div>
						</td>
						<td width="10px" style="background:url(images/bg-blend-right.png) -3px 0px repeat-y;">
						</td>
					</tr>
					<tr >
						<td height="10px" width="10px" style="
							background:url(images/bg-blend-bottom.png) 8px -5px no-repeat;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) 0px -5px repeat-x;
						">
						</td>
						<td style="
							background:url(images/bg-blend-bottom.png) -98px -5px no-repeat;
						">
						</td>
					</tr>
					
				</table>
				
			</div>
		</div>
	</body>
</html>
