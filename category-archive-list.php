<section>
<div id="categorySection">
<p class="titleImg" ><img src="<?php echo $siteUrl; ?>/img/blog/categoryTitle.png"　alt="カテゴリー"></p>
<div class="clearfix">
<?php 
//assign SQL converted directive 
$categoryQuery=sprintf('SELECT COUNT(*) AS cnt,category FROM iba_post GROUP BY category');
//retrieve the data from iba_post
$categoryQueryRecord = mysqli_query($db,$categoryQuery);
while ($categoryTable = mysqli_fetch_assoc($categoryQueryRecord)): ?>
<a href="<?php echo $siteUrl; ?>/category/?name=<?php echo $categoryTable['category']; ?>"><?php echo htmlspecialchars($categoryTable["category"]); ?><?php echo '(' . htmlspecialchars($categoryTable["cnt"]) . ')'; ?></a>
<?php endwhile; ?>
</div>
</div>
</section>     