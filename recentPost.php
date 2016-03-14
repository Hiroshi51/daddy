<section>
  <div id="recentPostSection" class="clearfix">
    <p class="titleImg" ><img src="<?php echo $siteUrl; ?>/img/blog/recentPostTitle.png"　alt="新着記事"></p>
    <?php 
      //color variable
      $color = ['red','green','yellow','blue'];
      $colorNumber = 0;
      //assign SQL converted directive 
      $recentQuery=sprintf('SELECT * FROM iba_post ORDER BY order_number DESC LIMIT 1,4');
      //retrieve the data from iba_post
      $recentQueryRecord = mysqli_query($db,$recentQuery);
      //declare paging variables
      while ($recentQueryTable = mysqli_fetch_assoc($recentQueryRecord)): ?>
          <a class="recentPost <?php echo $color[$colorNumber]; ?>" href="<?php echo $siteUrl; ?>/single/?page=<?php echo $recentQueryTable['order_number']; ?>">
          <?php if(empty($recentQueryTable['catchy_img'])):?>
          <div class="recentPostImg"><img src="<?php echo $siteUrl.'/img/common/noImage.jpg'; ?>"></div>
          <?php else: ?>  
          <div class="recentPostImg"><img src="<?php echo $uploadUrl.'/'.$recentQueryTable['catchy_img']; ?>"></div>
          <?php endif; ?>
          <div class="recentPostContent">
            <h3><?php echo htmlspecialchars($recentQueryTable['title'],ENT_QUOTES,'utf-8'); ?></h3>
            <p><?php echo htmlspecialchars(mb_strimwidth($recentQueryTable['content'], 0, 60, "...",'utf-8'));　?></p>
          </div>
          </a>
    <?php $colorNumber++; endwhile; ?>
  </div>
</section>
