{include file="common/uheader" /}
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css">
{include file="common/uheaderNav" /}
<style>
.form-group{ display:inline-block;}
</style>
<!-- header end --> 
<!-- body -->
<div class="container" id="j-content">
  <div class="row">
    <!--left Nav start-->
    {include file="common/usnav" /}
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
{include file="common/ufooter" /}