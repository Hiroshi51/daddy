<?php
session_start();
require_once('../dbinfo.php');
require_once('login-status.php');
$pageNumber = $_REQUEST['page'];
$nextNumber = $pageNumber + 10;
$prevNumber = $pageNumber - 10;
if(isset($deleteImg)){
if(!empty($deleteImg)){
   header("Location: delete-img.php");
   exit();
}
elseif(empty($deleteImg)){
   $errorMsg = "画像が選択されていません。";

}
}
?> 
<!doctype html>
<html>
<head>
  <meta charset='utf-8' />
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo $siteUrl; ?>/reset.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $siteUrl; ?>/admin.css">

  
  <script>
   $(document).ready(function(){

          $('.selectAll').on('click',selectAll);
          $('.deselectAll').on('click',deselectAll);
              
          $("#imgHolder p.eachImage img").on('click',function(){
              
              if(this.count == undefined || this.count == 0) {
               $(this).siblings('input').prop('checked',true);
               this.count = 1;
             }
             else{
              $(this).siblings('input').prop('checked',false);
              this.count = 0;
            }
              console.log(this.count);
          });

          function selectAll(){
            
             $('input').each(function(){
               $(this).prop({'checked':true});


             });  
           }

           function deselectAll(){
            
             $('input').each(function(){
               $(this).prop({'checked':false});


             });  

          }
          //check img width and height 
          $("#imgHolder p.eachImage img").each(function(){

            if($(this).height() > $(this).width()){
              $(this).css({
                "height":"90px",
                "width" :"auto"
              });

              var imgWidth = $(this).width();
              var marginLeft= (90-imgWidth) / 2;
              $(this).css({
                "margin-left": marginLeft+"px"

              　　　  });
            }
            else{
              var imgHeight = $(this).height();
              var marginTop= (90-imgHeight) / 2;
              $(this).css({
                "margin-top": marginTop+"px"

              });
            }

          });

          //add event to the submit BTN
          $('.submit').on('click',function(){
             //Get the windowHeight
               var surfaceHeight = $(window).height();  
              //Get the windowHeight
              var surfaceWidth = $(window).width(); 
            $('#confirm').css({
              "display":"block",
              "height":surfaceHeight+"px",
              "width":surfaceWidth+"px",
              "z-index":100
            }).animate({
              "opacity":1.0
            });
            $('#confirmbtn').css({
              "top" : (surfaceHeight / 2 - surfaceHeight * 0.3) + "px",
              "left" : (surfaceWidth / 2 - surfaceWidth * 0.5 * 0.5) + "px"
            });

          });

          //add backBtn Event
          $('.backBtn').on('click',function(){
            $confirm = $('#confirm');

            $confirm.animate({
              "opacity":0
            });

            var changeCssBack = setTimeout(function(){
              $confirm.css({
                "display":"none",
                "width":"0px",
                "height":"0px",
                "z-index":0
              });
            },500);
          });

          $(window).resize(function() {
         //Get the windowHeight
         var surfaceHeight = $(window).height();  
              //Get the windowHeight
              var surfaceWidth = $(window).width(); 

              $('#confirm').css({

                "height":surfaceHeight+"px",
                "width":surfaceWidth+"px",

              });
              $('#confirmbtn').css({
                "top" : (surfaceHeight / 2 - surfaceHeight * 0.3) + "px",
                "left" : (surfaceWidth / 2 - surfaceWidth * 0.5 * 0.5) + "px"
              });

            });
      
        });   


      </script>
    </head>

<body>
<div id="postArea">
<div id="menuArea"></div>
<div id="editArea">
    <div id="header">
      <h1>画像一覧</h1>
      <p>Check images you want to delete and click the DELETE Button</p>
      <p>削除したい画像を選び、DELETEボタンを押してください</p>
      </div>

        <div id="wrapper">
      <div class="clearfix">
      <P class="selectAll normalBtn green">Select All</P>
       <P class="deselectAll normalBtn green">Deselect All</P>
       </div>
      <form action="delete-img.php" method="post">
       <div id="imgHolder" class="clearfix">
   
        <?php
            $imageArray = array();
            foreach (glob('uploadfile/uploads/{*.jpg,*.JPG,*.gif,*.png}',GLOB_BRACE) as $filename) {
            array_push($imageArray,$filename);   
            }
         
        ?>
         <?php
            $start = $pageNumber;
            $end   = $pageNumber + 10;
            $numberOfImg = count($imageArray);
            for ($i = $start; $i < $end; $i++) : ?>
              <?php $filePath = $imageArray[$i]; ?>
           
              <p class="eachImage">
                 <input type="checkbox" class="checkImg" name="deleteImg[]" value="<?php echo $filePath; ?>">
                 <img src="<?php echo $filePath; ?>" />
               </p>
           
               
        <?php endfor; ?>
         </div>

        <div id="confirm">
        <div id="confirmbtn">
         <p>Are you sure to delete?</p>
         <p>本当に削除しますか?</p><p class="warning">※削除した後は戻すことはできません。</p>

         <div>
           <p class="yesNo"><input type="submit" value="Yes" class="normalBtn red"></p>
           <p class="yesNo backBtn normalBtn green">back</p>
         </div>
       </div>
</div>
       </form>
         <a href="<?php echo $siteUrl.'/iba_admin/image-list.php?page='.$prevNumber; ?>" class="submit normalBtn green">前へ</a>
       <a href="<?php echo $siteUrl.'/iba_admin/image-list.php?page='.$nextNumber; ?>" class="submit normalBtn green">次へ</a>
        <p class="submit normalBtn green">Delete</p>
        <p><?php echo $errorMsg; ?></p>
        <p class="normalBtn red"><a href="<?php echo $siteUrl.'/iba_admin/input-post.php'; ?>">投稿画面へ</a></p>
    </div>

</div>
</body>

</html>