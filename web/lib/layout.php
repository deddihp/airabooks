<?
	include 'fbhandler.php';
?>
<?
	$FB_APPID = '159457617553432';
	//$FB_APPID = '116943728442196';
					
	$prefix = 'airabk00_';
function printBOXLONGCommon($content) {
	$content_html = "<table class=\"boxlong\" style='width:100%;text-align:left;'><tr>";
				for ( $i = 0; $i < count($content); $i++ ) {
					$content_html = $content_html . "<td style='width:20%;vertical-align:top;'>";
					$content_html = $content_html . $content[$i];
					$content_html = $content_html . "</td>";
					if ( $i > 0 && (($i+1) % 5 == 0 ) && $i != 20-1) {
						$content_html = $content_html . "</tr></table>";
						$content_html = $content_html. "<div class=\"hline\"></div>";
						$content_html = $content_html . "<table class=\"boxlong\" style='width:100%;text-align:center;'><tr>";
					}
				}
	$content_html = $content_html . "</tr></table>";
			

	return $content_html;
}

function printAds($type=1) {
	$content = '';
	//return $content;
	if ( $type == 0 ) {
		/*		
		$content = "
			<a class='nodecor' href='http://store.airabooks.com'>
			<table style='background-color:#dfdfdf;display:block;width:600px;border:1px solid #e2e2e2;text-align:left;margin:5px auto;'>
				<tr><td style='width:120px;'>
				<img alt='Toko Buku Online airabooks' src='images/airabooks-store.png' height='100'>
				</td>
				<td>
					<p style='text-align:center;padding:0px; margin:0px;font:bold 15px/18px Arial, Sans-serif;'>Kunjungi Toko Buku Online airabooks</p>
					<p style='text-align:center;padding:0px; margin:0px;font:bold 15px/18px Arial, Sans-serif;color:blue;'>Throw & Drag Your Books To The Trolley</p>
					<p style='text-align:center;padding:0px; margin:0px;font:normal 15px/18px Arial, Sans-serif;'>Nikmati kemudahan berbelanja buku di Toko Buku Online airabooks. Modern, Cepat dan Murah</p>
					<p style='text-align:center;padding:0px; margin:0px;font:bold 13px/15px Arial, Sans-serif;'>Diskon 15% untuk semua buku</p>
					<p style='text-align:right;padding:0px; margin:0px;font:bold 12px/12px Arial, Sans-serif;'>www.store.airabooks.com</p>
				</td>
				</tr>
			</table>
			</a>
		";*/
	}
	else
	if ( $type == 1 ) {
		$content = '
			<!-- Begin: http://adsensecamp.com/ -->
				<script src="http://adsensecamp.com/show/?id=C9MHJT3rGBo%3D&cid=lP7PZgp7i7o%3D&chan=TWwhxWD4vWw%3D&type=1&title=3D81EE&text=000000&background=FFFFFF&border=000000&url=2BA94F" type="text/javascript">
				</script>
			<!-- End: http://adsensecamp.com/ -->
		';
	} else if ( $type == 2 ) {
		$content = '
		<!-- Begin: http://adsensecamp.com/ -->
<script src="http://adsensecamp.com/show/?id=C9MHJT3rGBo%3D&cid=lP7PZgp7i7o%3D&chan=TWwhxWD4vWw%3D&type=3&title=3D81EE&text=000000&background=FFFFFF&border=000000&url=2BA94F" type="text/javascript">
</script>
<!-- End: http://adsensecamp.com/ -->
		';
	} else if ( $type == 4 ) {
		$content = '
		<!-- Begin: http://adsensecamp.com/ -->
<script src="http://adsensecamp.com/show/?id=C9MHJT3rGBo%3D&cid=lP7PZgp7i7o%3D&chan=TWwhxWD4vWw%3D&type=11&title=3D81EE&text=000000&background=FFFFFF&border=000000&url=2BA94F" type="text/javascript">
</script>
<!-- End: http://adsensecamp.com/ -->';
	} else if ( $type == 5 ) {
		$content = '
		<!-- Begin: http://adsensecamp.com/ -->
<script src="http://adsensecamp.com/show/?id=C9MHJT3rGBo%3D&cid=lP7PZgp7i7o%3D&chan=TWwhxWD4vWw%3D&type=11&title=3D81EE&text=000000&background=FFFFFF&border=000000&url=2BA94F" type="text/javascript">
</script>
<!-- End: http://adsensecamp.com/ -->';
	} else if ( $type == 6 ) {
		$content = '
		<!-- Begin: http://adsensecamp.com/ -->
<script src="http://adsensecamp.com/show/?id=C9MHJT3rGBo%3D&cid=lP7PZgp7i7o%3D&chan=TWwhxWD4vWw%3D&type=11&title=3D81EE&text=000000&background=FFFFFF&border=000000&url=2BA94F" type="text/javascript">
</script>
<!-- End: http://adsensecamp.com/ -->
		';
	}
	return $content;
	if ( $type == 1 ) { //728x90
		$content = '
			<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<ins class="adsbygoogle"
     		style="display:inline-block;width:728px;height:90px"
     		data-ad-client="ca-pub-2340414184571894"
     		data-ad-slot="1959648362"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		';
	} else if ( $type == 2 ) { //120x600
		$content = '
		<div style="border:0px solid black;">
		<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     		style="display:inline-block;width:120px;height:600px"
     		data-ad-client="ca-pub-2340414184571894"
     		data-ad-slot="1820047569"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</div>';
	} else if ( $type == 3 ) { //Iklan_120x240
		$content = '
			<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     		style="display:inline-block;width:120px;height:240px"
     		data-ad-client="ca-pub-2340414184571894"
     		data-ad-slot="3296780764"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		';
	} else if ( $type == 4 ) { //Iklan_250x250
		$content = '
		<div style="border:0px solid black;">	
			<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<ins class="adsbygoogle"
     		style="display:inline-block;width:250px;height:250px"
     		data-ad-client="ca-pub-2340414184571894"
     		data-ad-slot="7726980360"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
		';
	} else if ( $type == 5 ) { //Iklan_250x250_2
		$content = '
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-2340414184571894";
				/* Iklan_250x250_2 */
				google_ad_slot = "7079348760";
				google_ad_width = 250;
				google_ad_height = 250;
				//-->
			</script>
			<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>';
	} else if ( $type == 6 ) { //Iklan_250x250_3
		$content = '
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-2340414184571894";
				/* Iklan_250x250_3 */
				google_ad_slot = "1032815165";
				google_ad_width = 250;
				google_ad_height = 250;
				//-->
			</script>
			<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		';
	}
	return $content;
}

function printBasicLayout($mlayout, $header, $menu, $mcontent, $dir='./') {
	$content = "
		<div id=\"maincontent\" class=\"maincontent\" style=\"float:left; top:0px;\">
			".$header."
			<table style='border-spacing:0px;width:100%;'>
				<tr>
					<td style='padding:0px;vertical-align:top;width:148px;'>
						".$menu."
					</td>
					<td style='padding:0px;vertical-align:top;'>
						".$mcontent."
						".$mlayout->writeFooter()."
					</td>
				</tr>
			</table>
		</div>
	";
	$content = $content . printInfoRightSide($dir);
	//$content = $content . printChatRoom();
	return $content;
}


function printChatRoom() {
	$content = "
	<div id='online_user' style='background-color:blue;
		position:absolute;
		z-index:5;
		border:1px solid red; width:200px; height:500px;'>
		
	</div>
	<div id='chat_room' style='position:absolute;
		z-index:6; left:200px;
		border:1px solid red;
		width:200px;
		background-color:white;
	'
	>
		<div>
		chat here
		</div>
		<div id='input_text'>
		<div id='status_chat'>
		Typing....
		</div>
		<textarea id='edit_text' onkeypress='onKeyChange()' cols='20' row='20'></textarea>
		</div>
	</div>
	<script>
		var last_date = '';
		var first_date = '';
		function putChatMessage(date, msg) {
			last_date = date;
			var newdiv = document.createElement('div');
			newdiv.setAttribute('id', last_date);
			newdiv.setAttribute('style', 'border:1px solid blue;');
			newdiv.innerHTML = 'Anda:'+msg;
			data = document.getElementById('input_text');
			//data.appendChild(newdiv);
			data.insertBefore(newdiv, document.getElementById('status_chat'));
			document.getElementById('edit_text').value = '';
		}
		function onsuccess_chat_sendmsg() {
			////console.log(this.responseText);
			var text = this.responseText;
			var date = text.substring(0, (9+10));
			var msg = text.substring((9+10+1), text.length);
			//console.log('last date = '+last_date);
			putChatMessage(date, msg);
		}
		function onKeyChange() {
			var key = window.event.keyCode;
			//console.log(key);
			////console.log(document.getElementById('edit_text'));
			var msg = document.getElementById('edit_text').value;
			//console.log(msg);
			if ( key == 13 ) {
				//console.log('send');
				var data = new FormData();
				data.append('type', 'send_chat_msg');
				data.append('msg', msg);
				var xhr = new XMLHttpRequest();
				xhr.onload = onsuccess_chat_sendmsg;
				xhr.open('POST', 'online_user.php', true);
				xhr.send(data);
			}
		}
		function onsuccess_online_user(event) {
			var obj = JSON.parse(this.responseText);
			//console.log(obj.chat);
			if ( obj.chat.length > 0 ) {
				last_date = obj.chat[0].date;
				//console.log(last_date);
			}
			for ( var i = obj.chat.length-1; i >= 0; i-- ) {
				//console.log(' i = '+ i);
				putChatMessage(obj.chat[i].date, obj.chat[i].msg+' '+obj.chat[i].date);
			}
			////console.log(this.responseText);
			//document.getElementById('online_user').innerHTML = this.responseText;	
		}
		function load_online_user() {
			var data = new FormData();
			data.append('last_date', last_date);
			var xhr = new XMLHttpRequest();
			xhr.onload = onsuccess_online_user;
			xhr.open('POST', 'online_user.php', true);
			xhr.send(data);
		}
		$(document).ready(function() {
			//alert('start chat');
			//load_online_user();
			setInterval(load_online_user,5000);	
		});
	</script>
	";
	return $content;
}

function printInfoRightSide($dir = './') {
	//if ( $_SESSION['role'] != 'ADMIN' )
	//	return '<div id="div-id"></div>';
	
	$content = "
		<div onscroll=\"javascript:onScroll(this);\" id=\"div-id\" style=\";border:1px solid #dedede;position:fixed;right:0;
			width:230px; overflow:auto;overflow-x:hidden; background-color:grey;\">";
			
		$content = $content . "</div>";
		$content = $content . "
		<script>
			function check() {
				var newdiv = document.createElement('div');
				var id = 'check-'+num;
				num = num + 1;
				newdiv.setAttribute('id',id);
				newdiv.setAttribute('style','display:none;border:1px solid black;background-color:white;');
				newdiv.innerHTML = 'Test again '+id;
				var dd = document.getElementById('div-id');
				if ( dd.firstChild != null ) {
					var firstchild_id = dd.firstChild.id;
					dd.insertBefore(newdiv, dd.firstChild);
					$('#'+dd.firstChild).slideDown();	
					
				} else {
					dd.appendChild(newdiv);
				}
			}
			var last_date = '';
			var bottom_date = '';
			var num = 0;
			var temp_counter = 0;
			function onsuccess_synopsislog() {
				if ( this.responseText == '' )
					return;
				var obj = JSON.parse(this.responseText);
				if ( obj == null ) {
					return;
				}
				if ( obj.last_date == last_date ) {
					return;
				}
				last_date = obj.last_date;
				
				var newdiv = document.createElement('div');
				var id = 'check-'+num;
				num = num + 1;
				newdiv.setAttribute('id',id);
				newdiv.setAttribute('style','display:none; width:95%;font:normal 12px/13px Arial, Sans-Serif;background-color:#e6e8ef; margin:1px; padding:5px;');
				
				newdiv.innerHTML = obj.html;
				var dd = document.getElementById('div-id');
				if ( dd.firstChild != null ) {
					////console.log('FIRST CHILD NOT NULL');
					var firstchild_id = dd.firstChild.id;
					dd.insertBefore(newdiv, dd.firstChild);
					$('#'+dd.firstChild.id).slideDown();	
				} else {
					////console.log('FIRST CHILD NULL');
					dd.appendChild(newdiv);
					$('#'+dd.firstChild.id).slideDown();
				}
			}
			function loadSynopsis_POST() {
				var dataku = new FormData();
				dataku.append('test', 'test');
				dataku.append('last_date', last_date);
				dataku.append('dir', '".$dir."');
				////console.log(dataku);	
				var xhr = new XMLHttpRequest();
				xhr.onload = onsuccess_synopsislog;
				xhr.open('POST', '".$dir."get_synopsislog.php', true);
				xhr.send(dataku);
			};
			function loadSynopsisFirst_POST() {
				var dataku = new FormData();
				dataku.append('test', 'test');
				dataku.append('last_date', last_date);
				dataku.append('dir', '".$dir."');
				dataku.append('isfirst', 'true');
				////console.log(dataku);	
				var xhr = new XMLHttpRequest();
				xhr.onload = firstAction;
				xhr.open('POST', '".$dir."get_synopsislog.php', true);
				xhr.send(dataku);
			};
			function firstAction() {
				//alert('Data anda telah di update'+this.responseText);
				////console.log('response = '+this.responseText+' after response');
				if ( this.responseText == '' )
					return;
				var obj = JSON.parse(this.responseText);
				if ( obj == null ) {
				//	//console.log('obj null'+last_date);
					
					return;
				}
				////console.log('last_date = '+obj.last_date+' , bottom_date = '+obj.bottom_date);
				last_date = obj.last_date;
				bottom_date = obj.bottom_date;	
				
				var str = \"<div id='most-bottom' style='background-color:#e6e8ef;padding:10px;text-align:center; font:normal 13px/18px Arial, sans-serif; margin:1px; width:100%; display:table;border:0px solid black;background-color:white;'><img alt='loading' src='".$dir."images/ajax-loading.gif' width='30'></div>\";
				document.getElementById('div-id').innerHTML = obj.html + str;
				
			//	$('#div-id').fadeIn();
				return;
				
				var newdiv = document.createElement('div');
				var id = 'check-'+num;
				num = num + 1;
				newdiv.setAttribute('id',id);
				newdiv.setAttribute('style','display:table; width:95%;font:normal 12px/13px Arial, Sans-Serif;background-color:#e6e8ef; margin:1px; padding:5px;');
				var html = \"\"
				newdiv.innerHTML = obj.html;
				var dd = document.getElementById('div-id');
				if ( dd.firstChild != null ) {
				//	//console.log('FIRST CHILD NOT NULL');
					var firstchild_id = dd.firstChild.id;
					dd.insertAfter(newdiv, dd.firstChild);
					$('#'+firstchild_id).slideDown(function(){
						
					});
				} else {
				//	//console.log('FIRST CHILD NULL');
					dd.appendChild(newdiv);
					$('#'+dd.firstChild.id).slideDown();
				}
				//console.log('end first action');
			}
			var isready_bottom = true;
			function onsuccess_synopsisbottom() {
				////console.log('get bottom');
				if ( this.responseText == '' )
					return;
				var obj = JSON.parse(this.responseText);
				if ( obj == null ) {
				//	//console.log('obj null'+last_date);
					return;
				}
				////console.log('date = '+obj.last_date);
				//last_date = obj.last_date;
				bottom_date = obj.bottom_date;	
				var str = \"<div id='most-bottom' style='background-color:#e6e8ef;padding:10px;text-align:center; font:normal 13px/18px Arial, sans-serif; margin:1px; width:100%; display:table;border:0px solid black;'>Lihat sebelumnya</div>\";
				//document.getElementById('div-id').innerHTML = obj.html + str;
				
				//$('#div-id').fadeIn();
				var newdiv = document.createElement('div');
				newdiv.setAttribute('id', 'update-bottom'+num);
				newdiv.setAttribute('style', 'display:none;');
				newdiv.innerHTML = obj.html;
				document.getElementById('div-id').insertBefore(newdiv, 
				document.getElementById('most-bottom'));
				$('#update-bottom'+num).slideDown();
				
				num++;
				//appendChild(newdiv);
				isready_bottom = true;
				return;
			}
			function loadSynopsisBottom_POST() {
				if ( isready_bottom == false ) 
					return;
				isready_bottom = false;
				var dataku = new FormData();
				dataku.append('bottom_date', bottom_date);
				dataku.append('dir', '".$dir."');
				dataku.append('position', 'bottom');
				////console.log(dataku);	
				var xhr = new XMLHttpRequest();
				xhr.onload = onsuccess_synopsisbottom;
				xhr.open('POST', '".$dir."get_synopsislog.php', true);
				xhr.send(dataku);
			}
			$(document).ready(function() {
				$('#div-id').hide();
				loadSynopsisFirst_POST(); 
				interval = window.setInterval(
					function(){
						loadSynopsis_POST();
				}, 5000);
				var width = $(window).width();
				var s_width = $('#div-id').width();
				var m_width = $('#maincontent').width();
				var m_left = 0;//$('#maincontent').left();
				//console.log(width +' , '+s_width+' , '+m_width+' , '+m_left);
				var totalwidth = s_width+m_width;
				if ( width > totalwidth ) {
					$('#div-id').fadeIn();
				} else {
					$('#div-id').hide();
				}
				var height = $(window).height();
				document.getElementById('div-id').style.height = height+'px';
				

			});
			function onScroll(el) {
				if ( el.scrollTop+el.offsetHeight >= el.scrollHeight ) {
					loadSynopsisBottom_POST(); 
				
				}
			}
		</script>
		";
	return $content;
}

