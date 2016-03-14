<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>fileUploading and cancel</title>
  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <style>
    #dropable{
        width:100%;
        height:800px;
        border:1px solid #999;
        background-color: #eee;
    }
    </style>
    <script>
    function sendFileToServer(formData,status)
    {
        var uploadURL ="upload-img.php"; //Upload URL
        var extraData ={}; //Extra Data.
        var jqXHR=$.ajax({
                xhr: function() {
                var xhrobj = $.ajaxSettings.xhr();
                if (xhrobj.upload) {
                        xhrobj.upload.addEventListener('progress', function(event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            //Set progress
                            status.setProgress(percent);
                        }, false);
                    }
                return xhrobj;
                },
                url: uploadURL,
                type: "POST",
                contentType:false,
                processData: false,
                cache: false,
                data: formData
                })
                .done(function(data){
                    status.setProgress(100);
                    console.log("success");
                    })
                .fail(function(data){
                 console.log("fail");
                    })
                .always(function(data){
                 console.log("keepGoing");
                    }); 

        status.setAbort(jqXHR);
    }

    var rowCount=0;
    function createStatusbar(obj)
        {
        rowCount++;
        var row="odd";
        if(rowCount %2 ==0) row ="even";
            this.statusbar = $("<div class='statusbar "+row+"'></div>");
            this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
            this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
            this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
            this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
            obj.after(this.statusbar);

        this.setFileNameSize = function(name,size)
        {
            var sizeStr="";
            var sizeKB = size/1024;
            if(parseInt(sizeKB) > 1024)
            {
                var sizeMB = sizeKB/1024;
                sizeStr = sizeMB.toFixed(2)+" MB";
            }
            else
            {
                sizeStr = sizeKB.toFixed(2)+" KB";
            }

            this.filename.html(name);
            this.size.html(sizeStr);
        }
        this.setProgress = function(progress)
        {       
            var progressBarWidth =progress*this.progressBar.width()/ 100;  
            this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
            if(parseInt(progress) >= 100)
            {
                this.abort.hide();
            }
        }
        this.setAbort = function(jqxhr)
        {
            var sb = this.statusbar;
            this.abort.click(function()
            {
                jqxhr.abort();
                sb.hide();
            });
        }
    }

    function handleFileUpload(files,obj)
        {
            for (var i = 0; i < files.length; i++) 
                {
                    var fd = new FormData();
                    fd.append('file', files[i]);
                    var status = new createStatusbar(obj); //Using this we can set progress.
                    status.setFileNameSize(files[i].name,files[i].size);
                    sendFileToServer(fd,status);

                }
        }

(function(global,$) {

    var util = {
        //stop brawser defalut action
        on: function(event){
            event.preventDefault();
            event.stopPropagation();
            $(this).css({
                'border':'1px solid red'
            });
        },

        leave: function(event){
            event.preventDefault();
            event.stopPropagation();
            $(this).css({
                'border':'1px solid #999'
            });
        },
        
        //cut str by in certain length
        cutoff: function(str, len, tail){
            this.tail = tail || "";
            return str.slice(0,len) + tail;
        }
    }

    $(function() {
        var $dropArea = $("#dropable");
        //stop default event to all the action and set new drop event 
        $dropArea.on({
          'dragenter' : util.on,
          'dragover'  : util.on,
          'dragleave' : util.leave,
          'drop'      : function(event){
             util.on(event);
             var tmp = event.originalEvent.dataTransfer.files,
             files = Array.prototype.slice.call(tmp, 0, tmp.length);
              
             files.forEach(function(file,index,array){
                var reader = new FileReader();
                console.log(reader);
                console.log($(reader));
                $(reader).one('load',function(event){
                    var fn = 'Dropped File name:' + file.name,
                        ft = 'Type of the File:' + file.type,
                        fs = 'Size of the File:' + file.size + 'byte',
                        fv = 'Content:' + util.cutoff(event.target.result, 80, '....'),
                        msg = [fn, ft, fs, fv].join('\n');
                   $dropArea.append($("<pre></pre>").text(msg));      
                });
               reader.readAsText(file); 
               reader.onload = function(){alert("done");};  
                  
              });  
             handleFileUpload(files,$dropArea); 
          }
        });
    });
        
}(this,jQuery));

    </script>
</head>
<body>
 <div id="dropable">dropHere</div>
</body>
</html>
