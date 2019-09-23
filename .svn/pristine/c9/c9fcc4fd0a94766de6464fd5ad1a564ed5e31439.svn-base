{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_recharge_box" style="clear:both;">
    <div class="account_recharge_tabhref">
      <ul>
        <li><a href="<?php echo url('pzu/mrecharge');?>" title="充值管理">充值管理</a></li>
        <li><a href="<?php echo url('pzu/mwithdraw');?>" title="提现管理" class="active">提现管理</a></li>
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
                <th> 提现编号 </th>
                <th> 提现时间 </th>
                <th> 提现方式 </th>
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
                <th> <?php echo $val['withdraw_no'];?> </th>
                <th> <?php echo $val['addtime'];?> </th>
                <th> 
					<?php  
                    $withdraw_note = json_decode(base64_decode($val['withdraw_note']),true);
                    if($val['pay_way'] == 'ALIPAY'){
                        echo '支付宝('.$withdraw_note['alipayAccount'].')';
                    }else if($val['pay_way'] == 'WECHAT'){
                        echo '微信('.$withdraw_note['wxAccount'].')';
                    }else{
                        echo $withdraw_note['bankName'].'(尾号'.substr($withdraw_note['cardNum'],-4).')';
                    }
                    ?>
				</th>
                <th> <?php echo number_format($val['amount']/100,2);?> </th>
                <th> <?php echo isset($financeStatusArr[$val['status']]) ? $financeStatusArr[$val['status']] :'处理中';?> </th>
                <th><?php echo ($val['status'] == '1') ? '<a href="javascript:void(0);" class="colorred audit" data-s="2" data-no="'.$val['withdraw_no'].'">成功</a>　　<a href="javascript:void(0);" class="colorred audit" data-s="5" data-no="'.$val['withdraw_no'].'">失败</a>':$financeStatusArr[$val['status']];?>
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
			url :'<?php echo url('pzu/mwithdrawsave'); ?>' ,
			data : {objno:objno,status:status,i:Math.random()},
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