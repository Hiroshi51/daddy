<?php
session_start();
require_once('../dbinfo.php');
require_once('login-status.php');
?>


<!doctype html>
<html>
<head>
<meta charset='utf-8' />

</head>
<body>
<?php
$updateSql = sprintf('UPDATE iba_post SET created="%s", title="%s", catchy_img="%s", content="%s", category="%s" WHERE id=%d',
  mysqli_real_escape_string($db, $_SESSION['update']['created']),
  mysqli_real_escape_string($db, $_SESSION['update']['title']),
  mysqli_real_escape_string($db, $_SESSION['update']['catchy_img']),
  mysqli_real_escape_string($db, $_SESSION['update']['content']),
  mysqli_real_escape_string($db, $_SESSION['update']['category']),
  mysqli_real_escape_string($db, $_SESSION['update']['id'])
  );
mysqli_query($db,$updateSql) or die(mysqli_error($db));
?>
<p><?php echo $updateSql;?></p>
<p>Successfully Updated</p>
afsdffsaas
<a href="<?php echo $siteUrl.'/iba_admin/input-post.php'; ?>">back to edit</a>
<a href="<?php echo $siteUrl.'/iba_admin/show-list.php'; ?>">back to list</a>
  


</body>
</html>
