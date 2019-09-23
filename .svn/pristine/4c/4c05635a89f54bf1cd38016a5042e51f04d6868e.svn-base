{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_box hengruibao_in_box">
    <h1><i></i>经典语录</h1>
    <div class="searchForm">
      <form action="" method="get">
          经典语录编号:<input name="keywords" type="text" class="input-text-style-1" value="<?php echo $keywords;?>" placeholder="请输入经典语录编号" />
          <a href="<?php echo url('pzu/wbinf').'?userid='.$userInfo['userid'];?>"><input type="button" class="btn-submit" value="语录详情" /></a>
          <input type="button" class="btn-submit editbut" data-n="生成中" data-c="" value="添加" />
          <input name="submit" type="submit" class="btn-submit" value="筛选" />
      </form>
      </div>
    <div class="table_tab">
        <table cellpadding="0" cellspacing="0" class="record-list">
        	<tr>
              <th> 语录编号 </th>
              <th> 经典语录 </th>
              <th> 时间 </th>
              <th> 操作 </th>
            </tr>
            <tbody id="rollin" data-cnt="1" data-name="rollInHistoryList">
          <?php foreach($lists as $val){?>
          <tr>
            <td><?php echo $val['classicno'];?></td>
            <td style=" max-width:650px"><?php echo nl2br($val['content']);?></td>
            <td><?php echo substr($val['updatetime'],2,8);?></td> 
            <td><a class="btn BtnSty editbut" href="javascript:" data-c="<?php echo $val['content'];?>" data-n="<?php echo $val['classicno'];?>" style="width:28px;padding:0 5px;float: none;">编辑</a></td>
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
<!--弹窗区域   经典语录内容-->
<div class="toWinUser">
	<div class="Enterpsw" style="height:280px;width:400px;">
      <h1>经典语录</h1>
      <form id="toWin">
      <input name="objNo" type="hidden" value="" id="classicno" />
      <table cellpadding="0" cellspacing="0" style="  width: 100%;height: 70%;border: 1px solid #DEDEDE; top:80px;">
        <tr>
          <th>编号</th>
          <td id="classicnos"></td>
        </tr>
        <tr>
          <th>语录 </th>
          <td><textarea id="content" name="content" cols="45" rows="7"></textarea></td>
        </tr>
        <tr>
          <td class="label">&nbsp;</td>
          <td><input name="" type="button" class="BtnSty" id="saveBtnWin" style="margin:20px 0px;width:150px;" value="保存" /></td>
        </tr>
      </table>
      </form>
      <div class="ClosebtnWin"></div>
    </div>
</div>


<script type="text/javascript">

    $(function () {
		//约稿
		$('.editbut').click(function () {
			var content = $(this).data('c'),classicno = $(this).data('n');
			$('#classicno').val(classicno);
			$('#classicnos').html(classicno);
			$('#content').val(content);

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
				url: '/pzu/wbclassicsave.html',
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