<div id="blogHeader">
<p class="date"><?php echo htmlspecialchars($createdOn); ?></p>
<p class="category"><?php echo htmlspecialchars($goiLog['category']); ?></p>
</div>
<div id="blogContent">
<h2><?php echo $goiLog['title']; ?></h2>
<?php if($goiLog['catchy_img'] != ""): ?>
<p class="catchyImg"><img src="<?php echo $uploadUrl.'/'.$goiLog['catchy_img']; ?>"></p>
<?php endif;?>
<p><?php echo nl2br($goiLog['content']); ?></p>
</div>