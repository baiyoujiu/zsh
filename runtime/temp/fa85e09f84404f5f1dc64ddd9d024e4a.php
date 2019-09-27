<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:34:"../template/mcenter/good\index.php";i:1569577198;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1568967277;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
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
                <li class="active"><a href="<?php echo url('good/index');?>">商品列表</a></li>
              </ul>
            </div>
            <div class="content" style="position:relative;">
              <ul class="newpager">
                <li class="previous">
                  <div class="form-inline text-right marginTop">
                    <div class="form-group">
                      <select class="form-control" name="cid">
                        <option value="0">所属分类</option>
                        <?php foreach($catlists as $k=>$v){?>
                          <option value="<?php echo $k;?>" <?php echo ($cid == $k)?'selected="selected"':'';?>><?php echo $v;?></option>
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
                      <input class="form-control changeStyle ui-input" type="text" name="keyword" placeholder="请输入名称" value="<?php echo $keyword;?>">
                      <div class="pull-right searchBtn">
                        <div class="searchBtnStyle"> <span class="addBorder"></span> <i class="iconfont icon-seach"></i>
                          <button type="submit" class="btn btnSearch">搜索</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
              <div class="content-add addShop"> <a href="<?php echo '/good/edit.html';?>" class="btn btn-major btn-small">添加商品</a> </div>
              <table class="table table-bordered" id="template">
                <thead>
                  <tr>
                    <th>商品名称</th>
                    <th>商品名称</th>
                    <th>一级分类</th>
                    <th>权重</th>
                    <th>拼购</th>
                    <th>上传时间</th>
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
                  <tr>
                    <td><?php echo $v['gno'];?></td>
                    <td><?php echo $v['name'];?></td>
                    <td><?php echo $catlists[$v['cid']];?></td>
                    <td><input class="weight" style="width: 45px;padding: 0;" value="<?php echo $v['weight'];?>">
                      <button name="weight" class="weightbth" type="button" data-alt="<?php echo $v['gno'];?>" >确认</button></td>
                    <td><?php echo $groupArr[$v['group']];?></td>
                    <td><?php echo substr($v['addtime'],0,11);?></td>
                    <td><?php echo $statusArr[$v['status']];?></td>
                    <td>
                        <a class="btn-link" href="<?php echo '/good/edit.html?objNo='.$v['gno'];?>">编辑商品</a>
                        <a class="btn-link" href="<?php echo '/good/edit2.html?objNo='.$v['gno'];?>">编辑价格</a>
                        <a class="btn-link" href="<?php echo '/good/edit3.html?objNo='.$v['gno'];?>">编辑详情</a>
                        <?php if($v['status'] == 1){?>
                          &nbsp;|&nbsp;
                            <a class="btn-link goodpass" href="javascript:void(0);" alt="<?php echo $v['id'];?>">上架</a>
                        <?php }else{?>
                          &nbsp;|&nbsp;
                            <a class="btn-link goodfail" href="javascript:void(0);" alt="<?php echo $v['id'];?>">下架</a>
                        <?php }?>
                          &nbsp;|&nbsp;
                            <a class="btn-link barcode" href="javascript:void(0);" data-n="<?php echo $v['gno'];?>">编辑条码号</a>
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

<!-- 添加条码号 -->
<div id="addAdmin" style="display:none;width:400px;">
  <form class="form-horizontal" role="form" id="addobj">
    <div>
      <span>商品编号：</span>
      <input style="border:none;" id="objId" name="objId"  >
    </div>

    <div class="old ">
      <div class="sp_lists"></div>
      <button id="hide" type="button">添加</button>
    </div>

    <div class="new">
      <label  for="nbarcode">请输入：</label>
        <input id="nbarcode" name="nbarcode" type="text" class="form-control form-plugInput ui-input" placeholder="请输入条码号">
    </div>
  </form>
</div>
<script type="text/javascript">
$(function() {
  menuleft("archex");

  $(".searchBtn").on("click", ".icon-seach,.addBorder,.btnSearch", function () {
    $('form').submit();
  });

  $(".searchBtn").on("mouseleave", function () {
    $(".btnSearch").removeClass("activeColor");
    $(".icon-seach").removeClass("activeColor");
  });
  $(".searchBtn").on("mouseenter", function () {
    $(".btnSearch").addClass("activeColor");
    $(".icon-seach").addClass("activeColor");
  });

  //状态
  $('.btnEdit').click(function () {
    var objId = $(this).data('id'), s = $(this).data('s');
    $.ajax({
      type: "POST",
      async: false,
      url: "/sitems/newsup.html",
      dataType: "json",
      data: {objId: objId, s: s, i: Math.random()},
      success: function (result) {
        if (result.status == 200) {
          window.location.reload();
        } else {
          art.dialog.alert(result.msg);
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        art.dialog.alert('网络异常，请稍后重试！');
      }
    });
  })

  //状态
  $('.goodpass').click(function () {
    var id = $(this).attr("alt");
    $.ajax({
      type: "POST",
      async: false,
      url: "/goods/gpass.html",
      dataType: "json",
      data: {id: id, i: Math.random()},
      success: function (result) {
        if (result.status == 200) {
          window.location.reload();
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        art.dialog.alert('网络异常，请稍后重试！');
      }
    });
  })


  $('.goodfail').click(function () {
    var id = $(this).attr("alt");
    $.ajax({
      type: "POST",
      async: false,
      url: "/goods/gfail.html",
      dataType: "json",
      data: {id: id, i: Math.random()},
      success: function (result) {
        if (result.status == 200) {
          window.location.reload();
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        art.dialog.alert('网络异常，请稍后重试！');
      }
    });
  })

  $('.actdel').click(function () {
    var $this = $(this), id = $this.data('id'), title = $this.data('t');
    normalDialog("提示", "确定要删除　" + title + "　吗？", "确定", function (t) {
      $.ajax({
        type: "POST",
        async: false,
        url: "/sitems/newsdel.html",
        dataType: "json",
        data: {objId: id, i: Math.random()},
        success: function (result) {
          if (result.status == 200) {
            window.location.reload();
          } else {
            art.dialog.alert(result.msg);
          }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          art.dialog.alert('网络异常，请稍后重试！');
        }
      });
    }, "取消", null);
  })


  $('.weightbth').click(function () {
    var gno = $(this).data("alt"),weight = $(this).parent('td').find('.weight').val();
    $.ajax({
      type: "POST",
      async: false,
      url: "/Good/wsave.html",
      dataType: "json",
      data: {gno: gno, weight: weight, i: Math.random()},
      success: function (result) {
        if (result.status == 200) {
          window.location.reload();
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        art.dialog.alert('网络异常，请稍后重试！');
      }
    });
  })

  //添加条码号
  $('.barcode').click(function () {
    var objId = $(this).data('n'),barcode = $(this).data('b');
    $(".old").show();
    $(".new").hide();
    $('#objId').val(objId);
    $('#barcode').val(barcode);
    $('#objId').attr("disabled","disabled");
    $.ajax({
      url: "/good/barcode.html",
      data: {objId:objId,i:Math.random()},
      type: "post",
      dataType: "json",
      success: function(data) {
        if(data.status == 200){
          $('.sp_lists').html(data.html);
        }else{
          layer.open({skin:'msg',content: data.msg,time:2});
        }
      }
    })
    toAddAdmin();
  });

  $("#hide").click(function(){
    $(".old").hide();
    $(".new").show();
  });

  function toAddAdmin() {
    normalDialog("条码号", document.getElementById("addAdmin"), "确认", function(t) {
      $('#objId').removeAttr("disabled");
      $.ajax({
        type:"POST",
        async:false,
        url:"/good/nbarcode.html",
        dataType: "json",
        data:$("#addobj").serialize(),
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

})

</script>
    <div class="footer">
      <p class="version">Copyright@2019 运营管理中心 版权所有，不允许任何形式的转载以及拷贝，违者必究。 &nbsp;&nbsp;</p>
    </div>
    <script type="text/javascript" src="__JS__/jquery.ba-resize.js"></script>
</body>
</html>