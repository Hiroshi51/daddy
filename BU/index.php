<!doctype html>
<html>
<?php require('dbconnect.php'); 
$postYear  = substr($goiLog['created'], 0, 4);
$postMonth = substr($goiLog['created'], 5, 2);
$postday   = substr($goiLog['created'], 8, 2);
$createdOn = $postYear . '年' . $postMonth . '月' . $postday . '日';
?>
<head>
<meta charset='utf-8' />
<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
<title>茨城のパパ｜IBARAKI DADDY</title>
<meta name="description" itemprop="description" content="茨城に住んでいるパパ目線でいろいろと日常でこれは良いな！と思った事を書いています。茨城在住の家族のみんなへ、または茨城に引っ越して来たばかりの方へ良い情報をお届けします。" />
<link rel="stylesheet" type="text/css" href="reset.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="<?php echo $siteUrl; ?>/js/backToTop.js"></script>

<script>
	$(document).ready(function(){
     //add BackToTop event
     $('.backToTop').backToTop();

	});
</script>
</head>
<body>
<!--page GUI from here-->
<header roll="banner"> 
  <!--header begins here-->
  <div id="headerWrapper"> 
    <!--innerWrapper begins here-->
    <div id="innerWrapper" class="clearfix"> 
      <!--leftInner begins here-->
      <div id="leftInner">
        <hgroup>
          <div id="logoArea">
            <h1>茨城のパパ応援サイト</h1>
            <div id="logoImg" ><img src="<?php echo $siteUrl; ?>/img/common/mainLogo.png" alt="茨城ダディー"></div>
          </div>
        </hgroup>
        <div id="authorArea">
          <div id="authorHeader" class="clearfix">
            <div id="authorImg"><img src="<?php echo $siteUrl; ?>/img/common/itsMe.png" alt="筆者"></div>
            <p class="authorCommentTitle">Welcome to "IBARAKI DADDY"</p>
          </div>
          <p class="authorComment">このサイトは茨城の水戸に住むパパ "IBARAKI DADDY" を応援するサイトです。子供と一緒に行くと楽しい場所や、おもちゃづくりなのど日頃僕がしたことで、これは良いな！っと思った事を書いています。茨城に住む皆さんに良い情報が届けられたらなと思い始めました。番外編コンテンツもお楽しみに。</p>
        </div>
      </div>
      <!--leftInner ends here--> 
      <!--rightInner begins here-->
      <div id="rightInner">
        <ul>
          <li> <img src="<?php echo $siteUrl; ?>/img/blog/mainImage01.jpg" width="681" height="485" alt="手作りキッチン"></li>
        </ul>
      </div>
      <!--rightInner ends here--> 
      <!--globalNavi begins here-->
      <?php require('globalNavi.php'); ?>
      <!--globalNavi ends here--> 
    </div>
    <!--innerWrapper ends here--> 
  </div>
  <!--header ends here--> 
</header>

<!--innerMainWrapper begins here-->
<div id="innerMainWrapper" class="clearfix"> 
  <!--leftContent begins here-->
  <main roll="main">
    <article>
      <div id="leftContent">
        <section>
          <p class="titleImg" ><img src="<?php echo $siteUrl; ?>/img/blog/newPostTitle.png"　alt="新着記事"></p>
          <!--globalNavi begins here-->
          <?php require_once('post-area.php'); ?>
          <!--globalNavi ends here-->
          <div id="blogNav"> <a class = "next" href="<?php echo $siteUrl; ?>/single/?page=<?php echo $nextPage; ?>">次の記事へ</a> </div>
        </section>
      </div>
    </article>
  </main>
  <!--leftContent ends here--> 
  <!--rightContent begins here-->
    <aside role="complimentary">
      <div id="rightContent"> 
        <!--recentPost begins here-->
        <?php require('recentPost.php'); ?>
        <!--recentPost ends here-->
      <div id="fixedMenu">
      　<!--category begins here-->
        <?php require_once('category-archive-list.php'); ?>
        <!--category ends here-->
        <!--monthly begins here-->
        <?php require_once('monthly-archive-list.php'); ?>
        <!--monthly ends here-->
        </div>
      </div>
    </aside>
  <!--rightContent ends here--> 
</div>
<!--innerMainWrapper ends here--> 

<!--footer starts here--> 

　　　
<?php require_once('footer.php'); ?>

<!--footer ends here-->
</body>
<!--page GUI untill here-->
</html>
