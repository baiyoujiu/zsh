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
            <?php foreach($lists as $k1 =>$v){ ?>
                <li class="right">
                    <div class="stagelists" data-pic="<?php echo $v['pic'];?>">
                        <p><?php echo $v['area'];?> <span class="fr" ><i class="icon-location"></i>地图</span></p>
                        <p><?php echo $v['address'];?></p>
                    </div>
                </li>
            <?php }?>
        </ul>
    </section>
    <section class="zhanwei_hei01"></section>
    <section>
        <div id="mapinf"><img src="/images/stages/zjyz1001.png" /></div>
    </section>

    <!--选择地址-->

<script type="text/javascript">

    $('#area').change(function(){
        var area = $(this).val();
        window.location.href = '/goods/stage.html?area='+area;
    })

	$('.stagelists').click(function(){
        $('#mapinf img').attr('src',$(this).data('pic'));
		
	});

    $('.stagelists:first').click();
</script>
<!--占位-->
<section class="zhanwei_hei55"></section>
{include file="common/footer" /}

