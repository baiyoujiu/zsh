{include file="common/header" /}
<!--收货地址-->
<section class="shouhuo_dizhi">
    <section class="dd_home">
        <h2 class="fanhui_head"><a href="javascript:history.back(-1);"><i class="icon-left"></i></a>收货地址</h2>
    </section>
    <section>
        <ul class="shdz_lists">
            <?php foreach($lists as $v){?>
            <li>
                <div class="shdz_list_user clearfix">
                    <span class="fl"><?php echo $v['recname'];?></span>
                    <p class="fl"><?php echo decryptd($v['phone']);?></p>
                    <em class="fr adredit" data-no="<?php echo $v['ano'];?>" data-p="<?php echo decryptd($v['phone']);?>" data-n="<?php echo $v['recname'];?>" data-adr="<?php echo $v['address'];?>" data-area="<?php echo $v['area'];?>" data-school="<?php echo $v['school'];?>" data-stage="<?php echo $v['school']?$stagels[$v['address']]['area']:'';?>" data-sadress="<?php echo $v['school']?$stagels[$v['address']]['address']:'';?>" data-pic="<?php echo $v['school']?$stagels[$v['address']]['pic']:'';?>">编辑</em>
                </div>
                <div class="shdz_list_dz">
                    <p><?php echo $arealist[$v['province']].$arealist[$v['city']].$arealist[$v['area']].' '.($v['school']?'<b>'.$stagels[$v['address']]['area'].'</b><br>('.$stagels[$v['address']]['address'].')':$arealist[$v['street']].$v['address']);?></p>
                </div>
                <div class="clearfix shdz_list_btns">
                    <p class="clearfix fl" data-no="<?php echo $v['ano'];?>">
                        <label>
                            <input class="fl adrflg" type="radio" name="dizhi"<?php echo $v['flg']?' checked':'';?>/>
                            <i class="fl">设置为默认地址</i>
                        </label>
                    </p>
                    <span class="fr clearfix" data-no="<?php echo $v['ano'];?>">
                        <img class="fl" src="__IMG__/shanchu.png" />
                        <i class="fl">删除</i>
                    </span>
                </div>
            </li>
            <?php }?>
            
        </ul>
        <div class="add_dizhi">
            <span class="addbtn">添加新地址</span>
        </div>
    </section>
