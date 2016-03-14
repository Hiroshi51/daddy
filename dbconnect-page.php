<?php

//dbconnect begins here
require_once('dbinfo.php'); 
//dbconnect ends here

//retrieve all the data from iba_post
$recordSet = mysqli_query($db, 'SELECT * FROM iba_post ORDER BY id DESC');

//fetch the data into goilog by associative array format
$goiLog = mysqli_fetch_assoc($recordSet);

//declare paging variables
$page = 0;
$nextPage = $page + 1;

?>