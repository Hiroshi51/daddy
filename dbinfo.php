<?php
//must be in the root directory
$db = mysqli_connect('localhost','root','root','iba_daddy') or die(mysqli_connect_error());

//fix charset to urf8
mysqli_set_charset($db,'utf8');

//retrieve site infomation
$siteInfo = mysqli_query($db, 'SELECT * FROM iba_admin') or die(mysqli_error($db));
$siteInfoTable = mysqli_fetch_assoc($siteInfo);

//set url
$siteUrl = $siteInfoTable['site_url']; 
$uploadUrl = $siteUrl.'/iba_admin/uploadfile/uploads';

?>