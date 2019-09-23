<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:36:"../template/mcenter/system\stage.php";i:1567996793;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1568967277;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
<!DOCTYPE html>
<!-- saved from url=(0032)http://www.o2osl.com/u/index.htm -->
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>运营管理中心</title>
<meta name="keywords" content="运营管理中心">
<meta name="Description" content="运营管理中心">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="shortcut icon" href="__IMG__/icon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="__CSS__/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="__CSS__/validate.css">
<link rel="stylesheet" type="text/css" href="__CSS__/main.css">

<!-- 公共JS -->
<script type="text/javascript" src="__STATIC__/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__JS__/jquery.artDialog.js"></script>
<script type="text/javascript" src="__JS__/jquery.validate.js"></script>
<script type="text/javascript" src="__JS__/iframeTools.js"></script>
<script type="text/javascript" src="__JS__/ui-dialog.js"></script>
<script type="text/javascript" src="__JS__/common.js"></script>
<!--top end -->
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css">
</head>
<body>
    <div class="header">
      <div class="container">
        <div class="row">
          <div class="indexheader_l"> <a href="http://<?php echo request()->host();?>"> <img class="indexheader_logo" src="__IMG__/logo.png" alt="运营管理中心"></a> </div>
          <div class="indexheader_r">
          </div>
          <div class="indexheader_user">
           <span id="headerNameSpan"><?php echo $userInfo['user_name'];?></span>  <a href="javascript:logout();">【安全退出】</a>
          </div>
        </div>
      </div>
    </div>
    
<!--    <div class="rightCorner rightCornerSingle">-->
<!--      <div class="rightCornerNotice"> <a href="http://www.o2osl.com/u/noticeMessageList.htm" target="_blank"> <i class="iconfont icon-gonggao"></i> <span>公告</span> </a> </div>-->
<!--    </div>-->
<script type="text/javascript">
    var logout = function(){
    window.location.href = "/users/logout.html";
    }
</script>
<style>
.form-group{ display:inline-block;}
.clearfix:before,.clearfix:after {content:"";display:table;}
.clearfix:after {clear:both;overflow:hidden;}
.clearfix {zoom:1; }
.fl {float:left;}
.fr {float:right;}
.zidingyi_css{font-size:14px;margin-bottom:10px;}
.zidingyi_css .control-label{width:120px; text-align:right; font-size:15px;}
.zidingyi_css .col-md-6{margin-top:5px;}

#allmap{width:100%;height:350px;}
		p{margin-left:5px; font-size:14px;}

</style>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=xqltRQVqD5bh1G3NPyyQpuuTlgaYv4GR"></script>
<!-- header end --> 
<!-- body -->
<div class="container" id="j-content">
  <div class="row">
    <!--left Nav start-->
    <div class="col-md-1 main_left"> 
  <ul class="ui_navbar" id="navbarlist">

    <li>
      <div><i class="iconfont icon-dianpuguanli"></i>商品管理</div>
      <ul>
        <li tabindex="archex"><a href="<?php echo url('good/index');?>">商品列表</a></li>
        <li tabindex="categoryindex"><a href="<?php echo url('category/index');?>">分类管理</a></li>
        <li tabindex="categoryspec"><a href="<?php echo url('category/spec');?>">分类规格</a></li>
        <li tabindex="categoryattr"><a href="<?php echo url('category/attr');?>">分类属性</a></li>
        <li tabindex="categoryattri"><a href="<?php echo url('category/attri');?>">分类属性值</a></li>
      </ul>
    </li>
    <li>
      <div><i class="iconfont icon-search"></i>订单管理</div>
      <ul>
        <li tabindex="ordersindex"><a href="<?php echo url('orders/index');?>">订单管理</a></li>
        <li tabindex="orderscart"><a href="<?php echo url('orders/cart');?>">购物车</a></li>
      </ul>
    </li>
    <li>
      <div><i class="iconfont icon-kehuguanli"></i>用户管理</div>
      <ul>
        <li tabindex="membersindex"><a href="<?php echo url('members/index');?>">用户管理</a></li>
        <li tabindex="memberslog"><a href="<?php echo url('members/log');?>">登录信息</a></li>
        <li tabindex="membersrecharge"><a href="<?php echo url('members/recharge');?>">会员费</a></li>
        <li tabindex="membersaddress"><a href="<?php echo url('members/address');?>">会员收货地址</a></li>
      </ul>
    </li>
    <li>
      <div><i class="iconfont icon-iconfontshezhi"></i>系统设置</div>
      <ul>
        <li tabindex="systemxitong"><a href="<?php echo url('system/xitong');?>">系统文章</a></li>
        <li tabindex="systemstage"><a href="<?php echo url('system/stage');?>">自提驿站</a></li>
      </ul>
    </li>
    <li>
      <div><i class="iconfont icon-search"></i>专题管理</div>
      <ul>
        <li tabindex="zhuantizt"><a href="<?php echo url('zhuanti/zt');?>">专题及分类</a></li>
        <li tabindex="zhuantizg"><a href="<?php echo url('zhuanti/zg');?>">专题商品</a></li>
      </ul>
    </li>

  </ul>
