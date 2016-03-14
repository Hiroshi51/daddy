<?php 
	session_start();
	require_once('../dbinfo.php');
	//delete SETTION data
	$_SETTION = array();
	if(ini_get("session.use_cookies")){
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
		$params["path"],$params["domain"],
		$params["secure"],$params["httponly"]
		);
	}

	session_destroy();
	//delete Cookie data
	setcookie('login_id','', time()-3600);
	setcookie('password','', time()-3600);
	$logoutUrl = $siteUrl.'/iba_admin/index.php';
	header("Location: {$logoutUrl}");
	exit();
?>