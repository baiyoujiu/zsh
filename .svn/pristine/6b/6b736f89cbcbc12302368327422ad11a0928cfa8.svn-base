{include file="common/uheader" /}
<style>.infcon{line-height: 25px;border-bottom: 1px solid #CCC;}</style>
<div class="user_right_box2017">
  <div class="account_box hengruibao_in_box">
  		<div class="tab_link_style"> <span class="row_jl"><a href="<?php echo url('pzu/ygorder');?>">约稿订单</a></span>
            <ul id="record"><li class="current"><a href="#" class="colorred">稿件要求</a></li></ul>
        </div>
        <div class="webset">
          <dl>约稿方：<?php echo $info['nickname'];?></dl>
          <dl>待收稿数：<?php echo $info['wantwritten'];?>篇　　　　　　　　已收稿数：<?php echo $info['haswritten'];?>篇　　　　　　　　周需稿数：<?php echo $info['weeknum'];?>篇</dl>
           <dl class="colorred">稿件要求</dl>
          <dl class="infcon"><?php echo nl2br($info['content']);?></dl>
          <dl class="colorred">经典语录</dl>
          <?php foreach($lists as $v){?>
          <dl><?php echo $info['updatetime'].'-【'.$v['classicno'].'】';?></dl>
          <dl class="infcon"><?php echo nl2br($v['content']);?></dl>
          <?php }?>
        </div>
  </div>
</div>
{include file="common/ufooter" /}