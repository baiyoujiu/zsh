{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_box hengruibao_in_box">
    <div class="tab_link_style"> <span class="row_jl">登陆明细</span>
        <ul id="record"><li>&nbsp;</li></ul>
    </div>
    <div class="user-box-2">
      <div class="searchForm">
      <form action="" method="get">
          　关键字:<input name="keywords" type="text" class="input-text-style-1" value="<?php echo $keywords;?>" placeholder="请输入用户名/手机号" />
          <input type="submit" class="btn-submit" value="筛选" />
      </form>
      </div>
      <div class="table_tab"> 
        <!--已购策略-->
        <table cellpadding="0" cellspacing="0" class="record-list">
          <thead>
            <tr>
              <th> 用户名 </th>
                <th> 手机号 </th>
                <th> 登陆时间 </th>
            </tr>
          </thead>
          <tbody id="rollin" data-cnt="1" data-name="rollInHistoryList">
            <?php foreach($lists as $val){?>
            <tr>
              <td><?php echo $val['username'];?></td>
              <td><?php echo $val['phone'];?></td>
              <td><?php echo $val['save_time'];?></td>
            </tr>
            <?php }?>
            <?php if(empty($lists)){?>
          <tr><td colspan="3" class="tac">暂无数据</td></tr>
            <?php }?>
           </tbody>
        </table>
        <?php echo $pageStr;?>
      </div>
    </div>
  </div>
</div>
{include file="common/ufooter" /}