function writeMetaInfo($description, $keywords="", $author="") {
	$content = "
		<meta name=\"description\" content=\"".$description."\">
		<meta name=\"keywords\" content=\"Pusat Sinopsis Komik dan Novel, Browse, Judul, Anggota, Persewaan, Rental, Sewa, Peminjaman, Rent, CD, DVD, Original, Orisinil, Komik, Comic, Novel, Buku, Book, Books, Rating, Rate, Sinopsis, Synopsis, Genre, New Release, Rilis Terbaru,  By Request, Pembelian, Buy, Pemesanan, Wiki, Pengarang, author, Mangaka, Most Recommended, rekomendasi, Most Popular, populer,".$keywords."\">
		<meta name=\"author\" content=\"airabooks,".$author."\">
	";
	return $content;
}

function countViewer() {
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query2 = "SELECT SUM(count) as count FROM url_visit where url LIKE '%php%' OR url LIKE 'http://airabooks.com/' ";
	$result2 = $mysql->query($query2);
	$row2 = mysqli_fetch_array($result2);
	return $row2['count'];

}

function writeShareButton() {
	$content = "<a href=\"javascript:void(0)\" id=\"share_button\"><img alt='facebook share' src=\"../images/facebook_share.png\" height=\"20\"></a>";
	return $content;
}

function writeJSShare($name, $link, $picture, $caption, $description, $message) {
	$description = str_replace("\n", " ", $description);	
	$content = "
				<script type=\"text/javascript\">
					$(document).ready(function()
					{
						var width = $('#mcontent').width();
						$('#share_button').click(function(e){
							//console.log('click here');
							e.preventDefault();
							FB.ui(
								{
									method: 'feed',
									name: '".$name."',
									link: '".$link."',
									picture: '".$picture."',
									caption: '".$caption."',
									description: '".$description."',
									message: '".$message."'
								}, callback);
						});
					}
					);
					function callback(response) {
					}
				</script>";
	return $content;
}

function getBookTitleFromCode($code) {
	$query = 'SELECT title FROM book_title WHERE code="'.$code.'"';
	$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
	$result = $mysql->query($query);
	$row = mysqli_fetch_array($result);
	return $row['title'];
}

function getFBNameFromFBID($fb_id) {
	if ( $fb_id === 'airabooks' )
		return 'airabooks';
	$query = "SELECT * FROM user_activation WHERE fb_id='".$fb_id."'";
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	//echo "<br>SUBS ID = ".$subscriber_id." -> ".mysqli_num_rows($result);
	if ( mysqli_num_rows($result) != 0 ) {
		$row = mysqli_fetch_array($result);
		return $row['fb_name'];
	}
	return "-";
}
function getSubscriberFBInfo($subscriber_id) {
	$query = "SELECT * FROM user_activation WHERE subscriber_id='".$subscriber_id."'";
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$result = $mysql->query($query);
	//echo "<br>SUBS ID = ".$subscriber_id." -> ".mysqli_num_rows($result);
	if ( mysqli_num_rows($result) != 0 ) {
		$row = mysqli_fetch_array($result);
		return $row['fb_id'];
	}
	return "none";
}
function writeJXSubscriberGroup($ATeam) {
	return "";
	$content = "
	<script>
		$(document).ready(function(){
			jxFBUserProfile();
		});
		function jxFBUserProfile() {	
			//////console.log('write subscriber group');
			window.fbAsyncInit = function() {
 				////console.log('fb init now');
				FB.init({
					//appId: '159457617553432',
					//TESTING bawah
					//appId: '116943728442196', 
					appId: '".$GLOBALS['FB_APPID']."',
					status: true, 
					cookie: true, 
					xfbml: true
				});";
	for ( $i = 0; $i < count($ATeam); $i++ ) {
		$content = $content ."			
				FB.api('/".$ATeam[$i]."', function(response) {
    				$('#'+$ATeam[$i]).fadeOut(function() {
						document.getElementById('".$ATeam[$i]."').innerHTML = 
						'<p class=\"title\" style=\"font:bold 13px/13px arial, sans-serif;\">'+response.name+'</p>';
						$('#'+$ATeam[$i]).fadeIn();
					});
					$('#img_'+$ATeam[$i]).fadeOut(function() {
						document.getElementById('img_".$ATeam[$i]."').src = \"http://graph.facebook.com/\"+response.id+\"/picture\";
						document.getElementById('img_".$ATeam[$i]."').width = 50;
						$('#img_'+$ATeam[$i]).fadeIn();
						//////console.log(\"http://graph.facebook.com/\"+response.id+\"/picture\");
					});

				});";
			}
		$content = $content . "
				console.log('auto start');
		};
	};
		</script>";
	return $content;
}


function writeSubscriberGroup($ATeam) {
	return "";
	$content = "
	<script>
		var fbasync = false;	
		function jxFBUserProfile(i, subs_id_list) {
		//for ( var i = 0; i < subs_id_list.length; i++ ) 
		{	
			////console.log('i = '+i);
			var fb_id = subs_id_list[i];
			////console.log('jx User Profile '+fb_id+' write subscriber group');
			if ( fbasync == false )
				alert('not synchronized yet with facebook, wait a minute');
			FB.api('/'+fb_id, function(response) {
    			$('#'+fb_id).fadeOut(function() {
					document.getElementById(fb_id).innerHTML = 
					'<p class=\"title\" style=\"font:bold 13px/13px arial, sans-serif;\">'+response.name+'</p>';
					$('#'+fb_id).fadeIn();
				});
				$('#img_'+fb_id).fadeOut(function() {
					document.getElementById('img_'+fb_id).src = \"http://graph.facebook.com/\"+response.id+\"/picture\";
					document.getElementById('img_'+fb_id).width = 50;
					$('#img_'+fb_id).fadeIn();
					//////console.log(\"http://graph.facebook.com/\"+response.id+\"/picture\");
				});
				if ( i < subs_id_list.length ) {
					i = i + 1;
					jxFBUserProfile(i, subs_id_list);
				}
			})
			////console.log('auto start');
		};
	};";

		$content = $content . "$(document).ready(function() {	
			////console.log('write subscriber group');
			window.fbAsyncInit = function() {
 				fbasync = true;
				////console.log('fb init now');
				FB.init({
					//appId: '159457617553432',
					//TESTING bawah
					//appId: '116943728442196', 
					appId: '".$GLOBALS['FB_APPID']."',
					status: true, 
					cookie: true, 
					xfbml: true
				});";
	for ( $i = 0; $i < count($ATeam); $i++ ) {
		$content = $content ."			
				FB.api('/".$ATeam[$i]."', function(response) {
    				$('#'+$ATeam[$i]).fadeOut(function() {
						document.getElementById('".$ATeam[$i]."').innerHTML = 
						'<p class=\"title\" style=\"font:bold 13px/13px arial, sans-serif;\">'+response.name+'</p>';
						$('#'+$ATeam[$i]).fadeIn();
					});
					$('#img_'+$ATeam[$i]).fadeOut(function() {
						document.getElementById('img_".$ATeam[$i]."').src = \"http://graph.facebook.com/\"+response.id+\"/picture\";
						document.getElementById('img_".$ATeam[$i]."').width = 50;
						$('#img_'+$ATeam[$i]).fadeIn();
						//////console.log(\"http://graph.facebook.com/\"+response.id+\"/picture\");
					});

				});";
			}
		$content = $content . "
				////console.log('auto start');
		};
	});
		</script>";
	return $content;
}


function writeFBTeam($ATeam) {
	$content = "
	<script>
		$(document).ready(function() {	
			window.fbAsyncInit = function() {
 				FB.init({
					//appId: '159457617553432',
					//TESTING bawah
					//appId: '116943728442196', 
					appId: '".$GLOBALS['FB_APPID']."',
					status: true, 
					cookie: true, 
					xfbml: true
				});";
		for ( $i = 0; $i < count($ATeam); $i++ ) {
	$content = $content ."			
				FB.api('/".$ATeam[$i]."', function(response) {
    				$('#".$ATeam[$i]."').fadeOut(function(){
						document.getElementById('".$ATeam[$i]."').innerHTML = response.name;
						$('#".$ATeam[$i]."').fadeIn();
					});
					$('#img_".$ATeam[$i]."').fadeOut(function() {
						document.getElementById('img_".$ATeam[$i]."').src = \"http://graph.facebook.com/\"+response.id+\"/picture\";
						document.getElementById('img_".$ATeam[$i]."').width = 50;
						$('#img_".$ATeam[$i]."').fadeIn();
					});

				});";
			}
	$content = $content . "
				////console.log('auto start');
		};
	});
		</script>";
	return $content;
}

function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} else {
  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 	return str_replace('www.','',$pageURL);
}

function CountUserLog($fb_info) {
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query = "UPDATE user_log SET count=count+1 , subscriber_id='".$fb_info['subscriber_id']."', status='".$fb_info['status']."' WHERE fb_id='".$fb_info['fb_id']."'";
	$result = $mysql->query($query);
	$aff = mysqli_affected_rows($mysql->con);
	//print_r($aff);
	if ( $aff == 0 ) {
		$query = "INSERT INTO user_log VALUES('".$fb_info['fb_id']."', '".$fb_info['subscriber_id']."', '".$fb_info['full_name']."', '".$fb_info['status']."', 1)";
		$result = $mysql->query($query);
		$aff = mysqli_affected_rows($mysql->con);
	//	print_r($aff);
	}
}
function countURLVisit() {
	if ( $_SESSION['subscriber_id'] == 'SUBS-1-1' || $_SESSION['role'] == 'ADMIN' )
		return;
	
	$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
	$query = "UPDATE url_visit SET count=count+1, date=NOW(), last_id='".$_SESSION['subscriber_id']."', last_name='".$_SESSION['full_name']."' WHERE url='".curPageURL()."'";
	$result = $mysql->query($query);
	$aff = mysqli_affected_rows($mysql->con);
	//print_r($aff);
	if ( $aff == 0 ) {
		$query = "INSERT INTO url_visit VALUES('".curPageURL()."', 1, NOW(), '".$_SESSION['subscriber_id']."','".$_SESSION['full_name']."')";
		$result = $mysql->query($query);
		$aff = mysqli_affected_rows($mysql->con);
	//	print_r($aff);
	}
}
function getFBInfoOffline() {
		$fb_info = Array (
			'subscriber_id' => $_SESSION['subscriber_id'],
			'full_name' => $_SESSION['full_name'],
			'fb_id' => $_SESSION['fb_id'],
			'status' => $_SESSION['status'],
			'role' => $_SESSION['role'],
			'email_address' => $_SESSION['email_address']
		);
	return $fb_info;	
}
function getFBInfo($fb_id, $fb_name='Anonymous') {
		//$request = "https://graph.facebook.com/".$fb_id;
		//echo "<br>REQUEST = ".$request;
		//return "";
		//$json = file_get_contents($request);
		//$json = json_decode($json);
	
		$fb_info = Array (
			'subscriber_id' => '-',
			'full_name' => $fb_name,//$json->{'name'},
			'fb_id' => $fb_id,
			'status' => 'NOT ACTIVE',
			'role' => 'USER'
		);
	
		//Get Information based on fb_id
		$query = "SELECT * FROM user_activation WHERE fb_id='".$fb_id."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		if ( $row['subscriber_id'] != "" ) {
			$fb_info['subscriber_id'] = $row['subscriber_id'];
			$fb_info['status'] = $row['status'];
			$fb_info['role'] = $row['role'];
		}
		//obtain Tanggal Daftar
		$query = "SELECT rent_date FROM transaction WHERE subscriber_id='".$fb_info['subscriber_id']."' AND income_source='REGISTRATION'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$fb_info['registration_date'] = $row['rent_date'];

		
		$query = "SELECT * FROM subscriber WHERE subscriber_id='".$fb_info['subscriber_id']."'";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$fb_info['email_address'] = $row['email_address'];
		$fb_info['home_address'] = $row['home_address'];
		$fb_info['home_phone_number'] = $row['home_phone_number'];
		$fb_info['mobile_phone_number'] = $row['mobile_phone_number'];
		$fb_info['saldo'] = $row['saldo'];
		return $fb_info;
	}

