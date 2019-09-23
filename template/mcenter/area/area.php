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
    #allmap{width:100%;height:350px;}
    p{margin-left:5px; font-size:14px;}
</style>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=xqltRQVqD5bh1G3NPyyQpuuTlgaYv4GR"></script>
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
                                <li class="active"><a href="<?php echo url('area/area');?>">地区管理</a></li>
                            </ul>
                            <a class="btn btn-major btn-small shopHelp" id="Addadmin" href="javascript:;">添加地区</a>
                        </div>
                        <div class="content" style="position:relative;">
                            <ul class="newpager">
                                <li class="previous">
                                    <div class="form-inline text-right marginTop">
                                        <div class="form-group">
                                            <select class="form-control" name="acode">
                                                <option value="0">所属区域</option>
                                                <?php foreach($alists as $k=>$v){?>
                                                    <option value="<?php echo $k;?>" <?php echo ($acode == $k)?'selected="selected"':'';?>><?php echo $v;?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="status">
                                                <option value="0">状态</option>
                                                <?php foreach($statusArr as $k=>$v){?>
                                                    <option value="<?php echo $k+1;?>" <?php echo ($status == $k+1)?'selected="selected"':'';?>><?php echo $v;?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group" style="position:relative;">
                                            <input class="form-control changeStyle ui-input" type="text" name="address" placeholder="请输入驿站地址" value="<?php echo $address;?>">
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
                                    <th>编号</th>
                                    <th>驿站名称</th>
                                    <th>所属地区</th>
                                    <th>驿站地址</th>
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
                                            <td><?php echo $v['code'];?></td>
                                            <td><?php echo $v['area'];?></td>
                                            <td><?php echo $alists[$v['area_code']];?></td>
                                            <td><?php echo $v['address'];?></td>
                                            <td><?php echo ($v['status'])?'有效':'无效';?></td>
                                            <td>
                                                <a href="javascript:void(0)" data-id="<?php echo $v['code'];?>" data-acode="<?php echo $v['area_code'];?>"  data-area="<?php echo $v['area'];?>" data-adr="<?php echo $v['address'];?>"  data-pic="<?php echo $v['pic'];?>"  data-la="<?php echo $v['latitude'];?>"  data-lo="<?php echo $v['longitude'];?>" data-w="<?php echo $v['weight'];?>" data-s="<?php echo $v['status'];?>" class="butedit">编辑</a>　
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
<div id="addAdmin" style="display:none;width:600px;">
    <form class="form-horizontal" role="form" id="addobj">
        <input type="hidden" id="objno" name="objno" value="" >
        <div class="clearfix zidingyi_css">
            <label for="groupname" class="control-label fl"><b class="clr-attention">*</b>所属地区：</label>
            <div class="col-md-6 fl">
                <select class="form-control" name="area_code" id="area_code">
                    <option value="">请所选择所属地区</option>
                    <?php foreach($alists as $k=>$v){?>
                        <option value="<?php echo $k;?>"><?php echo $v;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="clearfix zidingyi_css">
            <label for="groupname" class="control-label fl"><b class="clr-attention">*</b>驿站名称:</label>
            <div class="col-md-6 fl">
                <input type="text" id="area" name="area"  class="form-control form-plugInput ui-input"   placeholder="请输入驿站名称" >
            </div>
        </div>
        <div class="clearfix zidingyi_css">
            <label  class="control-label fl" for="groupname"><b class="clr-attention">*</b>驿站地址:</label>
            <div class="col-md-6 fl">
                <input  id="address" name="address" type="text" class="form-control form-plugInput ui-input"  placeholder="请输入驿站地址">
            </div>
        </div>
        <div class="clearfix zidingyi_css">
            <label  class="control-label fl" for="groupname"><b class="clr-attention"></b>驿站照片:</label>
            <div class="col-md-6 fl">
                <input id="pic" name="pic" type="text" class="form-control form-plugInput ui-input"  placeholder="请输入驿站照片存储位置">
            </div>
        </div>
        <div class="clearfix zidingyi_css">
            <label for="groupname" class="control-label fl" >权重:</label>
            <div class="col-md-2 fl">
                <input id="weight" name="weight" type="text" class="form-control form-plugInput ui-input" placeholder="输入权重"  onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" value="">
            </div>

            <label for="groupname" class="control-label fl">状 态：</label>
            <div class="col-md-3 fl">
                <input type="radio" name="status" value="1" >有效 &nbsp; &nbsp;
                <input type="radio" name="status" value="0" checked="checked">无效 &nbsp; &nbsp;
            </div>
        </div>
        <div id="allmap"></div>
        <input name="longitude" type="hidden" id="longitude" value="">
        <input name="latitude" type="hidden"  id="latitude"  value="">
    </form>
</div>

<script type="text/javascript">
    var map = new BMap.Map("allmap");
$(function(){
    menuleft("categoryxitong");
    $(function() {
        $("#Addadmin").on("click", function(e) {
            e.stopPropagation();
            $('#objno').val('');
            $('#area_code').val(0);
            $('#area').val('');
            $('#address').val('');
            $('#weight').val(0);
            $('#pic').val('');
            $("#longitude").val('');
            $("#latitude").val('');
            $("input[name='status']:eq(0)").attr("checked",'checked');
        //初始化地图
            var map = new BMap.Map("allmap");
            map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
            map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
            map.centerAndZoom('杭州市',14);
            map.addEventListener("click",function(e){
                map.clearOverlays();
                point = new BMap.Point(e.point.lng, e.point.lat);
                var marker = new BMap.Marker(point);
                map.addOverlay(marker);
                marker.setAnimation(BMAP_ANIMATION_BOUNCE);
                var longitude = e.point.lng,latitude = e.point.lat;
                $("#longitude").val(e.point.lng);
                $("#latitude").val(e.point.lat);
            });
            toAddAdmin();
        });
        $('.butedit').click(function(){

            var objNo = parseInt($(this).data('id')),acode = parseInt($(this).data('acode')),area = $.trim($(this).data('area')),weight = parseInt($(this).data('w')),status = parseInt($(this).data('s')),address=$.trim($(this).data('adr')),pic=$.trim($(this).data('pic')),latitude=$.trim($(this).data('la')),longitude=$.trim($(this).data('lo'));
            $('#objno').val(objNo);
            $('#area_code').val(acode);
            $('#area').val(area);
            $('#address').val(address);
            $('#pic').val(pic);
            $('#weight').val(weight);
            $("#longitude").val(longitude);
            $("#latitude").val(latitude);
            if(status == 1){
                $("input[name='status'][value=1]").attr("checked",true);
            }else{
                $("input[name='status'][value=0]").attr("checked",true);
            }
            //定位原点并初始地图
            var map = new BMap.Map("allmap");
            map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
            map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
            point = new BMap.Point(longitude,latitude);
            map.centerAndZoom(point,15);
            var marker = new BMap.Marker(point);// 创建标注
            map.addOverlay(marker);             // 将标注添加到地图中
            marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
            map.panBy(300,160);
            map.addEventListener("click",function(e){
                map.clearOverlays();
                point = new BMap.Point(e.point.lng, e.point.lat);
                var marker = new BMap.Marker(point);
                map.addOverlay(marker);
                marker.setAnimation(BMAP_ANIMATION_BOUNCE);
                var longitude = e.point.lng,latitude = e.point.lat;
                $("#longitude").val(e.point.lng);
                $("#latitude").val(e.point.lat);
            });
            toAddAdmin();
        })
    });

    function toAddAdmin() {
//        $("title.error").remove();
//        $("title.error").hide();
        normalDialog("添加", document.getElementById("addAdmin"), "确认", function(t) {
            $.ajax({
                type:"POST",
                async:false,
                url:"/area/areasave.html",
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