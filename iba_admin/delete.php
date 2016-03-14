<?php
require_once('../dbinfo.php');
session_start();
$deleteSql = sprintf("DELETE FROM iba_post WHERE id=%d",
             mysqli_real_escape_string($db,$_REQUEST['id'])
             );
$deletePost = mysqli_query($db,$deleteSql) or die(mysqli_error($db));
?>

<!doctype html>
<html>
<head>
<meta charset='utf-8' />

</head>
<body>


<p>Successfully deleted</p>
<a href="<?php echo $siteUrl.'/iba_admin/input-post.php'; ?>">back to edit</a>
<a href="<?php echo $siteUrl.'/iba_admin/show-list.php'; ?>">back to list</a>
  


</body>
</html>