function writeLocalSearchForm($local_search="", $hide_param="", $fb_id, $dir='./')
{
	$nav = "
		<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<!--<form class=\"search_form\" name=\"local_search\" method=\"get\" action=\"\">-->
					".$hide_param."
					<input style=\"border:1px solid black;
						height:20px;
					\" type=\"text\" id=\"local_search\" name=\"local_search\" value=\"".$local_search."\"
					onkeypress=\"javascript:callHTMLFormKeyPress('".$dir."user_history.php', 'dir=".$dir."&fb_id=".$fb_id."&prev=<&offset="."0"."','content_screen_loader', event);\"
				
					
					>
					<input style=\"
						border:1px solid black;
						height:24px; margin:0 0 0 -1px;
					\"type=\"button\" value=\"search\"
					onclick=\"javascript:callHTMLForm('user_history.php', 'fb_id=".$fb_id."&prev=<&offset="."0"."','content_screen_loader');\"
					>
				<!--</form>-->
			</div>";
	return $nav;
}
function writeNavForm($local_search, $prev_var, $next_var, $view_var="0 - 0 of 0", $hide_param="", $fb_id, $dir='./') {
	$action_handler = "";
	$nav_var = "
	<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
		<form style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
			".$hide_param."
			<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
			<input type=\"button\" name=\"prev\" value=\"<\" onclick=\"javascript:callHTMLForm('".$dir."user_history.php', 'dir=".$dir."&fb_id=".$fb_id."&prev=<&local_search=".$local_search."&offset=".$prev_var."','content_screen_loader');\">
			<input type=\"hidden\" name=\"offset\" value=\""
				.$prev_var.
			"\">
		</form>
		<p style=\"float:left;
			font-family:'Verdana';
			font-size:14px;
			font-weight:normal;
			margin:5px 10px 0 10px;
		\">"
			.$view_var.
		"</p>
		<form style=\"float:left\" name=\"next\"  action=\"".$action_handler."\">
			".$hide_param."
			<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
			<input type=\"button\" name=\"next\" value=\">\"
				onclick=\"javascript:callHTMLForm('".$dir."user_history.php','dir=".$dir."&fb_id=".$fb_id."&next=>&local_search=".$local_search."&offset=".$next_var."','content_screen_loader');
				return false;
				\"
			>
			<input type=\"hidden\" name=\"offset\" value=\""
				.$next_var.
			"\">
		</form>
	</div>";
	return $nav_var;
}
function writeCommentFB($url) {
		return "<div style=\"
			padding:0px;margin:0px;
		\" class=\"fb-comments\" data-href=\"".$url."\" data-width=\"850px\" data-num-posts=\"10\" data-colorscheme=\"light\"></div>";
	}
function writeLikeButtonComplete($url, $type) {
		if ( $type == "" )
			$type = "recommend";
		else
			$type = "like";
		$query = "<div class=\"fb-like\" data-href=\"".$url."\" data-send=\"true\" data-layout=\"button_count\" data-width=\"450\" data-show-faces=\"true\" data-action=\"".$type."\"></div>";

		return $query;
	}
function writeLikeButtonCommon($url, $type) {
		/*if ( $type == "" )
			$type = "recommend";
		else
			$type = "like";
		$query = "<div style=\"
			position:relative;
		\" class=\"fb-like\" data-href=\"".$url."\" data-send=\"false\" data-layout=\"button_count\" data-width=\"450\" data-show-faces=\"false\" data-action=\"".$type."\"></div>";
			return $query;
*/
				
	$content = "<iframe src=\"http://www.facebook.com/plugins/like.php?href=".$url."&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=recommend&amp;height=20px&amp;appId=".$GLOBALS['FB_APPID']."\" scrolling=\"no\" frameborder=\"0\" style=\"border:1px; overflow:hidden; width:100px; height:20px;\" allowTransparency=\"true\"></iframe>";
	return $content;
}
function GenreTrans($genre) {
	if ( $genre == 'Adventure+Fantasy' )
		return "Fantasy";
	else if ( $genre == "Detective" )
		return "Detektif";
	else if ( $genre == "Mystery" )
		return "Misteri";
	else if ( $genre == "Sport" )
		return "Olahraga";
	/*'Genre Fantasy' => 'comic_genre.php?genre=',
				'Genre Drama' => 'comic_genre.php?genre=Drama',
				'Genre Romance' => 'comic_genre.php?genre=Romance',
				'Genre Action' => 'comic_genre.php?genre=Action',
				'Genre Comedy' => 'comic_genre.php?genre=Comedy',
				'Genre History' => 'comic_genre.php?genre=History',
				'Genre Detektif' => 'comic_genre.php?genre=Detective',
				'Genre Misteri' => 'comic_genre.php?genre=Mystery',
				'Genre Olahraga' => 'comic_genre.php?genre=Sport',
			),
*/
	return $genre;
}

