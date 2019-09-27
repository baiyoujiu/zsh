{include file="common/uheader" /}
<style>
	.box {border-top: none;}
	input {border:1px solid #dfdfdf!important;}
	form label.error {display:inline;}
	.clearfix:before,.clearfix:after {content:"";display:table;}
	.clearfix:after {clear:both;overflow:hidden;}
	.clearfix {zoom:1; }
	.clear {clear:both;display:block;font-size:0;height:0;line-height:0;overflow:hidden;}
	.hide {display:none;}
	.block {display:block;}
	.fl {float:left;}
	.fr {float:right;}
	.spect{width:20%; text-align:center;}
	.spect1{width:17%; text-align:center;}
	.spect2{width:13%; text-align:center;}
	.specv1{width:19%; text-align:center; line-height:34px; border:1px solid #ededed;}
	.gspc{width:13%; margin:0 1% 10px;}
	.gspecv{width:15%; margin:0 1% 10px;}
	.gspecv2{width:11%; margin:0 1% 10px;}
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
                        <li><a href="#"><?php echo $info?'编辑':'添加';?>商品规格</a></li>
                      </ul>
					<div class="content">
						<div class="form-horizontal bank-card-new">
							<form class="form-horizontal withdraw-form" role="form" id="objForm" method="post">
                                <input type="hidden" name="gno" value="<?php echo $info['gno'];?>">

								<?php foreach($cslist as $key=>$val){?>
								<!--商品规格:年份-->
								<div class="form-group clearfix">
									<label for="bankcard" class="fl col-sm-2 control-label"><?php echo $val['name'];?>：</label>
									<div class="col-sm-8 clearfix fl" >
										<ul class="fl gcsi<?php echo $key;?>" style="width:98%;">
											<li class="clearfix">
												<?php for($i=0; $i<5; $i++){?>
                                                <input name="gcsiv<?php echo $key;?>[]" class="form-control ui-input input-short-5 fl gspc gcsiv<?php echo $i;?>" type="text" value="<?php echo $csilist[$val['id']][$i]['name'];?>">
                                                <?php }?>
											</li>
											<li class="clearfix">
												<?php for($i=5; $i<10; $i++){?>
                                                <input name="gcsiv<?php echo $key;?>[]" class="form-control ui-input input-short-5 fl gspc gcsiv<?php echo $i;?>" type="text" value="<?php echo $csilist[$val['id']][$i]['name'];?>">
                                                <?php }?>
											</li>
										</ul>
									</div>
								</div>
                                <?php }?>
                                <div class="form-group">
									<label for="bankcard" class="col-sm-2 control-label">&nbsp;</label>
									<div class="col-sm-8 fr">
                                        <input id="getspecbtn" type="button" value="生成规格" />
									</div>
								</div>
								<!--商品规格价格-->
								<div class="form-group clearfix">
									<label for="bankcard" class="fl col-sm-2 control-label">商品规格：</label>
									<div class="col-sm-8 clearfix fl" >
										<ul class="fl" style="width:90%;">
                                        	<li class="clearfix">
                                            	<span class="fl spect">规格</span>
                                                <span class="fl <?php echo $info['group']?'spect2':'spect1';?>">市价</span>
                                                <span class="fl <?php echo $info['group']?'spect2':'spect1';?>">售价</span>
                                                <?php echo $info['group']?'<span class="fl spect2">拼团价</span>':'';?>
                                                <span class="fl <?php echo $info['group']?'spect2':'spect1';?>">数量</span>
                                                <span class="fl <?php echo $info['group']?'spect2':'spect1';?>">SKU</span>
                                            </li>
                                            <li class="clearfix">
												<i class="fl specv1" style="border:0px;">&nbsp;</i>
												<input class="form-control ui-input input-short-5 fl <?php echo $info['group']?'gspecv2':'gspecv';?> gspecdmp" type="number">
                                                <input class="form-control ui-input input-short-5 fl <?php echo $info['group']?'gspecv2':'gspecv';?> gspecdp" type="number">
                                                <?php echo $info['group']?'<input class="form-control ui-input input-short-5 fl gspecv2 gspecdgp" type="number">':'';?>
                                                <input class="form-control ui-input input-short-5 fl <?php echo $info['group']?'gspecv2':'gspecv';?> gspecdm" type="number">
                                                <input class="form-control ui-input input-short-5 fl <?php echo $info['group']?'gspecv2':'gspecv';?> gspecdsku" type="text">
                                                <input id="gspecibtn" type="button" value="批量插入" />
											</li>
                                         </ul>
                                         <ul class="fl" style="width:90%;" id="specitemv">
											<?php foreach($gsplist as $v){?>
                                            <?php $groupclass = $info['group']?'gspecv2':'gspecv';?>
                                            <li class="clearfix">
												<i class="fl specv1"><?php echo $v['key_name'];?></i>
                                                <input type="hidden" name="key[]" value="<?php echo $v['key'];?>">
                                                <input type="hidden" name="key_name[]" value="<?php echo $v['key_name'];?>">
												<input name="market_price[]" class="form-control ui-input input-short-5 fl <?php echo $groupclass;?> gspecvmp" type="number" value="<?php echo $v['market_price']/100;?>">
                                                <input name="price[]" class="form-control ui-input input-short-5 fl <?php echo $groupclass;?> gspecvp" type="number" value="<?php echo $v['price']/100;?>">
                                                <?php if($info['group']){?>
                                                <input name="gprice[]" class="form-control ui-input input-short-5 fl <?php echo $groupclass;?> gspecvgp" type="number" value="<?php echo $v['gprice']/100;?>">
                                                <?php }?>
                                                <input name="num[]" class="form-control ui-input input-short-5 fl <?php echo $groupclass;?> gspecvm" type="number" value="<?php echo $v['num'];?>">
                                                <input name="sku[]" class="form-control ui-input input-short-5 fl <?php echo $groupclass;?> gspecvsku" type="text" value="<?php echo $v['sku'];?>">
											</li>
											<?php }?>
										</ul>
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


<script type="text/javascript">
//规格长度
var gpacnum = <?php echo count($cslist);?>,ggroup = <?php echo $info['group'];?>;

//生成规格
$('#getspecbtn').click(function(){
	var gcsiv0 = $.trim($('.gcsi0 .gcsiv0').val());
	var gcsiv1 = $.trim($('.gcsi1 .gcsiv0').val());
	var gcsiv2 = $.trim($('.gcsi2 .gcsiv0').val());
	
	//console.log(gcsiv0+'>>'+gcsiv2);
	if((gpacnum==1 && gcsiv0)||(gpacnum==2 && gcsiv0 && gcsiv1)||(gpacnum==3 && gcsiv0 && gcsiv1 && gcsiv2)){
		console.log('ok');
		
		//生成规格值
		gspecitems()
		//if($.trim(gcsiv0) && )
	}else{
		art.dialog.alert('所有规格均需有值');
	}
})
//生成规格价格
function gspecitems(){
	console.log(gpacnum)
	var gcsiv0 = new Array();gcsiv1 = new Array();gcsiv2 = new Array();
	for (i = 0; i < 10; i++) {
		ogcsiv = $.trim($('.gcsi0 .gcsiv'+i).val());
		if(ogcsiv){
			gcsiv0[i] = ogcsiv;
		}else{
			break;
		}
	}
    if(gpacnum==2){
		for (i = 0; i < 10; i++) {
			ogcsiv = $.trim($('.gcsi1 .gcsiv'+i).val());
			if(ogcsiv){
				gcsiv1[i] = ogcsiv;
			}else{
				break;
			}
		}
	}
	if(gpacnum==3){
		for (i = 0; i < 10; i++) {
			ogcsiv = $.trim($('.gcsi2 .gcsiv'+i).val());
			if(ogcsiv){
				gcsiv2[i] = ogcsiv;
			}else{
				break;
			}
		}
	}
	console.log(gcsiv0+'>>'+gcsiv1);
	specitemvstr = '';
	for (i = 0; i < gcsiv0.length; i++) {
		if(gpacnum==1){
			if(ggroup<1){
				specitemvstr += '<li class="clearfix"><i class="fl specv1">'+gcsiv0[i]+'</i><input type="hidden" name="key[]" value="'+i+'"><input type="hidden" name="key_name[]" value="'+gcsiv0[i]+'"><input name="market_price[]" class="form-control ui-input input-short-5 fl gspecv gspecvmp" type="number"><input name="price[]" class="form-control ui-input input-short-5 fl gspecv gspecvp" type="number"><input name="num[]" class="form-control ui-input input-short-5 fl gspecv gspecvm" type="number"><input name="sku[]" class="form-control ui-input input-short-5 fl gspecv gspecvsku" type="text"></li>';
			}else{
				specitemvstr += '<li class="clearfix"><i class="fl specv1">'+gcsiv0[i]+'</i><input type="hidden" name="key[]" value="'+i+'"><input type="hidden" name="key_name[]" value="'+gcsiv0[i]+'"><input name="market_price[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvmp" type="number"><input name="price[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvp" type="number"><input name="gprice[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvgp" type="number"><input name="num[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvm" type="number"><input name="sku[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvsku" type="text"></li>';
			}
		}else if(gpacnum==2){
			for (ii = 0; ii < gcsiv1.length; ii++) {
				if(ggroup<1){
					specitemvstr += '<li class="clearfix"><i class="fl specv1">'+gcsiv0[i]+'　'+gcsiv1[ii]+'</i><input type="hidden" name="key[]" value="'+i+'|'+ii+'"><input type="hidden" name="key_name[]" value="'+gcsiv0[i]+'　'+gcsiv1[ii]+'"><input name="market_price[]" class="form-control ui-input input-short-5 fl gspecv gspecvmp" type="number"><input name="price[]" class="form-control ui-input input-short-5 fl gspecv gspecvp" type="number"><input name="num[]" class="form-control ui-input input-short-5 fl gspecv gspecvm" type="number"><input name="sku[]" class="form-control ui-input input-short-5 fl gspecv gspecvsku" type="text"></li>';
				}else{
					specitemvstr += '<li class="clearfix"><i class="fl specv1">'+gcsiv0[i]+'　'+gcsiv1[ii]+'</i><input type="hidden" name="key[]" value="'+i+'|'+ii+'"><input type="hidden" name="key_name[]" value="'+gcsiv0[i]+'　'+gcsiv1[ii]+'"><input name="market_price[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvmp" type="number"><input name="price[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvp" type="number"><input name="gprice[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvgp" type="number"><input name="num[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvm" type="number"><input name="sku[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvsku" type="text"></li>';
				}
			}
		}else if(gpacnum==3){
			for (ii = 0; ii < gcsiv1.length; ii++) {
				for (iii = 0; iii < gcsiv1.length; iii++) {
					if(ggroup<1){
						specitemvstr += '<li class="clearfix"><i class="fl specv1">'+gcsiv0[i]+'　'+gcsiv1[ii]+'　'+gcsiv2[iii]+'</i><input type="hidden" name="key[]" value="'+i+'|'+ii+'|'+gcsiv2[iii]+'"><input type="hidden" name="key_name[]" value="'+gcsiv0[i]+'　'+gcsiv1[ii]+'　'+gcsiv2[iii]+'"><input name="market_price[]" class="form-control ui-input input-short-5 fl gspecv gspecvmp" type="number"><input name="price[]" class="form-control ui-input input-short-5 fl gspecv gspecvp" type="number"><input name="num[]" class="form-control ui-input input-short-5 fl gspecv gspecvm" type="number"><input name="sku[]" class="form-control ui-input input-short-5 fl gspecv gspecvsku" type="text"></li>';
					}else{
						specitemvstr += '<li class="clearfix"><i class="fl specv1">'+gcsiv0[i]+'　'+gcsiv1[ii]+'　'+gcsiv2[iii]+'</i><input type="hidden" name="key[]" value="'+i+'|'+ii+'|'+gcsiv2[iii]+'"><input type="hidden" name="key_name[]" value="'+gcsiv0[i]+'　'+gcsiv1[ii]+'　'+gcsiv2[iii]+'"><input name="market_price[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvmp" type="number"><input name="price[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvp" type="number"><input name="gprice[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvgp" type="number"><input name="num[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvm" type="number"><input name="sku[]" class="form-control ui-input input-short-5 fl gspecv2 gspecvsku" type="text"></li>';
					}
				}
			}
		}
	}
	$('#specitemv').html(specitemvstr);
	
	
	//$("input[name='gcsiv0']").each(function(){  var a = $(this).val();console.log('888');});
}

//批量添加
$('#gspecibtn').click(function(){
	var gspecdmp = $.trim($('.gspecdmp').val()),gspecdp = $.trim($('.gspecdp').val()),gspecdgp = $.trim($('.gspecdgp').val()),gspecdm = $.trim($('.gspecdm').val()),gspecdsku = $.trim($('.gspecdsku').val());
	$('.gspecvmp').val(gspecdmp);
	$('.gspecvp').val(gspecdp);
	$('.gspecvgp').val(gspecdgp);
	$('.gspecvm').val(gspecdm);
	$('.gspecvsku').val(gspecdsku);
})


$(function(){
	menutop("websys");
    menuleft("archex");

	$('.saveBtn').click(function(){
		$.post("/good/savep.html", $('#objForm').serialize(),
			function(data){
				if (data.status == 200) {
					$('.saveBtn').attr('disabled',true);
					window.location.href = '/good/edit3.html?objNo='+data.gno;
				} else {
					art.dialog.alert(data.msg);
				}
			});
	})
});
</script>
{include file="common/ufooter" /}