{include file="common/header" /}
<section class="sc_home">
    <section class="ds_home_head">
        <h2 class="fanhui_head"><a href="javascript:history.back(-1);"><i class="icon-left"></i></a><span id="adrtitle">租借驿站</span></h2>
    </section>
    <section class="zhanwei_hei35"></section>
    <section class="zhanwei_hei01"></section>
    <section>
        <ul class="add_dizhi_lists">
            <li class="right">
                <div class="fl add_address_list_sec" style=" width:49%">
                    <select class="pro_code" >
                        <option value="">浙江省杭州市</option>
                    </select>
                </div>
                <div class="add_address_list_sec fl" style=" width:49%">
                    <select class="areacode" name="area" id="area">
                        <?php foreach($alists as $k=>$v){?>
                            <option value="<?php echo $v['code'];?>"<?php echo $v['code']==$area?"selected='selected'":'';?>><?php echo $v['area'];?></option>
                        <?php }?>
                    </select>
                </div>
            </li>
            <?php foreach($lists as $k =>$v){ ?>
                <li class="right">
                    <div class="stagelists" data-pic="<?php echo $k;?>">
                        <p><b><?php echo $v['area'];?></b> <span class="fr" ><i class="icon-location"></i>地图</span></p>
                        <p><?php echo $v['address'];?></p>
                    </div>
                </li>
                <?php if($v['pic']){?>
                <li class="picshow pic<?php echo $k;?>" style="display:none;"><img src="<?php echo $v['pic'];?>" /></li>
            <?php }}?>
        </ul>
    </section>
    <section class="zhanwei_hei01"></section>


    <!--选择地址-->

<script type="text/javascript">
	$('.picshow').hide();
    $('#area').change(function(){
        var area = $(this).val();
        window.location.href = '/goods/stage.html?area='+area;
    })
	

	$('.stagelists').click(function(){
		$('.picshow').hide();
        $('.pic'+$(this).data('pic')).show();
	});

    $('.stagelists:first').click();
</script>
<!--占位-->
<section class="zhanwei_hei55"></section>
{include file="common/footer" /}

