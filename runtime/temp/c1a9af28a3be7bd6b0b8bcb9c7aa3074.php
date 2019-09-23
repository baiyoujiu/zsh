<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:39:"../template/mcenter/category\xitong.php";i:1567675009;s:52:"D:\wamp\work\zsh\template\mcenter\common\uheader.php";i:1567594450;s:55:"D:\wamp\work\zsh\template\mcenter\common\uheaderNav.php";i:1567501447;s:50:"D:\wamp\work\zsh\template\mcenter\common\usnav.php";i:1567672429;s:52:"D:\wamp\work\zsh\template\mcenter\common\ufooter.php";i:1564996439;}*/ ?>
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
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.myconfig.js"></script>
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/uedit/lang/zh-cn/zh-cn.js"></script>
<style>
    #divcss5{margin:0 auto;border:0px solid #000;width:300px;height:30px}
</style>
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
        <li tabindex="categoryxitong"><a href="<?php echo url('category/xitong');?>">自提驿站</a></li>
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

  </ul>
</div>
        <!--left Nav end-->
        <div class="col-md-11 main_right">
            <div class="row">
                <div class="box">
                    <form class="form-horizontal withdraw-form" role="form" id="objForm" method="post">
                    <div id="divcss5">
                        <select class="form-control" name="type" id="tid">
                            <?php foreach($typearr as $k=>$v){?>
                                <option value="<?php echo $k;?>"<?php echo $k==$info['type']?"selected='selected'":'';?>><?php echo $v;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="content">
                        <div class="form-horizontal bank-card-new">

                                <div class="form-group alipay">
                                    <label for="bankcard" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-8">
                                        <script id="content" type="text/plain" style="width:100%;height:500px;" ></script>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bankcard" class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-8 text-left">
                                        <a class="btn btn-major btn-big saveBtn" data-t="<?php echo $k;?>">保存</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<textarea id="contentdiv" style="display:none"><?php echo $info['content']?> </textarea>


<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('content');
    var content = $("#contentdiv").val();
    ue.ready(function() {
        ue.setContent(content);
    });


    $(function(){
        menuleft("categoryxitong");

        $('#tid').change(function(){
            var type = $(this).val();
            window.location.href = '/category/xitong.html?type='+type;
        })


        $('.saveBtn').click(function(){
            $.post("/Category/xitongsave.html", $('#objForm').serialize(),
                function(data){
                    if (data.status == 200) {
                        $('.saveBtn').attr('disabled',true);
                        window.location.reload();
                    } else {
                        art.dialog.alert(data.msg);
                    }
                });
        })
    });
</script>
    <div class="footer">
      <p class="version">Copyright@2019 运营管理中心 版权所有，不允许任何形式的转载以及拷贝，违者必究。 &nbsp;&nbsp;</p>
    </div>
    <script type="text/javascript" src="__JS__/jquery.ba-resize.js"></script>
</body>
</html>