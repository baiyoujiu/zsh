<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:37:"../template/mcenter/members\index.php";i:1569221767;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1568967277;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
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
    .form-group{ display:inline-block;
    }<!-- 增加下边界-->

          .clearfix:before,.clearfix:after {content:"";display:table;}
    .clearfix:after {clear:both;overflow:hidden;}
    .clearfix {zoom:1; }

    .fl {float:left;}
    .fr {float:right;}
    .zidingyi_css{font-size:14px;margin-bottom:10px;}
    .zidingyi_css .control-label{width:120px; text-align:right; font-size:15px;}
    .zidingyi_css .col-md-6{margin-top:5px;}
</style>
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
                                <li class="active"><a href="<?php echo url('members/index');?>">用户管理</a></li>
                            </ul>
                        </div>
                        <div class="content" style="position:relative;">
                            <ul class="newpager">
                                <li class="previous">
                                    <div class="form-inline text-right marginTop">
<!--                                       <!--搜索-->
                                        <div class="form-group">
                                            <select class="form-control" name="hystatus">
                                                <option value="0">会员类型</option>
                                                <?php foreach($hyArr as $k => $v){?>
                                                    <option value="<?php echo $k;?>" <?php echo ($hystatus == $k)?'selected="selected"':'';?>><?php echo $v;?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="ztstatus">
                                                <option value="0">状态</option>
                                                <?php foreach($ztArr as $k => $v){?>
                                                    <option value="<?php echo $k;?>" <?php echo ($ztstatus == $k)?'selected="selected"':'';?>><?php echo $v;?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group" style="position:relative;">
                                            <input class="form-control changeStyle ui-input" type="text" name="keyid"    placeholder="请输入用户名" value="<?php echo $keyid;?>">
                                        </div>
                                        <div class="form-group" style="position:relative;">
                                            <input class="form-control changeStyle ui-input" type="text" name="keytel"   placeholder="请输入手机号" value="<?php echo $keytel;?>">
                                            <div class="pull-right searchBtn">
                                                <div class="searchBtnStyle"> <span class="addBorder"></span> <i class="iconfont icon-seach"></i>
                                                    <button type="submit" class="btn btnSearch">搜索</button>
                                                </div>
                                            </div>

                                    </div>
                                </li>
                            </ul>
                            <table class="table table-bordered" id="template">
                                <thead>
                                <tr>
                                    <th>用户昵称</th>
                                    <th>手机号</th>
                                    <th>会员类型</th>
                                    <th>qq号</th>
                                    <th>微信号</th>
                                    <th>微博uid</th>
                                    <th>注册时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(empty($lists)){?>
                                    <tr><td colspan="5" class="text-center">暂无内容</td></tr>
                                    <?php
                                }else{
                                    foreach($lists as $v){
                                        ?>
                                        <tr style="height: 55px;">
                                            <td><?php echo $v['username'];?></td>
                                            <td><?php echo decryptd($v['phone']);?></td>
                                            <td><?php echo $v['utype'] == 1?'普通买家':'会员买家';?></td>
                                            <td><?php echo $v['qq'];?></td>
                                            <td><?php echo $v['wx'];?></td>
                                            <td><?php echo $v['wb'];?></td>
                                            <td><?php echo $v['addtime'];?></td>
                                            <td><?php echo $v['status'] == 1?'有效':'无效';?></td>
                                            <td>
                                                <div>
                                                    <span class="butedit" data-na = "<?php echo $v['userid'];?>"  data-s ="<?php echo $v['status']?0:1;?>"><?php echo $v['status']?'关闭':'启用';?></span>
                                                </div>
                                            </td>
                                        <?php }?>
                                        </tr>
                                    <?php }?>
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


<script type="text/javascript">
    $(function(){
        menuleft("membersindex");

        $('.butedit').click(function(){
           var objid = $.trim($(this).data('na')),status = $.trim($(this).data('s'));
		   var hstr = $(this).html();
		   normalDialog('用户'+hstr, hstr+'用户', "确认", function(t) {
			   $.ajax({
					type:"POST",
					async:false,
					url:"/Members/ustatus.html",
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
						art.dialog.alert('网000络异常，请稍后重试！');
					}
				});
			}, "取消", null);
        })
    });
</script>
    <div class="footer">
      <p class="version">Copyright@2019 运营管理中心 版权所有，不允许任何形式的转载以及拷贝，违者必究。 &nbsp;&nbsp;</p>
    </div>
    <script type="text/javascript" src="__JS__/jquery.ba-resize.js"></script>
</body>
</html>