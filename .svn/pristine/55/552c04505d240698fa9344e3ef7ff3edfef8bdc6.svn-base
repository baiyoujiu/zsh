{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_recharge_box" style="clear:both;">
    <div class="account_recharge_tabhref">
      <ul>
        <li><a href="<?php echo url('pzu/mcert');?>" title="提现管理" class="active">认证管理</a></li>
      </ul>
    </div>
      <div class="account_recharge_div">
        <div class="recharge_tab_href" style="min-height:480px;">
          <table width="100%">
            <thead>
              <tr>
                <th colspan="5" align="center"></th>
              </tr>
              <tr class="recharge_tab_hrefotr">
                <th> 姓名 </th>
                <th> 身份证号 </th>
                <th> 认证时间 </th>
                <th> 状态 </th>
                <th> 操作 </th>
              </tr>
            </thead>
            <tbody>
              
			  <?php 
			  if(empty($lists)){
				echo '<tr class="recharge_tab_hrefotr"><th colspan="5">暂无充值记录</th></tr>';
			  }else{
			  foreach($lists as $val){?>
              <tr class="recharge_tab_hrefotr">
                <th> <?php echo $val['real_name'];?> </th>
                <th> <?php echo $val['identity']?Decrypt($val['identity']):'';?> </th>
                <th> <?php echo $val['cert_time'];?> </th>
                <th> <?php echo $statusArr[$val['status']];?> </th>
                <th><?php echo ($val['status'] == '0') ? '<a href="javascript:void(0);" class="colorred audit" data-s="1" data-no="'.$val['id'].'">通过</a>　　<a href="javascript:void(0);" class="colorred audit" data-s="3" data-no="'.$val['id'].'">未通过</a>':$statusArr[$val['status']];?>
                </th>
              </tr>
              <?php }} ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="6">
                <?php echo $pageHtml;?>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
  </div>
</div>
<script type="text/javascript">
$(function () {
	$('.audit').click(function(){
		var status = $(this).data('s');
		var objno = $(this).data('no');
		$.ajax( {
			url :'<?php echo url('pzu/mcertsave'); ?>' ,
			data : {objid:objno,status:status,i:Math.random()},
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