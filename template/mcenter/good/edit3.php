{include file="common/uheader" /}
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.myconfig.js"></script>
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/uedit/lang/zh-cn/zh-cn.js"></script>

{include file="common/uheaderNav" /}
<div class="container" id="j-content">
	<div class="row">
		<!--left Nav start-->
        {include file="common/usnav" /}
        <!--left Nav end-->
		<div class="col-md-11 main_right">
			<div class="row">
				<div class="box">
					<ul class="nav nav-tabs detail-tabs">
                        <li><a href="#"><?php echo $info?'编辑':'添加';?>商品详情</a></li>
                      </ul>
					<div class="content">
						<div class="form-horizontal bank-card-new">
							<form class="form-horizontal withdraw-form" role="form" id="objForm" method="post">
                                <input type="hidden" name="gno" value="<?php echo $info['gno'];?>">
                                <div class="form-group alipay">
									<label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention">*</b>商品介绍：</label>
									<div class="col-sm-8">
                                        <script id="content" type="text/plain" style="width:100%;height:500px;"></script>
									</div>
								</div>
                                
								<div class="form-group">
                                	<label for="bankcard" class="col-sm-2 control-label">&nbsp;</label>
									<div class="col-sm-8 text-left">
										<a class="btn btn-major btn-big saveBtn">保存</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<textarea id="contentdiv" style="display:none"><?php echo htmlspecialchars_decode($info['desc']);?></textarea>


<script type="text/javascript">
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
var ue = UE.getEditor('content');
var content = $("#contentdiv").val();
ue.ready(function() {
	ue.setContent(content);
});

$(function(){
    menuleft("archex");

	$('.saveBtn').click(function(){
		$.post("/good/saveinf.html", $('#objForm').serialize(),
			function(data){
				if (data.status == 200) {
					$('.saveBtn').attr('disabled',true);
					window.location.href = '/good/index.html';
				} else {
					art.dialog.alert(data.msg);
				}
			});
	})
});
</script>
{include file="common/ufooter" /}