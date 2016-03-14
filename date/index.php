<!doctype html>
<html>
<head>
<meta charset='utf-8' />
<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />

<title>月間アーカイブ｜茨城のパパ</title>
<link rel="stylesheet" type="text/css" href="../reset.css">
<link rel="stylesheet" type="text/css" href="../style.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    //adjust to make them have the same height
    var mainContentHeight = $('#leftContent').height();
    var asideContentHeight = $('#rightContent').height();
    if(mainContentHeight > asideContentHeight){
      $('#rightContent').css('height',mainContentHeight+'px');
    }
    if(mainContentHeight < asideContentHeight){
      $('#rightContent').css('height',asideContentHeight+'px');
    }
  });
</script>
</head>
<body>
<!--dbconnect begins here-->
<?php require('../dbconnect.php'); ?>
<!--dbconnect ends here--> 



<!--recentPost begins here-->
<?php require('../header-page.php'); ?>
<!--recentPost ends here--> 

 <!--innerMainWrapper begins here-->
  <div id="innerMainWrapper" class="clearfix"> 
  
    
      
    <!--leftContent begins here-->
    <main roll="main">
      <article>
        <div id="leftContent">
          <section>
           <p class="newTitleImg"><img src="../img/blog/monthlyArchiveListTitle.png"　alt="新着記事"></p>
            <div id="archiveWrapper">
           
               <?php 

             //retieve category name
             $date = $_REQUEST['date'];
             
             //assign SQL converted directive 
             $categoryPost=sprintf('SELECT * FROM iba_post WHERE created LIKE "%s" ORDER BY id DESC',$date."%");
           

             //retrieve the data from iba_post
             $categoryPostRecord = mysqli_query($db,$categoryPost); ?>
             <h2>月間アーカイブ「<?php echo $date; ?>」の一覧を表示しています。</h2> 
             <ul id="archiveList">
             <?php while ($categoryPostTable = mysqli_fetch_assoc($categoryPostRecord)): ?>
            
            <li class="clearfix"><p class="archiveImg"><a href="<?php echo $siteUrl; ?>/single/?page=<?php echo $categoryPostTable['order_number']; ?>">
            <?php if(empty($categoryPostTable['catchy_img'])):?>
            <img src="<?php echo $siteUrl.'/img/common/noImage.jpg'; ?>">
            <?php else: ?>  
            <img src="<?php echo $uploadUrl.'/'.$categoryPostTable['catchy_img']; ?>">
            <?php endif; ?></p>
            <h3><a href="<?php echo $siteUrl; ?>/single/?page=<?php echo $categoryPostTable['order_number']; ?>"><?php echo htmlspecialchars($categoryPostTable['title']); ?></a></h3>
            <p class="archiveContent"><?php echo mb_strimwidth(htmlspecialchars($categoryPostTable['content']), 0, 100, "...",'utf-8'); ?></p></li>

             <?php endwhile; ?>




            </div>
          </section>
        </div>
      </article>
    </main>
    <!--leftContent ends here--> 
  <!--rightContent begins here-->
  <aside role="complimentary">
    <div id="rightContent"> 
      <!--recentPost begins here-->
      <?php require_once('../recentPost.php'); ?>
      <!--recentPost ends here-->
      <div id="fixedMenu">
      <!--category begins here-->
      <?php require_once('../category-archive-list.php'); ?>
      <!--category ends here--> 
      <!--monthly begins here-->
      <?php require_once('../monthly-archive-list.php'); ?>
      <!--monthly ends here--> 
    </div>
    </div>
  </aside>
  <!--rightContent ends here--> 
</div>
<!--innerMainWrapper ends here--> 
<!--footer starts here--> 
<!--recentPost begins here-->
<?php require_once('../footer.php'); ?>
<!--recentPost ends here--> 
<!--footer ends here-->
</body>
</html>