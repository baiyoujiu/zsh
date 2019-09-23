<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:34:"../template/mallm/uinf\address.php";i:1568771936;s:49:"D:\wamp\work\zsh\template\mallm\common\header.php";i:1567558230;}*/ ?>
<!DOCTYPE html><html><head><meta name="apple-mobile-web-app-capable" content="yes"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="content-language" content="zh-CN" /><meta name="viewport" content="width=device-width,minimum-scale=1.00001,maximum-scale=1.00001,initial-scale=2.0,user-scalable=no"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta content="telephone=no" name="format-detection"><meta name="applicable-device"content="mobile"><meta name="MobileOptimized" content="320"><meta name="x5-orientation" content="portrait"><meta name="x5-fullscreen" content="true"><meta name="full-screen" content="yes"><meta name="browsermode" content="application"><meta name="x5-page-mode" content="app"><meta name="msapplication-tap-highlight" content="no"><meta name="format-detection" content="email=no" /><title><?php echo $webseo['title'];?></title><link rel="shortcut icon" type="image/x-icon" href="__IMG__/icon.ico" /><meta name="keywords" content="<?php echo $webseo['keywords'];?>" /><meta name="description" content="<?php echo $webseo['description'];?>" /><meta property="og:type" content="website" /><meta property="og:site_name" content="<?php echo $webseo['title'];?>"><meta property="og:title" content="<?php echo $webseo['title'];?>"><meta property="og:description" content="<?php echo $webseo['description'];?>"><meta property="og:url" content="<?php echo request()->url(true);?>"><link rel="stylesheet" type="text/css" href="__CSS__/base.css" /><link rel="stylesheet" type="text/css" href="__CSS__/icon.css" /><link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css"><link rel="stylesheet" type="text/css" href="__CSS__/ds_phone.css" /><script type="text/javascript" src="__JS__/swiper.min.js"></script><script type="text/javascript" src="__JS__/layer/layer.js" ></script><script type="text/javascript" src="__JS__/jquery-1.11.1.min.js" ></script><script type="text/javascript" src="__JS__/jquery.lazyload.js" ></script><script type="text/javascript" src="__JS__/common.js" ></script><script type="text/javascript">var rem = 20/640*document.documentElement.clientWidth;document.documentElement.style.fontSize = rem+'px';window.onload=window.onresize=function(){ var rem = 20/640*document.documentElement.clientWidth;
document.documentElement.style.fontSize = rem+'px';}</script></head><body><img style="display:none;" src="__IMG__/icon.png">
<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=xqltRQVqD5bh1G3NPyyQpuuTlgaYv4GR"></script>
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
                    <p class="fl"><?php echo $v['phone'];?></p>
                    <em class="fr adredit" data-no="<?php echo $v['ano'];?>" data-p="<?php echo $v['phone'];?>" data-n="<?php echo $v['recname'];?>" data-adr="<?php echo $v['address'];?>" data-area="<?php echo $v['area'];?>" data-school="<?php echo $v['school'];?>" data-stage="<?php echo $v['school']?$stagels[$v['address']]['area']:'';?>" data-sadress="<?php echo $v['school']?$stagels[$v['address']]['address']:'';?>" data-longitude="<?php echo $v['school']?$stagels[$v['address']]['longitude']:'';?>" data-latitude="<?php echo $v['school']?$stagels[$v['address']]['latitude']:'';?>">编辑</em>
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
                    <option value="0">其它地址</option>
                  </select>
                </div>
              </li>
            <li>
                <input type="text" name="address" class="input" id="address" placeholder="请输入详细地址">
            </li>
            <li>
                <div class="mapshow" data-lon="" data-lat="" data-area="" data-address="" data-pic="">
                  <span class="adrinf"></span>
                  <span>　<i class="icon-location"></i>地图</span>
                  <i class="fr icon-down"></i>
                </div>
            </li>
        </ul>
        </form>
        <div class="mapinf" id="mapinf">
        </div>
        <div class="add_dizhi">
            <span id="savebtn">保存</span>
        </div>
    </section>
    <!--选择地址-->
    
