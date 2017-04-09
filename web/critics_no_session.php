<?php
	session_start();
	
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
	$fb_info = getFBInfo($_SESSION['fb_id']);	
	if ( $fb_info['fb_id'] == "" ) {
		echo '<span font:normal 13px/13px arial, sans-serif>Maaf anda harus login terlebih dahulu.</span>';
		return;
	}
	//$fb_info = getFBInfoOffline();	
?>
		<span
				style="
					font-family:'Verdana';
					font-size:15px;
					font-weight:bold;
					margin:10px;
					//border:1px solid black;
					display:block;
				"
				>Saran dan Kritik</span>
		
<table border="0px" cellpadding="5px" cellspacing="0" bordercolor="#e2e2e2" class="user_profile">
				<tr style="border-bottom:1px solid #e2e2e2;">
					<td style="border-bottom:1px solid #e2e2e2;">
						ID Anggota
					</td>
					<td width="100%" style="border-bottom:1px solid #e2e2e2;">
					<?
						echo $_SESSION['subscriber_id'];
					?>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
						Nama
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<?
						echo $fb_info['full_name'];
					?>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
					Alamat Email
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<?
							//echo $fb_info['email_address'];
					?>
					<?	
						if ( $fb_info['email_address'] != "" ) { 
					?>
						<input type="text" id="email_address"
						 
						 value="<?
							echo $fb_info['email_address'];
						?>">
					<? } else { ?>
						<input type="text" id="email_address">
					<? } ?>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
						Saran dan Kritik
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<textarea id="content" rows="10" cols="50"></textarea>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<button onclick="javascript:callCriticsForm('send_critics.php', '<?echo "name=".$fb_info['full_name']."&subscriber_id=".$fb_info['subscriber_id'];?>','content_screen_loader');">Submit</button>
					</td>
				</tr>
			</table>
			
