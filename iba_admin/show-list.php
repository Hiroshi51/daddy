<?php
session_start();
require_once('../dbinfo.php');
require_once('login-status.php');
$recordSet = mysqli_query($db, 'SELECT * FROM iba_post ORDER BY id DESC');
?>
<!doctype html>
<html>
<head>
<meta charset='utf-8' />
<style>
dt {
  margin: 20px 0 0 0;
}
</style>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>
<h1>投稿一覧</h1>
<table>

<?php while ($table = mysqli_fetch_assoc($recordSet)): ?>
<tr>
<td><?php echo (htmlspecialchars($table['id'])); ?></td>
<td><?php echo (htmlspecialchars($table['created'])); ?></td>
<td><?php echo (htmlspecialchars($table['title'])); ?></td>
<td><?php echo (htmlspecialchars($table['content'])); ?></td>
<td><?php echo (htmlspecialchars($table['category'])); ?></td>
<td><a href="<?php echo $siteUrl.'/iba_admin/update-post.php/?id='.$table['id']; ?>">Edit</a></td>
<td><a href="<?php echo $siteUrl.'/iba_admin/delete-post.php/?id='.$table['id']; ?>">Delete</a></td>
</tr>

<?php endwhile; ?> 
<a href="<?php echo $siteUrl.'/iba_admin/input-post.php'; ?>">back to edit</a>
</table>
</body>
</html>
