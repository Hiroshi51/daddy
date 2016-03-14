<footer>
  <section>
    <div id="footerWrapper"> 
      <!--footerContent starts here-->
      <div id="footerContent" class="clearfix">
      <div class="backToTop">トップへ戻る</div>
        <div id="footerPostArea">
          <h4>Recent Post</h4>
          <ul>
            <?php 
            //assign SQL converted directive 
            $footerQuery=sprintf('SELECT * FROM iba_post ORDER BY order_number ASC LIMIT 0,4');
            //retrieve the data from iba_post
            $footerQueryRecord = mysqli_query($db,$footerQuery);
            //declare paging variables
            $colorNumber=0;
            while ($footerQueryTable = mysqli_fetch_assoc($footerQueryRecord)): ?>
            <li><a href="<?php echo $siteUrl; ?>/single/?page=<?php echo $colorNumber; ?>"><?php echo $footerQueryTable['title']; ?></a></li>
            <?php $colorNumber++; endwhile; ?>
          </ul>
        </div>
        <div id="footerIbadenArea">
          <h4>Recent Ibaden</h4>
          <ul>
           
          </ul>
        </div>
        <div id="footerLogoArea"> 　　　
          <div id="footerLogoImg"><img src="<?php echo $siteUrl; ?>/img/common/footerLogo.png" alt="茨城ダディー"></div>
          <small>2016(c) All right reserved by Ibaraki Daddy</small> </div>
      </div>
      <!--footerContent ends here--> 
    </div>
  </section>
</footer>