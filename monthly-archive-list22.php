<section>
  <div id="monthlyArchiveSection">
    <p class="titleImg" ><img src="<?php echo $siteUrl; ?>/img/blog/monthlyArchiveTitle.png"　alt="新着記事"></p>　
   <div class="monthlyList">
<?php 
  //set monthly count and start while loop
  $monthlySqlMsg = sprintf ('SELECT count(*) as NumberOfPosts,created_at FROM iba_post GROUP BY created_at');
  $monthlyRecord = mysqli_query($db,$monthlySqlMsg);
  while($monthlyRecordSet = mysqli_fetch_assoc($monthlyRecord)):
    $cutDate = substr($monthlyRecordSet['created_at'],0,7); 
    ?>
   <a href="<?php echo $siteUrl.'/date/?date='.$cutDate;?>"><?php echo $cutDate.'('.$monthlyRecordSet["NumberOfPosts"]')';?></a>
  <?php endwhile; ?>
</div>
  </div>
</section>
