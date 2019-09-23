{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_box hengruibao_in_box">
    <h1><i></i>约稿</h1>
    <div class="account_z_box">
      <dl>
        <dt>约稿概况</dt>
        <dd><span>账户余额：</span><?php echo number_format($finfo['balance']/100,2)?><span style="width:auto;">元</span></dd>
        <dd><span>待收稿数：</span><?php echo number_format($infomore['wantwritten'])?><span style="width:auto;">篇</span></dd>
        <dd><a class="btn BtnSty" href="<?php echo url('pzu/ygorder');?>">约稿订单</a></dd>
      </dl>
    </div>
    <div class="searchForm">
      <form action="" method="get">
          作家:<input name="keywords" type="text" class="input-text-style-1" value="<?php echo $keywords;?>" placeholder="请输入作家昵称" />
          <input name="submit" type="submit" class="btn-submit" value="筛选" />
      </form>
      </div>
    <div class="table_tab">
        <table cellpadding="0" cellspacing="0" class="record-list">
        	<tr>
              <th> 作家 </th>
              <th> 累计交稿 </th>
              <th> 待交交稿 </th>
              <th> 周交稿 </th>
              <th> 稿费/篇 </th>
              <th> 操作 </th>
            </tr>
            <tbody id="rollin" data-cnt="1" data-name="rollInHistoryList">
          <?php foreach($lists as $val){?>
          <tr>
            <td><?php echo $val['nickname'];?></td>
            <td><?php echo number_format($val['haswritten']);?></td>
            <td><?php echo number_format($val['towritten']);?></td>
            <td><?php echo $val['weeknum'];?></td>
            <td>￥<?php echo $val['prices']/100;?>元</td> 
            <td><a class="btn BtnSty showbut" href="javascript:" data-t="<?php echo $val['towritten'];?>" data-h="<?php echo $val['haswritten'];?>" data-c="<?php echo $val['content'];?>" data-n="<?php echo $val['nickname'];?>" data-p="<?php echo $val['prices']/100;?>" style="width:28px;padding:0 5px;float: none;">查看</a>　<a class="btn BtnSty ygbut" href="javascript:" data-u="<?php echo $val['userid'];?>" data-n="<?php echo $val['nickname'];?>" data-p="<?php echo $val['prices']/100;?>" style="width:28px;padding:0 5px;float: none;">约稿</a></td>
          </tr>
          <?php }?>
          <?php if(empty($lists)){?>
          <tr>
            <td colspan="6" class="tac">暂无数据</td>
          </tr>
          <?php }?>
          </tbody>
          <tfoot>
            <tr>
              <td id="interestlist_footer" colspan="6"><?php echo $pageHtml;?></td>
            </tr>
          </tfoot>
        </table>
        
     
    </div>
  </div>
</div>

<!--弹窗区域-->
<div class="bg_black"></div>
<!--弹窗区域   约稿-->
<div class="toWinUser">
	<div class="Enterpsw" style="height:280px;width:400px;">
      <h1>约稿</h1>
      <form id="toWin">
      <input name="author" type="hidden" value="" id="author" />
      <table cellpadding="0" cellspacing="0" style="  width: 100%;height: 70%;border: 1px solid #DEDEDE;">
        <tr>
          <th> 作家 </th>
          <td id="nickname"></td>
        </tr>
        <tr>
          <th> 稿费/篇 </th>
          <td id="prices"></td>
        </tr>
        <tr>
          <th> 约稿篇数<b class="colorred">*</b> </th>
          <td><input class="BrdHei" name="num" type="number" placeholder="请输入约稿篇数，大于10" onkeyup="value=value.replace(/[^\d]/g,'')"  value="50"/></td>
        </tr>
        <tr>
          <th> 支付密码<b class="colorred">*</b></th>
          <td><input class="BrdHei" name="paypass" type="password" placeholder="请输入支付密码"/></td>
        </tr>
        <tr>
          <td class="label">&nbsp;</td>
          <td><input name="" type="button" class="BtnSty" id="saveBtnWin" style="margin:20px 0px;width:150px;" value="提交申请" /></td>
        </tr>
      </table>
      </form>
      <div class="ClosebtnWin"></div>
    </div>
</div>
<!--弹窗区域   约稿-->
<div class="toenddiv">
	<div class="Enterpsw" style="height:280px;width:400px; top:80px;">
      <h1>查看写手信息</h1>
      <table cellpadding="0" cellspacing="0" style="width: 100%;height:70%; line-height:25px;border: 1px solid #DEDEDE;">
        <tr>
          <td> 写手: <span id="snickname"></span></td>
          <td> 稿费/篇:<span id="sprices"></span></td>
        </tr>
        <tr>
          <td> 待交:<span id="towritten"></span></td>
          <td> 过稿:<span id="haswritten"></span></td>
        </tr>
        <tr>
          <td colspan="2"> 简介<textarea id="content" name="content" cols="45" rows="7"></textarea></td>
        </tr>
      </table>
      <div class="CloseStockbtn"></div>
    </div>
</div>

<script type="text/javascript">

    $(function () {
		//查看
		$('.showbut').click(function () {
			var content = $(this).data('c'),nickname = $(this).data('n'),prices = $(this).data('p'),towritten = $(this).data('t'),haswritten = $(this).data('h');
			$('#content').val(content);
			$('#snickname').html(nickname);
			$('#sprices').html('￥'+prices);
			$('#towritten').html(towritten+'篇');
			$('#haswritten').html(haswritten+'篇');

			$(".toenddiv").show();
			$(".toenddiv>div").show();
			$(".bg_black").show();
			var dh = 660;
			var ih = $(window).height();
			var zh = (ih - dh) / 2;
			$(".toShowUser>div").css("top", zh);	
		});
		$(".CloseStockbtn").click(function() {
			$(this).parent("div").hide().parent(".toenddiv").hide();
			$(".bg_black").hide();
		});
		
		//约稿
		$('.ygbut').click(function () {
			var author = $(this).data('u'),nickname = $(this).data('n'),prices = $(this).data('p');
			$('#author').val(author);
			$('#nickname').html(nickname);
			$('#prices').html('￥'+prices);

			$(".toWinUser").show();
			$(".toWinUser>div").show();
			$(".bg_black").show();
			var dh = 660;
			var ih = $(window).height();
			var zh = (ih - dh) / 2;
			$(".toWinUser>div").css("top", zh);	
		});
		$(".ClosebtnWin").click(function() {
			$(this).parent("div").hide().parent(".toWinUser").hide();
			$(".bg_black").hide();
		});
		$('#saveBtnWin').click(function(){
			var saveBtn = $(this);
			saveBtn.attr("disabled", true);
			$.ajax({
				url: '/pzu/ygsave.html',
				cache: false,
				data: $('#toWin').serialize(),
				type: 'post',
				dataType: 'json',
				success: function (data) {
					if (data.status == 200) {
						CFW.dialog.alert(data.msg, 4, { listener: function () { window.location.reload(); } });
					}else{
						CFW.dialog.alert(data.msg, 4, null);
						saveBtn.attr("disabled", false);
					}
				}
			});
		})
	})

</script> 
{include file="common/ufooter" /}