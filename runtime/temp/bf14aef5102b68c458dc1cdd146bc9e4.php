<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:38:"../template/mcenter/orders\daihuan.php";i:1569667247;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1569664258;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
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
        <li tabindex="ordersdaihuan"><a href="<?php echo url('orders/daihuan');?>">待还订单</a></li>
        <li tabindex="orderscart"><a href="<?php echo url('orders/cart');?>">购物车</a></li>
        <li tabindex="orderscheck"><a href="<?php echo url('orders/check');?>">检货</a></li>
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
                <li class="active"><a href="<?php echo url('orders/index');?>">订单列表</a></li>
              </ul>
              <a class="btn btn-major btn-small shopHelp" id="toprint">打印</a>
            </div>
            <div class="content" style="position:relative;">
              <ul class="newpager">
                <li class="previous">
                  <div class="form-inline text-right marginTop">
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
                      <th class="food_prices">租借时间</th>
                      <th class="food_prices">租借商品状态</th>
                      <th class="food_transaction">操作</th>
                    </tr>
                  </thead>
                  <?php if(empty($lists)){?>
                  <tr>
                    <th class="food_dingdan"  colspan="8"><div class="no_data">
                        <div class="no_data_w"> <img src="../img/!.png" alt="">
                          <p>您还没有订单哦~</p>
                        </div>
                      </div></th>
                  </tr>
                  <?php }else{
							foreach($lists as $v){
								?>
                  <tr>
                    <th class="food_dingdan" colspan="8"> <div class="clearfix"> <b class="fl"><?php echo $v['order_time'].'&nbsp'.'&nbsp'.'&nbsp'.'用户名:'.$user[$v['userid']];?></b> <span class="fr">订单号: <?php echo $v['order_no'];?><b class="clr-attention">（<?php echo $v['pay_status']==1?'待付款-'.$sstatusArr[$v['status']]:$sstatusArr[$v['status']];?>）</b></span> </div>
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
                      <td class="food_number"><?php echo $v1['num'];?></td>
                      <td class="food_prices"><div class="food_prices_list">
                          <p class="xj">￥<?php echo number_format($price_each = $v1['num'] * $v1['price']/100,2);?></p>
                        </div></td>
                        <?php if($k1<1){?>
                        <td class="rent" rowspan="<?php echo count($v['glists']);?>"><?php echo '租借：'.$v1['rentstart'].'<br>'.'归还：'.$v1['rentend'];?></td>
                        <td class="st" rowspan="<?php echo count($v['glists']);?>"><?php echo $statusbrr[$v1['status']];?></td>
                        <td rowspan="<?php echo count($v['glists']);?>"><a href="javascript:void(0);" class="yh" data-id="<?php echo $v1['order_no'];?>">确认已还</a></td>
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

<script type="text/javascript">
	menuleft("ordersdaihuan");

	$('.yh').click(function(){
		var objId =$(this).data('id');
        $.ajax({
            type:"POST",
            async:false,
            url:"/orders/huanshu.html",
            dataType: "json",
            data:{objId:objId,i: Math.random()},
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
        })
	})

    function toAddAdmin() {
        normalDialog("物流信息", document.getElementById("addAdmin"), "确认", function(t) {
			$("title.error").remove();
			$("title.error").hide();
				;
        }, "取消", null);
    }
	
	
</script> 
    <div class="footer">
      <p class="version">Copyright@2019 运营管理中心 版权所有，不允许任何形式的转载以及拷贝，违者必究。 &nbsp;&nbsp;</p>
    </div>
    <script type="text/javascript" src="__JS__/jquery.ba-resize.js"></script>
</body>
</html>