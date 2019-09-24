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
{include file="common/ufooter" /}