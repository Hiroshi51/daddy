<?php

require_once('dbinfo.php');

//retrieve all the data from iba_post
$recordSet = mysqli_query($db, 'SELECT * FROM iba_post ORDER BY order_number DESC');

//fetch the data into goilog by associative array format
$goiLog = mysqli_fetch_assoc($recordSet);

//declare paging variables
$page = 0;
$nextPage = $page + 1;


?>