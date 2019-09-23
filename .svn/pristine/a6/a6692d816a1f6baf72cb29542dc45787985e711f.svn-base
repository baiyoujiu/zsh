{include file="common/uheader" /}
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css">
{include file="common/uheaderNav" /}
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
    {include file="common/usnav" /}
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
{include file="common/ufooter" /}

