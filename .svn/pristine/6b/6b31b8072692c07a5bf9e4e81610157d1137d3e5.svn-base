{include file="common/header" /}
<style>
.person_lists li .xfu{ height:10rem; width:6rem;}
.person_lists li table{ width:100%; border:1px solid #a9a9a9;}
.person_lists li table td{ text-align:center;}
.person_lists li b{ color:red; margin:0 0.5rem}
</style>
<section class="sc_home">
    <!--head-->
    <section class="ds_home_head">
        <h2>个人中心</h2>
    </section>
    <section class="zhanwei_hei30"></section>
    <section class="ds_wode_back">
        <div class="clearfix ds_wode_uname">
            <img class="fl" src="__IMG__/userdef.png" />
            <p class="fl" style=" height:7.5rem;">
				<?php echo $userinfo['username'];?>
            	<br><?php echo $userinfo['students'].'('.$userinfo['grade'].'0'.$userinfo['class'].')';?>
                <br>身高：<?php echo $userinfo['height'].'厘米，体重'.$userinfo['weight'].'斤';?>
            </p>
        </div>
        
    </section>
    <section>
        <ul class="person_lists">
            <li class="clearfix showclass">
                <img class="fl" src="__IMG__/personal-img5.png"/>
                <p class="fl"><b><?php echo $userinfo['grade'].'0'.$userinfo['class']?></b>班校服登记情况</p>
                <i class="fr icon-down"></i>
            </li>
            <li class="clearfix classinfo">
                <table border="1">
                  <tr>
                    <td>姓名</td>
                    <td>女夏</td>
                    <td>男夏</td>
                    <td>运动</td>
                    <td>冬装</td>
                    <td>长袖</td>
                    <td>长裤</td>
                  </tr>
                  <?php foreach($clists as $v){?>
                  <tr>
                    <td><?php echo $v['students'];?></td>
                    <td><?php $xfu1 += $v['xfu1'];echo $v['xfu1'];?></td>
                    <td><?php $xfu2 += $v['xfu2'];echo $v['xfu2'];?></td>
                    <td><?php $xfu3 += $v['xfu3'];echo $v['xfu3'];?></td>
                    <td><?php $xfu4 += $v['xfu4'];echo $v['xfu4'];?></td>
                    <td><?php $xfu5 += $v['xfu5'];echo $v['xfu5'];?></td>
                    <td><?php $xfu6 += $v['xfu6'];echo $v['xfu6'];?></td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td>统计</td>
                    <td><?php echo $xfu1;?></td>
                    <td><?php echo $xfu2;?></td>
                    <td><?php echo $xfu3;?></td>
                    <td><?php echo $xfu4;?></td>
                    <td><?php echo $xfu5;?></td>
                    <td><?php echo $xfu6;?></td>
                  </tr>
                </table>
            </li>
            <li class="clearfix showclass">
                <img class="fl" src="__IMG__/personal-img4.png"/>
                <p class="fl">我的校服登记情况</p>
            </li>
            <li class="clearfix">
                <a href="__IMG__/001.jpg" target="_blank"><img class="fl xfu" src="__IMG__/001.jpg"/></a>
                <p class="fl">夏女装 <b><?php echo $userinfo['xfu1'];?></b> 套</p>
            </li>
            <li class="clearfix">
                <a href="__IMG__/002.jpg" target="_blank"><img class="fl xfu" src="__IMG__/002.jpg"/></a>
                <p class="fl">夏男装 <b><?php echo $userinfo['xfu2'];?></b> 套</p>
            </li>
            <li class="clearfix">
                <a href="__IMG__/003.jpg" target="_blank"><img class="fl xfu" src="__IMG__/003.jpg"/></a>
                <p class="fl">运动服 <b><?php echo $userinfo['xfu3'];?></b> 套</p>
            </li>
            <li class="clearfix">
                <a href="__IMG__/004.jpg" target="_blank"><img class="fl xfu" src="__IMG__/004.jpg"/></a>
                <p class="fl">冬装 <b><?php echo $userinfo['xfu4'];?></b> 套</p>
            </li>
            <li class="clearfix">
                <a href="__IMG__/005.jpg" target="_blank"><img class="fl xfu" src="__IMG__/005.jpg"/></a>
                <p class="fl">长袖T恤 <b><?php echo $userinfo['xfu5'];?></b> 套</p>
            </li>
            <li class="clearfix">
                <a href="__IMG__/005.jpg" target="_blank"><img class="fl xfu" src="__IMG__/005.jpg"/></a>
                <p class="fl">长裤 <b><?php echo $userinfo['xfu6'];?></b> 套</p>
            </li>
            
            
        </ul>
    </section>
    <!--<section>
    <img src="__IMG__/banner5.jpg"/>
    </section>-->
    <!--退出登录-->
    <section>
        <div class="grzx_tcdl">
            <a href="<?php echo url('login/logout');?>"><p>退出登录</p></a>
        </div>
    </section>
<script type="text/javascript">
$('.classinfo').hide();
$(function(){
	$(".showclass").click(function(){
		$('.classinfo').toggle();
	})
})
</script>