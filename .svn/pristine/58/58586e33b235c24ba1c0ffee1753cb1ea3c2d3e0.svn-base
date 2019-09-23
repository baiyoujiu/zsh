{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_box hengruibao_in_box">
    <div class="tab_link_style"><span class="row_jl">约稿订单</span>
    </div>
    <div class="user-box-2">
      <div class="searchForm">
      <form action="" method="get">
      	<?php echo '写手';?>:<select name="suserid" class="searchSelect">
          	<option value="0"<?php echo empty($suserid)?' selected="selected"':'';?>>-请选择-</option>
          	<?php foreach($useridarr as $k=>$v){?>
            <option value="<?php echo $k;?>" <?php echo $k==$suserid?' selected="selected"':'';?>><?php echo $v;?></option>
            <?php }?>
          </select>
          关键字:<input name="keywords" type="text" class="input-text-style-1" value="<?php echo $keywords;?>" placeholder="请输入订单编号" />
          <input name="submit" type="submit" class="btn-submit" value="筛选" />
      </form>
     
      
      </div>
      <div class="table_tab"> 
        <!--已购策略-->
        <table cellpadding="0" cellspacing="0" class="record-list">
          <thead>
            <tr>
              <th>订单编号 </th>
              <th>写手</th>
              <th>约稿方</th>
              <th>约稿数</th>
              <th>交/过稿数</th>
              <th>约稿时段</th>
              <th>状态</th>
            </tr>
          </thead>
          <tbody id="rollin" data-cnt="1" data-name="rollInHistoryList">
            <?php foreach($lists as $val){?>
            <tr>
              <td><?php echo $val['order_no'];?></td>
              <td><?php echo $useridarr[$val['author']];?></td>
              <td><?php echo $yuseridarr[$val['userid']];?></td>
              <td><?php echo $val['num'];?></td>
              <td><?php echo $val['headnum'].'/'.$val['passnum'];?></td>
              
              <td><?php echo substr($val['addtime'],2,8).'/'.(empty($val['finishtime'])?substr($val['endtime'],2,8):substr($val['finishtime'],2,8));?></td>
              <td <?php echo $val['status']==6?' class="colorred"':'';?>><?php echo $statusArr[$val['status']];?></td>
            </tr>
            <?php }?>
            <?php if(empty($lists)){?>
          <tr><td colspan="7" class="tac">暂无数据</td></tr>
            <?php }?>
           </tbody>
        </table>
        <?php echo $pageStr;?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
//无用
$(function () {
	$('.sendxzh').click(function(){
		var objno = $(this).data('no');
		$.ajax( {
			url :'<?php echo url('pzu/sendxzh'); ?>' ,
			data : {objno:objno,i:Math.random()},
			type : 'post' ,
			dataType : 'json',
			cache : false ,
			success : function(data){
			   if(data.status == 200 ){
				    CFW.dialog.alert(data.msg,4, { listener: function () {window.location.reload();} });
				}else{
					CFW.dialog.alert(data.msg, 3, null);
				}  
			},
			error : function(){
				CFW.dialog.alert('服务器繁忙，请稍后重试', 3, null);
			}
		});
	})
});	
</script>
{include file="common/ufooter" /}
