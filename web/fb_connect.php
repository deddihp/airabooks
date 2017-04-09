<?
include 'sync.php';
require 'fb/src/facebook.php';
class fbConnect {
	var $fb_user;
	var $loginUrl;
	var $logoutUrl;
	var $facebook;
	var $user_profile;
	var $fb_token;
	var $synchstatus;
	var $subscriber_id;
	var $userstatus;
	var $error_msg;	
	
	function __construct() {
		session_start();
		//session_destroy();
		//exit;
		$this->user_profile = "";
		$this->fb_user = false;
		if ( isset($_SESSION['user_profile']) ) {
			//print_r($_SESSION);
			$this->user_profile = $_SESSION['user_profile'];
			$synch = new SynchAccount();
			$synch->captureLogin($this->user_profile['id'], 
			$this->user_profile['name']);
				
			$this->synchstatus = $synch->getSynchStatus($this->user_profile['id']);
			$this->subsctiber_id = $synch->getSubscriberID($this->user_profile['id']);
			//Get All Of The Value
			$this->subscriber_id = $synch->getSubscriberID($this->user_profile['id']);
			$this->userstatus = $synch->getUserStatus($this->user_profile['id']);
			$this->logoutUrl = $_SESSION['logoutUrl'];
			$this->loginUrl = $_SESSION['loginUrl'];
			$this->fb_token = $_SESSION['fb_token'];
			$this->fb_user = $_SESSION['fb_user'];//true;		
			return;
		}

		//echo "<br>***********************NOT VALID******************<br>" ;
		//print_r($_SESSION);
		//echo "<br>***************************************************<br>";
		$this->error_msg = "";
		$this->facebook = new Facebook(array(
			
	/*		//TESTING
			'appId' => '116943728442196',
			'secret' => '08f7df4d40b301796544e26919369226',
	*/		
			//airabooks.com
			'appId' => '159457617553432',
  			'secret' => 'c3819dfdfe4733129294a18064ddad9c',
			
		));
		$this->fb_user = $this->facebook->getUser();
				
		//Check token
		if ( $this->fb_user ) {
			try {
				//echo "BERHASIL <br> ";
				
				//echo "<pre>".print_r($_SESSION)."</pre>";
				if ( isset($_SESSION['user_profile']) ) {
					//echo "<br>AFTER FBFBFBFBFBFB<br>";
					//print_r($_SESSION);
					//echo "<br>***************************<br>";
					return;
				}
				$this->user_profile = $this->facebook->api('/me');
				$_SESSION['user_profile'] = $this->user_profile;
				//echo "<br>******************<br><pre>".$_SESSION['user_profile']."<br>";
			} catch (FacebookApiException $e) {
				//echo "<pre>";print_r($e);echo "<\pre>";
				error_log($e);
				$this->fb_user = null;
				$this->error_msg = $e->getMessage();
				//echo "CATCH API<br>";
				//session_destroy();
			}
		} else {
			//echo " Tak Bisa Token FB User is not valid";
		//	exit;
		}

		if ( $this->fb_user ) {
			$synch = new SynchAccount();
			$synch->captureLogin($this->user_profile['id'], 
			$this->user_profile['name']);
				
			$this->synchstatus = $synch->getSynchStatus($this->user_profile['id']);
			$this->subsctiber_id = $synch->getSubscriberID($this->user_profile['id']);
			//Get All Of The Value
			$this->subscriber_id = $synch->getSubscriberID($this->user_profile['id']);
			$this->userstatus = $synch->getUserStatus($this->user_profile['id']);
			$this->logoutUrl = $this->facebook->getLogoutUrl();
			$this->fb_token = $this->facebook->getAccessToken();
			$_SESSION['logoutUrl'] = $this->logoutUrl;
			$_SESSION['loginUrl'] = $this->loginUrl;
			$_SESSION['fb_token'] = $this->fb_token;
			$_SESSION['fb_user'] = $this->fb_user;
			//$_SESSION['logoutUrl'] = $this->logoutUrl;
		} else {
			//echo "<br>Cek Login";
			$this->loginUrl = $this->facebook->getLoginUrl();
		}
	
	}
	function BACKCONSTRUCT() {
		/*if ( isset($_SESSION['user_profile']) ) {
			print_r($_SESSION);
			return;
		}*/
//		print_r($_SESSION);
//		echo "<br>***********************<br> REQUEST : ";
//		print_r($_REQUEST);
//		echo "<br>";
		$this->error_msg = "";
		$this->facebook = new Facebook(array(
			'appId' => '159457617553432',
  			'secret' => 'c3819dfdfe4733129294a18064ddad9c',
		));
		$this->fb_user = $this->facebook->getUser();
				
		//Check token
		if ( $this->fb_user ) {
			try {
				//echo "BERHASIL <br> ";
				//echo "<pre>".print_r($_SESSION)."</pre>";
				$this->user_profile = $this->facebook->api('/me');
				//$_SESSION['user_profile'] = $this->user_profile;
				//echo "<br>******************<br><pre>".$_SESSION['user_profile']."<br>";
			} catch (FacebookApiException $e) {
				//echo "<pre>";print_r($e);echo "<\pre>";
				error_log($e);
				$this->fb_user = null;
				$this->error_msg = $e->getMessage();
				//echo "CATCH API<br>";
				//session_destroy();
			}
		} else {
			//echo " Tak Bisa Token FB User is not valid";
		//	exit;
		}

		if ( $this->fb_user ) {
			$synch = new SynchAccount();
			$synch->captureLogin($this->user_profile['id'], 
			$this->user_profile['name']);
			//echo "<br>Try 2<br>";	
				
			$this->synchstatus = $synch->getSynchStatus($this->user_profile['id']);
			//echo "<br>Try 3<br>";	
			$this->subsctiber_id = $synch->getSubscriberID($this->user_profile['id']);
			//Get All Of The Value
			//echo "<br>Try 4<br>";	
			$this->subscriber_id = $synch->getSubscriberID($this->user_profile['id']);
			$this->userstatus = $synch->getUserStatus($this->user_profile['id']);
			$this->logoutUrl = $this->facebook->getLogoutUrl();
			$this->fb_token = $this->facebook->getAccessToken();
				
			//$_SESSION['logoutUrl'] = $this->logoutUrl;
		} else {
			//echo "<br>Cek Login";
			$this->loginUrl = $this->facebook->getLoginUrl();
		}
	}

