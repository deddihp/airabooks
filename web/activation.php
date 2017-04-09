	<?
		/* Define All Class */
		include 'lib/layout.php';
		include 'lib/mysql_comic.php';
		include 'lib/book.php';
		$fb_id = $_GET['fb_id'];
		$mlayout = new MainLayout;
		
		echo $mlayout->writeHeadParameter();
		$fb_info = getFBInfo($_GET['fb_id']);
	?>
	
	<script>
		function callActivationFormKeyPress(url, data_str, id_loader, event) {
			console.log(event.keyCode);
			if ( event.keyCode === 13 ) {
				callActivationForm(url, data_str, id_loader);
			}
		}
		function callActivationForm(url, data_str, id_loader) {
			var email_address = $('#email_address').val();
			document.getElementById(id_loader).innerHTML = document.getElementById(id_loader).innerHTML+\"<div style='position:absolute;top:4px;background-color:blue;'><span style=\\\"font-family:'Verdana'; color:yellow;\\\">Fetching data...</span></div>\";
			console.log(email_address);
			data_str=data_str + '&email_address='+email_address;
			console.log(data_str);
			$.ajax({
				type: \"GET\",
				url:url,
				data:data_str,
				success: function(responseText) {
					document.getElementById(id_loader).innerHTML = responseText;
					//document.getElementById(id_loader).find(\"script\").each(function(i) {
                  		//	eval($(this).text());
               		//});
				}

			});
			return false;
		}
		</script>
	
	
	<span
		style="
			font-family:'Verdana';
			font-size:15px;
			font-weight:bold;
			margin:10px;
			//border:1px solid black;
			display:block;
		"
	>
			Form Aktifasi
	</span>
						
	<table border="0px" cellpadding="5px" cellspacing="0" bordercolor="#e2e2e2" class="user_profile" style="width:700px;">
		<tr style="border-bottom:1px solid #e2e2e2;">
			<td style="border-bottom:1px solid #e2e2e2;">
				Nama
			</td>
			<td style="border-bottom:1px solid #e2e2e2;">
				<? echo $fb_info['full_name']; ?>
			</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid #e2e2e2;">
				Email Address
			</td>
			<td style="border-bottom:1px solid #e2e2e2;">
				<!--<form action="synchro.php" method="post"
								enctype="multipart/form-data">-->
					<input type="text" 
						onkeypress="javascript:callActivationFormKeyPress('<?echo $_GET['dir'];?>synchro.php', 'fb_id=<? echo $fb_id; ?>', 'content_screen_loader', event)"
						name="email_address" id="email_address" size="10">
					<input type="submit" 
						onclick="javascript:callActivationForm('<?echo $_GET['dir'];?>synchro.php', 'fb_id=<? echo $fb_id; ?>','content_screen_loader');"
						name="submit" class="button" value="Submit">
					<input type="hidden" name="fbid" value="<? echo $fb->user_profile['id']; ?>">
				<!--</form>-->
			</td>
		</tr>
	</table>
	<p style="
		font-family:'Verdana';
		font-size:13px;

		display:block;
		border:1px solid #e2e2e2; width:700px;
		margin:0px auto;">
							*System akan mengirimkan kode aktivasi ke email anda yang terdaftar di airabooks, apabila anda tidak menerima email aktivasi tersebut, maka ada kemungkinan terjadi kesalahan dalam penginputan data, segera hubungi admin airabooks untuk mensetting ulang email anda.
						</p>