</div>
    <!--left Nav end-->
    <div class="col-md-11 main_right">
      <div class="row">
        <form id="formPage" method="get">
          <div class="box">
            <div class="title help-course-f">
              <ul class="nav nav-tabs" style="margin-top: 16px;padding-left: 16px;">
                <li class="active"><a href="<?php echo url('system/stage');?>">自提驿站</a></li>
              </ul>
              <a class="btn btn-major btn-small shopHelp" id="Addadmin" href="javascript:;">添加自提驿站</a>
            </div>
            <div class="content" style="position:relative;">
              <ul class="newpager">
                <li class="previous">
                  <div class="form-inline text-right marginTop">
                    <div class="form-group">
                      <select class="form-control" name="cid">
                        <option value="0">所属区域</option>
                        <?php foreach($alists as $k=>$v){?>
                          <option value="<?php echo $k;?>" <?php echo ($acode == $k)?'selected="selected"':'';?>><?php echo $v;?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <select class="form-control" name="status">
                        <option value="0">状态</option>
                        <?php foreach($statusArr as $k=>$v){?>
                        <option value="<?php echo $k;?>" <?php echo ($status == $k)?'selected="selected"':'';?>><?php echo $v;?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="form-group" style="position:relative;">
                      <input class="form-control changeStyle ui-input" type="text" name="keyword" placeholder="请输入驿站名称" value="<?php echo $keyword;?>">
                      <div class="pull-right searchBtn">
                        <div class="searchBtnStyle"> <span class="addBorder"></span> <i class="iconfont icon-seach"></i>
                          <button type="submit" class="btn btnSearch">搜索</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
              <table class="table table-bordered" id="template">
                <thead>
                  <tr>
                    <th>编号</th>
                    <th>驿站名称</th>
                    <th>所属地区</th>
                    <th>驿站地址</th>
                    <th>状态</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($lists)){?>
                    <tr><td colspan="6" class="text-center">暂无内容</td></tr>  
                    <?php 
                    }else{
                    foreach($lists as $v){
                    ?>
                  <tr style="height: 55px;">
                    <td><?php echo $v['code'];?></td>
                    <td><?php echo $v['area'];?></td>
                    <td><?php echo $alists[$v['area_code']];?></td>
                    <td><?php echo $v['address'];?></td>
                    <td><?php echo ($v['status'])?'发布':'未发布';?></td>
                    <td>
                        <a href="javascript:void(0)" data-id="<?php echo $v['code'];?>" data-acode="<?php echo $v['area_code'];?>"  data-area="<?php echo $v['area'];?>" data-adr="<?php echo $v['address'];?>"  data-pic="<?php echo $v['pic'];?>"  data-la="<?php echo $v['latitude'];?>"  data-lo="<?php echo $v['longitude'];?>" data-w="<?php echo $v['weight'];?>" data-s="<?php echo $v['status'];?>" class="butedit">编辑</a>　
                     </td>
                  </tr>
                  <?php }}?>
                </tbody>
              </table>
              <?php echo $pageStr;?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- 添加 -->
<div id="addAdmin" style="display:none;width:600px;">
  <form class="form-horizontal" role="form" id="addLabel">
    <input type="hidden" id="objno" name="objno" value="" >

    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl"><b class="clr-attention">*</b>所属地区：</label>
      <div class="col-md-6 fl">
          <select class="form-control" name="area_code" id="area_code">
            <option value="">请所属地区</option>
            <?php foreach($alists as $k=>$v){?>
              <option value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php }?>
          </select>
      </div>
    </div>
    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl"><b class="clr-attention">*</b>名称：</label>
      <div class="col-md-6 fl">
        <input id="area" name="area" type="text" class="form-control form-plugInput ui-input" placeholder="名称">
      </div>
    </div>
    <div class="clearfix zidingyi_css">
      <label class="control-label fl" for="groupname"><b class="clr-attention">*</b>驿站地址：</label>
      <div class="col-md-6 fl">
        <input id="address" name="address" type="text" class="form-control form-plugInput ui-input" placeholder="输入自提驿站地址(最长22个汉字)">
      </div>
    </div>
	<div class="clearfix zidingyi_css">
      <label class="control-label fl" for="groupname"><b class="clr-attention">*</b>门面照片：</label>
      <div class="col-md-6 fl">
        <input id="pic" name="pic" type="text" class="form-control form-plugInput ui-input" placeholder="输入门面照片">
      </div>
    </div>
    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl">权 重：</label>
      <div class="col-md-2 fl">
          <input type="text" class="form-control money ui-input" id="weight" name="weight" placeholder="请输入权 重" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" value="">
      </div>
      <label for="groupname" class="control-label fl">状 态：</label>
      <div class="col-md-3 fl">
          <input type="radio" name="status" value="0" >未发布 &nbsp; &nbsp;
          <input type="radio" name="status" value="1" checked="checked">发布 &nbsp; &nbsp;
      </div>
    </div>
    
    <div id="allmap"></div>
    <input name="longitude" type="hidden"  id="longitude"  value="">
    <input name="latitude" type="hidden"  id="latitude"  value="">

  </form>
</div>

<script type="text/javascript">
/*// 百度地图API功能
var map = new BMap.Map("allmap");            
map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用 
      
//单击获取点击的经纬度
map.addEventListener("click",function(e){
	map.clearOverlays(); 
	point = new BMap.Point(e.point.lng,e.point.lat);
	var marker = new BMap.Marker(point);// 创建标注
	map.addOverlay(marker);             // 将标注添加到地图中
	marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
	var longitude = e.point.lng ;
	var latitude =  e.point.lat;
	$("#longitude").val(e.point.lng);
	$("#latitude").val(e.point.lat);
});

//编辑时定位
var longitude=$("#longitude").val(),latitude=$("#latitude").val();
if($.trim(longitude) !=''){
	point = new BMap.Point(longitude,latitude);
	map.centerAndZoom(point,14);  
	var marker = new BMap.Marker(point);// 创建标注
	map.addOverlay(marker);             // 将标注添加到地图中
	marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
}else{
	//商家默认城市
	map.centerAndZoom('杭州市',14);  	
}
*/


	/*// 百度地图API功能
	var map = new BMap.Map("allmap");
	var point = new BMap.Point(116.417854,39.921988);
	var marker = new BMap.Marker(point);  // 创建标注
	map.addOverlay(marker);              // 将标注添加到地图中
	map.centerAndZoom(point, 15);
	var opts = {
	  width : 200,     // 信息窗口宽度
	  height: 100,     // 信息窗口高度
	  title : "海底捞王府井店" , // 信息窗口标题
	  enableMessage:true,//设置允许信息窗发送短息
	  message:"亲耐滴，晚上一起吃个饭吧？戳下面的链接看下地址喔~"
	}
	var infoWindow = new BMap.InfoWindow("地址：北京市东城区王府井大街88号乐天银泰百货八层", opts);  // 创建信息窗口对象 
	marker.addEventListener("click", function(){          
		map.openInfoWindow(infoWindow,point); //开启信息窗口
	});*/
</script>

<script type="text/javascript">
$(function(){
    menuleft("systemstage");

  $(function() {
    $("#Addadmin").on("click", function(e) {
      $('#objno').val('');
      $('#area_code').val('');
	  $('#area').val('');
      $('#address').val('');
	  $('#pic').val('');
      $('#weight').val(0);
	  $("#longitude").val('');
	  $("#latitude").val('');
      $("input[name='status']:eq(1)").attr("checked",'checked');
	  
	  var map = new BMap.Map("allmap");            
	  map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
	  map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
	  
	  //单击获取点击的经纬度
	map.addEventListener("click",function(e){
		map.clearOverlays(); 
		point = new BMap.Point(e.point.lng,e.point.lat);
		var marker = new BMap.Marker(point);// 创建标注
		map.addOverlay(marker);             // 将标注添加到地图中
		marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
		var longitude = e.point.lng ;
		var latitude =  e.point.lat;
		$("#longitude").val(e.point.lng);
		$("#latitude").val(e.point.lat);
	});

	  //初始化地图
	  map.centerAndZoom('杭州市',14);
      toAddAdmin();
    });

    $('.butedit').click(function(){
      	var objNo = parseInt($(this).data('id')),acode = parseInt($(this).data('acode')),area = $.trim($(this).data('area')),weight = parseInt($(this).data('w')),status = parseInt($(this).data('s')),address=$.trim($(this).data('adr')),pic=$.trim($(this).data('pic')),latitude=$.trim($(this).data('la')),longitude=$.trim($(this).data('lo'));
      	$('#objno').val(objNo);
		$('#area_code').val(acode);
	    $('#area').val(area);
        $('#address').val(address);
	    $('#pic').val(pic);
        $('#weight').val(weight);
	    $("#longitude").val(longitude);
	    $("#latitude").val(latitude);
        if(status == 1){
        	$("input[name='status'][value=1]").attr("checked",true);
        }else{
        	$("input[name='status'][value=2]").attr("checked",true);
        }
		var map = new BMap.Map("allmap");            
	    map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
	    map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
		
		//单击获取点击的经纬度
		map.addEventListener("click",function(e){
			map.clearOverlays(); 
			point = new BMap.Point(e.point.lng,e.point.lat);
			var marker = new BMap.Marker(point);// 创建标注
			map.addOverlay(marker);             // 将标注添加到地图中
			marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
			var longitude = e.point.lng ;
			var latitude =  e.point.lat;
			$("#longitude").val(e.point.lng);
			$("#latitude").val(e.point.lat);
		});
	    
	    //定位原点并初始地图
	  	point = new BMap.Point(longitude,latitude);
		map.centerAndZoom(point,18);  
		var marker = new BMap.Marker(point);// 创建标注
		map.addOverlay(marker);             // 将标注添加到地图中
		marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
		map.panBy(300,160);//中心点偏移
		
      	toAddAdmin();
    })
  });

  function toAddAdmin() {
    normalDialog("分类规格", document.getElementById("addAdmin"), "确认", function(t) {
      $.ajax({
          type:"POST",
          async:false,
          url:"/system/stagesave.html",
          dataType: "json",
          data:$("#addLabel").serialize(),
          success:function(result){
            if(result.status == 200){
              window.location.reload();
            }else{
              art.dialog.alert(result.msg);
            }
          },
          error:function(XMLHttpRequest, textStatus, errorThrown){
            art.dialog.alert('网络异常，请稍后重试！');
          }
        });

    }, "取消", null);
  }


});
</script>
    <div class="footer">
      <p class="version">Copyright@2019 运营管理中心 版权所有，不允许任何形式的转载以及拷贝，违者必究。 &nbsp;&nbsp;</p>
    </div>
    <script type="text/javascript" src="__JS__/jquery.ba-resize.js"></script>
</body>
</html>

