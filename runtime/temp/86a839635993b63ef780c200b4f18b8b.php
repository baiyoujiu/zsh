<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:34:"../template/mcenter/zhuanti\zg.php";i:1568194882;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1568016764;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
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
                <li class="active"><a href="<?php echo url('zhuanti/zg');?>">专题商品列表</a></li>
              </ul>
              <a class="btn btn-major btn-small shopHelp" id="Addadmin" href="javascript:;">添加专题商品</a>
            </div>
            <div class="content" style="position:relative;">
              <ul class="newpager">
                <li class="previous">
                  <div class="form-inline text-right marginTop">
                    <div class="form-group">
                      <select class="form-control" name="ztid">
                        <option value="0">版块</option>
                        <?php foreach($alists as $k=>$v){?>
                        <option value="<?php echo $v['id'];?>" <?php echo ($ztid == $v['id'])?'selected="selected"':'';?>><?php echo $blists[$v['pid']].'>'.$v['name'];?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="form-group" style="position:relative;">
                      <input class="form-control changeStyle ui-input" type="text" name="keyword" placeholder="请输入商品编号" value="<?php echo $keyword;?>">
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
                    <th>专题</th>
                    <th>专题版块</th>
                    <th>商品编号</th>
                    <th>权重</th>
                    <th>更新时间</th>
                    <th>编辑</th>
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
                        <td><?php echo $blists[$v['ztid']];?></td>
                        <td><?php echo $blists[$v['cid']];?></td>
                        <td><?php echo $v['gno'];?></td>
                        <td><?php echo $v['weight'];?></td>
                        <td><?php echo $v['updatetime'];?></td>
                        <td>
                          <a href="javascript:void(0)" data-id="<?php echo $v['id'];?>" data-z="<?php echo $v['ztid'];?>" data-c="<?php echo $v['cid'];?>"  data-g="<?php echo $v['gno'];?>" data-w="<?php echo $v['weight'];?>" class="butedit">编辑</a>　
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
<div id="addAdmin" style="display:none;width:400px;">
  <form class="form-horizontal" role="form" id="addLabel">
    <input type="hidden" id="objNo" name="objNo" value="" >
    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl"><b class="clr-attention">*</b>所属版块：</label>
      <div class="col-md-6 fl">
        <select class="form-control" name="cid" id="cid">
          <option value="0">请选择</option>
          <?php foreach($alists as $k=>$v){?>
            <option value="<?php echo $v['id'];?>" <?php echo ($cid == $v['id'])?'selected="selected"':'';?>><?php echo $blists[$v['pid']].'>'.$v['name'];?></option>
          <?php }?>
        </select>
      </div>
    </div>
    <div class="clearfix zidingyi_css">
      <label class="control-label fl" for="groupname"><b class="clr-attention">*</b>商品编号：</label>
      <div class="col-md-6 fl">
        <input id="gno" name="gno" type="text" class="form-control form-plugInput ui-input" placeholder="输入商品编号">
      </div>
    </div>
    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl">权 重：</label>
      <div class="col-md-6 fl">
        <input type="text" class="form-control money ui-input" id="weight" name="weight" placeholder="请输入权 重" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" value="<?php echo $info['weight'];?>">
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">
$(function(){
    menuleft("zhuantizg");

  $(function() {
    $("#Addadmin").on("click", function(e) {
      e.stopPropagation();
      $('#cid').val('');
      $('#gno').val('');
      $('#objNo').val('');
      $('#weight').val(0);
      toAddAdmin();
    });

    $('.butedit').click(function(){
      var objNo = parseInt($(this).data('id')),cid = parseInt($(this).data('c')),gno = $.trim($(this).data('g')),weight = parseInt($(this).data('w'));
      $('#cid').val(cid);
      $('#gno').val(gno);
      $('#objNo').val(objNo);
      $('#weight').val(weight);
      toAddAdmin();
    })
  });

  function toAddAdmin() {
    normalDialog("商品", document.getElementById("addAdmin"), "确认", function(t) {
      $.ajax({
        type:"POST",
        async:false,
        url:"/zhuanti/zgsave.html",
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

