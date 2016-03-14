<?php
session_start();
require_once('../dbinfo.php');
require_once('login-status.php');

$deleteSql = sprintf("DELETE FROM iba_post WHERE id=%d",
             mysqli_real_escape_string($db,$_REQUEST['id'])
             );
$deletePost = mysqli_query($db,$deleteSql) or die(mysqli_error($db));
$backUrl    = $siteUrl.'/iba_admin/show-list.php';
header("Location: {$backUrl}"); 
exit();
?>

<!doctype html>
<html>
<head>
<meta charset='utf-8' />

</head>
<body>



</body>
</html>
