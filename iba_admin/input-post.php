<?php
session_start();
require_once('../dbinfo.php');
require_once('login-status.php');

//check the MIME type of file
if (!empty($_POST)) {
    $catchImgfileName = $_FILES['catchy_img']['name'];
    if (!empty($catchImgfileName)) {
        $ext = substr($catchImgfileName, -3);
        if ($ext != 'jpg' && $ext != 'gif' && $ext != 'JPG' && $ext != 'png') {
            $error['image'] = 'type';
        }
    }
    
    if (empty($error)) {
      if($catchImgfileName != ""){
        $catchImgfileName = date('YmdHis') . $_FILES['catchy_img']['name'];
        move_uploaded_file($_FILES['catchy_img']['tmp_name'], './uploadfile/uploads/' . $catchImgfileName);
      }
        $_SESSION['iba_admin'] = $_POST;
        $_SESSION['iba_admin']['catchy_img'] = $catchImgfileName;
        header('location: check.php');
        exit();
    }
}
?>

<!doctype html>
<html>
<head>
<meta charset='utf-8' />
<style>
dt {
	margin: 20px 0 0 0;
}
</style>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $siteUrl; ?>/reset.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $siteUrl; ?>/admin.css">
  <script>
    $(document).ready(function(){
     var checkImgUrl ="";
     var checkImgCounter = 0;
      $('body').on('keyup',function() {
       updatePreview();
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
         
        $("#imgHolder p.eachImage img").on('click',function(){
              
              if(checkImgCounter == 0){
                    if(this.count == undefined || this.count == 0) {
                    $(this).siblings('input').addClass("selected").prop('checked',true);
                    this.count = 1;
                    checkImgCounter = 1;
                    }
              }

              else if(checkImgCounter == 1){

                  if(this.count == undefined || this.count == 0) {
                      alert ("you can check 1 img only");
                    }

                  else{
                  $(this).siblings('input').removeClass("selected").prop('checked',false);
                  this.count = 0;
                  checkImgCounter = 0;
                  }
                  
               }   
             

             
          });




        $('.yes').on('click',function(){

            $('.eachImage img').each(function(){

                
                if($(this).siblings('input').hasClass('selected')){
                   checkImgUrl = $siteUrl+'/'+$(this).attr('src');
                   console.log(checkImgUrl);
                }
               


            });

            var insertImgUrl = '\n<img src=\''+checkImgUrl+'\' />\n'
                insertAtCaret('mytextarea',insertImgUrl)






        });       
    });
   function updatePreview(){
 var postText = $('#mytextarea').val();
        postText = postText.replace(/\r\n/g, '\n');
        postText = postText.replace(/\r/g, '\n');
        var lines = postText.split('\n');
        console.log(lines);
        var replacedText = lines.join("<br>");
        $('#preview').html(replacedText);
   }


 function insertAtCaret(areaId,text) {
      var txtarea = document.getElementById(areaId);
      var scrollPos = txtarea.scrollTop;
      var strPos = 0;
      var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
        "ff" : (document.selection ? "ie" : false ) );
      if (br == "ie") { 
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart ('character', -txtarea.value.length);
        strPos = range.text.length;
      }
      else if (br == "ff") strPos = txtarea.selectionStart;

      var front = (txtarea.value).substring(0,strPos);  
      var back = (txtarea.value).substring(strPos,txtarea.value.length); 
      txtarea.value=front+text+back;
      strPos = strPos + text.length;
      if (br == "ie") { 
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart ('character', -txtarea.value.length);
        range.moveStart ('character', strPos);
        range.moveEnd ('character', 0);
        range.select();
      }
      else if (br == "ff") {
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
      }
      txtarea.scrollTop = scrollPos;
      updatePreview();
    }

// Function to add <tag>To Selected text</tag> in textarea with id of idelm
// Receives the tag name, and the id of textarea.
// Returns the selected text, with tag
function addTagSel(tag, idelm) {
  // http://CoursesWeb.net/javascript/
  var tag_type = new Array('<', '>');        // for BBCode tag, replace with:  new Array('[', ']');
  var txta = document.getElementById(idelm);
  var start = tag_type[0] + tag + tag_type[1];
  var end = tag_type[0] +'/'+ tag +  tag_type[1];
  var IE = /*@cc_on!@*/false;    // this variable is false in all browsers, except IE

  if (IE) {
    var r = document.selection.createRange();
    var tr = txta.createTextRange();
    var tr2 = tr.duplicate();
    tr2.moveToBookmark(r.getBookmark());
    tr.setEndPoint('EndToStart',tr2);
    var tag_seltxt = start + r.text + end;
    var the_start = txta.value.replace(/[\r\n]/g,'.').indexOf(r.text.replace(/[\r\n]/g,'.'),tr.text.length);
    txta.value = txta.value.substring(0, the_start) + tag_seltxt + txta.value.substring(the_start + tag_seltxt.length, txta.value.length);

    var pos = txta.value.length - end.length;    // Sets location for cursor position
    tr.collapse(true);
    tr.moveEnd('character', pos);        // start position
    tr.moveStart('character', pos);        // end position
    tr.select();                 // selects the zone
  }
  else if (txta.selectionStart || txta.selectionStart == "0") {
    var startPos = txta.selectionStart;
    var endPos = txta.selectionEnd;

    var tag_seltxt = start + txta.value.substring(startPos, endPos) + end;
    txta.value = txta.value.substring(0, startPos) + tag_seltxt + txta.value.substring(endPos, txta.value.length);

    // Place the cursor between formats in #txta
    txta.setSelectionRange((endPos+start.length),(endPos+start.length));
    txta.focus();
  }
  updatePreview();
  return tag_seltxt;
}

function deleteTagSel(idelm) {
// http://CoursesWeb.net/javascript/
  var txta = document.getElementById(idelm);
    if (txta.selectionStart || txta.selectionStart == "0") {
        var startPos = txta.selectionStart;
        var endPos = txta.selectionEnd;
        var targetText = txta.value.substring(startPos, endPos);
        var arrayText  = targetText.split('');
        var lengthOfText = arrayText.length - 1;
        console.log(arrayText[lengthOfText])
        if (arrayText[0] == "<" && arrayText[lengthOfText] == ">"){
            var filterdTextArray = [];
            var deleteFlag = false;
            for(var i = 0; i < lengthOfText; i++) {
              if(arrayText[i] == "<"){
                deleteFlag = true;
              }
              if(!deleteFlag){
                filterdTextArray.push(arrayText[i]);
              }
              if(arrayText[i] == ">"){
                deleteFlag = false;
              }
            }
            var filterdTextStr = filterdTextArray.join(''); 
            console.log(filterdTextStr);
            txta.value = txta.value.substring(0, startPos) + filterdTextStr + txta.value.substring(endPos, txta.value.length);
        }
        else{}
        updatePreview();
    }
    return filterdTextStr;
}
  </script>
</head>
<body>
<div id="postArea">
<div id="menuArea">
  
  <ul>
  <li><a href="logout.php">ログアウト</a></li>
  <li><a href="<?php echo $siteUrl.'/iba_admin/show-list.php'; ?>">一覧へ</a></li>
    <li><a href="<?php echo $siteUrl.'/iba_admin/uploadfile'; ?>">MEDIA</a></li>
    <li><a href="<?php echo $siteUrl.'/iba_admin/image-list.php'; ?>">写真を削除</a></li>
  </ul>



</div>
<div id="editArea">
<form id="" name="postInput" method="post" action="" enctype="multipart/form-data">
  <dl>
    <dt>
      <label for="created">日付</label>
    </dt>
    <dd>
      <?php
date_default_timezone_get('Japan');
?>
      <input name="created" type="text" id="date" size="20" maxlength="10" value="<?php
echo date('Y-m-d'); ?>" />
    </dd>
    <dt>
      <label for="title">タイトル</label>
    </dt>
    <dd>
      <input name="title" type="text" id="title" size="50" maxlength="50" />
    </dd>
    <dt>
      <label for="catchy_img">Goiキャッチ画像</label>
    </dt>
    <dd>
      <input name="catchy_img" type="file" id="catchy_img" size="35" />
		<?php if ($error['image'] == 'type'): ?>
		<p>please choose jpg or gif</p>
		<?php endif; ?>
    </dd>
    <dt>
      <label for="content">本文01</label>
    </dt>
    <dd>
    <textarea name="content" id="mytextarea" rows="10" cols="100" /></textarea>
      <div id="preview"></div>
    </dd>
    <dt>
      <label for="category">カテゴリー</label>
    </dt>
    <dd>
      <?php 
		//assign SQL converted directive 
		$categoryQuery=sprintf('SELECT * FROM category ORDER BY category_id ASC');

		//retrieve the data from iba_post
		$categoryQueryRecord = mysqli_query($db,$categoryQuery);

		while ($categoryTable = mysqli_fetch_assoc($categoryQueryRecord)): ?>
		<input name="category" type="radio" class="cat" value="<?php printf(htmlspecialchars($categoryTable['category_name'])); ?>" />
		<label for="book"><?php printf(htmlspecialchars($categoryTable['category_name'])); ?></label>
		<a href="#"></a>
		<?php endwhile; ?>
      　　 </dd>
  </dl>
  <div>
    <input type="submit" value="post">
    投稿する</div>
    <p class="submit">INSERT IMAGE</p>
    <input type="button" value="BOLD" onclick="addTagSel('h4', 'mytextarea');" />
      <input type="button" value="DELETE" onclick="deleteTagSel('mytextarea');" />
</form>
  
			<div id="confirm">
				<div id="imgHolder" class="clearfix">
				<?php
				//set the directory path
				$dir = "./uploadfile/uploads/";
				//set the file list in the directory 

				//iterate loops for how many items in the list
				if(is_dir($dir) && $handle = opendir($dir)):
					while(($file = readdir($handle)) !== false): 
						$filePath = $dir.$file;
						$fileType = filetype($filePath);
						if($fileType == "file"):?>
							<p class="eachImage">
							<input type="checkbox" class="checkImg" name="deleteImg[]" value="<?php echo $filePath; ?>">
							<img src="<?php echo $filePath; ?>" />
							</p>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php endif; ?>

				</div>

			<div>
          <p class="yesNo backBtn normalBtn red yes">Yes</p>
           <p class="yesNo backBtn normalBtn green">back</p>
         </div>
</div>
</div>
</body>
</html>
