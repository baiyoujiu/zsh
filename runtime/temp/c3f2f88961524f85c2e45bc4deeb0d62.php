<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:34:"../template/mcenter/orders\inf.php";i:1570494110;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1569749584;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="__CSS__/withdraw-new.css">
<link rel="stylesheet" type="text/css" href="__CSS__/dsmc.css">
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
table{ margin-left:10px;}
table td{ text-align:left;}
</style>
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
        <li tabindex="ordersdaihuan"><a href="<?php echo url('orders/daihuan');?>">待还书目</a></li>
        <li tabindex="orderscheck"><a href="<?php echo url('orders/check');?>">检货</a></li>
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
        <div class="box">
          <div class="title help-course-f">
            <ul class="nav nav-tabs" style="margin-top: 16px;padding-left: 16px;">
              <li class="active"><a href="http://www.jsg.co/orders/index.html">订单详情</a></li>
            </ul>
            <?php 
			  ////1-下单，待确认|2-卖家确认|3-配货完成|4-已发贷，待收货|5-买家确认收货|6-系统收货|8-卖家取消订单|9-系统关闭未付款订单
			  if($info['pay_status']==1){
				  if($info['status']==1){
			  ?>
			  <b class="btn btn-major btn-small shopHelp upbtn" data-no="<?php echo $info['order_no'];?>" data-s="9">系统关闭</b>
			  <?php 
				}
			  }else{ //已付款订单操作
				if($info['status']==1){ 
			   ?>
			   <b class="btn btn-major btn-small shopHelp upbtn" data-no="<?php echo $info['order_no'];?>" data-s="2">卖家确认</b>
			   <b class="btn btn-major btn-small shopHelp upbtn" data-no="<?php echo $info['order_no'];?>" data-s="8">取消订单</b>
			   <?php }else if($info['status']==2){ ?>
			   <b class="btn btn-major btn-small shopHelp butedit" data-no="<?php echo $info['order_no'];?>" data-s="4">发货</b>
			   <?php }else if($info['status']==4){ ?>
			   <b class="btn btn-major btn-small shopHelp upbtn" data-no="<?php echo $info['order_no'];?>" data-s="6">系统收货</b>
			  <?php }}?>
          </div>
          <div class="content">
            <table border="1">
              <tr>
                <td>订单编号：<b class="clr-attention"><?php echo $info['order_no'].'（'.($info['group']?'拼购':'普通').'）';?></b></td>
                <td>支付状态：<b class="clr-attention"><?php echo $info['pay_status']==1?'未付款':'已付款';?></b></td>
                <td>订单状态：<b class="clr-attention"><?php echo $sstatusArr[$info['status']];?></b></td>
              </tr>
              <tr>
                <td>商品金额：<?php echo number_format($info['good_amount']/100,2).'<b class="clr-attention">（'.$info['goodnum'].'件）</b>';?></td>
                <td>运　　费：<?php echo number_format($info['freight']/100,2);?></td>
                <td>优惠金额：<?php echo number_format($info['camount']/100,2);?></td>
              </tr>
              <tr>
                <td>应付金额：<?php echo number_format($info['amount']/100,2);?></td>
                <td>实付金额：<b class="clr-attention"><?php echo number_format($info['pay_amount']/100,2);?></b></td>
                <td>支付方式：<b class="clr-attention"><?php echo $info['pay_status']==2?$paytypeArr[$info['pay_type']].'('.$info['trade_no'].')':'未付款';?></b></td>
              </tr>
              <tr>
                <td>下单时间：<?php echo $info['order_time'];?></td>
                <td>付款时间：<?php echo $info['pay_time'];?></td>
                <td>发货时间：<?php echo $info['send_time'];?></td>
              </tr>
              <tr>
                <td colspan="2">订单备注：<b class="clr-attention"><?php echo $info['remark'];?></b></td>
                <td>收货时间：<?php echo $info['received_time'];?></td>
              </tr>
              <tr>
                <td colspan="3"> 收货人：<?php echo $info['address']['recname'].'('.decryptd($info['address']['phone']).')';?> <?php echo $arealist[$info['address']['province']].$arealist[$info['address']['city']].$arealist[$info['address']['area']].(($info['address']['school'] == 1 )?$stagelist[$info['address']['address']].'('.$stagealist[$info['address']['address']].')':$arealist[$info['address']['street']].$info['address']['address']);?></td>
              </tr>
            </table>
            <!--订单商品详情-->
            <div class="dingdan_detail_shops">
              <h6>订单商品详情</h6>
              <div>
                <table>
                  <thead>
                    <tr>
                      <td>商品信息</td>
                      <td>单价</td>
                      <td>数量</td>
                    </tr>
                  </thead>
                </table>
                <ul class="dingdan_detail_shops_lists">
                  <?php foreach($glist as $k=>$v){?>
                  <li class="clearfix">
                    <div class="fl food_name"> <img class="fl" src="<?php echo $v['pic'];?>"/>
                      <p class="fl"><?php echo $v['name'].'<br>'.$v['keyv'];?></p>
                    </div>
                    <div class="fl food_pic">￥<?php echo $v['price']/100;?></div>
                    <div class="fl food_mun"><?php echo $v['num'];?></div>
                  </li>
                  <?php }?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- 添加 -->
<div id="addAdmin" style="display:none;width:400px;">
  <form class="form-horizontal" role="form" id="tosend">
    <input type="hidden" id="objid" name="objid" value="0">
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname">订单编号</label>
      <div class="col-md-8">
        <input id="objid1" type="text" class="form-control form-plugInput ui-input" disabled>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname"><b class="clr-attention">*</b>物　　流：</label>
      <div class="col-md-8">
        <input  type="text" name="wuliu" class="form-control form-plugInput ui-input"  placeholder="物流及编号">
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
$(function(){
    menuleft("ordersindex");

	$(function() {
      $('.upbtn').click(function(){
			var hstr = $(this).html();
			var objid = $.trim($(this).data('no')),status = $.trim($(this).data('s'));
			normalDialog(hstr, hstr, "确认", function(t) {
				 $.ajax({ 
					type:"POST", 
					async:false, 
					url:"/orders/upstatus.html",
					dataType: "json",
					data:{objid : objid,status : status,i: Math.random()},
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
			
		})
		$('.butedit').click(function(){
          var objid = $.trim($(this).data('no'));
          $('#objid').val(objid);
          $('#objid1').val(objid);
          toAddAdmin();
		})
	});

	function toAddAdmin() {
		normalDialog("物流信息", document.getElementById("addAdmin"), "确认", function(t) {
			$.ajax({
				type:"POST",
				async:false,
				url:"/Orders/tosend.html",
				dataType: "json",
				data:$("#tosend").serialize(),
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