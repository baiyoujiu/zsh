{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_recharge_box" style="clear:both;">
    <div class="account_recharge_tabhref">
      <ul>
        <li><a href="<?php echo url('pzu/recharge');?>" title="充值-<?php echo $webSet['title'];?>">充值</a></li>
        <li><a href="<?php echo url('pzu/rechargelog');?>" title="充值流水-<?php echo $webSet['title'];?>" class="active">充值流水</a></li>
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
                <th> 充值编号 </th>
                <th> 充值时间 </th>
                <th> 充值方式 </th>
                <th> 金额 </th>
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
                <th> <?php echo $val['recharge_no'];?> </th>
                <th> <?php echo $val['addtime'];?> </th>
                <th>
                	<?php  
					$withdraw_note = json_decode(base64_decode($val['recharge_note']),true);
					if($val['pay_way'] == 'ALIPAY'){
						echo '支付宝('.substr($withdraw_note['alipayAccount'],0,6).'***)';
					}else if($val['pay_way'] == 'WECHAT'){
						echo '微信('.$withdraw_note['wxAccount'].')';
					}else{
						echo $withdraw_note['bankName'].'(尾号'.substr($withdraw_note['cardNum'],-4).')';
					}
					?> 
                </th>
                <th> <?php echo number_format($val['amount']/100,2);?> </th>
                <th> <?php echo isset($financeStatusArr[$val['status']]) ? $financeStatusArr[$val['status']] :'处理中';?> </th>
                <th><?php echo ($val['status'] == '3') ? '<a href="javascript:void(0);" class="colorred showWhy" data-why="'.$val['back_receipt'].'">查看原因</a>' :$financeStatusArr[$val['status']];?></th>
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
	$('.showWhy').click(function(){
		var withdraw_why = $(this).data('why');
		CFW.dialog.alert(withdraw_why, 1, null);
	})
});	
</script>
{include file="common/ufooter" /}