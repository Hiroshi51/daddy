<?php
require_once('../dbinfo.php');
session_start();
if(!empty($_POST)){
  //login flow
  if($_POST['login_id'] != '' && $_POST['password'] != ''){
    $sql = sprintf('SELECT * FROM iba_admin WHERE login_id="%s" AND password="%s"',
            mysqli_real_escape_string($db,$_POST['login_id']),
            mysqli_real_escape_string($db,sha1($_POST['password']))

      );      
    $record = mysqli_query($db,$sql) or die(mysqli_error($db));
    if($table = mysqli_fetch_assoc($record)){
      //success to log in
      $_SESSION['id'] = $table['id'];
      $_SESSION['time'] = time();
      $successUrl = $siteUrl.'/iba_admin/input-post.php';
      header("Location: {$successUrl}");
      exit(); 
    }
    else{
      $error['longin'] = 'failed';
    }
  }
  else{
      $error['blank'] = 'blank';
    }
}
?>

<!doctype html>
<html>
<head>
<meta charset='utf-8' />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $siteUrl; ?>/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo $siteUrl; ?>/admin.css">
</head>
<body>
<div id="login">
<h1>ログイン画面</h1>

<form id="" name="postInput" method="post" action="">
  <dl>
    </dd>
    <dt>
      <label for="id">ID</label>
    </dt>
    <dd><input type="text" name="login_id" size="40"></dd>
     <dt>
      <label for="id">PASSWORD</label>
    </dt>
    <dd><input type="password" name="password" size="40"></dd>
   
    <?php if($error['blank'] == 'blank'): ?>
      <p>error!!</p>
      <?php endif; ?>  

        <?php if($error['longin'] == 'failed'): ?>
      <p>not loged in!!</p>
      <?php endif; ?>  
     </dl>
      <input type="submit" value="go"> 
      </div>
</form>

</body>
</html>
