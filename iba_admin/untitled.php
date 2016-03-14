<?php
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //user is loged in
    $_SESSION['time'] = time();
    $sql = sprintf('SELECT * FROM iba_admin WHERE id=%d',
    mysqli_real_escape_string($db,$_SESSION['id'])
    );
    $record = mysqli_query($db,$sql) or die(mysqli_error($db));
    $member = mysqli_fetch_assoc($record);
}else{
    //use isnot loged in
    $failedUrl = $siteUrl.'/iba_admin/index.php';
    header("Location: {$failedUrl}");
    exit();
}
?>