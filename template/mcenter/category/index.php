{include file="common/uheader" /}
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css">
{include file="common/uheaderNav" /}
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
    {include file="common/usnav" /}
    <!--left Nav end-->
    <div class="col-md-11 main_right">
      <div class="row">
        <form id="formPage" method="get">
          <div class="box">
            <div class="title help-course-f">
              <ul class="nav nav-tabs" style="margin-top: 16px;padding-left: 16px;">
                <li class="active"><a href="<?php echo url('category/index');?>">分类管理</a></li>
              </ul>
              <a class="btn btn-major btn-small shopHelp" id="Addadmin" href="javascript:;">添加分类</a>
            </div>
            <div class="content" style="position:relative;">
              <ul class="newpager">
                <li class="previous">
                  <div class="form-inline text-right marginTop">
                    <div class="form-group">
                      <select class="form-control" name="status">
                        <option value="0">状态</option>
                        <?php foreach($statusArr as $k=>$v){?>
                        <option value="<?php echo $k;?>" <?php echo ($status == $k)?'selected="selected"':'';?>><?php echo $v;?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="form-group" style="position:relative;">
                      <input class="form-control changeStyle ui-input" type="text" name="keyword" placeholder="请输入分类名称" value="<?php echo $keyword;?>">
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
                    <th>分类</th>
                    <th>权重</th>
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
					<td><?php echo $v['name'];?></td>
                    <td><?php echo $v['weight'];?></td>
                    <td><?php echo ($v['status'] == 2)?'已发布':'未发布';?></td>
                    <td>
                        <a href="javascript:void(0)" data-id="<?php echo $v['id'];?>" data-cid="<?php echo $v['cid'];?>"  data-t="<?php echo $v['name'];?>" data-w="<?php echo $v['weight'];?>" data-s="<?php echo $v['status'];?>" data-i="<?php echo $v['icon'];?>"data-d="<?php echo $v['desc'];?>"class="butedit">编辑</a>　
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
  <form class="form-horizontal" role="form" id="addobj">
    <input type="hidden" id="objNo" name="objNo" value="" >
    <div class="clearfix zidingyi_css">
      <label class="control-label fl" for="groupname"><b class="clr-attention">*</b>分类名称：</label>
      <div class="col-md-6 fl">
        <input id="name" name="name" type="text" class="form-control form-plugInput ui-input" placeholder="输入分类名称">
      </div>
    </div>

    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl"><b class="clr-attention">*</b>图标：</label>
      <div class="col-md-6 fl">
        <input type="text" class="form-control form-plugInput ui-input" id="icon" name="icon"  placeholder="请输入图标地址" value="">
      </div>
    </div>

    <div class="clearfix zidingyi_css">
    <label for="groupname" class="control-label fl"><b class="clr-attention">*</b>分类描述：</label>
    <div class="col-md-6 fl">
      <input type="text" id="desc" class="form-control form-plugInput ui-input" name="desc" value="0"  placeholder="请输入描述">
    </div>

    <div class="clearfix zidingyi_css">
    <label for="groupname" class="control-label fl"><b class="clr-attention"></b>权 重：</label>
    <div class="col-md-6 fl">
      <input type="text" class="form-control form-plugInput ui-input" id="weight" name="weight" placeholder="请输入权 重" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" value="">
    </div>
    </div>
</div>

    <div class="clearfix zidingyi_css">
      <label for="groupname" class="control-label fl"><b class="clr-attention"></b>状 态：</label>
      <div class="col-md-6 fl">
          <input type="radio" name="status" value="1" >未发布 &nbsp; &nbsp;
          <input type="radio" name="status" value="2" checked="checked">发布 &nbsp; &nbsp;
      </div>
    </div>

  </form>
</div>



<script type="text/javascript">
$(function(){
    menuleft("categoryindex");

  $(function() {
    $("#Addadmin").on("click", function(e) {
      e.stopPropagation();
      $('#objNo').val('');
      $('#name').val('');
      $('#icon').val('');
      $('#desc').val('');
      $('#weight').val(0);
      $("input[name='status']:eq(0)").attr("checked",'checked');
      toAddAdmin();
    });

    $("#adminFrom").on("click", ".act-del", function(e) {
      e.stopPropagation();

      groupDel($(this));
    });

    $('.butedit').click(function(){
      var name = $.trim($(this).data('t')),objNo = $.trim($(this).data('id')),weight = parseInt($(this).data('w')),icon = $.trim($(this).data('i')),desc =$.trim($(this).data('d')),status = parseInt($(this).data('s'));
      $('#name').val(name);
      $('#objNo').val(objNo);
      $('#weight').val(weight);
      $('#icon').val(icon);
      $('#desc').val(desc);
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
    normalDialog("分类", document.getElementById("addAdmin"), "确认", function(t) {
      $("title.error").remove();
      $("title.error").hide();

      $.ajax({
          type:"POST",
          async:false,
          url:"/category/catsave.html",
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


});
</script>
{include file="common/ufooter" /}