</section>
<!--新增地址-->
<section class="xinzeng_dizhi" style="display:none;">
    <section class="dd_home">
        <h2 class="fanhui_head"><i class="icon-left"></i><span id="adrtitle">新增收货地址</span></h2>
    </section>
    <section>
        <form id="objform">
        <input name="ano" type="hidden" id="ano" value=""/>
        <ul class="add_dizhi_lists">
            <p>地址信息</p>
            <li>
                <input type="text" name="recname" class="recname" placeholder="收货人"/>
            </li>
            <li>
                <input type="text" name="phone" class="phone" placeholder="收货人手机号码"/>
            </li>
            <li class="right">
                <div class="fl add_address_list_sec">
                  <select class="pro_code" >
                    <option value="">浙江省杭州市</option>
                  </select>
                </div>
                <div class="add_address_list_sec fl">
                  <select class="areacode" name="area" >
                    <option value="">请选择区/县</option>
                    <?php foreach($alists as $k=>$v){?>
                      <option value="<?php echo $v['code'];?>"><?php echo $v['area'];?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="add_address_list_sec fl">
                  <select class="stcode" name="street">
                    <option value="">街道/镇</option>
                  </select>
                </div>
                
              </li>
              <li class="right">
                <div class="add_address_list_sec fl">
                  <select class="sccode" name="sccode">
                    <option value="0">非驿站地址</option>
                  </select>
                </div>
              </li>
            <li>
                <input type="text" name="address" class="input" id="address" placeholder="请输入详细地址">
            </li>
            <li>
                <div class="mapshow" data-lon="" data-lat="" data-area="" data-address="" data-pic="">
                  <span class="adrinf"></span>
                  <span class="fr">　<i class="icon-location"></i>地图</span>
                </div>
            </li>
        </ul>
        </form>
        <div id="mapinf">
        <img src="/images/stages/zjyz1001.png" />
        </div>
        <div class="add_dizhi">
            <span id="savebtn">保存</span>
        </div>
    </section>
    <!--选择地址-->
    
</section>

<script>
$('#mapinf').hide();$('.mapshow').hide();


	$(function(){
		$('.shdz_lists li .shdz_list_btns span').click(function(){
			var ano = $.trim($(this).data('no')),obj=$(this);
			
			layer.open({
				content: '您确定要删除该地址吗？'
				,btn: ['确定', '取消']
				,yes: function(index){
				  layer.close(index);
				  console.log(ano);
				  if(ano==''){return false;}
				  obj.parent('.shdz_list_btns').parent('li').remove();
				  $.ajax({ 
						type:"POST", 
						async:false, 
						url:"/api/adrdel.html",
						dataType: "json",
						data:{ano:ano,i:Math.random()},
						success:function(result){
							if(result.status != 200){
								layer.open({skin:'msg',content: result.msg,time:2});
							}
						},
						error:function(XMLHttpRequest, textStatus, errorThrown){
							layer.open({skin:'msg',content:'网络异常，请稍后重试！',time:2});
						}	
					});
				}
			});
		});
		$('.shdz_lists li .shdz_list_btns p').click(function(){
			var ano = $.trim($(this).data('no'));
			if(ano == ''){return false;}
			$.ajax({ 
					type:"POST", 
					async:false, 
					url:"/api/adrflg.html",
					dataType: "json",
					data:{ano:ano,i:Math.random()},
					success:function(result){
						if(result.status != 200){
							layer.open({skin:'msg',content: result.msg,time:2});
						}
					},
					error:function(XMLHttpRequest, textStatus, errorThrown){
						layer.open({skin:'msg',content:'网络异常，请稍后重试！',time:2});
					}	
			});
		});
		/*新增地址显示*/
		$('.addbtn').click(function(){
			$('#adrtitle').html('新增收货地址');
			
			$('.recname').val('');
			$('.phone').val('');
			$('.areacode').val('');
			$('.stcode').empty();
			$('.stcode').html('<option value="">街道/镇</option>');
			$('.sccode').empty();
			$('.sccode').html('<option value="0">非驿站地址</option>');
			$('#address').val('');	
			$('#address').show();
			
			
			$('.xinzeng_dizhi').show();
			$('.shouhuo_dizhi').hide();
			
			$('#mapinf').hide();$('.mapshow').hide();
		});
		/*新增地址隐藏*/
		$('.xinzeng_dizhi .icon-left').click(function(){
			$('.xinzeng_dizhi').hide();
			$('.shouhuo_dizhi').show();
		});
		$('.adredit').click(function(){
			$('#adrtitle').html('编辑收货地址')
			$('.xinzeng_dizhi').show();
			$('.shouhuo_dizhi').hide();
			$('#mapinf').hide();
			
			$('.recname').val($(this).data('n'));
			$('.phone').val($(this).data('p'));
			$('.areacode').val($(this).data('area'));
			
			var ano = $.trim($(this).data('no')),school=parseInt($(this).data('school'));
			$('#ano').val(ano);
			if(school<1){
				$('#address').show();
				$('#address').val($(this).data('adr'));	
				
				$('.mapshow').hide();
				$('#mapinf').hide();
			}else{
				$('#address').hide();
				$('#address').val('');	
				
				$('.mapshow').data('lon',$(this).data('longitude'));
			    $('.mapshow').data('lat',$(this).data('latitude'));
			
			    $('.mapshow').data('area',$(this).data('stage'));
				$('.mapshow').data('address',$(this).data('sadress'));
				$('.adrinf').html($(this).data('sadress'));
				
				$('.mapshow').show();
				$('#mapinf img').attr('src',$(this).data('pic'));
				$('#mapinf').show();
			}
			$.ajax({ 
					type:"POST", 
					async:false, 
					url:"/api/adred.html",
					dataType: "json",
					data:{ano:ano,i:Math.random()},
					success:function(result){
						if(result.status == 200){
							var sthtml='<option value="">街道/镇</option>',schtml='<option value="0">非驿站地址</option>';
							sthtml += result.sthtml;
							schtml += result.schtml;
							$('.stcode').empty();
							$('.stcode').html(sthtml);
							$('.sccode').empty();
							$('.sccode').html(schtml);
						}else{
							layer.open({skin:'msg',content: result.msg,time:2});
						}
					},
					error:function(XMLHttpRequest, textStatus, errorThrown){
						layer.open({skin:'msg',content:'网络异常，请稍后重试！',time:2});
					}	
			});
		});
	});
	

	$(".areacode").change(function () {
		var code = parseInt($(this).val());
		if(code<1){
			return false;
		}
		$.ajax({
			url:'/api/getchildarea.html',
			cache: false,
			data: {code:code,i:Math.random()},
			type: 'post',
			dataType: 'json',
			success: function (data) {
			  if (data.status == 200) {
				$('.mapshow').hide();
				$('#address').show();
				var stcode = '<option value="">街道/镇</option>',sccode = '<option value="0">非驿站地址</option>';
				stcode += data.html;
				$('.stcode').empty();
				$('.stcode').html(stcode);
				
				sccode += data.schtml;
				$('.sccode').empty();
				$('.sccode').html(sccode);
				
				$('#mapinf').hide();
			  }
			}
		});
	});
	
	$(".sccode").change(function () {
		var code = parseInt($(this).val());
		if(code<1){
			$('#address').show();
			$('.mapshow').hide();
			$('#mapinf').hide();
		}else{
			$('#address').hide();
			var adsites = $(".sccode option:selected");
			$('.adrinf').html(adsites.attr('inf'));
			$('.mapshow').show();
			$('#mapinf img').attr('src',adsites.attr('pic'));
			$('#mapinf').show();
		}
	});
	
	$('#savebtn').click(function(){
		$.ajax({ 
			type:"POST", 
			async:false, 
			url:"/api/adrsave.html",
			dataType: "json",
			data:$("#objform").serialize(),
			success:function(result){
				if(result.status == 200){
					layer.open({skin:'msg',content: result.msg,time:1,end:function(){window.location.reload();}});
				}else{
					layer.open({skin:'msg',content: result.msg,time:2});
				}
			},
			error:function(XMLHttpRequest, textStatus, errorThrown){
				layer.open({skin:'msg',content:'网络异常，请稍后重试！',time:2});
			}	
		});
	});
	
</script>        
	</body>
</html>
