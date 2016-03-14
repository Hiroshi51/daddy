<?php
session_start();
require_once('../dbinfo.php');
?>
<!doctype html>
<html>
<head>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
  <?php 
  $targetImgs= $_POST['deleteImg'];
   echo $targetImgs[0];
  foreach ($targetImgs as $targetImg) {
    if(unlink($targetImg) == false){
        echo "<p>...Some error occured in somefiles OR Nothing to Delete</p>";
        break;
    }
    else{
        echo "<p>....delete one file</p>";
    }
}
?>
<a href="<?php echo $siteUrl.'/iba_admin/input-post.php'; ?>">back to edit</a>
<a href="<?php echo $siteUrl.'/iba_admin/show-list.php'; ?>">back to list</a>
</body>
</html>