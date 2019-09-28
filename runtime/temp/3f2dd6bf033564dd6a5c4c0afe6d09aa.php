<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:36:"../template/mcenter/orders\check.php";i:1569667762;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1569664258;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
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
                <div class="box">
                    <input type="text" id="ddbh" name="ddbh" placeholder="条码号">
                        <!--订单商品详情-->
                        <div class="dingdan_detail_shops">
                            <h6>订单商品详情</h6>
                            <table border="1">
                                <tr>订单编号：<?php echo $ddbh;?></tr>
                                <?php foreach($lists as $k=>$v){?>
                                    <tr>
                                        <td>商品名称：<b class="clr-attention"><?php echo $info['order_no'].'（'.($info['group']?'拼购':'普通').'）';?></b></td>
                                        <td>数量：<b class="clr-attention"><?php echo $info['pay_status']==1?'未付款':'已付款';?></b></td>
                                        <td>已检：<b class="clr-attention"><?php echo $sstatusArr[$info['status']];?></b></td>
                                    </tr>
                                <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- 添加 -->
<div id="addAdmin" style="display:none;width: 500px;">
    <form class="form-horizontal" role="form" id="addLabel">
        <input type="hidden" id="objId" name="objId" value="0">
        <input type="hidden" id="status" name="status" value="0">
        <div class="form-group">
            <label class="col-md-4 control-label" for="groupname">订单编号</label>
            <div class="col-md-8">
                <input id="objId1" name="objId1" type="text" class="form-control form-plugInput ui-input" disabled>
            </div>
        </div>
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
    $(function(){
        menuleft("orderscheck");
        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode==13) {
                alert(66666);
            }
        }

        $(function() {
            $('.butedit0').click(function(){
                var objId = $.trim($(this).data('order')),status = $.trim($(this).data('s'));
                $.ajax({
                    type:"POST",
                    async:false,
                    url:"/Orders/hnavsave.html",
                    dataType: "json",
                    data:{objId:objId,status:status,i: Math.random()},
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
            })

            $('.butedit').click(function(){
                var objId = $.trim($(this).data('order')),status = $.trim($(this).data('s')),objId1 = $.trim($(this).data('or'));
                $('#objId').val(objId);
                $('#objId1').val(objId1);
                $('#status').val(status);
                toAddAdmin();
            })
        });

        function toAddAdmin() {
            $("title.error").remove();
            $("title.error").hide();
            var id;
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

    });
</script>
    <div class="footer">
      <p class="version">Copyright@2019 运营管理中心 版权所有，不允许任何形式的转载以及拷贝，违者必究。 &nbsp;&nbsp;</p>
    </div>
    <script type="text/javascript" src="__JS__/jquery.ba-resize.js"></script>
</body>
</html>