/*** Class Layout ***/
class MainLayout {
	function initFB() {
	}
	/*function getFBInfo($fb_id) {
		$request = "http://graph.facebook.com/".$fb_id;
		//echo "<br>REQUEST = ".$request;
		//return "";
		$json = file_get_contents($request);
		$json = json_decode($json);
	
		$fb_info = Array (
			'subscriber_id' => '-',
			'full_name' => $json->{'name'},
			'fb_id' => $fb_id,
			'status' => 'NOT ACTIVE',
			'role' => 'USER'
		);
	
		//Get Information based on fb_id
		$query = "SELECT * FROM user_activation WHERE fb_id='".$fb_id."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		if ( $row['subscriber_id'] != "" ) {
			$fb_info['subscriber_id'] = $row['subscriber_id'];
			$fb_info['status'] = $row['status'];
			$fb_info['role'] = $row['role'];
		}
		//obtain Tanggal Daftar
		$query = "SELECT rent_date FROM transaction WHERE subscriber_id='".$fb_info['subscriber_id']."' AND income_source='REGISTRATION'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$fb_info['registration_date'] = $row['rent_date'];

		
		$query = "SELECT * FROM subscriber WHERE subscriber_id='".$fb_info['subscriber_id']."'";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$fb_info['email_address'] = $row['email_address'];
		$fb_info['home_address'] = $row['home_address'];
		$fb_info['home_phone_number'] = $row['home_phone_number'];
		$fb_info['mobile_phone_number'] = $row['mobile_phone_number'];
		$fb_info['saldo'] = $row['saldo'];
		return $fb_info;
	}*/
	function getFBInfo1($fb_id) {
		$facebook = new Facebook(array(
//  'appId'  => '344617158898614',
 // 'secret' => '6dc8ac871858b34798bc2488200e503d',
//TESTING
			'appId' => '116943728442196',
			'secret' => '08f7df4d40b301796544e26919369226',
		));


		//echo "fb_id = ".$_GET['fb_id'];
		//$fb_id = $_GET['fb_id'];
		
		//$profile = file_get_contents("http://graph.facebook.com/".$fb_id);
		$profile = $facebook->api('/'.$fb_id);
		//print_r($profile);
		//echo '<br>name = '.$profile['name'];
		$fb_info = Array (
			'subscriber_id' => '-',
			'full_name' => $profile['name'],
			'fb_id' => $fb_id,
			'status' => 'NOT ACTIVE',
			'role' => 'USER'
		);

		//Get Information based on fb_id
		$query = "SELECT * FROM user_activation WHERE fb_id='".$fb_id."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DBWEB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		if ( $row['subscriber_id'] != "" ) {
			$fb_info['subscriber_id'] = $row['subscriber_id'];
			$fb_info['status'] = $row['status'];
			$fb_info['role'] = $row['role'];
		}
		//obtain Tanggal Daftar
		$query = "SELECT rent_date FROM transaction WHERE subscriber_id='".$fb_info['subscriber_id']."' AND income_source='REGISTRATION'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$fb_info['registration_date'] = $row['rent_date'];

		
		$query = "SELECT * FROM subscriber WHERE subscriber_id='".$fb_info['subscriber_id']."'";
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		$fb_info['email_address'] = $row['email_address'];
		$fb_info['home_address'] = $row['home_address'];
		$fb_info['home_phone_number'] = $row['home_phone_number'];
		$fb_info['mobile_phone_number'] = $row['mobile_phone_number'];
		$fb_info['saldo'] = $row['saldo'];
		return $fb_info;
	}
	function writeFooter($dir='./') {
		$content = "
			<div style=\"position:relative;display:table;border:0px solid red;height:90px; text-align:center; padding:15px; width:100%;\">
				<a href='".$dir."wiki/wikiabout.php' class=\"style3\">About</a>
					<a href='#' 
						onclick=\"javascript.showScreenCover('".$dir."onsale.php?dir=".urlencode($dir)."');\" class=\"style3\">Pembelian</a>
					<a href='#' class=\"style3\"
									onclick=\"javascript:showScreenCover('".$dir."critics_no_session.php');\"
									>
									Saran & Kritik</a>
					<a href='".$dir."wiki/wikihelp.php' class=\"style3\">Bantuan</a>
				
			".printAds()."
			</div>
		";
		return $content;
	}
	function writeHeadParameter($dir='./') {
		countURLVisit();
		$member_share = "
			<script>
				function ClickMemberShare(el) {
					//alert('member share'+el);
					
					////console.log(el.name+' '+el.value);
					var str = '".$dir."setuserprofile.php?type='+el.name+'&value='+el.value;
					////console.log(str);
					loadHTML(str, '');
				}
			</script>
		";

		$headparam = "
			<link rel=\"stylesheet\" href=\"".$dir."css/style.css\" type=\"text/css\">";
		$headparam = $headparam ."
			<script src=\"".$dir."jquery.min.js\"></script>
			<script>
  				(function() {
    				var cx = '011619598497550101864:sajtfnwz8ta';
    				var gcse = document.createElement('script');
    				gcse.type = 'text/javascript';
    				gcse.async = true;
    				gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        			'//www.google.com/cse/cse.js?cx=' + cx;
    				var s = document.getElementsByTagName('script')[0];
    				s.parentNode.insertBefore(gcse, s);
  				})();
			</script>
			
			
		";
		$headparam2 = /*$headparam2 . */"
		<script>
			function loadHTML(url, loader) {
				document.getElementById(loader).innerHTML = \"<img alt='loading' src=\\\"".$dir."images/ajax-loading.gif\\\">\"
							
				var xmlhttp;
				if (window.XMLHttpRequest)
  				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
  				}
				xmlhttp.onreadystatechange=function()
  					{
  						if (xmlhttp.readyState==4 && xmlhttp.status==200)
    					{
    						////console.log('ok');
							//$('#'+loader).show();
							if ( loader != '' ) {
								document.getElementById(loader).innerHTML = xmlhttp.responseText;
								document.getElementById(loader).find(\"script\").each(function(i) {
                    				eval($(this).text());
                				});
							}
						}
  					}
				xmlhttp.open(\"GET\",url,true);
				res = xmlhttp.send();
				////console.log('response html = '+xmlhttp.responseHtml);
			
			}
			var flag_hide = true;
			var interval;
			
			function sleep(milliseconds) {
  				var start = new Date().getTime();
  				for (var i = 0; i < 1e7; i++) {
    				if ((new Date().getTime() - start) > milliseconds){
      					break;
    				}
  				}
			}
		/*	window.oldSetInterval = window.setInterval;
			window.setInterval = function(info, func, interval) {
    			var interval_this = oldSetInterval(func, interval);
				if ( ($('#arrow'+info).is(':visible') == false )&&
					($('#loader'+info).is(':visible') == false )
				) {
					clearInterval(interval_this);
				}
				////console.log('check new interval ->'+info);
				//clearInterval(interval_this);
			}
			*/
			var iterate = 0;
			var iterate_minus = -1;
			var mtime = 10;
			var previnfo;
			function hideImmediate(info) {
				////console.log('hideNow immediate info->'+info);
				$('#loader'+info).fadeOut();
				$('#arrow'+info).fadeOut();
			}
			function ClearAllIntervals() {
    			////console.log('clear all prev = '+previnfo);
				for (var i = 1; i < 99999; i++)
        			window.clearInterval(i);
				iterate_minus = -1;
				iterate = -1;
						
			}
			function hideNow(info) {
				////console.log('iterate = '+iterate);
				if ( iterate > 10 ) {
					ClearAllIntervals();
				}
				if ( $('#arrow'+info).is(':visible') == false ) {
					////console.log('clearnow');
					clearInterval(interval);
					iterate++;
					return;
				}
				if ( $('#loader'+info).is(':visible') == false ) {
					////console.log('clearnow');
					clearInterval(interval);
					iterate++;
				}
				
				if ( iterate != -1 ) {
				//	////console.log('val valid ' +iterate);
				
					if ( iterate < 1 ) {
						iterate++;// = iterate + 1;
				//		////console.log('val valid ' +iterate);
						return;
					} else {
						//clearInterval(interval);
						////console.log('hideNow--> info->'+info);
						$('#loader'+info).fadeOut();
						$('#arrow'+info).fadeOut();
						////console.log('interval 2 = '+iterate);
						clearInterval(interval);
						iterate++;
					}
				} else {
				//	////console.log('interval 2 = '+iterate);
					clearInterval(interval);
					iterate_minus++;
					if ( iterate_minus == 30 )
						ClearAllIntervals();
				}
			}
			function showInfo(info, loader, bookcode) {
				if ( previnfo != info )
					hideImmediate(previnfo);
				previnfo = info;
				iterate = -1;
				flag_hide = true;
				////console.log(info+\" \"+loader);
				$('#'+info).show();
				$('#loader'+info).show();
				$('#arrow'+info).show();
				//document.getElementById(info).setAttribute(\"style\", 
				//	\"display:block;position:absolute;z-index:1;border:0px solid #e2e2e2;background-color:blue;\");
					//loadHTML('snapshot.php?bookcode='+bookcode, loader);
			}
			
			function hideInfo(info) {
				if ( previnfo != info )
					hideImmediate(previnfo);
				previnfo = info;
				
				iterate = 0;
				interval = window.setInterval(
					function(){
					hideNow(info)
				}, mtime);
				
				//if ( flag_hide == true ) {
				//	////console.log('hide info->'+info);
					//$('#'+info).fadeOut();
				//	$('#loader'+info).fadeOut();
					//document.getElementById(info).setAttribute(\"style\", 
					//				\"display:none\");	
				
				//}
				
					//document.getElementById(info).fadeOut();
				//setAttribute(\"style\", \"display:none;\");
			}
			function overOnInfo(info) {
				iterate = -1;
				clearInterval(interval);
				//////console.log('capture overOnInfo '+flag_hide);
				$('#loader'+info).show();
				$('#arrow'+info).show();
				//document.getElementById(info).setAttribute(\"style\", 
				//	\"display:block;position:absolute;z-index:1;border:0px solid #e2e2e2;background-color:blue;\");
					
			}
			function outFromInfo(info) {
				////console.log('out from info');
				iterate = 0;
				interval = window.setInterval(
					function(){hideNow(info)
				}, mtime);
				/*if ( flag_hide == true ) {
					////console.log('out from '+info);
					$('#loader'+info).fadeOut();
				}// else //console.log('flag_hide is false');
				*///document.getElementById(info).setAttribute(\"style\", 
				//					\"display:none\");	
				////console.log(document.getElementById(info));
			}
			
		</script>
		";
		$headparam = $headparam . $member_share;	
		$headparam = $headparam . "
		<script>
			var max_width = 1024;
			$(document).ready(function() {
				var height = $(window).height();
				var width = $(window).width();
				//console.log(' width = '+width+',height='+height);
				document.getElementById('div-id').style.height = height;
				if ( width > max_width ) {
					////console.log('change here');
					document.getElementById('maincontent').style.width = max_width+\"px\";
				} else {
					document.getElementById('maincontent').style.width = \"100%\";
				}
				var s_width = $('#div-id').width();
				var m_width = $('#maincontent').width();
				var m_left = 0;//$('#maincontent').left();
				////console.log(width +' , '+s_width+' , '+m_width+' , '+m_left);
				var totalwidth = s_width+m_width;
				////console.log('check width = '+width+' , '+totalwidth);
				if ( width > totalwidth ) {
					$('#div-id').show();
				} else {
					////console.log('hide it');
					$('#div-id').hide();
				}
			});

			window.onresize = function(event) {
				var str = \"\\\"\"+$(window).width()+\"px\\\"\";
				str = \"1716px\";
				//document.getElementById('mheader').style.width = $(window).width()+\"px\";
				//document.getElementById('maincontent').style.width = $(window).width()+\"px\";
				var height = $(window).height();
				var width = $(window).width();
				////console.log('window width = '+width+',height='+height);
				document.getElementById('div-id').style.height = height+'px';
				
				if ( width > max_width ) {
					////console.log('change here');
					document.getElementById('maincontent').style.width = max_width+\"px\";
				} else {
					$('#div-id').hide();	
					document.getElementById('maincontent').style.width = \"100%\";
				}
				var s_width = $('#div-id').width();
				var m_width = $('#maincontent').width();
				var m_left = 0;//$('#maincontent').left();
				////console.log(s_width+' , '+m_width+' , '+m_left);

				if ( width > s_width+m_width ) {
					$('#div-id').show();
				} else {
					$('#div-id').hide();
				}
			}
			function closeScreenCover() {
				document.getElementById('cover_screen').setAttribute(\"style\", 
					\"display:none;\");
				document.getElementById('screen_loader').setAttribute(\"style\", \"display:none;\");
				
			}
			function showScreenCover(url) {
				////console.log(url);
				var height = screen.height;//window.innerHeight || document.body.clientHeight;
				var width = 100;//(window.innerWidth || document.body.clientWidth);
				//if (height < 1000 )
				//	height = 1000;
				var style = \"display:fixed;position:fixed;z-index:30;border:0px solid #e2e2e2;background-color:black;opacity:0.8;width:\"+
				width+\"%;\"+
				\"height:\"+height+
				\"px;\";
				document.getElementById('cover_screen').setAttribute(\"style\", 
					style);
				var width_div = \"90%\";//1000px;
				var hw = width_div / 2;
				var hscreen = screen.width / 2;
				var left = hscreen - hw - 10;
				if ( left < 0 )
					left = 0;
				style = \"display:table;position:relative;border:2px solid #e2e2e2; border-radius:10px; top:30px; width:\"+width_div+\"; z-index:31;margin:0px auto!important;padding:10px;background:white;\";
				document.getElementById('screen_loader').setAttribute(\"style\", style);
				if ( url == '' ) {
					document.getElementById('content_screen_loader').innerHTML = \"<img src=\\\"".$dir."images/ajax-loading.gif\\\">\";
				} else 
					loadHTML(url, 'content_screen_loader', false);
				
			}
			function loadHTML(url, loader, noload) {
				if ( noload === false ) {
					document.getElementById(loader).innerHTML = \"<img src=\\\"".$dir."images/ajax-loading.gif\\\">\";
					$('#'+loader).hide();
					$('#'+loader).fadeIn();
				}
				var xmlhttp;
				if (window.XMLHttpRequest)
  				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
  				}
				xmlhttp.onreadystatechange=function()
  					{
  						if (xmlhttp.readyState==4 && xmlhttp.status==200)
    					{
    						if ( loader != '' ) {
								////console.log('ok');
								if ( noload === false )
									$('#'+loader).hide();
								////console.log('loader = \''+loader+'\' : -> '+xmlhttp.responseText);
								//$('#'+loader).hide();
								////console.log(document.getElementById(loader));
								document.getElementById(loader).innerHTML = xmlhttp.responseText;
								if ( noload === false )
									$('#'+loader).fadeIn(500,function(){
								});
							}
						}
  					}
				xmlhttp.open(\"GET\",url,true);
				res = xmlhttp.send();
				////console.log('response = '+url+'->'+xmlhttp.responseHtml);
			
			}
			function showInfo(info, loader, bookcode) {
				////console.log(info+\" \"+loader);
				document.getElementById(info).setAttribute(\"style\", 
					\"display:block;position:absolute;z-index:5;border:0px solid #e2e2e2;background-color:blue;\");
					//var doc = \"
					//<iframe src=snapshot.php?bookcode=\"+bookcode+\"></iframe>
					//\";

					//document.getElementById(loader).innerHTML = \"<iframe style='border:0px; display:table; width:100%;' src=snapshot.php?bookcode=\"+bookcode+\"></iframe>\";		
					loadHTML('snapshot.php?bookcode='+bookcode, loader, true);
				//\"display:block;border:1px solid block; position:absolute;width:100px;height:100px;z-index=2\");
				//var left = document.getElementById(info).position();//getAttribute(\"left\");
				//////console.log(left.left);
			}
			var flag_hide = true;
			function hideInfo(info) {
				//////console.log(info);
				if ( flag_hide == true )
				document.getElementById(info).setAttribute(\"style\", \"display:none;\");
			}
			function overOnInfo(info) {
				flag_hide = false;
				//////console.log('capture overOnInfo');
				document.getElementById(info).setAttribute(\"style\", 
					\"display:block;position:absolute;z-index:5;border:0px solid #e2e2e2;background-color:blue;\");
					
			}
			function outFromInfo(info) {
				flag_hide = true;
				document.getElementById(info).setAttribute(\"style\", 
					\"display:none\");	
			}
		</script>
		";
		$headparam = $headparam."
			<script>
				function profile_show(id) {
					$('#'+id).show();
					////console.log('profile = '+id);
				}
				function profile_hide(id) {
					$('#'+id).hide();
				}
				var hide = 1;
				function ShowHideDiv(id) {
					if ( hide == 1 ) {
						$('#'+id).show();
						hide = 0; 
					} else {
						$('#'+id).hide();
						hide = 1;
					}
				}
				function showCommon(id) {
					$('#'+id).show();
				}
				function hideCommon(id) {
					$('#'+id).hide();
				}
			</script>
		";
		$headparam = $headparam."
		<script>
			function allowDrop(ev)
			{
				ev.preventDefault();
			}

			function drag(ev)
			{
				ev.dataTransfer.setData(\"Text\",ev.target.id);
			}

			function drop(ev)
			{
				ev.preventDefault();
				var data=ev.dataTransfer.getData(\"Text\");
				ev.target.appendChild(document.getElementById(data));
			}
		</script>
		";
		$headparam = $headparam."
			<script>
				function ShowCollection(id) {
					el = document.getElementById(id);
					if ( el.innerHTML == '- Lihat Koleksi -' ) {
						$('#Collection').show();
						(el).innerHTML = '- Sembunyikan Koleksi -';
					} else {
						$('#Collection').hide();
						(el).innerHTML = '- Lihat Koleksi -';
					}
				}
			</script>
		";
	
		$headparam = $headparam."
				<script>
		function callActivationFormKeyPress(url, data_str, id_loader, event) {
			////console.log(event.keyCode);
			if ( event.keyCode === 13 ) {
				callActivationForm(url, data_str, id_loader);
			}
		}
		function callActivationForm(url, data_str, id_loader) {
			var email_address = $('#email_address').val();
			document.getElementById(id_loader).innerHTML = document.getElementById(id_loader).innerHTML+\"<div style='position:absolute;top:4px;background-color:blue;'><span style=\\\"font-family:'Verdana'; color:yellow;\\\">Fetching data...</span></div>\";
			////console.log(email_address);
			data_str=data_str + '&email_address='+email_address;
			////console.log(data_str);
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
	
			<script>
				function callHTMLFormKeyPress(url, data_str, id_loader, event) {
					////console.log(event.keyCode);
					if ( event.keyCode === 13 ) {
						callHTMLForm(url, data_str, id_loader);
					}
				}
				function callOnSaleForm(url, data_str, id_loader) {
					//////console.log($('#local_search').val());
					var user_email = $('#email_address').val();
					var content = $('#content').val();	
					var quantity = $('#quantity').val();
					var admin_subs_id = $('#id_subs').val();
					document.getElementById(id_loader).innerHTML = document.getElementById(id_loader).innerHTML+\"<div style='position:absolute;top:4px;background-color:blue;'><span style=\\\"font-family:'Verdana'; color:yellow;\\\">Fetching data...</span></div>\";
					data_str=data_str + '&user_email='+user_email+'&content='+content+'&quantity='+quantity+'&subs_id='+admin_subs_id;
					////console.log('bookrequest form'+data_str);
					$.ajax({
						type: \"GET\",
						url:url,
						data:data_str,
						success: function(responseText) {
							////console.log(responseText);
							document.getElementById(id_loader).innerHTML = responseText;
							////console.log(responseText);
							//document.getElementById(id_loader).find(\"script\").each(function(i) {
                    		//	eval($(this).text());
                			//});
						}

					});
					return false;
				}


				function callBookRequestForm(url, data_str, id_loader) {
					//////console.log($('#local_search').val());
					var user_email = $('#email_address').val();
					var content = $('#content').val();	
					var keterangan = $('#keterangan').val();
					document.getElementById(id_loader).innerHTML = document.getElementById(id_loader).innerHTML+\"<div style='position:absolute;top:4px;background-color:blue;'><span style=\\\"font-family:'Verdana'; color:yellow;\\\">Fetching data...</span></div>\";
					data_str=data_str + '&user_email='+user_email+'&content='+content+'&keterangan='+keterangan;
					////console.log('bookrequest form'+data_str);
					$.ajax({
						type: \"GET\",
						url:url,
						data:data_str,
						success: function(responseText) {
							////console.log(responseText);
							document.getElementById(id_loader).innerHTML = responseText;
							////console.log(responseText);
							//document.getElementById(id_loader).find(\"script\").each(function(i) {
                    		//	eval($(this).text());
                			//});
						}

					});
					return false;
				}

				function callCriticsForm(url, data_str, id_loader) {
					//////console.log($('#local_search').val());
					var user_email = $('#email_address').val();
					var content = $('#content').val();	
					document.getElementById(id_loader).innerHTML = document.getElementById(id_loader).innerHTML+\"<div style='position:absolute;top:4px;background-color:blue;'><span style=\\\"font-family:'Verdana'; color:yellow;\\\">Fetching data...</span></div>\";
					data_str=data_str + '&user_email='+user_email+'&content='+content;
					////console.log(data_str);
					$.ajax({
						type: \"GET\",
						url:url,
						data:data_str,
						success: function(responseText) {
							////console.log(responseText);
							document.getElementById(id_loader).innerHTML = responseText;
							////console.log(responseText);
							//document.getElementById(id_loader).find(\"script\").each(function(i) {
                    		//	eval($(this).text());
                			//});
						}

					});
					return false;
				}

				function callHTMLForm(url, data_str, id_loader) {
					//////console.log($('#local_search').val());
					var local_search = $('#local_search').val();
					
					document.getElementById(id_loader).innerHTML = document.getElementById(id_loader).innerHTML+\"<div style='position:absolute;top:4px;background-color:blue;'><span style=\\\"font-family:'Verdana'; color:yellow;\\\">Fetching data...</span></div>\";
					////console.log(local_search);
					data_str=data_str + '&local_search='+local_search;
					////console.log(data_str);
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
		";
		return '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">'.$headparam;
	}
	function writeBodyHeader($dir='./', $additional_script="") {
		if ( isset($_SESSION['fb_id'] )) {
			//echo " SESSION ID = ".session_id();		
			$fb_connected = "
			function fbConnected() {
    			////console.log('Welcome!  Fetching your information.... ');
    			FB.api('/me', function(response) {
      				////console.log('Good to see you, ' + response.name + '.'+' id=> '+ response.id);
    		
					loadHTML('".$dir."content_profile.php?fb_id='+response.id+'&dir=".urlencode($dir)."', 'content_profile_loader', false);
					//loadHTML('show_faces.php', 'fb_container_footer');
					//window.location = \"index.php?fb_id=\"+response.id;	
				});
				$('#fb_container').hide();
				$('#fb_container_footer').show();
				$('#profile_menu').show();
			}
			";

		} else {
			$fb_connected = "
			function fbConnected() {
    			console.log('Welcome!  Fetching your information.... ');
    			FB.api('/me', function(response) {
      				console.log('Good to see you, ' + response.name + '.'+' id=> '+ response.id);
    		
					loadHTML('".$dir."content_profile.php?fb_id='+response.id, 'content_profile_loader', false);
					//loadHTML('show_faces.php', 'fb_container_footer');
					window.location = \"".$dir."login.php?fb_id=\"+response.id+\"&name=\"+response.name;	
				});
				$('#fb_container').hide();
				$('#fb_container_footer').show();
				$('#profile_menu').show();
			}
			";
		}
		$headparam = "
		<div id=\"fb-root\"></div>	
		<script type=\"text/javascript\">	
			function InsertComicRating(url){
				////console.log('send '+url);
				
					//if (str==\"\")
  					//{
  						//	document.getElementById(\"txtHint\").innerHTML=\"\";
  						//	return;
  					//} 
					if (window.XMLHttpRequest)
  					{// code for IE7+, Firefox, Chrome, Opera, Safari
  						xmlhttp=new XMLHttpRequest();
  					}
					else
  					{// code for IE6, IE5
  						xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
  					}
					xmlhttp.onreadystatechange=function()
  					{
  						if (xmlhttp.readyState==4 && xmlhttp.status==200)
    					{
    						//document.getElementById(\"txtHint\").innerHTML=xmlhttp.responseText;
    				//		////console.log(xmlhttp.responseText);
						}
  					}
					//////console.log('insert comic rating url='+url);
					xmlhttp.open(\"GET\",url,true);
					res = xmlhttp.send();
					//////console.log(res);
				}
			var fbasync = false;
			var subs_id_list = '';";
		$headparam = $headparam. "
			function jxFBUserProfile(i, subs_id_list) {
				////console.log('i = '+i);
				var fb_id = subs_id_list[i];
				if ( fb_id == '' )
					return;
				////console.log('jx User Profile '+fb_id+' write subscriber group');
				if ( fbasync == false ) {
					//alert
					////console.log('not synchronized yet with facebook, wait a minute');
					//setTimeOut(1000);
					//jxFBUserProfile(0, subs_id_list);
					return;
				} else {
					//clearInterval(myVar);
					////console.log('fbasync true = '+fbasync);
				}
				FB.api('/'+fb_id, function(response) {
    				loadHTML('../insertfb_name.php?fb_id='+fb_id+'&fb_name='+response.name, '');
					$('#'+fb_id.split('.').join('_')).fadeOut(function() {
						document.getElementById(fb_id.split('.').join('_')).innerHTML = 
							'<a href=\"http://facebook.com/'+response.id+'\">'+response.name+'</a>';
						$('#'+fb_id.split('.').join('_')).fadeIn();
					});
					////console.log(subs_id_list[i]+' '+response.name+' '+\"http://graph.facebook.com/\"+response.id+\"/picture\");
					$('#img_'+fb_id.split('.').join('_')).fadeOut(function() {
						document.getElementById('img_'+fb_id.split('.').join('_')).src = \"http://graph.facebook.com/\"+response.id+\"/picture\";
						//document.getElementById('img_'+fb_id.split('.').join('_')).width = 50;
						$('#img_'+fb_id.split('.').join('_')).fadeIn();
						//////console.log(\"http://graph.facebook.com/\"+response.id+\"/picture\");
					});
					if ( i < subs_id_list.length-1 ) {
						i = i + 1;
						////console.log('recursive jxFB');
						jxFBUserProfile(i, subs_id_list);
					}
				})
				////console.log('auto start');
			};

			<!-- END OF jxFBUserProfile -->
			";
		

			$headparam = $headparam . "
			window.fbAsyncInit = function() {
 				FB.init({
					//appId: '159457617553432',
					//TESTING bawah
					//appId: '116943728442196', 
					appId: '".$GLOBALS['FB_APPID']."',
					status: true, 
					cookie: true, 
					xfbml: true
				});
 				fbasync = true;
				if ( window.subs_id_list != '' ) {
					////console.log('fb asynch init');
					jxFBUserProfile(0, window.subs_id_list);
 				}
				FB.Event.subscribe('auth.authResponseChange', function(response) {
    				////console.log('fb response = '+response.status);
					//if ( response == 'undefined' )
					//	console.log('this undefined');
					if (response.status === 'connected') {
     					fbConnected();
						//testAPI();
    					console.log('connected');
					} else if (response.status === 'not_authorized') {
     					FB.login();
						////console.log('reponse changed');
    				} else {
     					////console.log('reponse changed2 -> '+response.status);
				
						//FB.login();
    				}
				})
				FB.Event.subscribe('edge.create', function(href, widget) {
 				// Do something, e.g. track the click on the \"Like\" button here
 							//alert('You just liked '+href);
 							////console.log('You just liked '+href);
					//window.location.href = 
					url = '".$dir."update_rating.php?url='+href;
					InsertComicRating(url);
				});

				FB.Event.subscribe('edge.remove', function(href, widget) {
   					//alert('dislike '+href);
					//////console.log('unlike blabla ' + href);
   					//window.location.href = 
					url = '".$dir."update_rating.php?url='+href;
					InsertComicRating(url);
				});
			};
			
			// Load the SDK asynchronously
  	
	
			(function(d){
   				var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   				if (d.getElementById(id)) {return;}
   				js = d.createElement('script'); js.id = id; js.async = true;
   				js.src = \"//connect.facebook.net/en_US/all.js\";
   				ref.parentNode.insertBefore(js, ref);
  			}(document));

		".$fb_connected."	
		function logout() {
			window.location = \"".$dir."logout.php\";
		}
       	function fb_logout(){
     		////console.log('Logout Facebook From');
			FB.logout(function(response) {
        		$('#fb_container').show();
				$('#fb_container_footer').hide();
				$('#profile_menu').hide();
		
				//window.location = \"http://localhost/airabooks/aira\";
				window.location = \"".$dir."logout.php\";
			});
 		}
		</script>
		";
		return $headparam;
	}

	function writeProfileHeaderContent($fb_info, $dir) {
		if ( $fb_info['status'] == "ACTIVE" )
			$status = "Aktif";
		else
			$status = "Belum Aktif";
			
		$msg = "Anda belum melakukan sinkronisasi dengan airabooks.com. \\nYang belum jadi anggota, ayo daftar, GRATIS lho!!";
		if ( $fb_info['status'] != "NOT ACTIVE" ) {
			$notactive_profile = "";

			$button_profile = "
				<button onclick=\"javascript:showScreenCover('".$dir."user_profile.php?fb_id=".$fb_info['fb_id']."');\" type=\"button\"
								class=\"style\">Lihat Profil</button>
							
			";
			$admin_profile = "";
			$menu_profile = "
			<a href=\"#\" 
									onclick=\"javascript:showScreenCover('".$dir."bookrent.php?fb_id=".$fb_info['fb_id']."&dir=".$dir."#peminjaman');
									
										\" class=\"style1\">Buku Yang Sedang Anda Pinjam</a>
								<a href=\"#\"
									onclick=\"javascript:showScreenCover('".$dir."user_history.php?fb_id=".$fb_info['fb_id']."&dir=".$dir."');\"
									class=\"style1\">Riwayat Peminjaman</a>
								<a href='#' onclick=\"javascript:alert('Maaf, Sedang dalam tahap pengembangan');\" class=\"style1\">Rekomendasi Untuk Anda</a>
								<a href='#'
								onclick=\"".
										"javascript:showScreenCover('".$dir."onsale.php?dir=".urlencode($dir)."');\" "
					
								//javascript:alert('Maaf, Sedang dalam tahap pengembangan');
								."\"
								class=\"style1\">Pembelian</a>
								<a href='#' onclick=\"javascript:showScreenCover('".$dir."critics.php');\" class=\"style1\"
									 >Saran & Kritik</a>
						
		";
			if ( $fb_info['role'] == 'ADMIN' ) {
				$admin_profile = $admin_profile. "<a href='#' onclick=\"javascript:showScreenCover('".$dir."uservisitlog.php');\" class=\"style1\"
									 >User Visit Log</a>";
				$admin_profile = $admin_profile. "<a href='#' onclick=\"javascript:showScreenCover('".$dir."changeuser.php');\" class=\"style1\"
									 >Change User</a>";
			
			}
		} else {
			$notactive_profile = "<a style=\"font-weight:bold; color:red;\" href='#' onclick=\"javascript:showScreenCover('".$dir."activation.php?dir=".$dir."&fb_id=".$fb_info['fb_id']."'); return false;\">Aktifkan Akun Anda</a>";
	
			$button_profile = "
				<button onclick=\"javascript:alert('".$msg."');\" type=\"button\"
								class=\"style\">Lihat Profil</button>
							
			";
			$menu_profile = "
			<a href=\"#\" 
									onclick=\"javascript:alert('".$msg."');
									return false;
										\" class=\"style1\">Buku Yang Sedang Anda Pinjam</a>
								<a href=\"\"
									onclick=\"javascript:alert('".$msg."');return false;\"
									class=\"style1\">Riwayat Peminjaman</a>
								<a href='#' onclick=\"javascript:alert('".$msg."');return false;\" class=\"style1\">Rekomendasi Untuk Anda</a>	
								<a href='#' onclick=\"javascript:alert('".$msg."');return false;\" class=\"style1\">Pembelian</a>	
					<a href='#' class=\"style1\" onclick=\"javascript:showScreenCover('critics.php');\"
									>Saran & Kritik</a>
		";
		}
		$content_profile = "
			<img alt='facebook profile picture' src=\"https://graph.facebook.com/".$fb_info['fb_id']."/picture?type=large\" width=\"80\" style=\"float:left;margin:5px;\" >
		
							<span style=\"
								font-family:'Verdana';
								font-size:13px;
								font-weight:bold;
								display:block;
								margin:5px;
							\">
								".$fb_info['full_name']."
							</span>
							<span style=\"
								font-family:'Verdana';
								font-size:12px;
								display:block;
								margin:5px;
							\">
								ID: ".$fb_info['subscriber_id']."
							</span>
							<span style=\"
								font-family:'Verdana';
								font-size:12px;
								display:block;
								margin:5px;
							\">
								Status Akun Anda: ".$status."
							</span>
							<span style=\"
								font-family:'Verdana';
								font-size:12px;
								display:block;
								margin:5px;
								border:1px solit black;
							\">
								".$notactive_profile."
							</span>
							".$button_profile."
							<div style=\"
								display:table;
								width:100%;
								border-top:1px solid #e2e2e2;
								height:1px;
								margin:5px 0 0px 0;
								padding:0px;
								background-color:#fbfbfb;
							\">".
								$menu_profile
							."
							</div>";
			if ( $admin_profile != "" ) {
				$content_profile = $content_profile."
					<div style=\"
								display:table;
								width:100%;
								border-top:1px solid #e2e2e2;
								height:1px;
								margin:5px 0 0px 0;
								padding:0px;
								background-color:#fbfbfb;
							\">".
								$admin_profile
							."
							</div>";
				
			}
			$content_profile = $content_profile."<div style=\"
								display:table;
								width:100%;
								border-top:1px solid #e2e2e2;
								height:1px;
								//margin:5px 0 5px 0;
								padding:0px;
							\">
								<button class=\"style\" style=\"
								float:right;		
								margin:5px;
								\"
								onclick=\"javascript:fb_logout();\"
								type=\"button\" >Logout</button>
							</div>
		";
		return $content_profile;	
	}
	function writeProfileHeader($fb_info, $dir='./') {
		$content_profile = "
			
			<img alt='facebook profile picture' src=\"https://graph.facebook.com/".$fb_info['fb_id']."/picture?type=large\" width=\"80\" style=\"float:left;margin:5px;\" >
		
							<span style=\"
								font-family:'Verdana';
								font-size:13px;
								font-weight:bold;
								display:block;
								margin:5px;
							\">
								".$fb_info['full_name']."
							</span>
							<span style=\"
								font-family:'Verdana';
								font-size:12px;
								display:block;
								margin:5px;
							\">
								ID: ".$fb_info['subscriber_id']."
							</span>
							<button onclick=\"javascript:showScreenCover('cover_screen');\" type=\"button\"
								class=\"style\">Lihat Profil</button>
							<div style=\"
								display:table;
								width:100%;
								border-top:1px solid #e2e2e2;
								height:1px;
								margin:5px 0 0px 0;
								padding:0px;
								background-color:#fbfbfb;
							\">
								<a href='#' class=\"style1\">Buku Yang Sedang Dipinjam</a>
								<a href='#' class=\"style1\">Riwayat Peminjaman</a>
								<a href='#' class=\"style1\">Rekomendasi Untuk Anda</a>	
							</div>
							<div style=\"
								display:table;
								width:100%;
								border-top:1px solid #e2e2e2;
								height:1px;
								padding:0px;
							\">
								<button class=\"style\" style=\"
								float:right;		
								margin:5px;
								\"
								onclick=\"javascript:fb_logout();\"
								type=\"button\" >Logout</button>
							</div>
		";
		$content_profile="<div id=\"content_profile_loader\"></div>";	
		if ( $fb_info['fb_id'] == "" )
			$profile_photo = $dir."cover_small/nophoto.png";
		else
			$profile_photo = "https://graph.facebook.com/".$fb_info['fb_id']."/picture";
		//echo "CHECK FB_ID = ".$fb_info['fb_id'];
		if ( isset($_SESSION['fb_id']) ) {
			$header = "<div id=\"fb_container\" style=\"
				position:relative;
				float:right;
				right:40px;	
				top:5px;
				width:70px;
				height:40px;
			\">
			
			<button class=\"style\" style=\"
								position:relative;
								float:right;		
								margin:5px;
								\"
								onclick=\"javascript:logout();\"
								type=\"button\" >Logout</button>
			</div>";
		} else
			$header = "
			<div id=\"fb_container\" style=\"
				position:relative;
				float:right;
				right:40px;	
				top:2px;
				width:70px;
				height:40px;
			\">
			<fb:login-button style=\"border:0px solid black; 
				margin-top:10px;\" show-faces=\"false\" width=\"200\" max-rows=\"1\"></fb:login-button>
			</div>";
		$header = $header . "
		<div id=\"profile_menu\" style=\"
				display:none;
				position:relative;
				float:right;
				right:20px;	
				top:2px;
				width:70px;
				height:40px;
			\">
		<a href=\"\" class=\"style1\" 
			style=\"
				padding:3px;
				margin:0px;
				width:63px;
				height:40px;
			\" 
			onclick=\"return false;\">
		<nav class=\"drop-menu\">		
				<img alt='profile photo' class=\"profile\" id=\"img_profile\" src=\"".$profile_photo."\" height=\"40\" width=\"40\"
					style=\"float:left\"
				>
				<div style=\"
					position:absolute;
					width:0;
					height:0;
					float:left;
					top:20px;
					right:5px;
					border-top:10px solid #bfbfbf;
					border-left:10px solid transparent;
					border-right:10px solid transparent;
				\"></div>
				
				<div class=\"profile_content\" id=\"profile_content\" style=\"
					display:none;
					position:absolute;
					width:320px;
					height:200px;
					left:-260px;
					top:40px;
					z-index:1;
					\">
					<div style=\"
						position:absolute;
						width:0;
						height:0;
						right:25px;
						border-bottom:15px solid #bfbfbf;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
						\">
					</div>
					<div style=\"
						position:absolute;
						width:0;
						height:0;
						top:1px;
						right:25px;
						border-bottom:15px solid white;
						border-left:15px solid transparent;
						border-right:15px solid transparent;
						z-index:2;
						\">
					</div>
				</div>".
			"<ul style=\"position:absolute;width:0; height:0px;
			\"><li>".CreateFloatingBox(13, -305, "top", 0, 302, 350, $content_profile, "menu_float")."</li></ul>"
			."</nav>
			</a>
		</div>
		";
		return $header;
	}
	function writeHeader($dir='./', $additional_script="") {
	$header = "<div id=\"cover_screen\"></div>
		<div style=\"position:absolute;display:none\" id=\"screen_loader\">
			<div style=\"
				position:absolute;
				right:-20px;
				top:-30px;
				float:right;\">
				<a href=\"\" onclick=\"javascript:closeScreenCover(); return false;\"><img alt='close' src=\"".$dir."images/close.png\" width=\"40\"></a>
			</div>
			<div style=\"background-color:white;display:table;text-align:center; width:100%; border:0px solid black;\" id=\"content_screen_loader\">
				<img alt='loading' src=\"".$dir."images/ajax-loading.gif\">
			</div>
		</div>
		";
		$header = $header . $this->writeBodyHeader($dir, $additional_script);
			
		$header = $header . "
		<div id=\"mheader\" class=\"mheader\">
			<div style=\"display:block;border:0px solid black;position:absolute;z-index:2;\" class=\"logo\">
				<img alt='airabooks' id=\"drag1\" draggable=\"true\" ondragstart=\"drag(event)\"  src=\"".$dir."images/airabooks.png\" width=\"110\" height=\"70\">
			</div>
			<div class=\"search\">";
		$header = $header . "<div style=\"position:relative;left:178px;border:0px solid black\">	
			<gcse:searchbox-only class=\"gsearch\" ></gcse:search>
			</div>
			<div style=\"position:absolute;left:720px; top:-30px; border:0px solid red; width:150px; height:20px;z-index:10;\">
			".writeLikeButtonComplete('http://airabooks.com','like')."
			</div>
			";
		$fb_info = getFBInfoOffline();
		$header = $header."</div>";
		$header = $header.$this->writeProfileHeader($fb_info, $dir);	
		$header = $header ."</div>
		";
		return $header;
	}
	function writeMenu($selected_parent="", $selected="", $wikiinfo="", $dir="./") {
		$list_menu = Array (
			'border0' => 'border',
			'Home' => $dir.'index.php',
			'Wiki' => Array (
					'index' => $dir.'wiki/index.php',
					'Wiki Page' => $dir.'wiki/index.php',
					'About' => $dir.'wiki/wikiabout.php',
					'Bantuan' => $dir.'wiki/wikihelp.php'
				),
			'border1' => 'border',
			'New Release' => $dir.'newrelease.php',
			'New Titles' => $dir.'newtitles.php',
			'Books Of The Month' => $dir.'booksofthemonth.php',
			'Most Popular' => Array (
				'top' => -100,
				'left' => 55,
				'arrow_dir' => 'left',
				'top_arrow' => 75,
				'left_arrow' => 0,
				'width' => 148,
				'index' => $dir.'mostpopular.php',
				'Semua Genre' => $dir.'mostpopular.php',
				'Genre Fantasy' => $dir.'mostpopular.php?genre=Adventure+Fantasy',
				'Genre Drama' => $dir.'mostpopular.php?genre=Drama',
				'Genre Romance' => $dir.'mostpopular.php?genre=Romance',
				'Genre Action' => $dir.'mostpopular.php?genre=Action',
				'Genre Comedy' => $dir.'mostpopular.php?genre=Comedy',
				'Genre History' => $dir.'mostpopular.php?genre=History',
				'Genre Detektif' => $dir.'mostpopular.php?genre=Detective',
				'Genre Misteri' => $dir.'mostpopular.php?genre=Mystery',
				'Genre Olahraga' => $dir.'mostpopular.php?genre=Sport',
			),


			'Most Recommended' => Array (
				'top' => -100,
				'left' => 98,
				'arrow_dir' => 'left',
				'top_arrow' => 75,
				'left_arrow' => 0,
				'width' => 148,
				'index' => $dir.'mostrecommended.php',
				'Semua Genre' => $dir.'mostrecommended.php',
				'Genre Fantasy' => $dir.'mostrecommended.php?genre=Adventure+Fantasy',
				'Genre Drama' => $dir.'mostrecommended.php?genre=Drama',
				'Genre Romance' => $dir.'mostrecommended.php?genre=Romance',
				'Genre Action' => $dir.'mostrecommended.php?genre=Action',
				'Genre Comedy' => $dir.'mostrecommended.php?genre=Comedy',
				'Genre History' => $dir.'mostrecommended.php?genre=History',
				'Genre Detektif' => $dir.'mostrecommended.php?genre=Detective',
				'Genre Misteri' => $dir.'mostrecommended.php?genre=Mystery',
				'Genre Olahraga' => $dir.'mostrecommended.php?genre=Sport',
			),

			'borderh' => 'border',
			'Browse Komik' =>  Array (
				'top' => -100,
				'left' => 62,
				'arrow_dir' => 'left',
				'top_arrow' => 75,
				'left_arrow' => 0,
				'width' => 148,
				'index' => $dir.'browsecomic.php',
				'Semua Genre' => $dir.'browsecomic.php',
				'Genre Fantasy' => $dir.'comic_genre.php?genre=Adventure+Fantasy',
				'Genre Drama' => $dir.'comic_genre.php?genre=Drama',
				'Genre Romance' => $dir.'comic_genre.php?genre=Romance',
				'Genre Action' => $dir.'comic_genre.php?genre=Action',
				'Genre Comedy' => $dir.'comic_genre.php?genre=Comedy',
				'Genre History' => $dir.'comic_genre.php?genre=History',
				'Genre Detektif' => $dir.'comic_genre.php?genre=Detective',
				'Genre Misteri' => $dir.'comic_genre.php?genre=Mystery',
				'Genre Olahraga' => $dir.'comic_genre.php?genre=Sport',
			),
			'Browse Novel' => Array (
				'top' => -100,
				'left' => 58,
				'arrow_dir' => 'left',
				'top_arrow' => 75,
				'left_arrow' => 0,
				'width' => 148,
				'index' => $dir.'browsecomic.php',
				'index' => $dir.'browsenovel.php',
				'Semua Genre' => $dir.'browsenovel.php',
				'Genre Fantasy' => $dir.'novel_genre.php?genre=Adventure+Fantasy',
				'Genre Drama' => $dir.'novel_genre.php?genre=Drama',
				'Genre Romance' => $dir.'novel_genre.php?genre=Romance',
				'Genre Action' => $dir.'novel_genre.php?genre=Action',
				'Genre Comedy' => $dir.'novel_genre.php?genre=Comedy',
				'Genre History' => $dir.'novel_genre.php?genre=History',
				'Genre Detektif' => $dir.'novel_genre.php?genre=Detective',
				'Genre Misteri' => $dir.'novel_genre.php?genre=Mystery',
				'Genre Olahraga' => $dir.'novel_genre.php?genre=Sport',
			),
			'Browse Sinopsis' => $dir.'browsesynopsis.php',
			'border2' => 'border',
			'Peminjaman' => $dir.'rentinfo.php',
			'Peminjaman Hari Ini' => $dir.'renttoday.php',
			'border3' => 'border',
			'By Request' => $dir.'byrequest.php',
			'border4' => 'border',
			'Evaluation' => Array (
				'top' => -50,
				'left' => 40,
				'arrow_dir' => 'left',
				'top_arrow' => 30,
				'left_arrow' => 0,
				'width' => 148,
				'index' => $dir.'index.php',
				'Member Of The Month' => $dir.'memberofthemonth.php',
				'Pemesanan' => $dir.'onsale.php',	
				'Coming Soon' => $dir.'comingsoon.php',
				'New Titles' => $dir.'newtitles.php',
			),
		);
		$menu = "<div class=\"mmenu\" id=\"mmenu\">";
			$menu= $menu."<ul class=\"mainmenu\">\n";
			foreach ( $list_menu as $i => $value ) {
				if ( $i == "Wiki" ) {
					$menu = $menu."<li>\n";
					$menu = $menu."<a class=\"mainmenu\" href=\"".$value['index']."\">".$i."</a>\n";
					
					$menu = $menu."<ul class=\"mainmenu\" style=\"border:1px solid #e2e2e2;background-color:white;padding:5px 5px 5px 20px;
					width:137px;\">";							
					foreach ( $value as $j => $val ) {
						if ( $j == "index" )
							continue;
						if ( $selected_parent == $j ) {
							$menu = $menu . "<li><a style=\"background-color:#bfbfbf;width:130px;\" class=\"mainmenu\" href=\"".$val."\">".$j."</a></li>";
							if ( $j == "Wiki Page" && $selected != "" ) {
								/*$menu = $menu . 
								"<ul class=\"mainmenu\" style=\"padding:0;margin:1px 0 0 10px;\"><li><a style=\"background-color:#bfbfbf;width:120px;\" class=\"mainmenu\" >".$selected."</a></li></ul>";
								*/
								$menu = $menu . "<li>
								<p style='margin:0 0 0 10px; clear:both;'><a style=\"background-color:#bfbfbf;width:120px;\" class=\"mainmenu\" >".$selected."</a></p></li>";
								
							}
						}
						else
							$menu = $menu . "<li><a class=\"mainmenu\" href=\"".$val."\">".$j."</a></li>";
					}
					$menu = $menu."</ul>";
					$menu = $menu."</li>";
				} else
				if ( is_array($value) == true ) {
					if ( $i == "Evaluation" ) {
						if ( $_SESSION['role'] != 'ADMIN' )
							continue;
					}
					$menu = $menu."<li>\n";
					$menu = $menu."<div onmouseover=\"
							javascript:showCommon('".str_replace(' ','_',$i)."')\"
							onmouseout=\"
							javascript:hideCommon('".str_replace(' ','_',$i)."')\"
						
>";//"<nav class=\"drop-menu\">\n";
					if ( $selected_parent != $i ) 
						$menu = $menu."<a
												class=\"mainmenu\"
												style=\"border:0px solid black; position:relative;\" href=\"".$value['index']."\" >".$i."<span class=\"arrow-right\"></span>
						</a>\n";
					else
						$menu = $menu."<a class=\"mainmenu\" 
						style=\"border:0px solid black;background-color:#bfbfbf; position:relative;\" href=\"".$value['index']."\">".$i."<span class=\"arrow-right\"></span>
						</a>\n";
					$float_box = "
					<ul style=\"width:115px; margin:5px 0 5px 0; padding:5px 0 0 5px;\" class=\"mainmenu\">\n";
					$k = 0;
					foreach	($value as $j => $val ) {
						if ( $k < 7 ) {
							$k++;
							continue;
						}
						if ( $selected_parent != $i || $selected != $j )
							$float_box = $float_box."\t<li><a class=\"mainmenu\" href=\"".$val."\">".$j."</a></li>\n";
						else 
							$float_box = $float_box."\t<li style=\"display:block!important;background-color:#bfbfbf;\"><a class=\"mainmenu\" href=\"".$val."\" style=\"\">".$j."</a></li>\n";
					}
					$float_box = $float_box . "</ul>";;
					$menu = $menu ."<ul id='".str_replace(' ','_',$i)."' style=\"
						display:none;
						border:0px solid blue;
						list-style:none; margin:0px padding:0px;\"><li style=\"margin:0px; padding:0px;\">". CreateFloatingBox($value['top'], $value['left'], $value['arrow_dir'], 
						$value['top_arrow'], 
						$value['left_arrow'],
						$value['width'], $float_box, str_replace(' ','',$i))."</li></ul>";
					$menu = $menu . "</div>";//"</nav>\n";
					$menu = $menu . "</li>\n";
				} else
				if ( $value == "border" ) 
					$menu = $menu."<li class=\"border\"><div></div></li>\n";
				else {
					if ( $i == "Recommended For You" ) {
						if ( $_SESSION['status'] == 'NOT ACTIVE' )
							continue;
					}
					if ( $selected_parent != $i )
						$menu = $menu."<li><a class=\"mainmenu\" href=\"".$value."\">".$i."</a></li>\n";
					else {
						$menu = $menu."<li style=\"background-color:#bfbfbf;\"><a class=\"mainmenu-selected\" href='".$value."' style=\"\">".$i."</a></li>";
						if ( $i == "News Channel" && $selected != "" ) {
							$menu = $menu."<ul style=\"list-style=none; margin:1px 0 0 20px; padding:0px 0 0 0px; background-color:#bfbfbf;color:#161674;\">
							<li style=\"list-style:none;border:0px solid black; padding:5px;\">".$selected."</li>
							</ul>";
						}
					}
				}
			}
			$menu=$menu."</ul>\n";
		$menu = $menu . "<table style='width:100%;text-align:center;'>
		<tr>
			<td>
				".printAds(3)."
			</td>
		</tr>
		<tr>
			<td>
				".printAds(2)."
			</td>
		</tr>
		</table>";
		if ( $_SESSION['role'] == 'ADMIN' ) {
		$menu = $menu . "
		<div style=\"border:1px solid #e2e2e2; margin:10px; padding:10px; background-color:#e1e1e1;\">
			<span style=\"display:table; text-align:center; width:100%; 
				font:normal 12px/12px arial, sans-serif; color:green;\">
				".countViewer()." viewer</span>
		</div>
		";
		}
		$menu = $menu."</div>\n";
		return $menu;
	}

	function writeBOXSnapshotContent($ctnt) {
		$content = "";
		$num_box = 1;
		$i = 0;
			$c = $ctnt[$i];
			$content = $content. "<div class=\"box\" style=\"display:table;border:0px solid black;width:370px;padding:5px; \">";
			$content = $content."
					<!--<p><a href='".$c['href_title']."'>".$c['Title']."</a></p>-->
					<div class=\"img\" style=\"margin:0px 5px 5px 0px\">
						<img alt='".$c['Title']."' id=\"drag1\" draggable=\"true\" ondragstart=\"drag(event)\" src=\"".$c['img_src']."\" width=\"80\" height=\"110\">
					</div>	
				";
			$like_rating = 0;
			if ( $c['Recommended_Max'] > 0 ) {
				$like_rating = round(($c['Recommended_Index']/$c['Recommended_Max'])*85);
			}
			//$content = $content."<span class=\"snapshot\">";
			$content = $content."<table style='font:normal 13px/15px Arial, Sans-serif;'><tr>
			<td>
				Judul 
			</td>
			<td>
				:
			</td>
			<td>
				<a href='wiki/wikibook.php?bookcode=".$c['Code']."'>".AdjustString($c['Judul'])."</a>
			</td>	
		</tr>
		<tr>
			<td>
				Pengarang
			</td>
			<td>
				:
			</td>
			<td>
				<a href='wiki/wikiauthor.php?author_name=".urlencode($c['Pengarang'])."'>".AdjustString($c['Pengarang'])."</a>
			</td>
		</tr>
		<tr>
			<td>
				Genre 
			</td>
			<td>
				:
			</td>
			<td>
				<a href='".$c['href_title']."'>".$c['Title']."</a>
			</td>
		</tr>
		<tr>
			<td>
				Status
			</td>
			<td>
				:
			</td>
			<td>
				".$c['Status']."
			</td>
		</tr>
	</table>";
			$content = $content."
			<div style=\"border:0px solid red; display:table;width:270px;
				height:23px;\">
				<div class='likerating' style=\"position:relative\" id=\"star\">
					<ul class=\"star\">
  						<li class=\"curr\" title=\"none\" style=\"width: ".round(($c['Popularitas_Index']/$c['Popularitas_Max'])*85)."px;\"></li>
 					</ul>
				</div>
				<div class='likerating'>
 					<ul class=\"star\">
  					<li class=\"curr\" title=\"9\" style=\"width: ".$like_rating."px;\"></li>
 					</ul>
				</div>
			</div>
				";
			$content = $content . "<span style=\"float:left;font:normal 13px/15px Arial, Sans-serif;padding:5px;border:0px solid black;display:table;\">";
				if ( $c['Synopsis'] != '...' )
					$content = $content.$c['Synopsis']."<a href='wiki/wikibook.php?bookcode=".$c['Code']."'>see more</a>";
				else
					$content = $content."Sinopsis belum tersedia.";
			$content = $content."</span>";
			$content = $content."
				<div style=\"margin:5px;border:0px solid blue;
					display:table;
					width:100%;
					\">".
				writeLikeButtonCommon("http://airabooks.com/wiki/wikibook.php?bookcode=".urlencode($c['Code']), "")
				."</div>
			";
			$content = $content."</div>";
		return $content;
	}
	function writeBOXContent($ctnt) {
		$num_box = count($ctnt);
		
		for ( $i = 0; $i < $num_box; $i++ ) {
			$c = $ctnt[$i];
			$content = "
					<p style=\"font:normal 15px/18px Arial, Sans-Serif; text-align:center; margin:5px;\" ><a href='".$c['href_title']."'>".$c['Title']."</a></p>
					<!--<div class=\"img\" style=\"margin:0px 5px 5px 0px\">-->
						<img alt='".$c['Title']."' src=\"".$c['img_src']."\" width=\"80\" height=\"110\" style=\"float:left; margin:0 5px 5px 0px \">
					<!--</div>	-->
				";
			
			//$content = $content."<span class=\"snapshot\">";
			
			$like_rating = 0;
			if ( $c['Recommended_Max'] > 0 )
				$like_rating = round(($c['Recommended_Index']/$c['Recommended_Max'])*85);
				
			$content = $content."
		<table style='font:normal 13px/15px Arial, Sans-serif;text-align:left;'>
			<tr>
				<td>
					Judul 
				</td>
				<td>
					:
				</td>
				<td>
					<a href='wiki/wikibook.php?bookcode=".$c['Code']."'>".AdjustString($c['Judul'])."</a>
				</td>
			</tr>
			<tr>
				<td>
					Pengarang
				</td>
				<td>
					:
				</td>
				<td>
					<a href='wiki/wikiauthor.php?author_name=".urlencode($c['Pengarang'])."'>".AdjustString($c['Pengarang'])."</a>
				</td>
			</tr>
			<tr>
				<td>
					Status
				</td>
				<td>
					:
				</td>
				<td>
					".$c['Status']."
				</td>
			</tr>
		</table>
				<div class='likerating'>
					<ul class=\"star\">
  						<li class=\"curr\" title=\"none\" style=\"width: ".(round(($c['Popularitas_Index']/$c['Popularitas_Max'])*85))."px;\"></li>
 					</ul>
				</div>
				<div style=\"border:1px solid transparent;width:10px; float:left\"></div>
				<div class='likerating'>
 					<ul class=\"star\">
  					<li class=\"curr\" title=\"9\" style=\"width: ".$like_rating."px;\"></li>
 					</ul>
				</div>
				<br><br>
				<span style='font:normal 13px/15px Arial, Sans-serif; text-align:left;'>".$c['Synopsis']."<a href='wiki/wikibook.php?bookcode=".$c['Code']."'>see more</a></span>
			";
			//$content = $content."</span>";
			$myc[] = "<div>".$content."</div>";
		}
		$content_t = "
		<table style='border-spacing:0px;width:100%;vertical-align:top;text-align:left;background-color:#e2e2e2;'>
			<tr>
				<td style=\"vertical-align:top;width:50%;background-color:white; border-right:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; padding:10px;\">
					".$myc[0]."
				</td>
				<td style=\"vertical-align:top;background-color:white; border-bottom:1px solid #e2e2e2; padding:10px;\">
					".$myc[1]."
				</td>
			</tr>
			<tr>
				<td  style=\"vertical-align:top;background-color:white; border-right:1px solid #e2e2e2; padding:10px;\">
					".$myc[2]."
				</td>
				<td  style=\"vertical-align:top;background-color:white; border-bottom:0px solid #e2e2e2; padding:10px; \">
					".$myc[3]."
				</td>
			</tr>
		</table>
		";
		$content = $content_t;
		
		return $content;
	}
	function writeBOXLONGContent($ctnt) {	
		$content = "
			<p class=\"left\" style=\"clear:both;border:0px solid black;text-align:left; 
				margin:10px;font:normal 15px/16px Arial, sans-serif;\">
				<a href='".$ctnt['href_bigtitle']."'>".AdjustString($ctnt['Title'])."</a></p>";
		
		$content .= "<table class=\"boxlong\" style='width:100%;text-align:left;'><tr>";
		$mrand = 0;
		for ( $i = 0; $i < count($ctnt)-2; $i++ ) {
			$c = $ctnt[$i];
			$mrand++;
			$content = $content . "<td style='vertical-align:top;width:20%;'>";
			$d = Array (
				'Code' => $c['Code'],
				'img_href' => "wiki/wikibook.php?bookcode=".$c['Code'], 
				'img_src' => $c['img_src'],
				'img_width' => '90',
				'img_height' => '120',
				'img_class' => 'mainpic'
			);
				$content = $content . SnapShotPrev($d);
				$content = 	$content."
					<p class=\"title\"><a href='wiki/wikibook.php?bookcode=".$c['Code']."'>".AdjustString($c['Judul'])."</a></p>
					<p class=\"author\">by <a href='wiki/wikiauthor.php?author_name=".urlencode($c['Author'])."'>".AdjustString($c['Author'])."</a></p>
					<p class=\"author\">".$c['Popularitas']."</p>
					<p class=\"author\">".$c['Popularitas2']."</p>";
				$content = $content . "</td>";
		}
		$content = $content . "</tr></table>";
		return $content;
	}
};
?>
<?php
class BooksLayout {
	
	function writeBooksGenre($mlayout, $bookscommon, $menu, $genre, $action_handler) {
		echo $mlayout->writeHeader();
		echo $mlayout->writeMenu($menu, "");
		$local_search = $_GET['local_search'];
		$cur_offset = $_GET['offset'];
		$cur_offset = ($cur_offset=="")?0:$cur_offset;
		$content = $bookscommon->writeBooksGroup($cur_offset, 20, $local_search, $genre);
		$numrows = $bookscommon->getBooksNumRows($local_search, $genre);	
		$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
		$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
		$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
			

	$content_html = "
		<div class=\"mcontent\" id=\"mcontent\">
			<div class=\"boxlong_detail\" >
			<p class=\"left\">Koleksi Komik Dengan ".$menu."</p>";
				
	$nav_var = "
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form  class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form  class=\"form_style\" style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>";
			
			$content_html = $content_html . $nav_var;
			
			$content_html = $content_html . "
			<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<form  class=\"form_style\" name=\"local_search\" method=\"get\" action=\"".$action_handler."\">
					<input style=\"border:1px solid black;
						height:24px;
					\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0px;
					\"type=\"submit\" value=\"search\">
				</form>
			</div>";
			
				for ( $i = 0; $i < count($content); $i++ ) {
					$content_html = $content_html . $content[$i];
					if ( $i > 0 && (($i+1) % 5 == 0 ) && $i != 20-1)
						$content_html = $content_html. "<div class=\"hline\"></div>";
				}
			
			$content_html = $content_html. 
		"</div>";
		
			$content_html = $content_html.$nav_var.
		"</div>";
		return $content_html;
	}

	function writeJXBooksOfTheMonth($month, $year, $mlayout, $bookscommon, $menu, $genre, $action_handler) {
		$local_search = "";
		$cur_offset = 0;
		$cur_offset = ($cur_offset=="")?0:$cur_offset;
		$content = $bookscommon->writeBooksOfTheMonthGroup($month, $year, $cur_offset, 20, $local_search, $genre);
		$numrows = $bookscommon->getBooksOfTheMonthNumRows($month, $year, $local_search, $genre);	
		$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
		$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
		$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
				
	$nav_var = "
		<div style=\"display:table;width:100%;\">
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form  class=\"form_style\" style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>
		</div>";
			$content_html = "";	
			$content_html = $content_html."<p class=\"left\">".$menu."</p>";
			$content_html = $content_html . $nav_var;
			
			$content_html = $content_html . "
			<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<form  class=\"form_style\" name=\"local_search\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input style=\"border:1px solid black;
						height:24px;
					\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0 0 0 -1px;
					\"type=\"submit\" value=\"search\">
				</form>
			</div>";
			$content_html = $content_html."<div id=\"booksofthemonth\">";	
				$content_html = $content_html . printBOXLONGCommon($content);
			
			$content_html = $content_html."</div>";
		
			$content_html = $content_html.$nav_var;
		return $content_html;
	}
	function writeBooksOfTheMonth($month, $year, $mlayout, $bookscommon, $menu, $genre, $action_handler) {
		$local_search = $_GET['local_search'];
		$cur_offset = $_GET['offset'];
		$cur_offset = ($cur_offset=="")?0:$cur_offset;
		$content = $bookscommon->writeBooksOfTheMonthGroup($month, $year, $cur_offset, 20, $local_search, $genre);
		$numrows = $bookscommon->getBooksOfTheMonthNumRows($month, $year, $local_search, $genre);	
		$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
		$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
		$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
			
	$start_year = 2012;
	$start_month = 4;

	$year_l = $start_year;
	$month_l = $start_month;
	
	$month_filter = "<nav class=\"drop-menu-month_filter\"><a class=\"style1\" href='#'>&middot; ".$start_year." &middot;</a>";
	$temp_str = "<ul style=\"text-align:center;\">";
	while ( $year_l <= date("Y") ) {
		$temp_str = $temp_str ." <li><a class=\"style1\" style=\"width:97%;\" href='#' onclick=\"jxReload(".$month_l.",".$year_l.")\">".MonthToIndo($month_l-1)." ".$year_l."</a></li>";
		if ( $year_l == date("Y") && $month_l == date("m") ) {
			$temp_str = $temp_str."</ul>";
			$temp_str = "<ul style=\"text-align:center;\"><li>".CreateFloatingBox(0, 0, "top", 0, 20, 150, $temp_str, "")."</li></ul>";
			$month_filter = $month_filter.$temp_str."</nav>";
			break;
		}
		$month_l++;
		if ( $month_l > 12 ) {
			$temp_str = $temp_str . "</ul>";
			$temp_str = "<ul style=\"text-align:center;\"><li>".CreateFloatingBox(0, 0, "top", 0, 20, 150, $temp_str, "")."</li></ul>";
			$month_filter = $month_filter.$temp_str."</nav>";
			$month_filter = $month_filter."<nav class=\"drop-menu-month_filter\"\"><a class=\"style1\" href='#'>&middot; ".($year_l+1)." &middot;</a>";
			$temp_str = "<ul style=\"text-align:center;\">";
	
			$year_l++;
			$month_l = 1;
		}
	}
	$content_html = "
		<div class=\"mcontent\" id=\"mcontent\">
			<div class=\"boxlong_detail\" style=\"position:relative;\">";
	$content_html = $content_html."<div style=\"position:relative;border-bottom:1px solid #e2e2e2; display:table; width:100%; text-align:center;\">".
			$month_filter."
			</div>";
				
	$nav_var = "
			<div style=\"display:table;width:100%\">
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form class=\"form_style\" style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>
			</div>";
			
			$content_html = $content_html."<div id=\"booksofthemonth\">";	
			$content_html = $content_html."<p class=\"left\">".$menu."</p>";
			$content_html = $content_html . $nav_var;
			
			$content_html = $content_html . "
			<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<form class=\"form_style\" name=\"local_search\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					
					<input style=\"border:1px solid black;
						height:20px;
					\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0 0 0 -1px;
					\"type=\"submit\" value=\"search\">
				</form>
			</div>";
				$content_html = $content_html . printBOXLONGCommon($content);
			$content_html = $content_html.$nav_var;
			
			$content_html = $content_html. 
		"</div>";
		
			$content_html = $content_html."</div>";
		$content_html = $content_html."</div>";
		return $content_html;
	}
	function writeBooksMostPopular($mlayout, $bookscommon, $menu, $genre, $action_handler) {
		$local_search = $_GET['local_search'];
		$cur_offset = $_GET['offset'];
		$cur_offset = ($cur_offset=="")?0:$cur_offset;
		$content = $bookscommon->writeBooksMostPopularGroup($cur_offset, 20, $local_search, $genre);
		$numrows = $bookscommon->getBooksMostPopularNumRows($local_search, $genre);	
		$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
		$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
		$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
			
	$title_now = $menu;
	if ( $genre != "" ) {
		$title_now = $menu." Dengan Genre ".$genre;
	}
	$content_html = "
		<div class=\"mcontent\" id=\"mcontent\">
			".printAds(0)."

			<div class=\"boxlong_detail\" >
			<p class=\"left\">".$title_now."</p>";
				
	$nav_var = "
			<div style=\"display:table;border:0px solid black; height:10px!important;margin:0px auto; text-align:center;\">
				<form style=\"float:left; height:10px;\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"genre\" value=\"".$genre."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\"".$prev_var."\">
				</form>
				<p style=\"float:left;
					//border:1px solid black;
					font:normal 15px/20px arial, sans-serif;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form class=\"form_style\" style=\"float:left; height:10px;\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"genre\" value=\"".$genre."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"hidden\" name=\"offset\" value=\"".$next_var."\">
				
					<input type=\"submit\" name=\"next\" value=\">\">
				</form>
			</div>";
			
			$content_html = $content_html . $nav_var;
			
			$content_html = $content_html . "
			<div style=\"display:table; margin:0px auto; border:0px solid black; padding:0px;\">
				<form class=\"form_style\" name=\"local_search\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"genre\" value=\"".$genre."\">
					<input style=\"border:1px solid black;
						height:20px;
					\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0 0 0 -1px;
					\" type=\"submit\" value=\"search\">
				</form>
			</div>";
			$content_html = $content_html . printBOXLONGCommon($content);
			$content_html = $content_html. 
		"</div>";
		
			$content_html = $content_html.$nav_var.
		"</div>";
		return $content_html;
	}
	
	function writeBooksMostRecommended($mlayout, $bookscommon, $menu, $genre, $action_handler) {
		$local_search = $_GET['local_search'];
		$cur_offset = $_GET['offset'];
		$cur_offset = ($cur_offset=="")?0:$cur_offset;
		$content = $bookscommon->writeBooksMostRecommendedGroup($cur_offset, 20, $local_search, $genre);
		$numrows = $bookscommon->getBooksMostRecommendedNumRows($local_search, $genre);	
		$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
		$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
		$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
			
	$title_now = $menu;
	if ( $genre != "" ) {
		$title_now = $menu." Dengan Genre ".$genre;
	}
	$content_html = "
		<div class=\"mcontent\" id=\"mcontent\">
			".printAds(0)."
			<div class=\"boxlong_detail\" >
			<p class=\"left\">".$title_now."</p>";
				
	$nav_var = "
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form  class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form  class=\"form_style\" style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>";
			
			$content_html = $content_html . $nav_var;
			
			$content_html = $content_html . "
			<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<form  class=\"form_style\" name=\"local_search\" method=\"get\" action=\"".$action_handler."\">
					<input style=\"border:1px solid black;
						height:20px;
					\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0 0 0 -1px;
					\"type=\"submit\" value=\"search\">
				</form>
			</div>";
			$content_html = $content_html . printBOXLONGCommon($content);
			$content_html = $content_html. 
		"</div>";
		
			$content_html = $content_html.$nav_var.
		"</div>";
		return $content_html;
	}
	function writeBooksNewRelease($mlayout, $bookscommon, $menu, $genre, $action_handler) {
		$local_search = $_GET['local_search'];
		$cur_offset = $_GET['offset'];
		$cur_offset = ($cur_offset=="")?0:$cur_offset;
		$max_date = $bookscommon->getBooksMaxDate();
		$content = $bookscommon->writeBooksNewReleaseGroup($max_date,$cur_offset, 20, $local_search, $genre);
		$numrows = $bookscommon->getBooksNewReleaseNumRows($max_date, $local_search, $genre);	
		$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
		$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
		$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
			

	$content_html = "
		<div class=\"mcontent\" id=\"mcontent\">
			".printAds(0)."
			<div class=\"boxlong_detail\" >
			<p class=\"left\">".$menu." ".DateToIndo($max_date)."</p>";
				
	$nav_var = "
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>";
			$content_html = $content_html . "<table class=\"boxlong\" style='width:100%;text-align:center;'><tr>";
				for ( $i = 0; $i < count($content); $i++ ) {
					$content_html = $content_html . "<td style=\"width:20%;vertical-align:top;\">";
					$content_html = $content_html . $content[$i];
					$content_html = $content_html . "</td>";
					if ( $i > 0 && (($i+1) % 5 == 0 ) ) {//&& $i != 20-1) 
						$content_html = $content_html . "</tr></table>";
						$content_html = $content_html. "<div class=\"hline\"> </div>";
						$content_html = $content_html . "<table class=\"boxlong\" style='width:100%;text-align:center;'><tr>";
					}
				}
				$content_html = $content_html . "</tr></table>";
			
			$content_html = $content_html. 
		"</div>";
		
		$content_html = $content_html./*$nav_var*/
		
		"</div>";
		return $content_html;
	}


	/********Rent Information **************/
	function writeBooksRentInfo($mlayout, $bookscommon, $menu, $genre, $action_handler, $today="") {
		$local_search = $_GET['local_search'];
		$cur_offset = $_GET['offset'];
		$cur_offset = ($cur_offset=="")?0:$cur_offset;
		$content = $bookscommon->writeRentInfoGroup($cur_offset, 20, $local_search, $genre, $today);
		$numrows = $bookscommon->getRentInfoNumRows($local_search, $genre, $today);	
		$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
		$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
		$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
			

	$content_html = "
		<div class=\"mcontent\" id=\"mcontent\">
			".printAds(0)."
			<div class=\"boxlong_detail\" >
			<p class=\"left\">Informasi Peminjaman".$today."</p>";
				
	$nav_var = "
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form  class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form  class=\"form_style\" style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>";
			
			$content_html = $content_html . $nav_var;
			
			$content_html = $content_html . "
			<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<form  class=\"form_style\" name=\"local_search\" method=\"get\" action=\"".$action_handler."\">
					<input style=\"border:1px solid black;
						height:24px;
					\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0px 0 0 -1px;
					\" type=\"submit\" value=\"search\">
				</form>
			</div>";
			$content_html = $content_html . printBOXLONGCommon($content);
			$content_html = $content_html. 
		"</div>";
		
			$content_html = $content_html.$nav_var.
		"</div>";
		return $content_html;
	}
}
?>

<?
class WikiLayout {
	function writeFBBox($fb_name, $real_name="noname") {
		$content = "
			<div style=\"
				float:left;
				margin:0px 5px 5px 0px;
				//margin:0 auto;
				display:table;;
				border:1px solid #d9e8e1;
				background-color:#f5fef9;
				width:30%;	
				padding:5px;
				//0 0 5px 0;
				text-align:center;
				\"
			>";
				$img_dir = "../images/nophoto_person.png";
				$img_dir = "http://graph.facebook.com/".$fb_name."/picture";
				$content = $content . "
					<img alt='".$fb_name."' id=\"img_".str_replace('.','_',$fb_name)."\" src=\"".$img_dir."\" width=\"50\" height=\"50\" style=\"float:left;margin:5px;\" >";
				$content = $content ."
				<div style=\"margin:5px;text-align:center;display:table;border:0px solid black;\">";
				$content = $content."
					<div style=\"border:0px solid black;\" >
						<a href='#'><p id=\"".str_replace('.','_',$fb_name)."\" class=\"title\" style=\"font:bold 13px/13px arial, sans-serif;\">".""
						."</p></a>
					</div>";
				
				$content = $content."
				</div>
			</div>";
			return $content;
		}
	function writeCategoriesBox($title, $page_wikiinfo, $category, $custom_list) {
		$content = "
			<div style=\"
				float:left;
				margin:0px 5px 5px 0px;
				display:table;;
				width:48%;
				border:1px solid #d9e8e1;
				background-color:#f5fef9;
				
				padding:5px;
				//0 0 5px 0;
				text-align:center;
				\"
			>
				<p style=\"
					background-color:#cef2e0;
					font-size:120%;
					border:1px solid #a3bfb1;
					margin:0px;
					text-align:left;
					font:bold 16px/13px arial, sans-serif;
					padding: 5px;
					\">".$title."</p>
				<p style=\"
					background-color:#d4d4d4;
					border:1px solid #3377ad;
					padding:5px;
					margin:5px 0 5px 0;
					color:blue;
					text-align:center;
					font:normal 12px/12px arial, sans-serif;
				\">
			  		<a class=\"style2\" href='".$page_wikiinfo."?category=".$category."&amp;start=0-9'> 0-9 </a>"; 
					for ( $i='A'; $i <= 'Z'; $i++ ) {
						$content = $content. "<a class=\"style2\" href='".$page_wikiinfo."?category=".$category."&amp;start=".$i."'> ".$i." </a>";
						if ( $i == 'Z' )
							break;
					}
				$content = $content ."
				</p>
				<div style=\"text-align:center;display:table;border:0px solid black;width:100%\">";
					
					$count = 0;
					foreach( $custom_list as $i => $value )	{
						$content = $content . "<span style=\"border:0px solid black;\">
						<a href='".$page_wikiinfo."?category=".$category."&amp;".$value."' style=\"
						border:0px solid black;margin:0px 5px 0 0; 
						font:bold 13px/13px arial, sans-serif; 
					\">";
						$content = $content.$i."</a></span>";
						$count++;
						if ( $count != count($custom_list) )
							$content = $content ."<span style=\"font-weight:bold\">&middot;</span>";
					}
				
				$content = $content."</div>
			</div>";
			return $content;
		}
}
?>


<?
class MemberLayout {
	function getMemberOfTheMonthNumRows($month, $year, $local_search, $genre) {
		$query = "SELECT COUNT(*) as count FROM rent_history where MONTH(rent_date)=".$month." AND YEAR(rent_date)=".$year;

		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( full_name LIKE ('%".$local_search."%')) ";
		}
		$query = $query . " GROUP BY subscriber_id ";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		return mysqli_num_rows($result);//$row['count'];
	}
	function writeMemberOfTheMonthGroup($month, $year, $offset, $numrows, $local_search, &$subscriber_id_list) {
		$query = "SELECT a.subscriber_id, COUNT(*) as jumlah, b.full_name FROM rent_history a, subscriber b WHERE a.subscriber_id=b.subscriber_id AND MONTH(a.rent_date)=".$month." AND YEAR(a.rent_date)=".$year." ";

		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " AND ( b.full_name LIKE ('%".$local_search."%') )";
		}
		$query = $query." GROUP BY a.subscriber_id ORDER BY jumlah DESC, b.full_name";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		
		$i = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			$sinfo = getSubscriberFBInfo($row['subscriber_id']);
			if ( $sinfo != "none" ) {
				$subscriber_id_list[] = $sinfo;
			}
			if ( $sinfo != "none" ) 
				$cover = "images/ajax-loading.gif";
			else
				$cover = "cover_small/nophoto.png";
			$corontent = "<div class=\"box_content\" >
				<img alt='mainpic' class=\"mainpic\" id=\"img_".$sinfo."\" src=\"".$cover."\" width=\"50\" height=\"50\" >";
			$corontent = $corontent."<div><p id=\"".$sinfo."\" class=\"title\" style=\"font:bold 13px/13px arial, sans-serif;\">"
			.$row['subscriber_id']."</p></div>
				<p class=\"author\">ranking #".($i+1)."</p>
			
				<p class=\"author\">".$row['jumlah']." buku di Bulan ".MonthToIndo($month-1)." ".$year."</p>";
			$corontent = $corontent."</div>";
			$content[$i++] = $corontent;
		}
		return $content;
	}
	

	function writeJXMemberOfTheMonth($month, $year, $mlayout, $menu, $action_handler, &$subscriber_id_list) {
		$local_search = "";//$_GET['local_search'];
		$cur_offset = 0;//$_GET['offset'];
		$cur_offset = ($cur_offset=="")?0:$cur_offset;
		$content = $this->writeMemberOfTheMonthGroup($month, $year, $cur_offset, 20, $local_search, $subscriber_id_list);
		$numrows = $this->getMemberOfTheMonthNumRows($month, $year, $local_search, $genre);	
		$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
		$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
		$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
	$nav_var = "
		<!--
		<div style=\"display:table;width:100%;\">
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form  class=\"form_style\" style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>
		</div>
		-->";
			$content_html = "";	
			$content_html = $content_html."<p class=\"left\">".$menu."</p>";
			$content_html = $content_html . $nav_var;
			
			$content_html = $content_html . "
		<!--	
			<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<form  class=\"form_style\" name=\"local_search\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input style=\"border:1px solid black;
						height:24px;
					\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0 0 0 -1px;
					\"type=\"submit\" value=\"search\">
				</form>
			</div>
		-->";
			//$content_html="";
			$content_html = $content_html."<div id=\"booksofthemonth\">";	
				for ( $i = 0; $i < count($content); $i++ ) {
					$content_html = $content_html . $content[$i];
					//if ( $i > 0 && (($i+1) % 5 == 0 ) && $i != 20-1)
					//	$content_html = $content_html. "<div class=\"hline\"></div>";
				}
			$content_html = $content_html."</div>";
			//$content_html = $content_html. 
		//"</div>";
		
			$content_html = $content_html.$nav_var;
		//"</div>";
		return $content_html;
	}
	function writeMemberOfTheMonth($month, $year, $mlayout, $menu, $action_handler, &$subscriber_id_list) {
		/*	$menu = "Genre Romance";
			$genre = "Romance";
			$action_handler = "genreromance.php";
		*/	//$rpop->getPopularRandom();
		$local_search = $_GET['local_search'];
		$cur_offset = $_GET['offset'];
		$cur_offset = ($cur_offset=="")?0:$cur_offset;
		$content = $this->writeMemberOfTheMonthGroup($month, $year, $cur_offset, 20, $local_search, $subscriber_id_list);
		//echo "CHCHCHCH = ".count($subscriber_id_list);
		$numrows = $this->getMemberOfTheMonthNumRows($month, $year, $local_search, $genre);	
		$next_var = ($cur_offset+20>$numrows)?$cur_offset:$cur_offset+20;
		$prev_var = ($cur_offset-20<0)?0:($cur_offset-20);
		$view_var = (($cur_offset+1>$numrows)?$numrows:$cur_offset+1)." - ".(($cur_offset+20>$numrows)?$numrows:$cur_offset+20)." of ".$numrows;
			
	$start_year = 2012;
	$start_month = 4;

	$year_l = $start_year;
	$month_l = $start_month;
	
	$month_filter = "<nav class=\"drop-menu-month_filter\"><a class=\"style1\" href='#'>&middot; ".$start_year." &middot;</a>";
	$temp_str = "<ul style=\"text-align:center;\">";
	while ( $year_l <= date("Y") ) {//&& $month <= date("m") ) {
		//if ( $year == date("Y") && $month > date("m") )
		//	break;
		//$month_filter = $month_filter . 
		$temp_str = $temp_str ." <li><a class=\"style1\" style=\"width:97%;\" href='#' onclick=\"jxReload(".$month_l.",".$year_l.")\">".MonthToIndo($month_l-1)." ".$year_l."</a></li>";
		if ( $year_l == date("Y") && $month_l == date("m") ) {
			//$month_filter = $month_filter."</ul></nav>";
			$temp_str = $temp_str."</ul>";
			$temp_str = "<ul style=\"text-align:center;\"><li>".CreateFloatingBox(0, 0, "top", 0, 20, 150, $temp_str, "")."</li></ul>";
			$month_filter = $month_filter.$temp_str."</nav>";
			break;
		}
		$month_l++;
		if ( $month_l > 12 ) {
			$temp_str = $temp_str . "</ul>";
			$temp_str = "<ul style=\"text-align:center;\"><li>".CreateFloatingBox(0, 0, "top", 0, 20, 150, $temp_str, "")."</li></ul>";
			$month_filter = $month_filter.$temp_str."</nav>";
			$month_filter = $month_filter."<nav class=\"drop-menu-month_filter\"\"><a class=\"style1\" href='#'>&middot; ".($year_l+1)." &middot;</a>";
			$temp_str = "<ul style=\"text-align:center;\">";
	
			$year_l++;
			$month_l = 1;
		}
	}
	$content_html = "
		<div class=\"mcontent\" id=\"mcontent\">
			<div class=\"boxlong_detail\" style=\"position:relative;\">";
			//<p class=\"left\">".$menu."</p>";
	$content_html = $content_html."<div style=\"position:relative;border-bottom:1px solid #e2e2e2; display:table; width:100%; text-align:center;\">".
			$month_filter."
			</div>";
				
	$nav_var = "
	<!--	
		<div style=\"display:table;width:100%\">
			<div style=\"display:table;border:0px solid black; margin:0px auto; text-align:center;\">
				<form class=\"form_style\" style=\"float:left\" name=\"prevnext\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"prev\" value=\"<\">
					<input type=\"hidden\" name=\"offset\" value=\""
							.$prev_var.
						"\">
				</form>
				<p style=\"float:left;
					font-family:'Verdana';
					font-size:14px;
					font-weight:normal;
					margin:5px 10px 0 10px;
				\">"
						.$view_var.
				"</p>
				<form class=\"form_style\" style=\"float:left\" name=\"next\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					<input type=\"hidden\" name=\"local_search\" value=\"".$local_search."\">
					<input type=\"submit\" name=\"next\" value=\">\">
					<input type=\"hidden\" name=\"offset\" value=\""
						.$next_var.
					"\">
				</form>
			</div>
		</div>
	-->";
			
			$content_html = $content_html."<div id=\"memberofthemonth\">";	
			$content_html = $content_html."<p class=\"left\">".$menu."</p>";
			$content_html = $content_html . $nav_var;
			
			$content_html = $content_html . "
		<!--	
			<div style=\"display:table; margin:0px auto; border:0px solid black;\">
				<form class=\"form_style\" name=\"local_search\" method=\"get\" action=\"".$action_handler."\">
					<input type=\"hidden\" name=\"month\" value=\"".$month."\">
					<input type=\"hidden\" name=\"year\" value=\"".$year."\">
					
					<input style=\"border:1px solid black;
						height:24px;
					\" type=\"text\" name=\"local_search\" value=\"".$local_search."\">
					<input style=\"
						border:1px solid black;
						height:24px; margin:0 0 0 -1px;
					\"type=\"submit\" value=\"search\">
				</form>
			</div>
		-->";
				for ( $i = 0; $i < count($content); $i++ ) {
					$content_html = $content_html . $content[$i];
		//			if ( $i > 0 && (($i+1) % 5 == 0 ) && $i != 20-1)
		//				$content_html = $content_html. "<div class=\"hline\"></div>";
				}
			$content_html = $content_html.$nav_var;
			
			$content_html = $content_html. 
		"</div>";
		
			$content_html = $content_html."</div>";//ajax end
		$content_html = $content_html."</div>";
		return $content_html;
	}


//////////////////////////Member Common Feature 
	function getMemberNumRows($local_search, $genre="", $synopsis="") {
		/*if ( $synopsis == "UseSynopsis" ) {
			$query = "SELECT COUNT(*) as count FROM book_title WHERE ";
			$query = $query." synopsis!='' ";
		} else
		*/
		//$query = "SELECT COUNT(*) as count FROM subscriber ";
		$query = "SELECT COUNT(*) as count FROM ".$GLOBALS['COMIC_DB'].".subscriber a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".user_activation b ON a.subscriber_id=b.subscriber_id ";
		
		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " WHERE ( b.fb_name LIKE ('%".$local_search."%') )";
		}
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
	function writeMemberGroup($offset, $numrows, $local_search, &$subscriber_id_list) {
		$query = "SELECT a.subscriber_id as subscriber_1, b.subscriber_id as subscriber_2, b.fb_id, b.member_share, b.book_share FROM ".$GLOBALS['COMIC_DB'].".subscriber a LEFT JOIN ".$GLOBALS['COMIC_DBWEB'].".user_activation b ON a.subscriber_id=b.subscriber_id ";

		if ( $local_search != "" ) {
			$local_search = str_replace(' ', '%', $local_search);
			$query = $query. " WHERE ( b.fb_name LIKE ('%".$local_search."%'))";
		}
		$query = $query." ORDER BY subscriber_2 DESC, '00000'+SUBSTRING(subscriber_1,8,5), b.fb_name LIMIT ".$numrows." OFFSET ".$offset; 
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$i = 0;
		while ( $row = mysqli_fetch_array($result) ) {
			if ( $row['subscriber_1'] == "" )
				continue;
			$cover = "../images/nophoto_person.png";
			if ( $row['subscriber_2'] != NULL && $row['member_share'] != 'Tidak Setuju' ) {
				$cover = "http://graph.facebook.com/".$row['fb_id']."/picture";
				$subscriber_id_list[] = $row['fb_id'];
			}
				$corontent = "<div class=\"box_content\">
				<img alt='mainpic' id=\"img_".$row['fb_id']."\" class=\"mainpic\" src=\"".$cover."\" width=\"50\" height=\"50\" >";
				$c = Array (
				'Code' => $row['subscriber_id'],
				'img_href' => "wiki/wikibook.php?bookcode=".urlencode($row['code']), 
				'img_src' => $cover,
				'img_width' => '50',
				'img_height' => '50',
				'img_class' => 'mainpic'
			);
		  	if ( $row['subscriber_2'] != NULL )	
				$corontent = $corontent."<p id=\"".$row['fb_id']."\" class=\"title\"><a href='http://facebook.com/".$row['fb_id']."'>".$row['subscriber_1']."</a></p>";
			else
				$corontent = $corontent."<p style=\"font:bold 13px/13px arial,sans-serif\" id=\"".$row['fb_id']."\" class=\"title\">".$row['subscriber_1']."</p>";
			

			$corontent = $corontent . "</div>";
			$content[$i++] = $corontent;	

		}
		return $content;
	}
	

}
?>
