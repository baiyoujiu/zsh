{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="account_box hengruibao_in_box">
    <div class="tab_link_style"> <span class="row_jl">用户管理</span>
        <ul id="record"><li>&nbsp;</li></ul>
    </div>
    <div class="user-box-2">
      <div class="searchForm">
      <form action="" method="get">
          　关键字:<input name="keywords" type="text" class="input-text-style-1" value="<?php echo $keywords;?>" placeholder="请输入用户名/手机号/用户昵称" />
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
              <th> 用户类型 </th>
              <th> 用户昵称 </th>
              <th> 账户金额 </th>
              <th> 注册时间 </th>
              <th> 操作 </th>
            </tr>
          </thead>
          <tbody id="rollin" data-cnt="1" data-name="rollInHistoryList">
            <?php foreach($lists as $val){?>
            <tr>
              <td><?php echo mb_substr($val['username'],0,15);?></td>
              <td><?php echo mb_substr(decryptd($val['phone']),0,11);?></td>
              <td><?php echo $val['utype']== 1?'写手':'网编';?></td>
              <td><?php echo $useridarr[$val['userid']];?></td>
              <td><?php echo number_format($flists[$val['userid']]/100,2);?></td>
              <td><?php echo substr($val['addtime'],2,8);?></td>
              <td>　<a class="btn BtnSty edbut" href="javascript:" data-u="<?php echo $val['userid'];?>" data-na="<?php echo $val['username'];?>" data-n="<?php echo $useridarr[$val['userid']];?>" data-t="<?php echo $val['utype'];?>" style="width:28px;padding:0 5px;float: none;">编辑</a></td>
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
<!--弹窗区域-->
<div class="bg_black"></div>
<!--弹窗区域   约稿-->
<div class="toWinUser">
	<div class="Enterpsw" style="height:350px;width:400px;">
      <h1>编辑</h1>
      <form id="toWin">
      <input name="userid" type="hidden" value="" id="userid" />
      <input name="utype" type="hidden" value="" id="utype" />
      <table cellpadding="0" cellspacing="0" style="  width: 100%;height: 70%;border: 1px solid #DEDEDE;">
        <tr>
          <th>用户名</th>
          <td id="username"></td>
        </tr>
        <tr>
          <th>对外昵称<b class="colorred">*</b></th>
          <td><input class="BrdHei" id="nickname" name="nickname" type="text" placeholder="用户对外昵称"/></td>
        </tr>
        <tr class="xsmore">
          <th> 签约稿费<b class="colorred">*</b> </th>
          <td><input class="BrdHei" name="gaofee" id="gaofee" type="number" placeholder="请输入签约稿费" onkeyup="value=value.replace(/[^\d]/g,'')"  value="10"/>元</td>
        </tr>
        <tr class="xsmore">
          <th> 网编稿费<b class="colorred">*</b> </th>
          <td><input class="BrdHei" name="prices" id="prices" type="number" placeholder="请输入网编稿费" onkeyup="value=value.replace(/[^\d]/g,'')"  value="20"/>元</td>
        </tr>
        <tr>
          <th>维护备注</th>
          <td ><textarea id="remarks" name="remarks" cols="40" rows="3"></textarea></td>
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
<script type="text/javascript">

    $(function () {
		//约稿
		$('.edbut').click(function () {
			var userid = $(this).data('u'),nickname = $(this).data('n'),username = $(this).data('na'),type = $(this).data('t');
			$('#userid').val(userid);
			$('#utype').val(type);
			$('#username').html(username);
			$('#nickname').val(nickname);
			
			if(type == 1){
				$('.xsmore').show();
			}else{
				$('.xsmore').hide();
			}

			$(".toWinUser").show();
			$(".toWinUser>div").show();
			$(".bg_black").show();
			var dh = 660;
			var ih = $(window).height();
			var zh = (ih - dh) / 2;
			$(".toWinUser>div").css("top", zh);	
			
			$.ajax({
				url: '/pzu/userinf.html',
				cache: false,
				data: {userid:userid,type:type,i:Math.random()},
				type: 'post',
				dataType: 'json',
				success: function (data) {
					if (data.status == 200) {
						if(type = 1){
							$('#gaofee').val(data.msg.gaofee);
							$('#prices').val(data.msg.prices);
						}
						$('#remarks').val(data.msg.remarks);
					}
				}
			});
			
		});
		$(".ClosebtnWin").click(function() {
			$(this).parent("div").hide().parent(".toWinUser").hide();
			$(".bg_black").hide();
		});
		$('#saveBtnWin').click(function(){
			var saveBtn = $(this);
			saveBtn.attr("disabled", true);
			$.ajax({
				url: '/pzu/usersave.html',
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
