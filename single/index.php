<?php require_once('../dbconnect.php'); ?>
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
//assign SQL converted directive 
$goiLogQuery=sprintf('SELECT * FROM iba_post WHERE order_number="%d"',$page);
//retrieve the data from iba_post
$recordSet = mysqli_query($db,$goiLogQuery);
//declare paging variables
$goiLog = mysqli_fetch_assoc($recordSet);
//declare paging variables
$prePage = $page - 1;
$nextPage = $page + 1;

$postYear  = substr($goiLog['created'], 0, 4);
$postMonth = substr($goiLog['created'], 5, 2);
$postday   = substr($goiLog['created'], 8, 2);
$createdOn = $postYear . '年' . $postMonth . '月' . $postday . '日';
?>
<!doctype html>
<html>
<head>
<meta charset='utf-8' />
<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
<title><?php echo $goiLog['title']; ?>｜茨城のパパ</title>
<link rel="stylesheet" type="text/css" href="../reset.css">
<link rel="stylesheet" type="text/css" href="../style.css">
<link href='https://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="<?php echo $siteUrl; ?>/js/backToTop.js"></script>
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

     //add BackToTop event
     $('.backToTop').backToTop();


});
</script>
</head>
<body>
<!--recentPost begins here-->
<?php require_once('../header-page.php'); ?>
<!--recentPost ends here--> 
<!--innerMainWrapper begins here-->
<div id="innerMainWrapper" class="clearfix"> 
  <!--leftContent begins here-->
  <main roll="main">
    <article>
      <div id="leftContent">
        <section>
          <p class="newTitleImg"><img src="<?php echo $siteUrl; ?>/img/blog/newPostTitle.png"　alt="新着記事"></p>
          <!--post begins here-->
          <?php require_once('../post-area.php'); ?>
          <!--post ends here-->
          <div id="blogNav">
            <?php if($prePage >= 0): ?>
            <a class = "prev" href="?page=<?php echo $prePage; ?>">前の記事へ</a>
            <?php endif; ?>
            <?php if($nextPage <= $maxPage-1): ?>
            <a class = "next" href="?page=<?php echo $nextPage; ?>">次の記事へ</a>
            <?php endif; ?>
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
