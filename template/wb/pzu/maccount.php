{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_box hengruibao_in_box">
    <div class="tab_link_style"> <span class="row_jl">收支明细</span></div>
    <div class="user-box-2">
      <div class="searchForm">
      <form action="" method="get">
          业务类型:<select name="typeKey" class="searchSelect">
          	<option value="0"<?php echo empty($typeKey)?' selected="selected"':'';?>>-请选择-</option>
          	<?php foreach($typeArr as $sk=>$sv){?>
            <option value="<?php $sk++;echo $sk;?>"<?php echo ($typeKey==$sk)?' selected="selected"':'';?>><?php echo $sv;?></option>
            <?php }?>
          </select>
          　业务编号:<input name="keywords" type="text" class="input-text-style-1" value="<?php echo $keywords;?>" placeholder="请输入业务编号或用户昵称" />
          <input name="submit" type="submit" class="btn-submit" value="筛选" />
      </form>
      </div>
      <div class="table_tab"> 
        <!--已购策略-->
        <table cellpadding="0" cellspacing="0" class="record-list">
          <thead>
            <tr>
              <th> 流水号 </th>
              <th> 用户 </th>
              <th> 业务编号 </th>
              <th> 业务类型 </th>
              <th> 收/支</th>
              <th> 交易额</th>
              <th> 交易后</th>
              <th> 交易时间 </th>
            </tr>
          </thead>
          <tbody id="rollin" data-cnt="1" data-name="rollInHistoryList">
            <?php foreach($lists as $val){?>
            <tr>
              <td><?php echo $val['serial_number'];?></td>
              <td><?php echo $useridarr[$val['userid']];?></td>
              <td><?php echo $val['business_no'];?></td>
              <td><?php echo $typeArr[$val['type']];?></td>
              <td style="color:<?php echo ($val['inout']==1)?'green':'red';?>; font-weight: bold;"><?php echo ($val['inout']==1)?'收入':'支出';?></td>
              <td><?php echo number_format($val['amount']/100,2);?></td>
              <td><?php echo number_format($val['amount_after']/100,2);?></td>
              <td><?php echo substr($val['addtime'],2,8);?></td>
            </tr>
            <?php }?>
            <?php if(empty($lists)){?>
          <tr><td colspan="6" class="tac">暂无数据</td></tr>
            <?php }?>
           </tbody>
        </table>
        <?php echo $pageStr;?>
      </div>
    </div>
  </div>
</div>
{include file="common/ufooter" /}