</section>

<script>
$('.mapinf').hide();$('.mapshow').hide();


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
			$('.sccode').html('<option value="0">其它地址</option>');
			$('#address').val('');	
			$('#address').show();
			
			
			$('.xinzeng_dizhi').show();
			$('.shouhuo_dizhi').hide();
			
			$('.mapinf').hide();$('.mapshow').hide();
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
			$('.mapinf').hide();
			
			$('.recname').val($(this).data('n'));
			$('.phone').val($(this).data('p'));
			$('.areacode').val($(this).data('area'));
			
			var ano = $.trim($(this).data('no')),school=parseInt($(this).data('school'));
			$('#ano').val(ano);
			if(school<1){
				$('#address').show();
				$('#address').val($(this).data('adr'));	
				
				$('.mapshow').hide();
			}else{
				$('#address').hide();
				$('#address').val('');	
				
				$('.mapshow').data('lon',$(this).data('longitude'));
			    $('.mapshow').data('lat',$(this).data('latitude'));
			
			    $('.mapshow').data('area',$(this).data('stage'));
				$('.mapshow').data('address',$(this).data('sadress'));
				$('.adrinf').html($(this).data('sadress'));
				
				$('.mapshow').show();
			}
			$.ajax({ 
					type:"POST", 
					async:false, 
					url:"/api/adred.html",
					dataType: "json",
					data:{ano:ano,i:Math.random()},
					success:function(result){
						if(result.status == 200){
							var sthtml='<option value="">街道/镇</option>',schtml='<option value="0">其它地址</option>';
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
				var stcode = '<option value="">街道/镇</option>',sccode = '<option value="0">其它地址</option>';
				stcode += data.html;
				$('.stcode').empty();
				$('.stcode').html(stcode);
				
				sccode += data.schtml;
				$('.sccode').empty();
				$('.sccode').html(sccode);
			  }
			}
		});
	});
	
	$(".sccode").change(function () {
		var code = parseInt($(this).val());
		if(code<1){
			$('#address').show();
			$('.mapshow').hide();
		}else{
			$('#address').hide();
			$('.mapshow').show();
			var adsites = $(".sccode option:selected");
			$('.adrinf').html(adsites.attr('inf'));
			$('.mapshow').data('lon',adsites.attr('longitude'));
			$('.mapshow').data('lat',adsites.attr('latitude'));
			
			$('.mapshow').data('area',adsites.text());
			$('.mapshow').data('address',adsites.attr('inf'));
			$('.mapshow').data('pic',adsites.attr('pic'));
			
			$('.mapinf').hide();
		}
	});
	$('.mapshow').click(function(){
		$('.mapinf').toggle();
		if($(this).find('.icon-down')){
			$(this).find('.icon-down').removeClass('icon-down').addClass('icon-up');
		}else{
			$(this).find('.icon-up').removeClass('icon-up').addClass('icon-down');
		}
		var longitude=$(this).data('lon'),latitude=$(this).data('lat'),area = $('.mapshow').data('area'),address = $('.mapshow').data('address');
	
		var map = new BMap.Map("mapinf");            
		map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
		map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用 
		
		point = new BMap.Point(longitude,latitude);
		map.centerAndZoom(point,17);  
		var marker = new BMap.Marker(point);// 创建标注
		map.addOverlay(marker);             // 将标注添加到地图中
		var opts = {
		  width : 200,     // 信息窗口宽度
		  height: 90,     // 信息窗口高度
		  title : area , // 信息窗口标题
		}
		var infoWindow = new BMap.InfoWindow(address+'<br>驿站图书租还时间(9:00—17:30)', opts);  // 创建信息窗口对象
		map.openInfoWindow(infoWindow,point); //开启信息窗口 
		marker.addEventListener("click", function(){          
			map.openInfoWindow(infoWindow,point); //开启信息窗口
		});
	})
	
	
	
	
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