	function errorHandler($fb) {
		echo "
			<script type=\"text/javascript\">
		";
			if ( $fb->error_msg == "SSL connection timeout" ) {
				echo "alert('".$fb->error_msg.", Will be refreshed');\n";
				echo "location.reload();";
			}
		echo "</script>";
	}
	function FBLogin() {
		//FBLogin();
	}
	
	function unusedLogin() {
	/*session_start();
		*///echo "SESISON NOW = ".$_SESSION['fbprofile']. "<br>";

		//print_r($_SESSION['fbprofile']);	
		if ( isset($_SESSION['fbprofile'])) {
			$this->fb_user = $_SESSION['fbuser'];	
			$this->loginUrl = $_SESSION['loginUrl'];
			$this->logoutUrl = $_SESSION['logoutUrl'];
			$this->user_profile = $_SESSION['fbprofile'];	
			$this->fb_token = $_SESSION['fb_token'];
			
			$synch = new SynchAccount();
			$this->synchstatus = $synch->getSynchStatus($this->user_profile['id']);
		//	$_SESSION['synchstatus'] = $this->synchstatus;
		//	$_SESSION['subscriber_id'] = $synch->getSubscriberID($this->user_profile['id']);
			$this->subscriber_id = $_SESSION['subscriber_id'];
			$this->userstatus = $synch->getUserStatus($this->user_profile['id']);
		//	$_SESSION['userstatus'] = $this->userstatus;
			echo "CHECK synchstatus=".$this->synchstatus." , subscriber_id=".$this->subscriber_id;
//			return;
		} else {
//			session_destroy();
			echo "SESSION STIL EMPTY<br>";
		}
		
		$this->facebook = new Facebook(array(
			'appId' => '159457617553432',
  			'secret' => 'c3819dfdfe4733129294a18064ddad9c',
		));
		$this->fb_user = $this->facebook->getUser();
				
		//Check token
		if ( $this->fb_user ) {
			try {
				echo "BERHASIL";
				$this->user_profile = $this->facebook->api('/me');
		//		$_SESSION['fbprofile'] = $this->user_profile;
				//print_r($this->user_profile);
		//		$_SESSION['fbuser'] = $this->fb_user;
		//		$_SESSION['fb_token'] = $this->facebook->getAccessToken();
				$synch = new SynchAccount();
				$this->synchstatus = $synch->getSynchStatus($this->user_profile['id']);
		//		$_SESSION['synchstatus'] = $this->synchstatus;
		//		$_SESSION['subscriber_id'] = $synch->getSubscriberID($this->user_profile['id']);
				$this->subscriber_id = $_SESSION['subscriber_id'];
			
				$this->userstatus = $synch->getUserStatus($this->user_profile['id']);
		//		$_SESSION['userstatus'] = $this->userstatus;
			
				$synch->captureLogin($this->user_profile['id'], 
					$this->user_profile['name']);
			} catch (FacebookApiException $e) {
				error_log($e);
				$this->fb_user = null;
				echo "CATCH API<br>";
				//session_destroy();
			}
		} else {
			echo " Tak Bisa Token FB User is not valid";
		//	exit;
		}
		if ( $this->fb_user ) {
			echo "Cek Logout";	
			//$token = $this->facebook->getAccessToken();
			//$url = 'https://www.facebook.com/logout.php?next=' . YOUR_SITE_URL .'&access_token='.$token;
			//session_destroy();
			//header('Location: '.$url);
			$this->logoutUrl = $this->facebook->getLogoutUrl();
			//$_SESSION['logoutUrl'] = $this->logoutUrl;
		} else {
			echo "Cek Login";
			$this->loginUrl = $this->facebook->getLoginUrl();
			//$_SESSION['loginUrl'] = $this->loginUrl;
		}
	}
	function writeFBJSHeader() {
		/*$query = "
		<script type=\"text/javascript\">
			function InsertComicRating(url)
{
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
    	}
  	}
	console.log('insert comic rating');
	xmlhttp.open(\"GET\",\"update_setting.php?url=\"+url,true);
	xmlhttp.send();
}
		</script>
		 <script src=\"//connect.facebook.net/en_US/all.js\"></script>
		<script>
		FB.Event.subscribe('edge.create', function(href, widget) {
     		alert('like bl abl ablabla '+href);
   			console.log('lie lisdlfiasdlifsalidf' + href);
		});
   		FB.Event.subscribe('edge.remove', function(href, widget) {
     		alert('dislike '+href);
			console.log('unlike blabla ' + href);
   		});
 		</script>	

		<div id=\"fb-root\"></div>
					<script>(
					function(d, s, id) {
  						var js, fjs = d.getElementsByTagName(s)[0];
  						if (d.getElementById(id)) return;
  						js = d.createElement(s); js.id = id;
  						js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1&appId=159457617553432\";
  						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>";
		
		*/
		$query = "
		<script type=\"text/javascript\">
			function InsertComicRating(url)
				{
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
    					}
  					}
					//console.log('insert comic rating url='+url);
					xmlhttp.open(\"GET\",url,true);
					res = xmlhttp.send();
					//console.log(res);
				}
		</script>
		 
		
		<div id=\"fb-root\"></div>
		<script type=\"text/javascript\">
			function FacebookInviteFriends()
			{
				FB.ui({
					method: 'apprequests',
					message: 'Undang teman anda untuk mengunjungi airabooks.'
				});
			}
			window.fbAsyncInit = function() {
 				FB.init({
					appId: '159457617553432',
					//'116943728442196', 
					status: true, 
					cookie: true, 
					xfbml: true
				});
 
 			
			FB.Event.subscribe('edge.create', function(href, widget) {
 				// Do something, e.g. track the click on the \"Like\" button here
 				//		alert('You just liked '+href);
 				//		console.log('You just liked '+href);
				//window.location.href = 
				url = 'update_rating.php?url='+href;
				InsertComicRating(url);
			});

			FB.Event.subscribe('edge.remove', function(href, widget) {
   				//alert('dislike '+href);
				//console.log('unlike blabla ' + href);
   				//window.location.href = 
				url = 'update_rating.php?url='+href;
				InsertComicRating(url);
			});
		};



