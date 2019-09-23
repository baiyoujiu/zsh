{include file="common/uheader" /}
<script type="text/javascript" src="__JSPZ__/ajaxupload3.9.js"></script>
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.myconfig.js"></script>
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/uedit/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="__STATIC__/js/laydate.js"></script>
<div class="user_right_box2017">
  <div class="account_box hengruibao_in_box">
  		<div class="tab_link_style"> <span class="row_jl"><a href="<?php echo url('pzu/news');?>">稿件管理</a></span>
            <ul id="record"><li class="current"><a href="<?php echo url('pzu/newsedit');?>" class="colorred"><?php echo $userInfo['utype'] == 1?'稿件编辑':'稿件审核';?></a></li></ul>
        </div>
        <div class="webset">
          <form id="form">
          <input name="objNo" id="objNo" type="hidden" value="<?php echo $objNo;?>" />
          <input name="pic" type="hidden" id="logo" value="<?php echo $info['pic'];?>" />
          <dl><b class="colorred"><?php echo $userInfo['utype'] == 1?'约　稿　方':'写　　手';?></b>：
          	<select name="userid" class="searchSelect">
            <option value="">-请选择-</option>
          	<?php foreach($useridarr as $k=>$v){?>
            <option value="<?php echo $k;?>" <?php echo in_array($k,array($info['author'],$info['userid']))?' selected="selected"':'';?>><?php echo $v;?></option>
            <?php }?>
          </select>
          </dl>
          <dl>资讯标题：<input name="title" type="text" class="input-text-style-1 longtext500" value="<?php echo $info['title'];?>" placeholder="请输入资讯标题" /></dl>
          
          <dl>封面图片：<img src="<?php echo empty($info['pic'])? '/static/add-pic.jpg':$info['pic'];?>" id="logoShow" style="height:100px;width:150px;"><button type="button" id="uplogo" class="btn btn-s">上传</button>图3：2且最小300X200</dl>
          <?php echo !empty($info['feedback'])?'<dl><b class="colorred">收退反馈</b>：<textarea name="summary" cols="69" rows="5" placeholder="请输入摘要" >'.$info['feedback'].'</textarea></dl>':'';?>
          <dl>资讯摘要：<textarea name="summary" cols="69" rows="5" placeholder="请输入摘要" ><?php echo $info['summary'];?></textarea></dl>
          <dl>
       		<script id="introduce" type="text/plain" style="width:875px;height:500px;"></script>
            <textarea id="introducediv" style="display:none"><?php echo htmlspecialchars_decode($info['content']);?></textarea>
          </dl>
          <?php if($userInfo['utype'] == 1 && $info['status'] == 0){?>
          <dl align="center"><button type="button" class="btn btn-s subut">保存</button></dl>
          <?php }else{?>
          <?php if($info['status'] == 0){?>
          <dl>收退反馈：<textarea id="feedback" name="feedback" cols="69" rows="5" placeholder="请输入收退稿调整反馈" ><?php echo $info['feedback'];?></textarea></dl>
          <dl align="center" class="colorred">收稿：平价收稿；优:加2元收稿；赞：加5元收稿;赏：加10等元收稿。</dl>
          <dl align="center"><button type="button" class="btn btn-s auditbut" data-alt="1">收稿</button>　　<button type="button" class="btn btn-s auditbut" data-alt="2">优</button>　　<button type="button" class="btn btn-s auditbut" data-alt="3">赞</button>　　<button type="button" class="btn btn-s auditbut" data-alt="4">赏</button>　　<button type="button" class="btn btn-s auditbut" data-alt="8">退稿</button></dl>
          <?php }}?>
          </form>
        </div>
  </div>
</div>
<script type="text/javascript">
	$('.auditbut').click(function(){
		var objNo = $('#objNo').val();upstatus = $(this).data('alt'),feedback = $('#feedback').val();
		$.ajax({
            url: 'newsaudit.html',
            type: "post",
            cache: false,
			dataType : 'json',
            data:{objNo:objNo,upstatus:upstatus,feedback:feedback,i:Math.random()},
            success: function (data) {
                if (data.status == 200) {
                    CFW.dialog.alert(data.msg, 4, { listener: function () {window.location.href='/pzu/news.html'; } });
                }else{
                    CFW.dialog.alert(data.msg, 0, null);
                }

            }
        });
	})
	$('.subut').click(function(){
		$.ajax({
            url: 'newssave.html',
            type: "post",
            cache: false,
			dataType : 'json',
            data:$("#form").serialize(),
            success: function (data) {
                if (data.status == 200) {
                    CFW.dialog.alert(data.msg, 4, { listener: function () {window.location.href='/pzu/news.html'; } });
                }else{
                    CFW.dialog.alert(data.msg, 0, null);
                }

            }
        });
	})
	
	//上传
	var button = $('#uplogo');
	new AjaxUpload(button, {
		action : '/index/upload.html',
		data : {},
		onSubmit : function(file, ext) {
			var imageSuffix = new RegExp('jpg|png|jpeg|JPG|PNG|JPEG');
			if (!(ext && imageSuffix.test(ext.toUpperCase()))) {
				art.dialog.alert("请上传JPG/JPEG/PNG格式图片");
				return false;
			}
		},
		autoSubmit : true,
		responseType : 'json',
		onChange : function(file, ext) {
		},
		onComplete : function(file, response) {
			if (response.flag == "SUCCESS") {
				$('#logoShow').attr("src", response.source);
				$('#logo').val(response.path);
			} else {
				art.dialog.alert(response.info);
				return;
			}
		}
	});
	
	//实例化编辑器
	var ue = UE.getEditor('introduce');
	var content = $("#introducediv").val();	 
	ue.ready(function() {	 
		ue.setContent(content); 
	});
</script> 
{include file="common/ufooter" /}