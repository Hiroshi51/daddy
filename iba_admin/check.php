<?php
require_once('../dbinfo.php');
session_start();


if (!isset($_SESSION['iba_admin'])) {
  header('Location: index.php');
  exit();
}

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
  <form action="register.php" method="post"  >
  <dl>
   <dt>
     日付
   </dt>
   <dd>
   <?php echo htmlspecialchars($_SESSION['iba_admin']['created'],ENT_QUOTES, 'utf-8'); ?>
   </dd>

    <dt>
     タイトル
   </dt>
   <dd>
   <?php echo htmlspecialchars($_SESSION['iba_admin']['title'],ENT_QUOTES, 'utf-8'); ?>
   </dd>


    <dt>
     Goiキャッチ画像
   </dt>
   <dd>
   <img src="<?php echo $uploadUrl.'/'.htmlspecialchars($_SESSION['iba_admin']['catchy_img'],ENT_QUOTES,'utf-8'); ?>">
   </dd>

  <dt>
本文
   </dt>
   <dd>
   <?php echo nl2br (htmlspecialchars($_SESSION['iba_admin']['content'],ENT_QUOTES, 'utf-8')); ?>
   </dd>

  <dt>
     カテゴリー
   </dt>
   <dd>
   <?php echo htmlspecialchars($_SESSION['iba_admin']['category'],ENT_QUOTES, 'utf-8'); ?>
   </dd>

  </dl>
<div><input type="submit" value="post">投稿する</div>
</form>

</body>
</html>
