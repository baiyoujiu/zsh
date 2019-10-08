{include file="common/uheader" /}
<link rel="stylesheet" type="text/css" href="__CSS__/withdraw-new.css">
<link rel="stylesheet" type="text/css" href="__CSS__/daterangepicker-bs3-zh.css">
<link rel="stylesheet" type="text/css" href="__CSS__/codemirror.css">
<link rel="stylesheet" type="text/css" href="__CSS__/product_y.css">
<script type="text/javascript" src="__JS__/addNewShop.js"></script>
<script type="text/javascript" src="__JS__/jquery-ui.min.js"></script>
<script type="text/javascript" src="__JS__/ajaxupload3.9.js"></script>
<style>
	.box {border-top: none;}
	input {border:1px solid #dfdfdf!important;}
	form label.error {display:inline;}
	#template input {width: 100px;}
	.add-uploadpic .action{display:none;}
	.clearfix:before,.clearfix:after {content:"";display:table;}
	.clearfix:after {clear:both;overflow:hidden;}
	.clearfix {zoom:1; }
	.clear {clear:both;display:block;font-size:0;height:0;line-height:0;overflow:hidden;}
	.hide {display:none;}
	.block {display:block;}
	.fl {float:left;}
	.fr {float:right;}
	.specv1{width:19%; text-align:center; line-height:34px; border:1px solid #ededed;}
</style>
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
                        <li><a href="#"><?php echo $info?'编辑':'添加';?>商品</a></li>
                      </ul>
					<div class="content">
						<div class="form-horizontal bank-card-new">
							<form class="form-horizontal withdraw-form" role="form" id="objForm" method="post">
                                <input type="hidden" name="objNo" id="objNo" value="<?php echo $info['gno'];?>">

								<div class="form-group">
									<label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention">*</b>商品名称：</label>
									<div class="col-sm-8">
										<input type="text" class="form-control money ui-input" name="name" placeholder="请输入商品名称" value="<?php echo $info['name'];?>">
									</div>
								</div>
                                <div class="form-group">
									<label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention">*</b>摧荐理由：</label>
									<div class="col-sm-8">
										<input type="text" class="form-control money ui-input" name="recommend" placeholder="请输入摧荐理由" value="<?php echo $info['recommend'];?>">
									</div>
								</div>
								<div class="form-group">
									<label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention">*</b>分类选择：</label>
									<div class="col-sm-8">
										<div class="clearfix" >
											<div class="clearfix fl" style="width:160px !important; ">
												<select class="form-control pid fl cid" name="cid" style="width:100%;display: inline-block;" <?php echo $info['cid']?'disabled="disabled"':'';?>>
													<option value="">请选择分类</option>
													<?php foreach($catlists as $k=>$v){?>
														<option value="<?php echo $v['id'];?>" <?php echo $v['id']==$info['cid']?"selected='selected'":'';?> ><?php echo $v['name'];?></option>
													<?php }?>
												</select>
											</div>							
										</div>
									</div>
								</div>
                                
                                
                                
                                <div class="catattrhtml">
                                    <?php foreach($attrlist as $key=>$val){?>
                                    <div class="form-group">
                                        <label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention">*</b><?php echo $val['name'];?>：</label>
                                        <div class="col-sm-8">
                                        	<?php foreach($val['attritems'] as $k=>$v){?>
                                            <input name="<?php echo 'attr'.$key.'[]';?>" type="checkbox" value="<?php echo $v['id'];?>"<?php echo in_array($v['id'],$gattriid)?' checked="checked"':'';?> /><?php echo $v['name'];?>　
                                            <?php }?>
                                        </div>
                                    </div>
                                    <?php }?>
								</div>
								<div class="form-group">
									<label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention">*</b>商品图片：</label>
									<div class="col-sm-8">
										<div class="m-storeset-column">
											<div class="m-storeset-title"></div>
											<ul class="add-uploadpic j-addpic ui-sortable" data-height="86" id="drag-images">
												<?php
												$picArr = json_decode(base64_decode($info['pic']),true);
												foreach($picArr as $k=>$v){
													?>
													<li title="0" class="ui-sortable-handle" style="display: block;">
														<input type="hidden" target="id" name="goodImgs[<?php echo $k;?>].id" value="<?php echo $k;?>">
														<input type="hidden" target="name" name="goodImgs[<?php echo $k;?>].position" value="<?php echo $k;?>">
														<input type="hidden" target="isCopyImg" name="goodImgs[<?php echo $k;?>].isCopyImg" value="1">
														<input type="hidden" target="path" name="goodImgs[<?php echo $k;?>].url" value="<?php echo $v;?>">
														<span class="delete_img" data-name="delete"></span>
														<div class="move_mkwz"> <img name="uploadImg" src="<?php echo $v;?>" alt="" data-src="img/lp/goods-1.jpg" class=""> <span class="action" style="z-index: 999; cursor: move; display: none;">按此处拖拽</span>
															<div style="display: none; position: absolute; overflow: hidden; margin: 0px; padding: 0px; opacity: 0; direction: ltr; z-index: 100; left: 0px; top: 0px; width: 98px; height: 98px; visibility: visible;">
																<input type="file" name="userfile" style="position: absolute; right: 0px; margin: 0px; padding: 0px; font-size: 480px; cursor: pointer;">
															</div>
														</div>
													</li>
												<?php }?>
											</ul>
											<ul class="add-uploadpic j-addpic" data-height="86" id="drag-adding" style="">
												<li class="addimg" data-id="5"><img name="adduploadImg" src="__IMG__/add100X100.jpg" alt="" class=""> </li>
												<input type="hidden" id="picpathvalid1" value="true" validate="{indexImageExits:true}">
											</ul>
										</div>
										<p class="picTip">提示：建议尺寸640*640像素，大小不能超过2M；您可拖动图片调整图片顺序。</p>
									</div>
								</div>
                                
								<div class="form-group">

									<label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention"></b>销售模式：</label>
									<div class="col-sm-3">
										<div style="padding-top: 8px;">
											<input type="radio" name="group" value="0" <?php echo (empty($info['group']) || $info['group'] == 0)?'checked="checked"':'';?> >普通 &nbsp; &nbsp;
											<input type="radio" name="group" value="1" <?php echo ($info['group'] == 1)?'checked="checked"':'';?> >拼购 &nbsp; &nbsp;
                                       </div>
									</div>

									<label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention"></b>状 态：</label>
									<div class="col-sm-3">
										<div style="padding-top: 8px;">
											<input type="radio" name="status" value="2" <?php echo ($info['status'] == 2)?'checked="checked"':'';?> >上架 &nbsp; &nbsp;
											<input type="radio" name="status" value="1" <?php echo (empty($info['id']) || $info['status'] == 1)?'checked="checked"':'';?> >下架 &nbsp; &nbsp;
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention">*</b>单　　位：</label>
									<div class="col-sm-3">
										<input class="form-control ui-input input-short-3" type="text" placeholder="输入单位" name="units" value="<?php echo $info['units'];?>">
									</div>
                                    <label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention">*</b>重量（克）：</label>
									<div class="col-sm-3">
										<input class="form-control ui-input input-short-3" type="text" placeholder="输入重量（克）" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" name="gnum" value="<?php echo $info['gnum']?$info['gnum']:1;?>">
									</div>
								</div>
                                <div class="form-group">
                                    <label for="bankcard" class="col-sm-2 control-label">权　　重：</label>
									<div class="col-sm-3">
										<input class="form-control ui-input input-short-2" type="text" placeholder="输入权重" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" name="weight" value="<?php echo $info['weight']?$info['weight']:0;?>">　大者居前
									</div>
								</div>
								<div class="form-group">
                                	<label for="bankcard" class="col-sm-2 control-label">&nbsp;</label>
									<div class="col-sm-8 text-left">
										<a class="btn btn-major btn-big saveBtn">下一步</a>
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

<script type="text/javascript">
var shopData;
function getsrt2(vid,arr1,data){
	console.dir(typeof vid);
	vid=Number(vid);
	var idvalue='';
	console.dir(idvalue);
	var str2 =	[ '<tr class="',vid,'">',
		'<td class="',arr1,'">',data,'</td>',
		'<td><div class="btn-upload"><input type="hidden" name="itemPath"><input type="hidden" name="propertyImgs['+vid+'].id" value=""><img name="itemFile"  src="../img/add100X100.jpg?ver=1111" style="width:100px;height:100px;" alt="" class="">',
		'<input type="hidden" name="propertyImgs['+vid+'].picturePath" value=""><input type="hidden" name="propertyImgs['+vid+'].propValueId" value="'+vid+'"></div></td>',
		'</tr>'
	].join("");
	return str2;
}

$(function(){
	$("img[name='uploadImg']").each(function(){
		imgUpload($(this));
	});
});

function getJson(){
	var name = $("[name='name']").val();
	var attachmentPaths=[];
	$("#j-addpic li").not('.addimg').find("img").each(function(index){
		attachmentPaths[index]=this.src;
	});
	var notkeyProperties = [];
	$(".j-tables tr").each(function(index){
		var notkeyProperty = {
			name:$(this).find("input[type='text']").eq(0).val(),
			value:$(this).find("input[type='text']").eq(1).val()
		};
		notkeyProperties[index]=notkeyProperty;
	});
	var marketPriceYuan = $("#marketPriceYuan").val();
	var salesPriceYuan = $("[name='salesPriceYuan']").val();
	var skuJson = shopData.getJson();
	var classificationId = $("#classificationId").val();
	var inventory = $("[name='inventory']").val();
	var goodDto = {
		classificationId:classificationId,
		name:name,
		marketPrice:marketPriceYuan*100,
		salesPrice:salesPriceYuan*100,
		goodContent:content,
		skuJson:skuJson,
		attachmentPaths:attachmentPaths,
		notkeyProperties:notkeyProperties,
		inventory:inventory
	};
	return JSON.stringify(goodDto);
}



var isSecKill = '0';
$(function(){
	moduleMove();
	findImg();
	mouseHover();
	$('body').find('img[name="adduploadImg"]').each(function(index){
		var _this=$(this);
		uploadimg($(this),true);

	});
	$('#change-select').on('change',function(){
		var attr = this.value;
		$('[data-name="'+attr+'"]').show().siblings('[data-name]').hide();
	});

	$(".add-uploadpic li").each(function(){
		var $link = $(this).find("[data-name='link']");
		if($link.length <= 0 ) return;
		var sCode = $(this).find('[name$="code"]').val(),
				isAllGoods = $(this).find('[name="isAllGoods"]').val(),
				dataId = "cylj";
		if (sCode) {
			if(sCode.indexOf('shopType') != -1 && sCode.indexOf('modular') == -1){ //回显
				dataId = "dpfl";
			} else if(sCode.indexOf('newsList') != -1 || sCode.indexOf('articleCategory') != -1 || sCode.indexOf('aricleColumn') != -1) {
				dataId = "wzlj";
			} else if(sCode.indexOf('album') != -1 || sCode.indexOf('photoAlbum') != -1){
				dataId = "xclj";
			} else if(sCode.indexOf('modular') != -1 || isAllGoods == 'true'){
				dataId = "cylj";
			} else if(sCode.indexOf('linkUrl') != -1){
				dataId = "zdylj";
			} else if(sCode.indexOf('appointment') != -1) {
				dataId = "cylj";
			} else if (isAllGoods == 'false' && sCode.indexOf('good') != -1) { //单个或者多个商品链接
				dataId = "splj";
			}
		}
		$link.attr('data-id', dataId);
	})
});

function uploadimg(uploadBtn,addTo){
	var url = "/good/upload.html";
	if(isSecKill == 1){
		$('img[name="adduploadImg"]').off().on("click",function(){
			toastTips(2, "限购活动期间，无法修改商品图文〜", "", 2000, false);
		})
		return;
	}
	new AjaxUpload(uploadBtn, {
		action: url,
		data: {
		},
		autoSubmit: true,
		responseType: 'json',
		onSubmit: function(file,ext){
			var imageSuffix = new RegExp('jpg|png|jpeg|JPG|PNG|JPEG');
			if (!(ext && imageSuffix.test(ext.toUpperCase()))){
				art.dialog.alert("请上传JPG/JPEG/PNG格式图片");
				return false;
			}

		},
		onComplete: function(file, response){
			if(response.code == -1){
				art.dialog.alert(response.desc);
				return ;
			}
			if(response.flag == "SUCCESS"){
				var src_path = response.source;
				if(addTo){
					var html = ''
							+'<li>'
							+'<input type="hidden" name=""/>'
							+'<input type="hidden" name="" value=""/>'
							+'<input type="hidden" name="" value=""/>'
							+'<input type="hidden" name="" value=""/>'
							+'<span class="delete_img" data-name="delete"></span>'
							+'<div class="move_mkwz">'
							+'  <img name="uploadImg" src="'+src_path+'" alt="">'
							+'  <span class="action">按此处拖拽</span>'
							+'</div>'
							+'</li>';
					var $li = $(html);
					var mk_li = $("#drag-images").find("li").length;
					$li.appendTo($("#drag-images"));
					if(mk_li>=0){
						$("label[for='picpathvalid1']").remove();
					}
					uploadimg($li.find('img'),false);
					initDragArea($li.find('img'));
					var eachinput = $li.find("input[type='hidden']");
					$(eachinput[0]).parent().attr("title",mk_li);
					$(eachinput[0]).attr("name","goodImgs["+ mk_li +"].id").attr("value",mk_li);
					$(eachinput[1]).attr("name","goodImgs["+ mk_li +"].position").attr("value",mk_li);
					$(eachinput[2]).attr("name","goodImgs["+ mk_li +"].isCopyImg").attr("value",1);
					$(eachinput[3]).attr("name","goodImgs["+ mk_li +"].url").attr("value",src_path);

					moduleMove();

				}else{
					$(uploadBtn).attr('src',src_path);
					//$(uploadBtn).prev().val(response.path);
					var thisinput = $(uploadBtn).parent().parent().find("input[type='hidden']");
					$(thisinput[6]).attr("value",response.path);
				}
				//mySubmit();

			} else {
				art.dialog.alert(response.info);
			}
		}
	});
}

//图片移除
function del(el){
	var $li = $(el).closest("li"),
			$img = $li.find('img'),
			$id = $li.find('input[name$="id"]'),
			$imgPath = $li.find('input[name$="imgPath"]'),
			$bindIds = $li.find('input[name$="bindIds"]'),
			$code = $li.find('input[name$="code"]'),
			$resourcePath = $li.find('input[name$="resourcePath"]'),
			$linkBtn = $(el).siblings("[data-name='link']"),
			id = $id.val();

	if(!id){
		$imgPath.val("");
		$bindIds.val("");
		$code.val("");
		$resourcePath.val("");
		$linkBtn.attr("data-id","cylj");
		$li.remove();
		$("#drag-adding").show();
		orderImg();
		return;
	}else{
		$id.val("");
		$imgPath.val("");
		$bindIds.val("");
		$code.val("");
		$resourcePath.val("");
		$linkBtn.attr("data-id","cylj");
		$li.remove();
		$("#drag-adding").show();
		orderImg();
	}
}

function moduleMove(){ //轮播图拖拽
	var images_len = $("#drag-images").find("li").length;
	var imageArr = [];

	//拖动文轮播图排序
	if(images_len > 1){
		$("#drag-images").sortable({
			helper: 'clone',
			opacity: 0.6,
			stop:function(e,ui){
				orderImg();
				//获取List然后请求保存在后台
				var liLists = $("#drag-images li");
				//console.log(liLists.length);
				for(var i = 0; i < liLists.length;i++){
					if(!liLists.eq(i).find("input").eq(0).val() == ""){
						var imageList = {};
						imageList.position = liLists.eq(i).find("input").eq(1).val();
						imageList.id = liLists.eq(i).find("input").eq(0).val();
						imageList.url = liLists.eq(i).find("input").eq(2).val();
						imageArr.push(imageList);
					}
				}
				var imageArr2 = JSON.stringify(imageArr);
				//console.log(imageArr2);
				var url = "/good/picorder.html";
				$.ajax({
					url:url,
					type:"post",
					data:{
						goodImgs:imageArr2
					},
					success:function (data) {
						imageArr = [];
						//console.log(data);
					},
					error:function(err){
//                            console.log(err);
					}
				})
			}
		});
	}
	if(images_len > 0 ||images_len < 8){
		$("#drag-adding").show();
	}
	if(images_len > 8){
		$("#drag-adding").hide();
	}
}

function mySubmit(){
	var form = document.getElementById("j-form"),img,_submit = false;
	for(var i=0;i<5;i++){
		var $img=form['goodImgs['+i+'].imgPath'];
		if($img){
			img = $img.value;
			if(img){
				_submit = true;
			}
		}
	}
	if(!_submit){
		location.reload();
		return;
	}
	$(".j-loading").show();
	$("#j-form").submit();
	art.dialog.tips('保存成功');
}
function findImg(){
	$('body').find('img[name="uploadImg"]').each(function(index){
		var _this=$(this);
		uploadimg($(this),false);
		initDragArea(_this);
	});
}
function initDragArea($img){
	$img.siblings('span').css('z-index',999);
	$img.parents('li').find(".delete_img").on("click",function(){
		/*if(isSecKill == 1){
		 toastTips(2, "限购活动期间，无法修改商品图文〜", "", 2000, false);
		 return;
		 }*/
		art.dialog.confirm('确定要删除此图片吗？', function() {
			del($img[0]);
		}, function() {
			return true;
		});
	});
	$img.parents('li').find(".handle").on("click",function(){
		// addPro($img);
		manageLink($img);
		if($($img).attr("data-id")){
			tapWeblist($img);
		}else{
			var thiz = $img.parent().parent().find("span a");
			tapWeblist(thiz);
		}
		$('.action').css('z-index',999);
	});
}
function mouseHover(){
	$("#drag-images").on('mouseover', '.move_mkwz', function(){
		$(this).find(".action").css("cursor","move").show();
		$(this).find("div").hide();
	});
	$("#drag-images").on('mouseout', '.move_mkwz', function(){
		$(this).find(".action").hide();
	});
}
function orderImg(){
	var lis = $('#drag-images').find('li');
	for(var i = 0; i < lis.length; i++){
		var eachinput = $(lis[i]).find('input[type="hidden"]');
		$(lis).eq(i).attr("title",i);
		$(eachinput[0]).attr("name","goodImgs["+ i +"].id");
		$(eachinput[1]).attr("name","goodImgs["+ i +"].position").attr("value",i);
		$(eachinput[2]).attr("name","goodImgs["+ i +"].isCopyImg");
		$(eachinput[3]).attr("name","goodImgs["+ i +"].url");
	}

}






$(function(){
    menuleft("archex");
	
	$('.cid').change(function(){
		var cid = $(this).val();
		if(cid>0){
			$.post("/good/catattr.html", 
				{cid:cid,i:Math.random()},
				function(data){
					if (data.status == 200) {
						$('.catattrhtml').html(data.html);
						//window.location.href = '/good/edit2.html?objNo='+data.gno;
					} else {
						art.dialog.alert(data.msg);
					}
				});
		}
	  
	});

	$('.saveBtn').click(function(){

		var flag = $('#objForm').validate({
					rules:{
						name:{required:true},
						recommend:{required:true},
						cid:{required:true}
					},
					messages:{
						name:{required:'请输入商品名称'},
						recommend:{required:'请输入摧荐理由'},
						cid:{required:'请选择分类'}
					}
				}).form();
		if(flag){
			var objNo = parseInt($('#objNo').val());
			$(".cid").removeAttr("disabled");
			$.post("/good/save.html", $('#objForm').serialize(),
				function(data){
					if (data.status == 200) {
						window.location.href = '/good/edit2.html?objNo='+data.gno;
					} else {
						if(objNo){
							$(".cid").attr("disabled","disabled");
						}
						art.dialog.alert(data.msg);
					}
				});
			return true;
		}else{
			return false;
		}
	})
});
</script>
{include file="common/ufooter" /}