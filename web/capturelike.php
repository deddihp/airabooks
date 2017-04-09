<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">

<head>
</head>
<body>


<div id="fb-root"></div>

<script type="text/javascript" src="jquery.min.js"></script> 
<script type="text/javascript">
window.fbAsyncInit = function() {
 	FB.init({
		appId: '159457617553432',
		//appId: '116943728442196', 
		status: true, 
		cookie: true, 
		xfbml: true
	});
 	
	FB.Event.subscribe('edge.create', function(href, widget) {
 		// Do something, e.g. track the click on the "Like" button here
 		alert('You just liked '+href);
 		console.log("like nthis");
		window.location.href="google.com";
	});
};

(function() {
 	var e = document.createElement('script');
 	e.type = 'text/javascript';
 	e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
 	e.async = true;
 	document.getElementById('fb-root').appendChild(e);
 }());

	$(document).ready(function() {
		console.log("ready");
	});
</script>



<div class="fb-like" data-send="false" data-width="450" data-show-faces="false" /> </div>

<div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-action="recommend"></div>
div iframe
<iframe id="fb-like" onclick="fbLikeClick()" class="fb-like" src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fairabooks.com/bookdetail.php?code=OPC&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=35&amp;appId=159457617553432" scrolling="no" frameborder="1" style="border:none; overflow:hidden; width:95px; height:35px;" allowTransparency="true"></iframe>

</body>
</html>
