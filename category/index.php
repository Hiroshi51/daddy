<!doctype html>
<html>
<head>
<meta charset='utf-8' />
<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />

<title>カテゴリーアーカイブ｜茨城のパパ</title>
<link rel="stylesheet" type="text/css" href="../reset.css">
<link rel="stylesheet" type="text/css" href="../style.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="<?php echo $siteUrl; ?>/js/fixedMenu.js"></script>
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
<?php
//get pageNumber from the URL
$page = $_REQUEST['page'];

//set back to 0 when $page is empty
if ($page == '') {$page = 0;};

//set back to 0 when $page is smaller than 0
$page = max($page, 0);

//find the oldest post
$postNumbers       = 'SELECT COUNT(*) AS cnt FROM iba_post';
$postNumbersRecord = mysqli_query($db, $postNumbers);
$postNumbersTable  = mysqli_fetch_assoc($postNumbersRecord);
$maxPage           = ceil($postNumbersTable['cnt']);
$page = min($page, $maxPage-1);

//declare paging variables
$prePage = $page - 1;
$nextPage = $page + 1;
?>


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
           <p class="newTitleImg"><img src="../img/blog/categoryArchiveListTitle.png"　alt="カテゴリー別一覧"></p>
            <div id="archiveWrapper">
           
               <?php 

             //retieve category name
             $categoryName = $_REQUEST['name'];  
             

             //assign SQL converted directive 
             $categoryPost=sprintf('SELECT * FROM iba_post WHERE category="%s" ORDER BY order_number DESC',$categoryName);

             //retrieve the data from iba_post
             $categoryPostRecord = mysqli_query($db,$categoryPost);?>

             <h2>カテゴリー「<?php echo $categoryName; ?>」の一覧を表示しています。</h2> 
             <ul id="archiveList">
             <?php while ($categoryPostTable = mysqli_fetch_assoc($categoryPostRecord)): ?>

                  <li class="clearfix"><p class="archiveImg"><a href="<?php echo $siteUrl; ?>/single/?page=<?php echo $categoryPostTable['order_number']; ?>">
                  <?php if(empty($categoryPostTable['catchy_img'])):?>
                  <img src="<?php echo $siteUrl.'/img/common/noImage.jpg'; ?>">
                  <?php else: ?>  
                  <img src="<?php echo $uploadUrl.'/'.$categoryPostTable['catchy_img']; ?>">
                  <?php endif; ?></p></a></p>
                  <h3><a href="<?php echo $siteUrl; ?>/single/?page=<?php echo $categoryPostTable['order_number']; ?>"><?php echo htmlspecialchars($categoryPostTable['title']); ?></a></h3>
                  <p class="archiveContent"><?php echo mb_strimwidth(htmlspecialchars($categoryPostTable['content']), 0, 100, "...",'utf-8'); ?></p></li>

             <?php endwhile; ?>
              </ul>
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

      <!--postArea begins here-->
      <?php require_once('../monthly-archive-list.php'); ?>
      <!--postArea ends here--> 
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