{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_box hengruibao_in_box">
    <div class="tab_link_style"><span class="row_jl"><a href="<?php echo url('pzu/mnews');?>">稿件管理</a></span></div>
    <div class="user-box-2">
      <div class="searchForm">
      <form action="" method="get">
          关键字:<input name="keywords" type="text" class="input-text-style-1" value="<?php echo $keywords;?>" placeholder="请输入稿子编号/标题/写手/约稿方" />
          <input name="submit" type="submit" class="btn-submit" value="筛选" />
      </form>
      </div>
      <div class="table_tab"> 
        <!--已购策略-->
        <table cellpadding="0" cellspacing="0" class="record-list">
          <thead>
            <tr>
              <th>文章编号 </th>
              <th>标题</th>
              <th>写手</th>
              <th>约稿方</th>
              <th>添加时间</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody id="rollin" data-cnt="1" data-name="rollInHistoryList">
            <?php foreach($lists as $val){?>
            <tr>
              <td><?php echo $val['news_no'];?></td>
              <td><?php echo $val['title'];?></td>
              <td><?php echo $useridarr[$val['author']];?></td>
              <td><?php echo $useridarr[$val['userid']];?></td>
              <td><?php echo substr($val['addtime'],5,5);?></td>
              <td style="color:<?php echo ($val['status']==1)?'green':'red';?>; font-weight: bold;"><?php echo $statusArr[$val['status']];?></td>
              <td><a href="<?php echo url('pzu/newsedit').'?objNo='.$val['news_no'];?>">查看</a></td>
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
$(function () {
	$('.nooriginal').click(function(){
		var objno = $(this).data('no');
		$.ajax( {
			url :'<?php echo url('pzu/nooriginal'); ?>' ,
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