	(function() {
 		var e = document.createElement('script');
 		e.type = 'text/javascript';
 		e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
 		e.async = true;
 		document.getElementById('fb-root').appendChild(e);
 	}());

	(function(d, s, id) {
  		var js, fjs = d.getElementsByTagName(s)[0];
  		if (d.getElementById(id)) return;
  		js = d.createElement(s); js.id = id;
  		//js.src = \"//connect.facebook.net/en_US/all.js\";
  
  		js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1&appId=159457617553432\";
  		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

</script>";
		return $query;
	}

	function writeCommentCommon($url) {
		return "<div class=\"fb-comments\" data-href=\"".$url."\" data-width=\"1000px\" data-num-posts=\"1\" data-colorscheme=\"dark\"></div>";
	}
	function writeCommentComingSoon() {
		
		$title = $_GET['title'];
		if ( $title == "" )
			return "";
		return "<div class=\"fb-comments\" data-href=\"http://airabooks.com/comingsoon.php?title=".$title."\" data-width=\"1000px\" data-num-posts=\"1\" data-colorscheme=\"dark\"></div>";
	}
	
	function writeCommentNewRelease($refdate) {
		if ( $refdate != "" )
			$date = $refdate;
		else
			$date = $_GET['refdate'];
		
		if ( $date == "" )
			return "";
		return "<div class=\"fb-comments\" data-href=\"http://airabooks.com/newrelease.php?refdate=".$date."\" data-width=\"1000px\" data-num-posts=\"1\" data-colorscheme=\"dark\"></div>";
	}
	function writeCommentFB($code) {
		return "<div class=\"fb-comments\" data-href=\"http://airabooks.com/bookdetail.php?code=".$code."\" data-width=\"700px\" data-num-posts=\"5\" data-colorscheme=\"dark\"></div>";
	}

	function writeLikeButtonComplete($code, $type) {
		if ( $type == "" )
			$type = "recommend";
		else
			$type = "like";
		$query = "<div class=\"fb-like\" data-href=\"http://airabooks.com/bookdetail.php?code=".$code."\" data-send=\"true\" data-layout=\"button_count\" data-width=\"450\" data-show-faces=\"true\" data-action=\"".$type."\"></div>";

		return $query;
	}
	function writeLikeButtonCommon($url, $type) {
		if ( $type == "" )
			$type = "recommend";
		else
			$type = "like";
		$query = "<div class=\"fb-like\" data-href=\"".$url."\" data-send=\"false\" data-layout=\"button_count\" data-width=\"450\" data-show-faces=\"false\" data-action=\"".$type."\"></div>";
			return $query;
	}

	function writeLikeButton($code, $type) {
		if ( $type == "" )
			$type = "recommend";
		else
			$type = "like";
		$query = "<div class=\"fb-like\" data-href=\"http://airabooks.com/bookdetail.php?code=".$code."\" data-send=\"false\" data-layout=\"button_count\" data-width=\"450\" data-show-faces=\"false\" data-action=\"".$type."\"></div>";
		return $query;
	}

	function writeJSCaptureLike() {
		$query = "
		<script>
		function InsertComicRating2(url)
		{
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
    				console.log('ok');
				}
  			}
			xmlhttp.open(\"GET\",url,true);
			res = xmlhttp.send();
		}
	</script>

	<script type=\"text/javascript\">
		var total;
		var c = 0;
		var ham = 0;
		var sinterval;
		function UpdateRating() {
			
			//console.log(total);
			id = 'code'+c;
			c++;
			if ( c == total ) {
				ham++;
				if ( ham > 1 )
					clearInterval(sinterval);
				c = 0;
				
			}
			//var i;
			//for ( i = 0; i < total; i++ ) {
			//	id = 'code'+i;
				url = \"update_rating.php?url=http://airabooks.com/bookdetail.php?code=\"+document.getElementById(id).innerHTML;
				console.log(url);
				InsertComicRating2(url);
			//}
		}
		$(document).ready(function() {
			total = document.getElementById('codetotal').innerHTML;
			
			
			var i;
			sinterval = setInterval(UpdateRating, 1000);
		
			$('#hint').fadeIn();
		})
		function hideDiv() {
			$('#hint').fadeOut();
		}
	</script>
		";
		return $query;
	}

}
?>
