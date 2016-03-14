<section>
<div id="monthlyArchiveSection">
<p class="titleImg" ><img src="<?php echo $siteUrl; ?>/img/blog/monthlyArchiveTitle.png"　alt="月間アーカイブ"></p>
<div class="monthlyList clearfix">
<?php $monthlySqlMsg = sprintf ('SELECT count(*) as NumberOfPosts,created FROM iba_post GROUP BY created');
$monthlyRecord = mysqli_query($db,$monthlySqlMsg);
$monthlyGethered = array();
$postCount = 0;
while($monthlyRecordSet = mysqli_fetch_assoc($monthlyRecord)){
$cutDate = substr($monthlyRecordSet['created'],0,7);
$NumberOfPosts = $monthlyRecordSet['NumberOfPosts'];
if(array_key_exists($cutDate,$monthlyGethered)){
$monthlyGethered[$cutDate] += $NumberOfPosts;}else{$monthlyGethered = $monthlyGethered + array($cutDate => $NumberOfPosts);}};
foreach ($monthlyGethered as $month => $posts) : ?>
<a href="<?php echo $siteUrl.'/date/?date='.$month;?>"><?php echo $month.'('.$posts.')' ;?></a>
<?php endforeach; ?>
</div>
</div>
</section>
