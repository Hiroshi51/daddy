<?php
session_start();
require_once('../dbinfo.php');
require_once('login-status.php');

if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
  $uploadImgfileName = date('YmdHis') . $_FILES['file']['name'];	
  if (move_uploaded_file($_FILES["file"]["tmp_name"], './uploadfile/uploads/'.$uploadImgfileName)) {
   
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}
 
?>
