<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:36:"../template/mcenter/orders\index.php";i:1568969484;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1568967277;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="__CSS__/dsmc.css">
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
                
                <!--          这个为什么后面不(能)加.html   因为用了url 就变成地址了吗？不用的话就是完整网址     -->
                <li class="active"><a href="<?php echo url('Orders/index');?>">订单列表</a></li>
              </ul>
            </div>
            <div class="content" style="position:relative;">
              <ul class="newpager">
                <li class="previous">
                  <div class="form-inline text-right marginTop">
                    <div class="form-group"> 
                      <!--搜索     -->
                      <select class="form-control" name="status">
                        <option value="0">状态</option>
                        <?php foreach($statusArr as $k=>$v){?>
                        <option value="<?php echo $k;?>" <?php echo ($status == $k)?'selected="selected"':'';?>><?php echo $v;?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="form-group" style="position:relative;">
                      <input class="form-control changeStyle ui-input" type="text" name="keyword" placeholder="请输入订单编号" value="<?php echo $keyword;?>">
                      <div class="pull-right searchBtn">
                        <div class="searchBtnStyle"> <span class="addBorder"></span> <i class="iconfont icon-seach"></i>
                          <button type="submit" class="btn btnSearch">搜索</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
              <div class="personal_order_food_list">
                <table class="food_listss">
                  <thead class="food_list_title">
                    <tr>
                      <th class="food_name">宝贝</th>
                      <th class="food_price">单价</th>
                      <th class="food_number">数量</th>
                      <th class="food_prices">小计</th>
                      <th class="food_holeprice">订单总价</th>
                      <th class="food_price">驿站地址</th>
                      <th class="food_state">交易状态</th>
                      <th class="food_transaction">交易操作</th>
                    </tr>
                  </thead>
                  <?php if(empty($lists)){?>
                  <tr colspan="8">
                    <th class="food_dingdan"><div class="no_data">
                        <div class="no_data_w"> <img src="../img/!.png" alt="">
                          <p>您还没有订单哦~</p>
                        </div>
                      </div></th>
                  </tr>
                  <?php }else{
							foreach($lists as $v){
								?>
                  <tr>
                    <th class="food_dingdan" colspan="8"> <div class="clearfix"> <b class="fl"><?php echo $v['order_time'].'&nbsp'.'&nbsp'.'&nbsp'.'用户名:'.$user[$v['userid']];?></b> <span class="fr">订单号: <?php echo $v['order_no'];?></span> </div>
                    </th>
                  </tr>
                  <tbody class="food_list_lists">
                    <?php foreach($v['glists'] as $k1=>$v1){?>
                    <tr>
                      <td class="food_name"><div class="clearfix"> <img class="fl grzx_food_img" src="<?php echo $v1['pic'];?>" />
                          <section class="fl">
                            <p><?php echo $v1['name'];?></p>
                            <div class="food_name_fenlei"><span><?php echo $v1['keyv'];?></span></div>
                          </section>
                        </div></td>
                      <td class="food_price"><div class="food_price_list">
                          <p class="yj">￥<?php echo number_format($v1['mprice']/100,2);?></p>
                          <p class="xj">￥<?php echo number_format($v1['price']/100,2);?></p>
                        </div></td>
                      <td class="food_number"><?php echo $v['goodnum'];?></td>
                      <td class="food_prices"><div class="food_prices_list">
                          <p class="xj">￥<?php echo number_format($price_each = $v['goodnum'] * $v1['price']/100,2);?></p>
                        </div></td>
                      <?php if($k1<1){?>
                      <td class="food_holeprice" rowspan="<?php echo count($v['glists']);?>"><div class="food_holeprice_list">
                          <p class="xj">￥<?php echo number_format($v['amount']/100,2);?></p>
                        </div></td>
                      <td class="food_holeprice" rowspan="<?php echo count($v['glists']);?>"><div class="food_holeprice_list">
                          <p class="yz">
                            <?php $address = json_decode(base64_decode($v['address']),true); echo ($address['school'] == 1)? $stagelist[$address['address']]:'非驿站';?>
                          </p>
                        </div></td>
                      <td class="food_state" rowspan="<?php echo count($v['glists']);?>"><div class="food_state_list">
                          <?php if($v['status'] == 1){?>
                          <p class="">买家下单</p>
                          <?php }elseif($v['status'] == 2){?>
                          <p class="">卖家确认</p>
                          <?php }elseif($v['status'] == 3){?>
                          <p class="">已发货</p>
                          <?php }elseif($v['status'] == 5){?>
                          <p class="">买家确认收货</p>
                          <?php }elseif($v['status'] == 6){?>
                          <p class="">系统收货</p>
                          <?php }elseif($v['status'] == 8){?>
                          <p class="">卖家取消订单</p>
                          <?php }elseif($v['status'] == 9){?>
                          <p class="">系统关闭未付款订单</p>
                          <?php }?>
                          <a href="<?php echo '/Orders/inf/id/'.$v['id'].'.html';?>">
                          <p class="">订单详情</p>
                          </a> </div></td>
                      <td class="food_transaction" rowspan="<?php echo count($v['glist']);?>"><div class="food_transaction_list">
                          <?php if($v['pay_status']==2 && $v['status']==2){?>
                          <p class="butedit" data-order="<?php echo $v['order_no'];?>" data-s="<?php echo $v['status'];?>">发货</p>
                          <?php }?>
                        </div></td>
                      <?php }?>
                    </tr>
                    <?php }}}?>
                  </tbody>
                </table>
              </div>
            </div>
            <?php echo $pageStr;?> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- body end! --> 
<!-- 添加 -->
<div id="addAdmin" style="display:none;width: 500px;">
  <form class="form-horizontal" role="form" id="addLabel">
    <input type="hidden" id="objId" name="objId" value="0">
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname">订单编号</label>
      <div class="col-md-8">
        <input id="objId1" name="objId1" type="text" class="form-control form-plugInput ui-input" disabled>
      </div>
    </div>
    <!--物流公司选择，没有对应的物流表-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname"><b class="clr-attention">*</b>物流公司选择：</label>
      <div class="col-md-8">
        <select class="form-control" >
          <option value="">请选择物流公司</option>
          <?php foreach($typeArr as $k=>$v){?>
          <option value="<?php echo $v['com'];?>"><?php echo $v['name'];?></option>
          <?php }?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname"><b class="clr-attention">*</b>物流编号：</label>
      <div class="col-md-8">
        <input  type="text" class="form-control form-plugInput ui-input"  placeholder="输入物流编号">
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
	menuleft("ordersindex");

//    实现编辑，CLICK事件    物流信息


    $(function() {
		$('.butedit').click(function(){
//    预显示
			var objId = $.trim($(this).data('order')),status = $.trim($(this).data('s'));
			$('#objId').val(objId);
			$('#objId1').val(objId);
            $('#status').val(status);
			toAddAdmin();
		})
    });

    function toAddAdmin() {
//      所有class = error 的  title  元素？
        $("title.error").remove();
        $("title.error").hide();

//      单独var  id 是干嘛用的()路由参数？？？
        var id;

//      这一行干哈的？（添加数据到 document.getElementById("addAdmin")  确认后触发事件）
        normalDialog("物流信息", document.getElementById("addAdmin"), "确认", function(t) {
			$("title.error").remove();
			$("title.error").hide();
				$.ajax({ 
					type:"POST", 
					async:false, 
					url:"/Orders/hnavsave.html",
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
	
	
</script> 
    <div class="footer">
      <p class="version">Copyright@2019 运营管理中心 版权所有，不允许任何形式的转载以及拷贝，违者必究。 &nbsp;&nbsp;</p>
    </div>
    <script type="text/javascript" src="__JS__/jquery.ba-resize.js"></script>
</body>
</html>