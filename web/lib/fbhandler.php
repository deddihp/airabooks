<?
	require 'facebook.php';
function init_facebook(&$user, &$logoutUrl, &$loginUrl) {	
	$facebook = new Facebook(array(
	//  'appId'  => '344617158898614',
 	// 'secret' => '6dc8ac871858b34798bc2488200e503d',
	//TESTING
			'appId' => '116943728442196',
			'secret' => '08f7df4d40b301796544e26919369226',
	));

	$user = $facebook->getUser();
	if ($user) {
  		try {
    		// Proceed knowing you have a logged in user who's authenticated.
    		$user_profile = $facebook->api('/me');
  			print_r($user_profile);	
		} catch (FacebookApiException $e) {
    		error_log($e);
    		$user = null;
  		}
	}

	if ($user) {
  		$logoutUrl = $facebook->getLogoutUrl();
	} else {
  		$loginUrl = $facebook->getLoginUrl();
	}
}
?>
