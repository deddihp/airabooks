<?
include 'lib/mysql_comic.php';
include 'lib/mail.php';
include 'lib/sync.php';
							$synch = new SynchAccount();
					
							$result = $synch->synchronize($fb_id);
							if ( $result == "bool(true)" ) {
								$str = 'Location: login.php?fb_id='.$fb_id;
								//echo $str;
								header($str);
								echo "Proses sinkronisasi telah berhasil";
								echo "<br><a href=\"".$fb->loginUrl."\">";
								echo "<img src=\"images/fb_login.png\">";
								echo "</a>";
							} else
								echo $result;
						?>
