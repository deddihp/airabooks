<?php
	session_start();
	
	/* Define All Class */
	include 'lib/layout.php';
	include 'lib/mysql_comic.php';
	include 'lib/book.php';
	//$fb_info = getFBInfo($_SESSION['fb_id']);	
	$fb_info = getFBInfoOffline();	
	if ( $fb_info['subscriber_id'] == "" ) {
		echo "Maaf, Anda harus terdaftar sebagai anggota airabooks untuk melihat halaman ini.
<br>
Mari bergabung dengan airabooks, Registrasi Gratis Lho.;
		";
		return;
	}
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
				>Request Buku</span>
		
<table border="0px" cellpadding="5px" cellspacing="0" bordercolor="#e2e2e2" class="user_profile">
				<tr style="border-bottom:1px solid #e2e2e2;">
					<td style="border-bottom:1px solid #e2e2e2;">
						ID Anggota
					</td>
					<td width="60%" style="border-bottom:1px solid #e2e2e2;">
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
						Judul
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<input type="text" id="content" ></input>
					</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
						Keterangan
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
						<select id="keterangan" >
							<option value="Request Judul Baru">Request Judul Baru</option>
							<option value="Request Untuk Dilengkapi">Request Untuk Dilengkapi</option>
						</select>
					</td>

				</tr>
				<tr>
					<td style="border-bottom:1px solid #e2e2e2;">
					</td>
					<td style="border-bottom:1px solid #e2e2e2;">
					<button onclick="javascript:callBookRequestForm('send_bookrequest.php', '<?echo "name=".$fb_info['full_name']."&subscriber_id=".$fb_info['subscriber_id'];?>','content_screen_loader');">Submit</button>
					</td>
				</tr>
			</table>
	
