<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:37:"../template/mcenter/category\spec.php";i:1568077138;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1568016764;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css" xmlns="http://www.w3.org/1999/html">
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
</style>
<!-- header end --> 
<!-- body -->
<div class="container" id="j-content">
  <div class="row">
    <!--left Nav start-->
    <div class="col-md-1 main_left"> 
  <ul class="ui_navbar" id="navbarlist">

    <li>
      <div><i class="iconfont icon-iconfontshezhi"></i>商品管理</div>
      <ul>
        <li tabindex="archex"><a href="<?php echo url('good/index');?>">商品列表</a></li>
        <li tabindex="categoryindex"><a href="<?php echo url('category/index');?>">分类管理</a></li>
        <li tabindex="categoryspec"><a href="<?php echo url('category/spec');?>">分类规格</a></li>
        <li tabindex="categoryattr"><a href="<?php echo url('category/attr');?>">分类属性</a></li>
        <li tabindex="categoryattri"><a href="<?php echo url('category/attri');?>">分类属性值</a></li>
        <li tabindex="systemxitong"><a href="<?php echo url('system/xitong');?>">系统</a></li>
        <li tabindex="systemstage"><a href="<?php echo url('system/stage');?>">自提驿站</a></li>
      </ul>
    </li>
    <li>
      <div><i class="iconfont icon-search"></i>订单管理</div>
      <ul>
        <li tabindex="ordersindex"><a href="<?php echo url('orders/index');?>">订单管理</a></li>
      </ul>
    </li>
    <li>
      <div><i class="iconfont icon-search"></i>用户管理</div>
      <ul>
        <li tabindex="membersindex"><a href="<?php echo url('members/index');?>">用户管理</a></li>
        <li tabindex="memberslog"><a href="<?php echo url('members/log');?>">登录信息</a></li>
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
                <li class="active"><a href="<?php echo url('category/spec');?>">分类规格</a></li>
              </ul>
              <a class="btn btn-major btn-small shopHelp" id="Addadmin" href="javascript:;">添加分类规格</a>

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
                      <input class="form-control changeStyle ui-input" type="text" name="keyword" placeholder="请输入规格名称" value="<?php echo $keyword;?>">
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
                    <th>权重</th>
                    <th>一级分类</th>
                    <th>规格名称</th>
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

                    <td><?php echo $v['weight'];?></td>
                    <td><?php foreach($catlists as $k => $d) {if($k == $v['cid'] ) echo $d;} ?></td>
                    <td><?php echo $v['name'];?></td>
                    <td><?php echo ($v['status'] == 2)?'发布':'未发布';?></td>
                          <td>
                            <a href="javascript:void(0)" data-id="<?php echo $v['id'];?>" data-c="<?php echo $v['cid'];?>"  data-t="<?php echo $v['name'];?>" data-w="<?php echo $v['weight'];?>" data-s="<?php echo $v['status'];?>" class="butedit">编辑</a>　
                          </td>
                          </tr>
                        <?php }
                      }?>
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
<div id="addAdmin" style="display:none;width:400px;">
  <form class="form-horizontal" role="form" id="addLabel">
    <input type="hidden" id="objNo" name="objNo" value="" >
    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl"><b class="clr-attention">*</b>分类选择：</label>
      <div class="col-md-6 fl">
          <select class="form-control" name="cid" id="cid">
            <option value="">请选择分类</option>
            <?php foreach($typeArr as $k=>$v){?>
              <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
            <?php }?>
          </select>
      </div>
    </div>
    <div class="clearfix zidingyi_css">
      <label class="control-label fl" for="groupname"><b class="clr-attention">*</b>规格名称：</label>
      <div class="col-md-6 fl">
        <input id="name" name="name" type="text" class="form-control form-plugInput ui-input" placeholder="输入规格名称">
      </div>
    </div>

    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl">权 重：</label>
      <div class="col-md-6 fl">
          <input type="text" class="form-control money ui-input" id="weight" name="weight" placeholder="请输入权 重" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" value="<?php echo $info['weight'];?>">
      </div>
    </div>

    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl">状 态：</label>
      <div class="col-md-6 fl">
          <input type="radio" name="status" value="1" >未发布 &nbsp; &nbsp;
          <input type="radio" name="status" value="2" checked="checked">发布 &nbsp; &nbsp;
      </div>
    </div>
  </form>
</div>



<script type="text/javascript">
$(function(){
    menuleft("categoryspec");
  //左菜单格式
  $(function() {
    $("#Addadmin").on("click", function(e) {
      e.stopPropagation();
      $('#cid').removeAttr("disabled");
      $('#cid').val('');
      $('#objNo').val('');
      $('#name').val('');
      $('#weight').val(0);
      $("input[name='status']:eq(2)").attr("checked",'checked');//设置属性
      toAddAdmin();
    });


    $('.butedit').click(function(){
      var objNo = parseInt($(this).data('id')),cid = parseInt($(this).data('c')),name = $.trim($(this).data('t')),weight = parseInt($(this).data('w')),status = parseInt($(this).data('s'));
      $('#objNo').val(objNo);
      $('#cid').val(cid);
      $('#name').val(name);
      $('#weight').val(weight);
      $('#cid').attr("disabled","disabled");
      if(status == 1){
        $("input[name='status'][value=1]").attr("checked",true);
      }else{
        $("input[name='status'][value=2]").attr("checked",true);
      }
      toAddAdmin();
    })
  });

  function toAddAdmin() {
    $("title.error").remove();
    $("title.error").hide();
    var id;
    normalDialog("分类规格", document.getElementById("addAdmin"), "确认", function(t) {
      $("title.error").remove();
      $("title.error").hide();
      $('#cid').removeAttr("disabled");
      $.ajax({
          type:"POST",
          async:false,
          url:"/category/specsave.html",
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