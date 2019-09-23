/**/
+function ($) {
    $.initPhotograph=function(config){
       var uploadingimg=false,
        $uploadphotograph=$("[data-id='upload-photograph']");
        $uploadphotograph.on("click","[data-id='u-photograph']",function(){

             if (!isiOSAndAndroid()) {
                var version=parseInt(version);
               if (version!=0&&version<85) {
                var oldVHtml='<div id="oldVerTipMsg"><p>您的版本不支持添加图片哦，</p><p>请及时升级版本操作如下：</p><p>在页面"我"--左上角的设置--点击检查更新</p></div>'
                    $("body").append(oldVHtml);
                     artDialogSureComfirm("oldVerTipMsg",function(){return true;$("#oldVerTipMsg").remove();},"我知道了");
                     return false;
               }
             }
            $uploadphotograph.children("a.none").remove();
           var  $obj=$(this),
                $objparent=$obj.parent(),
                $objparentprev,
                $newinput,
                a_imghtml='<a class="u-p-aimg  none u-p-loading "><i class="loader loader-quart loader-uploadpic"></i>'+
                                        '<img  src="">'+
                                        '<em></em>'+
                                       '</a>';  
           if (defaults.isReplaceSlef) {
                a_imghtml='<a class="u-p-aimg u-p-aimg-single none u-p-loading"><i class="loader loader-quart loader-uploadpic"></i>'+
                           '<img  src=""></a>'; 
            var $upamig=$('.u-p-aimg');
                $newinput=$objparent.children("input");
                if ($newinput.length==0) {
                     if ($upamig.length==0) {
                        $obj.append(a_imghtml);
                    } 
                      $objparent.append('<input type="file" name="file" class="none" accept="image/*" />');
                      $newinput=$objparent.children("input");
                }   
           }
           else{
              $objparent.before(a_imghtml);
              $objparentprev=$objparent.prev();
              $objparentprev.append('<input type="file" name="file" class="none" accept="image/*" />');
              $newinput=$objparentprev.find("input");
             
           }                                                    
           $newinput.click();
           
            
        });
        // 上传图片
        $uploadphotograph.on("change","input[type='file']",function(e){
            var $this=$(this),
            $thisparent=$this.parent(),
            $thisparents=$this.parents("[data-id='upload-photograph']"),
            fileUrl=$this[0].files[0];
             if (defaults.isReplaceSlef) {
                $thisparent=$thisparent.find('.u-p-aimg');
             }
             $thisparent.removeClass("none");             
            var filevalue=fileUrl.type;
            if (fileUrl.size>10485760) {
                artTip("上传照片不能超过10M");
                 $thisparent.remove();
               return false;

            }
            // if(filevalue!=""&&!/image\/\w+/.test(filevalue)) {
            //     artTip("请选择文件类型为图像类型哦");
            //      $thisparent.remove();
            //     return false;
            // }
            if (defaults.isReplaceSlef) {
                 $uploadphotograph.find("div.u-icon").remove();
            }
            if (isiOSAndAndroid()) {
               lrz(fileUrl,{width:800})
                .then(function (rst) {
                    // 处理成功会执行
                      var img = new Image(),
                      $newimg=$thisparent.find("img");
                      img.onload = function () {
                         $thisparent.removeClass("u-p-loading");
                         $thisparent.find("i.loader").remove();
                         var rstbase64=rst.base64;
                          $newimg[0].src=rstbase64;
                           ishideAddPic($thisparents);
                        putbyte64(rstbase64,function(src){
                             $newimg.data("loading",false);
                            $thisparent.removeClass("none");
                            $newimg.data("src",src.path);
                        });
                    };
                     img.onerror=function(){
                         $newimg.data("loading",false);
                         artTip("请选择文件类型为图像类型哦!");
                         $thisparent.remove();
                         return false;
                        }
                    img.src=rst.base64;
                   
                });

            }
            else{
                var imgW=0,
                    imgH=0,
                    expW=0,
                    expH=0,
                    imgDataUrl="",reader=new FileReader(),imgW=0,imgH=0,expW=0,expH=0,imgMax=800, thisc=document.createElement("canvas");
                   thisctx=thisc.getContext("2d");
                     reader.readAsDataURL(fileUrl);
                    //转换图片为base64格式
                    reader.onload=function(e){
                         var img = new Image(),
                          $newimg=$thisparent.find("img");
                           $newimg.data("loading",true);
                        img.onload =function(){
                             $thisparent.removeClass("u-p-loading");
                           $thisparent.find("i.loader").remove();
                             var $newinpufile=$thisparent.children("input[type='file']");
                                 imgW=this.width;
                                imgH=this.height; 
                                //改变图片尺寸，这个根据自己的实际需求来写算法
                                if(imgW>imgMax&&imgW>=imgH){
                                    expW=imgMax;
                                    expH=parseInt((imgMax*imgH)/imgW);
                                }else if(imgH>imgMax&&imgH>imgW){
                                    expH=imgMax;
                                    expW=parseInt((imgMax*imgW)/imgH);
                                }else{
                                    expW=imgW;
                                    expH=imgH;
                                }
                                thisc.width=expW;
                                thisc.height=expH;
                                thisctx.drawImage(this,0,0,expW,expH);
                                imgDataUrl= thisc.toDataURL('image/jpeg'); //默认输出PNG格式
                                $newimg[0].src=imgDataUrl;
                                 putbyte64(imgDataUrl,function(src){
                                    $newimg.data("loading",false);
                                    $thisparent.removeClass("none");
                                    ishideAddPic($thisparents); 
                                    $newimg.data("src",src.path);
                                });
                            
                        };
                        img.onerror=function(){
                             $newimg.data("loading",false);
                             artTip("请选择文件类型为图像类型哦!");
                             $thisparent.remove();
                             return false;
                        }
                         img.src=this.result;
                    }
                    
            }        
        });
        // 删除图片
        $uploadphotograph.on("click","em",function(){
            var $obj=$(this),
                $thisparents= $obj.parents("[data-id='upload-photograph']");
                $obj.parent().remove();
                ishideAddPic($thisparents);
        });
        // 显示或隐藏图片
        var ishideAddPic=function($thisphotograph){
            $thisphotograph.children("a.none").remove();
            var aphotolen=$thisphotograph.children("a.u-p-aimg").length,
                $photographfont=$thisphotograph.find(".p-b-font"),
                $photograph=$thisphotograph.find("[data-id='u-photograph']");
                $photographfont.removeClass("none");
                $photograph.removeClass("none");
            if (aphotolen>0) {
                $photographfont.addClass("none");
                if (aphotolen>=defaults.uploadlen) {
                    $photograph.addClass("none");
                }
            }
        }
        var putbyte64=function (strbtye,fn){
          var pic = strbtye;
          var url = "/u/evaluate/uploadPic.htm";
          var xhr = new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if (xhr.readyState==4&&xhr.status === 200){
                    var data = JSON.parse(xhr.response);
                    fn(data);
                }
            }
              xhr.open("POST", url, true);
              xhr.setRequestHeader("Content-Type", "application/octet-stream");
              xhr.send(pic);
        }
        var defaults={"uploadlen":5,"isReplaceSlef":false};
        var init=function(config){
            if (config) {
                defaults.uploadlen=config.uploadlen|| defaults.uploadlen;
                defaults.isReplaceSlef=config.isReplaceSlef|| defaults.isReplaceSlef;
            }
        }
        init(config);
    } 
}($);
