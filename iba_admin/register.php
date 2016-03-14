<?php
session_start();
require_once('../dbinfo.php');
?>



<!doctype html>
<html>
<head>
<meta charset='utf-8' />
<style>
dt{
  margin: 20px 0 0 0;
}
</style>
</head>
<body>
<?php


$sql = sprintf('INSERT INTO iba_post SET created="%s", title="%s", catchy_img="%s", content="%s", category="%s"',
  mysqli_real_escape_string($db, $_SESSION['iba_admin']['created']),
  mysqli_real_escape_string($db, $_SESSION['iba_admin']['title']),
  mysqli_real_escape_string($db, $_SESSION['iba_admin']['catchy_img']),
  mysqli_real_escape_string($db, $_SESSION['iba_admin']['content']),
  mysqli_real_escape_string($db, $_SESSION['iba_admin']['category'])
  );


$set = mysqli_query($db, $sql) or die(mysqli_error($db));




?>

<p>registered</p>
<a href="<?php echo $siteUrl.'/iba_admin/input-post.php'; ?>">back to edit</a>
  


</body>
</html>
